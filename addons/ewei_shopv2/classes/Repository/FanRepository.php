<?php
declare(strict_types=1);

namespace Ydb\Repository;

/**
 * Class FanRepository
 * @package Ydb\Repository
 *
 * 粉丝
 */
class FanRepository
{

    public function getFanByOpenId($openid)
    {
        return ['unfollowtime' => 0];
    }
}