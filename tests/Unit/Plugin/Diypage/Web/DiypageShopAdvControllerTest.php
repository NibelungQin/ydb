<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypageShppAdvControllerTest extends BasePluginWebUnitTest
{

    public function testShopAdv(): void
    {
        $_GET['r'] = 'diypage.shop.adv';
        $_GET['keyword'] = 'test';
        $this->route(function(){
            $this->diypage_plus[0]['name']='test_adv';
        });
    }

    public function testGetShopAdvAdd(): void
    {
        $_GET['r'] = 'diypage.shop.adv.add';
        $_GET['type'] = 2;
        $this->route();
    }

    public function testPostShopAdvAdd(): void
    {
        $_GET['r'] = 'diypage.shop.adv.edit';
        $_POST['id'] = 0;
        $_POST['advs'] = [
            'name' => '未命名启动广告test',
            'status' => '0',
            'params' => [
                "style" => 'small-bot',
                "showtype" => '1',
                "showtime" => '60',
                "autoclose" => '10',
                "canclose" => '1',
            ],
            'style' => [
                'background' => '#000000',
                'opacity' => '0.6',
            ],
            'data' => [
                'M0123456789101' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-1.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
                'M0123456789102' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-2.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
                'M0123456789103' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-2.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
            ],
        ];
        $this->post();
        $this->route();
    }

    public function testPostShopAdvEdit(): void
    {
        $_GET['r'] = 'diypage.shop.adv.edit';
        $_POST['id'] = 1;
        $_POST['advs'] = [
            'name' => '未命名启动广告test',
            'status' => '0',
            'params' => [
                "style" => 'small-bot',
                "showtype" => '1',
                "showtime" => '60',
                "autoclose" => '10',
                "canclose" => '1',
            ],
            'style' => [
                'background' => '#000000',
                'opacity' => '0.6',
            ],
            'data' => [
                'M0123456789101' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-1.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
                'M0123456789102' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-2.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
                'M0123456789103' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/adv-2.jpg',
                    'linkurl' => '',
                    'click' => 0,
                ],
            ],
        ];
        $this->post();
        $this->route();
    }

    public function testShopAdvdelete(): void
    {
        $_GET['r'] = 'diypage.shop.adv.delete';
        $_GET['id'] = 1;
        $this->route();
    }


}