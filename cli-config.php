<?php

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Console\Helper\HelperSet;
use Ydb\Util\DevelopmentUtil;

define('IN_IA', true);

require 'vendor/autoload.php';
if (DevelopmentUtil::isTestingEnvironment()) {
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
} else {
    require 'data/config.php';
}

$paths = [__DIR__ . '/addons/ewei_shopv2/classes/Entity/Manual'];
$isDevMode = $config['setting']['development'];

$dbParams = [
    'dbname' => $config['db']['master']['database'],
    'user' => $config['db']['master']['username'],
    'password' => $config['db']['master']['password'],
    'host' => $config['db']['master']['host'],
    'port' => $config['db']['master']['port'],
    'charset' => $config['db']['master']['charset'],
    'driver' => 'pdo_mysql'
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return new HelperSet([
    'em' => new EntityManagerHelper($entityManager),
    'db' => new ConnectionHelper($entityManager->getConnection()),
]);
