<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Admin</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body style="width:100%;">
   <div class="container">
    <?php if($_GET['path'] == 'logout') echo "<h3>Bye bye!</h3>"; ?>
    <div class="row" style="margin-top:100px;">
     <div class="" style="margin:auto;">
      <form method='post' action='/menu/home/'>
       <div class="form-login">
       <h4>Log in</h4>
       <input name="user" type="text" id="user" class="form-control input-sm chat-input" placeholder="Mail address" />
       <br>
       <input name="password" type="password" id="password" class="form-control input-sm chat-input" placeholder="Password" />
       <br>
       <div class="wrapper">
       <input type="submit" class="btn btn-info" value="login">
       </div>
       </div>
      </form>
     </div>
    </div>
   </div>
  </body>
</html>
