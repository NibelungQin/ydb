<?php

use Ydb\Entity\Manual\Engine\Modules;

if (!function_exists('_login')) {
    function _login($forward = '')
    {
        global $_GPC, $_W;
        if (empty($_GPC['login_type'])) {
            $_GPC['login_type'] = 'system';
        }

        if (empty($_GPC['handle_type'])) {
            $_GPC['handle_type'] = 'login';
        }


        if ($_GPC['handle_type'] === 'login') {
            $member = OAuth2Client::create(
                $_GPC['login_type'],
                $_W['setting']['thirdlogin'][$_GPC['login_type']]['appid'],
                $_W['setting']['thirdlogin'][$_GPC['login_type']]['appsecret']
            )->login();
        } else {
            $member = OAuth2Client::create(
                $_GPC['login_type'],
                $_W['setting']['thirdlogin'][$_GPC['login_type']]['appid'],
                $_W['setting']['thirdlogin'][$_GPC['login_type']]['appsecret']
            )->bind();
        }

        if (!empty($_W['user']) && $_GPC['handle_type'] === 'bind') {
            if (is_error($member)) {
                web_itoast($member['message'], web_url('user/profile/bind'), '');
            } else {
                web_itoast('绑定成功', web_url('user/profile/bind'), '');
            }
        }

        if (is_error($member)) {
            web_itoast($member['message'], web_url('user/login'), '');
        }
        $record = user_single($member);
        if (!empty($record)) {
            if ($record['status'] == USER_STATUS_CHECK || $record['status'] == USER_STATUS_BAN) {
                web_itoast('您的账号正在审核或是已经被系统禁止，请联系网站管理员解决?', web_url('user/login'), '');
            }
            $_W['uid'] = $record['uid'];
            $_W['isfounder'] = user_is_founder($record['uid']);
            $_W['user'] = $record;


            if (empty($_W['isfounder']) || user_is_vice_founder()) {
                if (!empty($record['endtime']) && $record['endtime'] < TIMESTAMP) {
                    web_itoast('您的账号有效期限已过,请联系网站管理员解决!', '', '');
                }
            }


            if (!empty($_W['siteclose']) && empty($_W['isfounder'])) {
                web_itoast('站点已关闭，关闭原因:' . $_W['setting']['copyright']['reason'], '', '');
            }
            $cookie = array();
            $cookie['uid'] = $record['uid'];
            $cookie['lastvisit'] = $record['lastvisit'];
            $cookie['lastip'] = $record['lastip'];
            $cookie['hash'] = md5($record['password'] . $record['salt']);
            $session = authcode(json_encode($cookie), 'encode');
            isetcookie('__session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 0, true);
            $status = array();
            $status['uid'] = $record['uid'];
            $status['lastvisit'] = TIMESTAMP;
            $status['lastip'] = CLIENT_IP;
            user_update($status);

            if (empty($forward)) {
                $forward = user_login_forward($_GPC['forward']);
            }
            $forward = safe_url_not_outside($forward);

            if ($record['uid'] != $_GPC['__uid']) {
                isetcookie('__uniacid', '', -7 * 86400);
                isetcookie('__uid', '', -7 * 86400);
            }
            $failed = pdo_get('users_failed_login', array('username' => trim($_GPC['username']), 'ip' => CLIENT_IP));
            pdo_delete('users_failed_login', array('id' => $failed['id']));

            //更改登录跳转，如果已经绑定一道包应用，直接跳转至一道包商户后台
            $sql = 'SELECT * FROM ' . Modules::TABLE_NAME . ' where `name`=:name LIMIT 1';
            $ydbapp = pdo_fetch($sql, array(':name' => 'ewei_shopv2'));
            if (isset($ydbapp['mid'])) {
                $forward = './index.php?c=home&a=welcome&do=ext&m=ewei_shopv2';
            }
            web_itoast("欢迎回来，{$record['username']}", $forward, 'success');
        } else {
            if (empty($failed)) {
                pdo_insert('users_failed_login', array(
                    'ip' => CLIENT_IP,
                    'username' => trim($_GPC['username']),
                    'count' => '1',
                    'lastupdate' => TIMESTAMP
                ));
            } else {
                pdo_update(
                    'users_failed_login',
                    array('count' => $failed['count'] + 1, 'lastupdate' => TIMESTAMP),
                    array('id' => $failed['id'])
                );
            }
            web_itoast('登录失败，请检查您输入的账号和密码', '', '');
        }
    }
}

defined('IN_IA') or exit('Access Denied');
define('IN_GW', true);

load()->model('user');
load()->model('message');
load()->classs('oauth2/oauth2client');
load()->model('setting');

if (checksubmit() || $_W['isajax']) {
    _login($_GPC['referer']);
}

$support_login_types = OAuth2Client::supportThirdLoginType();
if (in_array($_GPC['login_type'], $support_login_types)) {
    _login($_GPC['referer']);
}

$setting = $_W['setting'];
$_GPC['login_type'] = !empty($_GPC['login_type'])
    ? $_GPC['login_type']
    : (!empty($_W['setting']['copyright']['login_type']) ? 'mobile' : 'system');
$login_urls = user_support_urls();
web_template('user/login');

