<?php

class PayController extends CController
{
	public function actionIndex()
	{
		$alipay = new AliPay();
		$response = $alipay->pay();
		echo $response;
	}

	public function trans() {
        $pay = new AliPay();
        $result = $pay->transfer();
        var_dump($result);
    }
}