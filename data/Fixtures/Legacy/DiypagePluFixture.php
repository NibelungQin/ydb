<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Entity\Manual\DiypagePlu;

class DiypagePluFixture implements FixtureInterface
{
    public const DIYPAGE_PLU_LIST = [
        1 =>
            [
                'id' => '1',
                'uniacid' => ConstantFixture::UNIACID,
                'type' => '1',
                'status' => '0',
                'name' => '未命名启动广告',
                'data' => 'eyJuYW1lIjoiXHU2NzJhXHU1NDdkXHU1NDBkXHU1NDJmXHU1MmE4XHU1ZTdmXHU1NDRhIiwic3RhdHVzIjoiMCIsInBhcmFtcyI6eyJzdHlsZSI6InNtYWxsLWJvdCIsInNob3d0eXBlIjoiMCIsInNob3d0aW1lIjoiNjAiLCJhdXRvY2xvc2UiOiIxMCIsImNhbmNsb3NlIjoiMSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiIzAwMDAwMCIsIm9wYWNpdHkiOiIwLjYifSwiZGF0YSI6eyJNMDEyMzQ1Njc4OTEwMSI6eyJpbWd1cmwiOiJpbWFnZXNcLzNcLzIwMTlcLzA3XC9LNjZzSjIxMUs2MDZLMU1jYzBUS1BnSmt5NTZLejEuanBnIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPXNhbGUuY291cG9uIiwiY2xpY2siOiIwIn19fQ==',
                'createtime' => '1563173125',
                'lastedittime' => '1572574203',
                'merch' => '0',
            ],
        2 =>
            [
                'id' => '2',
                'uniacid' => ConstantFixture::UNIACID,
                'type' => '1',
                'status' => '1',
                'name' => '未命名启动广告2',
                'data' => 'eyJuYW1lIjoiXHU2NzJhXHU1NDdkXHU1NDBkXHU1NDJmXHU1MmE4XHU1ZTdmXHU1NDRhIiwic3RhdHVzIjoiMSIsInBhcmFtcyI6eyJzdHlsZSI6InNtYWxsLWJvdCIsInNob3d0eXBlIjoiMSIsInNob3d0aW1lIjoiNjAiLCJhdXRvY2xvc2UiOiIxMCIsImNhbmNsb3NlIjoiMSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiIzAwMDAwMCIsIm9wYWNpdHkiOiIwLjMifSwiZGF0YSI6eyJNMDEyMzQ1Njc4OTEwMSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvYWR2LTEuanBnIiwibGlua3VybCI6IiIsImNsaWNrIjoiMSJ9LCJNMDEyMzQ1Njc4OTEwMiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvYWR2LTIuanBnIiwibGlua3VybCI6IiIsImNsaWNrIjoiMCJ9LCJNMDEyMzQ1Njc4OTEwMyI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvYWR2LTMuanBnIiwibGlua3VybCI6IiIsImNsaWNrIjoiMCJ9fX0=',
                'createtime' => '1582521994',
                'lastedittime' => '1582521994',
                'merch' => '0',
            ],
    ];


    private $list;

    public function __construct()
    {
        $this->list = self::DIYPAGE_PLU_LIST;
    }

    public function setList($list){
        $this->list = $list;
    }

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . DiypagePlu::TABLE_NAME);
        array_map(static function ($diypage) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $diypage['id'], $diypage['uniacid'], $diypage['type'], $diypage['status'],$diypage['name'],
                $diypage['data'], $diypage['createtime'], $diypage['lastedittime'], $diypage['merch']
            );
            pdo_run('INSERT INTO ' . DiypagePlu::TABLE_NAME . " VALUE ($values)");
        }, $this->list);
    }
}