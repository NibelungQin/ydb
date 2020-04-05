<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UniAccountFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_uni_account`');
        pdo_run("INSERT INTO `ims_uni_account`(`uniacid`, `groupid`, `name`, `description`, `default_acid`,
                              `rank`, `title_initial`) VALUES (3, 0, '一道电商服务', '', 3, NULL, 'Y');");
    }
}