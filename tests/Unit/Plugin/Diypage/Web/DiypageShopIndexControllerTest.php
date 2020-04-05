<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use RuntimeException;
use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypageShopIndexControllerTest extends BasePluginWebUnitTest
{

    //关注条
    public function testShopFollowbar(): void
    {
        $_GET['r'] = 'diypage.shop.followbar';
        $this->route();
    }


    public function testPostShopFollowbar(): void
    {

        $_GET['r'] = 'diypage.shop.followbar';
        $_POST['data'] = [
            'merch' => '0',
            'params' => [
                'logo]' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                'isopen]' => '0',
                'icontype]' => '1',
                'btntext]' => '点击关注',
                'btnclick]' => '1',
                'btnlinktype]' => '0',
                'qrcodetype]' => '0',
                'btnicon' => '',
                'iconurl' => '',
                'iconstyle' => '',
                'defaulttext' => '',
                'sharetext' => '',
                'btnlink' => '',
                'qrcodeurl' => '',
            ],
            'style' => [
                'background' => '#444444',
                'textcolor' => '#ffffff',
                'btnbgcolor' => '#04be02',
                'btncolor' => '#ffffff',
                'highlight' => '#ffffff',
            ],
        ];
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(1));
        $this->post();
        $this->route();
    }

    public function testShopPage()
    {
        $_GET['r'] = 'diypage.shop.page';
        $this->route();
    }

    //悬浮按钮
    public function testShopLayer(): void
    {
        $_GET['r'] = 'diypage.shop.layer';
        $this->route();
    }

    public function testPostShopLayer(): void
    {

        $_GET['r'] = 'diypage.shop.layer';
        $_POST['data'] = [
            'merch' => '0',
            'params' => [
                'isopen' => '0',
                'imgurl' => 'images/3/2019/07/CuA8E57ad4ntL7DteUT5Ul5La97A8p.jpg',
                'linkurl' => './index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=creditshop',
                'iconposition' => 'left bottom',
            ],
            'style' => [
                'width' => '26',
                'top' => '46',
                'left' => '29',
            ],
        ];
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(1));
        $this->post();
        $this->route();
    }

    //返回顶部
    public function testShopGotop(): void
    {
        $_GET['r'] = 'diypage.shop.gotop';
        $this->route();
    }


    public function testPostShopGotop(): void
    {

        $_GET['r'] = 'diypage.shop.gotop';
        $_POST['data'] = [
            'merch' => '0',
            'params' => [
                'isopen' => '1',
                'gotoptype' => '1',
                'gotopclick' => '0',
                'imgurl' => 'images/3/2020/02/jE157z5U71VKplL1Lw1ohE1ktElPeL.jpg',
                'linkurl' => '',
                'iconposition' => 'right bottom',
                'iconclass' => 'icon-top1',
                'gotopheight' => '300',
            ],
            'style' => [
                'iconcolor' => '#ffffff',
                'background' => '#000000',
                'opacity' => '0.5',
                'width' => '35',
                'top' => '43',
                'left' => '29',
            ],
        ];
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(1));
        $this->post();
        $this->route();
    }

//下单提醒
    public function testShopDanum(): void
    {
        $_GET['r'] = 'diypage.shop.danmu';
        $this->route();
    }

    public function testPostShopDanmu(): void
    {
        $_GET['r'] = 'diypage.shop.danmu';
        $_POST['data'] = [
            'merch' => '0',
            'params' => [
                'isopen' => '1',
                'gotoptype' => '1',
                'gotopclick' => '0',
                'imgurl' => 'images/3/2020/02/jE157z5U71VKplL1Lw1ohE1ktElPeL.jpg',
                'linkurl' => '',
                'iconposition' => 'right bottom',
                'iconclass' => 'icon-top1',
                'gotopheight' => '300',
            ],
            'style' => [
                'iconcolor' => '#ffffff',
                'background' => '#000000',
                'opacity' => '0.5',
                'width' => '35',
                'top' => '43',
                'left' => '29',
            ],
        ];
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(1));
        $this->post();
        $this->route();
    }

    public function testShopMenu(): void
    {
        $_GET['r'] = 'diypage.shop.menu';
        $this->route();
    }

    public function testPostShopMenu(): void
    {
        $_GET['r'] = 'diypage.shop.menu';
        $_POST['menu'] = [
            'shop' => '3',
            'shop_wap' => '6',
            'creditshop' => '6',
            'creditshop_wap' => '6',
            'commission' => '6',
            'commission_wap' => '6',
            'groups' => '7',
            'groups_wap' => '8',
            'sns' => '6',
            'sns_wap' => '6',
            'sign' => '6',
            'sign_wap' => '6',
            'seckill' => '6',
            'seckill_wap' => '6',
        ];
        $this->post();
        $this->route();
    }

}