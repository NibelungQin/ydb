<?php


namespace Ydb\Test\Unit\Plugin\Article\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class ArticleCategoryControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'article.category';
        $this->route();
    }

    public function testSave(): void
    {
        $_GET['r'] = 'article.category.save';
        $_POST['cate'] = [
            [
                'displayorder' => '100',
                'name' => 'o2o',
                'isshow' => '1'
            ]
        ];
        $this->post();
        $this->route();
    }

    public function testSaveNew(): void
    {
        $_GET['r'] = 'article.category.save';
        $_POST['cate'] = [
            [
                'displayorder' => '100',
                'name' => 'o2o',
                'isshow' => '1'
            ]
        ];
        $_POST['cate_new'] = ['电商', '零售'];
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'article.category.delete';
        $_GET['id'] = '1';
        $this->route();
    }
}