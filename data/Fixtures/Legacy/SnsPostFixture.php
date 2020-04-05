<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsPost;

class SnsPostFixture implements FixtureInterface
{
    public const POST_LIST = [
        3 =>
            [
                'id' => 3,
                'uniacid' => 3,
                'bid' => '1',
                'pid' => '0',
                'rpid' => '0',
                'openid' => 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s',
                'avatar' => 'http://thirdwx.qlogo.cn/mmopen/kFpYPHQmrHwBuecGJ4DdUlrKN7eepthBLBsPVbicbQGyy1kibzPfQPn1tiaXILeIyhBf6qIzx0tkpItOUwzRZVX1hYcPjmrAl9o/132',
                'nickname' => '叶子',
                'title' => '#饮食养生# 3种食物每天吃一点，调理失眠精神棒！',
                'content' => '&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255);color: rgb(51, 51, 51);font-family: arial;text-align: justify;&quot;&gt;随着社会的发展，生活和工作节奏的加快失眠者的数量也越来越多。一般来说，入睡时间超过30分钟、睡眠质量不好、总睡眠时间低于6小时都可以诊断为失眠。失眠除了对睡眠造成伤害之外，还会对我们的日常造成一定的困扰，例如：全身疲劳，四肢无力，情绪波动大，学习和工作效率降低。 身体不好晚上还老失眠，其实这与你的饮食有着极大的关系。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 18px;font-weight: 700;background-color: rgb(255, 255, 255);font-family: arial;text-align: justify;&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 18px;font-weight: 700;background-color: rgb(255, 255, 255);font-family: arial;text-align: justify;&quot;&gt;睡前少吃2款食物，远离失眠！&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;咖啡&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot;style=&quot;margin-top: 30px;font-family: arial;font-size: 12px;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot;data-loadfunc=&quot;0&quot;src=&quot;https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=278864689,2328679071&fm=173&app=25&f=JPEG?w=640&h=429&s=CC9800D760E493037FB5143603004063&quot;data-loaded=&quot;0&quot;style=&quot;border: 0px;width: 600px;display: block;&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;咖啡中含的咖啡因会刺激大脑神经系统是呼吸及心跳加速，血压上升会减少黑色素的分泌造成失眠！ 这就是为什么咖啡能够提神的原因，此外咖啡有着很好的利尿作用，会让你在半夜去厕所的次数更加的频繁。咖啡虽然可以燃烧我们的脂肪，有助于减肥，但是老年人和妇女应该少喝，因为饮用过多的咖啡会导致钙质的流失。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;甜品&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot;style=&quot;margin-top: 30px;font-family: arial;font-size: 12px;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot;data-loadfunc=&quot;0&quot;src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3497909876,337501970&fm=173&app=25&f=JPEG?w=640&h=441&s=50A8BE55EA40674560BB5C790300A038&quot;data-loaded=&quot;0&quot;style=&quot;border: 0px;width: 600px;display: block;&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;甜品是大多数人都喜欢的，尤其在饭后近十点，甜品可以帮助消化，但过于甜腻的食物很容易会给胃增添负担，对牙齿的伤害也大，另一方面甜品中的糖分很难在休息的状态下分解，这样容易造成肥胖，时间长了还会有引发心血管疾病。吃过多的甜食还会加快人面部皮肤的衰老，而睡眠又对缓解皮肤衰老起到了至关重要的作用，因为睡眠不足的人就没有足够的时间来修复和更新自己的机体，也无法制造出保持皮肤细嫩光滑的激素。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;经常失眠让人苦不堪言，不仅影响精神，还影响身体健康，推荐大家平时也可以多吃以下3种食物，助睡安眠一觉到天亮！&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;想要好的睡眠质量，这些东西应当多吃：&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;小米&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot;style=&quot;margin-top: 30px;font-family: arial;font-size: 12px;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot;data-loadfunc=&quot;0&quot;src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3106986197,3467289549&fm=173&app=25&f=JPEG?w=640&h=426&s=8D24D6144A663201522A84250300006B&quot;data-loaded=&quot;0&quot;style=&quot;border: 0px;width: 600px;display: block;&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;小米是谷类植物，有很高的营养价值，有丰富的维生素蛋白质和脂肪。晚饭的时候我们不妨可以喝一点小米粥，因为小米粥里有一种特殊的物质——色氨酸。色氨酸能够抑制人大脑的兴奋，从而改善睡眠质量。小米不仅可以改善睡眠还可以清热，滋阴，补脾肺肾等功效，可以说是好处多多。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;桂圆干&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot;style=&quot;margin-top: 30px;font-family: arial;font-size: 12px;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot;data-loadfunc=&quot;0&quot;src=&quot;https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=4016690540,943825053&fm=173&app=25&f=JPEG?w=640&h=423&s=B6387E865A1216C4D899C0270300604B&quot;data-loaded=&quot;0&quot;style=&quot;border: 0px;width: 600px;display: block;&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;桂圆干也就是被晒干了的龙眼肉。桂圆干里有多种的氨基酸还有硫胺素等化学成分，这些化学成分具有益气补血，安神定志的作用，非常适用于失眠的人群。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-strong&quot;style=&quot;font-size: 18px;font-weight: 700;&quot;&gt;坚果&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;div class=&quot;img-container&quot;style=&quot;margin-top: 30px;font-family: arial;font-size: 12px;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;img class=&quot;large&quot;data-loadfunc=&quot;0&quot;src=&quot;https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=495079267,796483682&fm=173&app=25&f=JPEG?w=640&h=446&s=E0B91FD54A4510C03420413703004063&quot;data-loaded=&quot;0&quot;style=&quot;border: 0px;width: 600px;display: block;&quot;/&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 26px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;&lt;span class=&quot;bjh-br&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;坚果如核桃、板栗、杏仁等的果实。都是很好的补脑食物，有改善神经衰弱功效。坚果集于了植物所有的精华，营养非常丰富，含蛋白质、脂肪、油脂、维生素等，对人体的发育和预防疾病都有很好的效果。&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 22px;margin-bottom: 0px;padding: 0px;line-height: 24px;color: rgb(51, 51, 51);text-align: justify;font-family: arial;white-space: normal;background-color: rgb(255, 255, 255);&quot;&gt;&lt;span class=&quot;bjh-p&quot;style=&quot;display: block;&quot;&gt;养生服务在线，健康永不掉线！感谢大家阅读慧莹的原创文章，更多关于健康的小知识，欢迎大家留言给慧莹哦！&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51);font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif;font-size: 14px;background-color: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;br/&gt;&lt;/p&gt;',
                'images' => 'a:1:{i:0;s:51:"images/3/2020/03/Z9Egw8Z9qGzq8HQ6Aw6282V9XXmA66.jpg";}',
                'voice' => '',
                'createtime' => '1585149952',
                'replytime' => '1585149952',
                'credit' => '0',
                'views' => '0',
                'islock' => '0',
                'istop' => '1',
                'isboardtop' => '1',
                'isbest' => '1',
                'isboardbest' => '1',
                'deleted' => '0',
                'deletedtime' => '0',
                'checked' => '1',
                'checktime' => '0',
                'isadmin' => '1',
            ],
        4 =>
            [
                'id' => 4,
                'uniacid' => 3,
                'bid' => '1',
                'pid' => '3',
                'rpid' => '0',
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'avatar' => 'http://thirdwx.qlogo.cn/mmopen/Q3auHgzwzM7PiaDvO18rz3QtvO4cniak2ibaia99NcLDb3kY7LTiaykxHp1fKxCzKYGkuJfic7LuE3ibLehYeaflSDJvuVOiaz98KibudT7BSicPYsWia0/132',
                'nickname' => 'madhatter',
                'title' => '',
                'content' => '最近总是焦虑失眠，试试这些方法有没有效果[EM1]',
                'images' => 'a:0:{}',
                'voice' => NULL,
                'createtime' => '1585153391',
                'replytime' => '1585153391',
                'credit' => '0',
                'views' => '0',
                'islock' => '0',
                'istop' => '0',
                'isboardtop' => '0',
                'isbest' => '0',
                'isboardbest' => '0',
                'deleted' => '0',
                'deletedtime' => '0',
                'checked' => '1',
                'checktime' => '0',
                'isadmin' => '0',
            ],
        5 => [
            'id' => '5',
            'uniacid' => '3',
            'bid' => '1',
            'pid' => '0',
            'rpid' => '0',
            'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
            'avatar' => 'http://thirdwx.qlogo.cn/mmopen/Q3auHgzwzM7PiaDvO18rz3QtvO4cniak2ibaia99NcLDb3kY7LTiaykxHp1fKxCzKYGkuJfic7LuE3ibLehYeaflSDJvuVOiaz98KibudT7BSicPYsWia0/132',
            'nickname' => 'madhatter',
            'title' => '焦虑到睡不着，吃什么可以缓解？',
            'content' => '1、焦虑吃什么可以缓解之低脂牛奶

调查发现人体在摄入比较多的钙后,心情会更加的好,更容易获得快乐,不再容易紧张、暴躁焦虑了,而日常生活中牛奶、酸奶与奶酪是钙的主要来源,特别是低脂牛奶和脱脂牛奶钙含量更加的丰富。

2、焦虑吃什么可以缓解之樱桃

樱桃在西方被称为自然的阿司匹林,因为樱桃中含有一种物质叫做花青素,这种物质可以制造快乐,科学家研究发现,人在心情不好的时候多吃一些樱桃心情会很快获得好转,比任何药物都管用。樱桃可以有补充花青素的作用,而且还可以有提高体质的作用,对于舒缓你心情有好处。

3、焦虑吃什么可以缓解之香蕉

抗焦虑的食物还包括一种大家比较熟悉的食物,那就是香蕉,香蕉含有一种称为生物碱的物质,可以振奋精神和提高信心。而且香蕉是色胺酸和维生素b的最好来源,这些都可以帮助大脑减少忧郁情绪。

4、焦虑吃什么可以缓解之蓝莓

你可别小瞧了蓝莓!虽然个头儿不大,但它却是强效压力祛除剂!不信吗?!小小的蓝莓中富含高剂量的抗氧化剂和维他命C。每当压力来袭时,我们都需要补充大量的维他命C和抗氧化剂来帮助身体保护和修复那些岌岌可危的“受虐”细胞们。

5、焦虑吃什么可以缓解之全麦面包

因为谷类中含有微量矿物质硒,对振奋精神有很好的效果。并且其含有的碳水化合物可以抵制忧郁的作用。更重要的是对焦虑症患者的焦虑意向和焦虑观念以及焦虑行为有很好的作用。全麦食物可以有振奋精神的作用,同时也可以有缓解焦虑情绪的效果。[EM1]',
            'images' => 'a:0:{}',
            'voice' => NULL,
            'createtime' => '1585221526',
            'replytime' => '1585221526',
            'credit' => '0',
            'views' => '0',
            'islock' => '0',
            'istop' => '0',
            'isboardtop' => '0',
            'isbest' => '0',
            'isboardbest' => '0',
            'deleted' => '0',
            'deletedtime' => '0',
            'checked' => '1',
            'checktime' => '0',
            'isadmin' => '0',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsPost::TABLE_NAME);
        array_map(static function($post) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $post['id'], $post['uniacid'], $post['bid'], $post['pid'], $post['rpid'], $post['openid'],
                $post['avatar'], $post['nickname'], $post['title'], $post['content'], $post['images'],
                $post['voice'], $post['createtime'], $post['replytime'], $post['credit'], $post['views'],
                $post['islock'], $post['istop'], $post['isboardtop'], $post['isbest'], $post['isboardbest'],
                $post['deleted'], $post['deletedtime'], $post['checked'], $post['checktime'], $post['isadmin']
            );
            pdo_run('INSERT INTO ' . SnsPost::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::POST_LIST));
    }
}