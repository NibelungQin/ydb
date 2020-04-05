<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Payment;

class PaymentFixture implements FixtureInterface
{

    public const UNIACID = 3;

    public const PAYMENT_LIST = array (
        0 =>
            array (
                'id' => '1',
                'uniacid' => '3',
                'title' => '一道电商企业支付',
                'type' => '0',
                'appid' => '',
                'mch_id' => '',
                'apikey' => 'hd5JiRBnehbOuRAiXJAnMkf0OR6xdMUj',
                'sub_appid' => 'wxca6b753bc095e372',
                'sub_appsecret' => '',
                'sub_mch_id' => '1534608831',
                'cert_file' => '-----BEGIN CERTIFICATE-----
MILD8DCCAtigAwIBAgIUKoFvDWoHEkJOzLMCvgmuueye5cowDQYJKoZIhvcNAQEL
BQAwXjELMAkGA1UEBhMCQ04xEzARBgNVBAoTClRlbnBheS5jb20xHTAbBgNVBAsT
FFRlbnBheS5jb20gQ0EgQ2VudGVyMRswGQYDVQQDExJUZW5wYXkuY29tIFJvb3Qg
Q0EwHhcNMTkwNTE1MTAwNjUzWhcNMjQwNTEzMTAwNjUzWjCBgTETMBEGA1UEAwwK
MTUzNDYwODgzMTEbMBkGA1UECgwS5b6u5L+h5ZWG5oi357O757ufMS0wKwYDVQQL
DCTmna3lt57lkLnnhafoo4XppbDlt6XnqIvmnInpmZDlhazlj7gxCzAJBgNVBAYM
AkNOMREwDwYDVQQHDAhTaGVuWmhlbjCCASIwDQYJKoZIhvcNAQEBBQADggEPADCC
AQoCggEBANMjxz+YK3VGpuvQtSVcMc6sgDkqddadptr9AJmfxRiXsWhjjINSC1oO
s2Z4OC4Z3lhWetYvbjbgnKMa8++MctODlBmuHUJMs+d9CGKVR/y8lWfxH+vj5xrn
71lVDaqq9jVzydXeeAjXF6ufMMZotvgfvRvNDD9EZ7PcAlat/+tB3J72+obob7HN
WEges6GdLdUmzFTklkidRIDSysUbbwdv9lBu/XXDTgWcqtc1TaLyIl0IJtC8aysQ
H2KygDfshS9fWZIiW1cjKuIbE5HYNDtGEOzC8drhFfCfJcYug+tItxAeTG74Djh5
4bh/fZ4MZmLW2DEMtm7AbV2uAwzHBLUCAwEAAaOBgTB/MAkGA1UdEwQCMAAwCwYD
VR0PBAQDAgTwMGUGA1UdHwReMFwwWqBYoFaGVGh0dHA6Ly9ldmNhLml0cnVzLmNv
bS5jbi9wdWJsaWMvaXRydXNjcmw/Q0E9MUJENDIyMEU1MERCQzA0QjA2QUQzOTc1
NDk4NDZDMDFDM0U4RUJEMjANBgkqhkiG9w0BAQsFAAOCAQEAggOdjTdllhfzWEto
HulJBjMO6x+wDBENWswdvFv1r/3d/QHZoH0Xrh73nEqZCoszO2/uTvRggjpfpTry
V/bLdS6koFxBXt6/vnxtdkvsA9W5gX6SCS4FjA520NpNffafZVSqsoFHBnPOuX8Y
9eI0J9Ag8mQqAsgwfe5wbYPaABdlB5xi1KKOQKugmXeuaShQrZjDvQ5IwF7lUfYR
ION7uMieP3NRh16ooFjxtQF4aWWIN981yZzxijHMoMr96gr7J9UtLT16sg9xYCpm
RmqCGWzOipFPkRZdU7SkaGrgmK5YiRLAvx1GSIbbPrvK7S+Jr4KpWKHYK6PdK94P
YU32sQ==
-----END CERTIFICATE-----
',
                'key_file' => '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDTI8c/mCt1Rqbr
0LUlXDHOrIA5KnXWnaba/QCZn8UZV7FoY4yDUgtaDrNmeDguGd5YVnrWL2424Jyj
GvPvjHITg5QZrh1CTLPnfQhilUf8vJVn8R/r4+ca5+9ZVQ2qqvY1c8nV3ngI1xer
nzDGaLb4H70bzQw/RGez3AJWrf/rQdye9vqG6G+xzVhLHrOhnS3VJsxU5JZInUSA
0srFG28Hb/ZQbv11w04FnKrXNU2i8iJdCCbQvGsrEB9isoA37IUvX1mSIltXIyri
GxOR2DQ7RhDswvHa4RXwnyXGLoPrSLcQHkxu+A44eeG4f32eDGZi1tgxDLZuwG1d
rgMMxwS1AgMBAAECggEAGIbWdXe6zKPJbilPcaiVDJoTRxC8oZKsuFGdiTr7DWeX
bzXpM7QLJ4n/ow6iEBDnOEHLgSf/WJac+4F9Br289P8a7CTCt1nrqB9pIvKOaziI
7osfFyrhRMnejvUHYmT7ttfdgV+XeAdsc35JjzLI1mfxctJN8ueCWG1dRC5wRSaq
cqhDMKMLRPhJQ9hYWGpIOgwonVNOQT59BBO6q0m0Hw8TTs7Kth7gsup/FbZaqVbu
DmiWtTHyJVx7IRF8WFlVm19sovbWlmaUuR+Ha3F3fVT1mX1kCtbRKq+mckj1iqwq
H/LiXyXXFv7WT6BZOjXNUT2cTZSvyZJFt7zn9hn6PQKBgQDrD6uBckp+G9Ey3Iz+
gaL88Prc2jqWko2w1N7E4H72sOWRgKuNSutt6PPx87Y2BsQ4pBmmZ+4DQvEpLGcE
oX1ouAI5H2rL7Zeq/fDRrIEf0SW8+ZlNVUZVsJ8M+mb1Vs1CNR2XYUbTcCwh8awu
f6z213pXfQyRieY5g4pO/6/fawKBgQDl8pqrQUPtnhH+4SzA+DWfEys1ALyB9mW4
PQ+a/kF/AQ4QRysgGusD3TLtioFmX8QTk4RfMYkfmVidc+lycl0FglM04Uye2Ju0
FwAJo6vJorR0r+jcGV1qavKkSB4M9iTf4qtaF5rkvL0TqOAgMMyalcm80js2vbV4
9GGE8JxUXwKBgD9vLSNzynKZ4yzMpCgSp/+GsMxlACaeSiqMZ8nNo7XDK1DG3oT0
0PAKS7rhwCx4Sv/WGS31IiAzMo2f8/Ul94gJEGCF//VVWPbGLPUIjpgdgweqfBqI
hsCdN27zLFHNKPtTBjdSAyEQRniqlYK+5dh/cf6mOnwUMNMYknybN8UdAoGAR4VN
1jZWinG/5ybiZKLPCstLhRDVkRayTLuxPuQWOwp49Vctcq7sqicC0B9kYBMpSW14
nqMpo0pu5YpH8fDgPfZrKudojX+R7lG5EUZ3CCAzQJf2NX8uLwtUrQRBVIa6sWgv
I7Zz1vFdXeAI1fpXqT0toi1BfaVD7HsWWeL8vMECgYEAvyxTYUADjwGM0Pb+fdrM
pybdZGnJT8xqbS1hd01ahPDpcK86M03vp6OvsG1f9J1odXFjK5979n5FqizzEifH
cDqJy3qSVSxOr3qY0vJURzxFdViXcHA1LrXT4PVXyoobBwOyGZ1wV11sLmE5Uz14
o3i/zwWnqUqYR7aaZDgZ/XU=
-----END PRIVATE KEY-----
',
                'root_file' => NULL,
                'is_raw' => '0',
                'createtime' => '1561796488',
                'paytype' => '0',
                'alitype' => '0',
                'alipay_sec' => 'a:4:{s:10:"public_key";s:0:"";s:11:"private_key";s:0:"";s:5:"appid";s:0:"";s:16:"alipay_sign_type";i:0;}',
                'qpay_signtype' => '0',
                'app_qpay_public_key' => '',
                'app_qpay_private_key' => '',
            ),
    );
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . Payment::TABLE_NAME);
        array_map( static function($payment) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s'",
                $payment['id'], $payment['uniacid'], $payment['title'], $payment['type'], $payment['appid'],
                $payment['mch_id'], $payment['apikey'], $payment['sub_appid'], $payment['sub_appsecret'],
                $payment['sub_mch_id'], $payment['cert_file'], $payment['key_file'], $payment['root_file'],
                $payment['is_raw'], $payment['createtime'], $payment['paytype'], $payment['alitype'],
                $payment['alipay_sec'], $payment['qpay_signtype'], $payment['app_qpay_public_key'],
                $payment['app_qpay_private_key']
            );
            pdo_run('INSERT INTO ' . Payment::TABLE_NAME . " VALUE ($values)");
        }, self::PAYMENT_LIST);
    }
}