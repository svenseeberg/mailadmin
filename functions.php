<?php

function encrypt_password($password, $salt=false) {
    if(false == $salt) {
        $salt = substr(sha1(rand()), 0, 16);
    }
    $hashed_password = "{SHA512-CRYPT}" . crypt($password, "$6$$salt");
    return $hashed_password;
}


?>
