<?php
declare(strict_types=1);

namespace Ydb\Repository;

use Psr\Log\LoggerInterface;
use RuntimeException;
use Ydb\Entity\Manual\Sysset;

class ShopSetRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSetData(int $uniacid): array
    {
        if ($uniacid <= 0) {
            throw new RuntimeException("uniacid不合法: uniacid=$uniacid");
        }

        $set = m('cache')->getArray('sysset', $uniacid);
        if (empty($set)) {
            $set = pdo_fetch('select * from ' . Sysset::TABLE_NAME . ' where uniacid=:uniacid limit 1',
                [':uniacid' => $uniacid]);
            if (empty($set)) {
                $set = array();
            }
            m('cache')->set('sysset', $set, $uniacid);
        }
        return $set;
    }

    /**
     * 获取插件的配置
     * @param string $pluginName 插件名称
     * @param int $uniacid 公众号唯一id
     * @return array|mixed 插件的配置，插件名为空字符串时返回所有插件配置
     */
    public function getPluginSet(string $pluginName, int $uniacid)
    {

        $set = pdo_fetch('select * from ' . Sysset::TABLE_NAME . " where uniacid = $uniacid");

        $pluginSet = iunserializer($set['plugins']);
        if (empty($pluginName)) {
            return $pluginSet;
        }
        return $pluginSet[$pluginName] ?? [];
    }

    public function setPluginSet(string $pluginName, array $pluginSet, int $uniacid)
    {
        $set = [];
        $set['plugins'] = [];
        $set['plugins'][$pluginName] = $pluginSet;

        $oldSet = pdo_fetch('select * from ' . Sysset::TABLE_NAME . " where uniacid = $uniacid");
        if (empty($oldSet)) {
            pdo_insert('ewei_shop_sysset', ['plugins' => iserializer($set['plugins']), 'uniacid' => $uniacid]);
        } else {
            pdo_update('ewei_shop_sysset', ['plugins' => iserializer($set['plugins'])], ['id' => $oldSet['id']]);
        }
    }

    public function getSets(string $key, int $uniacid)
    {
        $set = pdo_fetch('select * from ' . Sysset::TABLE_NAME . " where uniacid = $uniacid");

        $sets = iunserializer($set['sets']);
        if (empty($key)) {
            return $sets;
        }
        return $sets[$key] ?? [];
    }

    public function setSets(string $key, array $sets, int $uniacid)
    {
        $set = [];
        $set['sets'] = [];
        $set['sets'][$key] = $sets;

        $oldSet = pdo_fetch('select * from ' . Sysset::TABLE_NAME . " where uniacid = $uniacid");
        if (empty($oldSet)) {
            pdo_insert('ewei_shop_sysset', ['sets' => iserializer($set['plugins']), 'uniacid' => $uniacid]);
        } else {
            pdo_update('ewei_shop_sysset', ['sets' => iserializer($set['plugins'])], ['id' => $oldSet['id']]);
        }
    }
}