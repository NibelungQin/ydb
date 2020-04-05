<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderComment;

class OrderCommentFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderComment = new OrderComment();
        $manager->persist($orderComment);

        $orderComment = new OrderComment();
        $manager->persist($orderComment);

        $orderComment = new OrderComment();
        $manager->persist($orderComment);

        $manager->flush();
    }
}