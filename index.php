<?php
    require_once('functions.php');
    $cfg = init();

    if($_GET['path'] == 'logout') {
        logout($cfg);
    }

    $cfg = verify_logged_in($cfg,
        (array_key_exists('user' ,$_POST) ? $_POST['user'] : false),
        (array_key_exists('password' ,$_POST) ? $_POST['password'] : false));
    if(is_string($cfg['username'])) {
        $cfg = admin_domains($cfg);
        parse_action($cfg);
        $cfg = parse_page($cfg);
        draw($cfg['page'], $cfg);
    } else {
        draw('login', $cfg);
    }
?>
