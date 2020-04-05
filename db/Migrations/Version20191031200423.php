<?php
declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20191031200423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '添加会员标记字段';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("alter table ims_ewei_shop_member add column (`member_flag` TEXT COMMENT '会员标记字段')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table ims_ewei_shop_member drop column `member_flag`');
    }
}