<?php
declare(strict_types=1);

namespace Ydb\Test\Funcational\Api\Member;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class MemberAddressApiTest extends TestCase
{
    /**
     * @var Client
     */
    private $http;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        ini_set('memory_limit', '2G');
    }

    public function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://localhost:8080/app/']);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    private function getAddressList()
    {
        $response = $this->http->get('ewei_shopv2_api.php?i=1&r=member.address.get_list&comefrom=wxapp'
            . '&openid=sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI&mid=&merchid=&authkey=&timestamp=1569477982099');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function testGetList(): void
    {
        $response = $this->http->get('ewei_shopv2_api.php?i=1&r=member.address.get_list&comefrom=wxapp'
            . '&openid=sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI&mid=&merchid=&authkey=&timestamp=1569477982099');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAddressDetail(): void
    {
        $response = $this->http->get('ewei_shopv2_api.php?i=1&r=member.address.get_detail&id=1&comefrom=wxapp'
            . '&openid=sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI&mid=&merchid=&authkey=&timestamp=15694973');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSetDefaultAddress(): void
    {
        $this->addAddress(10);
        $body = $this->getAddressList();
        $id = $body['list'][0]['id'];
        $response = $this->http->post('ewei_shopv2_api.php?r=member.address.set_default',
            [
                'form_params' => [
                    'i' => 1,
                    'openid' => 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI',
                    'id' => $id,
                    'comefrom' => 'wxapp',
                    'mid' => '',
                    'merchid' => '',
                    'authkey' => '',
                    'timestamp' => (string)time(),

                ]
            ]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->http->get("ewei_shopv2_api.php?i=1&r=member.address.get_detail&id=$id&comefrom=wxapp"
            . '&openid=sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI&mid=&merchid=&authkey=&timestamp=15694973');
        $this->assertEquals(200, $response->getStatusCode());
        $bodyContents = $response->getBody()->getContents();
        $this->assertEquals('1', json_decode($bodyContents, true)['detail']['isdefault']);
    }

    private function addAddress($count) {
        for ($i = 0; $i < $count; $i++) {
            $this->http->post(
                'ewei_shopv2_api.php?i=1&r=member.address.submit&timestamp=1569479236878',
                [
                    'form_params' => [
                        'realname' => '杨',
                        'mobile' => '15201010001',
                        'address' => '17楼',
                        'province' => '北京市',
                        'city' => '北京辖区',
                        'area' => '东城区',
                        'comefrom' => 'wxapp',
                        'openid' => 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI',
                        'datavalue' => 'null null null'
                    ]
                ]);
        }
    }

    public function testAddAddress(): void
    {
        $response = $this->http->post(
            'ewei_shopv2_api.php?i=1&r=member.address.submit&timestamp=1569479236878',
            [
                'form_params' => [
                    'realname' => '杨',
                    'mobile' => '15201010001',
                    'address' => '17楼',
                    'province' => '北京市',
                    'city' => '北京辖区',
                    'area' => '东城区',
                    'comefrom' => 'wxapp',
                    'openid' => 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI',
                    'datavalue' => 'null null null'
                ]
            ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteAddress(): void
    {
        $body = $this->getAddressList();
        $total = (int)$body['total'];
        $id = $body['list'][0]['id'];
        $response = $this->http->post('ewei_shopv2_api.php?r=member.address.delete',
            [
                'form_params' => [
                    'i' => 1,
                    'id' => $id,
                    'comefrom' => 'wxapp',
                    'openid' => 'sns_wa_o2nA_5dJg95XAwQFxrNIGptIWmWI',
                    'mid' => '',
                    'merchid' => '',
                    'authkey' => '',
                    'timestamp' => (string)time(),
                ]
            ]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}