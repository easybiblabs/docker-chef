<?php

include 'config.sample.inc.php';

$admin_user = getenv('ADMIN_USER');
$admin_pass = getenv('ADMIN_PASS');

if (!empty($admin_user)) {
  $config['login'] = array(
    $admin_user => array(
      'password' => $admin_pass,
    ),
  );
}

$i=1;

$config['servers'] = array();

while (TRUE) {

  $prefix = 'REDIS_' . $i . '_';

  $server_name = getenv($prefix . 'NAME');
  $server_host = getenv($prefix . 'HOST');
  $server_port = getenv($prefix . 'PORT');
  $server_pass = getenv($prefix . 'PASS');

  if (empty($server_host)) {
    break;
  }

  if (empty($server_name)) {
    $server_name = $server_host;
  }

  if (empty($server_port)) {
    $server_port = 6379;
  }

  $array = array(
      'name'   => $server_name,
      'host'   => $server_host,
      'port'   => $server_port,
      'filter' => '*',
  );
  if($server_pass != '') $array['auth'] = $server_pass;

  $config['servers'][] = $array;

  $i++;
}
