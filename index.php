<?php
    require_once('functions.php');
    $cfg = init();

    $cfg = verify_logged_in($cfg,$_POST['user'],$_POST['password']);
    if(is_string($cfg['username'])) {
        parse_action($cfg);
        $cfg = parse_page($cfg);
        $cfg = admin_domains($cfg);
        draw($cfg['page'], $cfg);
    } else {
        draw('login', $cfg);
    }
?>
