<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\ArticleCategory;

class ArticleCategoryFixture implements FixtureInterface
{
    public const ARTICLE_CATEGORY_LIST = [
        1 =>
            [
                'id' => '1',
                'category_name' => 'o2o',
                'uniacid' => '3',
                'displayorder' => '100',
                'isshow' => '1',
            ],
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . ArticleCategory::TABLE_NAME);
        array_map(static function ($articleCategory) {
            $values = sprintf("'%s','%s','%s','%s','%s'",
                $articleCategory['id'], $articleCategory['category_name'], $articleCategory['uniacid'],
                $articleCategory['displayorder'], $articleCategory['isshow']
            );
            pdo_run('INSERT INTO ' . ArticleCategory::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::ARTICLE_CATEGORY_LIST));
    }
}