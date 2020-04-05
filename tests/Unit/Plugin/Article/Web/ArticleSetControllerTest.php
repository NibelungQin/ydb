<?php


namespace Ydb\Test\Unit\Plugin\Article\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class ArticleSetControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.set';
        $this->route();
    }

    public function testMainPost(): void
    {
        $_GET['r'] = 'article.set';
        $_POST['article_advanced'] = '';
        $_POST['article_close_advanced'] = '0';
        $_POST['article_source'] = '';
        $_POST['article_title'] = '';
        $_POST['article_image'] = '';
        $_POST['article_shownum'] = '';
        $_POST['article_temp'] = '0';
        $_POST['article_keyword'] = '文章';
        $this->post();
        $this->route();
    }
}