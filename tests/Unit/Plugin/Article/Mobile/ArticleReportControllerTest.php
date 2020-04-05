<?php


namespace Ydb\Test\Unit\Plugin\Article\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class ArticleReportControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.report';
        $_GET['aid'] = '1';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'article.report.post';
        $_GET['aid'] = '1';
        $_GET['cate'] = '隐私信息收集';
        $_GET['content'] = '测试投诉测试投诉测试投诉测试投诉测试投诉测试投诉';
        $this->route();
    }
}