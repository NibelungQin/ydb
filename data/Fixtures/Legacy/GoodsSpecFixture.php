<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsSpec;

class GoodsSpecFixture implements FixtureInterface
{
    public const GOODS_SPEC_LIST = array(
        0 =>
            array(
                'id' => '17',
                'uniacid' => '3',
                'goodsid' => '74',
                'title' => '使用肤质',
                'description' => '',
                'displaytype' => '0',
                'content' => 'a:3:{i:0;s:2:"52";i:1;s:2:"53";i:2;s:2:"54";}',
                'displayorder' => '2',
                'propId' => '',
                'iscycelbuy' => '0',
            ),
        1 =>
            array(
                'id' => '16',
                'uniacid' => '3',
                'goodsid' => '74',
                'title' => '重量',
                'description' => '',
                'displaytype' => '0',
                'content' => 'a:2:{i:0;s:2:"50";i:1;s:2:"51";}',
                'displayorder' => '1',
                'propId' => '',
                'iscycelbuy' => '0',
            ),
        2 =>
            array(
                'id' => '15',
                'uniacid' => '3',
                'goodsid' => '74',
                'title' => '颜色',
                'description' => '',
                'displaytype' => '0',
                'content' => 'a:4:{i:0;s:2:"46";i:1;s:2:"47";i:2;s:2:"48";i:3;s:2:"49";}',
                'displayorder' => '0',
                'propId' => '',
                'iscycelbuy' => '0',
            ),
        3 =>
            array(
                'id' => '20',
                'uniacid' => '3',
                'goodsid' => '69',
                'title' => '小',
                'description' => '',
                'displaytype' => '0',
                'content' => 'a:1:{i:0;s:2:"60";}',
                'displayorder' => '1',
                'propId' => '',
                'iscycelbuy' => '0',
            ),
        4 =>
            array(
                'id' => '19',
                'uniacid' => '3',
                'goodsid' => '69',
                'title' => '大',
                'description' => '',
                'displaytype' => '0',
                'content' => 'a:1:{i:0;s:2:"59";}',
                'displayorder' => '0',
                'propId' => '',
                'iscycelbuy' => '0',
            ),
    );

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . GoodsSpec::TABLE_NAME);
        array_map(static function ($goodsSpec) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $goodsSpec['id'], $goodsSpec['uniacid'], $goodsSpec['goodsid'], $goodsSpec['title'],
                $goodsSpec['description'], $goodsSpec['displaytype'], $goodsSpec['content'],
                $goodsSpec['displayorder'], $goodsSpec['propId'], $goodsSpec['iscycelbuy']
            );
            pdo_run('INSERT INTO ' . GoodsSpec::TABLE_NAME . " VALUE ($values)");
        }, self::GOODS_SPEC_LIST);
    }
}