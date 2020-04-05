<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2019/5/13
 * Time: 10:53
 */

declare(strict_types=1);

namespace Ydb\Repository;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Ydb\Entity\Manual\Goods;
use Ydb\Entity\Manual\GoodsCards;
use Ydb\Entity\Manual\GoodscodeGood;
use Ydb\Entity\Manual\GoodsComment;
use Ydb\Entity\Manual\GoodsGroup;
use Ydb\Entity\Manual\GoodsLabel;
use Ydb\Entity\Manual\GoodsLabelstyle;
use Ydb\Entity\Manual\GoodsOption;
use Ydb\Entity\Manual\GoodsParam;
use Ydb\Entity\Manual\GoodsSpec;
use Ydb\Entity\Manual\GoodsSpecItem;

class GoodsRepository
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
        $this->repository = $entityManger->getRepository(Goods::class);
    }

    /**
     * @param Goods $goods
     */
    public function save(Goods $goods): void
    {
        $this->entityManager->persist($goods);
    }

    /**
     * @param int $goodsid
     * @return Goods|null
     */
    public function findOne(int $goodsid): ?Goods
    {
        /**
         * @var Goods $result
         */
        $result = $this->repository->find($goodsid);
        return $result;
    }

    /**
     * @return Goods[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param Goods $goods
     */
    public function delete(Goods $goods): void
    {
        $this->entityManager->remove($goods);
    }

    /**
     * @param GoodsCards $goodsCards
     */
    public function saveGoodsCards(GoodsCards $goodsCards): void
    {
        $this->entityManager->persist($goodsCards);
    }

    /**
     * @param int $goodsCardsId
     * @return GoodsCards|null
     */
    public function findOneGoodsCards(int $goodsCardsId): ?GoodsCards
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gc")
                ->from('Ydb\Entity\Manual\GoodsCards', 'gc')
                ->where("gc.id = :gcid")
                ->setParameter("gcid", $goodsCardsId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return GoodsCards[]
     */
    public function findAllGoodsCards(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gc")
            ->from('Ydb\Entity\Manual\GoodsCards', 'gc')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param GoodsCards $goodsCards
     */
    public function deleteGoodsCards(GoodsCards $goodsCards): void
    {
        $this->entityManager->remove($goodsCards);
    }

    /**
     * @param GoodscodeGood $goodscodeGood
     */
    public function saveGoodscodeGood(GoodscodeGood $goodscodeGood): void
    {
        $this->entityManager->persist($goodscodeGood);
    }

    /**
     * @param int $goodscodeGoodId
     * @return GoodscodeGood|null
     */
    public function findOneGoodscodeGood(int $goodscodeGoodId): ?GoodscodeGood
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gcg")
                ->from('Ydb\Entity\Manual\GoodscodeGood', 'gcg')
                ->where("gcg.id = :gcgid")
                ->setParameter("gcgid", $goodscodeGoodId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return GoodscodeGood[]
     */
    public function findAllGoodscodeGood(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gcg")
            ->from('Ydb\Entity\Manual\GoodscodeGood', 'gcg')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param GoodscodeGood $goodscodeGood
     */
    public function deleteGoodscodeGood(GoodscodeGood $goodscodeGood): void
    {
        $this->entityManager->remove($goodscodeGood);
    }

    /**
     * @param GoodsComment $goodsComment
     */
    public function saveGoodsComment(GoodsComment $goodsComment): void
    {
        $this->entityManager->persist($goodsComment);
    }

    /**
     * @param int $goodsCommentId
     * @return GoodsComment|null
     */
    public function findOneGoodsComment(int $goodsCommentId): ?GoodsComment
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gc")
                ->from('Ydb\Entity\Manual\GoodsComment', 'gc')
                ->where("gc.id = :gcid")
                ->setParameter("gcid", $goodsCommentId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return GoodsComment[]
     */
    public function findAllGoodsComment(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gc")
            ->from('Ydb\Entity\Manual\GoodsComment', 'gc')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param GoodsComment $goodsComment
     */
    public function deleteGoodsComment(GoodsComment $goodsComment): void
    {
        $this->entityManager->remove($goodsComment);
    }

    /**
     * @param GoodsGroup $goodsGroup
     */
    public function saveGoodsGroup(GoodsGroup $goodsGroup): void
    {
        $this->entityManager->persist($goodsGroup);
    }

    /**
     * @param int $goodsGroupId
     * @return GoodsGroup|null
     */
    public function findOneGoodsGroup(int $goodsGroupId): ?GoodsGroup
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gg")
                ->from('Ydb\Entity\Manual\GoodsGroup', 'gg')
                ->where("gg.id = :ggid")
                ->setParameter("ggid", $goodsGroupId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return GoodsGroup[]
     */
    public function findAllGoodsGroup(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gg")
            ->from('Ydb\Entity\Manual\GoodsGroup', 'gg')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param GoodsGroup $goodsGroup
     */
    public function deleteGoodsGroup(GoodsGroup $goodsGroup): void
    {
        $this->entityManager->remove($goodsGroup);
    }

    /**
     * @param GoodsLabel $goodsLabel
     */
    public function saveGoodsLabel(GoodsLabel $goodsLabel): void
    {
        $this->entityManager->persist($goodsLabel);
    }

    /**
     * @param int $goodsLabelId
     * @return GoodsLabel|null
     */
    public function findOneGoodsLabel(int $goodsLabelId): ?GoodsLabel
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gl")
                ->from('Ydb\Entity\Manual\GoodsLabel', 'gl')
                ->where("gl.id = :glid")
                ->setParameter("glid", $goodsLabelId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return GoodsLabel[]
     */
    public function findAllGoodsLabel(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gl")
            ->from('Ydb\Entity\Manual\GoodsLabel', 'gl')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param GoodsLabel $goodsLabel
     */
    public function deleteGoodsLabel(GoodsLabel $goodsLabel): void
    {
        $this->entityManager->remove($goodsLabel);
    }

    /**
     * @param GoodsLabelstyle $goodsLabelStyle
     */
    public function saveGoodsLabelStyle(GoodsLabelStyle $goodsLabelStyle): void
    {
        $this->entityManager->persist($goodsLabelStyle);
    }

    /**
     * @return GoodsLabelstyle[]
     */
    public function findAllGoodsLabelStyle(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gls")
            ->from("Ydb\Entity\Manual\GoodsLabelStyle", 'gls')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $goodsLabelStyleId
     * @return GoodsLabelstyle|null
     */
    public function findOneGoodsLabelStyle(int $goodsLabelStyleId): ?GoodsLabelstyle
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gls")
                ->from('Ydb\Entity\Manual\GoodsLabelStyle', 'gls')
                ->where("gls.id = :glsid")
                ->setParameter("glsid", $goodsLabelStyleId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param GoodsLabelstyle $goodsLabelStyle
     */
    public function deleteGoodsLabelStyle(GoodsLabelstyle $goodsLabelStyle): void
    {
        $this->entityManager->remove($goodsLabelStyle);
    }

    /**
     * @param GoodsOption $goodsOption
     */
    public function saveGoodsOption(GoodsOption $goodsOption): void
    {
        $this->entityManager->persist($goodsOption);
    }

    /**
     * @return GoodsOption[]
     */
    public function findAllGoodsOption(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("go")
            ->from("Ydb\Entity\Manual\GoodsOption", 'go')
            ->getQuery()
            ->getArrayResult();
    }

    public function findOneGoodsOption(int $goodsOptionId): ?GoodsOption
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("go")
                ->from('Ydb\Entity\Manual\GoodsOption', 'go')
                ->where("go.id = :goid")
                ->setParameter("goid", $goodsOptionId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param GoodsOption $goodsOption
     */
    public function deleteGoodsOption(GoodsOption $goodsOption): void
    {
        $this->entityManager->remove($goodsOption);
    }

    /**
     * @param GoodsParam $goodsParam
     */
    public function saveGoodsParam(GoodsParam $goodsParam): void
    {
        $this->entityManager->persist($goodsParam);
    }

    /**
     * @return GoodsParam[]
     */
    public function findAllGoodsParam(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gp")
            ->from("Ydb\Entity\Manual\GoodsParam", 'gp')
            ->getQuery()
            ->getArrayResult();
    }

    public function findOneGoodsParam(int $goodsParamId): ?GoodsParam
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gp")
                ->from("Ydb\Entity\Manual\GoodsParam", "gp")
                ->where("gp.id = :gpid")
                ->setParameter("gpid", $goodsParamId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param GoodsParam $goodsParam
     */
    public function deleteGoodsParam(GoodsParam $goodsParam): void
    {
        $this->entityManager->remove($goodsParam);
    }

    /**
     * @param GoodsSpec $goodsSpec
     */
    public function saveGoodsSpec(GoodsSpec $goodsSpec): void
    {
        $this->entityManager->persist($goodsSpec);
    }

    /**
     * @return GoodsSpec[]
     */
    public function findAllGoodsSpec(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gs")
            ->from("Ydb\Entity\Manual\GoodsSpec", 'gs')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $goodsSpecId
     * @return GoodsSpec
     */
    public function findOneGoodsSpec(int $goodsSpecId): ?GoodsSpec
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gs")
                ->from("Ydb\Entity\Manual\GoodsSpec", "gs")
                ->where("gs.id = :gsid")
                ->setParameter("gsid", $goodsSpecId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param GoodsSpec|null $goodsParam
     */
    public function deleteGoodsSpec(?GoodsSpec $goodsParam): void
    {
        $this->entityManager->remove($goodsParam);
    }

    /**
     * @param GoodsSpecItem $goodsSpecItem
     */
    public function saveGoodsSpecItem(GoodsSpecItem $goodsSpecItem): void
    {
        $this->entityManager->persist($goodsSpecItem);
    }

    /**
     * @return GoodsSpecItem[]
     */
    public function findAllGoodsSpecItem(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select("gsi")
            ->from("Ydb\Entity\Manual\GoodsSpecItem", 'gsi')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $goodsSpecItemId
     * @return GoodsSpecItem|null
     */
    public function findOneGoodsSpecItem(int $goodsSpecItemId): ?GoodsSpecItem
    {
        try {
            return $this->entityManager->createQueryBuilder()
                ->select("gsi")
                ->from("Ydb\Entity\Manual\GoodsSpecItem", "gsi")
                ->where("gsi.id = :gsiid")
                ->setParameter("gsiid", $goodsSpecItemId)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function deleteGoodsSpecItem(?GoodsSpecItem $goodsSpecItem): void
    {
        $this->entityManager->remove($goodsSpecItem);
    }

}