<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsComplainControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.complain';
        $_GET['type'] = 'untreated';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.complain.delete';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testDelete1(): void
    {
        $_GET['r'] = 'sns.complain.delete1';
        $_GET['id'] = '2';
        $this->route();
    }

    public function testChecked(): void
    {
        $_GET['r'] = 'sns.complain.checked';
        $_GET['id'] = '2';
        $_GET['type'] = '-1';
        $this->route();
    }

    public function testRestore(): void
    {
        $_GET['r'] = 'sns.complain.restore';
        $_GET['id'] = '2';
        $_GET['type'] = '-1';
        $this->route();
    }

    public function testCheckedPost(): void
    {
        $_GET['r'] = 'sns.complain.checked';
        $_POST['id'] = '2';
        $_POST['type'] = '-1';
        $_POST['status'] = '1';
        $this->post();
        $this->route();
    }

    public function testCategory(): void
    {
        $_GET['r'] = 'sns.complain.category';
        $this->route();
    }

    public function testCategoryPost(): void
    {
        $_GET['r'] = 'sns.complain.category';
        $_POST['catid'] = ['1', '2', ''];
        $_POST['catname'] = ['欺诈', '不实信息', '违法犯罪'];
        $_POST['status'] = ['1', '1', '1'];
        $this->post();
        $this->route();
    }

    public function testCateDel(): void
    {
        $_GET['r'] = 'sns.complain.catedel';
        $_GET['id'] = '1';
        $this->route();
    }
}