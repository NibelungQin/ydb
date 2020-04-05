<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\VerifygoodsLog;

class VerifyGoodsLogFixture implements FixtureInterface
{
    public const VERIFY_GOODS_LOG_LIST = array (
        10 =>
            array (
                'id' => '10',
                'uniacid' => '3',
                'verifygoodsid' => '26',
                'salerid' => '7',
                'storeid' => '3',
                'verifynum' => '1',
                'verifydate' => '1583078141',
                'remarks' => '',
            ),
    );

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . VerifygoodsLog::TABLE_NAME);
        array_map(static function($verifyGoodsLog) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s'",
                $verifyGoodsLog['id'], $verifyGoodsLog['uniacid'], $verifyGoodsLog['verifygoodsid'],
                $verifyGoodsLog['salerid'], $verifyGoodsLog['storeid'], $verifyGoodsLog['verifynum'],
                $verifyGoodsLog['verifydate'], $verifyGoodsLog['remarks']
            );
            pdo_run('INSERT INTO ' . VerifygoodsLog::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::VERIFY_GOODS_LOG_LIST));
    }
}