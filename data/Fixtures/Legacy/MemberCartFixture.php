<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\MemberCart;

class MemberCartFixture implements FixtureInterface
{
    public const UNIACID = 3;

    public const MEMBER_CART_LIST = [
        [
            'id' => 47,
            'uniacid' => self::UNIACID,
            'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
            'goodsid' => 74,
            'total' => 1,
            'marketprice' => '0.01',
            'deleted' => 0,
            'optionid' => 96,
            'createtime' => '1576893344',
            'diyformdataid' => 0,
            'diyformdata' => 'false',
            'diyformfields' => 'a:0:{}',
            'diyformid' => 0,
            'selected' => 1,
            'selectedadd' => 1,
            'merchid' => 0,
            'isnewstore' => 0
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . MemberCart::TABLE_NAME);
        array_map(static function ($memberCart) {
            $values = sprintf("'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s'",
                $memberCart['id'], $memberCart['uniacid'], $memberCart['openid'], $memberCart['goodsid'],
                $memberCart['total'], $memberCart['marketprice'], $memberCart['deleted'], $memberCart['optionid'],
                $memberCart['createtime'], $memberCart['diyformdataid'], $memberCart['diyformdata'],
                $memberCart['diyformfields'], $memberCart['diyformid'], $memberCart['selected'],
                $memberCart['selectedadd'], $memberCart['merchid'], $memberCart['isnewstore']
            );
            pdo_run('INSERT INTO ' . MemberCart::TABLE_NAME . " VALUE ($values)");
        }, self::MEMBER_CART_LIST);
    }
}