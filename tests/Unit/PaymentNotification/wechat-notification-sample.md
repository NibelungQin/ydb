## 微信支付回调日志输出，用于单元测试

- 正常订单（order)

    ```xml
    <xml>
        <appid><![CDATA[wxca6b753bc095e372]]></appid>
        <attach><![CDATA[3:0]]></attach>
        <bank_type><![CDATA[CFT]]></bank_type>
        <cash_fee>1</cash_fee>
        <device_info><![CDATA[ewei_shopv2]]></device_info>
        <fee_type><![CDATA[CNY]]></fee_type>
        <is_subscribe><![CDATA[Y]]></is_subscribe>
        <mch_id>1534608831</mch_id>
        <nonce_str><![CDATA[a242HXtt024H90HZW2ywsZHT0hTtfrZ2]]></nonce_str>
        <openid><![CDATA[oMW005przpAfam6xjAseEI3GV0jU]]></openid>
        <out_trade_no><![CDATA[SH20191115144657748481]]></out_trade_no>
        <result_code><![CDATA[SUCCESS]]></result_code>
        <return_code><![CDATA[SUCCESS]]></return_code>
        <sign><![CDATA[1B7BD0D30220AE7BA1862CCA21AF374D]]></sign>
        <time_end>20191115144705</time_end>
        <total_fee>1</total_fee>
        <trade_type><![CDATA[JSAPI]]></trade_type>
        <transaction_id>4200000430201911152596953132</transaction_id>
    </xml> 
    ```

    ```xml
    <xml>
        <appid><![CDATA[wxca6b753bc095e372]]></appid>
        <attach><![CDATA[3:0]]></attach>
        <bank_type><![CDATA[CFT]]></bank_type>
        <cash_fee>1</cash_fee>
        <device_info><![CDATA[ewei_shopv2]]></device_info>
        <fee_type><![CDATA[CNY]]></fee_type>
        <is_subscribe><![CDATA[Y]]></is_subscribe>
        <mch_id>1534608831</mch_id>
        <nonce_str><![CDATA[JIEL4LgiE2l842Sc82Xl4Gx4XLI4ZRGs]]></nonce_str>
        <openid><![CDATA[oMW005przpAfam6xjAseEI3GV0jU]]></openid>
        <out_trade_no><![CDATA[SH20191115135015866931]]></out_trade_no>
        <result_code><![CDATA[SUCCESS]]></result_code>
        <return_code><![CDATA[SUCCESS]]></return_code>
        <sign><![CDATA[84A563846860EDBA54F03E3962AE0B78]]></sign>
        <time_end>20191115135034</time_end>
        <total_fee>1</total_fee>
        <trade_type><![CDATA[JSAPI]]></trade_type>
        <transaction_id>4200000424201911154529577473</transaction_id>
    </xml>
    ```
    
- 升级大礼包

    ```xml
    <xml>
        <appid><![CDATA[wxca6b753bc095e372]]></appid>
        <attach><![CDATA[3:99]]></attach>
        <bank_type><![CDATA[OTHERS]]></bank_type>
        <cash_fee><![CDATA[1]]></cash_fee>
        <device_info><![CDATA[ewei_shopv2]]></device_info>
        <fee_type><![CDATA[CNY]]></fee_type>
        <is_subscribe><![CDATA[Y]]></is_subscribe>
        <mch_id><![CDATA[1534608831]]></mch_id>
        <nonce_str><![CDATA[b44A1SnZ1S41GBe3S2lg82Isi21i8yuY]]></nonce_str>
        <openid><![CDATA[oMW005lDg8xacovx279GSHDCMetM]]></openid>
        <out_trade_no><![CDATA[PT20200215215833434476]]></out_trade_no>
        <result_code><![CDATA[SUCCESS]]></result_code>
        <return_code><![CDATA[SUCCESS]]></return_code>
        <sign><![CDATA[D424B8681D5E4A7C8501788F6F95C138]]></sign>
        <time_end><![CDATA[20200215215852]]></time_end>
        <total_fee>1</total_fee>
        <trade_type><![CDATA[JSAPI]]></trade_type>
        <transaction_id><![CDATA[4200000483202002150572025256]]></transaction_id>
    </xml>
    ```