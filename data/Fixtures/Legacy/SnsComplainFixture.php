<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsComplain;

class SnsComplainFixture implements FixtureInterface
{
    public const COMPLAIN_LIST = [
        0 =>
            [
                'id' => 2,
                'uniacid' => 3,
                'type' => '-1',
                'postsid' => '3',
                'defendant' => 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s',
                'complainant' => 'oMW005lDg8xacovx279GSHDCMetM',
                'complaint_type' => '-1',
                'complaint_text' => '骗人，没效果',
                'images' => 'a:0:{}',
                'createtime' => '1585214279',
                'checkedtime' => '0',
                'checked' => '0',
                'checked_note' => '',
                'deleted' => '0',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsComplain::TABLE_NAME);
        array_map(static function ($complain) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $complain['id'], $complain['uniacid'], $complain['type'], $complain['postsid'],
                $complain['defendant'], $complain['complainant'], $complain['complaint_type'],
                $complain['complaint_text'], $complain['images'], $complain['createtime'],
                $complain['checkedtime'], $complain['checked'], $complain['checked_note'],
                $complain['deleted']
            );
            pdo_run('INSERT INTO ' . SnsComplain::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::COMPLAIN_LIST));
    }
}