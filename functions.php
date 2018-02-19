<?php
function init() {
    $cfg = parse_ini_file ( 'config.ini', $process_sections = true);
    $cfg['mysqli'] = new mysqli($cfg['db']['host'], $cfg['db']['user'], $cfg['db']['password'], $cfg['db']['database']);
    $cfg['db']['password'] = 'XXXXXX';
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

function get_db_password_address($cfg, $address) {
    $address = explode('@', $address);
    $query = "SELECT id, password FROM accounts WHERE username=? AND domain=? LIMIT 1";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('ss', $address[0], $address[1]);
    $stmt->bind_result($user_id, $db_password);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return array($user_id, $db_password);
}

function get_db_password_id($cfg, $user_id) {
    $query = "SELECT password FROM accounts WHERE id=? LIMIT 1";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('s', $user_id);
    $stmt->bind_result($db_password);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $db_password;
}

function get_account_domain($cfg, $user_id) {
    $query = "SELECT domain FROM accounts WHERE id=? LIMIT 1";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('s', $user_id);
    $stmt->bind_result($domain);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $domain;
}

function get_alias_domain($cfg, $alias_id) {
    $query = "SELECT source_domain FROM aliases WHERE id=? LIMIT 1";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param('s', $alias_id);
    $stmt->bind_result($domain);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $domain;
}

function login($cfg, $address, $password) {
    list($user_id, $db_password) = get_db_password_address($cfg, $address);
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
    $cfg['user_id'] = $user_id;
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

function logout($cfg) {
    $sid = session_id();
    $query = "DELETE FROM logins WHERE session_id=?";
    $stmt = $cfg['mysqli']->prepare($query);
    $stmt->bind_param("s", $sid);
    $stmt->execute();
    $stmt->close();
}


function verify_logged_in($cfg, $user=false, $password=false) {
    if(is_string($user) and is_string($password) and substr_count($user, '@') == 1){
        $user_id = login($cfg, $user, $password);
        if($user_id)
            save_session($cfg, $user_id);
        else
            return false;
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

function parse_page($cfg) {
    if(array_key_exists('path' ,$_GET) and strlen($_GET['path']) > 0) {
        $parts = explode('/', $_GET['path']);
        $cfg['page'] = $parts[0];
        $cfg['edit'] = $parts[1];
        if(sizeof($parts) == 3)
            $cfg['item'] = $parts[2];
    } else {
        $cfg['page'] = 'menu';
    }
    return $cfg;
}

function admin_domains($cfg) {
    $mail = $cfg['username'].'@'.$cfg['userdomain'];
    foreach($cfg['admins'] as $domain => $addresses) {
        if (strpos($addresses, $mail) !== false) {
            $cfg['admin_domains'][] = $domain;
        }
    }
    return $cfg;
}

function list_users($cfg, $id=false) {
    /* We don't need a prepared statement here because the query
     * parameters are read from the config.ini. And a variable amount of
     * items in the IN clause is a nightmare with prepared statements. */
    $inclause=implode("', '",($cfg['admin_domains']));
    if($id)
        $query = sprintf("SELECT id, username, domain, quota, enabled, sendonly FROM accounts WHERE id = %s",$id);
    else
        $query = sprintf("SELECT id, username, domain, quota, enabled, sendonly FROM accounts WHERE domain IN ('%s')",$inclause);
    $result = $cfg['mysqli']->query($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $user_list[] = array(   'id' => $row['id'],
                                'address' => $row['username'].'@'.$row['domain'],
                                'quota' => $row['quota'],
                                'enabled' => $row['enabled'],
                                'sendonly' => $row['sendonly']
                            );
    }
    return $user_list;
}

function list_aliases($cfg, $id=false) {
    /* We don't need a prepared statement here because the query
     * parameters are read from the config.ini. And a variable amount of
     * items in the IN clause is a nightmare with prepared statements. */
    $inclause=implode("', '",($cfg['admin_domains']));
    if($id)
        $query = sprintf("SELECT * FROM aliases WHERE id = %s",$id);
    else
        $query = sprintf("SELECT * FROM aliases WHERE source_domain IN ('%s')",$inclause);
    $result = $cfg['mysqli']->query($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $user_list[] = array(   'id' => $row['id'],
                                'source' => $row['source_username'].'@'.$row['source_domain'],
                                'destination' => $row['destination_username'].'@'.$row['destination_domain'],
                                'enabled' => $row['enabled']
                            );
    }
    return $user_list;
}

function parse_action($cfg) {
    if(array_key_exists('new_user_address' ,$_POST) and array_key_exists('new_user_password' ,$_POST)) {
        new_user(           $cfg, $_POST['new_user_address'],
                            $_POST['new_user_password'],
                            $cfg['defaults']['quota'],
                            (array_key_exists('new_user_enabled', $_POST) ? 1 : 0),
                            (array_key_exists('new_user_sendonly', $_POST) ? 1 : 0)
                );
    } elseif(array_key_exists('new_alias_source' ,$_POST) and array_key_exists('new_alias_destination' ,$_POST)) {
        new_alias(          $cfg, $_POST['new_alias_source'],
                            $_POST['new_alias_destination'],
                            (array_key_exists('new_alias_enabled', $_POST) ? 1 : 0)
                 );
    } elseif(array_key_exists('edit_user' ,$_POST)) {
        update_user(        $cfg, $_POST['edit_user'],
                            $_POST['edit_user_password'],
                            $_POST['edit_user_quota'],
                            (array_key_exists('edit_user_enabled', $_POST) ? 1 : 0),
                            (array_key_exists('edit_user_sendonly', $_POST) ? 1 : 0)
                   );
    } elseif(array_key_exists('edit_alias' ,$_POST)) {
        update_alias(       $cfg,
                            $_POST['edit_alias'],
                            $_POST['edit_alias_destination'],
                            (array_key_exists('edit_alias_enabled', $_POST) ? 1 : 0)
                    );
    } elseif(array_key_exists('old_pw' ,$_POST)) {
        update_password(    $cfg,
                            $_POST['old_pw'],
                            $_POST['new_pw1'],
                            $_POST['new_pw2']
                       );
    }
}

function update_password($cfg, $old_password, $new_password, $new_password2) {
    $db_password = get_db_password_id($cfg, $cfg['user_id']);
    if($new_password == $new_password2 and verify_password($db_password, $old_password)) {
        $query = "UPDATE accounts SET password=? WHERE id=?";
        $stmt = $cfg['mysqli']->prepare($query);
        $encrypted_new_password = encrypt_password($new_password);
        $stmt->bind_param("si", $encrypted_new_password, $cfg['user_id']);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function new_user($cfg, $address, $password, $quota, $enabled=0, $sendonly=0) {
    $address = filter_var($address, FILTER_SANITIZE_EMAIL);
    $address = explode('@', $address);
    if(sizeof($address)==2 and in_array($address[1], $cfg['admin_domains'])) {
        $query = "INSERT INTO accounts (username, domain, password, quota, enabled, sendonly) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $cfg['mysqli']->prepare($query);
        $encrypted_password = encrypt_password($password);
        $stmt->bind_param("sssiii", $address[0], $address[1], $encrypted_password, $quota, $enabled, $sendonly);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function update_user($cfg, $user_id, $password, $quota, $enabled, $sendonly) {
    $domain = get_account_domain($cfg, $user_id);
    if(in_array($domain, $cfg['admin_domains'])) {
        if(sizeof($password) > 8) {
            $encrypted_password = encrypt_password($password);
            $query = "UPDATE accounts SET password=?, quota=?, enabled=?, sendonly=? WHERE id=?";
            $stmt = $cfg['mysqli']->prepare($query);
            $stmt->bind_param("siiii", $encrypted_password, $quota, $enabled, $sendonly, $user_id);
        } else {
            $query = "UPDATE accounts SET quota=?, enabled=?, sendonly=? WHERE id=?";
            $stmt = $cfg['mysqli']->prepare($query);
            $stmt->bind_param("iiii", $quota, $enabled, $sendonly, $user_id);
        }
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function new_alias($cfg, $source, $destination, $enabled) {
    $source = filter_var($source, FILTER_SANITIZE_EMAIL);
    $destination = filter_var($destination, FILTER_SANITIZE_EMAIL);
    $source = explode('@', $source);
    $destination = explode('@', $destination);
    if(sizeof($source)==2 and sizeof($destination)==2 and in_array($source[1], $cfg['admin_domains'])) {
        $query = "INSERT INTO aliases (source_username, source_domain, destination_username, destination_domain, enabled) VALUES (?, ?, ?, ?, ?)";
        $stmt = $cfg['mysqli']->prepare($query);
        $stmt->bind_param("ssssi", $source[0], $source[1], $destination[0], $destination[1], $enabled);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function update_alias($cfg, $alias_id, $destination, $enabled) {
    $domain = get_alias_domain($cfg, $alias_id);
    $destination = filter_var($destination, FILTER_SANITIZE_EMAIL);
    $destination = explode('@', $destination);
    if(sizeof($destination)==2 and in_array($domain, $cfg['admin_domains'])) {
        $query = "UPDATE aliases SET destination_username=?, destination_domain=?, enabled=? WHERE id=?";
        $stmt = $cfg['mysqli']->prepare($query);
        $stmt->bind_param("ssii", $destination[0], $destination[1], $enabled, $alias_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}
?>
