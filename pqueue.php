<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<style type="text/css">
.detail
{
 text-align: center;
 font-family: 'Quicksand', sans-serif;
}
.table
{
width: 49%;
}
.body
{
margin-left: 20px;
}
h1
{
font-family: 'Quicksand', sans-serif !important;
font-size: 72px;
background-color: rgb(134,223,45);
color: #fff;
margin-top: 0px;
margin-bottom: 0px;
text-align: center;
}

form
{
float:right;
margin-top: -5%;
width: 49%;
position: absolute;
right: 0px;
top: 12.5pc;
}
.navbar-brand
{
 margin-right: 10px;
}

.navbar-brand:hover:not(selected)
{
color: #000 !important;
background-color: #bbb !important;
border-radius: 2px !important;
}
.selected
{
 color:#000 !important;
 background-color: #ddd !important;
 border-radius: 2px !important;
}
</style>
</head>
<body>
<h1>Queue Manager</h1>
<div id="arrcall">
</div>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="padmin.php">Monitor</a>
      <a class="navbar-brand selected">Queue</a>
      <a class="navbar-brand" href="plogs.php">Logs</a>
      <a class="navbar-brand" href="mailer.php">Test Mail</a
    </div>
</div>
</nav>
<table class="table table-hover table-bordered">
<!--<button id="clk">Test</button>-->
<h2>Sending Domain Queue</h2>
<table class="table" id="qlist">
	<tr><th>Mail Count</th><th>Sending Domain</th></tr>
</table>
<form role="form" action="qpush.php" method="post">
<h2>Queue manager</h2>	
<select class="form-control" name="qname" id="qname">
		<?php
		  /*$r = exec("mailq | grep ^[A-Z\|0-9] | awk '{print $7}' | cut -d@ -f2 | sort", $total_out);
		  foreach ($total_out as $out) {
		  	$out_split = explode(" ", $out);
		  	echo "<option value='".$out_split[1]."'>".$out_split[1]."</option>";
		  }*/
		?>
</select>
<br>
	<button type="submit" value="flush" name="flush" class="btn btn-success">Flush Queue</button>
	<button type="submit" value="hold" name="hold" style="" class="btn btn-warning">Hold Queue</button>
       	<button type="submit" value="del" name="del" style="" class="btn btn-danger">Delete Queue</button>
       <button type="submit" value="del_all" name="del_all" style="float:right;" class="btn btn-info">Delete All Queues</button>  
</form>
<h2>Recipient Domain Queue</h2>
<table class="table" id="qlist_recipient">
	<tr><th>Mail Count</th><th>Recipient Domain</th></tr>
</table>
<script>
$(document).ready(
setInterval(function(){
$.get("test_queue_receipient.php", function(rec_queue, status){
$('#qlist_recpient').html("<tr><th>Mail Count</th><th>Recipient Domain</th></tr>");

for(var i = 0;i<rec_queue.length;i++){
var l = rec_queue[i].split(" ").filter(function(v){return v!==''});

$('#qlist_recipient').append("<tr><td class='tme'>"+l[0]+"</td><td>"+l[1]+"</td></tr>");
//i++;
}

});

$.get("test_queue.php", function(full_queue, status){
$('#qname').html("");
for(var i = 0;i<full_queue.length;i++){
var l = full_queue[i].split(" ").filter(function(v){return v!==''});
$('#qname').append("<option value='"+l[1]+"'>"+l[1]+"</option>");
}
});
$.get("test_queue.php",function(data,status){

$('#qlist').html("<tr><th>Mail Count</th><th>Sender Domain</th></tr>");

var max_in = 0;
var max_out = 0;
for(var i = 0;i<data.length;i++){
var l = data[i].split(" ").filter(function(v){return v!==''});
if(max_in<l[1]) max_in = l[1];
if(max_out<l[2]) max_out = l[2]; 
//$('#arrcall').append("<div class='details'>"+data[i]+"</div><br>");
$('#qlist').append("<tr><td class='tme'>"+l[0]+"</td><td>"+l[1]+"</td></tr>");
//i++;
}
//$('#maxin').html(max_in);
//$('#maxout').html(max_out);
});
//$("#arrcall").append("<p>success</p>");
}, 1000));

</script>

