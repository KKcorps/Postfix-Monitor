<?php
  $r = exec("mailq | grep ^[A-Z\|0-9] | awk '{print $7}' | sort", $total_out);
  header('Content-Type: application/json');
  echo json_encode($total_out);		  
?>
