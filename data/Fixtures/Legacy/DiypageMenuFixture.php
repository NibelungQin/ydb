<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Entity\Manual\DiypageMenu;

class DiypageMenuFixture implements FixtureInterface
{
    public const DIYPAGE_MENU_LIST = [
        1 =>
            [
                'id' => '1',
                'uniacid' => ConstantFixture::UNIACID,
                'name' => '一道科技商城',
                'data' => 'eyJuYW1lIjoiXHU0ZTAwXHU5MDUzXHU3OWQxXHU2MjgwXHU1NTQ2XHU1N2NlIiwicGFyYW1zIjp7Im5hdnN0eWxlIjoiMCIsIm5hdmZsb2F0IjoidG9wIiwiY2FydG51bSI6IjEifSwic3R5bGUiOnsicGFnZWJnY29sb3IiOiIjZjlmOWY5IiwiYmdjb2xvciI6IiNmZmZmZmYiLCJiZ2NvbG9yb24iOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiIzk5OTk5OSIsImljb25jb2xvcm9uIjoiIzk5OTk5OSIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJ0ZXh0Y29sb3JvbiI6IiM2NjY2NjYiLCJib3JkZXJjb2xvciI6IiNmZmZmZmYiLCJib3JkZXJjb2xvcm9uIjoiI2ZmZmZmZiIsImNoaWxkdGV4dGNvbG9yIjoiIzY2NjY2NiIsImNoaWxkYmdjb2xvciI6IiNmNGY0ZjQiLCJjaGlsZGJvcmRlcmNvbG9yIjoiI2VlZWVlZSIsImNhcnRiZ2NvbG9yIjoiI2ZmMDAwMCJ9LCJkYXRhIjp7Ik0wMTIzNDU2Nzg5MTAxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTEucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSIsImljb25jbGFzcyI6Imljb24taG9tZSIsInRleHQiOiJcdTU1NDZcdTU3Y2VcdTk5OTZcdTk4NzUifSwiTTAxMjM0NTY3ODkxMDIiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL21lbnUtMi5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9c2hvcC5jYXRlZ29yeSIsImljb25jbGFzcyI6Imljb24tbGlzdCIsInRleHQiOiJcdTUxNjhcdTkwZThcdTU1NDZcdTU0YzEifSwiTTE1NjE2MTc0MzU3MzMiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL21lbnUtMS5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9Y29tbWlzc2lvbiIsImljb25jbGFzcyI6Imljb24tZ3JvdXAiLCJ0ZXh0IjoiXHU1MjA2XHU5NTAwXHU0ZTJkXHU1ZmMzIn0sIk0wMTIzNDU2Nzg5MTA0Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTQucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPW1lbWJlci5jYXJ0IiwiaWNvbmNsYXNzIjoiaWNvbi1jYXJ0IiwidGV4dCI6Ilx1OGQyZFx1NzI2OVx1OGY2NiJ9LCJNMDEyMzQ1Njc4OTEwNSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvbWVudS01LnBuZyIsImxpbmt1cmwiOiIuXC9pbmRleC5waHA/aT0zJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUmcj1tZW1iZXIiLCJpY29uY2xhc3MiOiJpY29uLXBlcnNvbjIiLCJ0ZXh0IjoiXHU0ZTJhXHU0ZWJhXHU0ZTJkXHU1ZmMzIn19fQ==',
                'createtime' => '1561443363',
                'lastedittime' => '1564452827',
                'merch' => '0',
            ],
        2 =>
            [
                'id' => '2',
                'uniacid' => ConstantFixture::UNIACID,
                'name' => '测试商户底部菜单',
                'data' => 'eyJuYW1lIjoiXHU2ZDRiXHU4YmQ1XHU1NTQ2XHU2MjM3XHU1ZTk1XHU5MGU4XHU4M2RjXHU1MzU1IiwicGFyYW1zIjp7Im5hdnN0eWxlIjoiMSIsIm5hdmZsb2F0IjoidG9wIiwiY2FydG51bSI6IjEifSwic3R5bGUiOnsicGFnZWJnY29sb3IiOiIjZjlmOWY5IiwiYmdjb2xvciI6IiNmZmZmZmYiLCJiZ2NvbG9yb24iOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiIzk5OTk5OSIsImljb25jb2xvcm9uIjoiIzk5OTk5OSIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJ0ZXh0Y29sb3JvbiI6IiM2NjY2NjYiLCJib3JkZXJjb2xvciI6IiNmZmZmZmYiLCJib3JkZXJjb2xvcm9uIjoiI2ZmZmZmZiIsImNoaWxkdGV4dGNvbG9yIjoiIzY2NjY2NiIsImNoaWxkYmdjb2xvciI6IiNmNGY0ZjQiLCJjaGlsZGJvcmRlcmNvbG9yIjoiI2VlZWVlZSJ9LCJkYXRhIjp7Ik0wMTIzNDU2Nzg5MTAxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTEucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPW1lcmNoJm1lcmNoaWQ9MSIsImljb25jbGFzcyI6Imljb24taG9tZSIsInRleHQiOiJcdTU1NDZcdTU3Y2VcdTk5OTZcdTk4NzUifSwiTTAxMjM0NTY3ODkxMDIiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL21lbnUtMi5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9c2hvcC5jYXRlZ29yeSZtZXJjaGlkPTEiLCJpY29uY2xhc3MiOiJpY29uLWxpc3QiLCJ0ZXh0IjoiXHU1MTY4XHU5MGU4XHU1NTQ2XHU1NGMxIn0sIk0wMTIzNDU2Nzg5MTAzIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTMucG5nIiwibGlua3VybCI6IiIsImljb25jbGFzcyI6Imljb24tZ3JvdXAiLCJ0ZXh0IjoiXHU1MjA2XHU5NTAwXHU0ZTJkXHU1ZmMzIn0sIk0wMTIzNDU2Nzg5MTA0Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTQucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPW1lbWJlci5jYXJ0Jm1lcmNoaWQ9MSIsImljb25jbGFzcyI6Imljb24tY2FydCIsInRleHQiOiJcdThkMmRcdTcyNjlcdThmNjYifSwiTTAxMjM0NTY3ODkxMDUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL21lbnUtNS5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9bWVtYmVyJm1lcmNoaWQ9MSIsImljb25jbGFzcyI6Imljb24tcGVyc29uMiIsInRleHQiOiJcdTRlMmFcdTRlYmFcdTRlMmRcdTVmYzMifX19',
                'createtime' => '1561542271',
                'lastedittime' => '1561542600',
                'merch' => '1',
            ],
        3 =>
            [
                'id' => '3',
                'uniacid' => ConstantFixture::UNIACID,
                'name' => '7月运营部',
                'data' => 'eyJuYW1lIjoiN1x1NjcwOFx1OGZkMFx1ODQyNVx1OTBlOCIsInBhcmFtcyI6eyJuYXZzdHlsZSI6IjAiLCJuYXZmbG9hdCI6InRvcCJ9LCJzdHlsZSI6eyJwYWdlYmdjb2xvciI6IiNmOWY5ZjkiLCJiZ2NvbG9yIjoiI2ZmZmZmZiIsImJnY29sb3JvbiI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwiaWNvbmNvbG9yb24iOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzY2NjY2NiIsInRleHRjb2xvcm9uIjoiIzY2NjY2NiIsImJvcmRlcmNvbG9yIjoiI2ZmZmZmZiIsImJvcmRlcmNvbG9yb24iOiIjZmZmZmZmIiwiY2hpbGR0ZXh0Y29sb3IiOiIjNjY2NjY2IiwiY2hpbGRiZ2NvbG9yIjoiI2Y0ZjRmNCIsImNoaWxkYm9yZGVyY29sb3IiOiIjZWVlZWVlIn0sImRhdGEiOnsiTTAxMjM0NTY3ODkxMDEiOnsiaW1ndXJsIjoiaW1hZ2VzXC8zXC8yMDE5XC8wN1wvQkdIVlBIeDloQXpCNFZjNnRYbDlsNUZ4QVQ1MnA3LnBuZyIsImxpbmt1cmwiOiIuXC9pbmRleC5waHA/aT0zJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUiLCJpY29uY2xhc3MiOiJpY29uLWhvbWUiLCJ0ZXh0IjoiXHU1NTQ2XHU1N2NlXHU5OTk2XHU5ODc1In0sIk0wMTIzNDU2Nzg5MTAyIjp7ImltZ3VybCI6ImltYWdlc1wvM1wvMjAxOVwvMDdcL08zMDJ6dW9OMm91MzN1VVRaNDM5elkzMDQxM1k4Vy5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9c2hvcC5jYXRlZ29yeSIsImljb25jbGFzcyI6Imljb24tbGlzdCIsInRleHQiOiJcdTUxNjhcdTkwZThcdTU1NDZcdTU0YzEifSwiTTAxMjM0NTY3ODkxMDQiOnsiaW1ndXJsIjoiaW1hZ2VzXC8zXC8yMDE5XC8wN1wvc0hUbXZjU1FaVnAwcTNDcWtwWjQwaDBYM2szOTk0LnBuZyIsImxpbmt1cmwiOiIuXC9pbmRleC5waHA/aT0zJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUmcj1tZW1iZXIuY2FydCIsImljb25jbGFzcyI6Imljb24tY2FydCIsInRleHQiOiJcdThkMmRcdTcyNjlcdThmNjYifSwiTTAxMjM0NTY3ODkxMDUiOnsiaW1ndXJsIjoiaW1hZ2VzXC8zXC8yMDE5XC8wN1wvU2ExWkduYzc3czRCcGFOQWc2UDZOR2puYjQxNDY0LnBuZyIsImxpbmt1cmwiOiIuXC9pbmRleC5waHA/aT0zJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUmcj1tZW1iZXIiLCJpY29uY2xhc3MiOiJpY29uLXBlcnNvbjIiLCJ0ZXh0IjoiXHU0ZTJhXHU0ZWJhXHU0ZTJkXHU1ZmMzIn19fQ==',
                'createtime' => '1562137329',
                'lastedittime' => '1573193814',
                'merch' => '0',
            ],
        4 =>
            [
                'id' => '4',
                'uniacid' => ConstantFixture::UNIACID,
                'name' => '拼团底部菜单',
                'data' => 'eyJuYW1lIjoiXHU2MmZjXHU1NmUyXHU1ZTk1XHU5MGU4XHU4M2RjXHU1MzU1IiwicGFyYW1zIjp7Im5hdnN0eWxlIjoiMCIsIm5hdmZsb2F0IjoidG9wIn0sInN0eWxlIjp7InBhZ2ViZ2NvbG9yIjoiI2Y5ZjlmOSIsImJnY29sb3IiOiIjZmZmZmZmIiwiYmdjb2xvcm9uIjoiI2ZmZmZmZiIsImljb25jb2xvciI6IiM5OTk5OTkiLCJpY29uY29sb3JvbiI6IiM5OTk5OTkiLCJ0ZXh0Y29sb3IiOiIjNjY2NjY2IiwidGV4dGNvbG9yb24iOiIjNjY2NjY2IiwiYm9yZGVyY29sb3IiOiIjZmZmZmZmIiwiYm9yZGVyY29sb3JvbiI6IiNmZmZmZmYiLCJjaGlsZHRleHRjb2xvciI6IiM2NjY2NjYiLCJjaGlsZGJnY29sb3IiOiIjZjRmNGY0IiwiY2hpbGRib3JkZXJjb2xvciI6IiNlZWVlZWUifSwiZGF0YSI6eyJNMDEyMzQ1Njc4OTEwMSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvbWVudS0xLnBuZyIsImxpbmt1cmwiOiIuXC9pbmRleC5waHA/aT0zJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUiLCJpY29uY2xhc3MiOiJpY29uLWhvbWUiLCJ0ZXh0IjoiXHU1NTQ2XHU1N2NlXHU5OTk2XHU5ODc1In0sIk0wMTIzNDU2Nzg5MTAyIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTIucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPWdyb3Vwcy5jYXRlZ29yeSIsImljb25jbGFzcyI6Imljb24tbGlzdCIsInRleHQiOiJcdTYyZmNcdTU2ZTJcdTUyMTdcdTg4NjgifSwiTTAxMjM0NTY3ODkxMDMiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL21lbnUtMy5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9Z3JvdXBzLm9yZGVycyIsImljb25jbGFzcyI6Imljb24tZGluZ2RhbjIiLCJ0ZXh0IjoiXHU2MmZjXHU1NmUyXHU4YmEyXHU1MzU1In0sIk0wMTIzNDU2Nzg5MTA0Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9tZW51LTQucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPWdyb3Vwcy50ZWFtIiwiaWNvbmNsYXNzIjoiaWNvbi1oZXhpYW9zaGFuZ3BpbiIsInRleHQiOiJcdTYyMTFcdTc2ODRcdTU2ZTIifX19',
                'createtime' => '1574405297',
                'lastedittime' => '1574405297',
                'merch' => '0',
            ],
        5 =>
            [
                'id' => '5',
                'uniacid' => ConstantFixture::UNIACID,
                'name' => '底部导航',
                'data' => 'eyJuYW1lIjoiXHU1ZTk1XHU5MGU4XHU1YmZjXHU4MjJhIiwicGFyYW1zIjp7Im5hdnN0eWxlIjoiMCIsIm5hdmZsb2F0IjoidG9wIiwiY2FydG51bSI6IjEifSwic3R5bGUiOnsicGFnZWJnY29sb3IiOiIjZjlmOWY5IiwiYmdjb2xvciI6IiNmZmZmZmYiLCJiZ2NvbG9yb24iOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiIzk5OTk5OSIsImljb25jb2xvcm9uIjoiIzk5OTk5OSIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJ0ZXh0Y29sb3JvbiI6IiM2NjY2NjYiLCJib3JkZXJjb2xvciI6IiNmZmZmZmYiLCJib3JkZXJjb2xvcm9uIjoiI2ZmZmZmZiIsImNoaWxkdGV4dGNvbG9yIjoiIzY2NjY2NiIsImNoaWxkYmdjb2xvciI6IiNmNGY0ZjQiLCJjaGlsZGJvcmRlcmNvbG9yIjoiI2VlZWVlZSJ9LCJkYXRhIjp7Ik0wMTIzNDU2Nzg5MTAxIjp7ImltZ3VybCI6ImltYWdlc1wvM1wvMjAxOVwvMTFcL2U4UGREaEg4UEFFZDhZOTVlNnRSNTk3NWRyZVBQRC5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlIiwiaWNvbmNsYXNzIjoiaWNvbi1ob21lIiwidGV4dCI6Ilx1OTk5Nlx1OTg3NSJ9LCJNMDEyMzQ1Njc4OTEwMiI6eyJpbWd1cmwiOiJpbWFnZXNcLzNcLzIwMTlcLzExXC9GemZqNTI3V20wME1NMjJtRDVMbXk1MDIwYjlmNTIucG5nIiwibGlua3VybCI6Ii5cL2luZGV4LnBocD9pPTMmYz1lbnRyeSZtPWV3ZWlfc2hvcHYyJmRvPW1vYmlsZSZyPXNob3AuY2F0ZWdvcnkiLCJpY29uY2xhc3MiOiJpY29uLWxpc3QiLCJ0ZXh0IjoiXHU1MjA2XHU3YzdiIn0sIk0wMTIzNDU2Nzg5MTAzIjp7ImltZ3VybCI6ImltYWdlc1wvM1wvMjAxOVwvMTFcL3NJaVpBR0dPOEYyTEhrMkYySUdpOG9Bdk1pTWgyWS5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9Y29tbWlzc2lvbiIsImljb25jbGFzcyI6Imljb24tZ3JvdXAiLCJ0ZXh0IjoiXHU1MjA2XHU5NTAwXHU0ZTJkXHU1ZmMzIn0sIk0wMTIzNDU2Nzg5MTA0Ijp7ImltZ3VybCI6ImltYWdlc1wvM1wvMjAxOVwvMTFcL0RwUG9PdVBtM1pKQ0o3SDk2NzM2emNwOXlYOUhrTS5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9bWVtYmVyLmNhcnQiLCJpY29uY2xhc3MiOiJpY29uLWNhcnQiLCJ0ZXh0IjoiXHU4ZDJkXHU3MjY5XHU4ZjY2In0sIk0wMTIzNDU2Nzg5MTA1Ijp7ImltZ3VybCI6ImltYWdlc1wvM1wvMjAxOVwvMTFcL0J1SUpHRk5TN043c1Vud0x2anhVdlYwM0xJSXYzSy5wbmciLCJsaW5rdXJsIjoiLlwvaW5kZXgucGhwP2k9MyZjPWVudHJ5Jm09ZXdlaV9zaG9wdjImZG89bW9iaWxlJnI9bWVtYmVyIiwiaWNvbmNsYXNzIjoiaWNvbi1wZXJzb24yIiwidGV4dCI6Ilx1NGUyYVx1NGViYVx1NGUyZFx1NWZjMyJ9fX0=',
                'createtime' => '1574391697',
                'lastedittime' => '1575530310',
                'merch' => '0',
            ],
    ];


    private $list;

    public function __construct()
    {
        $this->list = self::DIYPAGE_MENU_LIST;
    }

    public function setList($list){
        $this->list = $list;
    }

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . DiypageMenu::TABLE_NAME);
        array_map(static function ($diypage) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s'",
                $diypage['id'], $diypage['uniacid'], $diypage['name'], $diypage['data'], $diypage['createtime'],
                $diypage['lastedittime'],$diypage['merch']
            );
            pdo_run('INSERT INTO ' . DiypageMenu::TABLE_NAME . " VALUE ($values)");
        }, $this->list);
    }
}