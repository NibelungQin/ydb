<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveBannerControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.banner';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'live.banner.add';
        $this->route();
    }

    public function testAddPost(): void
    {
        $_GET['r'] = 'live.banner.add';
        $_POST['id'] = '';
        $_POST['displayorder'] = '0';
        $_POST['thumb'] = 'images/3/2019/12/qbzDvaBd1vxa1Ja88sCj1akbdV4j4v.jpg';
        $_POST['link'] = 'http://yidaodianshang.yidaoit.net//app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=goods&ishot=1';
        $_POST['enabled'] = '1';
        $this->post();
        $this->route();
    }

    public function testEnabled(): void
    {
        $_GET['r'] = 'live.banner.enabled';
        $_GET['enabled'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'live.banner.displayorder';
        $_GET['id'] = '1';
        $_POST['value'] = '1';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'live.banner.delete';
        $_POST['id'] = '1';
        $this->post();
        $this->route();
    }
}