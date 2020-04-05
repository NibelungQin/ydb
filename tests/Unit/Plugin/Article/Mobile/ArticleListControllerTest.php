<?php


namespace Ydb\Test\Unit\Plugin\Article\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class ArticleListControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.list';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'article.list.getlist';
        $_GET['page'] = '1';
        $this->route();
    }
}