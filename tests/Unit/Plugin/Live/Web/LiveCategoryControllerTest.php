<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveCategoryControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.category';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'live.category.add';
        $this->route();
    }

    public function testAddPost(): void
    {
        $_GET['r'] = 'live.category.add';
        $_POST['displayorder'] = '0';
        $_POST['catename'] = '测试直播分类';
        $_POST['thumb'] = 'images/3/2019/11/IQjd70bc81zC37Ivd08D85j6R8c3d9.jpg';
        $_POST['isrecommand'] = '1';
        $_POST['enabled'] = '1';
        $this->post();
        $this->route();
    }

    public function testEnabled(): void
    {
        $_GET['r'] = 'live.category.enabled';
        $_GET['enabled'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testRecommand(): void
    {
        $_GET['r'] = 'live.category.recommand';
        $_GET['isrecommand'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'live.category.displayorder';
        $_GET['id'] = '1';
        $_POST['value'] = '1';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'live.category.delete';
        $_POST['id'] = '1';
        $this->post();
        $this->route();
    }
}