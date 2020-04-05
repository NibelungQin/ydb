<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypageTempCategoryControllerTest extends BasePluginWebUnitTest
{

    public function testTempCategory(): void
    {
        $_GET['r'] = 'diypage.temp.category';
        $this->route();
    }

    public function testPostTempCategoryAdd(): void
    {
        $_GET['r'] = 'diypage.temp.category.add';
        $_POST['name'] = 'test';
        $this->post();
        $this->route();
    }

    public function testPostTempCategoryEdit(): void
    {
        $_GET['r'] = 'diypage.temp.category.edit';

        $_POST['id'] = 2;
        $_POST['name'] = 'test12';
        $this->route();
    }

    public function testTempCategoryDelete(): void
    {
        $_GET['r'] = 'diypage.temp.category.delete';
        $_POST['id'] = '1';
        $this->post();
        $this->route();
    }


}