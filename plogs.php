<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<style>
.detail
{
 text-align: center;
 font-family: 'Quicksand', sans-serif;
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
.table
{
width: 50%;
margin-left:25%;
}
</style>
</head>
<body>
<h1>Postfix Logs</h1>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="padmin.php">Monitor</a>
      <a class="navbar-brand" href="pqueue.php">Queue</a>
      <a class="navbar-brand selected">Logs</a>
      <a class="navbar-brand" href="mailer.php">Test Mail</a
    </div>
</div>
</nav>
<table class="table table-hover table-bordered">
<tr><th>Logs</th></tr>
<?php
$r = exec("ls | grep logmail", $files);
foreach($files as $file)
{
  echo "<tr><td><a href=".$file.">".$file."</a></td></tr>";
}
?>
</table>
</body>
</html>
