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
  <h2 style="margin-top:2em;margin-bottom:1em;"><a href="/menu/home">&#x2709; Mail Admin</a></h2>
  <ul class="nav nav-pills">
   <li class="nav-item">
     <a class="nav-link <?php if($cfg['edit'] == 'home') echo "active"; ?>" href="/menu/home">Change Password</a>
   </li>
   <li class="nav-item">
     <a class="nav-link <?php if($cfg['edit'] == 'users') echo "active"; ?>" href="/menu/users">Edit Users</a>
   </li>
   <li class="nav-item">
     <a class="nav-link <?php if($cfg['edit'] == 'aliases') echo "active"; ?>" href="/menu/aliases">Edit Aliases</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="/logout">Log Out</a>
   </li>
  </ul>
  <div class="tab-content" style="margin-top:0.5em;">
