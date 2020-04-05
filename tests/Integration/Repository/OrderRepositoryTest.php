<?php
declare(strict_types=1);

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Ydb\Data\Fixtures\OrderBuySendFixture;
use Ydb\Data\Fixtures\OrderCommentFixture;
use Ydb\Data\Fixtures\OrderFixture;
use Ydb\Data\Fixtures\OrderGoodsFixture;
use Ydb\Data\Fixtures\OrderPeerpayFixture;
use Ydb\Data\Fixtures\OrderPeerpayPayinfoFixture;
use Ydb\Data\Fixtures\OrderPrintFixture;
use Ydb\Data\Fixtures\OrderRefundFixture;
use Ydb\Data\Fixtures\OrderSingleRefundFixture;
use Ydb\Entity\Manual\Order;
use Ydb\Entity\Manual\OrderBuySend;
use Ydb\Entity\Manual\OrderComment;
use Ydb\Entity\Manual\OrderGoods;
use Ydb\Entity\Manual\OrderPeerpay;
use Ydb\Entity\Manual\OrderPeerpayPayinfo;
use Ydb\Entity\Manual\OrderPrint;
use Ydb\Entity\Manual\OrderRefund;
use Ydb\Entity\Manual\OrderSingleRefund;
use Ydb\Repository\OrderRepository;

class OrderRepositoryTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private static $entityManager;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var ORMPurger
     */
    private $purger;

    /**
     * @var ORMExecutor
     */
    private $executor;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        ini_set('memory_limit', '2G');
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(
            array(dirname(__DIR__, 3) . '/addons/ewei_shopv2/classes/Entity'),
            true);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'root',
            'host' => 'mysql',
            'dbname' => 'ydb_test',
            'charset' => 'utf8',
        );

        // obtaining the entity manager
        self::$entityManager = EntityManager::create($conn, $doctrineConfig);
        $meta = self::$entityManager->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool(self::$entityManager);
        $tool->dropSchema($meta);
        $tool->createSchema($meta);
    }

    protected function setUp(): void
    {
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(array(dirname(__DIR__, 3) . '/addons/ewei_shopv2/classes/Entity'),
            true);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'root',
            'host' => 'mysql',
            'dbname' => 'ydb_test',
            'charset' => 'utf8',
        );

        // obtaining the entity manager
        $entityManager = EntityManager::create($conn, $doctrineConfig);

        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(dirname(__DIR__, 3) . '/config/'));
        $loader->load('services.yml');
        $this->container->compile();
        $this->container->set(EntityManagerInterface::class, $entityManager);
        $this->container->set(ObjectManager::class, $entityManager);

        $this->purger = new ORMPurger($entityManager);
        $this->executor = new ORMExecutor($entityManager, $this->purger);
        $this->loader = new Loader();
        $this->orderRepository = $this->container->get(OrderRepository::class);
        $this->objectManager = $this->container->get(ObjectManager::class);
    }

    public static function tearDownAfterClass(): void
    {
        $meta = self::$entityManager->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool(self::$entityManager);
        $tool->dropSchema($meta);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->container->get(EntityManagerInterface::class)->clear();
        $this->container->set(EntityManagerInterface::class, null); // avoid memory leaks
    }

    public function testSaveOrder(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $order = new Order();
        $this->orderRepository->save($order);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $order->getId());
    }

    public function testFindAllOrder(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new OrderFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAll();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrder(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderFixture());
        $this->executor->execute($this->loader->getFixtures());


        $result = $this->orderRepository->findOne(1);

        $this->assertEquals(1, $result->getId());
    }

    public function testDeleteOrder(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goods = $this->orderRepository->findOne(1);
        $this->orderRepository->delete($goods);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOne(1);

        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderBuySend(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderBuySend = new OrderBuySend();
        $this->orderRepository->saveOrderBuySend($orderBuySend);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderBuySend->getId());
    }

    public function testFindAllOrderBuySend(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new OrderBuySendFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderBuySend();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderBuySend(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderBuySendFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderBuySend(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderBuySend(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderBuySend(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderBuySendFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderBuySend = $this->orderRepository->findOneOrderBuySend(1);
        $this->orderRepository->deleteOrderBuySend($orderBuySend);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderBuySend(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderComment = new OrderComment();
        $this->orderRepository->saveOrderComment($orderComment);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderComment->getId());
    }

    public function testFindAllOrderComment(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderComment();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderComment();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderComment(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderComment(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderComment = $this->orderRepository->findOneOrderComment(1);
        $this->orderRepository->deleteOrderComment($orderComment);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderComment(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderGoods = new OrderGoods();
        $orderGoods->setExpresscom("test");
        $orderGoods->setExpresssn("test");
        $orderGoods->setExpress("test");
        $orderGoods->setSendtime(time());
        $orderGoods->setFinishtime(time());
        $orderGoods->setRemarksend("test");
        $orderGoods->setStoreid("test");
        $orderGoods->setOptime("test");
        $orderGoods->setOrdercode("test");
        $this->orderRepository->saveOrderGoods($orderGoods);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderGoods->getId());
    }

    public function testFindAllOrderGoods(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderGoods();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderGoodsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderGoods();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderGoodsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderGoods(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderGoods(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderGoodsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderGoods = $this->orderRepository->findOneOrderGoods(1);
        $this->orderRepository->deleteOrderGoods($orderGoods);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderGoods(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderPeerpay(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderPeerpay = new OrderPeerpay();
        $this->orderRepository->saveOrderPeerpay($orderPeerpay);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderPeerpay->getId());
    }

    public function testFindAllOrderPeerpay(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderPeerpay();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderPeerpayFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderPeerpay();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderPeerpay(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPeerpayFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderPeerpay(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderPeerpay(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderPeerpay(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPeerpayFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderPeerpay = $this->orderRepository->findOneOrderPeerpay(1);
        $this->orderRepository->deleteOrderPeerpay($orderPeerpay);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderPeerpay(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderSingleRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderSingleRefund = new OrderSingleRefund();
        $this->orderRepository->saveOrderSingleRefund($orderSingleRefund);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderSingleRefund->getId());
    }

    public function testFindAllOrderSingleRefund(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderSingleRefund();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderSingleRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderSingleRefund();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderSingleRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderSingleRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderSingleRefund(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderSingleRefund(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderSingleRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderSingleRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderSingleRefund = $this->orderRepository->findOneOrderSingleRefund(1);
        $this->orderRepository->deleteOrderSingleRefund($orderSingleRefund);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderSingleRefund(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderPeerpayPayinfo(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderPeerpayPayinfo = new OrderPeerpayPayinfo();
        $this->orderRepository->saveOrderPeerpayPayinfo($orderPeerpayPayinfo);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderPeerpayPayinfo->getId());
    }

    public function testFindAllOrderPeerpayPayinfo(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderPeerpayPayinfo();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderPeerpayPayinfoFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderPeerpayPayinfo();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderPeerpayPayinfo(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPeerpayPayinfoFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderPeerpayPayinfo(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderPeerpayPayinfo(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderPeerpayPayinfo(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPeerpayPayinfoFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderPeerpayPayinfo = $this->orderRepository->findOneOrderPeerpayPayinfo(1);
        $this->orderRepository->deleteOrderPeerpayPayinfo($orderPeerpayPayinfo);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderPeerpayPayinfo(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderPrint(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderPrint = new OrderPrint();
        $this->orderRepository->saveOrderPrint($orderPrint);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderPrint->getId());
    }

    public function testFindAllOrderPrint(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderPrint();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderPrintFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderPrint();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderPrint(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPrintFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderPrint(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderPrint(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderPrint(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderPrintFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderPrint = $this->orderRepository->findOneOrderPrint(1);
        $this->orderRepository->deleteOrderPrint($orderPrint);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderPrint(1);
        $this->assertEquals(null, $goods);
    }

    public function testSaveOrderRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $orderRefund = new OrderRefund();
        $this->orderRepository->saveOrderRefund($orderRefund);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $orderRefund->getId());
    }

    public function testFindAllOrderRefund(): void
    {
        $this->purger->purge();

        $result = $this->orderRepository->findAllOrderRefund();
        $this->assertEquals(0, sizeof($result));

        $this->loader->addFixture(new OrderRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findAllOrderRefund();
        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneOrderRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->orderRepository->findOneOrderRefund(1);
        $this->assertEquals(1, $result->getId());

        $result = $this->orderRepository->findOneOrderRefund(10000);
        $this->assertNull($result);
    }

    public function testDeleteOrderRefund(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new OrderRefundFixture());
        $this->executor->execute($this->loader->getFixtures());

        $orderRefund = $this->orderRepository->findOneOrderRefund(1);
        $this->orderRepository->deleteOrderRefund($orderRefund);
        $this->objectManager->flush();

        $goods = $this->orderRepository->findOneOrderRefund(1);
        $this->assertEquals(null, $goods);
    }
}