<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsManageControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.manage';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.manage.add';
        $this->route();
    }

    public function testAddPost(): void
    {
        $_GET['r'] = 'sns.manage';
        $_POST['id'] = '';
        $_POST['r'] =  'sns.manage.add';
        $_POST['bid'] = '1';
        $_POST['openid_text'] = 'madhatter';
        $_POST['openid'] = 'oMW005lDg8xacovx279GSHDCMetM';
        $this->post();
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sns.manage.edit';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.manage.delete';
        $_GET['id'] = '1';
        $this->route();
    }
}