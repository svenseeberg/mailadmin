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
    $encrypted = encrypt_password($new_password, $split[2]);
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
    $stmt->bind_result($user_id, $db_password);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    if(verify_password($db_password, $password))
        return $user_id;
    else
        return false;
}

function set_user_domain($cfg, $user_id) {
    $query = "SELECT username, domain FROM accounts WHERE id=?";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->bind_result($username, $domain);
    $stmt->execute();
    $stmt->fetch();
    $cfg['username'] = $username;
    $cfg['userdomain'] = $domain;
    $stmt->close();
    return $cfg;
}

function get_current_user_id($cfg) {
    $sid = session_id();
    $time = time();
    $query = "SELECT id FROM logins WHERE session_id=? AND timeout>=?";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('si',$sid,$time);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    return $user_id;
}

function save_session($cfg, $user_id) {
    $sid = session_id();
    $timeout = time() + 600;
    $query = "INSERT INTO logins (id, session_id, timeout) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE session_id=?, timeout=?";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param("issss", $user_id, $sid, $timeout, $sid, $timeout);
    $stmt->execute();
    $stmt->close();
}

function verify_logged_in($cfg, $user=false, $password=false) {
    if(is_string($user) and is_string($password) and substr_count($user, '@') == 1){
        $user_id = login($cfg, $user, $password);
        if($user_id)
            save_session($cfg, $user_id);
        else
            echo "Try again.";
    }
    $user_id = get_current_user_id($cfg);
    if($user_id) {
        $cfg = set_user_domain($cfg, $user_id);
        return $cfg;
    } else {
        return false;
    }
}

function draw($page, $cfg) {
    include("templates/".$page.".php");
}

?>
