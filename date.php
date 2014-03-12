<?php 
$n = strtotime(date("Y-m-d", strtotime("03/05/2014")) . " +2 month");
$q = date("Y-m-d", $n);
echo $q ;
?>