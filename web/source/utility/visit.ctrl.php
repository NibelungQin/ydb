<?php
defined('IN_IA') or exit('Access Denied');

load()->model('visit');

$dos = array('showjs');
$do = in_array($do, $dos) ? $do : 'showjs';

if ($do == 'showjs') {
    echo '';
    exit;
}

