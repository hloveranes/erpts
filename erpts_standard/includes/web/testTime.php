<?php

$startDate = getdate(strtotime("now"));
$endDate = getdate(strtotime("Jan 1, 2004"));
# get the years
$numYears = $endDate['year'] - $startDate['year'];
# get the months
$numMonths = $endDate['mon'] - $startDate['mon'];
$totalMonths = ($numYears*12) + $numMonths;

echo " $numYears years have elapsed, $numMonths months have passed \n";
echo " that makes a total of $totalMonths \n";
$startTime = strtotime("Jan 1, 2003");
$q1 = date("M-j-Y",$startTime);
$q2 = date("M-j-Y",strtotime("+3 months", $startTime));
$q3 = date("M-j-Y",strtotime("+6 months", $startTime));
$q4 = date("M-j-Y",strtotime("+9 months", $startTime));
echo "the four quarters $q1, $q2, $q3, $q4\n";

?>
