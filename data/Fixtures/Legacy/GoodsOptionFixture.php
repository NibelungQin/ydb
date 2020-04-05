<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsOption;

class GoodsOptionFixture implements FixtureInterface
{

    public const GOODS_OPTION_LIST = [
        96 =>
            [
                'id' => 96,
                'uniacid' => 3,
                'goodsid' => 74,
                'title' => '500ml+干性皮肤+玫瑰金',
                'thumb' => '',
                'productprice' => '3882.00',
                'marketprice' => '0.01',
                'costprice' => '1.00',
                'stock' => '22222222',
                'weight' => '0.00',
                'displayorder' => '0',
                'specs' => '51_54_49',
                'skuId' => '',
                'goodssn' => '',
                'productsn' => '',
                'virtual' => '0',
                'exchange_stock' => '0',
                'exchange_postage' => '0.00',
                'presellprice' => '0.01',
                'day' => '0',
                'allfullbackprice' => '0.00',
                'fullbackprice' => '0.00',
                'allfullbackratio' => '0.00',
                'fullbackratio' => '0.00',
                'isfullback' => '0',
                'islive' => '0',
                'liveprice' => '0.00',
                'cycelbuy_periodic' => '',
            ],
        72 =>
            [
                'id' => 72,
                'uniacid' => 3,
                'goodsid' => 57,
                'title' => '蓝色',
                'thumb' => '',
                'productprice' => '100.00',
                'marketprice' => '0.01',
                'costprice' => '100.00',
                'stock' => '31',
                'weight' => '100.00',
                'displayorder' => '0',
                'specs' => '45',
                'skuId' => '',
                'goodssn' => '101',
                'productsn' => '101',
                'virtual' => '0',
                'exchange_stock' => '0',
                'exchange_postage' => '0.00',
                'presellprice' => '100.00',
                'day' => '0',
                'allfullbackprice' => '0.00',
                'fullbackprice' => '0.00',
                'allfullbackratio' => null,
                'fullbackratio' => null,
                'isfullback' => '0',
                'islive' => '0',
                'liveprice' => '0.00',
                'cycelbuy_periodic' => '',
            ],
        71 =>
            [
                'id' => 71,
                'uniacid' => 3,
                'goodsid' => 57,
                'title' => '红色',
                'thumb' => '',
                'productprice' => '100.00',
                'marketprice' => '0.01',
                'costprice' => '100.00',
                'stock' => '42',
                'weight' => '100.00',
                'displayorder' => '0',
                'specs' => '44',
                'skuId' => '',
                'goodssn' => '100',
                'productsn' => '100',
                'virtual' => '0',
                'exchange_stock' => '0',
                'exchange_postage' => '0.00',
                'presellprice' => '100.00',
                'day' => '0',
                'allfullbackprice' => '0.00',
                'fullbackprice' => '0.00',
                'allfullbackratio' => null,
                'fullbackratio' => null,
                'isfullback' => '0',
                'islive' => '0',
                'liveprice' => '0.00',
                'cycelbuy_periodic' => '',
            ],
        101 =>
            [
                'id' => 101,
                'uniacid' => 3,
                'goodsid' => 69,
                'title' => '大+小',
                'thumb' => '',
                'productprice' => '15.00',
                'marketprice' => '12.00',
                'costprice' => '5.00',
                'stock' => '99',
                'weight' => '0.00',
                'displayorder' => '0',
                'specs' => '59_60',
                'skuId' => '',
                'goodssn' => '',
                'productsn' => '',
                'virtual' => '0',
                'exchange_stock' => '0',
                'exchange_postage' => '0.00',
                'presellprice' => '10.00',
                'day' => '0',
                'allfullbackprice' => '0.00',
                'fullbackprice' => '0.00',
                'allfullbackratio' => null,
                'fullbackratio' => null,
                'isfullback' => '0',
                'islive' => '0',
                'liveprice' => '0.00',
                'cycelbuy_periodic' => '',
            ]
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . GoodsOption::TABLE_NAME);
        array_map(static function ($goodsOption) {
            $values = sprintf("'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'",
                $goodsOption['id'], $goodsOption['uniacid'], $goodsOption['goodsid'], $goodsOption['title'],
                $goodsOption['thumb'], $goodsOption['productprice'], $goodsOption['marketprice'],
                $goodsOption['costprice'], $goodsOption['stock'], $goodsOption['weight'], $goodsOption['displayorder'],
                $goodsOption['specs'], $goodsOption['skuId'], $goodsOption['goodssn'], $goodsOption['productsn'],
                $goodsOption['virtual'], $goodsOption['exchange_stock'], $goodsOption['exchange_postage'],
                $goodsOption['presellprice'], $goodsOption['day'], $goodsOption['allfullbackprice'],
                $goodsOption['fullbackprice'], $goodsOption['allfullbackratio'], $goodsOption['fullbackratio'],
                $goodsOption['isfullback'], $goodsOption['islive'], $goodsOption['liveprice'],
                $goodsOption['cycelbuy_periodic']
            );
            pdo_run('INSERT INTO ' . GoodsOption::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::GOODS_OPTION_LIST));
    }
}