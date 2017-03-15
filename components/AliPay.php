<?php

/**
 * Created by PhpStorm.
 * User: pengcheng
 * Date: 2016/9/30
 * Time: 15:06
 */
class AliPay
{
    private $pay_client;
    private $pay_request;
    private $pay_config;
    public function __construct()
    {
        $this->pay_client = new AopClient;
        $this->getConfig();
        $this->pay_client->gatewayUrl = "https://openapi.alipaydev.com/gateway.do";
        $this->pay_client->appId = $this->pay_config['APP_ID'];
        $this->pay_client->privateKey = $this->pay_config['APP_PRIVATE'];
        $this->pay_client->format = "json";
        $this->pay_client->charset= $this->pay_config['CHARSET'];
        $this->pay_client->alipayPublicKey = $this->pay_config['ALIPAY_PUBLIC_KEY'];
        $this->pay_client->rsaPrivateKeyFilePath = dirname(__FILE__).'/../config/rsa_private_key.pem';
    }

    /**
     * 手机网站支付
     */
    private function tradeWap()
    {
        $this->pay_request = new AlipayTradeWapPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        //此次只是参数展示，未进行字符串转义，实际情况下请转
        $this->pay_request->setBizContent(
            " {".
            "    \"body\":\"对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。\",".
            "    \"subject\":\"大乐透\",".
            "    \"out_trade_no\":\"70501111111S001111119\",".
            "    \"timeout_express\":\"90m\",".
            "    \"total_amount\":9.00,".
            "    \"product_code\":\"QUICK_WAP_PAY\"".
            " }"
        );
    }
    
    public function getConfig()
    {
        $this->pay_config = require(dirname(__FILE__).'/../config/ali.php');
    }

    public function pay(){
        $this->tradeWap();
        $response= $this->pay_client->execute($this->pay_request);
        return $response;
    }

    public function transfer() {
        $this->pay_request = new AlipayFundTransToaccountTransferRequest();
        $this->pay_request->setBizContent(
            "{".
            "    \"out_biz_no\":\"3142321423432\"," .
            "    \"payee_type\":\"ALIPAY_LOGONID\"," .
            "    \"payee_account\":\"abc@sina.com\"," .
            "    \"amount\":\"0.01\"," .
            "    \"payer_real_name\":\"上海交通卡公司\"," .
            "    \"payer_show_name\":\"上海交通卡退款\"," .
            "    \"payee_real_name\":\"张三\"," .
            "    \"remark\":\"转账备注\"," .
            "    \"ext_param\":\"{\\\"order_title\\\":\\\"上海交通卡退款\\\"}\"" .
            "  }"
        );

        $result = $this->pay_client->execute($this->pay_request);
        return $result;
    }
}