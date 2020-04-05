<?php


namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsComment;

class GoodsCommentFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsComment = new GoodsComment();
        $manager->persist($goodsComment);

        $goodsComment = new GoodsComment();
        $manager->persist($goodsComment);

        $goodsComment = new GoodsComment();
        $manager->persist($goodsComment);

        $manager->flush();
    }
}