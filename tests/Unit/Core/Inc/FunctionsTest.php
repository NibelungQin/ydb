<?php


namespace Ydb\Test\Unit\Core\Inc;


use Ydb\Test\Unit\BaseUnitTest;

class FunctionsTest extends BaseUnitTest
{
    public const HTTP_USER_AGENT_LIST = [
        'iPhone_7P_WeChat_Official_Account' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/7.0.9(0x17000929) NetType/WIFI Language/zh_CN',
        'iPhone_7P_Safari' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.4 Mobile/15E148 Safari/604.1',
        'Nexus_6P_WeChat_Official_Account' => 'Mozilla/5.0 (Linux; Android 8.1.0; Nexus 6P Build/OPM7.181205.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/66.0.3359.126 MQQBrowser/6.2 TBS/45016 Mobile Safari/537.36 MMWEBID/4314 MicroMessenger/7.0.10.1580(0x27000A86) Process/tools NetType/WIFI Language/zh_CN ABI/arm64',
        'Nexus_6P_MOBILE_APP' => 'Mozilla/5.0 (Linux; Android 8.1.0; Nexus 6P Build/OPM7.181205.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.98 Mobile Safari/537.36 uni-app Html5Plus/1.0 (Immersed/24.0)',
        'Nexus_6P_Chrome' => 'Mozilla/5.0 (Linux; Android 8.1.0; Nexus 6P Build/OPM7.181205.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.98 Mobile Safari/537.36',
        'ThinkPad_Windows_10_Chrome' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
    ];

    public function testIsWeixin(): void
    {
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['ThinkPad_Windows_10_Chrome'];
        $result = is_weixin();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['iPhone_7P_WeChat_Official_Account'];
        $result = is_weixin();
        $this->assertEquals(true, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_WeChat_Official_Account'];
        $result = is_weixin();
        $this->assertEquals(true, $result);
    }

    public function testIsH5App(): void
    {
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['ThinkPad_Windows_10_Chrome'];
        $result = is_h5app();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_WeChat_Official_Account'];
        $result = is_h5app();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_MOBILE_APP'];
        $result = is_h5app();
        $this->assertEquals(true, $result);
    }

    public function testIsiOS(): void
    {
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['ThinkPad_Windows_10_Chrome'];
        $result = is_ios();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_WeChat_Official_Account'];
        $result = is_ios();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['iPhone_7P_WeChat_Official_Account'];
        $result = is_ios();
        $this->assertEquals(true, $result);
    }

    public function testIsAndroid(): void
    {
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['ThinkPad_Windows_10_Chrome'];
        $result = is_android();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_WeChat_Official_Account'];
        $result = is_android();
        $this->assertEquals(true, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_MOBILE_APP'];
        $result = is_android();
        $this->assertEquals(true, $result);
    }

    public function testIsMobile(): void
    {
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['ThinkPad_Windows_10_Chrome'];
        $result = is_android();
        $this->assertEquals(false, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_WeChat_Official_Account'];
        $result = is_android();
        $this->assertEquals(true, $result);

        $_SERVER['HTTP_USER_AGENT'] = self::HTTP_USER_AGENT_LIST['Nexus_6P_MOBILE_APP'];
        $result = is_android();
        $this->assertEquals(true, $result);
    }
}