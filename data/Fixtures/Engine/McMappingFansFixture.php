<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Engine\McMappingFans;

class McMappingFansFixture implements FixtureInterface
{
    public const MC_MAPPING_FANS = [
        1 =>
            [
                'fanid' => '1',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '1',
                'openid' => 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s',
                'nickname' => '你好',
                'groupid' => '',
                'salt' => 'rQ0Qg0sN',
                'follow' => '1',
                'followtime' => '1564389572',
                'unfollowtime' => '1564389530',
                'tag' => 'YToxODp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1a1FIQ0JHU1dyUHVqOVVncDZZMy00cyI7czo4OiJuaWNrbmFtZSI7czo2OiLkvaDlpb0iO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuadreW3niI7czo4OiJwcm92aW5jZSI7czo2OiLmtZnmsZ8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTM0OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vaEdpY3Y1WnFXaWJYaWJxMm5RbktHNjJ5UUNZM1FCclN1aHl6c3k3UEZZTklaMzhaUVNqendVYkdZYkUyNUcwTWZGcFFYMjNUNWJZV0NENVhwbzVoNDZTUk84bHZYa1NuNElILzEzMiI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTU2NDM4OTU3MjtzOjc6InVuaW9uaWQiO3M6Mjg6Im9ISjRndzNmVGNkM3pFZ1VNVWtjNWFMOHlvdnMiO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czoxNToic3Vic2NyaWJlX3NjZW5lIjtzOjE2OiJBRERfU0NFTkVfU0VBUkNIIjtzOjg6InFyX3NjZW5lIjtpOjA7czoxMjoicXJfc2NlbmVfc3RyIjtzOjA6IiI7czo2OiJhdmF0YXIiO3M6MTM0OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vaEdpY3Y1WnFXaWJYaWJxMm5RbktHNjJ5UUNZM1FCclN1aHl6c3k3UEZZTklaMzhaUVNqendVYkdZYkUyNUcwTWZGcFFYMjNUNWJZ',
                'updatetime' => '1572054468',
                'unionid' => '',
            ],
        2 =>
            [
                'fanid' => '2',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '2',
                'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
                'nickname' => 'madhatter',
                'groupid' => '',
                'salt' => 'gsii0gFZ',
                'follow' => '0',
                'followtime' => '1572176606',
                'unfollowtime' => '1572176839',
                'tag' => 'YToxMTp7czo2OiJvcGVuaWQiO3M6Mjg6Im9NVzAwNWxEZzh4YWNvdngyNzlHU0hEQ01ldE0iO3M6ODoibmlja25hbWUiO3M6OToibWFkaGF0dGVyIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmna3lt54iO3M6ODoicHJvdmluY2UiO3M6Njoi5rWZ5rGfIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMToiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL3ZpXzMyL3g2dTZpYUQ3bkE5S3NEbXF6MmljcGJUNk1aaWNtZW1oU21XbjFMa1AxS3JSUlZONk13T2E4Sm05YTBoOTlOY1BSWVBpY0dyZmxhS2QxbzBHTDRhTGtDYWpKdy8xMzIiO3M6OToicHJpdmlsZWdlIjthOjA6e31zOjc6InVuaW9uaWQiO3M6Mjg6Im9ISjRndzJYMDMzLThiM09rZTJ3TW1HMDdUYXMiO3M6NjoiYXZhdGFyIjtzOjEzMToiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL3ZpXzMyL3g2dTZpYUQ3bkE5S3NEbXF6MmljcGJUNk1aaWNtZW1oU21XbjFMa1AxS3JSUlZONk13T2E4Sm05YTBoOTlOY1BSWVBpY0dyZmxhS2QxbzBHTDRhTGtDYWpKdy8xMzIiO30=',
                'updatetime' => '1572200289',
                'unionid' => 'oHJ4gw2X033-8b3Oke2wMmG07Tas',
            ],
        3 =>
            [
                'fanid' => '3',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '3',
                'openid' => 'oMW005l-F9QEemhWtYk60B2NNnq4',
                'nickname' => '哈尔จุ๊บ',
                'groupid' => '',
                'salt' => 'bkrJzW11',
                'follow' => '1',
                'followtime' => '1561547283',
                'unfollowtime' => '1561547244',
                'tag' => 'YToxNjp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1bC1GOVFFZW1oV3RZazYwQjJOTm5xNCI7czo4OiJuaWNrbmFtZSI7czoxODoi5ZOI5bCU4LiI4Li44LmK4LiaIjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czoxMToiTGlhbnl1bmdhbmciO3M6ODoicHJvdmluY2UiO3M6NzoiSmlhbmdzdSI7czo3OiJjb3VudHJ5IjtzOjU6IkNoaW5hIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzNzoiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL3VoZU9xY2tpYmpkY25HS0x3M2F4WTFyVmlidktaYXY1Y3d1WFk3aWJUS2lhMUxFNW13RkZwdFN1THNrTFhITURaOUlvUEprODZHMXBJUVdpYVR3b0U0RzZGdkpjOVRVS2traWF3YS8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1NjE1NDcyODM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjE1OiJzdWJzY3JpYmVfc2NlbmUiO3M6MTY6IkFERF9TQ0VORV9TRUFSQ0giO3M6ODoicXJfc2NlbmUiO2k6MDtzOjEyOiJxcl9zY2VuZV9zdHIiO3M6MDoiIjt9',
                'updatetime' => '1563954184',
                'unionid' => '',
            ],
        4 =>
            [
                'fanid' => '4',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '4',
                'openid' => 'oMW005rGZ8eZ_WnRC-mEOFpLF0oo',
                'nickname' => '***Dan***',
                'groupid' => '',
                'salt' => 'X3NOwXnz',
                'follow' => '1',
                'followtime' => '1561026987',
                'unfollowtime' => '0',
                'tag' => 'YToxNzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1ckdaOGVaX1duUkMtbUVPRnBMRjBvbyI7czo4OiJuaWNrbmFtZSI7czo5OiIqKipEYW4qKioiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuadreW3niI7czo4OiJwcm92aW5jZSI7czo2OiLmtZnmsZ8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTM2OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vVE85MUdyOFJnRG9hY0tVbkhKTGcyaWFoeDBuYlpvak02WXRXS2ZkM3Z6TktpYktLVXZxaWJKWTBCbElyUVZjUTlHWGdPekNJYzM4OHoybVZjR0Y4UDR2OWd6TUhlSmliZ2liOEIvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTYxMDI2OTg3O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czoxNToic3Vic2NyaWJlX3NjZW5lIjtzOjE2OiJBRERfU0NFTkVfU0VBUkNIIjtzOjg6InFyX3NjZW5lIjtpOjA7czoxMjoicXJfc2NlbmVfc3RyIjtzOjA6IiI7czo2OiJhdmF0YXIiO3M6MTM2OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vVE85MUdyOFJnRG9hY0tVbkhKTGcyaWFoeDBuYlpvak02WXRXS2ZkM3Z6TktpYktLVXZxaWJKWTBCbElyUVZjUTlHWGdPekNJYzM4OHoybVZjR0Y4UDR2OWd6TUhlSmliZ2liOEIvMTMyIjt9',
                'updatetime' => '1569637148',
                'unionid' => '',
            ],
        5 =>
            [
                'fanid' => '5',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '5',
                'openid' => 'oMW005sEfHZ3wg9spRvfgFIyMoaY',
                'nickname' => 'Luna',
                'groupid' => '',
                'salt' => 'VZ844nPA',
                'follow' => '1',
                'followtime' => '1564993227',
                'unfollowtime' => '0',
                'tag' => 'YToxNzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1c0VmSFozd2c5c3BSdmZnRkl5TW9hWSI7czo4OiJuaWNrbmFtZSI7czo0OiJMdW5hIjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLlj7Dlt54iO3M6ODoicHJvdmluY2UiO3M6Njoi5rWZ5rGfIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyMzoiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL1BpYWp4U3FCUmFFS2NtbkhrWHNOT25wVXZiQjJUMjllSlVCWE1tcWVDalhFazJsN1Ywdm55R2NCbGVrMjFJaWFRUWF5UVlRTFRyTWdlWVV1QURQV2pua2cvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTY0OTkzMjI3O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czoxNToic3Vic2NyaWJlX3NjZW5lIjtzOjE2OiJBRERfU0NFTkVfU0VBUkNIIjtzOjg6InFyX3NjZW5lIjtpOjA7czoxMjoicXJfc2NlbmVfc3RyIjtzOjA6IiI7czo2OiJhdmF0YXIiO3M6MTIzOiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vUGlhanhTcUJSYUVLY21uSGtYc05PbnBVdmJCMlQyOWVKVUJYTW1xZUNqWEVrMmw3VjB2bnlHY0JsZWsyMUlpYVFRYXlRWVFMVHJNZ2VZVXVBRFBXam5rZy8xMzIiO30=',
                'updatetime' => '1569633191',
                'unionid' => '',
            ],
        6 =>
            [
                'fanid' => '6',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '6',
                'openid' => 'oMW005iGSyl92U4vTJ5udc8m_EJY',
                'nickname' => '汤正辉',
                'groupid' => '',
                'salt' => 'QlQTqcv2',
                'follow' => '1',
                'followtime' => '1564127988',
                'unfollowtime' => '1564127517',
                'tag' => 'YToxNzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1aUdTeWw5MlU0dlRKNXVkYzhtX0VKWSI7czo4OiJuaWNrbmFtZSI7czo5OiLmsaTmraPovokiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuadreW3niI7czo4OiJwcm92aW5jZSI7czo2OiLmtZnmsZ8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQ5OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vUTNhdUhnend6TTV6NHlpYkFkWlBuTlppYmIwT3pPUFlNbnZsd1RmYWZjMHJmR2VQQjdpYVVyaWJyM0g4NnF6Q0ZScUhZM3NTVWhjdHFnaWF1c2dUN3U2OVhWdU11Q3I2SGhpYzRhR01kY0FpYndDdkd3LzEzMiI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTU2NDEyNzk4ODtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fXM6MTU6InN1YnNjcmliZV9zY2VuZSI7czoxNjoiQUREX1NDRU5FX1NFQVJDSCI7czo4OiJxcl9zY2VuZSI7aTowO3M6MTI6InFyX3NjZW5lX3N0ciI7czowOiIiO3M6NjoiYXZhdGFyIjtzOjE0OToiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL1EzYXVIZ3p3ek01ejR5aWJBZFpQbk5aaWJiME96T1BZTW52bHdUZmFmYzByZkdlUEI3aWFVcmlicjNIODZxekNGUnFIWTNzU1VoY3RxZ2lhdXNnVDd1NjlYVnVNdUNyNkhoaWM0YUdNZGNB',
                'updatetime' => '1569633550',
                'unionid' => '',
            ],
        7 =>
            [
                'fanid' => '7',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '7',
                'openid' => 'oMW005irn7KsyiqZcXCogbHssz_4',
                'nickname' => 'Judy',
                'groupid' => '',
                'salt' => 'qg1XcJ5Z',
                'follow' => '1',
                'followtime' => '1564129254',
                'unfollowtime' => '1564127742',
                'tag' => 'YToxNzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1aXJuN0tzeWlxWmNYQ29nYkhzc3pfNCI7czo4OiJuaWNrbmFtZSI7czo0OiJKdWR5IjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czowOiIiO3M6ODoicHJvdmluY2UiO3M6MDoiIjtzOjc6ImNvdW50cnkiO3M6OToi5biD6ZqG6L+qIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzNDoiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL1RPOTFHcjhSZ0RweVZPbVVtcElSNlo4blBka2RRZjZGY3V0ak00bEpUZzc3NVNJUTF4b2dEOXMwVlZxejN5aWNGQkZ2SmRMMnNaaWIzR2RlM0NId1oyclVpYkJ3dHk2UE1FSS8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1NjQxMjkyNTQ7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjE1OiJzdWJzY3JpYmVfc2NlbmUiO3M6MTY6IkFERF9TQ0VORV9TRUFSQ0giO3M6ODoicXJfc2NlbmUiO2k6MDtzOjEyOiJxcl9zY2VuZV9zdHIiO3M6MDoiIjtzOjY6ImF2YXRhciI7czoxMzQ6Imh0dHA6Ly90aGlyZHd4LnFsb2dvLmNuL21tb3Blbi9UTzkxR3I4UmdEcHlWT21VbXBJUjZaOG5QZGtkUWY2RmN1dGpNNGxKVGc3NzVTSVExeG9nRDlzMFZWcXozeWljRkJGdkpkTDJzWmliM0dkZTNDSHdaMnJVaWJCd3R5NlBNRUkvMTMyIjt9',
                'updatetime' => '1565776620',
                'unionid' => '',
            ],
        8 =>
            [
                'fanid' => '8',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '8',
                'openid' => 'oMW005iaqvX8W7GDn_V0hu5NofXo',
                'nickname' => 'Jessica.Z',
                'groupid' => '',
                'salt' => 'OrkVvKtX',
                'follow' => '1',
                'followtime' => '1565085963',
                'unfollowtime' => '1564128510',
                'tag' => 'YToxNzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1aWFxdlg4VzdHRG5fVjBodTVOb2ZYbyI7czo4OiJuaWNrbmFtZSI7czo5OiJKZXNzaWNhLloiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czoyOiJlbiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czo2OiLlhrDlspsiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTM1OiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vQkhqNWZ5ckdyRHVSeWdKUTVpYkhUN2I0ME1nZEVEcFhUamljM0FHOXBVOFRqeXVOcVFyd0JraGVzcEFJQnFrelh5YU1XdHBpYU1nQk1USUc5TnE2YUxCdDFNdkFCekRpY1NGVi8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1NjUwODU5NjM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjE1OiJzdWJzY3JpYmVfc2NlbmUiO3M6MTY6IkFERF9TQ0VORV9TRUFSQ0giO3M6ODoicXJfc2NlbmUiO2k6MDtzOjEyOiJxcl9zY2VuZV9zdHIiO3M6MDoiIjtzOjY6ImF2YXRhciI7czoxMzU6Imh0dHA6Ly90aGlyZHd4LnFsb2dvLmNuL21tb3Blbi9CSGo1ZnlyR3JEdVJ5Z0pRNWliSFQ3YjQwTWdkRURwWFRqaWMzQUc5cFU4VGp5dU5xUXJ3QmtoZXNwQUlCcWt6WHlhTVd0cGlhTWdCTVRJRzlOcTZhTEJ0MU12QUJ6RGljU0ZWLzEzMiI7fQ==',
                'updatetime' => '1565597022',
                'unionid' => '',
            ],
        9 =>
            [
                'fanid' => '9',
                'acid' => '3',
                'uniacid' => '3',
                'uid' => '9',
                'openid' => 'oMW005nXuw1vdDcvn-12ce5iM_4k',
                'nickname' => 'Feather',
                'groupid' => '',
                'salt' => 'OgM3NNDu',
                'follow' => '1',
                'followtime' => '1562147630',
                'unfollowtime' => '0',
                'tag' => 'YToxODp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib01XMDA1blh1dzF2ZERjdm4tMTJjZTVpTV80ayI7czo4OiJuaWNrbmFtZSI7czo3OiJGZWF0aGVyIjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmna3lt54iO3M6ODoicHJvdmluY2UiO3M6Njoi5rWZ5rGfIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMzoiaHR0cDovL3RoaXJkd3gucWxvZ28uY24vbW1vcGVuL1RPOTFHcjhSZ0RvYWNLVW5ISkxnMm9Kb2lieW83VnZNYTZwMmF2d1ZjUVJJZE9zejBKUmNKMUZLVEpmNDdXTDl5R3VMQWpvVFdWaWFnNWVYSjNNRWJxRTBjUEYyVkRxbXBkLzEzMiI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTU2MjE0NzYzMDtzOjc6InVuaW9uaWQiO3M6Mjg6Im9ISjRndzM5M3lHZFF5NmJtNEkyZnlWWTkzSG8iO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czoxNToic3Vic2NyaWJlX3NjZW5lIjtzOjE2OiJBRERfU0NFTkVfU0VBUkNIIjtzOjg6InFyX3NjZW5lIjtpOjA7czoxMjoicXJfc2NlbmVfc3RyIjtzOjA6IiI7czo2OiJhdmF0YXIiO3M6MTMzOiJodHRwOi8vdGhpcmR3eC5xbG9nby5jbi9tbW9wZW4vVE85MUdyOFJnRG9hY0tVbkhKTGcyb0pvaWJ5bzdWdk1hNnAyYXZ3VmNRUklkT3N6MEpSY0oxRktUSmY0N1dMOXlHdUxBam9UV1Zp',
                'updatetime' => '1572405897',
                'unionid' => '',
            ],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . McMappingFans::TABLE_NAME);
        array_map(static function ($fan) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $fan['id'], $fan['acid'], $fan['uniacid'], $fan['uid'],
                $fan['openid'], $fan['nickname'], $fan['groupid'], $fan['salt'],
                $fan['follow'], $fan['followtime'], $fan['unfollowtime'], $fan['tag'],
                $fan['updatetime'], $fan['unionid']
            );
            pdo_run('INSERT INTO ' . McMappingFans::TABLE_NAME . " VALUE ($values)");
        }, self::MC_MAPPING_FANS);
    }
}