<?php
define('FRAME', 'mc');
$frames = buildframes(array(FRAME));
$frames = $frames[FRAME];
define('ACTIVE_FRAME_URL', url("material/{$action}"));


