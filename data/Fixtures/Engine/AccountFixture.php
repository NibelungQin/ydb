<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AccountFixture implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_account`');
        pdo_run("INSERT INTO `ims_account`(
                `acid`, `uniacid`, `hash`, `type`, `isconnect`, `isdeleted`, `endtime`)
                 VALUES (3, 3, 'nqE3UzII', 1, 1, 0, 0);");
    }
}