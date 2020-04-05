<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsLevelControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.level';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.level.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sns.level.edit';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testEditPost(): void
    {
        $_GET['r'] = 'sns.level';
        $_POST['id'] = '2';
        $_POST['r'] = 'sns.level.edit';
        $_POST['levelname'] = '健康达人';
        $_POST['credit'] = '200';
        $_POST['bg'] = '#999';
        $_POST['color'] = '#333';
        $_POST['enabled'] = '1';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.level.delete';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testEnabled(): void
    {
        $_GET['r'] = 'sns.level.enabled';
        $_GET['enabled'] = '0';
        $_GET['id'] = '2';
        $this->route();
    }
}