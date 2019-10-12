<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'action_begin' => 
    array (
      0 => 'geetest',
    ),
    'config_init' => 
    array (
      0 => 'geetest',
    ),
    'app_init' => 
    array (
      0 => 'log',
    ),
    'admin_login_init' => 
    array (
      0 => 'loginbg',
    ),
    'response_send' => 
    array (
      0 => 'loginvideo',
    ),
    'user_sidenav_after' => 
    array (
      0 => 'recharge',
    ),
  ),
  'route' => 
  array (
    '/example$' => 'example/index/index',
    '/example/d/[:name]' => 'example/demo/index',
    '/example/d1/[:name]' => 'example/demo/demo1',
    '/example/d2/[:name]' => 'example/demo/demo2',
  ),
);