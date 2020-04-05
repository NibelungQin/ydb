<?php


namespace Ydb\Test\Unit\Plugin\Article\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class ArticleIndexControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article';
        $_GET['aid'] = '1';
        $this->route();
    }

    public function testLike(): void
    {
        $_GET['r'] = 'article.like';
        $_GET['aid'] = '1';
        $this->route();
    }
}