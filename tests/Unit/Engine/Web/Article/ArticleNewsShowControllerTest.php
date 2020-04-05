<?php


namespace Ydb\Test\Unit\Engine\Web\Article;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class ArticleNewsShowControllerTest extends BaseEngineWebUnitTest
{
    public function testList(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'news-show';
        $this->route();
    }

    public function testDetail(): void
    {
        $this->expectExceptionMessage('');
        $_GET['c'] = 'article';
        $_GET['a'] = 'news-show';
        $_GET['do'] = 'detail';
        $_GET['id'] = '1';
        $this->route();
    }
}