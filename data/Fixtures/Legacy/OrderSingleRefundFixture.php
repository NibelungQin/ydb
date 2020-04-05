<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderSingleRefund;

class OrderSingleRefundFixture implements FixtureInterface
{
    public const ORDER_SINGLE_REFUND_LIST = [
        4 =>
            [
                'id' => 4,
                'uniacid' => 3,
                'orderid' => 368,
                'ordergoodsid' => 383,
                'refundno' => 'SR20200113193211022461',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '不喜欢',
                'createtime' => '1578915131',
                'status' => '0',
                'reply' => null,
                'refundtype' => '0',
                'realprice' => '0.00',
                'refundtime' => '0',
                'ordergoodsrealprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/WnZ0gN4MG7ff73b7We4WQn70nN38f5.jpg";}',
                'rtype' => '1',
                'refundaddress' => null,
                'message' => null,
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '0',
                'sendtime' => '0',
                'returntime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'merchid' => '0',
                'tradetype' => '0',
                'issuporder' => '0',
                'suptype' => '0',
            ],
        5 =>
            [
                'id' => 5,
                'uniacid' => 3,
                'orderid' => 369,
                'ordergoodsid' => 384,
                'refundno' => 'SR20200113195136259691',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '不喜欢',
                'createtime' => '1578916296',
                'status' => '3',
                'reply' => '',
                'refundtype' => '0',
                'realprice' => '0.00',
                'refundtime' => '0',
                'ordergoodsrealprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/A1YW7V72YyqYJB6KN82bMNkkklkbfQ.png";}',
                'rtype' => '1',
                'refundaddress' => 'a:12:{s:2:"id";s:1:"2";s:5:"title";s:18:"杭州退货地址";s:4:"name";s:6:"小新";s:3:"tel";s:0:"";s:6:"mobile";s:10:"1368678667";s:8:"province";s:9:"浙江省";s:4:"city";s:9:"杭州市";s:4:"area";s:9:"萧山区";s:7:"address";s:27:"宁围街道民和路500号";s:7:"zipcode";s:0:"";s:7:"content";N;s:7:"merchid";s:1:"0";}',
                'message' => '测试',
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '1578916322',
                'sendtime' => '0',
                'returntime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'merchid' => '0',
                'tradetype' => '0',
                'issuporder' => '0',
                'suptype' => '0',
            ],
        6 =>
            [
                'id' => 6,
                'uniacid' => 3,
                'orderid' => 370,
                'ordergoodsid' => 385,
                'refundno' => 'SR20200113200231242889',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '换大码',
                'createtime' => '1578916951',
                'status' => '5',
                'reply' => '',
                'refundtype' => '0',
                'realprice' => '0.00',
                'refundtime' => '0',
                'ordergoodsrealprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/RNKnnzj6gNnbjWq2nDNqcBhkGxIX26.png";}',
                'rtype' => '2',
                'refundaddress' => 'a:12:{s:2:"id";s:1:"2";s:5:"title";s:18:"杭州退货地址";s:4:"name";s:6:"小新";s:3:"tel";s:0:"";s:6:"mobile";s:10:"1368678667";s:8:"province";s:9:"浙江省";s:4:"city";s:9:"杭州市";s:4:"area";s:9:"萧山区";s:7:"address";s:27:"宁围街道民和路500号";s:7:"zipcode";s:0:"";s:7:"content";N;s:7:"merchid";s:1:"0";}',
                'message' => '1111',
                'express' => '',
                'expresscom' => '',
                'expresssn' => '1112',
                'operatetime' => '1578916973',
                'sendtime' => '1578916988',
                'returntime' => '1578917006',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '1113',
                'refundaddressid' => '0',
                'endtime' => '0',
                'merchid' => '0',
                'tradetype' => '0',
                'issuporder' => '0',
                'suptype' => '0',
            ],
        7 =>
            [
                'id' => 7,
                'uniacid' => 3,
                'orderid' => 375,
                'ordergoodsid' => 391,
                'refundno' => 'SR20200225172253628312',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '',
                'createtime' => '1582622573',
                'status' => '0',
                'reply' => null,
                'refundtype' => '0',
                'realprice' => '0.00',
                'refundtime' => '0',
                'ordergoodsrealprice' => '19.90',
                'applyprice' => '19.90',
                'imgs' => 'N;',
                'rtype' => '0',
                'refundaddress' => null,
                'message' => null,
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '0',
                'sendtime' => '0',
                'returntime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'merchid' => '0',
                'tradetype' => '0',
                'issuporder' => '0',
                'suptype' => '0',
            ]
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . OrderSingleRefund::TABLE_NAME);
        array_map(static function ($orderSingleRefund) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $orderSingleRefund['id'], $orderSingleRefund['uniacid'], $orderSingleRefund['orderid'],
                $orderSingleRefund['ordergoodsid'], $orderSingleRefund['refundno'], $orderSingleRefund['price'],
                $orderSingleRefund['reason'], $orderSingleRefund['images'], $orderSingleRefund['content'],
                $orderSingleRefund['createtime'], $orderSingleRefund['status'], $orderSingleRefund['reply'],
                $orderSingleRefund['refundtype'], $orderSingleRefund['realprice'], $orderSingleRefund['refundtime'],
                $orderSingleRefund['ordergoodsrealprice'], $orderSingleRefund['applyprice'],
                $orderSingleRefund['imgs'], $orderSingleRefund['rtype'], $orderSingleRefund['refundaddress'],
                $orderSingleRefund['message'], $orderSingleRefund['express'], $orderSingleRefund['expresscom'],
                $orderSingleRefund['expresssn'], $orderSingleRefund['operatetime'], $orderSingleRefund['sendtime'],
                $orderSingleRefund['returntime'], $orderSingleRefund['rexpress'], $orderSingleRefund['rexpresscom'],
                $orderSingleRefund['rexpresssn'], $orderSingleRefund['refundaddressid'], $orderSingleRefund['endtime'],
                $orderSingleRefund['merchid'], $orderSingleRefund['tradetype'], $orderSingleRefund['issuporder'],
                $orderSingleRefund['suptype']
            );
            pdo_run('INSERT INTO ' . OrderSingleRefund::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::ORDER_SINGLE_REFUND_LIST));
    }
}