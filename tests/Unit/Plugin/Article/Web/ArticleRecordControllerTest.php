<?php


namespace Ydb\Test\Unit\Plugin\Article\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class ArticleRecordControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.record';
        $_GET['aid'] = '1';
        $this->route();
    }
}