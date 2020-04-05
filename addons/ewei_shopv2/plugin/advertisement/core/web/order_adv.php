<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}
class Order_adv_EweiShopV2Page extends PluginWebPage
{
    //广告套餐列表
    public function main(){
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = ' o.uniacid = :uniacid ';
        $params = array(':uniacid' => $_W['uniacid']);
        $type = $_GPC['type'];
        switch ($type) {
            case 'sale': $condition .= 'and o.status = 0 ';//待审核
                break;
            case 'sold': $condition .= 'and o.status = 1 ';//已通过
                break;
            case 'store': $condition .= 'and o.status = 2 ';//未通过
                break;
            default: $condition .= 'and o.status = 0 ';//待审核
        }

//        $starttime = strtotime(trim($_GPC['time']['start']));
//        $endtime = strtotime(trim($_GPC['time']['end']));
//        if (empty($starttime) || empty($endtime)) {
//            $starttime = strtotime('-1 month');
//            $endtime = time();
//            $condition = '';
//        }else {
//            $condition .= ' AND `o.createtime`>=' . $starttime . ' AND o.createtime <=' . $endtime ;
//            $params[':createtime'] = '%' . trim($_GPC['keyword']) . '%';
//        }

        if (!(empty($_GPC['searchfield'])) && !(empty($_GPC['keyword']))) {

            $searchfield = trim(strtolower($_GPC['searchfield']));
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $params[':keyword'] = $_GPC['keyword'];

            if ($searchfield == 'orderno') {
                $condition .= ' AND locate(:keyword,o.orderno)>0 ';
            }else if ($searchfield == 'merchid') {
                $condition .= ' AND (locate(:keyword,o.merchid)>0 ';
            }else if ($searchfield == 'merchname') {
                $condition .= ' AND ( locate(:keyword,m.merchname)>0 ';
            }else if ($searchfield == 'adv_title') {
                $condition .= ' AND locate(:keyword,advg.title)>0';
            }else if ($searchfield == 'goodstitle') {
                $condition .= ' and locate(:keyword,g.title)>0 ';
            }else if ($searchfield == 'goodssn') {
                $condition .= ' and locate(:keyword,g.goodssn)>0 ';
            }
        }
        if (!(empty($_GPC['keyword']))) {
            $_GPC['keyword'] = trim($_GPC['keyword']);
            $condition .= ' AND advg.title LIKE :title';
            $params[':title'] = '%' . trim($_GPC['keyword']) . '%';
        }
        if ($_GPC['status'] != '') {
            $condition .= ' AND o.status = :status';
            $params[':status'] = intval($_GPC['status']);
        }

        $sql = 'SELECT o.*,advg.title as adv_title,advg.price as adv_price,advg.thumb as adv_thumb,g.title as g_title,g.thumb as g_thumb,m.merchname FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as advg on advg.id = o.adv_id and advg.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'where  1 = 1 and ' . $condition . ' ORDER BY o.createtime DESC,o.id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);

        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as advg on advg.id = o.adv_id and advg.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . ' where 1 and ' . $condition, $params);

        $pager = pagination2($total, $pindex, $psize);
        include $this->template();
    }
    public function add(){
        $this->post();
    }
    public function edit(){
        $this->post();
    }
    //添加编辑广告套餐
    protected function post(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        $item = pdo_fetch(
            'SELECT o.*,advg.title as adv_title,advg.stock,advg.showstock,advg.content,advg.groupsprice,advg.price as adv_price,advg.thumb as adv_thumb,advg.thumb_url as adv_thumb_url,g.title as g_title,g.thumb as g_thumb,g.thumb_url as g_thumb_url,m.merchname FROM ' . tablename('ewei_shop_advertisement_order') . ' as o' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_advertisement_goods') . ' as advg on advg.id = o.adv_id and advg.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_goods') . ' g on g.id=o.goods_id and g.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'left join ' . tablename('ewei_shop_merch_user') . ' m on m.id=o.merchid and m.uniacid =  o.uniacid' . "\r\n\t\t\t\t"
            . 'WHERE o.id =:id and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));
        if (!(empty($item['adv_thumb']))) {
            $piclist_adv = iunserializer($item['adv_thumb_url']);
        }
        if (!(empty($item['task_money']))) {
            $item['task_money'] = iunserializer($item['task_money']);
        }
        if (!(empty($item['share_money']))) {
            $item['share_money'] = iunserializer($item['share_money']);
        }
        if (!(empty($item['g_thumb']))) {
            $piclist_goods = array_merge(array($item['g_thumb']),iunserializer($item['g_thumb_url']));
        }

        if ($_W['ispost']) {
            $data = array(
                'share_num' => intval($_GPC['share_num']),
                'seen_num' => intval($_GPC['seen_num']),
                'system_pro' => intval($_GPC['system_pro']),
                'o_g_status' => intval($_GPC['o_g_status']),
                'task_limit_num' => intval($_GPC['task_limit_num']),
                'share_title' => trim($_GPC['share_title']),
                'share_icon' => trim($_GPC['share_icon']),
                'share_desc' => trim($_GPC['share_desc']),
            );
            $taskmoney = array('level'=>$_GPC['level_task_id'],'money'=>$_GPC['task_money']);
            $sharemoney = array('level'=>$_GPC['level_share_id'],'money'=>$_GPC['share_money']);
            $data['share_money'] = serialize($sharemoney);
            $data['task_money'] = serialize($taskmoney);
            if (!(empty($id))) {
                $goods_update = pdo_update('ewei_shop_advertisement_order', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
                if (!($goods_update)) {
                    show_json(0, '广告套餐订单绑定设置失败！');
                }
            }else {
                show_json(0, '操作失败！');
            }
            show_json(1, array('url' => webUrl('advertisement/order_adv/edit', array('op' => 'post', 'id' => $id, 'tab' => str_replace('#tab_', '', $_GPC['tab'])))));
        }
        //代理等级
        $levellist = pdo_fetchall('SELECT id,levelname FROM ' . tablename('ewei_shop_commission_level') . ' WHERE  uniacid=' . $_W['uniacid']);
         include $this->template();
    }

    public function total(){
        global $_W;
        global $_GPC;
        $type = intval($_GPC['type']);
        $condition = ' uniacid = :uniacid ';
        $params[':uniacid'] = $_W['uniacid'];
        if ($type == 1) {
            $condition .= ' and status = 0 ';
        }else if ($type == 2) {
            $condition .= ' and status = 1';
        }else if ($type == 3) {
            $condition .= ' and status = 2 ';
        }
        $total = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_advertisement_order') . ' where ' . $condition . ' ', $params);
        echo json_encode($total);
    }
    public function query(){
        global $_W;
        global $_GPC;
        $kwd = trim($_GPC['keyword']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 8;
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $condition = ' and uniacid=:uniacid and merchid = 0 and type = 1 and status = 1 and deleted = 0 ';
        if (!(empty($kwd))) {
            $condition .= ' AND `title` LIKE :keyword';
            $params[':keyword'] = '%' . $kwd . '%';
        }
        $ds = pdo_fetchall(
            'SELECT id as gid,title,subtitle,thumb,thumb_url,marketprice,productprice,subtitle,content,goodssn,productsn,followtip,followurl' . "\r\n\t\t\t\t"
            . 'FROM ' . tablename('ewei_shop_goods') . ' WHERE 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
        foreach ($ds as &$d ) {
            if (!(empty($d['thumb_url']))) {
                $d['thumb_url'] = iunserializer($d['thumb_url']);
            }
        }
        unset($d);
        $ds = set_medias($ds, array('share_icon'));
        if ($_GPC['suggest']) {
            exit(json_encode(array('value' => $ds)));
        }
        $total = pdo_fetchcolumn('SELECT count(1) FROM ' . tablename('ewei_shop_goods') . ' WHERE 1 ' . $condition . ' ', $params);
        $pager = pagination2($total, $pindex, $psize, '', array('before' => 5, 'after' => 4, 'ajaxcallback' => 'select_page', 'callbackfuncname' => 'select_page'));
        include $this->template();
    }
    public function delete1(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }
        $items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item ) {
            pdo_delete('ewei_shop_advertisement_goods', array('id' => $item['id']));
            plog('advertisement.goods.edit', '从回收站彻底删除广告套餐<br/>ID: ' . $item['id'] . '<br/>广告名称: ' . $item['title']);
        }
        show_json(1, array('url' => referer()));
    }
    public function restore(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }
        $items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item ) {
            pdo_update('ewei_shop_advertisement_goods', array('deleted' => 0, 'status' => 0), array('id' => $item['id']));
            plog('advertisement.goods.edit', '从回收站恢复广告套餐<br/>ID: ' . $item['id'] . '<br/>广告名称: ' . $item['title']);
        }
        show_json(1, array('url' => referer()));
    }
    public function delete(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }
        $items = pdo_fetchall('SELECT id,title FROM ' . tablename('ewei_shop_advertisement_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item ) {
            $delete_update = pdo_update('ewei_shop_advertisement_goods', array('deleted' => 1, 'status' => 0), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
            if (!($delete_update)) {
                show_json(0, '删除广告套餐失败！');
            }
            plog('advertisement.goods.delete', '删除广告套餐 ID: ' . $item['id'] . '  <br/>广告名称: ' . $item['title'] . ' ');
        }
        show_json(1, array('url' => referer()));
    }

    public function status(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }
        $status = intval($_GPC['status']);
        $items = pdo_fetchall('SELECT id,status FROM ' . tablename('ewei_shop_advertisement_order') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item ) {
            $status_update = pdo_update('ewei_shop_advertisement_order', array('status' => $status), array('id' => $item['id']));
            if (!($status_update)) {
                throw new Exception('广告套餐订单状态修改失败！');
            }
            //plog('advertisement.order_adv.edit', '修改广告套餐订单 ' . $item['id'] . ' <br /> 状态: ' . (($status == 0 ? '下架' : '上架')));
        }
        show_json(1, array('url' => referer()));
    }
    public function property(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        $type = trim($_GPC['type']);
        $value = intval($_GPC['value']);
        if (in_array($type, array('o_g_status', 'displayorder'))) {
            $statusstr = '';
            if ($type == 'o_g_status') {
                $typestr = '上下架';
                $statusstr = (($value == 1 ? '上架' : '下架'));
            }else if ($type == 'displayorder') {
                $typestr = '排序';
                $statusstr = '序号 ' . $value;
            }else if ($type == 'isindex') {
                $typestr = '是否首页显示';
                $statusstr = (($value == 1 ? '是' : '否'));
            }
            $property_update = pdo_update('ewei_shop_advertisement_order', array($type => $value), array('id' => $id, 'uniacid' => $_W['uniacid']));
            if (!($property_update)) {
                throw new Exception('' . $typestr . '修改失败');
            }
            plog('advertisement.order_adv.edit', '修改广告套餐订单' . $typestr . '状态   ID: ' . $id . ' ' . $statusstr . ' ');
        }
        show_json(1);
    }
}
?>