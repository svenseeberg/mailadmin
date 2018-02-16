<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mail Admin</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body style="width:100%;">
   <!--
   <div class="container">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Change password</a></li>
      <li><a data-toggle="tab" href="#users">Edit users</a></li>
      <li><a data-toggle="tab" href="#aliases">Edit alias</a></li>
    </ul>

    <div class="tab-content">
     <div id="home" class="tab-pane fade in active">
       <h3>Change password</h3>
        <div class="container">
         <div class="row" style="margin-top:100px;">
          <div class="" style="margin:auto;">
           <form method='post' action=''>
            <div class="form-login">
            <input name="old_pw" type="password" id="user" class="form-control input-sm chat-input" placeholder="Current password" />
            </br>
            <input name="new_pw1" type="password" id="password" class="form-control input-sm chat-input" placeholder="New password" />
            </br>
            <input name="new_pw2" type="password" id="password" class="form-control input-sm chat-input" placeholder="Confirm new password" />
            </br>
            <div class="wrapper">
            <input type="submit" class="btn btn-info" value="login">
            </div>
            </div>
           </form>
          </div>
         </div>
        </div>
      </div>
      <div id="users" class="tab-pane fade">
        <h3>Edit userse</h3>
        <p>Some content in menu 1.</p>
      </div>
      <div id="aliases" class="tab-pane fade">
        <h3>Edit alias</h3>
        <p>Some content in menu 2.</p>
      </div>
    </div>
   </div>-->
    <div class="container">
      <h2>Mail Admin</h2>

      <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">Change password</a></li>
        <li><a data-toggle="pill" href="#menu1">Menu 1</a></li>
        <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
        <li><a data-toggle="pill" href="#menu3">Menu 3</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>HOME</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
          <h3>Menu 1</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
          <h3>Menu 2</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div id="menu3" class="tab-pane fade">
          <h3>Menu 3</h3>
          <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        </div>
      </div>
    </div>
  </body>
</html>
