## Running VMWare on FC9   <sub>by JC (2008 Nov 5)</sub> ##

Running VMWare Workstation on FC9 generates an error message something like

> _**"C headers matching your running kernel not found"**_

Cause: The default install of FC9 does not include the kernel-devel package

Solution: Install it using yum -

> `yum install kernel-devel`

This presupposes your FC9 box has a working Internet connection.

After this, running VMWare Workstation updates its modules and should work normally.