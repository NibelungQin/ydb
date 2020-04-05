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
use Ydb\Data\Fixtures\GoodsCardsFixture;
use Ydb\Data\Fixtures\GoodscodeGoodFixture;
use Ydb\Data\Fixtures\GoodsCommentFixture;
use Ydb\Data\Fixtures\GoodsFixture;
use Ydb\Data\Fixtures\GoodsGroupFixture;
use Ydb\Data\Fixtures\GoodsLabelFixture;
use Ydb\Data\Fixtures\GoodsLabelStyleFixture;
use Ydb\Data\Fixtures\GoodsOptionFixture;
use Ydb\Data\Fixtures\GoodsParamFixture;
use Ydb\Data\Fixtures\GoodsSpecFixture;
use Ydb\Data\Fixtures\GoodsSpecItemFixture;
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
use Ydb\Repository\GoodsRepository;

class GoodsRepositoryTest extends TestCase
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
     * @var GoodsRepository
     */
    private $goodsRepository;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
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
        self::$entityManager = EntityManager::create($conn, $doctrineConfig);
        $meta = self::$entityManager->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool(self::$entityManager);
        $tool->dropSchema($meta);
        $tool->createSchema($meta);
    }

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(dirname(__DIR__, 3) . "/config/"));
        $loader->load('services.yml');
        $this->container->compile();
        $this->container->set(EntityManagerInterface::class, self::$entityManager);
        $this->container->set(ObjectManager::class, self::$entityManager);

        $this->purger = new ORMPurger(self::$entityManager);
        $this->executor = new ORMExecutor(self::$entityManager, $this->purger);
        $this->loader = new Loader();
        $this->goodsRepository = $this->container->get(GoodsRepository::class);
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

    public function testSaveGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goods = new Goods();
        $goods->setTitle("test");
        $goods->setPresellovertime(time());
        $goods->setEdareasCode("10000");
        $this->goodsRepository->save($goods);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $goods->getId());
    }

    public function testFindAllGoods(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAll();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new GoodsFixture());
        $this->executor->execute($this->loader->getFixtures());


        $result = $this->goodsRepository->findOne(1);

        $this->assertEquals(1, $result->getId());
        $this->assertEquals("test", $result->getTitle());
    }

    public function testDeleteGoods(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->loader->addFixture(new GoodsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goods = $this->goodsRepository->findOne(1);
        $this->goodsRepository->delete($goods);
        $this->objectManager->flush();

        $goods = $this->goodsRepository->findOne(1);

        $this->assertEquals(null, $goods);
    }

    public function testSaveGoodsCards(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsCards = new GoodsCards();
        $this->goodsRepository->saveGoodsCards($goodsCards);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $goodsCards->getId());
    }

    public function testFindAllGoodsCards(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCardsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsCards();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsCards(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCardsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsCards(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsCards", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsCards(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsCards(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCardsFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsCards = $this->goodsRepository->findOneGoodsCards(1);
        $this->goodsRepository->deleteGoodsCards($goodsCards);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsCards(1);

        $this->assertEquals(null, $result);
    }

    public function testSaveGoodscodeGood(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodscodeGood = new GoodscodeGood();
        $goodscodeGood->setUniacid(1);
        $goodscodeGood->setGoodsid(1);
        $goodscodeGood->setTitle("test");
        $goodscodeGood->setThumb("path/to/thumb");
        $goodscodeGood->setQrcode("qrcode");
        $goodscodeGood->setStatus(1);
        $goodscodeGood->setDisplayorder(1);
        $this->goodsRepository->saveGoodscodeGood($goodscodeGood);
        $this->objectManager->flush();
        $this->assertGreaterThan(0, $goodscodeGood->getId());
    }

    public function testFindAllGoodscodeGood(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodscodeGoodFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodscodeGood();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodscodeGood(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodscodeGoodFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodscodeGood(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodscodeGood", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodscodeGood(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodscodeGood(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodscodeGoodFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodscodeGood = $this->goodsRepository->findOneGoodscodeGood(1);
        $this->goodsRepository->deleteGoodscodeGood($goodscodeGood);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodscodeGood(1);

        $this->assertEquals(null, $result);
    }

    public function testSaveGoodsComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsComment = new GoodsComment();
        $this->goodsRepository->saveGoodsComment($goodsComment);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsComment->getId());
    }

    public function testFindAllGoodsComment(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsComment();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsComment(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsComment", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsComment(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsComment(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsCommentFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsComment = $this->goodsRepository->findOneGoodsComment(1);
        $this->goodsRepository->deleteGoodsComment($goodsComment);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsComment(1);

        $this->assertEquals(null, $result);
    }

    public function testSaveGoodsGroup(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsGroup = new GoodsGroup();
        $this->goodsRepository->saveGoodsGroup($goodsGroup);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsGroup->getId());
    }

    public function testFindAllGoodsGroup(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsGroupFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsGroup();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsGroup(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsGroupFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsGroup(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsGroup", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsGroup(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsGroup(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsGroupFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsGroup = $this->goodsRepository->findOneGoodsGroup(1);
        $this->goodsRepository->deleteGoodsGroup($goodsGroup);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsGroup(1);
        $this->assertNull($result);
    }

    public function testSaveGoodsLabel(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsLabel = new GoodsLabel();
        $goodsLabel->setLabelname("test");
        $this->goodsRepository->saveGoodsLabel($goodsLabel);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsLabel->getId());
    }

    public function testFindAllGoodsLabel(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsLabel();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsLabel(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsLabel(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsLabel", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsLabel(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsLabel(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsLabel = $this->goodsRepository->findOneGoodsLabel(1);
        $this->goodsRepository->deleteGoodsLabel($goodsLabel);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsLabel(1);
        $this->assertNull($result);
    }

    public function testSaveGoodsLabelStyle(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsLabelStyle = new GoodsLabelStyle();
        $goodsLabelStyle->setUniacid(1);
        $goodsLabelStyle->setStyle(1);
        $this->goodsRepository->saveGoodsLabelStyle($goodsLabelStyle);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsLabelStyle->getId());
    }

    public function testFindAllGoodsLabelStyle(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelStyleFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsLabelStyle();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsLabelStyle(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelStyleFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsLabelStyle(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsLabelStyle", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsLabelStyle(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsLabelStyle(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsLabelStyleFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsLabelStyle = $this->goodsRepository->findOneGoodsLabelStyle(1);
        $this->goodsRepository->deleteGoodsLabelStyle($goodsLabelStyle);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsLabelStyle(1);
        $this->assertNull($result);
    }

    public function testSaveGoodsOption(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsOption = new GoodsOption();
        $goodsOption->setDay(1);
        $goodsOption->setAllfullbackprice("1.23");
        $goodsOption->setFullbackprice("2.34");
        $goodsOption->setIsfullback(1);
        $goodsOption->setIslive(1);
        $this->goodsRepository->saveGoodsOption($goodsOption);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsOption->getId());
    }

    public function testFindAllGoodsOption(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsOptionFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsOption();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsOption(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsOptionFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsOption(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsOption", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsOption(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsOption(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsOptionFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsOption = $this->goodsRepository->findOneGoodsOption(1);
        $this->goodsRepository->deleteGoodsOption($goodsOption);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsOption(1);
        $this->assertNull($result);
    }

    public function testSaveGoodsParam(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsParam = new GoodsParam();
        $this->goodsRepository->saveGoodsParam($goodsParam);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsParam->getId());
    }

    public function testFindAllGoodsParam(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsParamFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsParam();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsParam(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsParamFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsParam(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsParam", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsParam(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsParam(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsParamFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsParam = $this->goodsRepository->findOneGoodsParam(1);
        $this->goodsRepository->deleteGoodsParam($goodsParam);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsParam(1);
        $this->assertNull($result);
    }

    public function testSaveGoodsSpec(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsSpec = new GoodsSpec();
        $this->goodsRepository->saveGoodsSpec($goodsSpec);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsSpec->getId());
    }

    public function testFindAllGoodsSpec(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsSpec();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsSpec(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsSpec(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsSpec", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsSpec(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsSpec(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsSpec = $this->goodsRepository->findOneGoodsSpec(1);
        $this->goodsRepository->deleteGoodsSpec($goodsSpec);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsSpec(1);
        $this->assertNull($result);

    }

    public function testSaveGoodsSpecItem(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();

        $goodsSpecItem = new GoodsSpecItem();
        $this->goodsRepository->saveGoodsSpecItem($goodsSpecItem);
        $this->objectManager->flush();

        $this->assertGreaterThan(0, $goodsSpecItem->getId());
    }

    public function testFindAllGoodsSpecItem(): void
    {
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecItemFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findAllGoodsSpecItem();

        $this->assertEquals(3, sizeof($result));
    }

    public function testFindOneGoodsSpecItem(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecItemFixture());
        $this->executor->execute($this->loader->getFixtures());

        $result = $this->goodsRepository->findOneGoodsSpecItem(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf("Ydb\\Entity\\Manual\\GoodsSpecItem", $result);
        $this->assertEquals(1, $result->getId());

        $result = $this->goodsRepository->findOneGoodsSpecItem(10000);

        $this->assertEquals(null, $result);
    }

    public function testDeleteGoodsSpecItem(): void
    {
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $this->purger->purge();
        $this->loader->addFixture(new GoodsSpecItemFixture());
        $this->executor->execute($this->loader->getFixtures());

        $goodsSpecItem = $this->goodsRepository->findOneGoodsSpecItem(1);
        $this->goodsRepository->deleteGoodsSpecItem($goodsSpecItem);
        $this->objectManager->flush();
        $result = $this->goodsRepository->findOneGoodsSpecItem(1);
        $this->assertNull($result);
    }
}