<?php
//for($i = 0;$i< 60;$i++){
$res = exec('./pflogsumm.pl -d today /var/log/maillog', $output);
//$out = json_encode($res);
//echo $output."\n";
//print_r($output);
//$var = json_encode($output);
//echo $var;
header('Content-Type: application/json');
echo json_encode($output);
//echo "HELLO".$var[0]; 
//$res2 = exec("netstat -pt | grep smtp", $out);
//print_r($out);
?>

