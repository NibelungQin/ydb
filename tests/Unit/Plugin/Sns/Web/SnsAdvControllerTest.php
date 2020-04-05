<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsAdvControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.adv';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.adv.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sns.adv.edit';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testEditPost(): void
    {
        $_GET['r'] = 'sns.adv.edit';
        $_GET['id'] = '2';
        $_POST['id'] = '2';
        $_POST['displayorder'] = '2147483647';
        $_POST['advname'] = '爱生活爱健康';
        $_POST['thumb'] = 'images/3/2020/03/eOdq47WssSqz1kXHtDSJ7WzSI4HL3Q.jpg';
        $_POST['link'] = '';
        $_POST['enabled'] = '1';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.adv.delete';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'sns.adv.displayorder';
        $_GET['id'] = '2';
        $_POST['value'] = '21';
        $this->post();
        $this->route();
    }

    public function testEnabled(): void
    {
        $_GET['r'] = 'sns.adv.enabled';
        $_GET['enabled'] = '0';
        $_GET['id'] = '2';
        $this->route();
    }
}