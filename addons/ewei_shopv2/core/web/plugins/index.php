<?php

if (!defined("IN_IA")) {
    exit("Access Denied");
}
class Plugins_Index_EweiShopV2WebPage extends WebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $category = m("plugin")->getList(1);
        $wxapp_array = array("commission", "creditshop", "diyform", "bargain", "quick", "cycelbuy", "seckill", "groups", "dividend", "membercard", "friendcoupon");
        $apps = false;
        if ($_W["role"] == "founder" || empty($_W["role"])) {
            $apps = true;
        }
        if (p("grant")) {
            $pluginsetting = pdo_fetch("select adv from " . tablename("ewei_shop_system_plugingrant_setting") . " where 1 = 1 limit 1 ");
        }
        include $this->template();
    }
}

?>