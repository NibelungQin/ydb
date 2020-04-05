<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\CommissionLevel;

class CommissionLevelFixture implements FixtureInterface
{
    public const COMMISSION_LEVEL_LIST = array (
        0 =>
            array (
                'id' => '16',
                'uniacid' => '3',
                'levelname' => '联 创',
                'commission1' => '65.00',
                'commission2' => '0.00',
                'commission3' => '0.00',
                'commissionmoney' => '0.00',
                'ordermoney' => '0.00',
                'zg_ordermoney' => '0.00',
                'downcount' => '0',
                'first_downcount' => '0',
                'team_downcount' => '2',
                'first_team_downcount' => '6',
                'ordercount' => '0',
                'zg_ordercount' => '0',
                'first_ordercount' => '0',
                'withdraw' => '0.00',
                'repurchase' => '0.00',
                'goodsids' => '',
                'first_ordermoney' => '0.00',
                'team_identity_id' => '15',
                'first_team_identity_id' => '13',
                'team_identity_type' => '1',
                'first_identity_type' => '1',
                'hierarchy' => '127',
            ),
        1 =>
            array (
                'id' => '14',
                'uniacid' => '3',
                'levelname' => '店长',
                'commission1' => '35.00',
                'commission2' => '15.00',
                'commission3' => '0.00',
                'commissionmoney' => '0.00',
                'ordermoney' => '0.00',
                'zg_ordermoney' => '398.00',
                'downcount' => '0',
                'first_downcount' => '0',
                'team_downcount' => '0',
                'first_team_downcount' => '0',
                'ordercount' => '0',
                'zg_ordercount' => '0',
                'first_ordercount' => '0',
                'withdraw' => '0.00',
                'repurchase' => '0.00',
                'goodsids' => '',
                'first_ordermoney' => '0.00',
                'team_identity_id' => '0',
                'first_team_identity_id' => '0',
                'team_identity_type' => '0',
                'first_identity_type' => '0',
                'hierarchy' => '0',
            ),
        2 =>
            array (
                'id' => '15',
                'uniacid' => '3',
                'levelname' => '联创',
                'commission1' => '65.00',
                'commission2' => '50.00',
                'commission3' => '0.00',
                'commissionmoney' => '0.00',
                'ordermoney' => '100000.00',
                'zg_ordermoney' => '10000.00',
                'downcount' => '0',
                'first_downcount' => '0',
                'team_downcount' => '100',
                'first_team_downcount' => '4',
                'ordercount' => '0',
                'zg_ordercount' => '0',
                'first_ordercount' => '0',
                'withdraw' => '0.00',
                'repurchase' => '0.00',
                'goodsids' => '',
                'first_ordermoney' => '0.00',
                'team_identity_id' => '14',
                'first_team_identity_id' => '13',
                'team_identity_type' => '1',
                'first_identity_type' => '1',
                'hierarchy' => '127',
            ),
        3 =>
            array (
                'id' => '13',
                'uniacid' => '3',
                'levelname' => 'BOSS',
                'commission1' => '50.00',
                'commission2' => '0.00',
                'commission3' => '0.00',
                'commissionmoney' => '0.00',
                'ordermoney' => '10000.00',
                'zg_ordermoney' => '1000.00',
                'downcount' => '0',
                'first_downcount' => '0',
                'team_downcount' => '0',
                'first_team_downcount' => '10',
                'ordercount' => '0',
                'zg_ordercount' => '0',
                'first_ordercount' => '0',
                'withdraw' => '0.00',
                'repurchase' => '0.00',
                'goodsids' => '',
                'first_ordermoney' => '0.00',
                'team_identity_id' => '0',
                'first_team_identity_id' => '14',
                'team_identity_type' => '0',
                'first_identity_type' => '1',
                'hierarchy' => '0',
            ),
    );

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . CommissionLevel::TABLE_NAME);
        array_map(static function ($commissionLevel) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $commissionLevel['id'], $commissionLevel['uniacid'], $commissionLevel['levelname'],
                $commissionLevel['commission1'], $commissionLevel['commission2'], $commissionLevel['commission3'],
                $commissionLevel['commissionmoney'], $commissionLevel['ordermoney'], $commissionLevel['zg_ordermoney'],
                $commissionLevel['downcount'], $commissionLevel['first_downcount'], $commissionLevel['team_downcount'],
                $commissionLevel['first_team_downcount'], $commissionLevel['ordercount'],
                $commissionLevel['zg_ordercount'], $commissionLevel['first_ordercount'], $commissionLevel['withdraw'],
                $commissionLevel['repurchase'], $commissionLevel['goodsids'], $commissionLevel['first_ordermoney'],
                $commissionLevel['team_identity_id'], $commissionLevel['first_team_identity_id'],
                $commissionLevel['team_identity_type'], $commissionLevel['first_identity_type'],
                $commissionLevel['hierarchy']
            );
            pdo_run('INSERT INTO ' . CommissionLevel::TABLE_NAME . " VALUE ($values)");
        }, self::COMMISSION_LEVEL_LIST);
    }
}