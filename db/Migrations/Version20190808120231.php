<?php
declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190808120231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '添加腾讯云短信';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
                alter table ims_ewei_shop_sms_set add column (`tencent` tinyint(1) NOT NULL DEFAULT '0' COMMENT '腾讯云短信是否开启',
                `tencent_key` varchar(50) NOT NULL DEFAULT '' COMMENT 'App Key',
                `tencent_secret` varchar(100) NOT NULL DEFAULT '' COMMENT 'SDK AppID')
            ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table ims_ewei_shop_sms_set drop column `tencent`,
            drop column `tencent_key`,
            drop column  `tencent_secret`');
    }
}
