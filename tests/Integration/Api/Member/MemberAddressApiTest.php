<?php
declare(strict_types=1);

namespace Ydb\Test\Integration\Api\Member;

use GuzzleHttp\Client;
use PDO;
use PHPUnit\Framework\TestCase;
use RuntimeException;

// !!! fix me
class MemberAddressApiTest extends TestCase
{
    /**
     * @var Client
     */
    private $http;

    public static function setUpBeforeClass(): void
    {
        global $container;
        global $_W;
        global $_GPC;

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

        $dat = require __DIR__ . '/../../../../data/db.php';
        foreach ($dat['schemas'] as $schema) {
            if (empty($schema)) {
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

        require_once __DIR__ . '/../../../../framework/bootstrap.inc.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/install.php';
        pdo_run('TRUNCATE TABLE `ims_ewei_shop_member`');
        pdo_run("INSERT INTO ims_ewei_shop_member VALUE( '1', '1', '0', '0', '0', '0',
         'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI', '', '', '', '', NULL, '1569310800', '0', '0', '0', '0', '0', NULL,
          'madhatter', '0.00', '0.00', '', '', '', '1',
           'https://wx.qlogo.cn/mmopen/vi_32/DZnZnfFulb8guw17kLzqWOOFeNgjPM34CIhM0jvrHjglRJYSUuanbLjmFEwft93ic401rB9x8tkPU137guiaTH6Q/132',
            '', '', '', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '', '0.00', '0',
             '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, 
             '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '0', 'sns_wa', NULL,
              NULL, '0', '0', '', 'o2nA_5dJg95XAwQFxrNIGptIWmWI', '', '', '0', '', '', '', '0', '0.00', '0.00', NULL,
               '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '0', ',-1,', '1');");
    }

    public function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://localhost:8080/app/']);
        pdo_run('TRUNCATE TABLE `ims_ewei_shop_member_address`');
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    private function getAddressList()
    {
        global $_W;
        global $_GPC;
        global $container;
        $this->addAddress();

        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.get_list';
        $_GET['comefrom'] = 'wxapp';
        $_GET['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_GET['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        return json_decode($this->getActualOutput(), true);
    }

    public function testGetList(): void
    {
        global $_W;
        global $_GPC;
        global $container;

        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.get_list';
        $_GET['comefrom'] = 'wxapp';
        $_GET['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_GET['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        $result = json_decode($this->getActualOutput(), true);
        $this->assertEquals(0, $result->error);
    }

    public function testGetAddressDetail(): void
    {
        $this->addAddress();
        global $_W;
        global $_GPC;
        global $container;

        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.get_detail';
        $_GET['comefrom'] = 'wxapp';
        $_GET['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_GET['id'] = 1;
        $_GET['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        $result = json_decode($this->getActualOutput(), true);
        $this->assertEquals(0, $result->error);
    }


    public function testSetDefaultAddress(): void
    {
        $body = $this->getAddressList();
        $id = $body['list'][0]['id'];

        global $_W;
        global $_GPC;
        global $container;

        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.set_default';
        $_GET['comefrom'] = 'wxapp';
        $_GET['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_GET['id'] = $id;
        $_GET['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        $result = json_decode($this->getActualOutput(), true);
        $this->assertEquals(0, $result->error);
    }

    private function addAddress(): void
    {
        global $_W;
        global $_GPC;
        global $container;
        for ($i = 0; $i < 3; $i++) {
            $_GET['i'] = '1';
            $_GET['r'] = 'member.address.submit';
            $_POST['comefrom'] = 'wxapp';
            $_POST['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
            $_POST['address'] = '17楼';
            $_POST['realname'] = '鲁班';
            $_POST['mobile'] = '15201010001';
            $_POST['province'] = '北京市';
            $_POST['city'] = '北京市辖区';
            $_POST['area'] = '东城区';
            $_POST['timestamp'] = (string)time();
            require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        }
    }

    public function testAddAddress(): void
    {

        global $_W;
        global $_GPC;
        global $container;
        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.submit';
        $_POST['comefrom'] = 'wxapp';
        $_POST['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_POST['address'] = '17楼';
        $_POST['realname'] = '鲁班';
        $_POST['mobile'] = '15201010001';
        $_POST['province'] = '北京市';
        $_POST['city'] = '北京市辖区';
        $_POST['area'] = '东城区';
        $_POST['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        $result = json_decode($this->getActualOutput(), true);
        $this->assertEquals(0, $result->error);
    }

    public function testDeleteAddress(): void
    {
        $body = $this->getAddressList();
        $total = (int)$body['total'];
        $id = $body['list'][0]['id'];

        global $_W;
        global $_GPC;
        global $container;
        $_GET['i'] = '1';
        $_GET['r'] = 'member.address.delete';
        $_GET['comefrom'] = 'wxapp';
        $_GET['openid'] = 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI';
        $_GET['id'] = $id;
        $_GET['timestamp'] = (string)time();
        require __DIR__ . '/../../../../app/ewei_shopv2_api.php';
        $result = json_decode($this->getActualOutput(), true);
        $this->assertEquals(0, $result->error);

        $this->getAddressList();
    }
}