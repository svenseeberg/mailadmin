<?php
$config = parse_ini_file ( 'config.ini', $process_sections = true);
var_dump($config);
$mysqli = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
start_session();
var_dump(session_id());
?>
