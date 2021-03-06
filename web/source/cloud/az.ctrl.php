<?php
load()->func('communication');
load()->model('cloud');
load()->func('file');
load()->func('az');

global $_W, $_GPC;
if ($_GPC['op'] == 'yun') {
    $op = $_GPC['op'];
    $ver = $_GPC['dataurl'];
    $ver = base64_decode($ver);
    $ver = $ver - 0.1;
    $hosturl = $_SERVER['HTTP_HOST'];
    $updatehost = 'http://www.yidaoit.cn/update.php';
    $lastver = file_get_contents($updatehost . '?a=check&v=' . $ver);
    $updatehosturl = $updatehost . '?a=update&v=' . $ver . '&u=' . $hosturl;
    $updatenowinfo = file_get_contents($updatehosturl);

    //$vern = $ver+0.1;
    $prturl = $updatehost . '?a=pra&v=' . $ver . '&u=' . $hosturl;
    $pr = file_get_contents($prturl);
    $prcl = explode('<br>', $pr);
    $packet['files'] = $prcl;
    $packet['type'] = '';

    if (strstr($updatenowinfo, 'zip')) {
        $pathurl = $updatehost . '?a=down&f=' . $updatenowinfo . '&u=' . $hosturl;
        $updatedir = IA_ROOT . '/data/update';
        if (!is_dir($updatedir)) {
            mkdirs($updatedir);
        }

        $isgot = get_file($pathurl, $updatenowinfo, $updatedir);

        if ($isgot) {
            $updatezip = $updatedir . '/' . $updatenowinfo;
            require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/Shared/PCLZip/pclzip.lib.php';
            $thisfolder = new PclZip($updatezip);
            $isextract = $thisfolder->extract(PCLZIP_OPT_PATH, $updatedir);
            if ($isextract == 0) {
                itoast('解压模块文件失败！', referer(), 'error');
            }
            $archive = new PclZip($updatezip);
            $list = $archive->extract(PCLZIP_OPT_PATH, IA_ROOT, PCLZIP_OPT_REPLACE_NEWER);

            if ($list == 0) {
                itoast('云市场模块文件不存在或站点没有读写权限,升级失败！', referer(), 'error');
            }

            if (file_exists($updatedir . '/update.sql')) {
                $sqlfile = $updatedir . '/update.sql';

                runquery($sqlfile);
            }

            $newver = "<?php return array ('ver' => '$lastver');?>";
            $f = fopen(IA_ROOT . '/web/key.php', 'w+');
            fwrite($f, $newver);
            fclose($f);
            @unlink(IA_ROOT . '/update.sql');
            deldir($updatedir);
        } else {
            itoast('查找不到模块安装包！', referer(), 'error');
        }
    } else {
        itoast('您还未获得应用市场授权，请购买授权后安装！', url('module/manage-system/not_installed', array('account_type' => '1')),
            'error');
    }

}
template('cloud/az');
