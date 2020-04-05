<?php


namespace Ydb\Test\Unit\Plugin\Article\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class ArticleSourceControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.source';
        $this->route();
    }
}