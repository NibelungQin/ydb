<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsComplainCate;

class SnsComplainCateFixture implements FixtureInterface
{
    public const COMPLAIN_CATE_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'name' => '欺诈',
                'status' => '1',
                'displayorder' => '0',
            ],
        2 =>
            [
                'id' => 2,
                'uniacid' => 3,
                'name' => '不实信息',
                'status' => '1',
                'displayorder' => '1',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsComplainCate::TABLE_NAME);
        array_map(static function($complainCate) {
            $values = sprintf("'%s','%s','%s','%s','%s'",
                $complainCate['id'], $complainCate['uniacid'], $complainCate['name'],
                $complainCate['status'], $complainCate['displayorder']
            );
            pdo_run('INSERT INTO ' . SnsComplainCate::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::COMPLAIN_CATE_LIST));
    }
}