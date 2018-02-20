 <?php
 include("templates/header.php");
  if($cfg['edit'] == 'user') {
   $user = list_users($cfg, $cfg['item'])[0];
   ?>
   <h3>Edit User</h3>
   <form method='post' action='' autocomplete="new-password" >
    <input name="nonce" type="hidden" value="<?php echo $cfg['nonce']; ?>"/>
    <input name="edit_user" type="hidden" value="<?php echo $user['id']; ?>"/>
    <table class="table">
     <tr><th>User</th><th><?php echo $user['address']; ?></th><th></th></tr>
     <tr><td>Password</td><td><input id="edit_user_password" name="edit_user_password" type="text" class="form-control" placeholder="Set password" autocomplete="new-password" value=""/></td><td></td></tr>
     <tr><td>Quota</td><td><input name="edit_user_quota" type="text" class="form-control" placeholder="Current password" value="<?php echo $user['quota']; ?>" /></td><td>MB</td></tr>
     <tr><td>Enabled</td><td><input name="edit_user_enabled" type="checkbox" class="form-check-input" value="1" <?php if($user['enabled']) echo "checked"; ?>/></td><td></td></tr>
     <tr><td>Send Only</td><td><input name="edit_user_sendonly" type="checkbox" class="form-check-input" value="1" <?php if($user['sendonly']) echo "checked"; ?>/></td><td></td></tr>
     <tr><td><input type="submit" class="btn btn-info" value="Save"></td><td></td><td></td><td></td></tr>
    </table>
   </form>
   <?php
  } elseif($cfg['edit'] == 'alias') {
   $alias = list_aliases($cfg, $cfg['item'])[0];
   ?>
   <h3>Edit Alias</h3>
   <form method='post' action='' autocomplete="off">
    <input name="nonce" type="hidden" value="<?php echo $cfg['nonce']; ?>"/>
    <input name="edit_alias" type="hidden" value="<?php echo $alias['id']; ?>"/>
    <table class="table">
     <tr><th>Source</th><th><?php echo $alias['source']; ?></th><th></th></tr>
     <tr><td>Destination</td><td><input name="edit_alias_destination" type="text" class="form-control" placeholder="Set password" value="<?php echo $alias['destination']; ?>"/></td><td></td></tr>
     <tr><td>Enabled</td><td><input name="edit_alias_enabled" type="checkbox" class="form-check-input" id="new_mail_sendonly"value="1" <?php if($alias['enabled']) echo "checked"; ?>/></td><td></td></tr>
     <tr><td><input type="submit" class="btn btn-info" value="Save"></td><td></td><td></td></tr>
    </table>
   </form>
   <?php
  }
 include("templates/footer.php");
 ?>
