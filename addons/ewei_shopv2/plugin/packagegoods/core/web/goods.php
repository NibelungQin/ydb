<?php
if (!(defined('IN_IA')))
{
	exit('Access Denied');
}
class Goods_EweiShopV2Page extends PluginWebPage
{
	public function main(){
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' uniacid = :uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		$type = $_GPC['type'];
		switch ($type) {
			case 'sale': $condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
				break;
			case 'sold': $condition .= ' and deleted = 0 and stock <= 0 and status = 1 ';
				break;
			case 'store': $condition .= ' and deleted = 0 and status = 0 ';
				break;
			case 'recycle': $condition .= ' and deleted = 1 ';
				break;
			default: $condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
		}
		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND title LIKE :title';
			$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
		}
		if ($_GPC['status'] != '') {
			$condition .= ' AND status = :status';
			$params[':status'] = intval($_GPC['status']);
		}
		$sql = 'SELECT * FROM ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t\t" . 'where  1 = 1 and ' . $condition . ' ORDER BY displayorder DESC,id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall($sql, $params);
		foreach($list as $k=>$v) {
			$list[$k]['packagedata'] = unserialize($v['packagedata']);
			$list[$k]['package_label'] = unserialize($v['package_label']);
		}
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_packagegoods_goods') . ' AS g where 1 and ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}
	public function add(){
		$this->post();
	}
	public function edit(){
		$this->post();
	}
	protected function post(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_packagegoods_goods') . "\r\n\t\t\t\t"
			. 'WHERE id =:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id)
		);
		$item['packagedata'] = unserialize($item['packagedata']);
		$item['package_label'] = unserialize($item['package_label']);
		$item['package_member_card'] = unserialize($item['package_member_card']);

		if (!(empty($id))) {
			$commission = json_decode($item['commission'], true);
			if (isset($commission['type'])) {
				$commission_type = $commission['type'];
				unset($commission['type']);
			}
			$item['globonus'] = unserialize($item['globonus']);
			$item['abonus'] = unserialize($item['abonus']);
		}

		if (!(empty($item['thumb']))) {
			$piclist = iunserializer($item['thumb_url']);
		}
		//快递模板
		$dispatch_data = pdo_fetchall('select * from ' . tablename('ewei_shop_dispatch') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $_W['uniacid']));

		//会员等级
		$default = array(
			'id' => 0,
			'levelname' => empty($set['shop']['levelname']) ? '普通等级' : $set['shop']['levelname'],
			'discount' => $set['shop']['leveldiscount'],
			'ordermoney' => 0,
			'ordercount' => 0,
//			'membercount' => pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_member')
//				. ' where uniacid=:uniacid and level=0 limit 1', array(':uniacid' => $_W['uniacid'])
//			)
		);
		$member_level = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_member_level') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY ordermoney asc');
		$member_level = array_merge(array($default), $member_level);


		//分销等级
		if (p('commission')) {
			$com_set = p('commission')->getSet();
		}

		$commission_level = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_commission_level') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY commission1 asc');
		foreach ($commission_level as &$l ) {
			$l['key'] = 'level' . $l['id'];
		}
		unset($l);
		$commission_level = array_merge(
			array(
				array(
					'key' => 'default',
					'levelname' => (empty($_W['shopset']['commission']['levelname']) ? '默认等级' : $_W['shopset']['commission']['levelname']))
			),
			$commission_level
		);

		//$default = array('id' => '0', 'levelname' => (empty($_S['commission']['levelname']) ? '默认等级' : $_S['commission']['levelname']), 'commission1' => $_S['commission']['commission1'], 'commission2' => $_S['commission']['commission2'], 'commission3' => $_S['commission']['commission3'], 'withdraw' => (double) $_S['commission']['withdraw_default'], 'repurchase' => (double) $_S['commission']['repurchase_default']);
		//$commission_level = array_merge(array($default), $commission_level);

		//店铺等级
		$globonus_level = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid order by id asc', array(':uniacid' => $_W['uniacid']));
		$default = array('id' => '0', 'levelname' => (empty($_S['globonus']['levelname']) ? '默认等级' : $_S['globonus']['levelname']), 'bonus' => $_W['shopset']['globonus']['bonus']);
		$globonus_level = array_merge(array($default), $globonus_level);


		//区域等级
		$abonus_level = pdo_fetchall('select * from ' . tablename('ewei_shop_abonus_level') . ' where uniacid=:uniacid order by id asc', array(':uniacid' => $_W['uniacid']));

		$default = array('id' => '0',
			'levelname' => (empty($_S['abonus']['levelname']) ? '默认等级' : $_S['abonus']['levelname']),
			'bonus1' => $_W['shopset']['abonus']['bonus1'],
			'bonus2' => $_W['shopset']['abonus']['bonus2'],
			'bonus3' => $_W['shopset']['abonus']['bonus3']
		);

		$abonus_level = array_merge(array($default), $abonus_level);



		$item['commission_html'] .= '<select id="package_type_1"';
		if($item['packagedata']['commission_package'] ==1) {
			$item['commission_html'] .= 'style="width:338px;margin-bottom:3px;float:left !important;"';
		}else {
			$item['commission_html'] .= 'style="width:338px;margin-bottom:3px;float:left !important;display:none;"';
		}
		$item['commission_html'] .= 'class="form-control tpl-category-parent select2" name="commission_package_level">';
		foreach($commission_level as $k=>$v) {
			$item['commission_html'] .= '<option value="'.$v['id'];
			if($item['packagedata']['commission_package_level'] == $v['id'] ) {
				$item['commission_html'] .= 'selected';
			}
			$item['commission_html'] .= '">'.$v['levelname'].'</option>';
		}
		$item['commission_html'] .= '</select>';




		$item['globonus_html'] .= '<select id="package_type_2"';
		if($item['packagedata']['globonus_package'] ==1) {
			$item['globonus_html'] .= 'style = "width:338px;margin-bottom:3px;"';
		}else {
			$item['globonus_html'] .= 'style="width:338px;margin-bottom:3px;display:none;"';
		}
		$item['globonus_html'] .= 'class="form-control tpl-category-parent select2" name="globonus_package_level" style="float:left !important;">';
		foreach($globonus_level as $k=>$row) {
			$item['globonus_html'] .= '<option value="' . $row['id'] . '"';
			if ($item['packagedata']['globonus_package_level'] == $row['id']) {
				$item['globonus_html'] .= 'selected';
			}
			$item['globonus_html'] .= '>' . $row['levelname'] . '</option>';
		}
		$item['globonus_html'] .= '</select>';



		$item['abonus_html'] .= '<select id="package_type_3"';
		if($item['packagedata']['abonus_package'] ==1) {
			$item['abonus_html'] .= 'style = "width:338px;margin-bottom:3px;"';
		}else {
			$item['abonus_html'] .= 'style="width:338px;margin-bottom:3px;display:none;"';
		}
		$item['abonus_html'] .= 'class="form-control tpl-category-parent select2" name="abonus_package_level" style="float:left !important;">';
		foreach($abonus_level as $k=>$row) {
			$item['abonus_html'] .= '<option value="' . $row['id'] . '"';
			if ($item['packagedata']['abonus_package_level'] == $row['id']) {
				$item['abonus_html'] .= 'selected';
			}
			$item['abonus_html'] .= '>' . $row['levelname'] . '</option>';
		}
		$item['abonus_html'] .= '</select>';






		//会员卡
		$member_card = pdo_fetchall('select id,name from ' . tablename('ewei_shop_member_card') . ' where uniacid=:uniacid and status=1', array(':uniacid' => $_W['uniacid']));

		$item['card_html'] .= '<div id="member_vip" style="height:28px;">';
		$item['card_html'] .= '<div style="width:100%;margin-bottom:15px;float:left">';
		$item['card_html'] .= '<p style="float:left;line-height:28px;margin-right:16px;">选择绑定会员卡</p>';
		$item['card_html'] .= '<select style="width:338px;margin-bottom:3px;float:left;" class="form-control tpl-category-parent select2" name="member_card_type" style="float:left !important;">';
		$item['card_html'] .= '<option value="0">--请选择--</option>';
		foreach($member_card as $k=>$row) {
			$item['card_html'] .= '<option value="'.$row['id'].'" ';
			if($item['package_member_card']['member_card_type']==$row['id']){
				$item['card_html'] .= 'selected';
			}
			$item['card_html'] .= '>'.$row['name'].'</option>';
		}
		$item['card_html'] .= '</select>';
		$item['card_html'] .= '<span style="line-height:28px;color:#999;">备注:会员卡一旦绑定上架之后不能进行更换</span>';
		$item['card_html'] .= '</div>';

		$item['card_html'] .= '<div style="width:100%;margin-bottom:3px;float:left">';
		$item['card_html'] .= '<div style="float:left;width:40%;">';
		$item['card_html'] .= '<div style="float:left;margin-right:6px;">';
		$item['card_html'] .= '<input style="display:block;float:left;margin-right:8px;margin-top:8px;" type="radio" name="recharge_type" value="1"';
		if($item['package_member_card']['recharge_type']==1){
			$item['card_html'] .= 'checked="checked"';
		}
		$item['card_html'] .= ' >';
		$item['card_html'] .= '<span style="display:block;float:left;margin-top:7px;margin-right:5px;">充值到会员卡金额</span>';
		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';
		$item['card_html'] .= '<input style="width:150px;float:left;" class="form-control" type="text" name="recharge_money_pay" value="'.$item['package_member_card']['recharge_money_pay'].'">';
		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';

		$item['card_html'] .= '<div style="float:left;width:40%;">';
		$item['card_html'] .= '<div style="float:left;margin-right:6px;">';
		$item['card_html'] .= '<input style="display:block;float:left;margin-right:8px;margin-top:8px;" type="radio" name="recharge_type" value="2"';
		if($item['package_member_card']['recharge_type']==2) {
			$item['card_html'] .= 'checked="checked"';
		}
		$item['card_html'] .= '>';
		$item['card_html'] .= '<span style="display:block;float:left;margin-top:7px;margin-right:5px;">充值到会员卡积分</span>';
		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';
		$item['card_html'] .= '<input style="width:150px;float:left;" class="form-control" type="text" name="recharge_integral_pay" value="'.$item['package_member_card']['recharge_integral_pay'].'">';
		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';
		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';

		$item['card_html'] .= '<div style="clear:both;"></div>';
		$item['card_html'] .= '</div>';

		//添加修改礼包
		if ($_W['ispost']) {
			$data = array(
				'uniacid' => $_W['uniacid'],//所属公众号
				'displayorder' => intval($_GPC['displayorder']),//排序
				'title' => trim($_GPC['title']),//礼包标题
				'thumb' => '',
				'thumb_url' => '',
				'price' => floatval($_GPC['price']),//原价
				'packageprice' => floatval($_GPC['packageprice']),//现价
				'goodsnum' => (intval($_GPC['goodsnum']) < 1 ? 1 : intval($_GPC['goodsnum'])),//数量
				'units' => trim($_GPC['units']),//单位
				'stock' => intval($_GPC['stock']),//库存
				'showstock' => intval($_GPC['showstock']),//显示库存
				'sales' => intval($_GPC['sales']),//已出售数
				'dispatchtype' => intval($_GPC['dispatchtype']),//运费模板
				'freight' => floatval($_GPC['freight']),//运费
				'status' => intval($_GPC['status']),//上下架
				'isindex' => intval($_GPC['isindex']),//
				'description' => trim($_GPC['description']),//礼包简短介绍
				'goodssn' => trim($_GPC['goodssn']),//编码
				'productsn' => trim($_GPC['productsn']),//条码
				'content' => m('common')->html_images($_GPC['content']),//礼包简介
				'createtime' => $_W['timestamp'],
				'share_title' => trim($_GPC['share_title']),
				'share_icon' => trim($_GPC['share_icon']),
				'share_desc' => trim($_GPC['share_desc']),
				'followneed' => intval($_GPC['followneed']),//购买强制关注
				'followtext' => trim($_GPC['followtext']),//未关注提示
				'followurl' => trim($_GPC['followurl']),//关注引导
			);

			if (p('commission')) {
				$cset = p('commission')->getSet();
				if (!(empty($cset['level']))) {
					$data['commission_type'] = intval($_GPC['commission_type']);//选择分销奖励模式
					$data['nocommission'] = intval($_GPC['nocommission']);//是否参与分销
					$data['hascommission'] = intval($_GPC['hascommission']);//是否启用独立佣金比例
					$data['commission1_rate'] = $_GPC['commission1_rate'];//一级分销比例
					$data['commission2_rate'] = $_GPC['commission2_rate'];//二级分销比例
					$data['commission3_rate'] = $_GPC['commission3_rate'];//三级分销比例
					$data['commission1_pay'] = $_GPC['commission1_pay'];//一级分销固定佣金
					$data['commission2_pay'] = $_GPC['commission2_pay'];//二级分销固定佣金
					$data['commission3_pay'] = $_GPC['commission3_pay'];//三级分销固定佣金
				}
			}


			$data['globonus_type'] = intval($_GPC['globonus_type']);//选择店铺奖励模式
			foreach ($globonus_level as $level ) {
					$globonusDefaultArray[$level['id']] = $_GPC['globonus_level_reward'][$level['id']];
			}
			$data['globonus'] = (is_array($globonusDefaultArray) ? serialize($globonusDefaultArray) : serialize(array()));//店铺等级对应佣金比例



			$data['abonus_type'] = intval($_GPC['abonus_type']);//选择区域奖励模式
            $data['achievement_type'] = intval($_GPC['achievement_type']);//绩效奖励开关
            $data['achievement_proportion'] = intval($_GPC['achievement_proportion']);//绩效奖励比例
			foreach($_GPC['abonus_level'] as $k=>$v ) {
				$abonusDefaultArray[] = array(
					'level'=>intval($v),
					'province'=>trim($_GPC['abonus_level_reward_province'][$k]),
					'city'=>trim($_GPC['abonus_level_reward_city'][$k]),
					'area'=>trim($_GPC['abonus_level_reward_area'][$k]),
				);
			}

			$data['abonus'] = (is_array($abonusDefaultArray) ? serialize($abonusDefaultArray) : serialize(array()));



			$data['packagedata'] = array(//礼包类型
				'commission_package' =>intval($_GPC['commission_package']),//分销礼包
				'commission_package_level' =>intval($_GPC['commission_package_level']),

				'globonus_package' =>intval($_GPC['globonus_package']),//店铺礼包
				'globonus_package_level' =>intval($_GPC['globonus_package_level']),

				'abonus_package' =>intval($_GPC['abonus_package']),//店铺礼包
				'abonus_package_level' =>intval($_GPC['abonus_package_level']),

				'member_package' =>intval($_GPC['member_package']),//会员身份
				'member_package_level' =>intval($_GPC['member_package_level']),
			);
			$data['packagedata'] = serialize($data['packagedata']);

			if($_GPC['virtual_package_label'] == 1 && $_GPC['recharge_package_label'] == 1) {//虚拟、充值标签
				$data['package_label'] = array(
					'material_package_label' =>0,
					'virtual_package_label' =>intval($_GPC['virtual_package_label']),
					'recharge_package_label' =>intval($_GPC['recharge_package_label']),
				);
			}elseif($_GPC['virtual_package_label'] == 1 && $_GPC['recharge_package_label'] == 0) {//虚拟标签
				$data['package_label'] = array(
					'material_package_label' =>0,
					'virtual_package_label' =>intval($_GPC['virtual_package_label']),
					'recharge_package_label' =>0,
				);
			}elseif($_GPC['virtual_package_label'] == 0 && $_GPC['recharge_package_label'] == 1) {//实物、充值标签
				$data['package_label'] = array(
					'material_package_label' =>1,
					'virtual_package_label' =>0,
					'recharge_package_label' =>intval($_GPC['recharge_package_label']),
				);
			}else {//实物标签
				$data['package_label'] = array(
					'material_package_label' =>1,
					'shop_package_label' =>0,
					'recharge_package_label' =>0,
				);
			}
			$data['package_label'] = serialize($data['package_label']);

			if($_GPC['recharge_package_label'] == 1) {//充值标签
				if($_GPC['recharge_type'] ==1) {
					$data['package_member_card'] = array(//绑定会员卡设置
						'member_card_type'=>intval($_GPC['member_card_type']),//会员卡类型
						'recharge_type'=>intval($_GPC['recharge_type']),//充值类型：1金额，2积分
						'recharge_money_pay'=>intval($_GPC['recharge_money_pay']),//充值金额数
					);
				}elseif($_GPC['recharge_type'] ==2) {
					$data['package_member_card'] = array(//绑定会员卡设置
						'member_card_type'=>intval($_GPC['member_card_type']),//会员卡类型
						'recharge_type'=>intval($_GPC['recharge_type']),//充值类型：1金额，2积分
						'recharge_integral_pay'=>intval($_GPC['recharge_integral_pay']),//充值金额数
					);
				}
				$data['package_member_card'] = serialize($data['package_member_card']);
			}

			if (($data['goodsnum'] < 0)) {
				show_json(0, '数量不能小于1！');
			}

			if (is_array($_GPC['thumbs'])) {
				$thumbs = $_GPC['thumbs'];
				$thumb_url = array();
				foreach ($thumbs as $th ) {
					$thumb_url[] = trim($th);
				}
				$data['thumb'] = save_media($thumb_url[0]);
				$data['thumb_url'] = serialize(m('common')->array_images($thumb_url));
			}

			if (!(empty($id))) {
				$goods_update = pdo_update('ewei_shop_packagegoods_goods', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				if (!($goods_update)) {
					show_json(0, '礼包编辑失败！');
				}
				plog('packagegoods.goods.edit', '编辑升级大礼包 ID: ' . $id . ' <br/>礼包名称: ' . $data['title']);
			}else {
				$goods_insert = pdo_insert('ewei_shop_packagegoods_goods', $data);
				if (!($goods_insert)) {
					show_json(0, '礼包添加失败！');
				}
				$id = pdo_insertid();
				plog('packagegoods.goods.add', '添加升级大礼包 ID: ' . $id . '  <br/>礼包名称: ' . $data['title']);
			}



			$commissionArrayPost = json_decode($_POST['commissionArray'], true);
			$commissionArray = array();
			$commissionDefaultArray = array();

			if (!(empty($commissionArray)) && $data['hasoption']) {
				$commissionArray = array_merge(array('type' => (int) $_GPC['commission_type_status']), $commissionArray);
				$commission_arr = array('commission' => (is_array($commissionArray) ? json_encode($commissionArray) : json_encode(array())));
			}else {
				foreach ($commission_level as $level ) {
					if ($level['key'] == 'default') {
						if (!(empty($_GPC['commission_level_' . $level['key'] . '_default']))) {
							foreach ($_GPC['commission_level_' . $level['key'] . '_default'] as $key => $value ) {
								$commissionDefaultArray[$level['key']]['option0'][] = $value;
							}
						}
					}else if (!(empty($_GPC['commission_level_' . $level['id'] . '_default']))) {
						foreach ($_GPC['commission_level_' . $level['id'] . '_default'] as $key => $value ) {
							$commissionDefaultArray[$level['key']]['option0'][] = $value;
						}
					}
				}
				$commissionDefaultArray = array_merge(array('type' => (int) $_GPC['commission_type_status']), $commissionDefaultArray);
				$commission_arr = array('commission' => (is_array($commissionDefaultArray) ? json_encode($commissionDefaultArray) : json_encode(array())));
			}

			pdo_update('ewei_shop_packagegoods_goods', $commission_arr, array('id' => $id));


			show_json(1,
				array(
					'url' => webUrl(
						'packagegoods/goods/edit',
						array('op' => 'post',
							'id' => $id,
							'tab' => str_replace('#tab_', '', $_GPC['tab'])
						)
					)
				));
		}
		include $this->template();
	}
	//根据不同大礼包商品状态统计显示数据
	public function total() {
		global $_W;
		global $_GPC;
		$type = intval($_GPC['type']);
		$condition = ' uniacid = :uniacid ';
		$params[':uniacid'] = $_W['uniacid'];
		if ($type == 1) {
			$condition .= ' and deleted = 0 and stock > 0 and status = 1 ';
		}else if ($type == 2) {
			$condition .= ' and deleted = 0 and stock = 0 and status = 1';
		}else if ($type == 3) {
			$condition .= ' and deleted = 0 and status = 0 ';
		}else if ($type == 4) {
			$condition .= ' and deleted = 1 ';
		}
		$total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_packagegoods_goods') . ' where ' . $condition . ' ', $params);
		echo json_encode($total);
	}
	//恢复到仓库
	public function restore() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_packagegoods_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_update('ewei_shop_packagegoods_goods', array('deleted' => 0, 'status' => 0), array('id' => $item['id']));
			plog('packagegoods.goods.edit', '从回收站恢复大礼包<br/>ID: ' . $item['id'] . '<br/>大礼包名称: ' . $item['title']);
		}
		show_json(1, array('url' => referer()));
	}
	//彻底删除
	public function delete1(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_packagegoods_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			pdo_delete('ewei_shop_packagegoods_goods', array('id' => $item['id']));
			plog('packagegoods.goods.edit', '从回收站彻底删除大礼包<br/>ID: ' . $item['id'] . '<br/>大礼包名称: ' . $item['title']);
		}
		show_json(1, array('url' => referer()));
	}
	//删除
	public function delete() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_packagegoods_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			$delete_update = pdo_update('ewei_shop_packagegoods_goods', array('deleted' => 1, 'status' => 0), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			if (!($delete_update)) {
				show_json(0, '删除礼包失败！');
			}
			plog('packagegoods.goods.delete', '删除升级礼包 ID: ' . $item['id'] . '  <br/>礼包名称: ' . $item['title'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
	//上下架
	public function status()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$status = intval($_GPC['status']);
		$items = pdo_fetchall('SELECT id,status FROM ' . tablename('ewei_shop_packagegoods_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) {
			$status_update = pdo_update('ewei_shop_packagegoods_goods', array('status' => $status), array('id' => $item['id']));
			if (!($status_update)) {
				throw new Exception('大礼包状态修改失败！');
			}
			plog('packagegoods.goods.edit', '修改升级大礼包 ' . $item['id'] . ' <br /> 状态: ' . (($status == 0 ? '下架' : '上架')));
		}
		show_json(1, array('url' => referer()));
	}
	//上下架、排序操作
	public function property() {
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = trim($_GPC['type']);
		$value = intval($_GPC['value']);
		if (in_array($type, array('status', 'displayorder'))) {
			$statusstr = '';
			if ($type == 'status') {
				$typestr = '上下架';
				$statusstr = (($value == 1 ? '上架' : '下架'));
			}else if ($type == 'displayorder') {
				$typestr = '排序';
				$statusstr = '序号 ' . $value;
			}else if ($type == 'isindex') {
				$typestr = '是否首页显示';
				$statusstr = (($value == 1 ? '是' : '否'));
			}
			$property_update = pdo_update('ewei_shop_packagegoods_goods', array($type => $value), array('id' => $id, 'uniacid' => $_W['uniacid']));
			if (!($property_update)) {
				throw new Exception('' . $typestr . '修改失败');
			}
			plog('packagegoods.goods.edit', '修改升级大礼包' . $typestr . '状态   ID: ' . $id . ' ' . $statusstr . ' ');
		}
		show_json(1);
	}

}
?>