<?php
declare(strict_types=1);

namespace Ydb\Repository;


use Ydb\Entity\Manual\MemberAddress;

class MemberAddressRepository
{
    public function getAddressCount($uniacid, $openid)
    {
        $params = array(':uniacid' => $uniacid, ':openid' => $openid);

        $sql = 'SELECT COUNT(*) FROM ' . MemberAddress::TABLE_NAME
            . ' WHERE openid = :openid AND deleted = 0 AND  `uniacid` = :uniacid';
        return pdo_fetchcolumn($sql, $params);
    }

    public function getAddressList($uniacid, $openid, $page, $pageSize)
    {
        $page = max(1, $page);
        $start = ($page - 1) * $pageSize;

        $params = array(':uniacid' => $uniacid, ':openid' => $openid);

        $sql = 'SELECT * FROM ' . MemberAddress::TABLE_NAME
            . " WHERE openid = :openid AND deleted = 0 AND `uniacid` = :uniacid
             ORDER BY `isdefault` DESC LIMIT ${start}, ${pageSize}";
        return pdo_fetchall($sql, $params);
    }

    public function getAddressDetail($uniacid, $openid, $id): array
    {
        $address = pdo_fetch('select *  from ' . MemberAddress::TABLE_NAME
            . ' where id=:id and openid=:openid and uniacid=:uniacid limit 1 ',
            [':id' => $id, ':uniacid' => $uniacid, ':openid' => $openid]);
        return $address;
    }

    /**
     * @param $data array 数据
     * @param $criteria array 条件
     */
    public function updateAddress($data, $criteria): void
    {
        pdo_update('ewei_shop_member_address', $data, $criteria);
    }

    public function addAddress($data)
    {
        pdo_insert('ewei_shop_member_address', $data);
        return (int)pdo_insertid();
    }

}