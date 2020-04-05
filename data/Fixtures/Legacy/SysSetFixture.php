<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SysSetFixture implements FixtureInterface
{
    public const UNIACID = 3;

    public const SETS = array (
        'pay' =>
            array (
                'weixin_id' => 1,
                'weixin' => 1,
                'weixin_sub' => 0,
                'weixin_jie' => 0,
                'weixin_jie_sub' => 0,
                'alipay' => 0,
                'alipay_id' => 0,
                'credit' => 1,
                'cash' => 1,
                'app_wechat' => 0,
                'app_alipay' => 0,
                'paytype' =>
                    array (
                        'commission' => '0',
                        'withdraw' => '0',
                        'redpack' => '0',
                    ),
                'wxapp' => 1,
            ),
        'area_config' =>
            array (
                'id' => '1',
                'uniacid' => '3',
                'new_area' => '1',
                'address_street' => '1',
                'createtime' => '1560821144',
            ),
        'shop' =>
            array (
                'name' => '一道电商',
                'logo' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                'description' => '一道宝为您提供一站式营销解决方案，全渠道立体化裂变营销，多种营销场景快速传播，引爆市场挖掘优质潜在客户，让粉丝变得更轻松！',
                'img' => '',
                'signimg' => 'images/3/2019/10/KUNaTNtxFXkVNtNnXU9U9tTlFXK8V3.jpg',
                'getinfo' => '1',
                'saleout' => '',
                'loading' => '',
                'diycode' => 'http://wpa.qq.com/msgrd?v=3&uin=206946332&site=qq&menu=yes',
                'funbar' => '1',
                'goodstotal' => '0',
                'close_preview' => '0',
                'close' => 0,
                'closedetail' => '<p>商城正在升级，请耐心等待！</p><p>如有重要咨询，请联系客服（1378888888）</p>',
                'closeurl' => '',
                'catlevel' => '3',
                'catshow' => '1',
                'catadvimg' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                'catadvurl' => '',
                'bottomFixedImage' =>
                    array (
                        'shopStatus' => true,
                        'merchStatus' => true,
                        'urls' =>
                            array (
                                0 => 'http://yidaodianshang.yidaoit.net/attachment/images/3/2019/07/K5D551X8yif8yzfDFRH5KD98Dr9e7o.jpg',
                            ),
                    ),
                'ordertemplates' =>
                    array (
                        '模板一' =>
                            array (
                                0 =>
                                    array (
                                        'field' => 'ordersn',
                                        'title' => '订单编号',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                1 =>
                                    array (
                                        'field' => 'nickname',
                                        'title' => '粉丝昵称',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                2 =>
                                    array (
                                        'field' => 'uid',
                                        'title' => '会员id',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                3 =>
                                    array (
                                        'field' => 'level',
                                        'title' => '会员等级',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                4 =>
                                    array (
                                        'field' => 'mrealname',
                                        'title' => '会员姓名',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                5 =>
                                    array (
                                        'field' => 'mmobile',
                                        'title' => '会员手机号',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                6 =>
                                    array (
                                        'field' => 'pickname',
                                        'title' => '自提门店',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                7 =>
                                    array (
                                        'field' => 'verifycode',
                                        'title' => '自提码',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                8 =>
                                    array (
                                        'field' => 'openid',
                                        'title' => 'openid',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                9 =>
                                    array (
                                        'field' => 'realname',
                                        'title' => '收货姓名(或自提人)',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                10 =>
                                    array (
                                        'field' => 'mobile',
                                        'title' => '联系电话',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                11 =>
                                    array (
                                        'field' => 'address',
                                        'title' => '收货地址',
                                        'subtitle' => '收货地址(省市区合并)',
                                        'width' => '24',
                                    ),
                                12 =>
                                    array (
                                        'field' => 'address_province',
                                        'title' => '收货地址',
                                        'subtitle' => '收货地址(省市区分离)',
                                        'width' => '12',
                                    ),
                                13 =>
                                    array (
                                        'field' => 'goods_str',
                                        'title' => '商品信息',
                                        'subtitle' => '商品信息(信息合并)',
                                        'width' => '36',
                                    ),
                                14 =>
                                    array (
                                        'field' => 'goods_title',
                                        'title' => '商品信息',
                                        'subtitle' => '商品信息(信息分离)',
                                        'width' => '24',
                                    ),
                                15 =>
                                    array (
                                        'field' => 'paytype',
                                        'title' => '支付方式',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                16 =>
                                    array (
                                        'field' => 'dispatchname',
                                        'title' => '配送方式',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                17 =>
                                    array (
                                        'field' => 'goodsprice',
                                        'title' => '商品小计',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                18 =>
                                    array (
                                        'field' => 'dispatchprice',
                                        'title' => '运费',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                19 =>
                                    array (
                                        'field' => 'deductprice',
                                        'title' => '积分抵扣',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                20 =>
                                    array (
                                        'field' => 'deductcredit2',
                                        'title' => '余额抵扣',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                21 =>
                                    array (
                                        'field' => 'deductenough',
                                        'title' => '满额立减',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                22 =>
                                    array (
                                        'field' => 'couponprice',
                                        'title' => '优惠券优惠',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                23 =>
                                    array (
                                        'field' => 'changeprice',
                                        'title' => '订单改价',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                24 =>
                                    array (
                                        'field' => 'changedispatchprice',
                                        'title' => '运费改价',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                25 =>
                                    array (
                                        'field' => 'price',
                                        'title' => '应收款',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                26 =>
                                    array (
                                        'field' => 'status',
                                        'title' => '状态',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                27 =>
                                    array (
                                        'field' => 'createtime',
                                        'title' => '下单时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                28 =>
                                    array (
                                        'field' => 'paytime',
                                        'title' => '付款时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                29 =>
                                    array (
                                        'field' => 'sendtime',
                                        'title' => '发货时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                30 =>
                                    array (
                                        'field' => 'finishtime',
                                        'title' => '完成时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                31 =>
                                    array (
                                        'field' => 'expresscom',
                                        'title' => '快递公司',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                32 =>
                                    array (
                                        'field' => 'expresssn',
                                        'title' => '快递单号',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                33 =>
                                    array (
                                        'field' => 'remark',
                                        'title' => '订单备注',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                34 =>
                                    array (
                                        'field' => 'salerinfo',
                                        'title' => '核销员',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                35 =>
                                    array (
                                        'field' => 'storeinfo',
                                        'title' => '核销门店',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                36 =>
                                    array (
                                        'field' => 'order_diyformdata',
                                        'title' => '订单自定义信息',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                37 =>
                                    array (
                                        'field' => 'goods_diyformdata',
                                        'title' => '商品自定义信息',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                38 =>
                                    array (
                                        'field' => 'commission',
                                        'title' => '佣金总额',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                39 =>
                                    array (
                                        'field' => 'commission1',
                                        'title' => '一级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                40 =>
                                    array (
                                        'field' => 'commission2',
                                        'title' => '二级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                41 =>
                                    array (
                                        'field' => 'commission3',
                                        'title' => '三级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                42 =>
                                    array (
                                        'field' => 'commission4',
                                        'title' => '扣除佣金后利润',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                43 =>
                                    array (
                                        'field' => 'profit',
                                        'title' => '扣除佣金及运费后利润',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                44 =>
                                    array (
                                        'field' => 'group',
                                        'title' => '会员分组',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                            ),
                        '订单导出模板' =>
                            array (
                                0 =>
                                    array (
                                        'field' => 'ordersn',
                                        'title' => '订单编号',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                1 =>
                                    array (
                                        'field' => 'uid',
                                        'title' => '会员id',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                2 =>
                                    array (
                                        'field' => 'level',
                                        'title' => '会员等级',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                3 =>
                                    array (
                                        'field' => 'mrealname',
                                        'title' => '会员姓名',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                4 =>
                                    array (
                                        'field' => 'address_province',
                                        'title' => '收货地址',
                                        'subtitle' => '收货地址(省市区分离)',
                                        'width' => '12',
                                    ),
                                5 =>
                                    array (
                                        'field' => 'mmobile',
                                        'title' => '会员手机号',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                6 =>
                                    array (
                                        'field' => 'pickname',
                                        'title' => '自提门店',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                7 =>
                                    array (
                                        'field' => 'verifycode',
                                        'title' => '自提码',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                8 =>
                                    array (
                                        'field' => 'openid',
                                        'title' => 'openid',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                9 =>
                                    array (
                                        'field' => 'realname',
                                        'title' => '收货姓名(或自提人)',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                10 =>
                                    array (
                                        'field' => 'mobile',
                                        'title' => '联系电话',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                11 =>
                                    array (
                                        'field' => 'address',
                                        'title' => '收货地址',
                                        'subtitle' => '收货地址(省市区合并)',
                                        'width' => '24',
                                    ),
                                12 =>
                                    array (
                                        'field' => 'nickname',
                                        'title' => '粉丝昵称',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                13 =>
                                    array (
                                        'field' => 'goods_str',
                                        'title' => '商品信息',
                                        'subtitle' => '商品信息(信息合并)',
                                        'width' => '36',
                                    ),
                                14 =>
                                    array (
                                        'field' => 'goods_title',
                                        'title' => '商品信息',
                                        'subtitle' => '商品信息(信息分离)',
                                        'width' => '24',
                                    ),
                                15 =>
                                    array (
                                        'field' => 'paytype',
                                        'title' => '支付方式',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                16 =>
                                    array (
                                        'field' => 'dispatchname',
                                        'title' => '配送方式',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                17 =>
                                    array (
                                        'field' => 'goodsprice',
                                        'title' => '商品小计',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                18 =>
                                    array (
                                        'field' => 'deductprice',
                                        'title' => '积分抵扣',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                19 =>
                                    array (
                                        'field' => 'dispatchprice',
                                        'title' => '运费',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                20 =>
                                    array (
                                        'field' => 'deductcredit2',
                                        'title' => '余额抵扣',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                21 =>
                                    array (
                                        'field' => 'deductenough',
                                        'title' => '满额立减',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                22 =>
                                    array (
                                        'field' => 'couponprice',
                                        'title' => '优惠券优惠',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                23 =>
                                    array (
                                        'field' => 'changeprice',
                                        'title' => '订单改价',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                24 =>
                                    array (
                                        'field' => 'changedispatchprice',
                                        'title' => '运费改价',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                25 =>
                                    array (
                                        'field' => 'price',
                                        'title' => '应收款',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                26 =>
                                    array (
                                        'field' => 'status',
                                        'title' => '状态',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                27 =>
                                    array (
                                        'field' => 'createtime',
                                        'title' => '下单时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                28 =>
                                    array (
                                        'field' => 'paytime',
                                        'title' => '付款时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                29 =>
                                    array (
                                        'field' => 'finishtime',
                                        'title' => '完成时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                30 =>
                                    array (
                                        'field' => 'sendtime',
                                        'title' => '发货时间',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                31 =>
                                    array (
                                        'field' => 'expresscom',
                                        'title' => '快递公司',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                32 =>
                                    array (
                                        'field' => 'expresssn',
                                        'title' => '快递单号',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                33 =>
                                    array (
                                        'field' => 'remark',
                                        'title' => '订单备注',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                34 =>
                                    array (
                                        'field' => 'salerinfo',
                                        'title' => '核销员',
                                        'subtitle' => '',
                                        'width' => '24',
                                    ),
                                35 =>
                                    array (
                                        'field' => 'storeinfo',
                                        'title' => '核销门店',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                36 =>
                                    array (
                                        'field' => 'order_diyformdata',
                                        'title' => '订单自定义信息',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                37 =>
                                    array (
                                        'field' => 'goods_diyformdata',
                                        'title' => '商品自定义信息',
                                        'subtitle' => '',
                                        'width' => '36',
                                    ),
                                38 =>
                                    array (
                                        'field' => 'commission',
                                        'title' => '佣金总额',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                39 =>
                                    array (
                                        'field' => 'commission1',
                                        'title' => '一级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                40 =>
                                    array (
                                        'field' => 'commission2',
                                        'title' => '二级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                41 =>
                                    array (
                                        'field' => 'commission3',
                                        'title' => '三级佣金',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                42 =>
                                    array (
                                        'field' => 'commission4',
                                        'title' => '扣除佣金后利润',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                43 =>
                                    array (
                                        'field' => 'profit',
                                        'title' => '扣除佣金及运费后利润',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                                44 =>
                                    array (
                                        'field' => 'group',
                                        'title' => '会员分组',
                                        'subtitle' => '',
                                        'width' => '12',
                                    ),
                            ),
                    ),
                'ordercolumns' =>
                    array (
                        0 =>
                            array (
                                'field' => 'ordersn',
                                'title' => '订单编号',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        1 =>
                            array (
                                'field' => 'uid',
                                'title' => '会员id',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        2 =>
                            array (
                                'field' => 'level',
                                'title' => '会员等级',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        3 =>
                            array (
                                'field' => 'mrealname',
                                'title' => '会员姓名',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        4 =>
                            array (
                                'field' => 'address_province',
                                'title' => '收货地址',
                                'subtitle' => '收货地址(省市区分离)',
                                'width' => '12',
                            ),
                        5 =>
                            array (
                                'field' => 'mmobile',
                                'title' => '会员手机号',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        6 =>
                            array (
                                'field' => 'pickname',
                                'title' => '自提门店',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        7 =>
                            array (
                                'field' => 'verifycode',
                                'title' => '自提码',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        8 =>
                            array (
                                'field' => 'openid',
                                'title' => 'openid',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        9 =>
                            array (
                                'field' => 'realname',
                                'title' => '收货姓名(或自提人)',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        10 =>
                            array (
                                'field' => 'mobile',
                                'title' => '联系电话',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        11 =>
                            array (
                                'field' => 'address',
                                'title' => '收货地址',
                                'subtitle' => '收货地址(省市区合并)',
                                'width' => '24',
                            ),
                        12 =>
                            array (
                                'field' => 'nickname',
                                'title' => '粉丝昵称',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        13 =>
                            array (
                                'field' => 'goods_str',
                                'title' => '商品信息',
                                'subtitle' => '商品信息(信息合并)',
                                'width' => '36',
                            ),
                        14 =>
                            array (
                                'field' => 'goods_title',
                                'title' => '商品信息',
                                'subtitle' => '商品信息(信息分离)',
                                'width' => '24',
                            ),
                        15 =>
                            array (
                                'field' => 'paytype',
                                'title' => '支付方式',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        16 =>
                            array (
                                'field' => 'dispatchname',
                                'title' => '配送方式',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        17 =>
                            array (
                                'field' => 'goodsprice',
                                'title' => '商品小计',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        18 =>
                            array (
                                'field' => 'deductprice',
                                'title' => '积分抵扣',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        19 =>
                            array (
                                'field' => 'dispatchprice',
                                'title' => '运费',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        20 =>
                            array (
                                'field' => 'deductcredit2',
                                'title' => '余额抵扣',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        21 =>
                            array (
                                'field' => 'deductenough',
                                'title' => '满额立减',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        22 =>
                            array (
                                'field' => 'couponprice',
                                'title' => '优惠券优惠',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        23 =>
                            array (
                                'field' => 'changeprice',
                                'title' => '订单改价',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        24 =>
                            array (
                                'field' => 'changedispatchprice',
                                'title' => '运费改价',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        25 =>
                            array (
                                'field' => 'price',
                                'title' => '应收款',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        26 =>
                            array (
                                'field' => 'status',
                                'title' => '状态',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        27 =>
                            array (
                                'field' => 'createtime',
                                'title' => '下单时间',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        28 =>
                            array (
                                'field' => 'paytime',
                                'title' => '付款时间',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        29 =>
                            array (
                                'field' => 'finishtime',
                                'title' => '完成时间',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        30 =>
                            array (
                                'field' => 'sendtime',
                                'title' => '发货时间',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        31 =>
                            array (
                                'field' => 'expresscom',
                                'title' => '快递公司',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        32 =>
                            array (
                                'field' => 'expresssn',
                                'title' => '快递单号',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        33 =>
                            array (
                                'field' => 'remark',
                                'title' => '订单备注',
                                'subtitle' => '',
                                'width' => '36',
                            ),
                        34 =>
                            array (
                                'field' => 'salerinfo',
                                'title' => '核销员',
                                'subtitle' => '',
                                'width' => '24',
                            ),
                        35 =>
                            array (
                                'field' => 'storeinfo',
                                'title' => '核销门店',
                                'subtitle' => '',
                                'width' => '36',
                            ),
                        36 =>
                            array (
                                'field' => 'order_diyformdata',
                                'title' => '订单自定义信息',
                                'subtitle' => '',
                                'width' => '36',
                            ),
                        37 =>
                            array (
                                'field' => 'goods_diyformdata',
                                'title' => '商品自定义信息',
                                'subtitle' => '',
                                'width' => '36',
                            ),
                        38 =>
                            array (
                                'field' => 'commission',
                                'title' => '佣金总额',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        39 =>
                            array (
                                'field' => 'commission1',
                                'title' => '一级佣金',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        40 =>
                            array (
                                'field' => 'commission2',
                                'title' => '二级佣金',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        41 =>
                            array (
                                'field' => 'commission3',
                                'title' => '三级佣金',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        42 =>
                            array (
                                'field' => 'commission4',
                                'title' => '扣除佣金后利润',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        43 =>
                            array (
                                'field' => 'profit',
                                'title' => '扣除佣金及运费后利润',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                        44 =>
                            array (
                                'field' => 'group',
                                'title' => '会员分组',
                                'subtitle' => '',
                                'width' => '12',
                            ),
                    ),
                'indexrecommands' => NULL,
                'style' => 'default',
                'levelname' => '粉丝',
                'leveldiscount' => '0',
                'indexsort' =>
                    array (
                        'adv' =>
                            array (
                                'text' => '幻灯片',
                                'visible' => 1,
                            ),
                        'search' =>
                            array (
                                'text' => '搜索栏',
                                'visible' => 1,
                            ),
                        'nav' =>
                            array (
                                'text' => '导航栏',
                                'visible' => 1,
                            ),
                        'notice' =>
                            array (
                                'text' => '公告栏',
                                'visible' => 1,
                            ),
                        'seckill' =>
                            array (
                                'text' => '秒杀栏',
                                'visible' => 1,
                            ),
                        'cube' =>
                            array (
                                'text' => '魔方栏',
                                'visible' => 1,
                            ),
                        'banner' =>
                            array (
                                'text' => '广告栏',
                                'visible' => 1,
                            ),
                        'goods' =>
                            array (
                                'text' => '推荐栏',
                                'visible' => 1,
                            ),
                    ),
                'cubes' =>
                    array (
                        0 =>
                            array (
                                'img' => 'images/3/2019/07/BGHVPHx9hAzB4Vc6tXl9l5FxAT52p7.png',
                                'url' => './index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=dividend',
                            ),
                        1 =>
                            array (
                                'img' => '',
                                'url' => '',
                            ),
                        2 =>
                            array (
                                'img' => '',
                                'url' => '',
                            ),
                    ),
            ),
        'close' =>
            array (
                'flag' => 0,
                'url' => '',
                'detail' => '<p>商城正在升级，请耐心等待！</p><p>如有重要咨询，请联系客服（1378888888）</p>',
            ),
        'wap' =>
            array (
                'open' => 1,
                'inh5app' => '0',
                'mustbind' => '0',
                'bindrealname' => '0',
                'bindbirthday' => '0',
                'bindidnumber' => '0',
                'bindwechat' => '0',
                'style' => 'default3',
                'color' => '#0b5394',
                'bg' => '../addons/ewei_shopv2/template/account/default3/bg.jpg',
                'smsimgcode' => '0',
                'sms_reg' => '1',
                'sms_forget' => '1',
                'sms_changepwd' => '1',
                'sms_bind' => '1',
                'headerbgcolor' => '',
                'headercolor' => '',
                'headericoncolor' => '',
                'statusbar' => '0',
                'loginbg' => NULL,
                'regbg' => NULL,
                'sns' =>
                    array (
                        'qq' => 1,
                        'wx' => 1,
                    ),
            ),
        'category' =>
            array (
                'level' => '3',
                'show' => '1',
                'style' => '1',
                'advimg' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                'advurl' => '',
            ),
        'wxpaycert_view' =>
            array (
                'wxpaycert_view_click' => 1,
            ),
        'notice_redis' =>
            array (
                'notice_redis_click' => 1,
            ),
        'sale' =>
            array (
                'virtual' =>
                    array (
                        'status' => 1,
                        'virtual_people' => 12,
                        'virtual_commission' => 11,
                        'virtual_text' => '[昵称] [会员数] [分销商数] [排名]',
                        'virtual_text2' => '[昵称] [会员数] [分销商数]',
                    ),
            ),
        'share' =>
            array (
                'followurl' => '',
                'followqrcode' => 'images/3/2019/11/iSeQlKYpyUk0qy5UsQk0QpYg0LDsgu.jpg',
                'title' => '商城分享',
                'icon' => 'images/3/2019/07/FM536ylIzk5k88KMlY9sIM9SSTk3y5.jpg',
                'desc' => '一道电商致力于社交电商的发展',
                'url' => '',
                'goods_detail_close' => '0',
                'goods_detail_text' => '12346789',
                'logo' => 'images/3/2019/07/FM536ylIzk5k88KMlY9sIM9SSTk3y5.jpg',
            ),
        'template' =>
            array (
                'style' => 'default',
                'detail_temp' => '1',
            ),
        'trade' =>
            array (
                'set_realname' => '0',
                'set_mobile' => '0',
                'invoice_entity' => 0,
                'closeorder' => '',
                'willcloseorder' => '',
                'stockwarn' => '50',
                'receive' => '',
                'shop_strengthen' => '1',
                'refunddays' => '',
                'refundcontent' => '',
                'pickuptext' => '上门自提',
                'credittext' => '积分',
                'moneytext' => '零钱',
                'closerecharge' => '0',
                'money' => '1',
                'credit' => '0',
                'minimumcharge' => 100.0,
                'withdraw' => '1',
                'withdrawmoney' => '',
                'withdrawcharge' => '',
                'withdrawbegin' => 0.0,
                'withdrawend' => 0.0,
                'maxcredit' => '0',
                'closecomment' => '0',
                'closecommentshow' => '0',
                'commentchecked' => '0',
                'shareaddress' => '1',
                'istimetext' => '限时购',
                'nodispatchareas' => 's:0:"";',
                'nodispatchareas_code' => 's:0:"";',
                'single_refund' => '1',
                'withdrawcashweixin' => 1,
                'withdrawcashalipay' => 1,
                'withdrawcashcard' => 1,
            ),
        'printer' =>
            array (
                'order_printer' => '1',
                'order_template' => 1,
                'printer_merch' => 1,
                'printer_recharge' => 1,
                'ordertype' => '1,2,3',
            ),
        'verify' =>
            array (
                'keyword' => '111111',
                'type' => '0',
            ),
        'rank' =>
            array (
                'status' => 1,
                'order_status' => 1,
                'num' => 10,
                'order_num' => 10,
            ),
        'notice' =>
            array (
                'saler_pay_template' => '',
                'saler_pay_close_advanced' => '0',
                'saler_pay_sms' => '',
                'saler_pay_close_sms' => '0',
                'mobile' => '',
                'saler_finish_template' => '',
                'saler_finish_close_advanced' => '0',
                'saler_finish_sms' => '',
                'saler_finish_close_sms' => '0',
                'mobile2' => '',
                'saler_stockwarn_template' => '',
                'saler_stockwarn_close_advanced' => '0',
                'saler_stockwarn_sms' => '',
                'saler_stockwarn_close_sms' => '0',
                'mobile3' => '',
                'saler_refund_template' => '',
                'saler_refund_close_advanced' => '0',
                'saler_refund_sms' => '',
                'saler_refund_close_sms' => '0',
                'mobile4' => '',
                'saler_goodpay_template' => '',
                'saler_goodpay_close_advanced' => '0',
                'saler_goodpay_sms' => '',
                'saler_goodpay_close_sms' => '0',
                'carrier_template' => '',
                'carrier_close_advanced' => '0',
                'carrier_sms' => '',
                'carrier_close_sms' => '0',
                'cancel_template' => '',
                'cancel_close_advanced' => '0',
                'cancel_sms' => '',
                'cancel_close_sms' => '0',
                'willcancel_template' => '',
                'willcancel_close_advanced' => '0',
                'willcancel_sms' => '',
                'willcancel_close_sms' => '0',
                'pay_template' => '',
                'pay_close_advanced' => '0',
                'pay_sms' => '',
                'pay_close_sms' => '0',
                'send_template' => '',
                'send_close_advanced' => '0',
                'send_sms' => '1',
                'send_close_sms' => '0',
                'virtualsend_template' => '',
                'virtualsend_close_advanced' => '0',
                'virtualsend_sms' => '',
                'virtualsend_close_sms' => '0',
                'orderstatus_template' => '',
                'orderstatus_close_advanced' => '0',
                'orderstatus_sms' => '',
                'orderstatus_close_sms' => '0',
                'refund1_template' => '',
                'refund1_close_advanced' => '0',
                'refund1_sms' => '',
                'refund1_close_sms' => '0',
                'refund3_template' => '',
                'refund3_close_advanced' => '0',
                'refund3_sms' => '',
                'refund3_close_sms' => '0',
                'refund4_template' => '',
                'refund4_close_advanced' => '0',
                'refund4_sms' => '',
                'refund4_close_sms' => '0',
                'refund2_template' => '',
                'refund2_close_advanced' => '0',
                'refund2_sms' => '',
                'refund2_close_sms' => '0',
                'recharge_ok_template' => '',
                'recharge_ok_close_advanced' => '0',
                'recharge_ok_sms' => '',
                'recharge_ok_close_sms' => '0',
                'withdraw_ok_template' => '',
                'withdraw_ok_close_advanced' => '0',
                'withdraw_ok_sms' => '',
                'withdraw_ok_close_sms' => '0',
                'backrecharge_ok_template' => '',
                'backrecharge_ok_close_advanced' => '0',
                'backrecharge_ok_sms' => '',
                'backrecharge_ok_close_sms' => '0',
                'backpoint_ok_template' => '',
                'backpoint_ok_close_advanced' => '0',
                'backpoint_ok_sms' => '',
                'backpoint_ok_close_sms' => '0',
                'upgrade_template' => '',
                'upgrade_close_advanced' => '0',
                'upgrade_sms' => '',
                'upgrade_close_sms' => '0',
                'o2o_sverify_template' => '',
                'o2o_sverify_close_advanced' => '0',
                'o2o_sverify_sms' => '',
                'o2o_sverify_close_sms' => '0',
                'o2o_bverify_template' => '',
                'o2o_bverify_close_advanced' => '0',
                'o2o_bverify_sms' => '',
                'o2o_bverify_close_sms' => '0',
                'openid' => '',
                'openid2' => '',
                'openid3' => '',
                'openid4' => '',
            ),
        'app' =>
            array (
                'appid' => 'wxc96a60905545aab0',
                'secret' => '1ed4ff4c01ff2d185416fb67d078fcf6',
                'isclose' => 0,
                'closetext' => '',
                'openbind' => 0,
                'sms_bind' => 0,
                'bindtext' => '',
                'hidecom' => 0,
                'navbar' => 0,
                'sendappurl' => '0',
                'customer' => 0,
                'customercolor' => '#ffb137',
                'tmessage_pay' => 0,
                'tmessage_send' => 0,
                'tmessage_virtualsend' => 0,
                'tmessage_finish' => 0,
                'phone' => 0,
                'phonenumber' => '',
                'phonecolor' => '#ffb137',
                'tabbar' => 'a:5:{s:5:"color";s:7:"#999999";s:13:"selectedColor";s:7:"#ff5555";s:11:"borderStyle";s:0:"";s:15:"backgroundColor";s:7:"#f7f7fa";s:4:"list";a:4:{i:0;a:4:{s:8:"pagePath";s:17:"pages/index/index";s:8:"iconPath";s:31:"static/images/tabbar/icon-1.png";s:16:"selectedIconPath";s:38:"static/images/tabbar/icon-1-active.png";s:4:"text";s:6:"首页";}i:1;a:4:{s:8:"pagePath";s:25:"pages/shop/caregory/index";s:8:"iconPath";s:31:"static/images/tabbar/icon-2.png";s:16:"selectedIconPath";s:38:"static/images/tabbar/icon-2-active.png";s:4:"text";s:12:"全部分类";}i:2;a:4:{s:8:"pagePath";s:23:"pages/member/cart/index";s:8:"iconPath";s:31:"static/images/tabbar/icon-4.png";s:16:"selectedIconPath";s:38:"static/images/tabbar/icon-4-active.png";s:4:"text";s:9:"购物车";}i:3;a:4:{s:8:"pagePath";s:24:"pages/member/index/index";s:8:"iconPath";s:31:"static/images/tabbar/icon-5.png";s:16:"selectedIconPath";s:38:"static/images/tabbar/icon-5-active.png";s:4:"text";s:12:"会员中心";}}}',
            ),
    );

    public const PLUGINS = array(
        'taobao' =>
            array(
                'taobao_status' => 1,
            ),
        'sale' =>
            array(
                'enoughmoney' => 0.0,
                'enoughdeduct' => 0.0,
                'enoughs' =>
                    array(),
                'enoughfree' => 0,
                'enoughorder' => 100.0,
                'enoughareas' => '',
                'enoughareas_code' => '',
                'goodsids' => null,
                'recharges' => 'a:0:{}',
                'bindmobile' => 1,
                'bindmobilecredit' => 500,
                'peerpay' =>
                    array(
                        'open' => '1',
                        'self_peerpay' => '100',
                        'peerpay_price' => '100',
                        'peerpay_privilege' => '20',
                        'enough1' =>
                            array(
                                0 => '代付一下吧',
                            ),
                        'enough2' =>
                            array(),
                    ),
                'credit1' => 'a:4:{s:12:"isgoodspoint";i:1;s:7:"enough1";a:1:{i:0;a:3:{s:9:"enough1_1";d:1;s:9:"enough1_2";d:500;s:5:"give1";i:1;}}s:7:"enough2";a:2:{i:0;a:3:{s:9:"enough2_1";d:100;s:9:"enough2_2";d:500;s:5:"give2";i:1;}i:1;a:3:{s:9:"enough2_1";d:500;s:9:"enough2_2";d:1000;s:5:"give2";i:2;}}s:7:"paytype";a:4:{i:1;s:1:"1";i:21;s:1:"1";i:22;s:1:"1";i:3;s:1:"1";}}',
                'creditdeduct' => 1,
                'credit' => 1,
                'moneydeduct' => 0,
                'money' => 1.0,
                'dispatchnodeduct' => 0,
            ),
        'coupon' =>
            array(
                'consumedesc' => '<p>购物即赠券，下次使用</p>',
                'rechargedesc' => '<p>抵扣充值金额</p>',
                'closemember' => '0',
                'closecenter' => '0',
                'showtemplate' => '1',
                'templateid' => '',
                'advs' =>
                    array(
                        0 =>
                            array(
                                'img' => 'images/3/2019/08/KNCdBI800bC8CIIZtp4BdzYiZzID0f.jpg',
                                'url' => '',
                            ),
                    ),
                'sendtemplateid' => '',
                'frist' => '',
                'fristcolor' => '#000000',
                'keyword1' => '恭喜您获得优惠卷',
                'keyword1color' => '#000000',
                'keyword2' => '请您点击查看',
                'keyword2color' => '#000000',
                'remark' => '',
                'remarkcolor' => '#000000',
                'templateurl' => '',
                'custitle' => '',
                'custhumb' => '',
                'cusdesc' => '',
                'cusurl' => '',
                'isopensendtask' => 1,
                'isopengoodssendtask' => 1,
            ),
        'diypage' =>
            array(
                'page' =>
                    array(
                        'home' => '6',
                        'member' => '15',
                        'detail' => '',
                        'commission' => '',
                        'creditshop' => '',
                        'seckill' => '',
                        'exchange' => '',
                    ),
                'layer' =>
                    array(
                        'params' =>
                            array(
                                'isopen' => '0',
                                'imgurl' => 'images/3/2019/07/CuA8E57ad4ntL7DteUT5Ul5La97A8p.jpg',
                                'linkurl' => './index.php?i=3&c=entry&m=ewei_shopv2&do=mobile&r=creditshop',
                                'iconposition' => 'left bottom',
                            ),
                        'style' =>
                            array(
                                'width' => '26',
                                'top' => '46',
                                'left' => '29',
                            ),
                        'merch' => '0',
                    ),
                'menu' =>
                    array(
                        'shop' => '3',
                        'shop_wap' => '1',
                        'creditshop' => '3',
                        'creditshop_wap' => '1',
                        'commission' => '3',
                        'commission_wap' => '1',
                        'groups' => '3',
                        'groups_wap' => '1',
                        'sns' => '3',
                        'sns_wap' => '1',
                        'sign' => '3',
                        'sign_wap' => '1',
                        'seckill' => '3',
                        'seckill_wap' => '1',
                    ),
                'followbar' =>
                    array(
                        'params' =>
                            array(
                                'logo' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                                'isopen' => '1',
                                'icontype' => '1',
                                'iconurl' => '',
                                'iconstyle' => '',
                                'defaulttext' => '',
                                'sharetext' => '',
                                'btntext' => '点击关注',
                                'btnicon' => '',
                                'btnclick' => '1',
                                'btnlinktype' => '0',
                                'btnlink' => '',
                                'qrcodetype' => '0',
                                'qrcodeurl' => '',
                            ),
                        'style' =>
                            array(
                                'background' => '#444444',
                                'textcolor' => '#ffffff',
                                'btnbgcolor' => '#04be02',
                                'btncolor' => '#ffffff',
                                'highlight' => '#ffffff',
                            ),
                        'merch' => '0',
                    ),
            ),
        'merch' =>
            array(
                'is_openmerch' => '1',
                'deduct_commission' => '0',
                'apply_openmobile' => '1',
                'open_protocol' => '1',
                'regbg' => '',
                'apply_diyform' => '0',
                'apply_diyformid' => '0',
                'reglogo' => '',
                'regpic' => '',
                'applytitle' => '',
                'applycontent' => '',
                'applycashweixin' => 0,
                'applycashalipay' => 0,
                'applycashcard' => 1,
            ),
        'commission' =>
            array(
                'level' => '2',
                'calcutype' => '2',
                'commissiontype' => '1',
                'selfbuy' => '1',
                'cansee' => '1',
                'seetitle' => '可获得佣金',
                'become_child' => '0',
                'hideicode' => '0',
                'become' => '3',
                'become_ordercount' => '',
                'become_moneycount' => '398',
                'become_check' => '1',
                'become_order' => '1',
                'open_protocol' => '0',
                'become_reg' => '1',
                'no_commission_url' => '',
                'withdraw' => '100',
                'withdrawcharge' => 2.0,
                'withdrawbegin' => 0.0,
                'withdrawend' => 0.0,
                'settledays' => '7',
                'levelurl' => '',
                'qrcodeshare' => '1',
                'codeShare' => '1',
                'openorderdetail' => '1',
                'openorderbuyer' => '1',
                'closed_qrcode' => '0',
                'qrcode' => '0',
                'qrcode_title' => '',
                'qrcode_content' => '',
                'qrcode_remark' => '',
                'register_bottom' => '0',
                'register_bottom_title1' => '',
                'register_bottom_content1' => '',
                'register_bottom_title2' => '',
                'register_bottom_content2' => '',
                'register_bottom_title3' => '',
                'register_bottom_content3' => '',
                'register_bottom_remark' => '',
                'register_bottom_content' => '',
                'closemyshop' => '1',
                'select_goods' => '0',
                'weishop_moneytype' => '0',
                'weishop_settledays' => '',
                'style' => 'default',
                'regbg' => '',
                'applytitle' => '',
                'applycontent' => '',
                'leveltype' => '["0","4","8","9"]',
                'cashcredit' => 0,
                'cashweixin' => 1,
                'cashother' => 0,
                'cashalipay' => 0,
                'cashcard' => 0,
                'become_goodsid' => 0,
                'texts' =>
                    array(
                        'agent' => '分销商',
                        'shop' => '小店',
                        'myshop' => '我的小店',
                        'center' => '分销中心',
                        'become' => '成为分销商',
                        'withdraw' => '提现',
                        'commission' => '佣金',
                        'commission1' => '分销佣金',
                        'commission_total' => '累计佣金',
                        'commission_ok' => '可提现佣金',
                        'commission_apply' => '已申请佣金',
                        'commission_check' => '待打款佣金',
                        'commission_lock' => '未结算佣金',
                        'commission_wait' => '待收货佣金',
                        'commission_fail' => '无效佣金',
                        'commission_pay' => '成功提现佣金',
                        'commission_charge' => '扣除提现手续费',
                        'commission_detail' => '佣金明细',
                        'order' => '分销订单',
                        'down' => '下线',
                        'mydown' => '我的下线',
                        'c1' => '一级',
                        'c2' => '二级',
                        'c3' => '三级',
                        'yuan' => '元',
                        'icode' => '邀请码',
                    ),
                'levelname' => '默认等级',
                'commission1' => '0',
                'commission2' => '',
                'commission3' => '0',
                'tm' =>
                    array(
                        'is_advanced' => '1',
                        'templateid' => '',
                        'commission_applymoney_title' => '',
                        'commission_applymoney' => '',
                        'commission_become_sms' => '',
                        'commission_becometitle' => '成为分销商通知',
                        'commission_become' => '恭喜 [昵称] 成为一道未店分销商，[时间]',
                        'commission_agent_newtitle' => '新增下线通知',
                        'commission_agent_new_notice' => '2',
                        'commission_agent_new' => '您的朋友 [下级昵称] 成为分销商[时间] [下线层级]',
                        'commission_agent_sms' => '',
                        'commission_order_paytitle' => '下级付款通知',
                        'commission_order_pay_notice' => '2',
                        'commission_order_pay' => ' 您的朋友[下级昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间] [下线层级]',
                        'commission_order_pay_sms' => '',
                        'commission_order_finishtitle' => '下级确认收货通知',
                        'commission_order_finish_notice' => '2',
                        'commission_order_finish' => ' 您的朋友[下级昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间] [下线层级]',
                        'commission_order_finish_sms' => '',
                        'commission_applytitle' => '',
                        'commission_apply' => '',
                        'commission_apply_sms' => '',
                        'commission_checktitle' => '',
                        'commission_check' => '',
                        'commission_check_sms' => '',
                        'commission_paytitle' => '',
                        'commission_pay' => '',
                        'commission_pay_sms' => '',
                        'commission_upgradetitle' => '',
                        'commission_upgrade' => '',
                        'commission_upgrade_sms' => '',
                        'commission_applymoney_advanced' => '',
                        'commission_applymoney_notice' => '0',
                        'commission_become_advanced' => '',
                        'commission_become_close_advanced' => '0',
                        'commission_agent_new_advanced' => '',
                        'commission_agent_new_close_advanced' => '0',
                        'commission_agent_new_sms_advanced' => '',
                        'carrier_close_sms' => '0',
                        'commission_agent_new_advanced_notice' => '0',
                        'commission_order_pay_advanced' => '',
                        'commission_order_pay_close_advanced' => '0',
                        'commission_order_pay_sms_advanced' => '',
                        'commission_order_pay_advanced_notice' => '0',
                        'commission_order_finish_advanced' => '',
                        'commission_order_finish_close_advanced' => '0',
                        'commission_order_finish_sms_advanced' => '',
                        'commission_order_finish_advanced_notice' => '0',
                        'commission_apply_advanced' => '',
                        'commission_apply_close_advanced' => '0',
                        'commission_apply_sms_advanced' => '',
                        'commission_check_advanced' => '',
                        'commission_check_close_advanced' => '0',
                        'commission_check_sms_advanced' => '',
                        'commission_pay_advanced' => '',
                        'commission_pay_close_advanced' => '0',
                        'commission_pay_sms_advanced' => '',
                        'commission_upgrade_advanced' => '',
                        'commission_upgrade_close_advanced' => '0',
                        'commission_upgrade_sms_advanced' => '',
                        'openid1' => '',
                        'openid' => '',
                    ),
                'weishop_paytype' => '2',
                'rank' =>
                    array(
                        'type' => 0,
                        'num' => 10,
                        'title' => '',
                        'status' => 1,
                        'content' =>
                            array(),
                    ),
                'subcredit' => 0,
                'submoney' => null,
                'reccredit' => 10,
                'recmoney' => null,
                'reccredit_totle' => 100,
                'recmoney_totle' => 0.0,
                'paytype' => 0,
            ),
        'abonus' =>
            array(
                'levelname' => '默认等级',
                'bonus1' => '2.5',
                'bonus2' => '1.5',
                'bonus3' => '1',
                'bonus4' => '0',
                'open' => '1',
                'open_town' => '1',
                'selfbuy' => '0',
                'become' => '1',
                'open_protocol' => '1',
                'noregdesc' => 'hello，想成为区域代理商吗？请立即联系我们！',
                'moneytype' => '0',
                'bonusrate' => '100',
                'settledays' => '',
                'paycharge' => '',
                'paybegin' => '',
                'payend' => '',
                'levelurl' => '',
                'openmembercenter' => '1',
                'closecommissioncenter' => '0',
                'centerdesc' => 'hello 小哪吒',
                'register_bottom' => '0',
                'register_bottom_title1' => '',
                'register_bottom_content1' => '',
                'register_bottom_title2' => '',
                'register_bottom_content2' => '',
                'register_bottom_remark' => '',
                'register_bottom_content' => '',
                'style' => 'default',
                'regbg' => '',
                'applytitle' => '小哪吒区域代理协议',
                'applycontent' => '<p>一道宝为您提供一站式营销解决方案，全渠道立体化裂变营销，多种营销场景快速传播，引爆市场挖掘优质潜在客户，让粉丝变得更轻松！</p>',
                'leveltype' => '["6","7","8","9"]',
                'withdrawbegin' => 0.0,
                'withdrawend' => 0.0,
                'become_goodsid' => 0,
                'texts' =>
                    array(
                        'aagent' => '区域代理',
                        'center' => '区域代理中心',
                        'become' => '成为区域代理',
                        'bonus' => '分红',
                        'bonus_total' => '累计分红',
                        'bonus_lock' => '待结算分红',
                        'bonus_wait' => '预计分红',
                        'bonus_pay' => '已结算分红',
                        'bonus_detail' => '分红明细',
                        'bonus_charge' => '扣除提现手续费',
                    ),
                'tm' =>
                    array(
                        'is_advanced' => '1',
                        'templateid' => '',
                        'becometitle' => '',
                        'become' => '',
                        'paytitle1' => '',
                        'pay1' => '',
                        'paytitle2' => '',
                        'pay2' => '',
                        'paytitle3' => '',
                        'pay3' => '',
                        'paytitle4' => '',
                        'pay4' => '',
                        'upgradetitle' => '',
                        'upgrade1' => '',
                        'upgradetitle2' => '',
                        'upgrade2' => '',
                        'upgradetitle3' => '',
                        'upgrade3' => '',
                        'upgradetitle4' => '',
                        'abonus_become_advanced' => '',
                        'abonus_become_close_advanced' => '0',
                        'abonus_upgrade1_advanced' => '',
                        'abonus_upgrade1_close_advanced' => '0',
                        'abonus_upgrade2_advanced' => '',
                        'abonus_upgrade2_close_advanced' => '0',
                        'abonus_upgrade3_advanced' => '',
                        'abonus_upgrade3_close_advanced' => '0',
                        'abonus_upgrade4_advanced' => '',
                        'abonus_upgrade4_close_advanced' => '0',
                        'abonus_pay_advanced' => '',
                        'abonus_pay_close_advanced' => '0',
                    ),
                'paytype' => '2',
            ),
        'globonus' =>
            array(
                'open' => '1',
                'selfbuy' => '1',
                'become' => '4',
                'become_ordercount' => '10',
                'become_moneycount' => '1000',
                'become_check' => '1',
                'become_order' => '1',
                'open_protocol' => '1',
                'noregdesc' => '',
                'moneytype' => '0',
                'bonusrate' => '100',
                'settledays' => '',
                'paycharge' => '',
                'paybegin' => '',
                'payend' => '',
                'levelurl' => '',
                'openmembercenter' => '1',
                'closecommissioncenter' => '0',
                'centerdesc' => '欢迎加入小哪吒店铺',
                'register_bottom' => '0',
                'register_bottom_title1' => '',
                'register_bottom_content1' => '',
                'register_bottom_title2' => '',
                'register_bottom_content2' => '',
                'register_bottom_remark' => '',
                'register_bottom_content' => '',
                'style' => 'default',
                'regbg' => 'images/3/2019/10/KUNaTNtxFXkVNtNnXU9U9tTlFXK8V3.jpg',
                'applytitle' => '',
                'applycontent' => '',
                'leveltype' => '["0","1","2","3","4","5","6","7","8","9"]',
                'withdrawbegin' => 0.0,
                'withdrawend' => 0.0,
                'become_goodsid' => 56,
                'texts' =>
                    array(
                        'partner' => '店铺123',
                        'center' => '店铺中心',
                        'become' => '成为店铺',
                        'bonus' => '分红',
                        'bonus_total' => '累计分红',
                        'bonus_lock' => '待结算分红',
                        'bonus_wait' => '预计分红',
                        'bonus_pay' => '已结算分红',
                        'bonus_detail' => '分红明细',
                        'bonus_charge' => '扣除提现手续费',
                    ),
                'paytype' => '1',
                'levelname' => '默认等级',
                'bonus' => '',
                'achievement_weight' => 0,
                'open_flatlevel' => '1',
                'flatlevel_rate' => '100',
                'flatlevel_switch' => '1',
                'leveling' => '2',
                'leveling_gen' => '["0.1","0.01"]',
            ),
        'achievement' =>
            array(
                'open' => '1',
                'paytype' => '2',
                'moneytype' => '0',
                'bonusrate' => '6',
                'settledays' => '',
                'paycharge' => '',
                'paybegin' => '',
                'payend' => '',
                'openmembercenter' => '1',
                'closecommissioncenter' => '0',
                'register_bottom_title1' => '',
                'register_bottom_content1' => '',
                'register_bottom_title2' => '',
                'register_bottom_content2' => '',
                'register_bottom_remark' => '',
                'register_bottom_content' => '',
                'style' => 'default',
                'withdrawbegin' => 0.0,
                'withdrawend' => 0.0,
                'applycontent' => '',
                'regbg' => null,
                'become_goodsid' => 0,
                'texts' =>
                    array(
                        'center' => '绩效奖励',
                        'bonus' => '分红',
                        'bonus_total' => '累计分红',
                        'bonus_lock' => '待结算分红',
                        'bonus_pay' => '已结算分红',
                        'bonus_detail' => '分红明细',
                    ),
            ),
        'groups' =>
            array(
                'exchangekeyword' => '',
            ),
        'mmanage' =>
            array(
                'keyword' => '手机商家',
                'title' => '',
                'thumb' => '',
                'desc' => '',
                'status' => 1,
                'open' => 1,
            ),
        'verify' =>
            array(
                'keyword' => '111111',
                'type' => '0',
            ),
        'membercard' =>
            array(
                'view' => 'gird',
            ),
        'creditshop' =>
            array(
                'set_realname' => 0,
                'set_mobile' => 0,
                'exchangekeyword' => '',
                'sendname' => '',
                'wishing' => '',
                'centeropen' => '0',
                'followurl' => '',
                'crediturl' => '',
                'share_title' => '',
                'share_icon' => '',
                'share_desc' => '',
                'importantdetail' => '',
                'isreply' => '0',
                'desckeyword' => '',
                'replykeyword' => '',
                'isdetail' => 0,
                'detail' => '',
                'isnoticedetail' => 0,
                'noticedetail' => '',
                'style' => 'default',
            ),
    );

    public const SEC = array(
        'alipay_id' => 0,
        'app_wechat' =>
            array(
                'appid' => '',
                'appsecret' => '',
                'merchname' => '',
                'merchid' => '',
                'apikey' => '',
            ),
        'alipay_pay' =>
            array(
                'sign_type' => '0',
                'partner' => '',
                'account_name' => '',
                'email' => '',
                'key' => '',
                'app_id' => '',
                'single_alipay_sign_type' => '0',
                'single_public_key' => '',
                'single_private_key' => '',
            ),
        'app_alipay' =>
            array(
                'public_key' => '',
                'private_key' => '',
                'public_key_rsa2' => '',
                'private_key_rsa2' => '',
                'appid' => '',
            ),
        'wxapp' =>
            array(
                'mchid' => '1534608831',
                'apikey' => 'hd5JiRBnehbOuRAiXJAnMkf0OR6xdMUj',
            ),
        'wxapp_cert' => '-----BEGIN CERTIFICATE-----
MIIDfTCCAmWgAwIBAgIJALafMmZlceENMA0GCSqGSIb3DQEBCwUAMFUxCzAJBgNV
BAYTAmNuMREwDwYDVQQIDAh6aGVqaWFuZzEVMBMGA1UEBwwMRGVmYXVsdCBDaXR5
MRwwGgYDVQQKDBNEZWZhdWx0IENvbXBhbnkgTHRkMB4XDTE5MTExNjAyMjYwMloX
DTIwMTExNTAyMjYwMlowVTELMAkGA1UEBhMCY24xETAPBgNVBAgMCHpoZWppYW5n
MRUwEwYDVQQHDAxEZWZhdWx0IENpdHkxHDAaBgNVBAoME0RlZmF1bHQgQ29tcGFu
eSBMdGQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDFqoMQF9IRjxTB
UmS+JxX2NvAFgtdAx4Qribv1h+50S4+baN/LH38hSHQG1hatGYdtgnIla1gRITft
Fj7PCQHxYLjCm8BJX/pN2QU86wCudSqiXkvQxpGdiZI7wombq/9Ge82DukATtMs+
ZQ+hSTQbTn4Ul4s3PtAEtb181PTuUQXyuBBIpWHUnw9RL/MjTe1KPcLeSK07DnZM
HgklSQuqzCFz/tQRNlvywlII2G4KnsV11j5yksrvDMqXDnZ8YmxRYn0+ZJ6jrca/
EXHAMJS7W4NTr4REbSXz7w0o2ixhMMZIEYbeSsPz0IIaBX7jOYY2ubJiONyR5N+c
m0IIoSCrAgMBAAGjUDBOMB0GA1UdDgQWBBQayHFvbQHTVlCAvxCienFjCXd0qzAf
BgNVHSMEGDAWgBQayHFvbQHTVlCAvxCienFjCXd0qzAMBgNVHRMEBTADAQH/MA0G
CSqGSIb3DQEBCwUAA4IBAQBFeqrzDPHKGbkWqcKN4TnmZnTa6Tum/aH3CFudBQfE
882l4wp2/pBe6B2jbRvNFdLsYR6MFCt5Yea1FwVTCEhDU4N9DRGGMbvs0aKaIHmr
YCVYmTIrEBpLIdfC3j6iPbhI7VZLjhoIClHImeAxORXcIEqM8E+NBZ90+5Mkuhpu
qnHD31EnecphGhQCsg202JOHeIvqEnMGk14X9ylX7GK953QDxHx69YEu+YnxUY+L
njRnsk1LEmQRFhn/lLDpplCYV5VIb5Kz0JTWx04QzK0EHcgWYuk+LHA+JkaaWeBz
ko7JnxYwXia+TUrQabvEdZs17Vau/vtqF3dtTL+tuuus
-----END CERTIFICATE-----
',
        'wxapp_key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAsf2RcZ6WsmdAf38uUwOoH2EEGyMXPlHLBM7VzTqrAudpA5pd
BMRNCSB2Z9lWeHX70Ryjk65LfkXF6QCUqI1NcIyE4m2YC4Gq+SD0PwnXr5EiUn0y
ItzKHwzf7X/iasnXveZVaLBsZ7COjmHXyX41O3xVv5EvSvRWY5LeCemIf4Z5HQX5
Y/CLbvgvBQzn08nm9wygv8vHaKdlzOd1dnBBoVv2PIJk4DfOzXlqACs80YNWCCPo
x+TYFgRJ0pFybAHu1DDONO0v1K58MJcsdfPXU7XedEoYRf7tdFVDwD010kOxcUp3
KN1/hqIz8kE3W5x5BnKgzGSV7gCCfV30TguP6QIDAQABAoIBAES3lu18wsWB437V
xTa7lK74r7MiaxjeTzk9+YFQgzGN0hdYA02R1AQQCmaxnBbJxjzHh8e+ZNsNaQk5
9irU0u7+8VbR5P+cQjwIowOrcyAPMmcSesbG4yn1uIZi9zEvWCGyyYqvgkrN+Vuz
HrJmDXs314ssLEwN5URwMVU2WkKRLSV/fSS/4Rz71FBlHK4cxoid8Vdqsl3zfjHz
LEX55W/u9dVNDV4HKdMdTbxSOxi2KAGfb9xiMdnMmOuRmn4GN8Rq3b4FBiW6QNr2
Qj/VnHdfEbOQ5PwZg8/x6pe5zr49m0Qq5F2YaueNscjRToJ6WWlBA7WIzo+PMrmf
CI+BpuECgYEA4TKdAAZUg5EPr2R+RGuMQdG4avdum7Mm/GCOWo6pp5vgsLN6nGll
s2Xo+sHiARfqcVbLbArsACdhpIEktMGYRRMEOp5da9s9v6lDsbaqyoZ67y0Ymi5O
b4dwAacbgnRnpFQj1CC3B3ku0GG2sS1aGcm91SvCjt3m/IV6K8J6wZUCgYEAylX5
0E4oz5VAxexYWw19ZpqW03HBYR/SFL46Pl3eZ5NuD2cLw0CvbL+oi/YbLt2qIHNZ
e+kLZal8ZK8cLrm5T/aHZF6fbRh1GfbQDrqXlMZQeYVfBFhq+9Dz9sj5fORcnNlr
wY/2oIYhKIhGIoCmVjdRu44NLIPj1eP1z7ksqAUCgYEA1MMa7hEM/Birdww896uc
ofrgf78x80y5wqv/ErPCuiZdjNSlPO2fNnVMPs27F0lfKKHWI0fWXPbYG7If2d8m
W+xxjGhe3y4OEux6loZ8qkeQEjTLD7A8TsbpHcaiCQiteuY7y4j1I8xsXFhVYOP2
QnMGNUbY1F32hBIfsQRXMlkCgYEAwKEToS4YCnCk5wl4oM75+Qnp18nv+gBqaBcm
qiOBzof8eyt2dmAJ4vWgiAc4n+imxBgtNBuNHy85Xz2bDh0BANDK21J+Y0Wqjpp8
P9mC4D/hc5/28tMenziyWtvBMhbS2Pzharkdanvn64e5hbWHJoOqC25UunGiIgrS
Bf3cNuUCgYEAx0oMQW7dR+2XiO5MF4HIrfs+tTxw8LO01cW+Ph6Op2mblGHGLnNW
HVVUbZdU6pEN8bJpzoUIFX0z+ybEqs06t0qRUmmEC97bnUUUiSYJdreVGU5cmYHG
ErP2drGI58sZk1jpYUvAvaZpNsvinuF3n8feuIrzIzjHJsEtmZHXB6Q=
-----END RSA PRIVATE KEY-----
',
    );

    private $sets;
    private $plugins;
    private $sec;

    public function setSets(array $sets): void
    {
        $this->sets = $sets;
    }

    public function setPlugins(array $plugins): void
    {
        $this->plugins = $plugins;
    }

    public function setSec(array $sec): void
    {
        $this->sec = $sec;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $uniacid = self::UNIACID;
        $sets = iserializer($this->sets);
        $plugins = iserializer($this->plugins);
        $sec = iserializer($this->sec);
        pdo_run('TRUNCATE TABLE `ims_ewei_shop_sysset`');
        pdo_run("INSERT INTO `ims_ewei_shop_sysset`(`id`, `uniacid`, `sets`, `plugins`, `sec`)
            VALUES(1, $uniacid,'$sets','$plugins','$sec')");
    }
}