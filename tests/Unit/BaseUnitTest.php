<?php
declare(strict_types=1);

namespace Ydb\Test\Unit;

use Doctrine\Common\Persistence\ObjectManager;
use PDO;
use PHPUnit\Framework\TestCase;
use RuntimeException;

abstract class BaseUnitTest extends TestCase
{
    /**
     * @var ObjectManager $objectManager
     */
    protected $objectManager;

    public static function setUpBeforeClass(): void
    {
        global $container;

        parent::setUpBeforeClass();
        $db = [
            'host' => 'mysql',
            'username' => 'root',
            'password' => 'root',
            'port' => '3306',
            'database' => 'ydb_test',
            'charset' => 'utf8',
            'pconnect' => 0,
            'tablepre' => 'ims_',
        ];
        $link = new PDO("mysql:host={$db['host']};port={$db['port']}", $db['username'], $db['password']);
        $link->exec("DROP DATABASE IF EXISTS `{$db['database']}`");
        $link->exec('SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary');
        $link->exec("SET sql_mode=''");
        $link->exec("CREATE DATABASE IF NOT EXISTS `{$db['database']}` DEFAULT CHARACTER SET utf8");
        $link->exec("USE `{$db['database']}`");

        $dat = require __DIR__ . '/../../data/db.php';
        foreach ($dat['schemas'] as $schema) {
            if (empty(trim($schema))) {
                continue;
            }
            $link->exec($schema);
            if ($link->errorCode() !== '00000') {
                $errorInfo = $link->errorInfo();
                throw new RuntimeException($errorInfo[2]);
            }

        }
        foreach ($dat['datas'] as $data) {
            $link->exec($data);
        }

        require __DIR__ . '/../../framework/bootstrap.inc.php';
        require_once __DIR__ . '/../../addons/ewei_shopv2/core/inc/functions.php';
        require __DIR__ . '/../../addons/ewei_shopv2/install.php';

        $migrationTable = include __DIR__ . '/../../migrations.php';
        $tableName = $migrationTable['table_name'];
        $columnName = $migrationTable['column_name'];
        $columnLength = $migrationTable['column_length'];
        $executedAt = $migrationTable['executed_at_column_name'];
        $link->exec("
            CREATE TABLE `$tableName` (
                `$columnName` varchar($columnLength) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `$executedAt` datetime(0) NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                PRIMARY KEY (`version`) USING BTREE
            ) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;
        ");
        if ($link->errorCode() !== '00000') {
            $errorInfo = $link->errorInfo();
            throw new RuntimeException($errorInfo[2]);
        }

        $migrationSql = file_get_contents(__DIR__ . '/../../data/migration.sql');
        $schemas = explode(";\n", $migrationSql);
        foreach ($schemas as $schema) {
            if (empty(trim($schema))) {
                continue;
            }
            $link->exec($schema);
            if ($link->errorCode() !== '00000') {
                $errorInfo = $link->errorInfo();
                throw new RuntimeException($errorInfo[2]);
            }
        }
    }

    protected function setUp(): void
    {
        global $container;
        global $_W;
        global $_GPC;
        global $acl;

        parent::setUp();

        $this->objectManager = $container->get(ObjectManager::class);

        redis()->flushDB();

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        $_SESSION = [];
        $_W = [];
        $_GPC = [];
        $acl = [];
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = '';
        $_SERVER['HTTP_USER_AGENT'] = '';
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        ini_set('memory_limit', '2G');
        set_time_limit(0);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        ini_set('memory_limit', '2G');
        set_time_limit(0);
    }
}