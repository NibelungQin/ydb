<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsPostsControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.posts';
        $_GET['uid'] = '88';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.posts.add';
        $this->route(function () {
            $this->pluginSets['sns']['managers'] = 'oMW005lDg8xacovx279GSHDCMetM,oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        });
    }

    public function testAddPost(): void
    {
        $_GET['r'] = 'sns.posts.add';
        $_POST['id'] = '';
        $_POST['bid'] = '1';
        $_POST['title'] = '#饮食养生# 3种食物每天吃一点，调理失眠精神棒！';
        $_POST['openid'] = 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        $_POST['images'] = ['images/3/2020/03/Z9Egw8Z9qGzq8HQ6Aw6282V9XXmA66.jpg'];
        $_POST['content'] = '<p><span style="background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: arial; text-align: justify;">随着社会的发展，生活和工作节奏的加快失眠者的数量也越来越多。一般来说，入睡时间超过30分钟、睡眠质量不好、总睡眠时间低于6小时都可以诊断为失眠。失眠除了对睡眠造成伤害之外，还会对我们的日常造成一定的困扰，例如：全身疲劳，四肢无力，情绪波动大，学习和工作效率降低。 身体不好晚上还老失眠，其实这与你的饮食有着极大的关系。</span></p><p><span style="font-size: 18px; font-weight: 700; background-color: rgb(255, 255, 255); font-family: arial; text-align: justify;"><br/></span></p><p><span style="font-size: 18px; font-weight: 700; background-color: rgb(255, 255, 255); font-family: arial; text-align: justify;">睡前少吃2款食物，远离失眠！</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">咖啡</span></span></p><div class="img-container" style="margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><img class="large" data-loadfunc="0" src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=278864689,2328679071&fm=173&app=25&f=JPEG?w=640&h=429&s=CC9800D760E493037FB5143603004063" data-loaded="0" style="border: 0px; width: 600px; display: block;"/></div><p style="margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-br"></span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">咖啡中含的咖啡因会刺激大脑神经系统是呼吸及心跳加速，血压上升会减少黑色素的分泌造成失眠！ 这就是为什么咖啡能够提神的原因，此外咖啡有着很好的利尿作用，会让你在半夜去厕所的次数更加的频繁。咖啡虽然可以燃烧我们的脂肪，有助于减肥，但是老年人和妇女应该少喝，因为饮用过多的咖啡会导致钙质的流失。</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">甜品</span></span></p><div class="img-container" style="margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><img class="large" data-loadfunc="0" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3497909876,337501970&fm=173&app=25&f=JPEG?w=640&h=441&s=50A8BE55EA40674560BB5C790300A038" data-loaded="0" style="border: 0px; width: 600px; display: block;"/></div><p style="margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-br"></span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">甜品是大多数人都喜欢的，尤其在饭后近十点，甜品可以帮助消化，但过于甜腻的食物很容易会给胃增添负担，对牙齿的伤害也大，另一方面甜品中的糖分很难在休息的状态下分解，这样容易造成肥胖，时间长了还会有引发心血管疾病。吃过多的甜食还会加快人面部皮肤的衰老，而睡眠又对缓解皮肤衰老起到了至关重要的作用，因为睡眠不足的人就没有足够的时间来修复和更新自己的机体，也无法制造出保持皮肤细嫩光滑的激素。</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">经常失眠让人苦不堪言，不仅影响精神，还影响身体健康，推荐大家平时也可以多吃以下3种食物，助睡安眠一觉到天亮！</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">想要好的睡眠质量，这些东西应当多吃：</span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">小米</span></span></p><div class="img-container" style="margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><img class="large" data-loadfunc="0" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=3106986197,3467289549&fm=173&app=25&f=JPEG?w=640&h=426&s=8D24D6144A663201522A84250300006B" data-loaded="0" style="border: 0px; width: 600px; display: block;"/></div><p style="margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-br"></span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">小米是谷类植物，有很高的营养价值，有丰富的维生素蛋白质和脂肪。晚饭的时候我们不妨可以喝一点小米粥，因为小米粥里有一种特殊的物质——色氨酸。色氨酸能够抑制人大脑的兴奋，从而改善睡眠质量。小米不仅可以改善睡眠还可以清热，滋阴，补脾肺肾等功效，可以说是好处多多。</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">桂圆干</span></span></p><div class="img-container" style="margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><img class="large" data-loadfunc="0" src="https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=4016690540,943825053&fm=173&app=25&f=JPEG?w=640&h=423&s=B6387E865A1216C4D899C0270300604B" data-loaded="0" style="border: 0px; width: 600px; display: block;"/></div><p style="margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-br"></span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">桂圆干也就是被晒干了的龙眼肉。桂圆干里有多种的氨基酸还有硫胺素等化学成分，这些化学成分具有益气补血，安神定志的作用，非常适用于失眠的人群。</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-strong" style="font-size: 18px; font-weight: 700;">坚果</span></span></p><div class="img-container" style="margin-top: 30px; font-family: arial; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);"><img class="large" data-loadfunc="0" src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=495079267,796483682&fm=173&app=25&f=JPEG?w=640&h=446&s=E0B91FD54A4510C03420413703004063" data-loaded="0" style="border: 0px; width: 600px; display: block;"/></div><p style="margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;"><span class="bjh-br"></span></span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">坚果如核桃、板栗、杏仁等的果实。都是很好的补脑食物，有改善神经衰弱功效。坚果集于了植物所有的精华，营养非常丰富，含蛋白质、脂肪、油脂、维生素等，对人体的发育和预防疾病都有很好的效果。</span></p><p style="margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);"><span class="bjh-p" style="display: block;">养生服务在线，健康永不掉线！感谢大家阅读慧莹的原创文章，更多关于健康的小知识，欢迎大家留言给慧莹哦！</span></p><p><span style="color: rgb(51, 51, 51); font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><br/></span><br/></p>';
        $_POST['isboardbest'] = '1';
        $_POST['isbest'] = '1';
        $_POST['isboardtop'] = '1';
        $_POST['istop'] = '1';
        $this->post();
        $this->route(function () {
            $this->pluginSets['sns']['managers'] = 'oMW005lDg8xacovx279GSHDCMetM,oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        });
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.posts.delete';
        $_GET['deleted'] = '1';
        $_GET['id'] = '4';
        $this->route();
    }

    public function testDelete1(): void
    {
        $_GET['r'] = 'sns.posts.delete1';
        $_GET['id'] = '4';
        $this->route();
    }

    public function testCheck(): void
    {
        $_GET['r'] = 'sns.posts.check';
        $_GET['check'] = '0';
        $_GET['id'] = '4';
        $this->route();
    }

    public function testBest(): void
    {
        $_GET['r'] = 'sns.posts.best';
        $_GET['best'] = '0';
        $_GET['all'] = '0';
        $_GET['id'] = '3';
        $this->route();
    }

    public function testTop(): void
    {
        $_GET['r'] = 'sns.posts.top';
        $_GET['top'] = '0';
        $_GET['all'] = '0';
        $_GET['id'] = '3';
        $this->route();
    }
}