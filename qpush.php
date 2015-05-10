<?php
if(isset($_POST['hold'])){
echo "hold";
$str = "mailq | tail -n +2 | grep -v '^ *(' | \ gawk 'BEGIN {RS = ''} /member[0-9]@".$_POST['qname']."/ {print $1}' | \ tr -d '*!' |postsuper -h -";
}
else if(isset($_POST['flush'])){
echo "flush";
$str = "mailq | tail -n +2 | grep -v '^ *(' | \ gawk 'BEGIN {RS = ''} /member[0-9]@".$_POST['qname']."/ {print $1}' | \ tr -d '*!' |postsuper -H -";
}
else if(isset($_POST['del'])){
echo "delete";
$str = "mailq | tail -n +2 | grep -v '^ *(' | \ gawk 'BEGIN {RS = ''} /member[0-9]@".$_POST['qname']."/ {print $1}' | \ tr -d '*!' |postsuper -d -";
}
else if(isset($_POST['del_all'])){
echo "deleted";
$str = "postsuper -d ALL";
}

$res = exec($str, $output);
print_r($output);
header('Location: http://localhost/PostfixMonitor/pqueue.php');
?>
