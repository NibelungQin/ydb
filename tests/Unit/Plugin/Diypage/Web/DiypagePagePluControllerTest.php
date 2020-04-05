<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypagePagePluControllerTest extends BasePluginWebUnitTest
{

    public function testPagePlu(): void
    {
        $_GET['r'] = 'diypage.page.plu';
        $_GET['keyword'] = 'type4';
        $_GET['type'] = 4;
        $this->route(function () {
            $this->diypages[1]['type'] = '4';
            $this->diypages[1]['name'] = 'type4test';
        });
    }

    public function testGetPagePluAdd(): void
    {
        $_GET['r'] = 'diypage.page.plu.add';
        $_GET['type'] = 4;   //4-->commission
        $_GET['tid'] = 0;
        $this->route();
    }

    public function testPostPagePluAdd(): void
    {
        $_GET['r'] = 'diypage.page.plu.add';
        $_POST['id'] = 0;
        $_POST['tid'] = 1;
        $_POST['type'] = 4;
        $_POST['jsonData'] = '{"id":"0","data":{"page":{"type":4,"title":"请输入页面标题","name":"未命名页面","desc":"","icon":"","keyword":"","background":"#f3f3f3","diymenu":"-1","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":null,"commission":null},"novisit":{"title":null,"link":null}},"items":{"M1584779083426":{"type":4,"max":1,"params":{"style":"default1","seticon":"icon-settings","setlink":"","leftnav":"提现1","leftnavlink":"","rightnav":"提现2","rightnavlink":"","centernav":"提现","centernavlink":"","hideup":0},"style":{"background":"#fe5455","textcolor":"#ffffff","textlight":"#ffffff"},"id":"memberc"},"M1584779085181":{"style":{"background":"#ffffff","pricecolor":"#ff8000","textcolor":"#000000","btncolor":"#ff8000"},"type":4,"max":1,"id":"commission_block"}}}}';
        $this->post();
        $this->route(function(){
            $this->diypage_templates[0]['type'] = 4;
        });
    }

    public function testPagePluEdit(): void
    {
        $_GET['r'] = 'diypage.page.plu.edit';
        $_POST['id'] = 26;
        $_POST['type'] = '4';
        $_POST['jsonData'] = '{"id":"26","data":{"page":{"type":4,"title":"请输入页面标题","name":"未命名页面","desc":"","icon":"","keyword":"","background":"#f3f3f3","diymenu":"-1","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":null,"commission":null},"novisit":{"title":null,"link":null}},"items":{"M1584779083426":{"type":4,"max":1,"params":{"style":"default1","seticon":"icon-settings","setlink":"","leftnav":"提现1","leftnavlink":"","rightnav":"提现2","rightnavlink":"","centernav":"提现","centernavlink":"","hideup":0},"style":{"background":"#fe5455","textcolor":"#ffffff","textlight":"#ffffff"},"id":"memberc"},"M1584779085181":{"style":{"background":"#ffffff","pricecolor":"#ff8000","textcolor":"#000000","btncolor":"#ff8000"},"type":4,"max":1,"id":"commission_block"}}}}';
        $this->post();
        $this->route();
    }

    public function testPagePludelete(): void
    {
        $_GET['r'] = 'diypage.page.plu.delete';
        $_GET['id'] = 1;
        $this->route(function () {
            $this->diypages[1]['type'] = 4;
        });
    }


 //模版
    public function testPagePluSavetemp(): void
    {
        $_GET['r'] = 'diypage.page.plu.savetemp';
        $_POST['jsonData'] = '{"type":4,"cate":"0","name":"未命名模板","preview":"123","data":{"page":{"type":4,"title":"请输入页面标题","name":"未命名页面11","desc":"","icon":"","keyword":"","background":"#f3f3f3","diymenu":"-1","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":null,"commission":null},"novisit":{"title":null,"link":null}},"items":{"M1584779083426":{"type":4,"max":1,"params":{"style":"default1","seticon":"icon-settings","setlink":"","leftnav":"提现1","leftnavlink":"","rightnav":"提现2","rightnavlink":"","centernav":"提现","centernavlink":"","hideup":0},"style":{"background":"#fe5455","textcolor":"#ffffff","textlight":"#ffffff"},"id":"memberc"},"M1584779085181":{"style":{"background":"#ffffff","pricecolor":"#ff8000","textcolor":"#000000","btncolor":"#ff8000"},"type":4,"max":1,"id":"commission_block"}}}}';
        $this->post();
        $this->route(function(){
            $this->diypages[1]['type'] = 4;
        });
    }

}