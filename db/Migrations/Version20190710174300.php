<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 更换应用图片
 */
final class Version20190710174300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '更换应用图片';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/qiniu.jpg' where id=1");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/taobao.png' where id=2");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/commission.png' where id=3");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/super_poster.png' where id=4");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/verify.jpg' where id=5");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/tmessage.jpg' where id=6");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/perm.jpg' where id=7");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sale.jpg' where id=8");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/designer.jpg' where id=9");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/credit_shop.png' where id=10");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/virtual.jpg' where id=11");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/article.png' where id=12");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/coupon.jpg' where id=13");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/activity_poster.png' where id=14");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/system.jpg' where id=15");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/diyform.png' where id=16");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/delivery_tool.png' where id=17");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/group_purchasing.png' where id=18");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/diypage.png' where id=19");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/globonus.png' where id=20");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/merch.png' where id=21");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/qa.jpg' where id=22");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sms.jpg' where id=24");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/sign.png' where id=25");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/sns.png' where id=26");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=27");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=28");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/area_bonus.png' where id=29");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=30");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/bargain.png' where id=31");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/task.png' where id=32");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/cashier.jpg' where id=33");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/messages.png' where id=34");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/seckill.png' where id=35");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/exchange.png' where id=36");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/game_marketing.png' where id=37");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=38");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/quick_buy.png' where id=39");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/mobile_admin.png' where id=40");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/pc_admin.png' where id=41");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/live.png' where id=42");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/member_card.png' where id=90");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/wxapp.png' where id=50");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/dividend.jpg' where id=70");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/cycle_buy.png' where id=60");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/friendcoupon.png' where id=100");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/ad.png' where id=101");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/role_package.png' where id=102");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/kpi_bonus.png' where id=103");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/plugin_icon/merchant_bonus.png' where id=104");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/qiniu.jpg' where id=1");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/taobao.jpg' where id=2");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/commission.jpg' where id=3");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/poster.jpg' where id=4");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/verify.jpg' where id=5");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/tmessage.jpg' where id=6");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/perm.jpg' where id=7");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sale.jpg' where id=8");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/designer.jpg' where id=9");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/creditshop.jpg' where id=10");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/virtual.jpg' where id=11");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/article.jpg' where id=12");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/coupon.jpg' where id=13");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/postera.jpg' where id=14");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/system.jpg' where id=15");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/diyform.jpg' where id=16");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/exhelper.jpg' where id=17");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/groups.jpg' where id=18");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/designer.jpg' where id=19");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/globonus.jpg' where id=20");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/merch.jpg' where id=21");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/qa.jpg' where id=22");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sms.jpg' where id=24");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sign.jpg' where id=25");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/sns.jpg' where id=26");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=27");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=28");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/abonus.jpg' where id=29");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=30");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/bargain.jpg' where id=31");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/task.jpg' where id=32");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/cashier.jpg' where id=33");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/messages.jpg' where id=34");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/seckill.jpg' where id=35");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/exchange.jpg' where id=36");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/lottery.jpg' where id=37");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=38");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/quick.jpg' where id=39");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/mmanage.jpg' where id=40");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/pc.jpg' where id=41");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/live.jpg' where id=42");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/membercard.png' where id=90");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/app.jpg' where id=50");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/dividend.jpg' where id=70");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/cycelbuy.jpg' where id=60");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/friendcoupon.png' where id=100");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='../addons/ewei_shopv2/static/images/membercard.png' where id=101");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=102");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=103");
        $this->addSql("update `ims_ewei_shop_plugin` set `thumb`='' where id=104");
    }
}
