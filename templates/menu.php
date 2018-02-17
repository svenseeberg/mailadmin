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
  <ul class="nav nav-pills">
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link active" href="#home">Change Password</a>
   </li>
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link" href="#users">Edit Users</a>
   </li>
   <li class="nav-item">
     <a data-toggle="pill"  class="nav-link" href="#aliases">Edit Aliases</a>
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
    <div id="users" class="tab-pane fade">
     <h3>Edit Users</h3>
     <form method='post' action=''>
      <table class="table table-hover">
       <thead>
        <tr>
         <th scope="col">Username</th>
         <th scope="col">Quota</th>
         <th scope="col">Enabled</th>
         <th scope="col">Send Only</th>
         <th scope="col"></th>
        </tr>
       </thead>
       <tbody>
        <?php
         $users = list_users($cfg);
         foreach($users as $user) {
          echo "<tr>
                 <td>".$user['address']."</td>
                 <td>".$user['quota']." MB</td>
                 <td>".$user['enabled']."</td>
                 <td>".$user['sendonly']."</td>
                 <td><a href='/edit/user/".$user['id']."'>&#9998;</a></td>
                </tr>";
         }
        ?>
         <tr>
          <td><input name="new_mail_address" type="text" class="form-control input-sm chat-input" placeholder="Mail address"/></td>
          <td><input name="new_mail_password" type="password" class="form-control input-sm chat-input" placeholder= "Password" /></td>
          <td>
           <div class="form-check">
            <input name="new_mail_enabled" type="checkbox" class="form-check-input" id="new_mail_enabled">
           </div>
          </td>
          <td>
           <div class="form-check">
            <input name="new_mail_sendonly" type="checkbox" class="form-check-input" id="new_mail_sendonly">
           </div>
          </td>
          <td>
           <div class="wrapper">
            <input type="submit" class="btn btn-info" value="Save">
           </div>
          </td>
         </tr>
       </tbody>
      </table>
     </form>
    </div>
    <div id="aliases" class="tab-pane fade">
     <h3>Edit Aliases</h3>
     <form method='post' action=''>
      <table class="table table-hover">
       <thead>
        <tr>
         <th scope="col">Source Address</th>
         <th scope="col">Destination Address</th>
         <th scope="col">Enabled</th>
         <th scope="col"></th>
        </tr>
       </thead>
       <tbody>
        <?php
         $aliases = list_aliases($cfg);
         foreach($aliases as $alias) {
          echo "<tr>
                 <td>".$alias['source']."</td>
                 <td>".$alias['destination']."</td>
                 <td>".$alias['enabled']."</td>
                 <td><a href='/edit/alias/".$alias['id']."'>&#9998;</a></td>
                </tr>";
         }
        ?>
        <tr>
         <td><input name="new_alias_source" type="text" class="form-control input-sm chat-input" placeholder="Source address" /></td>
         <td><input name="new_alias_destination" type="text" class="form-control input-sm chat-input" placeholder="Destination address" /></td>
         <td>
          <div class="form-check">
           <input name="new_alias_enabled" type="checkbox" class="form-check-input" id="new_alias_enabled">
          </div>
         </td>
         <td>
          <div class="wrapper">
           <input type="submit" class="btn btn-info" value="Save">
          </div>
         </td>
        </tr>
       </tbody>
      </table>
     </form>
    </div>
  </div>
</div>

</body>
</html>
