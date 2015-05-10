<?php
$r = fopen("/var/log/mail.log","r");
while($q = fgets($r)){
  echo $q."<br/>";
}
?>
