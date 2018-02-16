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
  <div class="tab-content" style="margin-top:0.5em;">
    <div id="home" class="tab-pane fade in active">
     <h3>Change Your Password</h3>
     <div class="container">
      <div class="row">
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
      <h3>Edit Users</h3>
       <table class="table table-hover">
         <thead>
           <tr>
             <th scope="col">Username</th>
             <th scope="col"></th>
           </tr>
         </thead>
         <tbody>
          <?php
           $users = list_users($cfg);
           foreach($users as $user) {
            echo "<tr><td>".$user['address']."</td><td>&#9998; &#128465;</td></tr>";
           }
          ?>
         </tbody>
       </table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Edit Aliases</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>

</body>
</html>
