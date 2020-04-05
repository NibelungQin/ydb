<?php

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Ydb\Util\DevelopmentUtil;

require_once __DIR__ . '/../vendor/autoload.php';

define('IN_IA', true);
define('STARTTIME', microtime());
define('IA_ROOT', str_replace("\\", '/', dirname(dirname(__FILE__))));
define('MAGIC_QUOTES_GPC',
    (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) || @ini_get('magic_quotes_sybase'));
define('TIMESTAMP', time());

global $_W;

$_W = $_GPC = array();
$configfile = IA_ROOT . "/data/config.php";

if (DevelopmentUtil::isProductionEnvironment()) {
    if (!file_exists($configfile)) {
        if (file_exists(IA_ROOT . '/install.php')) {
            header('Content-Type: text/html; charset=utf-8');
            require IA_ROOT . '/framework/version.inc.php';
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo "·如果你还没安装本程序，请运行<a href='" . (strpos($_SERVER['SCRIPT_NAME'],
                    'web') === false ? './install.php' : '../install.php') . "'> install.php 进入安装&gt;&gt; </a><br/><br/>";
            echo "&nbsp;&nbsp;<a href='http://www.yidaoit.cn' style='font-size:12px' target='_blank'>Power by WE7 " . IMS_VERSION . " &nbsp;一道宝公众平台自助开源引擎</a>";
            exit();
        } else {
            header('Content-Type: text/html; charset=utf-8');
            exit('配置文件不存在或是不可读，请检查“data/config”文件或是重新安装！');
        }
    }

    require $configfile;
} else {
    global $config;
    $config = array();

    $config['db']['master']['host'] = 'mysql';
    $config['db']['master']['username'] = 'root';
    $config['db']['master']['password'] = 'root';
    $config['db']['master']['port'] = '3306';
    $config['db']['master']['database'] = 'ydb_test';
    $config['db']['master']['charset'] = 'utf8';
    $config['db']['master']['pconnect'] = 0;
    $config['db']['master']['tablepre'] = 'ims_';

    $config['db']['slave_status'] = false;
    $config['db']['slave']['1']['host'] = '';
    $config['db']['slave']['1']['username'] = '';
    $config['db']['slave']['1']['password'] = '';
    $config['db']['slave']['1']['port'] = '3307';
    $config['db']['slave']['1']['database'] = '';
    $config['db']['slave']['1']['charset'] = 'utf8';
    $config['db']['slave']['1']['pconnect'] = 0;
    $config['db']['slave']['1']['tablepre'] = 'ims_';
    $config['db']['slave']['1']['weight'] = 0;

    $config['db']['common']['slave_except_table'] = array('core_sessions');

// --------------------------  CONFIG COOKIE  --------------------------- //
    $config['cookie']['pre'] = '679f_';
    $config['cookie']['domain'] = '';
    $config['cookie']['path'] = '/';

// --------------------------  CONFIG SETTING  --------------------------- //
    $config['setting']['charset'] = 'utf-8';
    $config['setting']['cache'] = 'mysql';
    $config['setting']['timezone'] = 'Asia/Shanghai';
    $config['setting']['memory_limit'] = '2G';
    $config['setting']['filemode'] = 0644;
    $config['setting']['authkey'] = '906dacf2';
    $config['setting']['founder'] = '1';
    $config['setting']['development'] = 1;
    $config['setting']['referrer'] = 0;

// --------------------------  CONFIG UPLOAD  --------------------------- //
    $config['upload']['image']['extentions'] = array('gif', 'jpg', 'jpeg', 'png');
    $config['upload']['image']['limit'] = 5000;
    $config['upload']['attachdir'] = 'attachment';
    $config['upload']['audio']['extentions'] = array('mp3');
    $config['upload']['audio']['limit'] = 5000;

// --------------------------  CONFIG MEMCACHE  --------------------------- //
    $config['setting']['memcache']['server'] = '';
    $config['setting']['memcache']['port'] = 11211;
    $config['setting']['memcache']['pconnect'] = 1;
    $config['setting']['memcache']['timeout'] = 30;
    $config['setting']['memcache']['session'] = 1;

// --------------------------  CONFIG REDIS  --------------------------- //
    $config['setting']['redis']['server'] = 'redis-test';
    $config['setting']['redis']['port'] = 6379;
    $config['setting']['redis']['pconnect'] = 0;
    $config['setting']['redis']['requirepass'] = '';
    $config['setting']['redis']['timeout'] = 1;

// --------------------------  CONFIG PROXY  --------------------------- //
    $config['setting']['proxy']['host'] = '';
    $config['setting']['proxy']['auth'] = '';
}

require IA_ROOT . '/framework/version.inc.php';
require IA_ROOT . '/framework/const.inc.php';
require IA_ROOT . '/framework/class/loader.class.php';
load()->func('global');
load()->func('compat');
load()->func('pdo');
load()->classs('account');
load()->model('cache');
load()->model('account');
load()->model('setting');
load()->model('module');
load()->library('agent');
load()->classs('db');
load()->func('communication');

define('CLIENT_IP', getip());

// Prepare logger
try {
    $formatter = new LineFormatter(LineFormatter::SIMPLE_FORMAT, LineFormatter::SIMPLE_DATE);
    $formatter->includeStacktraces(true);
    $handler = new StreamHandler(__DIR__ . '/../logs/development.log', Logger::DEBUG);
    $handler->setFormatter($formatter);
    $ydbLogger = new Logger('ydb');
    $ydbLogger->pushHandler($handler);
} catch (Exception $e) {
}

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = $config['setting']['development'];
$doctrineConfig = Setup::createAnnotationMetadataConfiguration(array(dirname(__DIR__) . "/addons/ewei_shopv2/classes/Entity"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'user' => $config['db']['master']['username'],
    'password' => $config['db']['master']['password'],
    'host' => $config['db']['master']['host'],
    'dbname' => $config['db']['master']['database'],
    'charset' => $config['db']['master']['charset'],
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $doctrineConfig);

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . "/config/"));
$loader->load('services.yml');
$container->compile();
$container->set(EntityManagerInterface::class, $entityManager);
$container->set(ObjectManager::class, $entityManager);
$container->set(LoggerInterface::class, $ydbLogger);

$_W['config'] = $config;
$_W['config']['db']['tablepre'] = !empty($_W['config']['db']['master']['tablepre']) ? $_W['config']['db']['master']['tablepre'] : $_W['config']['db']['tablepre'];
$_W['timestamp'] = TIMESTAMP;
$_W['charset'] = $_W['config']['setting']['charset'];
$_W['clientip'] = CLIENT_IP;

unset($configfile, $config);

define('ATTACHMENT_ROOT', IA_ROOT . '/attachment/');

define('DEVELOPMENT', $_W['config']['setting']['development'] == 1);
define('AUTH_KEY', $_W['config']['setting']['authkey']);
ini_set("error_log", IA_ROOT . "/logs/php_error.log");
if (DEVELOPMENT) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL ^ E_NOTICE);
} else {
    error_reporting(0);
}

if (!in_array($_W['config']['setting']['cache'], array('mysql', 'memcache', 'redis'))) {
    $_W['config']['setting']['cache'] = 'mysql';
}
load()->func('cache');

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set($_W['config']['setting']['timezone']);
}
if (!empty($_W['config']['setting']['memory_limit']) && function_exists('ini_get') && function_exists('ini_set')) {
    if (@ini_get('memory_limit') != $_W['config']['setting']['memory_limit']) {
        @ini_set('memory_limit', $_W['config']['setting']['memory_limit']);
    }
}
if (isset($_W['config']['setting']['https']) && $_W['config']['setting']['https'] == '1') {
    $_W['ishttps'] = $_W['config']['setting']['https'];
} else {
    $_W['ishttps'] = $_SERVER['SERVER_PORT'] == 443 ||
    (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ||
    strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https' ||
    strtolower($_SERVER['HTTP_X_CLIENT_SCHEME']) == 'https' ? true : false;
}

$_W['isajax'] = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
$_W['ispost'] = $_SERVER['REQUEST_METHOD'] == 'POST';

$_W['sitescheme'] = $_W['ishttps'] ? 'https://' : 'http://';
$_W['script_name'] = htmlspecialchars(scriptname());
$sitepath = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
$_W['siteroot'] = htmlspecialchars($_W['sitescheme'] . $_SERVER['HTTP_HOST'] . $sitepath);

if (substr($_W['siteroot'], -1) != '/') {
    $_W['siteroot'] .= '/';
}
$urls = parse_url($_W['siteroot']);
$urls['path'] = str_replace(array('/web', '/app', '/payment/wechat', '/payment/alipay', '/payment/jueqiymf', '/api'),
    '', $urls['path']);
$_W['siteroot'] = $urls['scheme'] . '://' . $urls['host'] . ((!empty($urls['port']) && $urls['port'] != '80') ? ':' . $urls['port'] : '') . $urls['path'];

if (MAGIC_QUOTES_GPC) {
    $_GET = istripslashes($_GET);
    $_POST = istripslashes($_POST);
    $_COOKIE = istripslashes($_COOKIE);
}
foreach ($_GET as $key => $value) {
    if (is_string($value) && !is_numeric($value)) {
        $value = safe_gpc_string($value);
    }
    $_GET[$key] = $_GPC[$key] = $value;
}
$cplen = strlen($_W['config']['cookie']['pre']);
foreach ($_COOKIE as $key => $value) {
    if (substr($key, 0, $cplen) == $_W['config']['cookie']['pre']) {
        $_GPC[substr($key, $cplen)] = $value;
    }
}
unset($cplen, $key, $value);

$_GPC = array_merge($_GPC, $_POST);
$_GPC = ihtmlspecialchars($_GPC);

$_W['siteurl'] = $urls['scheme'] . '://' . $urls['host'] . ((!empty($urls['port']) && $urls['port'] != '80') ? ':' . $urls['port'] : '') . $_W['script_name'] . '?' . http_build_query($_GET,
        '', '&');

if (!$_W['isajax']) {
    $input = file_get_contents("php://input");
    if (!empty($input)) {
        $__input = @json_decode($input, true);
        if (!empty($__input)) {
            $_GPC['__input'] = $__input;
            $_W['isajax'] = true;
        }
    }
    unset($input, $__input);
}

setting_load();
if (empty($_W['setting']['upload'])) {
    $_W['setting']['upload'] = array_merge($_W['config']['upload']);
}

$_W['os'] = Agent::deviceType();
if ($_W['os'] == Agent::DEVICE_MOBILE) {
    $_W['os'] = 'mobile';
} elseif ($_W['os'] == Agent::DEVICE_DESKTOP) {
    $_W['os'] = 'windows';
} else {
    $_W['os'] = 'unknown';
}

$_W['container'] = Agent::browserType();
if (Agent::isMicroMessage() == Agent::MICRO_MESSAGE_YES) {
    $_W['container'] = 'wechat';
} elseif ($_W['container'] == Agent::BROWSER_TYPE_ANDROID) {
    $_W['container'] = 'android';
} elseif ($_W['container'] == Agent::BROWSER_TYPE_IPAD) {
    $_W['container'] = 'ipad';
} elseif ($_W['container'] == Agent::BROWSER_TYPE_IPHONE) {
    $_W['container'] = 'iphone';
} elseif ($_W['container'] == Agent::BROWSER_TYPE_IPOD) {
    $_W['container'] = 'ipod';
} else {
    $_W['container'] = 'unknown';
}

$controller = $_GPC['c'];
$action = $_GPC['a'];
$do = $_GPC['do'];
if (DevelopmentUtil::isProductionEnvironment()) {
    header('Content-Type: text/html; charset=' . $_W['charset']);
}
