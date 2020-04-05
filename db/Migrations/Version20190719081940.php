<?php

declare(strict_types = 1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719081940 extends AbstractMigration {

    public function getDescription(): string {
        return '初始化快递表';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('顺丰', 'shunfeng', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('申通', 'shentong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('韵达快运', 'yunda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('天天快递', 'tiantian', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('圆通速递', 'yuantong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('中通速递', 'zhongtong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('ems快递', 'ems', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('汇通快运', 'huitongkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('全峰快递', 'quanfengkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('宅急送', 'zhaijisong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('aae全球专递', 'aae', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('安捷快递', 'anjie', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('安信达快递', 'anxindakuaixi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('彪记快递', 'biaojikuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('bht', 'bht', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('百福东方国际物流', 'baifudongfang', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('中国东方（COE）', 'coe', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('长宇物流', 'changyuwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('大田物流', 'datianwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('德邦物流', 'debangwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('dhl', 'dhl', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('dpex', 'dpex', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('d速快递', 'dsukuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('递四方', 'disifang', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('fedex（国外）', 'fedex', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('飞康达物流', 'feikangda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('凤凰快递', 'fenghuangkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('飞快达', 'feikuaida', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('国通快递', 'guotongkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('港中能达物流', 'ganzhongnengda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('广东邮政物流', 'guangdongyouzhengwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('共速达', 'gongsuda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('恒路物流', 'hengluwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('华夏龙物流', 'huaxialongwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('海红', 'haihongwangsong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('海外环球', 'haiwaihuanqiu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('佳怡物流', 'jiayiwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('京广速递', 'jinguangsudikuaijian', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('急先达', 'jixianda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('佳吉物流', 'jjwl', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('加运美物流', 'jymwl', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('金大物流', 'jindawuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('嘉里大通', 'jialidatong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('晋越快递', 'jykd', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('快捷速递', 'kuaijiesudi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('联邦快递（国内）', 'lianb', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('联昊通物流', 'lianhaowuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('龙邦物流', 'longbanwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('立即送', 'lijisong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('乐捷递', 'lejiedi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('民航快递', 'minghangkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('美国快递', 'meiguokuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('门对门', 'menduimen', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('OCS', 'ocs', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('配思货运', 'peisihuoyunkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('全晨快递', 'quanchenkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('全际通物流', 'quanjitong', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('全日通快递', 'quanritongkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('全一快递', 'quanyikuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('如风达', 'rufengda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('三态速递', 'santaisudi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('盛辉物流', 'shenghuiwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('速尔物流', 'sue', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('盛丰物流', 'shengfeng', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('赛澳递', 'saiaodi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('天地华宇', 'tiandihuayu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('tnt', 'tnt', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('ups', 'ups', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('万家物流', 'wanjiawuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('文捷航空速递', 'wenjiesudi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('伍圆', 'wuyuan', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('万象物流', 'wxwl', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('新邦物流', 'xinbangwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('信丰物流', 'xinfengwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('亚风速递', 'yafengsudi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('一邦速递', 'yibangwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('优速物流', 'youshuwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('邮政包裹挂号信', 'youzhengguonei', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('邮政国际包裹挂号信', 'youzhengguoji', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('远成物流', 'yuanchengwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('源伟丰快递', 'yuanweifeng', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('元智捷诚快递', 'yuanzhijiecheng', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('运通快递', 'yuntongkuaidi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('越丰物流', 'yuefengwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('源安达', 'yad', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('银捷速递', 'yinjiesudi', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('中铁快运', 'zhongtiekuaiyun', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('中邮物流', 'zhongyouwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('忠信达', 'zhongxinda', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('芝麻开门', 'zhimakaimen', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('安能物流', 'annengwuliu', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('京东快递', 'jd', 1, 0, '')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`) VALUES ('百世快递', 'huitongkuaidi', 1, 0, '')");
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("delete from `ims_ewei_shop_express`");
    }

}
