<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Verifygoods;

class VerifyGoodsFixture implements FixtureInterface
{
    public const VERIFY_GOODS_LIST = array (
        26 =>
            array (
                'id' => '26',
                'uniacid' => '3',
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'orderid' => '382',
                'ordergoodsid' => '398',
                'storeid' => '3',
                'starttime' => '1583076009',
                'limitdays' => '30',
                'limitnum' => '3',
                'used' => '0',
                'verifycode' => '824434646',
                'codeinvalidtime' => '1583079951',
                'invalid' => '0',
                'getcard' => '0',
                'activecard' => '0',
                'cardcode' => '',
                'limittype' => '0',
                'limitdate' => '1565074440',
            ),
    );

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . Verifygoods::TABLE_NAME);
        array_map(static function($verifyGoods) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s'",
                $verifyGoods['id'], $verifyGoods['uniacid'], $verifyGoods['openid'], $verifyGoods['orderid'],
                $verifyGoods['ordergoodsid'], $verifyGoods['storeid'], $verifyGoods['starttime'],
                $verifyGoods['limitdays'], $verifyGoods['limitnum'], $verifyGoods['used'], $verifyGoods['verifycode'],
                $verifyGoods['codeinvalidtime'], $verifyGoods['invalid'], $verifyGoods['getcard'],
                $verifyGoods['activecard'], $verifyGoods['cardcode'], $verifyGoods['limittype'],
                $verifyGoods['limitdate']
            );
            pdo_run('INSERT INTO ' . Verifygoods::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::VERIFY_GOODS_LIST));
    }
}