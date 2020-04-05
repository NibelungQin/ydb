<?php
declare(strict_types=1);

namespace Ydb\Repository;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Ydb\Entity\Manual\Order;
use Ydb\Entity\Manual\OrderBuySend;
use Ydb\Entity\Manual\OrderComment;
use Ydb\Entity\Manual\OrderGoods;
use Ydb\Entity\Manual\OrderPeerpay;
use Ydb\Entity\Manual\OrderPeerpayPayinfo;
use Ydb\Entity\Manual\OrderPrint;
use Ydb\Entity\Manual\OrderRefund;
use Ydb\Entity\Manual\OrderSingleRefund;

class OrderRepository
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManager = $entityManger;
        $this->repository = $entityManger->getRepository(Order::class);
    }

    /**
     * @param Order $order
     */
    public function save(Order $order): void
    {
        $this->entityManager->persist($order);
    }

    /**
     * @param int $orderid
     * @return Order|null
     */
    public function findOne(int $orderid): ?Order
    {
        /**
         * @var Order $result
         */
        $result = $this->repository->find($orderid);
        return $result;
    }

    /**
     * @return Order[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param Order $order
     */
    public function delete(Order $order): void
    {
        $this->entityManager->remove($order);
    }

    /**
     * @param OrderBuySend $orderBuySend
     */
    public function saveOrderBuySend(OrderBuySend $orderBuySend): void
    {
        $this->entityManager->persist($orderBuySend);
    }

    /**
     * @return OrderBuySend[]
     */
    public function findAllOrderBuySend(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("obs")
            ->from('Ydb\Entity\Manual\OrderBuySend', 'obs')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderBuySendId
     * @return OrderBuySend|null
     */
    public function findOneOrderBuySend(int $orderBuySendId): ?OrderBuySend
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("obs")
                ->from('Ydb\Entity\Manual\OrderBuySend', 'obs')
                ->where("obs.id = :obsid")
                ->setParameter("obsid", $orderBuySendId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderBuySend $orderBuySend
     */
    public function deleteOrderBuySend(OrderBuySend $orderBuySend): void
    {
        $this->entityManager->remove($orderBuySend);
    }

    /**
     * @param OrderComment $orderComment
     */
    public function saveOrderComment(OrderComment $orderComment): void
    {
        $this->entityManager->persist($orderComment);
    }

    /**
     * @return OrderComment[]
     */
    public function findAllOrderComment(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("oc")
            ->from('Ydb\Entity\Manual\OrderComment', 'oc')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderCommentId
     * @return OrderComment|null
     */
    public function findOneOrderComment(int $orderCommentId): ?OrderComment
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("oc")
                ->from('Ydb\Entity\Manual\OrderComment', 'oc')
                ->where("oc.id = :ocid")
                ->setParameter("ocid", $orderCommentId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderComment $orderComment
     */
    public function deleteOrderComment(OrderComment $orderComment): void
    {
        $this->entityManager->remove($orderComment);
    }

    /**
     * @param OrderGoods $orderGoods
     */
    public function saveOrderGoods(OrderGoods $orderGoods): void
    {
        $this->entityManager->persist($orderGoods);
    }

    /**
     * @return OrderGoods[]
     */
    public function findAllOrderGoods(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("og")
            ->from('Ydb\Entity\Manual\OrderGoods', 'og')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderGoodsId
     * @return OrderGoods|null
     */
    public function findOneOrderGoods(int $orderGoodsId): ?OrderGoods
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("og")
                ->from('Ydb\Entity\Manual\OrderGoods', 'og')
                ->where("og.id = :ogid")
                ->setParameter("ogid", $orderGoodsId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderGoods $orderGoods
     */
    public function deleteOrderGoods(OrderGoods $orderGoods): void
    {
        $this->entityManager->remove($orderGoods);
    }

    /**
     * @param OrderPeerpay $orderPeerpay
     */
    public function saveOrderPeerPay(OrderPeerpay $orderPeerpay): void
    {
        $this->entityManager->persist($orderPeerpay);
    }

    /**
     * @return OrderPeerpay[]
     */
    public function findAllOrderPeerpay(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("opp")
            ->from('Ydb\Entity\Manual\OrderPeerpay', 'opp')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderPeerpayId
     * @return OrderPeerpay|null
     */
    public function findOneOrderPeerpay(int $orderPeerpayId): ?OrderPeerpay
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("opp")
                ->from('Ydb\Entity\Manual\OrderPeerpay', 'opp')
                ->where("opp.id = :oppid")
                ->setParameter("oppid", $orderPeerpayId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderPeerpay $orderPeerpay
     */
    public function deleteOrderPeerPay(OrderPeerpay $orderPeerpay): void
    {
        $this->entityManager->remove($orderPeerpay);
    }

    /**
     * @param OrderSingleRefund $orderSingleRefund
     */
    public function saveOrderSingleRefund(OrderSingleRefund $orderSingleRefund): void
    {
        $this->entityManager->persist($orderSingleRefund);
    }

    /**
     * @return OrderSingleRefund[]
     */
    public function findAllOrderSingleRefund(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("osr")
            ->from('Ydb\Entity\Manual\OrderSingleRefund', 'osr')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderSingleRefundId
     * @return OrderSingleRefund|null
     */
    public function findOneOrderSingleRefund(int $orderSingleRefundId): ?OrderSingleRefund
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("osr")
                ->from('Ydb\Entity\Manual\OrderSingleRefund', 'osr')
                ->where("osr.id = :osrid")
                ->setParameter("osrid", $orderSingleRefundId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderSingleRefund $orderSingleRefund
     */
    public function deleteOrderSingleRefund(OrderSingleRefund $orderSingleRefund): void
    {
        $this->entityManager->remove($orderSingleRefund);
    }

    /**
     * @param OrderPeerpayPayinfo $orderPeerpayPayinfo
     */
    public function saveOrderPeerpayPayinfo(OrderPeerpayPayinfo $orderPeerpayPayinfo): void
    {
        $this->entityManager->persist($orderPeerpayPayinfo);
    }

    /**
     * @return OrderPeerpayPayinfo[]
     */
    public function findAllOrderPeerpayPayinfo(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("opp")
            ->from('Ydb\Entity\Manual\OrderPeerpayPayinfo', 'opp')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderPeerpayPayinfoId
     * @return OrderPeerpayPayinfo|null
     */
    public function findOneOrderPeerpayPayinfo(int $orderPeerpayPayinfoId): ?OrderPeerpayPayinfo
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("opp")
                ->from('Ydb\Entity\Manual\OrderPeerpayPayinfo', 'opp')
                ->where("opp.id = :oppid")
                ->setParameter("oppid", $orderPeerpayPayinfoId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderPeerpayPayinfo $orderPeerpayPayinfo
     */
    public function deleteOrderPeerpayPayinfo(OrderPeerpayPayinfo $orderPeerpayPayinfo): void
    {
        $this->entityManager->remove($orderPeerpayPayinfo);
    }

    /**
     * @param OrderPrint $orderPrint
     */
    public function saveOrderPrint(OrderPrint $orderPrint): void
    {
        $this->entityManager->persist($orderPrint);
    }

    /**
     * @return OrderPrint[]
     */
    public function findAllOrderPrint(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("op")
            ->from('Ydb\Entity\Manual\OrderPrint', 'op')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderPrintId
     * @return OrderPrint|null
     */
    public function findOneOrderPrint(int $orderPrintId): ?OrderPrint
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("op")
                ->from('Ydb\Entity\Manual\OrderPrint', 'op')
                ->where("op.id = :opid")
                ->setParameter("opid", $orderPrintId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderPrint $orderPrint
     */
    public function deleteOrderPrint(OrderPrint $orderPrint): void
    {
        $this->entityManager->remove($orderPrint);
    }

    /**
     * @param OrderRefund $orderRefund
     */
    public function saveOrderRefund(OrderRefund $orderRefund): void
    {
        $this->entityManager->persist($orderRefund);
    }

    /**
     * @return OrderRefund[]
     */
    public function findAllOrderRefund(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("or_")
            ->from('Ydb\Entity\Manual\OrderRefund', 'or_')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $orderRefundId
     * @return OrderRefund|null
     */
    public function findOneOrderRefund(int $orderRefundId): ?OrderRefund
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("or_")
                ->from('Ydb\Entity\Manual\OrderRefund', 'or_')
                ->where("or_.id = :orid")
                ->setParameter("orid", $orderRefundId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param OrderRefund $orderRefund
     */
    public function deleteOrderRefund(OrderRefund $orderRefund): void
    {
        $this->entityManager->remove($orderRefund);
    }

    public static function generateStatusConditionSQL(String $status): String
    {
        if ($status === '-1') {
            $condition = ' AND o.status=-1 and (o.refundtime=0 or o.refundstate=3)';
        } elseif ($status === '4') {
            $condition = ' AND (o.refundstate>0 and o.refundid<>0 or (o.refundtime=0 and o.refundstate=3))';
        } elseif ($status === '5') {
            $condition = ' AND o.refundtime<>0';
        } elseif ($status === '1') {
            $condition = ' AND ( o.status = 1 or (o.status=0 and o.paytype=3) )';
        } elseif ($status === '0') {
            $condition = ' AND o.status = 0 and o.paytype<>3';
        } elseif ($status === '2') {
            $condition = ' AND ( o.status = 2 or (o.status=1 and o.sendtype>0) )';
        } else {
            $condition = ' AND o.status = ' . (int)$status;
        }
        return $condition;
    }
}