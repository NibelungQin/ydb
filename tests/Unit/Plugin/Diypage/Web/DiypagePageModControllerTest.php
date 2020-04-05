<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypagePageModControllerTest extends BasePluginWebUnitTest
{

    public function testPageMod(): void
    {
        $_GET['r'] = 'diypage.page.mod';
        $_GET['keyword'] = 'type99';
        $this->route(function (){
            $this->diypage_templates[0]['name'] = 'type99_test';
        });
    }

    public function testGetPageModAdd(): void
    {
        $_GET['r'] = 'diypage.page.mod.add';
        $this->route();
    }

    public function testPostPageModdd(): void
    {
        $_GET['r'] = 'diypage.page.mod.add';
        $_POST['id'] = 0;
        $_POST['data']['page'] = [
            "type" => '99',
            "title" => '公用模块',
            "name" => '测试模块mod',
            "desc" => '',
            "icon" => '',
            "keyword" => '',
            "background" => '#f3f3f3',
            "diymenu" => '-1',
            "diylayer" => '0',
            "diygotop" => '0',
            "followbar" => '0',
            "visit" => '0',
            'visitlevel' => [
                'member' => '',
                'commission' => '',
            ],
            'novisit' => [
                'title' => '',
                'link' => '',
            ],
        ];
        $_POST['data']['items'] = [
            'M1584343562740' => [
                'style' => [
                    'background' => '#ffffff',
                    'padding' => '5',
                ],
                'params' => [
                    'content' => 'PHA+5pKS55qE5Y+R6aG65LiwPC9wPg==',
                ],
                'id' => 'richtext',
            ]
        ];
        $this->post();
        $this->route();
    }

    public function testGetPageModEdit(): void
    {
        $_GET['r'] = 'diypage.page.mod.edit';
        $_SERVER['REQUEST_METHOD'] = "GET";
        $_GET['id'] = 1;
        $this->route(function () {
            $this->diypage_templates[0]['type'] = 99;
        });
    }

    public function testPageModdelete(): void
    {
        $_GET['r'] = 'diypage.page.mod.delete';
        $_GET['id'] = 1;
        $this->route(function () {
            $this->diypages[1]['type'] = 99;
        });
    }


}