<?php


namespace Ydb\Test\Unit\Engine\Web\Article;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class ArticleNewsControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'news';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'news';
        $_GET['do'] = 'post';
        $this->route();
    }

    public function testCategory(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'news';
        $_GET['do'] = 'category';
        $this->route();
    }

    public function testCategoryPost(): void
    {
        $_GET['c'] = 'article';
        $_GET['a'] = 'news';
        $_GET['do'] = 'category_post';
        $this->route();
    }
}