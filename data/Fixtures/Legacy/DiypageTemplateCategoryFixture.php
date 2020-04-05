<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Entity\Manual\DiypageTemplateCategory;


class DiypageTemplateCategoryFixture implements FixtureInterface
{
    public const DIYPAGE_TEMPLATE_CATEGORY_LIST = [
            1 =>
                [
                    'id' => '1',
                    'uniacid' => ConstantFixture::UNIACID,
                    'name' => '全新商圈',
                    'merch' => '0',
                ],
            2 =>
                [
                    'id' => '2',
                    'uniacid' => ConstantFixture::UNIACID,
                    'name' => '超市零售',
                    'merch' => '0',
                ],
            3 =>
                [
                    'id' => '3',
                    'uniacid' => ConstantFixture::UNIACID,
                    'name' => '拼团抽奖',
                    'merch' => '0',
                ],
    ];
    private $list;

    public function __construct()
    {
        $this->list = self::DIYPAGE_TEMPLATE_CATEGORY_LIST;
    }

    public function setList($list){
        $this->list = $list;
    }

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . DiypageTemplateCategory::TABLE_NAME);
        array_map(static function ($diypage) {
            $values = sprintf("'%s','%s','%s','%s'",
                $diypage['id'], $diypage['uniacid'], $diypage['name'], $diypage['merch']
            );
            pdo_run('INSERT INTO ' . DiypageTemplateCategory::TABLE_NAME . " VALUE ($values)");
        }, $this->list);
    }
}