<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsCategoryControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.category';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.category.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sns.category.edit';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testEditPost(): void
    {
        $_GET['r'] = 'sns.category.edit';
        $_GET['id'] = '1';
        $_POST['displayorder'] = '0';
        $_POST['catename'] = '健康养生';
        $_POST['thumb'] = 'images/3/2020/03/UOP040O4EgzYyyhop9p69OR96SsPHG.jpg';
        $_POST['isrecommand'] = '1';
        $_POST['enabled'] = '1';
        $this->post();
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'sns.category.displayorder';
        $_GET['id'] = '1';
        $_POST['value'] = '100';
        $this->post();
        $this->route();
    }

    public function testEnabled(): void
    {
        $_GET['r'] = 'sns.category.enabled';
        $_GET['enabled'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.category.delete';
        $_GET['id'] = '1';
        $this->route();
    }
}