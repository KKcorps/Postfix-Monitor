<?php
$r = exec("whoami", $o);
//print_r($o);
//echo $r;
$res_2 = exec("sudo /bin/netstat -punta | grep -E ':25.*ESTABLISHED'", $out);
//echo "error:".$res_2."test";
//print_r($out);
header('Content-Type: application/json');
//print_r($out);
echo json_encode($out);
?>

