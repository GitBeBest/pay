<?php

class PayModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'pay.models.*',
			'pay.components.*',
			'pay.sdk.*',
			'pay.sdk.alipay-sdk.aop.*',
			'pay.sdk.alipay-sdk.aop.request.*',
			'pay.sdk.alipay-sdk.lotusphp_runtime.*',
			'pay.sdk.alipay-sdk.lotusphp_runtime.Logger.*'
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
