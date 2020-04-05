<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\MemberAddress;

class MemberAddressFixture implements FixtureInterface
{
    public const UNIACID = 3;

    public const MEMBER_ADDRESS_LIST = [
        [
            'id' => 44,
            'uniacid' => self::UNIACID,
            'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
            'realname' => '杨',
            'mobile' => '15201010001',
            'province' => '浙江省',
            'city' => '杭州市',
            'area' => '上城区',
            'address' => '11',
            'isdefault' => 1,
            'zipcode' => '',
            'deleted' => 0,
            'street' => '清波街道',
            'datavalue' => '330000 330100 330102',
            'streetdatavalue' => '330102001',
            'lng' => '',
            'lat' => ''
        ]
    ];
    /**
     * @var array
     */
    private $memberAddressList;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . MemberAddress::TABLE_NAME);
        array_map(static function ($memberAddress) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s'",
                $memberAddress['id'], $memberAddress['uniacid'], $memberAddress['openid'], $memberAddress['realname'],
                $memberAddress['mobile'], $memberAddress['province'], $memberAddress['city'], $memberAddress['area'],
                $memberAddress['address'], $memberAddress['isdefault'], $memberAddress['zipcode'],
                $memberAddress['deleted'], $memberAddress['street'], $memberAddress['datavalue'],
                $memberAddress['streetdatavalue'], $memberAddress['lng'], $memberAddress['lat']
            );
            pdo_run('INSERT INTO ' . MemberAddress::TABLE_NAME . " VALUE ($values)");
        }, $this->memberAddressList);
    }

    public function setMemberAddressLIst(array $memberAddressList)
    {
        $this->memberAddressList = $memberAddressList;
    }
}