<?php


namespace Ydb\Test\Unit\Plugin\Sns\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class SnsUserControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.user';
        $_GET['id'] = '125';
        $this->route();
    }

    public function testBoards(): void
    {
        $_GET['r'] = 'sns.user.boards';
        $this->route();
    }

    public function testGetBoards(): void
    {
        $_GET['r'] = 'sns.user.get_boards';
        $_GET['page'] = '1';
        $_GET['id'] = '125';
        $this->route();
    }

    public function testPosts(): void
    {
        $_GET['r'] = 'sns.user.posts';
        $this->route();
    }

    public function testGetPosts(): void
    {
        $_GET['r'] = 'sns.user.get_posts';
        $_GET['page'] = '1';
        $_GET['id'] = '125';
        $this->route();
    }

    public function testReplys(): void
    {
        $_GET['r'] = 'sns.user.replys';
        $this->route();
    }

    public function testGetReplys(): void
    {
        $_GET['r'] = 'sns.user.get_replys';
        $_GET['page'] = '1';
        $_GET['id'] = '125';
        $this->route();
    }

    public function testDeleteReply(): void
    {
        $_GET['r'] = 'sns.user.delete_reply';
        $_GET['id'] = '4';
        $this->route();
    }

    public function testSubmitSign(): void
    {
        $_GET['r'] = 'sns.user.submit_sign';
        $_POST['sign'] = 'allizwell';
        $this->post();
        $this->route();
    }
}