<?php
declare(strict_types=1);

namespace Ydb\Service;


use Ydb\Repository\MemberAddressRepository;

class MemberAddressService
{
    /**
     * @var MemberAddressRepository
     */
    private $repository;

    public function __construct(MemberAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addAddress($data): int
    {
        return $this->repository->addAddress($data);
    }

    public function getAddressCount($uniacid, $openid)
    {
        return $this->repository->getAddressCount($uniacid, $openid);
    }

    public function getAddressList($uniacid, $openid, $page = 1, $pageSize = 20): array
    {
        return [
            'page' => $page,
            'pagesize' => $pageSize,
            'total' => $this->getAddressCount($uniacid, $openid),
            'list' => $this->repository->getAddressList($uniacid, $openid, $page, $pageSize)
        ];
    }

    public function getAddressDetail($uniacid, $openid, $id): array
    {
        return $this->repository->getAddressDetail($uniacid, $openid, $id);
    }

    public function updateAddress($data, $criteria): void
    {
        $this->repository->updateAddress($data, $criteria);
    }

    public function setDefaultAddress($uniacid, $openid, $id): void
    {
        $this->updateAddress(['isdefault' => 0], ['uniacid' => $uniacid, 'openid' => $openid]);
        $this->updateAddress(['isdefault' => 1], ['id' => $id, 'uniacid' => $uniacid, 'openid' => $openid]);
    }

    public function deleteAddress(int $id): void
    {
        $this->updateAddress(['deleted' => 1], ['id' => $id]);
    }
}