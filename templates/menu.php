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
  <h2>Dynamic Pills</h2>

  <ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a data-toggle="pill"  class="nav-link active" href="#home">Active</a>
  </li>
  <li class="nav-item">
    <a data-toggle="pill"  class="nav-link" href="#menu1">Longer nav link</a>
  </li>
  <li class="nav-item">
    <a data-toggle="pill"  class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a data-toggle="pill"  class="nav-link disabled" href="#">Disabled</a>
  </li>
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
