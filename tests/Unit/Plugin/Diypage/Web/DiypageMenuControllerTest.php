<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypageMenuControllerTest extends BasePluginWebUnitTest
{

    public function testMenu(): void
    {
        $_GET['r'] = 'diypage.menu';
        $this->route();
    }

    public function testGetMenuAdd(): void
    {
        $_GET['r'] = 'diypage.menu.add';
        $this->route();
    }

    public function testPostMenuAdd(): void
    {
        $_GET['r'] = 'diypage.menu.edit';
        $_POST['id'] = 0;
        $_POST['menu'] = [
            'name' => 'test_menu-add',
            'params' => [
                'navstyle' => 1,
                'navfloat' => 'top',
            ],
            'style' => [
                'pagebgcolor' => '#f9f9f9',
                'bgcolor' => '#ffffff',
                'bgcoloron' => '#ffffff',
                'iconcolor' => '#999999',
                'iconcoloron' => '#999999',
                'textcolor' => '#666666',
                'textcoloron' => '#666666',
                'bordercolor' => '#ffffff',
                'bordercoloron' => '#ffffff',
                'childtextcolor' => '#666666',
                'childbgcolor' => '#f4f4f4',
                'childbordercolor' => '#eeeeee',
            ],
            'data' => [
                'M0123456789101' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/menu-1.png',
                    'linkurl' => 'http://www.baidu.com',
                    'iconclass' => 'icon-home',
                    'text' => '商城首页',
                ],
                'M0123456789102' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/menu-2.png',
                    'linkurl' => 'http://www.baidu.com',
                    'iconclass' => 'icon-list',
                    'text' => '全部商品',
                ],
                'M0123456789103' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/menu-3.png',
                    'linkurl' => 'http://www.baidu.com',
                    'iconclass' => 'icon-group',
                    'text' => '分销中心',
                ],
                'M0123456789104' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/menu-4.png',
                    'linkurl' => 'http://www.baidu.com',
                    'iconclass' => 'icon-cart',
                    'text' => '购物车',
                ],
                'M0123456789105' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/diypage/static/images/default/menu-5.png',
                    'linkurl' => 'http://www.baidu.com',
                    'iconclass' => 'icon-person2',
                    'text' => '个人中心',
                ],
            ],
        ];
        $this->post();
        $this->route();
    }

    public function testMenudelete(): void
    {
        $_GET['r'] = 'diypage.menu.delete';
        $_GET['id'] = 1;
        $this->route();
    }

}