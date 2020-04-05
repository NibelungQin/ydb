<?php

use Ydb\Entity\Manual\Member;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require(EWEI_SHOPV2_PLUGIN . 'dividend/core/dividend_page_web.php');

class Dividend_Increase_EweiShopV2PluginMobilePage extends DividendWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $days = (int)$_GPC['days'];
        if (empty($_GPC['search'])) {
            $days = 7;
        }
        $years = [];
        $current_year = date('Y');
        $year = $_GPC['year'];
        for ($i = $current_year - 10; $i <= $current_year; $i++) {
            $years[] = ['data' => $i, 'selected' => $i == $year];
        }
        $months = [];
        $current_month = date('m');
        $month = $_GPC['month'];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = ['data' => $i, 'selected' => $i == $month];
        }
        $timefield = 'agenttime';
        $datas = [];
        $title = '';
        if (!empty($days)) {
            $charttitle = '最近' . $days . '天增长趋势图';
            for ($i = $days; 0 <= $i; $i--) {
                $time = date('Y-m-d', strtotime('-' . $i . ' day'));
                $condition = ' and uniacid=:uniacid and ' . $timefield . '>=:starttime and ' . $timefield . '<=:endtime';
                $params = [
                    ':uniacid' => $_W['uniacid'],
                    ':starttime' => strtotime($time . ' 00:00:00'),
                    ':endtime' => strtotime($time . ' 23:59:59')
                ];
                $datas[] = [
                    'date' => $time,
                    'acount' => pdo_fetchcolumn('
                        select count(*) from ' . Member::TABLE_NAME . '
                        where isagent=1 and status=1  ' . $condition,
                        $params)
                ];
            }
        } elseif (!empty($year) && !empty($month)) {
            $charttitle = (string)$year . '年' . $month . '月增长趋势图';
            $lastday = get_last_day($year, $month);
            for ($d = 1; $d <= $lastday; $d++) {
                $condition = ' and uniacid=:uniacid and ' . $timefield . '>=:starttime and ' . $timefield . '<=:endtime';
                $params = [
                    ':uniacid' => $_W['uniacid'],
                    ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'),
                    ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59')
                ];
                $datas[] = [
                    'date' => (string)$d . '日',
                    'acount' => pdo_fetchcolumn('
                        select count(*) from ' . Member::TABLE_NAME . '
                        where isagent=1  ' . $condition,
                        $params)
                ];
            }
        } elseif (!empty($year)) {
            $charttitle = $year . '年增长趋势图';
            foreach ($months as $m) {
                $lastday = get_last_day($year, $m['data']);
                $condition = ' and uniacid=:uniacid and ' . $timefield . '>=:starttime and ' . $timefield . '<=:endtime';
                $params = [
                    ':uniacid' => $_W['uniacid'],
                    ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'),
                    ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59')
                ];
                $datas[] = [
                    'date' => $m['data'] . '月',
                    'acount' => pdo_fetchcolumn('
                        select count(*) from ' . Member::TABLE_NAME . '
                        where isagent=1  ' . $condition,
                        $params)
                ];
            }
        }
        include($this->template());
    }
}
