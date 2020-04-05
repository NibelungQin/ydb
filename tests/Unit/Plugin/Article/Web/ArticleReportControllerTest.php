<?php


namespace Ydb\Test\Unit\Plugin\Article\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class ArticleReportControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.report';
        $this->route();
    }
}