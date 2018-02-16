<?php
require_once('functions.php');
$cfg = init();
$cfg = verify_logged_in($cfg,$_POST['user'],$_POST['password']);
if(is_string($cfg['username'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        parse_post();
    }
    draw('menu', $cfg);
} else {
    draw('login', $cfg);
}

?>
