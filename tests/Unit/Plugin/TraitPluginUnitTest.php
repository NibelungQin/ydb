<?php


namespace Ydb\Test\Unit\Plugin;


use Ydb\Data\Fixtures\Legacy\ArticleCategoryFixture;
use Ydb\Data\Fixtures\Legacy\ArticleFixture;
use Ydb\Data\Fixtures\Legacy\DiypageFixture;
use Ydb\Data\Fixtures\Legacy\DiypageMenuFixture;
use Ydb\Data\Fixtures\Legacy\DiypagePluFixture;
use Ydb\Data\Fixtures\Legacy\DiypageTemplateCategoryFixture;
use Ydb\Data\Fixtures\Legacy\DiypageTemplateFixture;
use Ydb\Data\Fixtures\Legacy\LiveAdvFixture;
use Ydb\Data\Fixtures\Legacy\LiveCategoryFixture;
use Ydb\Data\Fixtures\Legacy\LiveFixture;
use Ydb\Data\Fixtures\Legacy\MerchAccountFixture;
use Ydb\Data\Fixtures\Legacy\MerchUserFixture;
use Ydb\Data\Fixtures\Legacy\SnsAdvFixture;
use Ydb\Data\Fixtures\Legacy\SnsBoardFixture;
use Ydb\Data\Fixtures\Legacy\SnsCategoryFixture;
use Ydb\Data\Fixtures\Legacy\SnsComplainCateFixture;
use Ydb\Data\Fixtures\Legacy\SnsComplainFixture;
use Ydb\Data\Fixtures\Legacy\SnsLevelFixture;
use Ydb\Data\Fixtures\Legacy\SnsManageFixture;
use Ydb\Data\Fixtures\Legacy\SnsMemberFixture;
use Ydb\Data\Fixtures\Legacy\SnsPostFixture;
use Ydb\Data\Fixtures\Legacy\WxappPageFixture;

trait TraitPluginUnitTest
{
    /**
     * @var array
     */
    protected $diypages;

    /**
     * @var array
     */
    protected $diypage_templates;

    /**
     * @var array
     */
    protected $diypage_plus;

    /**
     * @var array
     */
    protected $diypage_menus;

    public function loadPluginFixture(?\Closure $setup = null): void
    {
        $this->diypages = DiypageFixture::DIYPAGE_LIST;
        $this->diypage_templates = DiypageTemplateFixture::DIYPAGE_TEMPLATE_LIST;
        $this->diypage_plus = DiypagePluFixture::DIYPAGE_PLU_LIST;
        $this->diypage_menus = DiypageMenuFixture::DIYPAGE_MENU_LIST;

        !empty($setup) && $setup();

        $this->loadArticleFixture();
        $this->loadMerchantFixture();
        $this->loadLiveFixture();
        $this->loadWxappFixture();
        $this->loadSnsFixture();
        $this->loadDiypageFixture();
    }

    private function loadArticleFixture(): void
    {
        $articleCategoryFixture = new ArticleCategoryFixture();
        $articleCategoryFixture->load($this->objectManager);
        $articleFixture = new ArticleFixture();
        $articleFixture->load($this->objectManager);
    }

    private function loadMerchantFixture(): void
    {
        $merchUserFixture = new MerchUserFixture();
        $merchUserFixture->load($this->objectManager);
        $merchAccountFixture = new MerchAccountFixture();
        $merchAccountFixture->load($this->objectManager);
    }

    private function loadLiveFixture(): void
    {
        $liveFixture = new LiveFixture();
        $liveFixture->load($this->objectManager);
        $liveCategoryFixture = new LiveCategoryFixture();
        $liveCategoryFixture->load($this->objectManager);
        $liveAdvFixture = new LiveAdvFixture();
        $liveAdvFixture->load($this->objectManager);
    }

    private function loadWxappFixture(): void
    {
        $wxappPageFixture = new WxappPageFixture();
        $wxappPageFixture->load($this->objectManager);
    }

    private function loadSnsFixture(): void
    {
        $snsAdvFixture = new SnsAdvFixture();
        $snsAdvFixture->load($this->objectManager);
        $snsLevelFixture = new SnsLevelFixture();
        $snsLevelFixture->load($this->objectManager);
        $snsCategoryFixture = new SnsCategoryFixture();
        $snsCategoryFixture->load($this->objectManager);
        $snsBoardFixture = new SnsBoardFixture();
        $snsBoardFixture->load($this->objectManager);
        $snsManageFixture = new SnsManageFixture();
        $snsManageFixture->load($this->objectManager);
        $snsMemberFixture = new SnsMemberFixture();
        $snsMemberFixture->load($this->objectManager);
        $snsPostFixture = new SnsPostFixture();
        $snsPostFixture->load($this->objectManager);
        $snsComplainCateFixture = new SnsComplainCateFixture();
        $snsComplainCateFixture->load($this->objectManager);
        $snsComplainFixture = new SnsComplainFixture();
        $snsComplainFixture->load($this->objectManager);
    }

    private function loadDiypageFixture(): void
    {
        $diypageFixture = new DiypageFixture();
        $diypageFixture->setList($this->diypages);
        $diypageFixture->load($this->objectManager);

        $diypageTemplateCategoryFixture = new DiypageTemplateCategoryFixture();
        $diypageTemplateCategoryFixture->load($this->objectManager);

        $diypageTemplateFixture = new DiypageTemplateFixture();
        $diypageTemplateFixture->setList($this->diypage_templates);
        $diypageTemplateFixture->load($this->objectManager);

        $diypagePluFixture = new DiypagePluFixture();
        $diypagePluFixture->setList($this->diypage_plus);
        $diypagePluFixture->load($this->objectManager);

        $diypageMenuFixture = new DiypageMenuFixture();
        $diypageMenuFixture->setList($this->diypage_menus);
        $diypageMenuFixture->load($this->objectManager);
    }
}