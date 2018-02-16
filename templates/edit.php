<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
<body>
<div class="container">
  <h2 style="margin-top:2em;margin-bottom:1em;"><a href="/">Mail Admin</a></h2>
  <ul class="nav nav-pills">
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link active" href="#home">Change Password</a>
   </li>
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link" href="#menu1">Edit Users</a>
   </li>
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link" href="#">Edit Aliases</a>
   </li>
  </ul>
<?php
if($cfg['edit'] == 'user') {
?>
<div></div>
<?php
} elseif($cfg['edit' == ''])
?>
</div>
</body>
</html>
