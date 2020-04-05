<?php
defined('IN_IA') or exit('Access Denied');
define('FRAME', 'advertisement');
if ($do == 'display') {
    define('ACTIVE_FRAME_URL', url('advertisement/content-provider/account_list'));
}

