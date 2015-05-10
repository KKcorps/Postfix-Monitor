<?php
if(isset($_POST['login'])){
$hostname = '{103.8.127.62:143}';
$user = $_POST['user'];
$pass = $_POST['pass'];
$inbox = imap_open($hostname,$user,$pass) or die("Can't connect to server");
$email = imap_search($inbox, 'ALL');
if($email){
 // print_r($email);
foreach($email as $num){
   $body = imap_fetchbody($inbox, $num, 0);
  echo imap_headers($inbox)."<br/>";
 }
//$stat = imap_status($inbox, 'INBOX');
//echo "STATUS: ".$stat."<br/>";

}
}
?>
