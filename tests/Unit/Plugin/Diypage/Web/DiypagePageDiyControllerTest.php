<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypagePageDiyControllerTest extends BasePluginWebUnitTest
{

    public function testPageDiy(): void
    {
        $_GET['r'] = 'diypage.page.diy';
        $this->route();
    }

    public function testGetPageDiyAdd(): void
    {
        $_GET['r'] = 'diypage.page.diy.add';
        $this->route();
    }

    public function testPostPageDiyAdd(): void
    {
        $_GET['r'] = 'diypage.page.diy.add';
        $_POST['id'] = 0;
        $_POST['tid'] = 1;
        $_POST['jsonData']='{"id":"0","data":{"page":{"type":"1","title":"diy_title","name":"testDiy","desc":"diy_content","icon":"images/3/2020/02/jE157z5U71VKplL1Lw1ohE1ktElPeL.jpg","keyword":"diy_keyword","background":"#f3f3f3","diymenu":"6","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":"","commission":""},"novisit":{"title":"","link":""}},"items":{"M1584172477316":{"params":{"iconurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/hotdot.png","noticedata":"0","speed":"4","noticenum":"10"},"style":{"background":"#ffffff","iconcolor":"#fd5454","color":"#666666","bordercolor":"#e2e2e2"},"data":{"C1584172477316":{"title":"这里是第一条自定义公告的标题","linkurl":""},"C1584172477317":{"title":"这里是第二条自定义公告的标题","linkurl":""}},"id":"notice"},"M1584780437889":{"params":{"goodstype":"0","showtitle":"1","showprice":"1","showtag":"0","goodsdata":"0","cateid":"","catename":"","groupid":"","groupname":"","goodssort":"0","goodsnum":"6","showicon":"1","iconposition":"left top","productprice":"1","showproductprice":"0","showsales":"0","productpricetext":"原价","salestext":"销量","productpriceline":"0","saleout":"0","pagetype":"1","seecommission":0,"cansee":0,"seetitle":""},"style":{"background":"#f3f3f3","liststyle":"block","buystyle":"buybtn-1","goodsicon":"recommand","iconstyle":"triangle","pricecolor":"#ff5555","productpricecolor":"#999999","iconpaddingtop":"0","iconpaddingleft":"0","buybtncolor":"#ff5555","iconzoom":"100","titlecolor":"#000000","tagbackground":"#fe5455","salescolor":"#999999"},"data":{"C1584780437889":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-1.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437890":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-2.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437891":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-3.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0},"C1584780437892":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-4.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0}},"id":"goods"},"M1584780438419":{"params":{},"style":{"navstyle":"","background":"#ffffff","rownum":"4","showtype":"0","pagenum":"8","showdot":"1"},"data":{"C1584780438419":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-1.png","linkurl":"","text":"按钮文字1","color":"#666666"},"C1584780438420":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-2.png","linkurl":"","text":"按钮文字2","color":"#666666"},"C1584780438421":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-3.png","linkurl":"","text":"按钮文字3","color":"#666666"},"C1584780438422":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-4.png","linkurl":"","text":"按钮文字4","color":"#666666"}},"id":"menu"},"M1584780439283":{"params":{"title":"未定义音频信息","subtitle":"副标题","playerstyle":0,"autoplay":0,"loopplay":0,"pausestop":0,"headalign":"left","headtype":"","headurl":""},"style":{"background":"#f1f1f1","bordercolor":"#ededed","textcolor":"#333333","subtitlecolor":"#666666","timecolor":"#666666","paddingtop":"20","paddingleft":"20","width":"80"},"id":"audio"}}}}';
        $this->post();
        $this->route(function(){
            $this->diypage_templates[0]['type'] = 1;
        });
    }

    public function testPageDiyEdit(): void
    {
        $_GET['r'] = 'diypage.page.diy.edit';
        $_GET['id'] = 1;
        $_POST['jsonData']='{"id":"1","data":{"page":{"type":"1","title":"diy_title","name":"testDiy_1","desc":"diy_content1","icon":"images/3/2020/02/jE157z5U71VKplL1Lw1ohE1ktElPeL.jpg","keyword":"diy_keyword123","background":"#f3f3f3","diymenu":"6","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":"","commission":""},"novisit":{"title":"","link":""}},"items":{"M1584172477316":{"params":{"iconurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/hotdot.png","noticedata":"0","speed":"4","noticenum":"10"},"style":{"background":"#ffffff","iconcolor":"#fd5454","color":"#666666","bordercolor":"#e2e2e2"},"data":{"C1584172477316":{"title":"这里是第一条自定义公告的标题","linkurl":""},"C1584172477317":{"title":"这里是第二条自定义公告的标题","linkurl":""}},"id":"notice"},"M1584780437889":{"params":{"goodstype":"0","showtitle":"1","showprice":"1","showtag":"0","goodsdata":"0","cateid":"","catename":"","groupid":"","groupname":"","goodssort":"0","goodsnum":"6","showicon":"1","iconposition":"left top","productprice":"1","showproductprice":"0","showsales":"0","productpricetext":"原价","salestext":"销量","productpriceline":"0","saleout":"0","pagetype":"1","seecommission":0,"cansee":0,"seetitle":""},"style":{"background":"#f3f3f3","liststyle":"block","buystyle":"buybtn-1","goodsicon":"recommand","iconstyle":"triangle","pricecolor":"#ff5555","productpricecolor":"#999999","iconpaddingtop":"0","iconpaddingleft":"0","buybtncolor":"#ff5555","iconzoom":"100","titlecolor":"#000000","tagbackground":"#fe5455","salescolor":"#999999"},"data":{"C1584780437889":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-1.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437890":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-2.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437891":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-3.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0},"C1584780437892":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-4.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0}},"id":"goods"},"M1584780438419":{"params":{},"style":{"navstyle":"","background":"#ffffff","rownum":"4","showtype":"0","pagenum":"8","showdot":"1"},"data":{"C1584780438419":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-1.png","linkurl":"","text":"按钮文字1","color":"#666666"},"C1584780438420":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-2.png","linkurl":"","text":"按钮文字2","color":"#666666"},"C1584780438421":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-3.png","linkurl":"","text":"按钮文字3","color":"#666666"},"C1584780438422":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-4.png","linkurl":"","text":"按钮文字4","color":"#666666"}},"id":"menu"},"M1584780439283":{"params":{"title":"未定义音频信息","subtitle":"副标题","playerstyle":0,"autoplay":0,"loopplay":0,"pausestop":0,"headalign":"left","headtype":"","headurl":""},"style":{"background":"#f1f1f1","bordercolor":"#ededed","textcolor":"#333333","subtitlecolor":"#666666","timecolor":"#666666","paddingtop":"20","paddingleft":"20","width":"80"},"id":"audio"}}}}';
        $this->route();
    }

    public function testPageDiydelete(): void
    {
        $_GET['r'] = 'diypage.page.diy.delete';
        $_GET['id'] = 1;
        $this->route(function () {
            $this->diypages[1]['type'] = 4;
        });
    }

    //模版
    public function testPageDiySavetemp(): void
    {
        $_GET['r'] = 'diypage.page.diy.savetemp';
        $_POST['jsonData'] = '{"type":"1","cate":"0","name":"未命名模板","preview":"123123","data":{"page":{"type":"1","title":"diy_title","name":"testDiy","desc":"diy_content","icon":"images/3/2020/02/jE157z5U71VKplL1Lw1ohE1ktElPeL.jpg","keyword":"diy_keyword","background":"#f3f3f3","diymenu":"6","diylayer":"0","diygotop":"0","followbar":"0","visit":"0","visitlevel":{"member":"","commission":""},"novisit":{"title":"","link":""}},"items":{"M1584172477316":{"params":{"iconurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/hotdot.png","noticedata":"0","speed":"4","noticenum":"10"},"style":{"background":"#ffffff","iconcolor":"#fd5454","color":"#666666","bordercolor":"#e2e2e2"},"data":{"C1584172477316":{"title":"这里是第一条自定义公告的标题","linkurl":""},"C1584172477317":{"title":"这里是第二条自定义公告的标题","linkurl":""}},"id":"notice"},"M1584780437889":{"params":{"goodstype":"0","showtitle":"1","showprice":"1","showtag":"0","goodsdata":"0","cateid":"","catename":"","groupid":"","groupname":"","goodssort":"0","goodsnum":"6","showicon":"1","iconposition":"left top","productprice":"1","showproductprice":"0","showsales":"0","productpricetext":"原价","salestext":"销量","productpriceline":"0","saleout":"0","pagetype":"1","seecommission":0,"cansee":0,"seetitle":""},"style":{"background":"#f3f3f3","liststyle":"block","buystyle":"buybtn-1","goodsicon":"recommand","iconstyle":"triangle","pricecolor":"#ff5555","productpricecolor":"#999999","iconpaddingtop":"0","iconpaddingleft":"0","buybtncolor":"#ff5555","iconzoom":"100","titlecolor":"#000000","tagbackground":"#fe5455","salescolor":"#999999"},"data":{"C1584780437889":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-1.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437890":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-2.jpg","price":"20.00","productprice":"99.00","title":"这里是商品标题","sales":"0","gid":"","bargain":0,"credit":0,"ctype":1},"C1584780437891":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-3.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0},"C1584780437892":{"thumb":"../addons/ewei_shopv2/plugin/diypage/static/images/default/goods-4.jpg","price":"20.00","productprice":"99.00","sales":"0","title":"这里是商品标题","gid":"","bargain":0,"credit":0,"ctype":0}},"id":"goods"},"M1584780438419":{"params":[],"style":{"navstyle":"","background":"#ffffff","rownum":"4","showtype":"0","pagenum":"8","showdot":"1"},"data":{"C1584780438419":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-1.png","linkurl":"","text":"按钮文字1","color":"#666666"},"C1584780438420":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-2.png","linkurl":"","text":"按钮文字2","color":"#666666"},"C1584780438421":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-3.png","linkurl":"","text":"按钮文字3","color":"#666666"},"C1584780438422":{"imgurl":"../addons/ewei_shopv2/plugin/diypage/static/images/default/icon-4.png","linkurl":"","text":"按钮文字4","color":"#666666"}},"id":"menu"},"M1584780439283":{"params":{"title":"未定义音频信息","subtitle":"副标题","playerstyle":0,"autoplay":0,"loopplay":0,"pausestop":0,"headalign":"left","headtype":"","headurl":""},"style":{"background":"#f1f1f1","bordercolor":"#ededed","textcolor":"#333333","subtitlecolor":"#666666","timecolor":"#666666","paddingtop":"20","paddingleft":"20","width":"80"},"id":"audio"}}}}';
        $this->post();
        $this->route();
    }

}