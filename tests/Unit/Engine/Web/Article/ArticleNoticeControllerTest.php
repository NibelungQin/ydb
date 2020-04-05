<?php


namespace Ydb\Test\Unit\Engine\Web\Article;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class ArticleNoticeControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'notice';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'notice';
        $_GET['do'] = 'post';
        $this->route();
    }
}