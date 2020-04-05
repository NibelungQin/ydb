<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Engine\CorePaylog;

class CorePaylogFixture implements FixtureInterface
{
    public const UNIACID = 3;
    public const CORE_PAYLOG_LIST = [
        [
            'plid' => '368',
            'type' => '',
            'uniacid' => self::UNIACID,
            'acid' => '0',
            'openid' => '2',
            'uniontid' => '',
            'tid' => 'SH20191221174215996721',
            'fee' => '0.01',
            'status' => '0',
            'module' => 'ewei_shopv2',
            'tag' => '',
            'is_usecard' => '0',
            'card_type' => '0',
            'card_id' => '',
            'card_fee' => '0.00',
            'encrypt_code' => '',
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . CorePaylog::TABLE_NAME);
        pdo_run('INSERT INTO `ims_core_paylog`(`plid`, `type`, `uniacid`, `acid`, `openid`, `uniontid`, `tid`,
                              `fee`, `status`, `module`, `tag`, `is_usecard`, `card_type`, `card_id`, `card_fee`,
                              `encrypt_code`)
            VALUES (337, \'\', 3, 0, \'2\', \'\', \'SH20191115000819744664\', 0.01, 0, \'ewei_shopv2\',
                    \'a:1:{s:14:\"transaction_id\";s:28:\"4200000441201911154568190154\";}\', 0, 0, \'\', 0.00, \'\');
        ');
        array_map( static function($corePaylog) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $corePaylog['plid'], $corePaylog['type'], $corePaylog['uniacid'], $corePaylog['acid'],
                $corePaylog['openid'], $corePaylog['uniontid'], $corePaylog['tid'], $corePaylog['fee'],
                $corePaylog['status'], $corePaylog['module'], $corePaylog['tag'], $corePaylog['is_usecard'],
                $corePaylog['card_type'], $corePaylog['card_id'], $corePaylog['card_fee'], $corePaylog['encrypt_code']
            );
            pdo_run('INSERT INTO ' . CorePaylog::TABLE_NAME . " VALUE ($values)");
        }, self::CORE_PAYLOG_LIST);
    }
}