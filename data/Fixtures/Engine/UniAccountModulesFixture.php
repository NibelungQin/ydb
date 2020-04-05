<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UniAccountModulesFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_uni_account_modules`');
        pdo_run("INSERT INTO `ims_uni_account_modules`(`id`, `uniacid`, `module`, `enabled`, `settings`,
                            `shortcut`, `displayorder`) VALUES (1, 7, 'ewei_shopv2', 1, '', 1, 0);
        ");
    }
}