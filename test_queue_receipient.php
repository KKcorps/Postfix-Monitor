<?php
$res = exec("whoami", $out1);
print_r($out1);
$res_2 = exec("mailq | grep ^[A-Z\|0-9] | awk '{print $8}' | cut -d@ -f2 | sort | uniq -c | sort -rn", $out);
header('Content-Type: application/json');
echo json_encode($out);
?>
