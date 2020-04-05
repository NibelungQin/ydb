<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\PackageGoods;

class PackageGoodsFixture implements FixtureInterface
{
    public const PACKAGE_GOODS_LIST = [
        0 =>
            [
                'id' => '28',
                'uniacid' => '3',
                'pid' => '1',
                'goodsid' => '70',
                'title' => '柠檬',
                'thumb' => 'images/3/2019/11/EHPVp7uN9LtTu9xF8N6HvFTfuU8x9X.jpg',
                'price' => '0.00',
                'option' => '',
                'goodssn' => '',
                'productsn' => '',
                'hasoption' => '0',
                'marketprice' => '100.00',
                'packageprice' => '99.00',
                'commission1' => '2.00',
                'commission2' => '1.00',
                'commission3' => '0.00',
            ],
        1 =>
            [
                'id' => '26',
                'uniacid' => '3',
                'pid' => '1',
                'goodsid' => '74',
                'title' => '橘子',
                'thumb' => 'images/3/2019/11/x0B9XyBCG3x9j9ogUbOXxOyoGu305u.jpg',
                'price' => '0.00',
                'option' => '96',
                'goodssn' => '',
                'productsn' => '',
                'hasoption' => '1',
                'marketprice' => '0.01',
                'packageprice' => '0.00',
                'commission1' => '0.00',
                'commission2' => '0.00',
                'commission3' => '0.00',
            ],
        2 =>
            [
                'id' => '27',
                'uniacid' => '3',
                'pid' => '1',
                'goodsid' => '69',
                'title' => '红枣',
                'thumb' => 'images/3/2019/11/X5LT9p5jxLl2615in6JJs22ly565z6.jpg',
                'price' => '0.00',
                'option' => '101',
                'goodssn' => '',
                'productsn' => '',
                'hasoption' => '1',
                'marketprice' => '100.00',
                'packageprice' => '0.00',
                'commission1' => '0.00',
                'commission2' => '0.00',
                'commission3' => '0.00',
            ],
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . PackageGoods::TABLE_NAME);
        array_map(static function($packageGoods) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s'",
                $packageGoods['id'], $packageGoods['uniacid'], $packageGoods['pid'], $packageGoods['goodsid'],
                $packageGoods['title'], $packageGoods['thumb'], $packageGoods['price'], $packageGoods['option'],
                $packageGoods['goodssn'], $packageGoods['productsn'], $packageGoods['hasoption'],
                $packageGoods['marketprice'], $packageGoods['packageprice'], $packageGoods['commission1'],
                $packageGoods['commission2'], $packageGoods['commission3']
            );
            pdo_run('INSERT INTO ' . PackageGoods::TABLE_NAME . " VALUE ($values)");
        }, self::PACKAGE_GOODS_LIST);
    }
}