<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Util_Area_EweiShopV2WebPage extends WebPage
{
	public function ajax()
	{
		global $_W;
		global $_GPC;
		$province_code = $_GPC['province_code'];
		$areas = m('common')->getAreas();
		$stc = '';
		$sta = '';

		foreach ($areas['province'] as $value) {
			if ($value['@attributes']['code'] == $province_code) {
				foreach ($value['city'] as $city) {
					$stc .= '<div class=\'child c-group clist pcode_c' . $value['@attributes']['code'] . '\' style=\'display: none;\'>
                        <label class=\'checkbox-inline \' style=\'cursor: default\'>' . $city['@attributes']['name'] . '</label>
                        <label class=\'checkbox-inline pull-right\'>
                        <input type=\'checkbox\' id=\'ch_ccode' . $city['@attributes']['code'] . '\' class=\'cityall checkbox_pcode' . $value['@attributes']['code'] . '\' value=\'' . $city['@attributes']['name'] . '\' data-value=\'' . $city['@attributes']['code'] . '\' pcode=\'' . $value['@attributes']['code'] . '\' pname=\'' . $value['@attributes']['name'] . '\' title=\'选择\' />
                        </label>
                  </div>';

					if (is_array($city['county'])) {
						foreach ($city['county'] as $county) {
							$sta .= ' <div class=\'child a-group alist pcode_a' . $value['@attributes']['code'] . ' ccode_a' . $city['@attributes']['code'] . '\' style=\'display: none;\'>
                                  <label class=\'checkbox-inline \' style=\'cursor: default\'>' . $county['@attributes']['name'] . '</label>
                                  <label class=\'checkbox-inline pull-right\'>
                                  <input type=\'checkbox\' id=\'ch_acode' . $county['@attributes']['code'] . '\' class=\'areaall checkbox_pcode' . $value['@attributes']['code'] . ' checkbox_ccode' . $city['@attributes']['code'] . '\' value=\'' . $county['@attributes']['name'] . '\' data-value=\'' . $county['@attributes']['code'] . '\' ccode=\'' . $city['@attributes']['code'] . '\' pcode=\'' . $value['@attributes']['code'] . '\' cname=\'' . $city['@attributes']['name'] . '\' pname=\'' . $value['@attributes']['name'] . '\' title=\'选择\' />
                                  </label>
                               </div>';
						}
					}
				}
			}
		}

		$data['stc'] = $stc;
		$data['sta'] = $sta;
		show_json(1, $data);
	}
}

?>