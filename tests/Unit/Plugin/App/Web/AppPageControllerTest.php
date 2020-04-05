<?php


namespace Ydb\Test\Unit\Plugin\App\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AppPageControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'app.page';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'app.page.add';
        $_GET['type'] = '2';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'app.page.edit';
        $_POST['id'] = 4;
        $_POST['data']['page'] = [
            'type' => 2,
            'title' => '请输入页面标题',
            'name' => '未命名页面',
            'desc' => '',
            'icon' => '',
            'background' => '#f3f3f3',
            'titlebarbg' => '#ffffff',
            'titlebarcolor' => '#000000'
        ];
        $_POST['data']['items']['M1506332563879'] = [
            'params' => ['placeholder' => '请输入关键字进行搜索'],
            'style' => [
                'inputbackground' => '#ffffff',
                'background' => '#f1f1f2',
                'iconcolor' => '#b4b4b4',
                'color' => '#999999',
                'paddingtop' => '10',
                'paddingleft' => '10',
                'textalign' => 'left',
                'searchstyle' => ''
            ],
            'id' => 'search'
        ];
        $_POST['data']['items']['M1506332568231'] = [
            'style' => [
                'dotstyle' => 'round',
                'dotalign' => 'center',
                'background' => '#ffffff',
                'opacity' => '0.8'
            ],
            'data' => [
                'C1506332568231' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/banner-1.jpg',
                    'linkurl' => ''
                ],
                [
                    'C1506332568232' => [
                        'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/banner-2.jpg',
                        'linkurl' => ''
                    ]
                ],
                'id' => 'banner'
            ]
        ];
        $_POST['data']['items']['M1506332575975'] = [
            'params' => [
                'iconurl' => '../addons/ewei_shopv2/static/images/hotdot.jpg',
                'noticedata' => '0',
                'speed' => '4',
                'noticenum' => '5'
            ],
            'style' => [
                'background' => '#ffffff',
                'iconcolor' => '#fd5454',
                'color' => '#666666',
                'bordercolor' => '#e2e2e2'
            ],
            'data' => [
                'C1506332575975' => [
                    'title' => '这里是第一条自定义公告的标题',
                    'linkurl' => ''
                ],
                'C1506332575976' => [
                    'title' => '这里是第二条自定义公告的标题',
                    'linkurl' => ''
                ]
            ],
            'id' => 'notice'
        ];

        $_POST['data']['items']['M1506332584255'] = [
            'style' => [
                'navstyle' => '',
                'background' => '#ffffff',
                'rownum' => '4',
                'showtype' => '0',
                'pagenum' => '8',
                'showdot' => '1'
            ],
            'data' => [
                'C1506332584255' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-1.png',
                    'linkurl' => '',
                    'text' => '按钮文字1',
                    'color' => '#666666'
                ],
                'C1506332584256' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-2.png',
                    'linkurl' => '',
                    'text' => '按钮文字2',
                    'color' => '#666666'
                ],
                'C1506332584257' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-3.png',
                    'linkurl' => '',
                    'text' => '按钮文字3',
                    'color' => '#666666'
                ],
                'C1506332584258' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-4.png',
                    'linkurl' => '',
                    'text' => '按钮文字4',
                    'color' => '#666666'
                ]
            ],
            'id' => 'menu'
        ];
        $_POST['data']['items']['M1506332586927'] = [
            'style' => [
                'navstyle' => '',
                'background' => '#ffffff',
                'rownum' => '4',
                'showtype' => '0',
                'pagenum' => '8',
                'showdot' => '1'
            ],
            'data' => [
                'C1506332586927' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-1.png',
                    'linkurl' => '',
                    'text' => '按钮文字1',
                    'color' => '#666666'
                ],
                'C1506332586928' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-2.png',
                    'linkurl' => '',
                    'text' => '按钮文字2',
                    'color' => '#666666'
                ],
                'C1506332586929' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-3.png',
                    'linkurl' => '',
                    'text' => '按钮文字3',
                    'color' => '#666666'
                ],
                'C1506332586930' => [
                    'imgurl' => '../addons/ewei_shopv2/plugin/app/static/images/default/icon-4.png',
                    'linkurl' => '',
                    'text' => '按钮文字4',
                    'color' => '#666666'
                ]
            ],
            'id' => 'menu'
        ];
        $_POST['data']['items']['M1506332594040'] = [
            'params' => [
                'showtitle' => '1',
                'showprice' => '1',
                'goodsdata' => '0',
                'cateid' => '',
                'catename' => '',
                'groupid' => '',
                'groupname' => '',
                'goodssort' => '0',
                'goodsscroll' => '0',
                'goodsnum' => '6',
                'showicon' => '1',
                'iconposition' => 'left top',
                'productprice' => '1',
                'showproductprice' => '0',
                'showsales' => '0',
                'productpricetext' => '原价',
                'salestext' => '销量',
                'productpriceline' => '0',
                'saleout' => '0'
            ],
            'style' => [
                'background' => '#f3f3f3',
                'liststyle' => 'block',
                'buystyle' => 'buybtn-1',
                'goodsicon' => 'recommand',
                'iconstyle' => 'triangle',
                'pricecolor' => '#ff5555',
                'productpricecolor' => '#999999',
                'iconpaddingtop' => '0',
                'iconpaddingleft' => '0',
                'buybtncolor' => '#ff5555',
                'iconzoom' => '100',
                'titlecolor' => '#000000',
                'tagbackground' => '#fe5455',
                'salescolor' => '#999999'
            ],
            'data' => [
                'C1506332594040' => [
                    'title' => '红枣',
                    'thumb' => 'http://yidaodianshang.yidaoit.net/attachment/images/3/2019/11/X5LT9p5jxLl2615in6JJs22ly565z6.jpg',
                    'price' => '12.00',
                    'gid' => '69',
                    'bargain' => '0'
                ],
                'C1506332594041' => [
                    'title' => '柠檬',
                    'thumb' => 'http://yidaodianshang.yidaoit.net/attachment/images/3/2019/11/EHPVp7uN9LtTu9xF8N6HvFTfuU8x9X.jpg',
                    'price' => '100.00',
                    'gid' => '70',
                    'bargain' => '0'
                ],
                'C1506332594042' => [
                    'title' => '橘子',
                    'thumb' => 'http://yidaodianshang.yidaoit.net/attachment/images/3/2019/11/x0B9XyBCG3x9j9ogUbOXxOyoGu305u.jpg',
                    'price' => '0.01',
                    'gid' => '74',
                    'bargain' => '0'
                ],
                'C1506332594043' => [
                    'title' => '透明收纳盒',
                    'thumb' => 'http://yidaodianshang.yidaoit.net/attachment/images/3/merch/2/WmIenmEqDVV7PVPiER7e2Ie0r0dyOP.jpg',
                    'price' => '19.90',
                    'gid' => '58',
                    'bargain' => '0'
                ]
            ],
            'id' => 'goods'
        ];
        $_POST['isdefault'] = '0';
        $this->post();
        $this->route();
    }

    public function testStatus(): void
    {
        $_GET['r'] = 'app.page.status';
        $_GET['status'] = '0';
        $_GET['id'] = '4';
        $this->route();
    }

    public function testSetDefault(): void
    {
        $_GET['r'] = 'app.page.setdefault';
        $_GET['id'] = '1';
        $_GET['type'] = '4';
        $this->route();
    }

    public function testCancelDefault(): void
    {
        $_GET['r'] = 'app.page.cancel_default';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'app.page.delete';
        $_GET['id'] = '1';
        $this->route();
    }
}