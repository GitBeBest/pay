<?php

class PayController extends CController
{
	public function actionIndex()
	{
		$alipay = new AliPay();
		$response = $alipay->pay();
		echo $response;
	}
}