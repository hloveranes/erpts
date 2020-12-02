<?php
$i = "nelson";
$new = (isset($i)&&(trim($i)<>"")) ? $i : "world";
echo "hello ".$new;
?>