/* ==================================================================== 
 * The Kannel Software License, Version 1.0 
 * 
 * Copyright (c) 2001-2004 Kannel Group  
 * Copyright (c) 1998-2001 WapIT Ltd.   
 * All rights reserved. 
 * 
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions 
 * are met: 
 * 
 * 1. Redistributions of source code must retain the above copyright 
 *    notice, this list of conditions and the following disclaimer. 
 * 
 * 2. Redistributions in binary form must reproduce the above copyright 
 *    notice, this list of conditions and the following disclaimer in 
 *    the documentation and/or other materials provided with the 
 *    distribution. 
 * 
 * 3. The end-user documentation included with the redistribution, 
 *    if any, must include the following acknowledgment: 
 *       "This product includes software developed by the 
 *        Kannel Group (http://www.kannel.org/)." 
 *    Alternately, this acknowledgment may appear in the software itself, 
 *    if and wherever such third-party acknowledgments normally appear. 
 * 
 * 4. The names "Kannel" and "Kannel Group" must not be used to 
 *    endorse or promote products derived from this software without 
 *    prior written permission. For written permission, please  
 *    contact org@kannel.org. 
 * 
 * 5. Products derived from this software may not be called "Kannel", 
 *    nor may "Kannel" appear in their name, without prior written 
 *    permission of the Kannel Group. 
 * 
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESSED OR IMPLIED 
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES 
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE 
 * DISCLAIMED.  IN NO EVENT SHALL THE KANNEL GROUP OR ITS CONTRIBUTORS 
 * BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,  
 * OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT  
 * OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR  
 * BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,  
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE  
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,  
 * EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
 * ==================================================================== 
 * 
 * This software consists of voluntary contributions made by many 
 * individuals on behalf of the Kannel Group.  For more information on  
 * the Kannel Group, please see <http://www.kannel.org/>. 
 * 
 * Portions of this software are based upon software originally written at  
 * WapIT Ltd., Helsinki, Finland for the Kannel project.  
 */ 

/*
 * smsc_at.c
 * 
 * New driver for serial connected AT based
 * devices.
 * 4.9.2001
 * Andreas Fink <afink@smsrelay.com>
 *
 */

#include <errno.h>
#include <stdarg.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <fcntl.h>
#include <ctype.h>
#include <termios.h>
#include <sys/time.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <netdb.h>
#include <sys/ioctl.h>
#include <time.h>
#include <math.h>

#include "gwlib/gwlib.h"
#include "gwlib/charset.h"
#include "smscconn.h"
#include "smscconn_p.h"
#include "bb_smscconn_cb.h"
#include "msg.h"
#include "sms.h"
#include "dlr.h"
#include "smsc_at.h"

static int at2_open_device1(PrivAT2data *privdata)
{
    info(0, "AT2[%s]: opening device", octstr_get_cstr(privdata->name));
    if (privdata->fd > 0) {
        warning(0, "AT2[%s]: trying to open device with not closed device!!! Please report!!!",
                 octstr_get_cstr(privdata->name));
        at2_close_device(privdata);
    }
    privdata->fd = open(octstr_get_cstr(privdata->device), 
                        O_RDWR | O_NONBLOCK | O_NOCTTY);
    if (privdata->fd == -1) {
        error(errno, "AT2[%s]: open failed! ERRNO=%d", octstr_get_cstr(privdata->name), errno);
        privdata->fd = -1;
        return -1;
    }
    debug("bb.smsc.at2", 0, "AT2[%s]: device opened", octstr_get_cstr(privdata->name));

    return 0;
}


int	at2_open_device(PrivAT2data *privdata)
{
    struct termios tios;
    int ret;

    if ((ret = at2_open_device1(privdata)) != 0)
        return ret;

    tcgetattr(privdata->fd, &tios);

    kannel_cfmakeraw(&tios);
                      
    tios.c_iflag |= IGNBRK; /* ignore break & parity errors */
    tios.c_iflag &= ~INPCK; /* INPCK: disable parity check */
    tios.c_cflag |= HUPCL; /* hangup on close */
    tios.c_cflag |= CREAD; /* enable receiver */
    tios.c_cflag &= ~CSIZE; /* set to 8 bit */
    tios.c_cflag |= CS8;
    tios.c_oflag &= ~ONLCR; /* no NL to CR-NL mapping outgoing */
    tios.c_iflag |= IGNPAR; /* ignore parity */
    tios.c_iflag &= ~INPCK;
    tios.c_cflag |= CRTSCTS; /* enable hardware flow control */
    tios.c_cc[VSUSP] = 0; /* otherwhise we can not send CTRL Z */

    /*
    if ( ModemTypes[privdata->modemid].enable_parity )
    	tios.c_cflag ^= PARODD;
    */

    ret = tcsetattr(privdata->fd, TCSANOW, &tios); /* apply changes now */
    if (ret == -1) {
        error(errno, "AT2[%s]: at_data_link: fail to set termios attribute",
              octstr_get_cstr(privdata->name));
    }
    tcflush(privdata->fd, TCIOFLUSH);
         
    /* 
     * Nokia 7110 and 6210 need some time between opening
     * the connection and sending the first AT commands 
     */
    if (privdata->modem == NULL || privdata->modem->need_sleep)
        sleep(1);
    debug("bb.smsc.at2", 0, "AT2[%s]: device opened", octstr_get_cstr(privdata->name));
    return 0;
}


void at2_close_device(PrivAT2data *privdata)
{
    info(0, "AT2[%s]: closing device", octstr_get_cstr(privdata->name));
    close(privdata->fd);
    privdata->fd = -1;
    privdata->pin_ready = 0;
    privdata->phase2plus = 0;
    if (privdata->ilb != NULL)
        octstr_destroy(privdata->ilb);
    privdata->ilb = octstr_create("");
}


void at2_read_buffer(PrivAT2data *privdata)
{
    char buf[MAX_READ + 1];
    int s, ret;
    int count;
    fd_set read_fd;
    struct timeval tv;

    if (privdata->fd == -1) {
        error(errno, "AT2[%s]: at2_read_buffer: fd = -1. Can not read", 
              octstr_get_cstr(privdata->name));
        return ;
    }
    count = MAX_READ;

#ifdef SSIZE_MAX
    if (count > SSIZE_MAX)
        count = SSIZE_MAX;
#endif

    tv.tv_sec = 0;
    tv.tv_usec = 1000;

    FD_ZERO(&read_fd);
    FD_SET(privdata->fd, &read_fd);
    ret = select(privdata->fd + 1, &read_fd, NULL, NULL, &tv);
    if (ret == -1) {
        if (!(errno == EINTR || errno == EAGAIN))
            error(errno, "AT2[%s]: error on select", octstr_get_cstr(privdata->name));
        return;
    }

    s = read(privdata->fd, buf, count);
    if (s > 0)
        octstr_append_data(privdata->ilb, buf, s);
}


Octstr *at2_wait_line(PrivAT2data *privdata, time_t timeout, int gt_flag)
{
    Octstr *line;
    time_t end_time;
    time_t cur_time;

    time(&end_time);
    if (timeout == 0)
        timeout = 3;
    end_time += timeout;

    if (privdata->lines != NULL)
        octstr_destroy(privdata->lines);
    privdata->lines = octstr_create("");
    while (time(&cur_time) <= end_time) {
        line = at2_read_line(privdata, gt_flag);
        if (line)
            return line;
    }
    return NULL;
}


Octstr *at2_read_line(PrivAT2data *privdata, int gt_flag)
{
    int	eol;
    int gtloc;
    int len;
    Octstr *line;
    Octstr *buf2;
    int i;

    at2_read_buffer(privdata);

    len = octstr_len(privdata->ilb);
    if (len == 0)
        return NULL;

    if (gt_flag)
        /* looking for > if needed */
        gtloc = octstr_search_char(privdata->ilb, '>', 0); 
    else
        gtloc = -1;

    /*   
    if (gt_flag && (gtloc != -1))
        debug("bb.smsc.at2", 0, "in at2_read_line with gt_flag=1, gtloc=%d, ilb=%s",
              gtloc, octstr_get_cstr(privdata->ilb));
    */

    eol = octstr_search_char(privdata->ilb, '\r', 0); /* looking for CR */

    if ( (gtloc != -1) && ( (eol == -1) || (eol > gtloc) ) )
        eol = gtloc;

    if (eol == -1)
        return NULL;

    line = octstr_copy(privdata->ilb, 0, eol);
    buf2 = octstr_copy(privdata->ilb, eol + 1, len);
    octstr_destroy(privdata->ilb);
    privdata->ilb = buf2;

    /* remove any non printable chars (including linefeed for example) */
    for (i = 0; i < octstr_len(line); i++) {
        if (octstr_get_char(line, i) < 32)
            octstr_set_char(line, i, ' ');
    }
    octstr_strip_blanks(line);

    /* empty line, skipping */
    if ((strcmp(octstr_get_cstr(line), "") == 0) && ( gt_flag == 0)) 
    {
        octstr_destroy(line);
        return NULL;
    }
    if ((gt_flag) && (gtloc != -1)) {
        /* got to re-add it again as the parser needs to see it */
        octstr_append_cstr(line, ">"); 
    }
    debug("bb.smsc.at2", 0, "AT2[%s]: <-- %s", octstr_get_cstr(privdata->name), 
          octstr_get_cstr(line));
    return line;
}


int at2_write_line(PrivAT2data *privdata, char *line)
{
    int count;
    int s = 0;
    int write_count = 0, data_written = 0;
    Octstr *linestr = NULL;

    linestr = octstr_format("%s\r", line);

    debug("bb.smsc.at2", 0, "AT2[%s]: --> %s^M", octstr_get_cstr(privdata->name), line);

    count = octstr_len(linestr);
    while (count > data_written) {
	errno = 0;
	s = write(privdata->fd, octstr_get_cstr(linestr) + data_written, count - data_written);
	if (s < 0 && errno == EAGAIN && write_count < RETRY_SEND) {
	    gwthread_sleep(1);
	    ++write_count;
        } else if (s > 0) {
            data_written += s;
            write_count = 0;
	} else
	    break;
    };
    O_DESTROY(linestr);
    if (s < 0) {
        error(errno, "AT2[%s]: Couldnot write to device.", 
              octstr_get_cstr(privdata->name));
        tcflush(privdata->fd, TCOFLUSH);
        return s;
    }
    tcdrain(privdata->fd);
    gwthread_sleep((double) (privdata->modem == NULL ? 
        100 : privdata->modem->sendline_sleep) / 1000);
    return s;
}


int at2_write_ctrlz(PrivAT2data *privdata)
{
    int s;
    char *ctrlz = "\032" ;
    int write_count = 0;
    
    debug("bb.smsc.at2", 0, "AT2[%s]: --> ^Z", octstr_get_cstr(privdata->name));
    while (1) {
	errno = 0;
	s = write(privdata->fd, ctrlz, 1);
	if (s < 0 && errno == EAGAIN && write_count < RETRY_SEND) {
	    gwthread_sleep(1);
	    ++write_count;
	} else
	    break;
    };
    if (s < 0) {
        error(errno, "AT2[%s]: Couldnot write to device.", 
              octstr_get_cstr(privdata->name));
        tcflush(privdata->fd, TCOFLUSH);
        return s;
    }
    tcdrain(privdata->fd);
    gwthread_sleep((double) (privdata->modem == NULL ?
        100 : privdata->modem->sendline_sleep) / 1000);
    return s;
}
      

int at2_write(PrivAT2data *privdata, char *line)
{
    int count, data_written = 0, write_count = 0;
    int s = 0;

    debug("bb.smsc.at2", 0, "AT2[%s]: --> %s", octstr_get_cstr(privdata->name), line);

    count = strlen(line);
    while(count > data_written) {
        s = write(privdata->fd, line + data_written, count - data_written);
        if (s < 0 && errno == EAGAIN && write_count < RETRY_SEND) {
            gwthread_sleep(1);
            ++write_count;
        } else if (s > 0) {
            data_written += s;
            write_count = 0;
        } else
            break;
    }

    if (s < 0) {
        error(errno, "AT2[%s]: Couldnot write to device.",
              octstr_get_cstr(privdata->name));
        tcflush(privdata->fd, TCOFLUSH);
        return s;
    }
    tcdrain(privdata->fd);
    gwthread_sleep((double) (privdata->modem == NULL ?
        100 : privdata->modem->sendline_sleep) / 1000);
    return s;
}


void at2_flush_buffer(PrivAT2data *privdata)
{
    at2_read_buffer(privdata);
    octstr_destroy(privdata->ilb);
    privdata->ilb = octstr_create("");
}


int	at2_init_device(PrivAT2data *privdata)
{
    int ret;
    Octstr *setpin;

    info(0, "AT2[%s]: init device", octstr_get_cstr(privdata->name));

    at2_set_speed(privdata, privdata->speed);
    /* sleep 10 ms in order to get device some time to accept speed */
    gwthread_sleep(0.10);

    /* reset the modem */
    if (at2_send_modem_command(privdata, "ATZ", 0, 0) == -1)
        return -1;

    /* check if the modem responded */
    if (at2_send_modem_command(privdata, "AT", 0, 0) == -1) {
        error(0, "AT2[%s]: no answer from modem", octstr_get_cstr(privdata->name));
        return -1;
    }

    at2_flush_buffer(privdata);

    if (at2_send_modem_command(privdata, "AT&F", 0, 0) == -1)
        return -1;

    if (at2_send_modem_command(privdata, "ATE0", 0, 0) == -1)
        return -1;

    at2_flush_buffer(privdata);

    /* enable hardware handshake */
    if (octstr_len(privdata->modem->enable_hwhs)) {
        if (at2_send_modem_command(privdata, 
            octstr_get_cstr(privdata->modem->enable_hwhs), 0, 0) == -1)
            info(0, "AT2[%s]: cannot enable hardware handshake", 
                 octstr_get_cstr(privdata->name));
    }

    /*
     * Check does the modem require a PIN and, if so, send it.
     * This is not supported by the Nokia Premicell 
     */
    if (!privdata->modem->no_pin) {
        ret = at2_send_modem_command(privdata, "AT+CPIN?", 10, 0);

        if (!privdata->pin_ready) {
            if (ret == 2) {
                if (privdata->pin == NULL)
                    return -1;
                setpin = octstr_format("AT+CPIN=\"%s\"", octstr_get_cstr(privdata->pin));
                ret = at2_send_modem_command(privdata, octstr_get_cstr(setpin), 0, 0);
                octstr_destroy(setpin);
                if (ret != 0 )
                    return -1;
            } else if (ret == -1)
                return -1;
        }

        /* 
         * we have to wait until +CPIN: READY appears before issuing
         * the next command. 10 sec should be suficient 
         */
        if (!privdata->pin_ready) {
            at2_wait_modem_command(privdata, 10, 0, NULL);
            if (!privdata->pin_ready) {
                at2_send_modem_command(privdata, "AT+CPIN?", 10, 0);
                if (!privdata->pin_ready) {
                    return -1; /* give up */
                }
            }
        }
    }
    /* 
     * Set the GSM SMS message center address if supplied 
     */
    if (octstr_len(privdata->sms_center)) {
        Octstr *temp;
        temp = octstr_create("AT+CSCA=");
        octstr_append_char(temp, 34);
        octstr_append(temp, privdata->sms_center);
        octstr_append_char(temp, 34);
        /* 
         * XXX If some modem don't process the +, remove it and add ",145"
         * and ",129" to national numbers
         */
        ret = at2_send_modem_command(privdata, octstr_get_cstr(temp), 0, 0);
        octstr_destroy(temp);
        if (ret == -1)
            return -1;
        if (ret > 0) {
            info(0, "AT2[%s]: Cannot set SMS message center, continuing", 
                 octstr_get_cstr(privdata->name));
        }
    }

    /* Set the modem to PDU mode and autodisplay of new messages */
    ret = at2_send_modem_command(privdata, "AT+CMGF=0", 0, 0);
    if (ret != 0 )
        return -1;

    /* lets see if it supports GSM SMS 2+ mode */
    ret = at2_send_modem_command(privdata, "AT+CSMS=?", 0, 0);
    if (ret != 0) {
        /* if it doesnt even understand the command, I'm sure it wont support it */
        privdata->phase2plus = 0; 
    } else {
        /* we have to take a part a string like +CSMS: (0,1,128) */
        Octstr *ts;
        int i;
        List *vals;

        ts = privdata->lines;
        privdata->lines = NULL;

        i = octstr_search_char(ts, '(', 0);
        if (i > 0) {
            octstr_delete(ts, 0, i + 1);
        }
        i = octstr_search_char(ts, ')', 0);
        if (i > 0) {
            octstr_truncate(ts, i);
        }
        vals = octstr_split(ts, octstr_imm(","));
        octstr_destroy(ts);
        ts = list_search(vals, octstr_imm("1"), (void*) octstr_item_match);
        if (ts)
            privdata->phase2plus = 1;
        list_destroy(vals, octstr_destroy_item);
    }
    if (privdata->phase2plus) {
        info(0, "AT2[%s]: Phase 2+ is supported", octstr_get_cstr(privdata->name));
        ret = at2_send_modem_command(privdata, "AT+CSMS=1", 0, 0);
        if (ret != 0)
            return -1;
    }

    /* send init string */
    ret = at2_send_modem_command(privdata, octstr_get_cstr(privdata->modem->init_string), 0, 0);
    if (ret != 0)
        return -1;

    if (privdata->sms_memory_poll_interval && privdata->modem->message_storage) {
        /* set message storage location for "SIM buffering" using the CPMS command */
        if (at2_set_message_storage(privdata, privdata->modem->message_storage) != 0)
            return -1;
    }

    info(0, "AT2[%s]: AT SMSC successfully opened.", octstr_get_cstr(privdata->name));
    return 0;
}


int at2_send_modem_command(PrivAT2data *privdata, char *cmd, time_t timeout, int gt_flag)
{
    at2_write_line(privdata, cmd);
    return at2_wait_modem_command(privdata, timeout, gt_flag, NULL);
}


int at2_wait_modem_command(PrivAT2data *privdata, time_t timeout, int gt_flag, 
                           int *output)
{
    Octstr *line = NULL;
    Octstr *line2 = NULL;
    Octstr *pdu = NULL;
    int ret;
    time_t end_time;
    time_t cur_time;
    Msg	*msg;
    int len;
    int cmgr_flag = 0;

    time(&end_time);
    if (timeout == 0)
        timeout = 3;
    end_time += timeout;

    if (privdata->lines != NULL)
        octstr_destroy(privdata->lines);
    privdata->lines = octstr_create("");
    while (time(&cur_time) <= end_time) {
        O_DESTROY(line);
        line = at2_read_line(privdata, gt_flag);
        if (line) {
            octstr_append(privdata->lines, line);
            octstr_append_cstr(privdata->lines, "\n");

            if (octstr_search(line, octstr_imm("SIM PIN"), 0) != -1) {
                ret = 2;
                goto end;
            }
            if (octstr_search(line, octstr_imm("OK"), 0) != -1) {
                ret = 0;
                goto end;
            }
            if ((gt_flag ) && (octstr_search(line, octstr_imm(">"), 0) != -1)) {
                ret = 1;
                goto end;
            }
            if (octstr_search(line, octstr_imm("RING"), 0) != -1) {
                at2_write_line(privdata, "ATH0");
                continue;
            }
            if (octstr_search(line, octstr_imm("+CPIN: READY"), 0) != -1) {
                privdata->pin_ready = 1;
                continue;
            }
            if ( -1 != octstr_search(line, octstr_imm("+CMS ERROR"), 0)) {
                int errcode;
                sscanf(octstr_get_cstr(line), "+CMS ERROR: %d", &errcode);
                error(0, "AT2[%s]: CMS ERROR: %s (%s)", octstr_get_cstr(privdata->name), 
                      octstr_get_cstr(line), at2_error_string(errcode));
                ret = 1;
                goto end;
            }
            if (octstr_search(line, octstr_imm("+CMTI:"), 0) != -1 || 
                octstr_search(line, octstr_imm("+CDSI:"), 0) != -1) {
		/*
		   we received an incoming message indication
		   put it in the pending_incoming_messages queue for later retrieval
		*/
                debug("bb.smsc.at2", 0, "AT2[%s]: +CMTI incoming SMS indication: %s", octstr_get_cstr(privdata->name), octstr_get_cstr(line));
                list_append(privdata->pending_incoming_messages, line);
                line = NULL;
                continue;
            }
            if (octstr_search(line, octstr_imm("+CMT:"), 0) != -1 ||
		octstr_search(line, octstr_imm("+CDS:"), 0) != -1 ||
                ((octstr_search(line, octstr_imm("+CMGR:"), 0) != -1) && (cmgr_flag = 1)) ) {
                line2 = at2_wait_line(privdata, 1, 0);

                if (line2 == NULL) {
                    error(0, "AT2[%s]: got +CMT but waiting for next line timed out", 
                          octstr_get_cstr(privdata->name));
                } else {
                    octstr_append_cstr(line, "\n");
                    octstr_append(line, line2);
                    O_DESTROY(line2);
                    at2_pdu_extract(privdata, &pdu, line);

                    if (pdu == NULL) {
                        error(0, "AT2[%s]: got +CMT but pdu_extract failed", 
                              octstr_get_cstr(privdata->name));
                    } else {
                        /* count message even if I can't decode it */
                        if (output)
                            ++(*output);
                        msg = at2_pdu_decode(pdu, privdata);
                        if (msg != NULL) {
                            msg->sms.smsc_id = octstr_duplicate(privdata->conn->id);
                            bb_smscconn_receive(privdata->conn, msg);
                        } else {
                            error(0, "AT2[%s]: could not decode PDU to a message.",
                                  octstr_get_cstr(privdata->name));
                        }

                        if (!cmgr_flag) {
                            if (privdata->phase2plus)
                                at2_write_line(privdata, "AT+CNMA");
                        }

                        O_DESTROY(pdu);
                    }
                }
                continue;
            }
            if ((octstr_search(line, octstr_imm("+CMGS:"),0) != -1) && (output)) {
		/* found response to a +CMGS command, read the message id and return it in output */
		long temp;
		if (octstr_parse_long(&temp, line, octstr_search(line, octstr_imm("+CMGS:"),0)+6,10) == -1)
		    error(0,"AT2[%s]: got +CMGS but failed to read message id", octstr_get_cstr(privdata->name));
		else
		    *output = temp;
            }

            if ( -1 != octstr_search(line, octstr_imm("ERROR"), 0)) {
                int errcode;
                sscanf(octstr_get_cstr(line), "ERROR: %d", &errcode);
                error(0, "AT2[%s]: Error occurs: %s (%s)", octstr_get_cstr(privdata->name),
                      octstr_get_cstr(line), at2_error_string(errcode));
                ret = -1;
                goto end;
            }
        }
    }

    len = octstr_len(privdata->ilb);
    /*
    error(0,"AT2[%s]: timeout. received <%s> until now, buffer size is %d, buf=%s",
          octstr_get_cstr(privdata->name),
          privdata->lines ? octstr_get_cstr(privdata->lines) : "<nothing>", len,
          privdata->ilb ? octstr_get_cstr(privdata->ilb) : "<nothing>");
    */
    O_DESTROY(line);
    O_DESTROY(line2);
    O_DESTROY(pdu);
    return -1; /* timeout */

end:
    octstr_append(privdata->lines, line);
    octstr_append_cstr(privdata->lines, "\n");
    O_DESTROY(line);
    O_DESTROY(line2);
    O_DESTROY(pdu);
    return ret;
}

int at2_read_delete_message(PrivAT2data* privdata, int message_number)
{
    char cmd[20];
    int message_count = 0;

    sprintf(cmd, "AT+CMGR=%d", message_number);
    /* read one message from memory */
    at2_write_line(privdata, cmd);
    if (at2_wait_modem_command(privdata, 0, 0, &message_count) != 0) {
	debug("bb.smsc.at2", 0, "AT2[%s]: failed to get message %d.", 
	    octstr_get_cstr(privdata->name), message_number);
        return 0; /* failed to read the message - skip to next message */
    }

    /* no need to delete if no message collected */
    if (!message_count) { 
	debug("bb.smsc.at2", 0, "AT2[%s]: not deleted.", 
	    octstr_get_cstr(privdata->name));
        return 0;
    }

    sprintf(cmd, "AT+CMGD=%d", message_number); /* delete the message we just read */
    /* 
    * 3 seconds (default timeout of send_modem_command()) is not enough with some
    * modems if the message is large, so we'll give it 7 seconds 
    */
    if (at2_send_modem_command(privdata, cmd, 7, 0) != 0) {  
        /* 
         * failed to delete the message, we'll just ignore it for now, 
         * this is bad, since if the message really didn't get deleted
         * we'll see it next time around. 
         */                
        error(2, "AT2[%s]: failed to delete message %d.",
              octstr_get_cstr(privdata->name), message_number);
    }

    return 1;
}

/*
 * This function loops through the pending_incoming_messages queue for CMTI
 * notifications.
 * Every notification is parsed and the messages are read (and deleted)
 * accordingly.
*/
void at2_read_pending_incoming_messages(PrivAT2data* privdata)
{
    Octstr *current_storage = NULL;

    if (privdata->modem->message_storage) {
	    current_storage = octstr_duplicate(privdata->modem->message_storage);
    }
    while (list_len(privdata->pending_incoming_messages) > 0) {
        int pos;
        long location;
        Octstr *cmti_storage = NULL, *line = NULL;
        
        line = list_extract_first(privdata->pending_incoming_messages);
	/* message memory starts after the first quote in the string */
        if ((pos = octstr_search_char(line, '"', 0)) != -1) {
            /* grab memory storage name */
            int next_quote = octstr_search_char(line, '"', ++pos);
            if (next_quote == -1) { /* no second qoute - this line must be broken somehow */
                O_DESTROY(line);
                continue;
	    }

            /* store notification storage location for reference */
            cmti_storage = octstr_copy(line, pos, next_quote - pos);
        } else
            /* reset pos for the next lookup which would start from the beginning if no memory
             * location was found */
            pos = 0; 

        /* if no message storage is set in configuration - set now */
        if (!privdata->modem->message_storage && cmti_storage) { 
            info(2, "AT2[%s]: CMTI received, but no message-storage is set in confiuration."
                "setting now to <%s>", octstr_get_cstr(privdata->name), octstr_get_cstr(cmti_storage));
            privdata->modem->message_storage = octstr_duplicate(cmti_storage);
            current_storage = octstr_duplicate(cmti_storage);
            at2_set_message_storage(privdata, cmti_storage);
	}

        /* find the message id from the line, which should appear after the first comma */
        if ((pos = octstr_search_char(line, ',', pos)) == -1) { /* this CMTI notification is probably broken */
            error(2, "AT2[%s]: failed to find memory location in CMTI notification",
                octstr_get_cstr(privdata->name));
		O_DESTROY(line);
		octstr_destroy(cmti_storage);
            continue;
        }

        if ((pos = octstr_parse_long(&location, line, ++pos, 10)) == -1) {
            /* there was an error parsing the message id. next! */
            error(2, "AT2[%s]: error parsing memory location in CMTI notification",
                octstr_get_cstr(privdata->name));
		O_DESTROY(line);
		octstr_destroy(cmti_storage);
            continue;
        }

        /* check if we need to change storage location before issuing the read command */
        if (!current_storage || (octstr_compare(current_storage, cmti_storage) != 0)) {
	    octstr_destroy(current_storage);
	    current_storage = octstr_duplicate(cmti_storage);
            at2_set_message_storage(privdata, cmti_storage);
	}
        
        if (!at2_read_delete_message(privdata, location)) {
            error(1,"AT2[%s]: CMTI notification received, but no message found in memory!",
                octstr_get_cstr(privdata->name));
        }

        
        octstr_destroy(line);
        octstr_destroy(cmti_storage);
    }
    /* set prefered message storage back to what configured */
    if (current_storage && privdata->modem->message_storage && (octstr_compare(privdata->modem->message_storage, current_storage) != 0))
	at2_set_message_storage(privdata, privdata->modem->message_storage);

    octstr_destroy(current_storage);
}

static int at2_read_sms_memory(PrivAT2data* privdata)
{
    /* get memory status */
    if (at2_check_sms_memory(privdata) == -1) {
        debug("bb.smsc.at2", 0, "AT2[%s]: memory check error", octstr_get_cstr(privdata->name));
        return -1;
    }

    if (privdata->sms_memory_usage) {
        /*
         * that is - greater then 0, meaning there are some messages to fetch
         * now - I used to just loop over the first input_mem_sms_used locations, 
         * but it doesn't hold, since under load, messages may be received while 
         * we're in the loop, and get stored in locations towards the end of the list, 
         * thus creating 'holes' in the memory. 
         * 
         * There are two ways we can fix this : 
         *   (a) Just read the last message location, delete it and return.
         *       It's not a complete solution since holes can still be created if messages 
         *       are received between the memory check and the delete command, 
         *       and anyway - it will slow us down and won't hold well under pressure
         *   (b) Just scan the entire memory each call, bottom to top. 
         *       This will be slow too, but it'll be reliable.
         *
         * We can massivly improve performance by stopping after input_mem_sms_used messages
         * have been read, but send_modem_command returns 0 for no message as well as for a 
         * message read, and the only other way to implement it is by doing memory_check 
         * after each read and stoping when input_mem_sms_used get to 0. This is slow 
         * (modem commands take time) so we improve speed only if there are less then 10 
         * messages in memory.
         *
         * I implemented the alternative - changed at2_wait_modem_command to return the 
         * number of messages it collected.
         */
        int i;
        int message_count = 0; /* cound number of messages collected */

        debug("bb.smsc.at2", 0, "AT2[%s]: %d messages waiting in memory", 
              octstr_get_cstr(privdata->name), privdata->sms_memory_usage);

        /*
         * loop till end of memory or collected enouch messages
         */
        for (i = 1; i <= privdata->sms_memory_capacity &&
            message_count < privdata->sms_memory_usage; ++i) { 

	    /* if (meanwhile) there are pending CMTI notifications, process these first
	     * to not let CMTI and sim buffering sit in each others way */
	    while (list_len(privdata->pending_incoming_messages) > 0) {
		    at2_read_pending_incoming_messages(privdata);
	    }
	    /* read the message and delete it */
            message_count += at2_read_delete_message(privdata, i);
        }
    }
    /*
    at2_send_modem_command(privdata, ModemTypes[privdata->modemid].init1, 0, 0);
    */
    return 0;
}


int at2_check_sms_memory(PrivAT2data *privdata)
{
    long values[4]; /* array to put response data in */
    int pos; /* position of parser in data stream */
    int ret;
    Octstr* search_cpms = NULL;

    /* select memory type and get report */
    if ((ret = at2_send_modem_command(privdata, "AT+CPMS?", 0, 0)) != 0) { 
        debug("bb.smsc.at2.memory_check", 0, "failed to send mem select command to modem %d", ret);
        return -1;
    }

    search_cpms = octstr_create("+CPMS:");

    if ((pos = octstr_search(privdata->lines, search_cpms, 0)) != -1) {
        /* got back a +CPMS response */
        int index = 0; /* index in values array */
        pos += 6; /* position of parser in the stream - start after header */

        /* skip memory indication */
        pos = octstr_search(privdata->lines, octstr_imm(","), pos) + 1; 

        /* find all the values */
        while (index < 4 && pos < octstr_len(privdata->lines) &&
               (pos = octstr_parse_long(&values[index], privdata->lines, pos, 10)) != -1) { 
            ++pos; /* skip number seperator */
            ++index; /* increment array index */
            if (index == 2)
                /* skip second memory indication */
                pos = octstr_search(privdata->lines, octstr_imm(","), pos) + 1; 
        }

        if (index < 4) { 
            /* didn't get all memory data - I don't why, so I'll bail */
            debug("bb.smsc.at2", 0, "AT2[%s]: couldn't parse all memory locations : %d:'%s'.",
                  octstr_get_cstr(privdata->name), index, 
                  &(octstr_get_cstr(privdata->lines)[pos]));
            O_DESTROY(search_cpms);
            return -1;
        }

        privdata->sms_memory_usage = values[0];
        privdata->sms_memory_capacity = values[1];
        /*
        privdata->output_mem_sms_used = values[2];
        privdata->output_mem_sms_capacity = values[3];
        */

        /* everything's cool */
        ret = 0; 

        /*  clear the buffer */
        O_DESTROY(privdata->lines);

    } else {
        debug("bb.smsc.at2", 0, "AT2[%s]: no correct header for CPMS response.", 
              octstr_get_cstr(privdata->name));

        /* didn't get a +CPMS response - this is clearly an error */
        ret = -1; 
    }

    O_DESTROY(search_cpms);
    return ret;
}


void at2_set_speed(PrivAT2data *privdata, int bps)
{
    struct termios tios;
    int ret;
    int	speed;

    tcgetattr(privdata->fd, &tios);

    switch (bps) {
    case 300:
        speed = B300;
        break;
    case 1200:
        speed = B1200;
        break;
    case 2400:
        speed = B2400;
        break;
    case 4800:
        speed = B4800;
        break;
    case 9600:
        speed = B9600;
        break;
    case 19200:
        speed = B19200;
        break;
    case 38400:
        speed = B38400;
        break;
#ifdef B57600
    case 57600:
        speed = B57600;
        break;
#endif
#ifdef B115200
    case 115200:
        speed = B115200;
        break;
#endif
    default:
        speed = B9600;
    }
    cfsetospeed(&tios, speed);
    cfsetispeed(&tios, speed);
    ret = tcsetattr(privdata->fd, TCSANOW, &tios); /* apply changes now */
    if (ret == -1) {
        error(errno, "AT2[%s]: at_data_link: fail to set termios attribute",
              octstr_get_cstr(privdata->name));
    }
    tcflush(privdata->fd, TCIOFLUSH);

    info(0, "AT2[%s]: speed set to %d", octstr_get_cstr(privdata->name), bps);
}


void at2_device_thread(void *arg)
{
    SMSCConn *conn = arg;
    PrivAT2data	*privdata = conn->data;
    int l, reconnecting = 0, error_count = 0;
    long idle_timeout, memory_poll_timeout = 0;

    conn->status = SMSCCONN_CONNECTING;

    /* Make sure we log into our own log-file if defined */
    log_thread_to(conn->log_idx);

reconnect:

    do {
        if (reconnecting) {
            if (conn->status == SMSCCONN_ACTIVE) {
                mutex_lock(conn->flow_mutex);
                conn->status = SMSCCONN_RECONNECTING;
                mutex_unlock(conn->flow_mutex);
            }
            error(0, "AT2[%s]: Couldn't connect (retrying in %ld seconds).",
                     octstr_get_cstr(privdata->name), conn->reconnect_delay);
            gwthread_sleep(conn->reconnect_delay);
        }

        /* If modems->speed is defined, try to use it, else autodetect */
        if (privdata->speed == 0 && privdata->modem != NULL && 
	    privdata->modem->speed != 0) {

	    info(0, "AT2[%s]: trying to use speed <%ld> from modem definition",
	         octstr_get_cstr(privdata->name), privdata->modem->speed);
	    if(0 == at2_test_speed(privdata, privdata->modem->speed)) { 
		privdata->speed = privdata->modem->speed;
		info(0, "AT2[%s]: speed is %ld", 
		     octstr_get_cstr(privdata->name), privdata->speed);
	    } else {
		info(0, "AT2[%s]: speed in modem definition don't work, will autodetect", 
		     octstr_get_cstr(privdata->name));
	    }
	}

        if (privdata->speed == 0 && at2_detect_speed(privdata) == -1) {
            continue;
        }

        if (privdata->modem == NULL && at2_detect_modem_type(privdata) == -1) {
            continue;
        }

        if (at2_open_device(privdata)) {
            error(errno, "AT2[%s]: at2_device_thread: open_at2_device failed. Terminating", 
                  octstr_get_cstr(privdata->name));
            continue;
        }

        if (privdata->max_error_count > 0 && error_count > privdata->max_error_count &&
             privdata->modem != NULL && privdata->modem->reset_string != NULL) {
            error_count = 0;
            if (at2_send_modem_command(privdata,
                 octstr_get_cstr(privdata->modem->reset_string), 0, 0) != 0) {
                error(0, "AT2[%s]: Reset of modem failed.", octstr_get_cstr(privdata->name));
                at2_close_device(privdata);
                continue;
            }
            else {
                info(0, "AT2[%s]: Modem reseted.", octstr_get_cstr(privdata->name));
            }
        }

        if (at2_init_device(privdata) != 0) {
            error(0, "AT2[%s]: Opening failed. Terminating", octstr_get_cstr(privdata->name));
            at2_close_device(privdata);
            error_count++;
            continue;
        }
        else
            error_count = 0;

        /* If we got here, then the device is opened */
        break;
    } while (!privdata->shutdown);

    mutex_lock(conn->flow_mutex);
    conn->status = SMSCCONN_ACTIVE;
    conn->connect_time = time(NULL);
    mutex_unlock(conn->flow_mutex);
    bb_smscconn_connected(conn);

    idle_timeout = 0;
    while (!privdata->shutdown) {
        l = gw_prioqueue_len(privdata->outgoing_queue);
        if (l > 0) {
            at2_send_messages(privdata);
            idle_timeout = time(NULL);
        } else
            at2_wait_modem_command(privdata, 1, 0, NULL);

	while (list_len(privdata->pending_incoming_messages) > 0) {
		at2_read_pending_incoming_messages(privdata);
	}

        if (privdata->keepalive &&
            idle_timeout + privdata->keepalive < time(NULL)) {
            if (at2_send_modem_command(privdata, 
                octstr_get_cstr(privdata->modem->keepalive_cmd), 5, 0) < 0) {
                at2_close_device(privdata);
                reconnecting = 1;
                goto reconnect;
            }
            idle_timeout = time(NULL);
        }

        if (privdata->sms_memory_poll_interval &&
            memory_poll_timeout + privdata->sms_memory_poll_interval < time(NULL)) {
            if (at2_read_sms_memory(privdata) == -1) {
                at2_close_device(privdata);
                reconnecting = 1;
                goto reconnect;
            }
            memory_poll_timeout = time(NULL);
        }
    }
    at2_close_device(privdata);
    mutex_lock(conn->flow_mutex);
    conn->status = SMSCCONN_DISCONNECTED;
    mutex_unlock(conn->flow_mutex);
    /* maybe some cleanup here? */
    at2_destroy_modem(privdata->modem);
    octstr_destroy(privdata->device);
    octstr_destroy(privdata->ilb);
    octstr_destroy(privdata->lines);
    octstr_destroy(privdata->pin);
    octstr_destroy(privdata->validityperiod);
    octstr_destroy(privdata->my_number);
    octstr_destroy(privdata->sms_center);
    octstr_destroy(privdata->name);
    octstr_destroy(privdata->configfile);
    gw_prioqueue_destroy(privdata->outgoing_queue, NULL);
    list_destroy(privdata->pending_incoming_messages, octstr_destroy_item);
    gw_free(conn->data);
    conn->data = NULL;
    mutex_lock(conn->flow_mutex);
    conn->why_killed = SMSCCONN_KILLED_SHUTDOWN;
    conn->status = SMSCCONN_DEAD;
    mutex_unlock(conn->flow_mutex);
    bb_smscconn_killed();
}


int at2_shutdown_cb(SMSCConn *conn, int finish_sending)
{
    PrivAT2data *privdata = conn->data;

    debug("bb.sms", 0, "AT2[%s]: Shutting down SMSCConn, %s",
          octstr_get_cstr(privdata->name),
          finish_sending ? "slow" : "instant");

    /* 
     * Documentation claims this would have been done by smscconn.c,
     * but isn't when this code is being written. 
     */
    conn->why_killed = SMSCCONN_KILLED_SHUTDOWN;
    privdata->shutdown = 1; 
    /* 
     * Separate from why_killed to avoid locking, as
     * why_killed may be changed from outside? 
     */
    if (finish_sending == 0) {
        Msg *msg;
        while ((msg = gw_prioqueue_remove(privdata->outgoing_queue)) != NULL) {
            bb_smscconn_send_failed(conn, msg, SMSCCONN_FAILED_SHUTDOWN, NULL);
        }
    }
    gwthread_wakeup(privdata->device_thread);
    return 0;

}


long at2_queued_cb(SMSCConn *conn)
{
    long ret;
    PrivAT2data *privdata = conn->data;

    if (conn->status == SMSCCONN_DEAD) /* I'm dead, why would you care ? */
	return -1;

    ret = gw_prioqueue_len(privdata->outgoing_queue);

    /* use internal queue as load, maybe something else later */

    conn->load = ret;
    return ret;
}


void at2_start_cb(SMSCConn *conn)
{
    PrivAT2data *privdata = conn->data;

    if (conn->status == SMSCCONN_DISCONNECTED)
        conn->status = SMSCCONN_ACTIVE;
    
    /* in case there are messages in the buffer already */
    gwthread_wakeup(privdata->device_thread);
    debug("smsc.at2", 0, "AT2[%s]: start called", octstr_get_cstr(privdata->name));
}

int at2_add_msg_cb(SMSCConn *conn, Msg *sms)
{
    PrivAT2data *privdata = conn->data;
    Msg *copy;

    copy = msg_duplicate(sms);
    gw_prioqueue_produce(privdata->outgoing_queue, copy);
    gwthread_wakeup(privdata->device_thread);
    return 0;
}


int smsc_at2_create(SMSCConn *conn, CfgGroup *cfg)
{
    PrivAT2data	*privdata;
    Octstr *modem_type_string;

    privdata = gw_malloc(sizeof(PrivAT2data));
    privdata->outgoing_queue = gw_prioqueue_create(sms_priority_compare);
    privdata->pending_incoming_messages = list_create();

    privdata->configfile = cfg_get_configfile(cfg);

    privdata->device = cfg_get(cfg, octstr_imm("device"));
    if (privdata->device == NULL) {
        error(0, "AT2[-]: 'device' missing in at2 configuration.");
        goto error;
    }

    privdata->name = cfg_get(cfg, octstr_imm("smsc-id"));
    if (privdata->name == NULL) {
        privdata->name = octstr_duplicate(privdata->device);
    }

    privdata->speed = 0;
    cfg_get_integer(&privdata->speed, cfg, octstr_imm("speed"));

    privdata->keepalive = 0;
    cfg_get_integer(&privdata->keepalive, cfg, octstr_imm("keepalive"));

    cfg_get_bool(&privdata->sms_memory_poll_interval, cfg, octstr_imm("sim-buffering"));
    if (privdata->sms_memory_poll_interval) {
        if (privdata->keepalive)
            privdata->sms_memory_poll_interval = privdata->keepalive;
        else
            privdata->sms_memory_poll_interval = AT2_DEFAULT_SMS_POLL_INTERVAL;
    }

    privdata->my_number = cfg_get(cfg, octstr_imm("my-number"));
    privdata->sms_center = cfg_get(cfg, octstr_imm("sms-center"));
    modem_type_string = cfg_get(cfg, octstr_imm("modemtype"));

    privdata->modem = NULL;

    if (modem_type_string != NULL) {
        if (octstr_compare(modem_type_string, octstr_imm("auto")) == 0 ||
            octstr_compare(modem_type_string, octstr_imm("autodetect")) == 0)
            O_DESTROY(modem_type_string);
    }

    if (octstr_len(modem_type_string) == 0) {
        info(0, "AT2[%s]: configuration doesn't show modemtype. will autodetect",
             octstr_get_cstr(privdata->name));
    } else {
        info(0, "AT2[%s]: configuration shows modemtype <%s>",
             octstr_get_cstr(privdata->name),
             octstr_get_cstr(modem_type_string));
        privdata->modem = at2_read_modems(privdata, privdata->configfile,
                                          modem_type_string, 0);
        if (privdata->modem == NULL) {
            info(0, "AT2[%s]: modemtype not found, revert to autodetect",
                 octstr_get_cstr(privdata->name));
        } else {
            info(0, "AT2[%s]: read modem definition for <%s>",
                 octstr_get_cstr(privdata->name),
                 octstr_get_cstr(privdata->modem->name));
        }
        O_DESTROY(modem_type_string);
    }

    privdata->ilb = octstr_create("");
    privdata->fd = -1;
    privdata->lines = NULL;
    privdata->pin = cfg_get(cfg, octstr_imm("pin"));
    privdata->pin_ready = 0;
    privdata->conn = conn;
    privdata->phase2plus = 0;
    privdata->validityperiod = cfg_get(cfg, octstr_imm("validityperiod"));
    if (cfg_get_integer((long*)&privdata->max_error_count, cfg, octstr_imm("max-error-count")) == -1)
        privdata->max_error_count = -1;

    conn->data = privdata;
    conn->name = octstr_format("AT2[%s]", octstr_get_cstr(privdata->name));
    conn->status = SMSCCONN_CONNECTING;

    privdata->shutdown = 0;

    conn->status = SMSCCONN_CONNECTING;
    conn->connect_time = time(NULL);

    if ((privdata->device_thread = gwthread_create(at2_device_thread, conn)) == -1) {
        privdata->shutdown = 1;
        goto error;
    }

    conn->shutdown = at2_shutdown_cb;
    conn->queued = at2_queued_cb;
    conn->start_conn = at2_start_cb;
    conn->send_msg = at2_add_msg_cb;
    return 0;

error:
    error(0, "AT2[%s]: Failed to create at2 smsc connection",
          octstr_len(privdata->name) ? octstr_get_cstr(privdata->name) : "");
    if (privdata != NULL) {
        gw_prioqueue_destroy(privdata->outgoing_queue, NULL);
    }
    gw_free(privdata);
    conn->why_killed = SMSCCONN_KILLED_CANNOT_CONNECT;
    conn->status = SMSCCONN_DEAD;
    info(0, "AT2[%s]: exiting", octstr_get_cstr(privdata->name));
    return -1;
}


int at2_pdu_extract(PrivAT2data *privdata, Octstr **pdu, Octstr *line)
{
    Octstr *buffer;
    long len = 0;
    int pos = 0;
    int tmp;

    buffer = octstr_duplicate(line);
    /* find the beginning of a message from the modem*/

    if ((pos = octstr_search(buffer, octstr_imm("+CDS:"), 0)) != -1) 
	pos += 5;
    else {
	if ((pos = octstr_search(buffer, octstr_imm("+CMT:"), 0)) != -1)
	    pos += 5;
	else if ((pos = octstr_search(buffer, octstr_imm("+CMGR:"), 0)) != -1) {
	    /* skip status field in +CMGR response */
	    if ((pos = octstr_search(buffer, octstr_imm(","), pos + 6)) != -1) 
		pos++;
	    else
		goto nomsg;
	} else
	    goto nomsg;

	/* skip the next comma in CMGR and CMT responses */
	tmp = octstr_search(buffer, octstr_imm(","), pos);
	if (! privdata->modem->broken && tmp == -1)
	    goto nomsg;
	if (tmp != -1)
	    pos = tmp + 1;
    }

    /* read the message length */
    pos = octstr_parse_long(&len, buffer, pos, 10);
    if (pos == -1)
        goto nomsg;

    /* skip the spaces and line return */
    while (isspace(octstr_get_char(buffer, pos)))
        pos++;

    /* skip the SMSC address on some modem types */
    if (!privdata->modem->no_smsc) {
        tmp = at2_hexchar(octstr_get_char(buffer, pos)) * 16
              + at2_hexchar(octstr_get_char(buffer, pos + 1));
        if (tmp < 0)
            goto nomsg;
        pos += 2 + tmp * 2;
    }

    /* check if the buffer is long enough to contain the full message */
    if (!privdata->modem->broken && octstr_len(buffer) < len * 2 + pos)
        goto nomsg;

    if (privdata->modem->broken && octstr_len(buffer) < len * 2)
        goto nomsg;

    /* copy the PDU then remove it from the input buffer*/
    *pdu = octstr_copy(buffer, pos, len * 2);

    octstr_destroy(buffer);
    return 1;

nomsg:
    octstr_destroy(buffer);
    return 0;
}


int at2_hexchar(int hexc)
{
    hexc = toupper(hexc) - 48;
    return (hexc > 9) ? hexc - 7 : hexc;
}


Msg *at2_pdu_decode(Octstr *data, PrivAT2data *privdata)
{
    int type;
    Msg *msg = NULL;

    /* Get the PDU type */
    type = octstr_get_char(data, 1) & 3;

    switch (type) {

        case AT_DELIVER_SM:
            msg = at2_pdu_decode_deliver_sm(data, privdata);
            break;
        case AT_STATUS_REPORT_SM:
	    msg = at2_pdu_decode_report_sm(data, privdata);
	    break;

            /* Add other message types here: */

    }

    return msg;
}


Msg *at2_pdu_decode_deliver_sm(Octstr *data, PrivAT2data *privdata)
{
    int len, pos, i, ntype;
    int udhi, dcs, udhlen, pid;
    Octstr *origin = NULL;
    Octstr *udh = NULL;
    Octstr *text = NULL, *tmpstr;
    Octstr *pdu = NULL;
    Msg *message = NULL;
    struct universaltime mtime; /* time structure */
    long stime; /* time in seconds */
    int timezone; /* timezone in 15 minutes jumps from GMT */

    /* 
     * Note: some parts of the PDU are not decoded because they are
     * not needed for the Msg type. 
     */

    /* convert the pdu to binary format for ease of processing */
    pdu = at2_convertpdu(data);

    /* UDH Indicator */
    udhi = (octstr_get_char(pdu, 0) & 64) >> 6;

    /* originating address */
    len = octstr_get_char(pdu, 1);
    if (len > 20) /* maximum valid number of semi-octets in Address-Value field */
        goto msg_error;
    ntype = octstr_get_char(pdu, 2);

    pos = 3;
    if ((ntype & 0xD0) == 0xD0) {
        /* Alphanumeric sender */
        origin = octstr_create("");
        tmpstr = octstr_copy(pdu, 3, len);
        at2_decode7bituncompressed(tmpstr, (((len - 1) * 4 - 3) / 7) + 1, origin, 0);
        octstr_destroy(tmpstr);
        debug("bb.smsc.at2", 0, "AT2[%s]: Alphanumeric sender <%s>", 
              octstr_get_cstr(privdata->name), octstr_get_cstr(origin));
        pos += (len + 1) / 2;
    } else {
        origin = octstr_create("");
        if ((ntype & 0x90) == 0x90) {
            /* International number */
            octstr_append_char(origin, '+');
        }
        for (i = 0; i < len; i += 2, pos++) {
            octstr_append_char(origin, (octstr_get_char(pdu, pos) & 15) + 48);
            if (i + 1 < len)
                octstr_append_char(origin, (octstr_get_char(pdu, pos) >> 4) + 48);
        }
        debug("bb.smsc.at2", 0, "AT2[%s]: Numeric sender %s <%s>", 
              octstr_get_cstr(privdata->name), ((ntype & 0x90) == 0x90 ? "(international)" : ""), 
              octstr_get_cstr(origin));
    }

    if (pos > octstr_len(pdu))
        goto msg_error;

    /* PID */
    pid = octstr_get_char(pdu, pos);
    pos++;

    /* DCS */
    dcs = octstr_get_char(pdu, pos);
    pos++;

    /* get the timestamp */
    mtime.year = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;
    mtime.year += (mtime.year < 70 ? 2000 : 1900);
    mtime.month = swap_nibbles(octstr_get_char(pdu, pos));
    mtime.month--;    
    pos++;
    mtime.day = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;
    mtime.hour = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;
    mtime.minute = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;
    mtime.second = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;

    /* 
     * time zone: 
     *
     * time zone is "swapped nibble", with the MSB as the sign (1 is negative).  
     */
    timezone = swap_nibbles(octstr_get_char(pdu, pos));
    pos++;
    timezone = ((timezone >> 7) ? -1 : 1) * (timezone & 127);
    /* 
     * Ok, that was the time zone as read from the PDU. Now how to interpert it? 
     * All the handsets I tested send the timestamp of their local time and the 
     * timezone as GMT+0. I assume that the timestamp is the handset's local time, 
     * so we need to apply the timezone in reverse to get GM time: 
     */

    /* 
     * time in PDU is handset's local time and timezone is handset's time zone 
     * difference from GMT 
     */
    mtime.hour -= timezone / 4;
    mtime.minute -= 15 * (timezone % 4);

    stime = date_convert_universal(&mtime);

    /* get data length
     * XXX: Is it allowed to have length = 0 ??? (alex)
     */
    len = octstr_get_char(pdu, pos);
    pos++;

    debug("bb.smsc.at2", 0, "AT2[%s]: User data length read as (%d)", octstr_get_cstr(privdata->name), len);

    /* if there is a UDH */
    udhlen = 0;
    if (udhi && len > 0) {
        udhlen = octstr_get_char(pdu, pos);
        pos++;
        if (udhlen + 1 > len)
            goto msg_error;
        udh = octstr_copy(pdu, pos, udhlen);
        pos += udhlen;
        len -= udhlen + 1;
    } else if (len <= 0) /* len < 0 is impossible, but sure is sure */
        udhi = 0;

    debug("bb.smsc.at2", 0, "AT2[%s]: Udh decoding done len=%d udhi=%d udhlen=%d udh='%s'",
          octstr_get_cstr(privdata->name), len, udhi, udhlen, (udh?octstr_get_cstr(udh):""));

    if (pos > octstr_len(pdu) || len < 0)
        goto msg_error;

    /* build the message */
    message = msg_create(sms);
    if (!dcs_to_fields(&message, dcs)) {
        /* XXX Should reject this message? */
        debug("bb.smsc.at2", 0, "AT2[%s]: Invalid DCS",
              octstr_get_cstr(privdata->name));
        dcs_to_fields(&message, 0);
    }

    message->sms.pid = pid;

    /* deal with the user data -- 7 or 8 bit encoded */
    tmpstr = octstr_copy(pdu, pos, len);
    if (message->sms.coding == DC_8BIT || message->sms.coding == DC_UCS2) {
        text = octstr_duplicate(tmpstr);
    } else {
        int offset = 0;
        text = octstr_create("");
        if (udhi && message->sms.coding == DC_7BIT) {
            int nbits;
            nbits = (udhlen + 1) * 8;
            /* fill bits for UDH to septet boundary */
            offset = (((nbits / 7) + 1) * 7 - nbits) % 7;     
        }
        at2_decode7bituncompressed(tmpstr, len, text, offset);
    }

    message->sms.sender = origin;
    if (octstr_len(privdata->my_number)) {
        message->sms.receiver = octstr_duplicate(privdata->my_number);
    } else {
        /* Put a dummy address in the receiver for now (SMSC requires one) */
        message->sms.receiver = octstr_create_from_data("1234", 4);
    }
    if (udhi) {
        message->sms.udhdata = udh;
    }
    message->sms.msgdata = text;
    message->sms.time = stime;

    /* cleanup */
    octstr_destroy(pdu);
    octstr_destroy(tmpstr);

    return message;
    
msg_error:
    error(1,"AT2[%s]: Invalid DELIVER-SMS pdu !",
	octstr_get_cstr(privdata->name));
    O_DESTROY(udh);
    O_DESTROY(origin);
    O_DESTROY(text);
    O_DESTROY(pdu);
    return NULL;
}

Msg *at2_pdu_decode_report_sm(Octstr *data, PrivAT2data *privdata)
{
   Msg* dlrmsg = NULL;
   Octstr *pdu, *msg_id, *tmpstr = NULL, *receiver = NULL;
   int type, tp_mr, len, ntype, pos;

    /*
     * parse the PDU.
     */

    /* convert the pdu to binary format for ease of processing */
    pdu = at2_convertpdu(data);

    /* Message reference */
    tp_mr = octstr_get_char(pdu,1);
    msg_id = octstr_format("%d",tp_mr);
    debug("bb.smsc.at2",0,"AT2[%s]: got STATUS-REPORT for message <%d>:", octstr_get_cstr(privdata->name), tp_mr);
    
    /* reciver address */
    len = octstr_get_char(pdu, 2);
    ntype = octstr_get_char(pdu, 3);

    pos = 4;
    if ((ntype & 0xD0) == 0xD0) {
        /* Alphanumeric sender */
        receiver = octstr_create("");
        tmpstr = octstr_copy(pdu, pos, (len+1)/2);
        at2_decode7bituncompressed(tmpstr, (((len - 1) * 4 - 3) / 7) + 1, receiver, 0);
        octstr_destroy(tmpstr);
        debug("bb.smsc.at2", 0, "AT2[%s]: Alphanumeric receiver <%s>",
              octstr_get_cstr(privdata->name), octstr_get_cstr(receiver));
        pos += (len + 1) / 2;
    } else {
	int i;
        receiver = octstr_create("");
        if ((ntype & 0x90) == 0x90) {
            /* International number */
            octstr_append_char(receiver, '+');
        }
        for (i = 0; i < len; i += 2, pos++) {
            octstr_append_char(receiver, (octstr_get_char(pdu, pos) & 15) + 48);
            if (i + 1 < len)
                octstr_append_char(receiver, (octstr_get_char(pdu, pos) >> 4) + 48);
        }
        debug("bb.smsc.at2", 0, "AT2[%s]: Numeric receiver %s <%s>",
              octstr_get_cstr(privdata->name), ((ntype & 0x90) == 0x90 ? "(international)" : ""),
              octstr_get_cstr(receiver));
    }

    pos += 14; /* skip time stamps for now */

    if ((type = octstr_get_char(pdu, pos)) == -1 ) {
	error(1,"AT2[%s]: STATUS-REPORT pdu too short to have TP-Status field !",
	    octstr_get_cstr(privdata->name));
	goto error;
    }

	/* check DLR type:
	 * 3GPP TS 23.040 defines this a bit mapped field with lots of options
	 * most of which are not really intersting to us, as we are only interested
	 * in one of three conditions : failed, held in SC for delivery later, or delivered successfuly
	 * and here's how I suggest to test it (read the 3GPP reference for further detailes) -
	 * we'll test the 6th and 5th bits (7th bit when set making all other values 'reseved' so I want to test it).
	 */
    type = type & 0xE0; /* filter out everything but the 7th, 6th and 5th bits */
    switch (type) {
        case 0x00:
            /* 0 0 : success class */
            type = DLR_SUCCESS;
            tmpstr = octstr_create("Success");
            break;
        case 0x20:
            /* 0 1 : buffered class (temporary error) */
            type = DLR_BUFFERED;
            tmpstr = octstr_create("Buffered");
            break;
        case 0x40:
        case 0x60:
        default:
            /* 1 0 : failed class */
            /* 1 1 : failed class (actually, temporary error but timed out) */
            /* and any other value (can't think of any) is considered failure */
            type = DLR_FAIL;
            tmpstr = octstr_create("Failed");
            break;
    }
    /* Actually, the above implementation is not correct, as the reference says that implementations should consider
     * any "reserved" values to be "failure", but most reserved values fall into one of the three categories. it will catch
     * "reserved" values where the first 3 MSBits are not set as "Success" which may not be correct. */

    if ((dlrmsg = dlr_find(privdata->conn->id, msg_id, receiver, type)) == NULL) {
	debug("bb.smsc.at2",1,"AT2[%s]: Received delivery notification but can't find that ID in the DLR storage",
	    octstr_get_cstr(privdata->name));
	    goto error;
    }

    /* Beware DLR URL is now in msg->sms.dlr_url given by dlr_find() */
    dlrmsg->sms.msgdata = octstr_duplicate(tmpstr);
	
error:
    O_DESTROY(tmpstr);
    O_DESTROY(pdu);
    O_DESTROY(receiver);
    O_DESTROY(msg_id);
    return dlrmsg;
}

Octstr *at2_convertpdu(Octstr *pdutext)
{
    Octstr *pdu;
    int i;
    int len = octstr_len(pdutext);

    pdu = octstr_create("");
    for (i = 0; i < len; i += 2) {
        octstr_append_char(pdu, at2_hexchar(octstr_get_char(pdutext, i)) * 16
                           + at2_hexchar(octstr_get_char(pdutext, i + 1)));
    }
    return pdu;
}


static int at2_rmask[8] = { 0, 1, 3, 7, 15, 31, 63, 127 };
static int at2_lmask[8] = { 0, 128, 192, 224, 240, 248, 252, 254 };

void at2_decode7bituncompressed(Octstr *input, int len, Octstr *decoded, int offset)
{
    unsigned char septet, octet, prevoctet;
    int i;
    int r = 1;
    int c = 7;
    int pos = 0;

    /* Shift the buffer offset bits to the left */
    if (offset > 0) {
        unsigned char *ip;
        for (i = 0, ip = octstr_get_cstr(input); i < octstr_len(input); i++) {
            if (i == octstr_len(input) - 1)
                *ip = *ip >> offset;
            else
                *ip = (*ip >> offset) | (*(ip + 1) << (8 - offset));
            ip++;
        }
    }
    octet = octstr_get_char(input, pos);
    prevoctet = 0;
    for (i = 0; i < len; i++) {
        septet = ((octet & at2_rmask[c]) << (r - 1)) + prevoctet;
        octstr_append_char(decoded, septet);

        prevoctet = (octet & at2_lmask[r]) >> c;

        /* When r=7 we have a full character in prevoctet */
        if ((r == 7) && (i < len - 1)) {
            i++;
            octstr_append_char(decoded, prevoctet);
            prevoctet = 0;
        }

        r = (r > 6) ? 1 : r + 1;
        c = (c < 2) ? 7 : c - 1;

        pos++;
        octet = octstr_get_char(input, pos);
    }
    charset_gsm_to_latin1(decoded);
}


void at2_send_messages(PrivAT2data *privdata)
{
    Msg *msg;

    do {
        if (privdata->modem->enable_mms && 
			gw_prioqueue_len(privdata->outgoing_queue) > 1)
            at2_send_modem_command(privdata, "AT+CMMS=2", 0, 0);

        if ((msg = gw_prioqueue_remove(privdata->outgoing_queue)))
            at2_send_one_message(privdata, msg);
    } while (msg);
}


void at2_send_one_message(PrivAT2data *privdata, Msg *msg)
{
    unsigned char command[500];
    int ret = -1;
    char sc[3];
    int retries = RETRY_SEND;

    if (octstr_len(privdata->my_number)) {
        octstr_destroy(msg->sms.sender);
        msg->sms.sender = octstr_duplicate(privdata->my_number);
    }

    /* 
     * The standard says you should be prepending the PDU with 00 to indicate 
     * to use the default SC. Some older modems dont expect this so it can be 
     * disabled 
     * NB: This extra padding is not counted in the CMGS byte count 
     */
    sc[0] = '\0';

    if (!privdata->modem->no_smsc)
        strcpy(sc, "00");

    if (msg_type(msg) == sms) {
	Octstr* pdu;

	if ((pdu = at2_pdu_encode(msg, privdata)) == NULL) {
	    error(2, "AT2[%s]: Error encoding PDU!",octstr_get_cstr(privdata->name));
	    return;
	}	

        ret = -99;
        retries = RETRY_SEND;
        while ((ret != 0) && (retries-- > 0)) {
	    int msg_id = -1;
            /* 
             * send the initial command and then wait for > 
             */
            sprintf(command, "AT+CMGS=%ld", octstr_len(pdu) / 2);
            
            ret = at2_send_modem_command(privdata, command, 5, 1);
            debug("bb.smsc.at2", 0, "AT2[%s]: send command status: %d",
                  octstr_get_cstr(privdata->name), ret);

            if (ret != 1) /* > only! */
                continue;
            /* 
             * ok the > has been see now so we can send the PDU now and a 
             * control Z but no CR or LF 
             */
            sprintf(command, "%s%s", sc, octstr_get_cstr(pdu));
            at2_write(privdata, command);
            at2_write_ctrlz(privdata);

            /* wait 20 secs for modem command */
            ret = at2_wait_modem_command(privdata, 20, 0, &msg_id);
            debug("bb.smsc.at2", 0, "AT2[%s]: send command status: %d",
                  octstr_get_cstr(privdata->name), ret);

            if (ret != 0) /* OK only */
                continue;

	    /* store DLR message if needed for SMSC generated delivery reports */
	    if (DLR_IS_ENABLED_DEVICE(msg->sms.dlr_mask)) {
		if (msg_id == -1)
		    error(0,"AT2[%s]: delivery notification requested, but I have no message ID!",
			octstr_get_cstr(privdata->name));
		else {
                    Octstr *dlrmsgid = octstr_format("%d", msg_id);

                    dlr_add(privdata->conn->id, dlrmsgid, msg);

		    O_DESTROY(dlrmsgid);
		}
	    }

            bb_smscconn_sent(privdata->conn, msg, NULL);
        }

        if (ret != 0) {
            /*
             * no need to do counter_increase(privdata->conn->failed) here,
             * since bb_smscconn_send_failed() will inc the counter on
             * SMSCCONN_FAILED_MALFORMED
             */
            bb_smscconn_send_failed(privdata->conn, msg,
	        SMSCCONN_FAILED_MALFORMED, octstr_create("MALFORMED"));
        }

        O_DESTROY(pdu);
    }
}


Octstr* at2_pdu_encode(Msg *msg, PrivAT2data *privdata)
{
    /*
     * Message coding is done as a binary octet string,
     * as per 3GPP TS 23.040 specification (GSM 03.40),
     */
    Octstr *pdu = NULL, *temp = NULL, *buffer = octstr_create("");
     
    int len, setvalidity = 0;

    /* 
     * message type SUBMIT , bit mapped :
     * bit7                            ..                                    bit0
     * TP-RP , TP-UDHI, TP-SRR, TP-VPF(4), TP-VPF(3), TP-RD, TP-MTI(1), TP-MTI(0)
     */
    octstr_append_char(buffer,
	((msg->sms.rpi > 0 ? 1 : 0) << 7) /* TP-RP */
	| ((octstr_len(msg->sms.udhdata)  ? 1 : 0) << 6) /* TP-UDHI */
	| ((DLR_IS_ENABLED_DEVICE(msg->sms.dlr_mask) ? 1 : 0) << 5) /* TP-SRR */
	| 16 /* TP-VP(Rel)*/
	| 1 /* TP-MTI: SUBMIT_SM */
	);

    /* message reference (0 for now) */
    octstr_append_char(buffer, 0);

    /* destination address */
    if ((temp = at2_format_address_field(msg->sms.receiver)) == NULL)
	goto error;
    octstr_append(buffer, temp);
    O_DESTROY(temp);

    octstr_append_char(buffer, (msg->sms.pid == -1 ? 0 : msg->sms.pid) ); /* protocol identifier */
    octstr_append_char(buffer, fields_to_dcs(msg, /* data coding scheme */
	(msg->sms.alt_dcs != -1 ? msg->sms.alt_dcs : privdata->conn->alt_dcs)));

    /* 
     * Validity-Period (TP-VP)
     * see GSM 03.40 section 9.2.3.12
     * defaults to 24 hours = 167 if not set 
     */
    if ( msg->sms.validity >= 0) {
        if (msg->sms.validity > 635040)
            setvalidity = 255;
        if (msg->sms.validity >= 50400 && msg->sms.validity <= 635040)
            setvalidity = (msg->sms.validity - 1) / 7 / 24 / 60 + 192 + 1;
        if (msg->sms.validity > 43200 && msg->sms.validity < 50400)
            setvalidity = 197;
        if (msg->sms.validity >= 2880 && msg->sms.validity <= 43200)
            setvalidity = (msg->sms.validity - 1) / 24 / 60 + 166 + 1;
        if (msg->sms.validity > 1440 && msg->sms.validity < 2880)
            setvalidity = 168;
        if (msg->sms.validity >= 750 && msg->sms.validity <= 1440)
            setvalidity = (msg->sms.validity - 720 - 1) / 30 + 143 + 1;
        if (msg->sms.validity > 720 && msg->sms.validity < 750)
            setvalidity = 144;
        if (msg->sms.validity >= 5 && msg->sms.validity <= 720)
            setvalidity = (msg->sms.validity - 1) / 5 - 1 + 1;
        if (msg->sms.validity < 5)
            setvalidity = 0;
    } else
        setvalidity = (privdata->validityperiod != NULL ? 
            atoi(octstr_get_cstr(privdata->validityperiod)) : 167);

    if (setvalidity >= 0 && setvalidity <= 143)
        debug("bb.smsc.at2", 0, "AT2[%s]: TP-Validity-Period: %d minutes",
              octstr_get_cstr(privdata->name), (setvalidity + 1)*5);
    else if (setvalidity >= 144 && setvalidity <= 167)
        debug("bb.smsc.at2", 0, "AT2[%s]: TP-Validity-Period: %3.1f hours",
              octstr_get_cstr(privdata->name), ((float)(setvalidity - 143) / 2) + 12);
    else if (setvalidity >= 168 && setvalidity <= 196)
        debug("bb.smsc.at2", 0, "AT2[%s]: TP-Validity-Period: %d days",
              octstr_get_cstr(privdata->name), (setvalidity - 166));
    else
        debug("bb.smsc.at2", 0, "AT2[%s]: TP-Validity-Period: %d weeks",
              octstr_get_cstr(privdata->name), (setvalidity - 192));
    octstr_append_char(buffer, setvalidity);

    /* user data length - include length of UDH if it exists */
    len = sms_msgdata_len(msg);

    if (octstr_len(msg->sms.udhdata)) {
        if (msg->sms.coding == DC_8BIT || msg->sms.coding == DC_UCS2) {
            len += octstr_len(msg->sms.udhdata);
            if (len > SMS_8BIT_MAX_LEN) { /* truncate user data to allow UDH to fit */
                octstr_delete(msg->sms.msgdata, SMS_8BIT_MAX_LEN - octstr_len(msg->sms.udhdata), 9999);
                len = SMS_8BIT_MAX_LEN;
            }
        } else {
            /*
             * The reason we branch here is because UDH data length is determined
             * in septets if we are in GSM coding, otherwise it's in octets. Adding 6
             * will ensure that for an octet length of 0, we get septet length 0,
             * and for octet length 1 we get septet length 2. 
             */
            int temp_len;
            len += (temp_len = (((8 * octstr_len(msg->sms.udhdata)) + 6) / 7));
            if (len > SMS_7BIT_MAX_LEN) { /* truncate user data to allow UDH to fit */
                octstr_delete(msg->sms.msgdata, SMS_7BIT_MAX_LEN - temp_len, 9999);
                len = SMS_7BIT_MAX_LEN;
            }
        }
    }

    octstr_append_char(buffer,len);

    if (octstr_len(msg->sms.udhdata)) /* udh */
	octstr_append(buffer, msg->sms.udhdata);

    /* user data */
    if (msg->sms.coding == DC_8BIT || msg->sms.coding == DC_UCS2) {
        octstr_append(buffer, msg->sms.msgdata);
    } else {
        int offset = 0;

        /*
         * calculate the number of fill bits needed to align
         * the 7bit encoded user data on septet boundry
         */
        if (octstr_len(msg->sms.udhdata)) { /* Have UDH */
            int nbits = octstr_len(msg->sms.udhdata) * 8; /* Includes UDH length byte */
            offset = (((nbits / 7) + 1) * 7 - nbits) % 7; /* Fill bits */
        }

        charset_latin1_to_gsm(msg->sms.msgdata);
        
        if ((temp = at2_encode7bituncompressed(msg->sms.msgdata, offset)) != NULL)
	    octstr_append(buffer, temp);
        O_DESTROY(temp);
    }

    /* convert PDU to HEX representation suitable for the AT2 command set */
    pdu = at2_encode8bituncompressed(buffer);
    O_DESTROY(buffer);

    return pdu;
error:
    O_DESTROY(temp);
    O_DESTROY(buffer);
    O_DESTROY(pdu);
    return NULL;
}


Octstr* at2_encode7bituncompressed(Octstr *source, int offset)
{
    int LSBmask[8] = { 0x00, 0x01, 0x03, 0x07, 0x0F, 0x1F, 0x3F, 0x7F };
    int MSBmask[8] = { 0x00, 0x40, 0x60, 0x70, 0x78, 0x7C, 0x7E, 0x7F };
    int destRemain = (int)ceil ((octstr_len(source) * 7.0) / 8.0);
    int i = (offset?8-offset:7), iStore = offset;
    int posT, posS;
    Octstr *target = octstr_create("");
    int target_chr = 0, source_chr;

    /* start packing the septet stream into an octet stream */
    for (posS = 0, posT = 0; (source_chr = octstr_get_char(source, posS++)) != -1;) {
	/* grab least significant bits from current septet and store them packed to the right */
	target_chr |= (source_chr & LSBmask[i]) << iStore;
	/* store current byte if last command filled it */
	if (iStore != 0) {
	    destRemain--;
	    octstr_append_char(target, target_chr);
	    target_chr = 0;
	}
	/* grab most significant bits from current septet and store them packed to the left */
	target_chr |= (source_chr & MSBmask[7 - i]) >> (8 - iStore) % 8;
	/* advance target bit index by 7 ( modulo 8 addition ) */
	iStore = (--iStore < 0 ? 7 : iStore);
	if (iStore != 0) /* if just finished packing 8 septets (into 7 octets) don't advance mask index */
	    i = (++i > 7 ? 1 : i); 
    }

    /* don't forget to pack the leftovers ;-) */
    if (destRemain > 0)
	octstr_append_char(target, target_chr);

    return target;
}


Octstr* at2_encode8bituncompressed(Octstr *input)
{
    int len, i;
    Octstr* out = octstr_create("");

    len = octstr_len(input);

    for (i = 0; i < len; i++) {
        /* each character is encoded in its hex representation (2 chars) */
        octstr_append_char(out, at2_numtext( (octstr_get_char(input, i) & 0xF0) >> 4));
        octstr_append_char(out, at2_numtext( (octstr_get_char(input, i) & 0x0F)));
    }
    return out;
}


int at2_numtext(int num)
{
    return (num > 9) ? (num + 55) : (num + 48);
}


int at2_detect_speed(PrivAT2data *privdata)
{
    int i;
    int autospeeds[] = { 
#ifdef B115200
	115200,
#endif
#ifdef	B57600
	57600, 
#endif
	38400, 19200, 9600 };

    debug("bb.smsc.at2", 0, "AT2[%s]: detecting modem speed. ", 
          octstr_get_cstr(privdata->name));

    for (i = 0; i < (sizeof(autospeeds) / sizeof(int)); i++) {
	if(at2_test_speed(privdata, autospeeds[i]) == 0) {
	    privdata->speed = autospeeds[i];
	    break;
	}
    }
    if (privdata->speed == 0) {
        info(0, "AT2[%s]: cannot detect speed", octstr_get_cstr(privdata->name));
        return -1;
    }
    info(0, "AT2[%s]: detect speed is %ld", octstr_get_cstr(privdata->name), privdata->speed);
    return 0;
}

int at2_test_speed(PrivAT2data *privdata, long speed) {

    int res;

    if (at2_open_device(privdata) == -1)
	return -1;

    at2_set_speed(privdata, speed);
    /* send a return so the modem can detect the speed */
    res = at2_send_modem_command(privdata, "", 1, 0); 
    res = at2_send_modem_command(privdata, "AT", 0, 0);

    if (res != 0)
	res = at2_send_modem_command(privdata, "AT", 0, 0);
    if (res != 0)
	res = at2_send_modem_command(privdata, "AT", 0, 0);
    at2_close_device(privdata);

    return res;
}


int at2_detect_modem_type(PrivAT2data *privdata)
{
    int res;
    ModemDef *modem;
    int i;

    debug("bb.smsc.at2", 0, "AT2[%s]: detecting modem type", octstr_get_cstr(privdata->name));

    if (at2_open_device(privdata) == -1)
        return -1;

    at2_set_speed(privdata, privdata->speed);
    /* send a return so the modem can detect the speed */
    res = at2_send_modem_command(privdata, "", 1, 0); 
    res = at2_send_modem_command(privdata, "AT", 0, 0);

    if (at2_send_modem_command(privdata, "AT&F", 0, 0) == -1)
        return -1;
    if (at2_send_modem_command(privdata, "ATE0", 0, 0) == -1)
        return -1;

    at2_flush_buffer(privdata);

    if (at2_send_modem_command(privdata, "ATI", 0, 0) == -1)
        return -1;

    /* we try to detect the modem automatically */
    i = 1;
    while ((modem = at2_read_modems(privdata, privdata->configfile, NULL, i++)) != NULL) {

        if (octstr_len(modem->detect_string) == 0) {
            at2_destroy_modem(modem);
            continue;
        }

        /* 
        debug("bb.smsc.at2",0,"AT2[%s]: searching for %s", octstr_get_cstr(privdata->name), 
              octstr_get_cstr(modem->name)); 
        */

        if (octstr_search(privdata->lines, modem->detect_string, 0) != -1) {
            if (octstr_len(modem->detect_string2) == 0) {
                debug("bb.smsc.at2", 0, "AT2[%s]: found string <%s>, using modem definition <%s>", 
                      octstr_get_cstr(privdata->name), octstr_get_cstr(modem->detect_string), 
                      octstr_get_cstr(modem->name));
                privdata->modem = modem;
                break;
            } else {
                if (octstr_search(privdata->lines, modem->detect_string2, 0) != -1) {
                    debug("bb.smsc.at2", 0, "AT2[%s]: found string <%s> plus <%s>, using modem "
                          "definition <%s>", octstr_get_cstr(privdata->name), 
                          octstr_get_cstr(modem->detect_string), 
                          octstr_get_cstr(modem->detect_string2), 
                          octstr_get_cstr(modem->name));
                    privdata->modem = modem;
                    break;
                }
            }
        }
    }

    if (privdata->modem == NULL) {
        debug("bb.smsc.at2", 0, "AT2[%s]: Cannot detect modem, using generic", 
              octstr_get_cstr(privdata->name));
        if ((modem = at2_read_modems(privdata, privdata->configfile, octstr_imm("generic"), 0)) == NULL) {
            panic(0, "AT2[%s]: Cannot detect modem and generic not found", 
                  octstr_get_cstr(privdata->name));
        } else {
            privdata->modem = modem;
        }
    }

    /* lets see if it supports GSM SMS 2+ mode */
    res = at2_send_modem_command(privdata, "AT+CSMS=?", 0, 0);
    if (res != 0)
        /* if it doesnt even understand the command, I'm sure it won't support it */
        privdata->phase2plus = 0; 
    else {
        /* we have to take a part a string like +CSMS: (0,1,128) */
        Octstr *ts;
        int i;
        List *vals;

        ts = privdata->lines;
        privdata->lines = NULL;

        i = octstr_search_char(ts, '(', 0);
        if (i > 0) {
            octstr_delete(ts, 0, i + 1);
        }
        i = octstr_search_char(ts, ')', 0);
        if (i > 0) {
            octstr_truncate(ts, i);
        }
        vals = octstr_split(ts, octstr_imm(","));
        octstr_destroy(ts);
        ts = list_search(vals, octstr_imm("1"), (void*) octstr_item_match);
        if (ts)
            privdata->phase2plus = 1;
        list_destroy(vals, octstr_destroy_item);
    }
    if (privdata->phase2plus)
        info(0, "AT2[%s]: Phase 2+ is supported", octstr_get_cstr(privdata->name));
    at2_close_device(privdata);
    return 0;
}


ModemDef *at2_read_modems(PrivAT2data *privdata, Octstr *file, Octstr *id, int idnumber)
{

    Cfg *cfg;
    List *grplist;
    CfgGroup *grp;
    Octstr *p;
    ModemDef *modem;
    int i = 1;

    /* 
     * Use id and idnumber=0 or id=NULL and idnumber > 0 
     */
    if (octstr_len(id) == 0 && idnumber == 0)
        return NULL;

    if (idnumber == 0)
        debug("bb.smsc.at2", 0, "AT2[%s]: Reading modem definitions from <%s>", 
              octstr_get_cstr(privdata->name), octstr_get_cstr(file));
    cfg = cfg_create(file);

    if (cfg_read(cfg) == -1)
        panic(0, "Cannot read modem definition file");

    grplist = cfg_get_multi_group(cfg, octstr_imm("modems"));
    if (idnumber == 0)
        debug("bb.smsc.at2", 0, "AT2[%s]: Found <%ld> modems in config", 
              octstr_get_cstr(privdata->name), list_len(grplist));

    if (grplist == NULL)
        panic(0, "Where are the modem definitions ?!?!");

    grp = NULL;
    while (grplist && (grp = list_extract_first(grplist)) != NULL) {
        p = cfg_get(grp, octstr_imm("id"));
        if (p == NULL) {
            info(0, "Modems group without id, bad");
            continue;
        }
        /* Check by id */
        if (octstr_len(id) != 0 && octstr_compare(p, id) == 0) {
            O_DESTROY(p);
            break;
        }
        /* Check by idnumber */
        if (octstr_len(id) == 0 && idnumber == i) {
            O_DESTROY(p);
            break;
        }
        O_DESTROY(p);
        i++;
        grp = NULL;
    }
    if (grplist != NULL)
        list_destroy(grplist, NULL);

    if (grp != NULL) {
        modem = gw_malloc(sizeof(ModemDef));

        modem->id = cfg_get(grp, octstr_imm("id"));

        modem->name = cfg_get(grp, octstr_imm("name"));
        if (modem->name == NULL)
            modem->name = octstr_duplicate(modem->id);

        modem->detect_string = cfg_get(grp, octstr_imm("detect-string"));
        modem->detect_string2 = cfg_get(grp, octstr_imm("detect-string2"));

        modem->init_string = cfg_get(grp, octstr_imm("init-string"));
        if (modem->init_string == NULL)
            modem->init_string = octstr_create("AT+CNMI=1,2,0,1,0");

        modem->reset_string = cfg_get(grp, octstr_imm("reset-string"));

        modem->speed = 9600;
        cfg_get_integer(&modem->speed, grp, octstr_imm("speed"));

        cfg_get_bool(&modem->need_sleep, grp, octstr_imm("need-sleep"));

        modem->enable_hwhs = cfg_get(grp, octstr_imm("enable-hwhs"));
        if (modem->enable_hwhs == NULL)
            modem->enable_hwhs = octstr_create("AT+IFC=2,2");

        cfg_get_bool(&modem->no_pin, grp, octstr_imm("no-pin"));

        cfg_get_bool(&modem->no_smsc, grp, octstr_imm("no-smsc"));

        modem->sendline_sleep = 100;
        cfg_get_integer(&modem->sendline_sleep, grp, octstr_imm("sendline-sleep"));

        modem->keepalive_cmd = cfg_get(grp, octstr_imm("keepalive-cmd"));
        if (modem->keepalive_cmd == NULL)
            modem->keepalive_cmd = octstr_create("AT");

        modem->message_storage = cfg_get(grp, octstr_imm("message-storage"));

        cfg_get_bool(&modem->enable_mms, grp, octstr_imm("enable-mms"));

        /*	
        if (modem->message_storage == NULL)
            modem->message_storage = octstr_create("SM");
        */

        cfg_get_bool(&modem->broken, grp, octstr_imm("broken"));

        cfg_destroy(cfg);
        return modem;

    } else {
        cfg_destroy(cfg);
        return NULL;
    }
}


void at2_destroy_modem(ModemDef *modem)
{
    if (modem != NULL) {
        O_DESTROY(modem->id);
        O_DESTROY(modem->name);
        O_DESTROY(modem->detect_string);
        O_DESTROY(modem->detect_string2);
        O_DESTROY(modem->init_string);
        O_DESTROY(modem->enable_hwhs);
        O_DESTROY(modem->keepalive_cmd);
        O_DESTROY(modem->message_storage);
        O_DESTROY(modem->reset_string);
        gw_free(modem);
    }
}


int swap_nibbles(unsigned char byte)
{
    return ( ( byte & 15 ) * 10 ) + ( byte >> 4 );
}


Octstr* at2_format_address_field(Octstr* msisdn)
{
    int ntype = PNT_UNKNOWN;
    Octstr* out = octstr_create("");
    Octstr* temp = octstr_duplicate(msisdn);

    octstr_strip_blanks(temp);
    /*
     * Check for international numbers
     * number starting with '+' or '00' are international,
     * others are national.
     */
    if (strncmp(octstr_get_cstr(msisdn), "+", 1) == 0) {
	octstr_delete(temp, 0, 1);
        ntype = PNT_INTER; /* international */
    } else if (strncmp(octstr_get_cstr(msisdn), "00", 2) == 0) {
        octstr_delete(temp, 0, 2);
        ntype = PNT_INTER; /* international */
    }

    /* address length */
    octstr_append_char(out, octstr_len(temp));

    /* Type of address : bit mapped values */
    octstr_append_char(out, 0x80 /* Type-of-address prefix */ |
			    0x01 /* Numbering-plan: MSISDN */ |
			    (ntype == PNT_INTER ? 0x10 : 0x00) /* Type-of-number: International or National */
			    );

    /* grab the digits from the MSISDN and encode as swapped semi-octets */
    while (octstr_len(temp)) {
	int digit1, digit2;
	/* get the first two digit */
	digit1 = octstr_get_char(temp,0) - 48;
	if ((digit2 = octstr_get_char(temp,1) - 48) < 0)
	    digit2 = 0x0F;
	octstr_append_char(out, (digit2 << 4) | digit1);
	octstr_delete(temp, 0, 2);
    }

    O_DESTROY(temp);
    return out;	
}


int at2_set_message_storage(PrivAT2data* privdata, Octstr* memory_name)
{
    Octstr *temp;
    int ret;

    if (!memory_name || !privdata)
        return -1;

    temp = octstr_format("AT+CPMS=\"%S\"", memory_name);
    ret = at2_send_modem_command(privdata, octstr_get_cstr(temp), 0, 0);
    octstr_destroy(temp);

    return !ret ? 0 : -1;
}


const char *at2_error_string(int code)
{
    switch (code) {
    case 8:
        return "Operator determined barring";
    case 10:
        return "Call barred";
    case 21:
        return "Short message transfer rejected";
    case 27:
        return "Destination out of service";
    case 28:
        return "Unidentified subscriber";
    case 29:
        return "Facility rejected";
    case 30:
        return "Unknown subscriber";
    case 38:
        return "Network out of order";
    case 41:
        return "Temporary failure";
    case 42:
        return "Congestion";
    case 47:
        return "Resources unavailable, unspecified";
    case 50:
        return "Requested facility not subscribed";
    case 69:
        return "Requested facility not implemented";
    case 81:
        return "Invalid short message transfer reference value";
    case 95:
        return "Invalid message, unspecified";
    case 96:
        return "Invalid mandatory information";
    case 97:
        return "Message type non-existent or not implemented";
    case 98:
        return "Message not compatible with short message protocol state";
    case 99:
        return "Information element non-existent or not implemented";
    case 111:
        return "Protocol error, unspecified";
    case 127:
        return "Interworking, unspecified";
    case 128:
        return "Telematic interworking not supported";
    case 129:
        return "Short message Type 0 not supported";
    case 130:
        return "Cannot replace short message";
    case 143:
        return "Unspecified TP-PID error";
    case 144:
        return "Data coding scheme (alphabet not supported";
    case 145:
        return "Message class not supported";
    case 159:
        return "Unspecified TP-DCS error";
    case 160:
        return "Command cannot be actioned";
    case 161:
        return "Command unsupported";
    case 175:
        return "Unspecified TP-Command error";
    case 176:
        return "TPDU not supported";
    case 192:
        return "SC busy";
    case 193:
        return "No SC subscription";
    case 194:
        return "SC system failure";
    case 195:
        return "Invalid SME address";
    case 196:
        return "Destination SME barred";
    case 197:
        return "SM Rejected-Duplicate SM";
    case 198:
        return "TP-VPF not supported";
    case 199:
        return "TP-VP not supported";
    case 208:
        return "D0 SIM SMS storage full";
    case 209:
        return "No SMS storage capability in SIM";
    case 210:
        return "Error in MS";
    case 211:
        return "D0 SIM SMS storage full";
    case 212:
        return "SIM Application Toolkit Busy";
    case 213:
        return "SIM data download error";
    case 255:
        return "Unspecified error cause";
    case 300:
        return "ME failure";
    case 301:
        return "SMS service of ME reserved";
    case 302:
        return "Operation not allowed";
    case 303:
        return "Operation not supported";
    case 304:
        return "Invalid PDU mode parameter";
    case 305:
        return "Invalid text mode parameter";
    case 310:
        return "SIM not inserted";
    case 311:
        return "SIM PIN required";
    case 312:
        return "PH-SIM PIN required";
    case 313:
        return "SIM failure";
    case 314:
        return "SIM busy";
    case 315:
        return "SIM wrong";
    case 316:
        return "SIM PUK required";
    case 317:
        return "SIM PIN2 required";
    case 318:
        return "SIM PUK2 required";
    case 320:
        return "Memory failure";
    case 321:
        return "Invalid memory index -> don't worry, just memory fragmentation.";
    case 322:
        return "Memory full";
    case 330:
        return "SMSC address unknown";
    case 331:
        return "No network service";
    case 332:
        return "Network timeout";
    case 340:
        return "NO +CNMA ACK EXPECTED";
    case 500:
        return "Unknown error. -> maybe Sim storage is full? I'll have a look at it.";
    case 512:
        return "User abort";
    default:
        return "error number not known to us. ask google and add it.";
    }
}

