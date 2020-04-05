<?php
ini_set('display_errors', '1');
ini_set("error_log", dirname(__FILE__) . "/logs/php_error.log");
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);


ob_start();
define('IA_ROOT', str_replace("\\", '/', dirname(__FILE__)));
define('APP_URL', 'http://v2.addons.yidaoit.cn/web/');
define('APP_STORE_URL', 'http://v2.addons.yidaoit.cn/web');
define('APP_STORE_API', 'http://v2.addons.yidaoit.cn/api.php');
if ($_GET['res']) {
    $res = $_GET['res'];
    $reses = tpl_resources();
    if (array_key_exists($res, $reses)) {
        if ($res == 'css') {
            header('content-type:text/css');
        } else {
            header('content-type:image/png');
        }
        echo base64_decode($reses[$res]);
        exit();
    }
}

$actions = array('license', 'env', 'db', 'finish');
$action = !empty($_GET['step']) ? $_GET['step'] : $_COOKIE['action'];
$action = in_array($action, $actions) ? $action : 'license';
$ispost = strtolower($_SERVER['REQUEST_METHOD']) == 'post';

if (file_exists(IA_ROOT . '/data/install.lock') && $action != 'finish') {
    header('location: ./index.php');
    exit;
}
header('content-type: text/html; charset=utf-8');
if ($action == 'license') {
    if ($ispost) {
        setcookie('action', 'env');
        header('location: ?refresh');
        exit;
    }
    tpl_install_license();
}
if ($action == 'env') {
    if ($ispost) {
        setcookie('action', $_POST['do'] == 'continue' ? 'db' : 'license');
        header('location: ?refresh');
        exit;
    }
    $ret = array();
    $ret['server']['os']['value'] = php_uname();
    if (PHP_SHLIB_SUFFIX == 'dll') {
        $ret['server']['os']['remark'] = '建议使用 Linux 系统以提升程序性能';
        $ret['server']['os']['class'] = 'warning';
    }
    $ret['server']['sapi']['value'] = $_SERVER['SERVER_SOFTWARE'];
    if (PHP_SAPI == 'isapi') {
        $ret['server']['sapi']['remark'] = '建议使用 Apache 或 Nginx 以提升程序性能';
        $ret['server']['sapi']['class'] = 'warning';
    }
    $ret['server']['php']['value'] = PHP_VERSION;
    $ret['server']['dir']['value'] = IA_ROOT;
    if (function_exists('disk_free_space')) {
        $ret['server']['disk']['value'] = floor(disk_free_space(IA_ROOT) / (1024 * 1024)) . 'M';
    } else {
        $ret['server']['disk']['value'] = 'unknow';
    }
    $ret['server']['upload']['value'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';

    $ret['php']['version']['value'] = PHP_VERSION;
    $ret['php']['version']['class'] = 'success';
    if (version_compare(PHP_VERSION, '5.3.0') == -1) {
        $ret['php']['version']['class'] = 'danger';
        $ret['php']['version']['failed'] = true;
        $ret['php']['version']['remark'] = 'PHP版本必须为 5.3.0 以上. <a href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58062">详情</a>';
    }

    $ret['php']['pdo']['ok'] = extension_loaded('pdo') && extension_loaded('pdo_mysql');
    if ($ret['php']['pdo']['ok']) {
        $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['pdo']['class'] = 'success';
    } else {
        $ret['php']['pdo']['failed'] = true;
        $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-remove text-warning"></span>';
        $ret['php']['pdo']['class'] = 'warning';
        $ret['php']['pdo']['remark'] = '您的PHP环境不支持PDO, 请开启此扩展. <a target="_blank" href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58074">详情</a>';
    }

    $ret['php']['fopen']['ok'] = @ini_get('allow_url_fopen') && function_exists('fsockopen');
    if ($ret['php']['fopen']['ok']) {
        $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
    } else {
        $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
    }

    $ret['php']['curl']['ok'] = extension_loaded('curl') && function_exists('curl_init');
    if ($ret['php']['curl']['ok']) {
        $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['curl']['class'] = 'success';
    } else {
        $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['curl']['class'] = 'danger';
        $ret['php']['curl']['remark'] = '您的PHP环境不支持cURL, 也不支持 allow_url_fopen, 系统无法正常运行. <a target="_blank" href="http://bbs.yidaoit.cn/thread-26119-1-1.html">详情</a>';
        $ret['php']['curl']['failed'] = true;
    }

    $ret['php']['ssl']['ok'] = extension_loaded('openssl');
    if ($ret['php']['ssl']['ok']) {
        $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['ssl']['class'] = 'success';
    } else {
        $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['ssl']['class'] = 'danger';
        $ret['php']['ssl']['failed'] = true;
        $ret['php']['ssl']['remark'] = '没有启用OpenSSL, 将无法访问公众平台的接口, 系统无法正常运行. <a target="_blank" href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58109">详情</a>';
    }

    $ret['php']['gd']['ok'] = extension_loaded('gd');
    if ($ret['php']['gd']['ok']) {
        $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['gd']['class'] = 'success';
    } else {
        $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['gd']['class'] = 'danger';
        $ret['php']['gd']['failed'] = true;
        $ret['php']['gd']['remark'] = '没有启用GD, 将无法正常上传和压缩图片, 系统无法正常运行. <a target="_blank" href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58110">详情</a>';
    }

    $ret['php']['dom']['ok'] = class_exists('DOMDocument');
    if ($ret['php']['dom']['ok']) {
        $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['dom']['class'] = 'success';
    } else {
        $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['dom']['class'] = 'danger';
        $ret['php']['dom']['failed'] = true;
        $ret['php']['dom']['remark'] = '没有启用DOMDocument, 将无法正常安装使用模块, 系统无法正常运行. <a target="_blank" href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a>';
    }

    $ret['php']['session']['ok'] = ini_get('session.auto_start');
    if ($ret['php']['session']['ok'] == 0 || strtolower($ret['php']['session']['ok']) == 'off') {
        $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['session']['class'] = 'success';
    } else {
        $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['session']['class'] = 'danger';
        $ret['php']['session']['failed'] = true;
        $ret['php']['session']['remark'] = '系统session.auto_start开启, 将无法正常注册会员, 系统无法正常运行. <a target="_blank" href="http://bbs.yidaoit.cn/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a>';
    }

    $ret['php']['asp_tags']['ok'] = ini_get('asp_tags');
    if (empty($ret['php']['asp_tags']['ok']) || strtolower($ret['php']['asp_tags']['ok']) == 'off') {
        $ret['php']['asp_tags']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['asp_tags']['class'] = 'success';
    } else {
        $ret['php']['asp_tags']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['asp_tags']['class'] = 'danger';
        $ret['php']['asp_tags']['failed'] = true;
        $ret['php']['asp_tags']['remark'] = '请禁用可以使用ASP 风格的标志，配置php.ini中asp_tags = Off';
    }

    $ret['write']['root']['ok'] = local_writeable(IA_ROOT . '/');
    if ($ret['write']['root']['ok']) {
        $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['write']['root']['class'] = 'success';
    } else {
        $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['write']['root']['class'] = 'danger';
        $ret['write']['root']['failed'] = true;
        $ret['write']['root']['remark'] = '本地目录无法写入, 将无法使用自动更新功能, 系统无法正常运行.  <a href="http://bbs.yidaoit.cn/">详情</a>';
    }
    $ret['write']['data']['ok'] = local_writeable(IA_ROOT . '/data');
    if ($ret['write']['data']['ok']) {
        $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['write']['data']['class'] = 'success';
    } else {
        $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['write']['data']['class'] = 'danger';
        $ret['write']['data']['failed'] = true;
        $ret['write']['data']['remark'] = 'data目录无法写入, 将无法写入配置文件, 系统无法正常安装. ';
    }

    $ret['continue'] = true;
    foreach ($ret['php'] as $opt) {
        if ($opt['failed']) {
            $ret['continue'] = false;
            break;
        }
    }
    if ($ret['write']['failed']) {
        $ret['continue'] = false;
    }
    tpl_install_env($ret);
}
if ($action == 'db') {
    if ($ispost) {
        if ($_POST['do'] != 'continue') {
            setcookie('action', 'env');
            header('location: ?refresh');
            exit();
        }
        $family = $_POST['family'] == 'x' ? 'x' : 'v';
        $db = $_POST['db'];
        $user = $_POST['user'];
        try {
            $pieces = explode(':', $db['server']);
            $db['server'] = $pieces[0];
            $db['port'] = !empty($pieces[1]) ? $pieces[1] : '3306';
            $link = new PDO("mysql:host={$db['server']};port={$db['port']}", $db['username'],
                $db['password']);    // dns可以没有dbname
            $link->exec("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
            $link->exec("SET sql_mode=''");
            if ($link->errorCode() != '00000') {
                $errorInfo = $link->errorInfo();
                $error = $errorInfo[2];
            } else {
                $statement = $link->query("SHOW DATABASES LIKE '{$db['name']}';");
                $fetch = $statement->fetch();
                if (empty($fetch)) {
                    if (substr($link->getAttribute(PDO::ATTR_SERVER_VERSION), 0, 3) > '4.1') {
                        $link->query("CREATE DATABASE IF NOT EXISTS `{$db['name']}` DEFAULT CHARACTER SET utf8");
                    } else {
                        $link->query("CREATE DATABASE IF NOT EXISTS `{$db['name']}`");
                    }
                }
                $statement = $link->query("SHOW DATABASES LIKE '{$db['name']}';");
                $fetch = $statement->fetch();
                if (empty($fetch)) {
                    $error .= "数据库不存在且创建数据库失败. <br />";
                }
                if ($link->errorCode() != '00000') {
                    $errorInfo = $link->errorInfo();
                    $error .= $errorInfo[2];
                }
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            if (strpos($error, 'Access denied for user') !== false) {
                $error = '您的数据库访问用户名或是密码错误. <br />';
            } else {
                $error = iconv('gbk', 'utf8', $error);
            }
        }
        if (empty($error)) {
            $link->exec("USE {$db['name']}");
            $statement = $link->query("SHOW TABLES LIKE '{$db['prefix']}%';");
            if ($statement->fetch()) {
                $error = '您的数据库不为空，请重新建立数据库或是清空该数据库或更改表前缀！';
            }
        }
        if (empty($error)) {
            $config = local_config();
            $cookiepre = local_salt(4) . '_';
            $authkey = local_salt(8);
            $config = str_replace(array(
                '{db-server}',
                '{db-username}',
                '{db-password}',
                '{db-port}',
                '{db-name}',
                '{db-tablepre}',
                '{cookiepre}',
                '{authkey}',
                '{attachdir}'
            ), array(
                $db['server'],
                $db['username'],
                $db['password'],
                $db['port'],
                $db['name'],
                $db['prefix'],
                $cookiepre,
                $authkey,
                'attachment'
            ), $config);
            $verfile = IA_ROOT . '/framework/version.inc.php';
            $dbfile = IA_ROOT . '/data/db.php';

            if ($_POST['type'] == 'remote') {
                $link = null;
                $ins = remote_install();
                if (empty($ins)) {
                    die('<script type="text/javascript">alert("连接不到服务器, 请稍后重试！");history.back();</script>');
                }
                if ($ins == 'error') {
                    die('<script type="text/javascript">alert("版本错误，请确认是否为一道宝最新版安装文件！");history.back();</script>');
                }

                $link = new PDO("mysql:dbname={$db['name']};host={$db['server']};port={$db['port']}", $db['username'],
                    $db['password']);
                $link->exec("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
                $link->exec("SET sql_mode=''");

                $tmpfile = IA_ROOT . '/we7source.tmp';
                file_put_contents($tmpfile, $ins);

                $zip = new ZipArchive;
                $res = $zip->open($tmpfile);

                if ($res === true) {
                    $zip->extractTo(IA_ROOT);
                    $zip->close();
                } else {
                    die('<script type="text/javascript">alert("安装失败，请确认当前目录是否有写入权限！");history.back();</script>');
                }
                unlink($tmpfile);
            }

            if (file_exists(IA_ROOT . '/index.php') && is_dir(IA_ROOT . '/web') && file_exists($verfile) && file_exists($dbfile)) {
                $dat = require $dbfile;
                if (empty($dat) || !is_array($dat)) {
                    die('<script type="text/javascript">alert("安装包不正确, 数据安装脚本缺失.");history.back();</script>');
                }
                foreach ($dat['schemas'] as $schema) {
                    local_run($schema);
                }
                foreach ($dat['datas'] as $data) {
                    local_run($data);
                }
            } else {
                die('<script type="text/javascript">alert("你正在使用本地安装, 但未下载完整安装包, 请从一道宝官网下载完整安装包后重试.");history.back();</script>');
            }

            $salt = local_salt(8);
            $password = sha1("{$user['password']}-{$salt}-{$authkey}");
            $link->exec("INSERT INTO {$db['prefix']}users (username, password, salt, joindate, groupid) VALUES('{$user['username']}', '{$password}', '{$salt}', '" . time() . "', 1)");
            local_mkdirs(IA_ROOT . '/data');
            file_put_contents(IA_ROOT . '/data/config.php', $config);
            touch(IA_ROOT . '/data/install.lock');
            setcookie('action', 'finish');
            header('location: ?refresh');
            exit();
        }
    }
    tpl_install_db($error);

}
if ($action == 'finish') {
    setcookie('action', '', -10);
    $dbfile = IA_ROOT . '/data/db.php';
    @unlink($dbfile);
    define('IN_SYS', true);
    require IA_ROOT . '/framework/bootstrap.inc.php';
    require IA_ROOT . '/web/common/bootstrap.sys.inc.php';
    $_W['uid'] = $_W['isfounder'] = 1;
    load()->web('common');
    load()->web('template');
    load()->model('setting');
    load()->model('cache');

    cache_build_frame_menu();
    cache_build_setting();
    cache_build_users_struct();
    cache_build_module_subscribe_type();
    tpl_install_finish();
}

function local_writeable($dir)
{
    $writeable = 0;
    if (!is_dir($dir)) {
        @mkdir($dir, 0777);
    }
    if (is_dir($dir)) {
        if ($fp = fopen("$dir/test.txt", 'w')) {
            fclose($fp);
            unlink("$dir/test.txt");
            $writeable = 1;
        } else {
            $writeable = 0;
        }
    }
    return $writeable;
}

function local_salt($length = 8)
{
    $result = '';
    while (strlen($result) < $length) {
        $result .= sha1(uniqid('', true));
    }
    return substr($result, 0, $length);
}

function local_config()
{
    $cfg = <<<EOF
<?php
defined('IN_IA') or exit('Access Denied');

\$config = array();

\$config['db']['master']['host'] = '{db-server}';
\$config['db']['master']['username'] = '{db-username}';
\$config['db']['master']['password'] = '{db-password}';
\$config['db']['master']['port'] = '{db-port}';
\$config['db']['master']['database'] = '{db-name}';
\$config['db']['master']['charset'] = 'utf8';
\$config['db']['master']['pconnect'] = 0;
\$config['db']['master']['tablepre'] = '{db-tablepre}';

\$config['db']['slave_status'] = false;
\$config['db']['slave']['1']['host'] = '';
\$config['db']['slave']['1']['username'] = '';
\$config['db']['slave']['1']['password'] = '';
\$config['db']['slave']['1']['port'] = '3307';
\$config['db']['slave']['1']['database'] = '';
\$config['db']['slave']['1']['charset'] = 'utf8';
\$config['db']['slave']['1']['pconnect'] = 0;
\$config['db']['slave']['1']['tablepre'] = 'ims_';
\$config['db']['slave']['1']['weight'] = 0;

\$config['db']['common']['slave_except_table'] = array('core_sessions');

// --------------------------  CONFIG COOKIE  --------------------------- //
\$config['cookie']['pre'] = '{cookiepre}';
\$config['cookie']['domain'] = '';
\$config['cookie']['path'] = '/';

// --------------------------  CONFIG SETTING  --------------------------- //
\$config['setting']['charset'] = 'utf-8';
\$config['setting']['cache'] = 'mysql';
\$config['setting']['timezone'] = 'Asia/Shanghai';
\$config['setting']['memory_limit'] = '256M';
\$config['setting']['filemode'] = 0644;
\$config['setting']['authkey'] = '{authkey}';
\$config['setting']['founder'] = '1';
\$config['setting']['development'] = 0;
\$config['setting']['referrer'] = 0;

// --------------------------  CONFIG UPLOAD  --------------------------- //
\$config['upload']['image']['extentions'] = array('gif', 'jpg', 'jpeg', 'png');
\$config['upload']['image']['limit'] = 5000;
\$config['upload']['attachdir'] = '{attachdir}';
\$config['upload']['audio']['extentions'] = array('mp3');
\$config['upload']['audio']['limit'] = 5000;

// --------------------------  CONFIG MEMCACHE  --------------------------- //
\$config['setting']['memcache']['server'] = '';
\$config['setting']['memcache']['port'] = 11211;
\$config['setting']['memcache']['pconnect'] = 1;
\$config['setting']['memcache']['timeout'] = 30;
\$config['setting']['memcache']['session'] = 1;

// --------------------------  CONFIG REDIS  --------------------------- //
\$config['setting']['redis']['server'] = 'redis';
\$config['setting']['redis']['port'] = 6379;
\$config['setting']['redis']['pconnect'] = 0;
\$config['setting']['redis']['requirepass'] = '';
\$config['setting']['redis']['timeout'] = 1;

// --------------------------  CONFIG PROXY  --------------------------- //
\$config['setting']['proxy']['host'] = '';
\$config['setting']['proxy']['auth'] = '';
EOF;
    return trim($cfg);
}

function local_mkdirs($path)
{
    if (!is_dir($path)) {
        local_mkdirs(dirname($path));
        mkdir($path);
    }
    return is_dir($path);
}

function local_run($sql)
{
    global $link;

    $query = trim($sql);
    if ($query) {
        $link->exec($query);
        if ($link->errorCode() != '00000') {
            $errorInfo = $link->errorInfo();
            echo $errorInfo[0] . ": " . $errorInfo[2] . "<br />";
            exit($query);
        }
    }
}

function local_create_sql($schema)
{
    $pieces = explode('_', $schema['charset']);
    $charset = $pieces[0];
    $engine = $schema['engine'];
    $sql = "CREATE TABLE IF NOT EXISTS `{$schema['tablename']}` (\n";
    foreach ($schema['fields'] as $value) {
        if (!empty($value['length'])) {
            $length = "({$value['length']})";
        } else {
            $length = '';
        }

        $signed = empty($value['signed']) ? ' unsigned' : '';
        if (empty($value['null'])) {
            $null = ' NOT NULL';
        } else {
            $null = '';
        }
        if (isset($value['default'])) {
            $default = " DEFAULT '" . $value['default'] . "'";
        } else {
            $default = '';
        }
        if ($value['increment']) {
            $increment = ' AUTO_INCREMENT';
        } else {
            $increment = '';
        }

        $sql .= "`{$value['name']}` {$value['type']}{$length}{$signed}{$null}{$default}{$increment},\n";
    }
    foreach ($schema['indexes'] as $value) {
        $fields = implode('`,`', $value['fields']);
        if ($value['type'] == 'index') {
            $sql .= "KEY `{$value['name']}` (`{$fields}`),\n";
        }
        if ($value['type'] == 'unique') {
            $sql .= "UNIQUE KEY `{$value['name']}` (`{$fields}`),\n";
        }
        if ($value['type'] == 'primary') {
            $sql .= "PRIMARY KEY (`{$fields}`),\n";
        }
    }
    $sql = rtrim($sql);
    $sql = rtrim($sql, ',');

    $sql .= "\n) ENGINE=$engine DEFAULT CHARSET=$charset;\n\n";
    return $sql;
}

function remote_install()
{
    global $family;
    $token = '';
    $pars = array();
    $pars['host'] = $_SERVER['HTTP_HOST'];
    $pars['version'] = '1.0';
    $pars['type'] = 'install';
    $pars['method'] = 'application.install';
    $url = $_SERVER['HTTP_HOST'] . '/gateway.php';
    $urlset = parse_url($url);
    $cloudip = gethostbyname($urlset['host']);
    $headers[] = "Host: {$urlset['host']}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlset['scheme'] . '://' . $cloudip . $urlset['path']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($pars, '', '&'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $content = curl_exec($ch);
    curl_close($ch);

    if (empty($content)) {
        return showerror(-1, '获取安装信息失败，可能是由于网络不稳定，请重试。');
    }

    return $content;
}

function tpl_frame()
{
    global $action, $actions;
    $action = $_COOKIE['action'];
    $step = array_search($action, $actions);
    $steps = array();
    for ($i = 0; $i <= $step; $i++) {
        if ($i == $step) {
            $steps[$i] = ' list-group-item-info';
        } else {
            $steps[$i] = ' list-group-item-success';
        }
    }
    $progress = $step * 25 + 25;
    $content = ob_get_contents();
    ob_clean();
    $tpl = <<<EOF
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装系统 - 一道宝 - 公众平台自助开源引擎</title>
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<style>
			html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
			.pager li.previous a{margin-right:10px;}
			.header a{color:#FFF;}
			.header a:hover{color:#428bca;}
			.footer{padding:10px;}
			.footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
		</style>
		<!--[if lt IE 9]>
		  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background-color:#28b0e4;">
		<div class="container" style="width:1200px;">
			<div class="header" style="margin:15px auto;">
				<ul class="nav nav-pills pull-right" role="tablist">
					<li role="presentation" class="active"><a href="javascript:;">安装一道宝系统</a></li>
					<li role="presentation"><a href="http://www.yidaoit.cn">一道宝官网</a></li>
					<li role="presentation"><a href="http://bbs.yidaoit.cn">访问论坛</a></li>
				</ul>
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAaQAAABfCAMAAACQsENpAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGNQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////mkUNoAAAACF0Uk5TACAwXxBv3++fT3+//0BQj7DPcJDgoPCvgGDQP8AxQWMZWPYYcgAAByFJREFUeJztnOliqjwQhgUpKkRrXSgq33L/V3lEyExWEij0JO08v2pKAsxLkslkYLUiCIIgCIIgCIIgCIIgCIIgCIIgRJIZ2kjXMzRCWMje8o2i0nY9SrZsV5SMsf2cV0UIpNuneVkplR2eJfn7zrOFJGcdx/mv7jeSaQUfvYFPYmnZF579Wr30h7M5Rs3fTlJ+aCode/uKA96eGz31a/fEj7/OdaW/l2LD2Idq96zqDfyJZbx31Z4NZ1ykjfYMEKNIO9NvVJVu3MJ7teTu3Tbvjuw219X+TmpuR23E4zMKn/az3g+oPAe7VedodI1/4Qqzx+Ot2D38zyqSPIqiWE+sHAxpZVOps/AdOgGX86Q2sVo9bPC22c74b7ft0nc+xrLN59gFV1ZA5byI2nnRVCo5L8uU0s8WLAEnj02kcVzbvpSPz9/G3Fk71wpsY54YU7yN1+8JNl5GpOxdr1F6WxoWEUAe86IaXIRu/TPBxpMUYg6RdCu3+DqK6cZQOWb/BZwHdlgFI5JZI4ODY66dm+pqLmxMXOEukmBEOtsqea2MS3NdNRYZE9ldMNsEG/tXsTSggzMlq651fb7gbw9Dn/RzdZTuusHCXbzjcyxpFPj9XdR/NEt6d7AOZnU3vt3AC3XHazOckC63/f5wxVPG7Dy8FkXVwfCfxOMBBgt4wo1mFwkiSjjZw1ph47wbnGT7sfEACsfcldontzHKwH2/oeeXW8D3ZNyIdpEgViEcogeqLGBHgtrQXtQeXnYxRBJarh6WmV8k6Ati5+bzkivAC2pW+NjBqP1zIvIJhm56XzYfCujMLxL4dqLDzZ8Xl0hHgyCwzeIeLGMBB3ULsnnnF6kxNcmrOToDzmfiowTuoWnijZK/LhJ0hsxQzdGTYP65iKXQN3/MeDdRpNKT3NiK8QIOhkKHSCCH5OuAdPloawTKRJHGYhcJ5n7xuffxYVbCUCmJCUsJ7/4eOiNFqluurjoSryp2dxhNKswrvWddOaJ3UFUWszIXx8BZHoj6IAIXSV+HGkV6Af6TF67rgkBVDpLwE0zyG4QOFt9KqWESvfG5SPrx3yUS7p/k3NY8aOqI3e0t54A79UxIm4mk/gr/yJcemEjYlRgrMrF9l41tIsEQ7toPnpd/R5lF5b9XG8GKJITB2eYpE4/13F37STYxfqxIVgw3mmpRcmi70v/lvrubeL7Ntt8DdOcqkUjjbvRrZrkZzuuRT0YijbvRL5oFt5A4d4/9b6dI37uanUOkW+9GhCiSsMHQ8+5RySYSdsyJVzONOUTihChSoWf85NOHO1R82tVMZHmR9HN+n0iZOZnEuRR1DnckkungSSJB4pyYg9LiymINTKTMN6fAyP9SW6GJBBo9e85B9m4cfckpkv9bIaFhFqnQGDS74iraccY4lTcN06NYe3heCswFnxOzSFaWFonvCcF59kKYaDjjJ7Cw0JyEJRLEhIRgqrAVMrgDHliAdU7CEokLIu2tYuLxYHqkc6vC923S8AhLJH6c7CNg816VlbNsfE8eLmaRrDHTZUWCEUveOkr96sNVSJmE2MHiTdo3i+Q6TmEukaAjK+XgPAyOWOa8IAg4VMPnDplZRLop+4rcLpfuZ5skdH795XiYeUU1kdFvWjHnBcHFRPx9lllEshzcHZ28wjwewTehL9jKB0UyD2zwTlp8KQ6AWSQ9ZW6ySG/9xO3zth089UqPM/Wk5L1k5VY6EEZFwdnG+SzeKWnxKDi+p+ahEpxe6THgoGFvuGklwqYEZhrhKivepew3bFWMUQmz66WEBtxsSLUjRZVwvIOulJqOi47FRRqlkvELIPiyMiZ5Y4Rc1BODE70k+Ja0lB8eG7JRFtn0G6ESWvkDvPUUX0eHDiJmKAldBPNfu3SwNb6LHm+4QbiL/BUXW2Zn1l+lRMhuKN8ez4LdFkswz1i8TjEkJ5bn4uZhvB0plT6ZUM4XNlElBZWcCSXW18dbsM+IYojPTXa3VI02JFSod1KuZ/oMj2a/3ngeceiB9H8hkGDrScIXkyRiHeyMqQSb7c6tU/Lgz6W+NyjtELIcSj7bnx/wc6B1q0pisMcyJ60MiUZq1ZgwfoOns+xnsX48pKVf1r4uu2tt3a1q+U3bmnAydGXmebGS379G7059Ieag96VYNTqgRtX5djYPElZ4TxpXS2Dw2hJDvFb9jMHAq/+pUr2KdYWUoSrtx1BWWT1GJnCVRkqDOC4vvUqXU131kI4p4gD/E/KMqjrez93Bk8iHgmTEC3swfCwl0pP96dg0bcb/8WT2CJNzw+4G9V6k9fHZn+7NOe5Xzq+KvZ9m8d4VgjtfUCRi1X4JRdFo1fYmv0EPBhASaWHa0KO+D3Y425aDJhOTSEtT216e29/qc9M0OPve+zyH62t39RDzZxij4xjxNhhBEARBEARBEARBEARBEARBEARBBMQfTi55uLKrEKwAAAAASUVORK5CYII=" />
			</div>
			<div class="row well" style="margin:auto 0;">
				<div class="col-xs-2" style="padding:0; width:14%;">
					<div class="progress" title="安装进度">
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="{$progress}" aria-valuemin="0" aria-valuemax="100" style="width: {$progress}%;">
							{$progress}%
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							安装步骤
						</div>
						<ul class="list-group">
							<a href="javascript:;" class="list-group-item{$steps[0]}"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
							<a href="javascript:;" class="list-group-item{$steps[1]}"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
							<a href="javascript:;" class="list-group-item{$steps[2]}"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
							<a href="javascript:;" class="list-group-item{$steps[3]}"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
						</ul>
					</div>
				</div>
				<div class="col-xs-10">
					{$content}
				</div>
			</div>
			<div class="footer" style="margin:15px auto;">
				<div class="text-center">
					<a href="http://www.yidaoit.cn">关于一道宝</a> &nbsp; &nbsp; <a href="http://bbs.yidaoit.cn">一道宝帮助</a> &nbsp; &nbsp; <a href="http://www.yidaoit.cn">购买授权</a>
				</div>
				<div class="text-center">
					Powered by <a href="http://www.yidaoit.cn"><b>一道宝</b></a> v1.x &copy; 2018 <a href="http://www.yidaoit.cn">www.yidaoit.cn</a>
				</div>
			</div>
		</div>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>
EOF;
    echo trim($tpl);
}

function tpl_install_license()
{
    echo <<<EOF
		<div class="panel panel-default">
			<div class="panel-heading">阅读许可协议</div>
			<div class="panel-body" style="overflow-y:scroll;max-height:400px;line-height:20px;">
				<h3>一道宝8.0商业纯净版安装说明</h3>
				<p>
					<li>本一道宝由一道宝提供</li>
				
				</p>
				
				<p>
					<strong>0x2 版本介绍 </strong>
					<ol>
						<li>0xA 删除所有附件</li>
						<li>0xB 删除测试公众号</li>
						<li>0xC 删除授权和盗版检测</li>
					</ol>
				</p>
				<p>
					<strong>0x3 数据库优化说明 </strong>
					<ol>
						<li>0xA 删除所有数据后自增ID归1</li>
						<li>0xB 删除沉余数据</li>
					</ol>
				</p>
				<p>
					<strong>0x4 对应版本 </strong>
					<ol>
						<li>一道宝1.7.0 20180202150514</li>
					</ol>
				</p>
			</div>
		</div>
		<form class="form-inline" role="form" method="post">
			<ul class="pager">
				<li class="pull-left" style="display:block;padding:5px 10px 5px 0;">
					<div class="checkbox">
						<label>
							<input type="checkbox"> 我已经阅读并同意此协议
						</label>
					</div>
				</li>
				<li class="previous"><a href="javascript:;" onclick="if(jQuery(':checkbox:checked').length == 1){jQuery('form')[0].submit();}else{alert('您必须同意软件许可协议才能安装！')};">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
			</ul>
		</form>
EOF;
    tpl_frame();
}

function tpl_install_env($ret = array())
{
    if (empty($ret['continue'])) {
        $continue = '<li class="previous disabled"><a href="javascript:;">请先解决环境问题后继续</a></li>';
    } else {
        $continue = '<li class="previous"><a href="javascript:;" onclick="$(\'#do\').val(\'continue\');$(\'form\')[0].submit();">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>';
    }
    echo <<<EOF
		<div class="panel panel-default">
			<div class="panel-heading">服务器信息</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">参数</th>
					<th>值</th>
					<th></th>
				</tr>
				<tr class="{$ret['server']['os']['class']}">
					<td>服务器操作系统</td>
					<td>{$ret['server']['os']['value']}</td>
					<td>{$ret['server']['os']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['sapi']['class']}">
					<td>Web服务器环境</td>
					<td>{$ret['server']['sapi']['value']}</td>
					<td>{$ret['server']['sapi']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['php']['class']}">
					<td>PHP版本</td>
					<td>{$ret['server']['php']['value']}</td>
					<td>{$ret['server']['php']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['dir']['class']}">
					<td>程序安装目录</td>
					<td>{$ret['server']['dir']['value']}</td>
					<td>{$ret['server']['dir']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['disk']['class']}">
					<td>磁盘空间</td>
					<td>{$ret['server']['disk']['value']}</td>
					<td>{$ret['server']['disk']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['upload']['class']}">
					<td>上传限制</td>
					<td>{$ret['server']['upload']['value']}</td>
					<td>{$ret['server']['upload']['remark']}</td>
				</tr>
			</table>
		</div>

		<div class="alert alert-info">PHP环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</div>
		<div class="panel panel-default">
			<div class="panel-heading">PHP环境要求</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">选项</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="{$ret['php']['version']['class']}">
					<td>PHP版本</td>
					<td>5.3或者5.3以上</td>
					<td>{$ret['php']['version']['value']}</td>
					<td>{$ret['php']['version']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['curl']['class']}">
					<td>cURL</td>
					<td>支持</td>
					<td>{$ret['php']['curl']['value']}</td>
					<td>{$ret['php']['curl']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['pdo']['class']}">
					<td>PDO</td>
					<td>支持</td>
					<td>{$ret['php']['pdo']['value']}</td>
					<td>{$ret['php']['pdo']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['ssl']['class']}">
					<td>openSSL</td>
					<td>支持</td>
					<td>{$ret['php']['ssl']['value']}</td>
					<td>{$ret['php']['ssl']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['gd']['class']}">
					<td>GD2</td>
					<td>支持</td>
					<td>{$ret['php']['gd']['value']}</td>
					<td>{$ret['php']['gd']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['dom']['class']}">
					<td>DOM</td>
					<td>支持</td>
					<td>{$ret['php']['dom']['value']}</td>
					<td>{$ret['php']['dom']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['session']['class']}">
					<td>session.auto_start</td>
					<td>关闭</td>
					<td>{$ret['php']['session']['value']}</td>
					<td>{$ret['php']['session']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['asp_tags']['class']}">
					<td>asp_tags</td>
					<td>关闭</td>
					<td>{$ret['php']['asp_tags']['value']}</td>
					<td>{$ret['php']['asp_tags']['remark']}</td>
				</tr>
			</table>
		</div>

		<div class="alert alert-info">系统要求一道宝整个安装目录必须可写, 才能使用一道宝所有功能。</div>
		<div class="panel panel-default">
			<div class="panel-heading">目录权限监测</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">目录</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="{$ret['write']['root']['class']}">
					<td>/</td>
					<td>整目录可写</td>
					<td>{$ret['write']['root']['value']}</td>
					<td>{$ret['write']['root']['remark']}</td>
				</tr>
				<tr class="{$ret['write']['data']['class']}">
					<td>/</td>
					<td>data目录可写</td>
					<td>{$ret['write']['data']['value']}</td>
					<td>{$ret['write']['data']['remark']}</td>
				</tr>
			</table>
		</div>
		<form class="form-inline" role="form" method="post">
			<input type="hidden" name="do" id="do" />
			<ul class="pager">
				<li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
				{$continue}
			</ul>
		</form>
EOF;
    tpl_frame();
}

function tpl_install_db($error = '')
{
    if (!empty($error)) {
        $message = '<div class="alert alert-danger">发生错误: ' . $error . '</div>';
    }
    $insTypes = array();
    if (file_exists(IA_ROOT . '/index.php') && is_dir(IA_ROOT . '/app') && is_dir(IA_ROOT . '/web')) {
        $insTypes['local'] = ' checked="checked"';
    } else {
        $insTypes['remote'] = ' checked="checked"';
    }
    if (!empty($_POST['type'])) {
        $insTypes = array();
        $insTypes[$_POST['type']] = ' checked="checked"';
    }
    $disabled = empty($insTypes['local']) ? ' disabled="disabled"' : '';
    echo <<<EOF
	{$message}
	<form class="form-horizontal" method="post" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">安装选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">安装方式</label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input type="radio" name="type" value="local"{$insTypes['local']}{$disabled}> 离线安装
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">数据库选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库主机</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[server]" value="127.0.0.1">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库用户</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[username]" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[password]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">表前缀</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[prefix]" value="ims_">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库名称</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[name]" value="">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">管理选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员账号</label>
					<div class="col-sm-4">
						<input class="form-control" type="username" name="user[username]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password" name="user[password]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">确认密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password"">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="do" id="do" />
		<ul class="pager">
			<li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
			<li class="previous"><a href="javascript:;" onclick="if(check(this)){jQuery('#do').val('continue');if($('input[name=type]:checked').val() == 'remote'){alert('在线安装时，安装程序会下载精简版快速完成安装，完成后请务必注册云服务更新到完整版。')}$('form')[0].submit();}">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
		</ul>
	</form>
	<script>
		var lock = false;
		function check(obj) {
			if(lock) {
				return;
			}
			$('.form-control').parent().parent().removeClass('has-error');
			var error = false;
			$('.form-control').each(function(){
				if($(this).val() == '') {
					$(this).parent().parent().addClass('has-error');
					this.focus();
					error = true;
				}
			});
			if(error) {
				alert('请检查未填项');
				return false;
			}
			if($(':password').eq(0).val() != $(':password').eq(1).val()) {
				$(':password').parent().parent().addClass('has-error');
				alert('确认密码不正确.');
				return false;
			}
			lock = true;
			$(obj).parent().addClass('disabled');
			$(obj).html('正在执行安装');
			return true;
		}
	</script>
EOF;
    tpl_frame();
}

function tpl_install_finish()
{
    $modules = get_store_module();
    $themes = get_store_theme();
    echo <<<EOF
	<div class="page-header"><h3>安装完成</h3></div>
	<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> 一道宝为你提供优质的CMS！</div>
	<div class="alert alert-success">
		恭喜您!已成功安装“一道宝 - 公众平台自助开源引擎”系统，您现在可以: <a target="_blank" class="btn btn-success" href="./web/index.php">访问网站首页</a>
	</div>
EOF;
    tpl_frame();
}

function tpl_resources()
{
    static $res = array(
        'logo' => ''
    );
    return $res;
}

function showerror($errno, $message = '')
{
    return array(
        'errno' => $errno,
        'error' => $message,
    );
}

function get_store_module()
{
    load()->func('communication');
    $response = ihttp_request(APP_STORE_API, array('controller' => 'store', 'action' => 'api', 'do' => 'module'));
    $response = json_decode($response['content'], true);

    $modules = '';
    foreach ($response['message'] as $key => $module) {
        if ($key % 3 < 1) {
            $modules .= '</tr><tr>';
        }
        $module['detail_link'] = APP_STORE_URL . trim($module['detail_link'], '.');
        $modules .= '<td>';
        $modules .= '<div class="col-sm-4">';
        $modules .= '<a href="' . $module['detail_link'] . '" title="查看详情" target="_blank">';
        $modules .= '<img src="' . $module['logo'] . '"' . ' width="50" height="50" ' . $module['title'] . '" /></a>';
        $modules .= '</div>';
        $modules .= '<div class="col-sm-8">';
        $modules .= '<p><a href="' . $module['detail_link'] . '" title="查看详情" target="_blank">' . $module['title'] . '</a></p>';
        $modules .= '<p>安装量：<span class="text-danger">' . $module['purchases'] . '</span></p>';
        $modules .= '</div>';
        $modules .= '</td>';
    }
    $modules = substr($modules, 5) . '</tr>';

    return $modules;
}

function get_store_theme()
{
    load()->func('communication');
    $response = ihttp_request(APP_STORE_API, array('controller' => 'store', 'action' => 'api', 'do' => 'theme'));
    $response = json_decode($response['content'], true);

    $themes = '<tr><td colspan="' . count($response['message']) . '">';
    $themes .= '<div class="form-group">';
    foreach ($response['message'] as $key => $theme) {
        $theme['detail_link'] = APP_STORE_URL . trim($theme['detail_link'], '.');
        $themes .= '<div class="col-sm-2" style="padding-left: 7px;margin-right: 25px;">';
        $themes .= '<a href="' . $theme['detail_link'] . '" title="查看详情" target="_blank" /><img src="' . $theme['logo'] . '" /></a>';
        $themes .= '<p></p><p class="text-right">';
        $themes .= '<a href="' . $theme['detail_link'] . '" title="查看详情" target="_blank">' . $theme['title'] . '</a></p>';
        $themes .= '</div>';
    }
    $themes .= '</div>';

    return $themes;
}
