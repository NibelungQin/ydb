<?php
defined('IN_IA') or exit('Access Denied');
header('content-type: text/css');
$src = '';
if (!empty($_W['styles']['imgdir'])) {
    $src = $_W['styles']['imgdir'];
}