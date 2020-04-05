<?php


namespace Ydb\Test\Unit\Plugin\Sns\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class SnsPostControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.post';
        $_GET['id'] = '3';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'sns.post.getlist';
        $_GET['page'] = '1';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testReply(): void
    {
        $_GET['r'] = 'sns.post.reply';
        $_POST['bid'] = '1';
        $_POST['pid'] = '3';
        $_POST['rpid'] = '0';
        $_POST['content'] = '最近总是焦虑失眠，试试这些方法有没有效果[EM1]';
        $this->post();
        $this->route();
    }

    public function testComplain(): void
    {
        $_GET['r'] = 'sns.post.complain';
        $_POST['id'] = '3';
        $_POST['type'] = '-1';
        $_POST['content'] = '骗人，没效果';
        $this->post();
        $this->route();
    }

    public function testLike(): void
    {
        $_GET['r'] = 'sns.post.like';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.post.delete';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testCheck(): void
    {
        $_GET['r'] = 'sns.post.check';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testBest(): void
    {
        $_GET['r'] = 'sns.post.best';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testTop(): void
    {
        $_GET['r'] = 'sns.post.top';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route();
    }

    public function testAllBest(): void
    {
        $_GET['r'] = 'sns.post.allbest';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route(function () {
            $this->pluginSets['sns']['managers'] = 'oMW005lDg8xacovx279GSHDCMetM,oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        });
    }

    public function testAllTop(): void
    {
        $_GET['r'] = 'sns.post.alltop';
        $_GET['bid'] = '1';
        $_GET['pid'] = '3';
        $this->route(function () {
            $this->pluginSets['sns']['managers'] = 'oMW005lDg8xacovx279GSHDCMetM,oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        });
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'sns.post.submit';
        $_POST['bid'] = '1';
        $_POST['title'] = '焦虑到睡不着，吃什么可以缓解？';
        $_POST['content'] = "1、焦虑吃什么可以缓解之低脂牛奶 \n 调查发现人体在摄入比较多的钙后,心情会更加的好,更容易获得快乐,不再容易紧张、暴躁焦虑了,而日常生活中牛奶、酸奶与奶酪是钙的主要来源,特别是低脂牛奶和脱脂牛奶钙含量更加的丰富。\n 2、焦虑吃什么可以缓解之樱桃 \n 樱桃在西方被称为自然的阿司匹林,因为樱桃中含有一种物质叫做花青素,这种物质可以制造快乐,科学家研究发现,人在心情不好的时候多吃一些樱桃心情会很快获得好转,比任何药物都管用。樱桃可以有补充花青素的作用,而且还可以有提高体质的作用,对于舒缓你心情有好处。\n 3、焦虑吃什么可以缓解之香蕉\n 抗焦虑的食物还包括一种大家比较熟悉的食物,那就是香蕉,香蕉含有一种称为生物碱的物质,可以振奋精神和提高信心。而且香蕉是色胺酸和维生素b的最好来源,这些都可以帮助大脑减少忧郁情绪。\n4、焦虑吃什么可以缓解之蓝莓\n你可别小瞧了蓝莓!虽然个头儿不大,但它却是强效压力祛除剂!不信吗?!小小的蓝莓中富含高剂量的抗氧化剂和维他命C。每当压力来袭时,我们都需要补充大量的维他命C和抗氧化剂来帮助身体保护和修复那些岌岌可危的“受虐”细胞们。\n5、焦虑吃什么可以缓解之全麦面包\n因为谷类中含有微量矿物质硒,对振奋精神有很好的效果。并且其含有的碳水化合物可以抵制忧郁的作用。更重要的是对焦虑症患者的焦虑意向和焦虑观念以及焦虑行为有很好的作用。全麦食物可以有振奋精神的作用,同时也可以有缓解焦虑情绪的效果。[EM1]";
        $this->post();
        $this->route();
    }
}