<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 添加绩效奖励店铺身份表的权重字段
 */
final class Version20190709135422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '添加绩效奖励店铺身份表的权重字段';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_globonus_level add column `achievement_weight` tinyint(3) unsigned DEFAULT '1' COMMENT '绩效权重'");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_globonus_level drop column `achievement_weight`");
    }
}
