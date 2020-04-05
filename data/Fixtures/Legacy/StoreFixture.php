<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Store;

class StoreFixture implements FixtureInterface
{
    public const STORE_LIST = array(
        3 =>
            array(
                'id' => '3',
                'uniacid' => '3',
                'storename' => '一道电商',
                'address' => '民营企业大厦B幢17楼',
                'tel' => '13164991551',
                'lat' => '30.23777055532508',
                'lng' => '120.2634617152941',
                'status' => '1',
                'realname' => '',
                'mobile' => '',
                'fetchtime' => '',
                'type' => '3',
                'logo' => 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg',
                'saletime' => '',
                'desc' => '',
                'displayorder' => '0',
                'order_printer' => '',
                'order_template' => '0',
                'ordertype' => '',
                'banner' => null,
                'label' => '',
                'tag' => '',
                'classify' => null,
                'perms' => '',
                'citycode' => '330100',
                'opensend' => '0',
                'province' => '浙江省',
                'city' => '杭州市',
                'area' => '萧山区',
                'provincecode' => '330000',
                'areacode' => '330109',
                'diypage' => '0',
                'diypage_ispage' => '0',
                'diypage_list' => null,
                'storegroupid' => null,
                'cates' => '',
            ),
    );

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . Store::TABLE_NAME);
        array_map(static function($store) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s'",
                $store['id'], $store['uniacid'], $store['storename'], $store['address'], $store['tel'],
                $store['lat'], $store['lng'], $store['status'], $store['realname'], $store['mobile'],
                $store['fetchtime'], $store['type'], $store['logo'], $store['saletime'], $store['desc'],
                $store['displayorder'], $store['order_printer'], $store['order_template'], $store['ordertype'],
                $store['banner'], $store['label'], $store['tag'], $store['classify'], $store['perms'],
                $store['citycode'], $store['opensend'], $store['province'], $store['city'], $store['area'],
                $store['provincecode'], $store['areacode'], $store['diypage'], $store['diypage_ispage'],
                $store['diypage_list'], $store['storegroupid'], $store['cates']
            );
            pdo_run('INSERT INTO ' . Store::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::STORE_LIST));
    }
}