<?php
require_once('functions.php');
$cfg = init();
if(verify_logged_in($cfg,$_POST['user'],$_POST['password'])) {
    draw('menu', $cfg);
} else {
    draw('login', $cfg);
}

?>
