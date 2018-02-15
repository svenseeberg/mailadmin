<?php
function init() {
    $cfg = parse_ini_file ( 'config.ini', $process_sections = true);
    $cfg['mysqli'] = new mysqli($cfg['db']['host'], $cfg['db']['user'], $cfg['db']['password'], $cfg['db']['database']);
    session_start();
    return $cfg;
}

function encrypt_password($password, $salt=false) {
    if(false == $salt) {
        $salt = substr(sha1(rand()), 0, 16);
    }
    $hashed_password = "{SHA512-CRYPT}" . crypt($password, "$6$$salt");
    return $hashed_password;
}

function verify_password($db_password, $new_password) {
    $split = explode('$', $db_password);
    $encrypted = encrypt_password($new_password, $$split[2]);
    if($encrypted == $db_password)
        return true;
    else
        return false;
}

function login($cfg, $user, $password) {
    $address = explode('@', $user);
    $query = "SELECT id, password FROM accounts WHERE username=? AND domain=? LIMIT 1";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('ss', $address[0], $address[1]);
    $stmt->bind_result($id, $db_password);
    $stmt->execute();
    $stmt->fetch();
    if(verify_password($db_password, $password))
        return $id;
    else
        return false;
}

function draw($page, $cfg) {
    include("templates/".$page.".php");
}

function verify_logged_in($cfg, $user=false, $password=false) {
    if(is_string($user) and is_string($password) and substr_count($user, '@') == 1){
        $user_id = login($cfg, $user, $password);
        if($user_id) {
            $query = "INSERT INTO logins (id, session_id, timeout) VALUES (?, ?, ?)";
        } else {
            echo "Try again.";
        }
    }
    $query = "SELECT id FROM logins WHERE session_id=? AND timeout>=?";
    $stmt = $cfg['mysqli']->prepare($query);
    $sid = session_id();
    $t = time();
    $stmt->bind_param('si',$sid,$t);
    $stmt->execute();
    if($stmt->num_rows() > 0)
        return true;
    else
        return false;
}


?>
