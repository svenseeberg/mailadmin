<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Admin</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
<body>
<div class="container">
  <h2 style="margin-top:2em;margin-bottom:1em;"><a href="/">Mail Admin</a></h2>
<?php
var_dump($cfg);
if($cfg['edit'] == 'user') {
?>
<h3>Edit User</h3>
<div></div>
<?php
} elseif($cfg['edit' == 'alias']) {
?>
<h3>Edit Alias</h3>
<div></div>
<?php
}
?>
</div>
</body>
</html>
