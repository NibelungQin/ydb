<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends PluginMobilePage 
{
	public function main() {
		global $_W;
		global $_GPC;
		try {
			$uniacid = $_W['uniacid'];
			$openid = $_W['openid'];
			$advs = pdo_fetchall('select id,advname,link,thumb from ' . tablename('ewei_shop_packagegoods_adv') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
			$advs = set_medias($advs, 'thumb');
			$packagegoods_type = pdo_fetchall('select id,name,thumb from ' . tablename('ewei_shop_packagegoods_type') . ' where uniacid=:uniacid and  enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
			$recgoods = pdo_fetchall('select id,title,thumb,thumb_url,price,packageprice,isindex,goodsnum,units,sales,description,packagedata,package_label from ' . tablename('ewei_shop_packagegoods_goods')
				. 'where uniacid=:uniacid and isindex = 1 and  status=1 and deleted=0 and stock>0 order by displayorder desc,id DESC limit 20', array(':uniacid' => $uniacid));
            foreach($recgoods as $k=>$v) {
                $recgoods[$k]['packagedata'] = unserialize($v['packagedata']);
                $recgoods[$k]['package_label'] = unserialize($v['package_label']);
            }

            $recgoods = set_medias($recgoods, 'thumb');
			$this->model->packagegoodsShare();
			include $this->template();
		}catch (Exception $e) {
			$content = $e->getMessage();
			include $this->template('packagegoods/error');
		}
	}

	public function test(){
        global $_W;
        global $_GPC;
	    $openid=$_W['openid'];
        $uniacid=$_W['uniacid'];
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_packagegoods_order') . "\r\n\t\t\t\t" . 'where openid=:openid  and uniacid=:uniacid and id = :orderid order by createtime desc ', array(':uniacid' => $uniacid, ':openid' => $openid, ':orderid' => 166));
        $globonus_data = p('globonus')->packagegoods_getBonusData($_W['openid'],  $order['id']);//佣金数据
        dump($globonus_data);die;
    }
}
?>