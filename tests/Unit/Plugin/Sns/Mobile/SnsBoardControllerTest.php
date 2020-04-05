<?php


namespace Ydb\Test\Unit\Plugin\Sns\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class SnsBoardControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.board';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'sns.board.getlist';
        $_GET['page'] = '1';
        $_GET['bid'] = '1';
        $this->route();
    }

    public function testFollow(): void
    {
        $_GET['r'] = 'sns.board.follow';
        $_POST['bid'] = '1';
        $this->post();
        $this->route();
    }

    public function testLists(): void
    {
        $_GET['r'] = 'sns.board.lists';
        $this->route();
    }

    public function testGetBoardLists(): void
    {
        $_GET['r'] = 'sns.board.get_boardlist';
        $_GET['page'] = '1';
        $_GET['cid'] = '0';
        $_GET['keywords'] = '';
        $this->route();
    }

    public function testBest(): void
    {
        $_GET['r'] = 'sns.board.best';
        $this->route();
    }

    public function testRelate(): void
    {
        $_GET['r'] = 'sns.board.relate';
        $_GET['id'] = '1';
        $this->route();
    }
}