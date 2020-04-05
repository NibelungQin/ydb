<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 新增分销商升级条件身份，亲密度字段
 */
final class Version20190712030018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '新增分销商升级条件身份，亲密度字段';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
                alter table ims_ewei_shop_commission_level add column (`team_identity_id` int(11) NOT NULL DEFAULT '0' COMMENT '下级身份id',
                `first_team_identity_id` int(11) NOT NULL DEFAULT '0' COMMENT '一级身份id',
                `team_identity_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '下级身份类型，1是分销商2是店铺',
                `first_identity_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '一级身份类型，1是分销商2是店铺',
                `hierarchy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分销关系的层级')
                ");
        
        $this->addSql("
                alter table ims_ewei_shop_globonus_level add column (`team_identity_id` int(11) NOT NULL DEFAULT '0' COMMENT '下级身份id',
                `first_team_identity_id` int(11) NOT NULL DEFAULT '0' COMMENT '一级身份id',
                `team_identity_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '下级身份类型，1是分销商2是店铺',
                `first_identity_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '一级身份类型，1是分销商2是店铺',
                `hierarchy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分销关系的层级')
                ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('alter table ims_ewei_shop_commission_level drop column `team_identity_id`,
            drop column `first_team_identity_id`, drop column `team_identity_type`,
            drop column `first_identity_type`, drop column `hierarchy`');
        $this->addSql('alter table ims_ewei_shop_globonus_level drop column `team_identity_id`,
            drop column `first_team_identity_id`, drop column `team_identity_type`,
            drop column `first_identity_type`, drop column `hierarchy`');
    }
}
