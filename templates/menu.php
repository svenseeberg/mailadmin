 <?php
  include("templates/header.php");
  if($cfg['edit'] == 'home') {
   ?>
    <div id="home">
     <h3>Change Your Password</h3>
     <div class="container">
      <div class="row">
       <div class="" style="margin:auto;">
        <script>
function checkform() {
    if(document.change_pw.new_pw1.value != document.change_pw.new_pw2.value) {
        alert("Passwords do not match!");
        return false;
    } else if (document.change_pw.new_pw2.value.length <= 8 ) {
        alert("Password too short!")
    } else {
        document.change_pw.submit();
    }
}
        </script>
        <form method='post' action='/' name='change_pw'>
         <input name="nonce" type="hidden" value="<?php echo $cfg['nonce']; ?>"/>
         <div class="form-login">
         <input name="old_pw" type="password" id="user" class="form-control input-sm chat-input" placeholder="Current password" />
         <br>
         <input name="new_pw1" type="password" id="password" class="form-control input-sm chat-input" placeholder="New password" />
         <br>
         <input name="new_pw2" type="password" id="password" class="form-control input-sm chat-input" placeholder="Confirm new password" />
         <br>
         <div class="wrapper">
         <input type="submit" class="btn btn-warning" value="Change password" onclick="checkform();">
         </div>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>
   <?php
  } elseif($cfg['edit'] == 'users') {
   ?>
    <div id="users">
     <h3>Edit Users</h3>
     <form method='post' action='/menu/users'>
      <input name="nonce" type="hidden" value="<?php echo $cfg['nonce']; ?>"/>
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
         if(array_key_exists('admin_domains',$cfg)){
          $users = list_users($cfg);
          foreach($users as $user) {
           echo "<tr>
                  <td>".$user['address']."</td>
                  <td>".$user['quota']." MB</td>
                  <td>".$user['enabled']."</td>
                  <td>".$user['sendonly']."</td>
                  <td>
                   <a href='/edit/user/".$user['id']."'>&#9998;</a>
                   <a href='/delete/user/".$user['id']."' onclick='confirm(\"Are you sure you want to delete this user?\")'>🗑️</a>
                  </td>
                 </tr>";
          }
         }
        ?>
         <tr>
          <td><input name="new_user_address" type="text" class="form-control input-sm chat-input" placeholder="Mail address"/></td>
          <td><input name="new_user_password" type="text" class="form-control input-sm chat-input" placeholder= "Password" /></td>
          <td>
           <div class="form-check">
            <input name="new_user_enabled" type="checkbox" class="form-check-input" value="1" checked />
           </div>
          </td>
          <td>
           <div class="form-check">
            <input name="new_user_sendonly" type="checkbox" class="form-check-input" value="1" />
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
   <?php
  } elseif($cfg['edit'] == 'aliases') {
   ?>
    <div id="aliases">
     <h3>Edit Aliases</h3>
     <form method='post' action='/menu/aliases'>
      <input name="nonce" type="hidden" value="<?php echo $cfg['nonce']; ?>"/>
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
         if(array_key_exists('admin_domains',$cfg)){
          $aliases = list_aliases($cfg);
          foreach($aliases as $alias) {
           echo "<tr>
                  <td>".$alias['source']."</td>
                  <td>".$alias['destination']."</td>
                  <td>".$alias['enabled']."</td>
                  <td>
                   <a href='/edit/alias/".$alias['id']."'>&#9998;</a>
                   <a href='/delete/alias/".$alias['id']."' onclick='confirm(\"Are you sure you want to delete this alias?\")'>🗑️</a>
                  </td>
                 </tr>";
          }
         }
        ?>
        <tr>
         <td><input name="new_alias_source" type="text" class="form-control input-sm chat-input" placeholder="Source address" /></td>
         <td><input name="new_alias_destination" type="text" class="form-control input-sm chat-input" placeholder="Destination address" /></td>
         <td>
          <div class="form-check">
           <input name="new_alias_enabled" type="checkbox" class="form-check-input" value="1" checked />
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
   <?php
  }
include("templates/footer.php");
   ?>
