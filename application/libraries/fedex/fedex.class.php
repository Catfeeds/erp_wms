<?php
	/**
	 * fedex 创建运单
	 */
	class FedexClass
	{
	
		public $path_to_wsdl ='';
		public $CustomerTransactionId='';
		public $index;
		public $client;
		public $request = array();//创建运单请求参数
		public $shipper = array(); ///发件方信息
		public $recipient = array();//接件方信息
		public $customerClearanceDetail = array(); //清关信息
		public $labelSpecification = array();//标签配置信息
		public $shippingChargesPayment = array();//运费信息
		public $packageNum = null;
		public $responseCreateOpenShipment ; //创建运单反馈信息
		public $responseValidateOpenShipment; //验证运单反馈信息
		public $responseConfirmOpenShipment ;//确认运单反馈信息
		public $responseDeleteOpenShipment;//删除运单反馈信息
		public $requestedPackageLineItems; //包裹描述信息
		public $package='YOUR_PACKAGING';//默认自定义包裹
		public $service_type='INTERNATIONAL_ECONOMY_FREIGHT';//默认国际经济重货
		const  SHIP_LABEL ='_shiplabel.pdf';
		public $ship_timestamp;

		public function writeLog($client,$response)
		{
			$highestSeverity=$response->HighestSeverity;
			$err_msg=str_repeat('=', 20).$highestSeverity.str_repeat('=', 20)."\r\n";
			if($highestSeverity=="SUCCESS"){$err_msg.="Date:".date('Y-m-d H:i:s')."\r\nTransaction:Successful\r\n";}
			if($highestSeverity=="WARNING"){ $err_msg.="Date:".date('Y-m-d H:i:s')."\r\nTransaction:Warning\r\n";}
			if($highestSeverity=="ERROR"){  $err_msg.="Date:".date('Y-m-d H:i:s')."\r\nTransaction:Error\r\n";}
			if($highestSeverity=="FAILURE"){ $err_msg.="Date:".date('Y-m-d H:i:s')."\r\nTransaction:Failure\r\n";}
			if(in_array($highestSeverity, array('SUCCESS','WARNING')))
			{
				$err_msg=$this->writeNotifications($err_msg,$response->Notifications);
			}
			elseif (in_array($highestSeverity, array('ERROR','FAILURE')))
			{
				$err_msg=$this->writeNotifications($err_msg,$response->Notifications);
			}

			$this->writeFileLog($err_msg);
		}

		protected function writeNotifications($msg,$notes)
		{
			foreach ($notes as $noteKey => $note) {
				if(is_string($note))
				{
					$msg.=$noteKey.':'.$note."\r\n";
				}
				else
				{
					$this->writeNotifications($msg,$note);
				}

			}

			return $msg;
		}

		protected function writeFileLog($msg)
		{

			if (!$logfile = fopen(APPPATH.'/cache/fedexShipmentBriefly.log', "a"))
			{
				error_func("Cannot open ".APPPATH.'/cache/fedexShipmentBriefly.log' . " file.\n", 0);
				exit(1);
			}
			fwrite($logfile,$msg,strlen($msg));
		}

		public function __construct()
		{

			 $this->path_to_wsdl =APPPATH."libraries/fedex/wsdl/OpenShipService_v7.wsdl";
		}

		/**
		 * 设置包裹数量
		 * @param $num   包裹数量
		 */
		public function setPackageNum($num)
		{
			$this->packageNum = $num;
		}


		/**
		 * 判定请求是否成功
		 */

		function isSuccess($client, $response){
			if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR')
				return true;
			else 
				return false;
		}

		/**
		 * 打印成功
		 */
		function printSuccess($client, $response) {
		    $this->printReply($client, $response);
		}


		/**
		 * 打印错误
		 */
		function printError($client, $response){
		    $this->printReply($client, $response);
		}


		/**
		 * 跟踪详情信息
		 */
		function trackDetails($details, $spacer){
			foreach($details as $key => $value){
				if(is_array($value) || is_object($value)){
		        	$newSpacer = $spacer. '&nbsp;&nbsp;&nbsp;&nbsp;';
		    		echo '<tr><td>'. $spacer . $key.'</td><td>&nbsp;</td></tr>';
		    		trackDetails($value, $newSpacer);
		    	}elseif(empty($value)){
		    		echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
		    	}else{
		    		echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
		    	}
		    }
		}
		/**
		 * 打印反馈信息
		 */
		public function printReply($client, $response){
			$highestSeverity=$response->HighestSeverity;
			if($highestSeverity=="SUCCESS"){echo '<h2>The transaction was successful.</h2>';}    	//交易成功
			if($highestSeverity=="WARNING"){echo '<h2>The transaction returned a warning.</h2>';}	//交易返回一个警告
			if($highestSeverity=="ERROR"){echo '<h2>The transaction returned an Error.</h2>';}		//交易返回一个错误
			if($highestSeverity=="FAILURE"){echo '<h2>The transaction returned a Failure.</h2>';}	//交易返回一个失败
			echo "\n";																				//换行
			$this->printNotifications($response -> Notifications);											//打印通知信息
			$this->printRequestResponse($client, $response);												//打印请求反馈											
		}
		/**
		 * 打印所提交交易的状态的描述性数据，包含通知的严重性，指出成功或失败或有关请求的某些其他信息。
		 */
		function printNotifications($notes){
			foreach($notes as $noteKey => $note){
				if(is_string($note)){    
		            echo $noteKey . ': ' . $note . '<br>';
		        }
		        else{
		        	$this->printNotifications($note);
		        }
			}
			echo '<br>';
		}
		/**
		 * 打印请求  响应
		 */
		function printRequestResponse($client){
			echo '<h2>Request</h2>' . "\n";
			echo '<pre>' . htmlspecialchars($client->__getLastRequest()). '</pre>';  
			echo "\n";
		   
			echo '<h2>Response</h2>'. "\n";
			echo '<pre>' . htmlspecialchars($client->__getLastResponse()). '</pre>';
			echo "\n";
		}


		/**
		 *  Print SOAP Fault 打印soap错误 
		 */  
		function printFault($exception, $client) {
//		    echo '<h2>Fault</h2>' . "<br>\n";
//		    echo "<b>Code:</b>{$exception->faultcode}<br>\n";
//		    echo "<b>String:</b>{$exception->faultstring}<br>\n";
		    $this->writeToLog($client);
//		    echo '<h2>Request</h2>' . "\n";
//			echo '<pre>' . htmlspecialchars($client->__getLastRequest()). '</pre>';
//			echo "\n";
		}


		/**
		 * SOAP request/response logging to a file //soap 请求 响应 生成日志
		 */                                  
		function writeToLog($client){  
			/**
			 * __DIR__ refers to the directory path of the library file.
			 * This location is not relative based on Include/Require.
			 */
			if (!$logfile = fopen(APPPATH.'/cache/fedexShipment.log', "a"))
			{
		   		error_func("Cannot open ".APPPATH.'/cache/fedexShipment.log' . " file.\n", 0);
		   		exit(1);
			}
			fwrite($logfile, sprintf("\r%s:- %s",date("D M j G:i:s T Y"), $client->__getLastRequest(). "\r\n" . $client->__getLastResponse()."\r\n\r\n"));
		}


		/**
		 * This section provides a convenient place to setup many commonly used variables
		 * needed for the php sample code to function.常用变量
		 */
		public function getProperty($var){
			if($var == 'key') return '05TG5AVXaIiSe6ZS';  
			if($var == 'password') return 'OTiF5eucYiTB0IQUvFzdFvZs2'; 
			if($var == 'shipaccount') return '510087968';   //寄件账号    510087968
			if($var == 'meter') return '118756395'; 		// 510087020 寄件方   510051408 第三方  
			if($var == 'billaccount') return '510087968';  	//合作人账号 付款账户,付运费用的
		    if($var == 'dutyaccount') return '510051408'; 	//清关支付关税的账户
			/*  
			Test Password:OTiF5eucYiTB0IQUvFzdFvZs2
			Test Account Number:510087968 (for FedEx Web Services for Shipping only)
			Test Meter Number:118756395 (for FedEx Web Services for Shipping only)
			FedEx Freight LTL Testing Information (used in the Freight Shipment Detail):

			//联邦货运零担托运人
			FedEx Freight LTL Shipper
			Account Number: 510087020
			Address Line 1: 1202 Chalet Ln
			Address Line 2: Do Not Delete - Test Account
			City: Harrison
			State: AR
			Zip: 72601

			//联邦货运零担货运票据/第三方
			FedEx Freight LTL Bill To/Third Party
			Account Number: 510051408
			Address Line 1: 2000 Freight LTL Testing
			Address Line 2: Do Not Delete - Test Account
			City: Harrison
			State: AR
			Zip: 72601  
			*/  
			  
			
			if($var == 'freightaccount') Return '';  
			if($var == 'trackaccount') Return ''; 
			if($var == 'dutiesaccount') Return '';
			if($var == 'importeraccount') Return '';
			if($var == 'brokeraccount') Return '';
			if($var == 'distributionaccount') Return '';
			if($var == 'locationid') Return 'PLBA';
			if($var == 'printlabels') Return false;
			if($var == 'printdocuments') Return true;
			if($var == 'packagecount') Return '4';
			if($var == 'shiptimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));
			if($var == 'spodshipdate') Return '2014-07-21';
			if($var == 'serviceshipdate') Return '2017-07-26';

			if($var == 'readydate') Return '2014-07-09T08:44:07';
			//if($var == 'closedate') Return date("Y-m-d");
			if($var == 'closedate') Return '2014-07-17';
			if($var == 'pickupdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
			if($var == 'pickuptimestamp') Return mktime(8, 0, 0, date("m")  , date("d")+1, date("Y"));
			if($var == 'pickuplocationid') Return 'XXX';
			if($var == 'pickupconfirmationnumber') Return '1';
			if($var == 'dispatchdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
			if($var == 'dispatchlocationid') Return 'XXX';
			if($var == 'dispatchconfirmationnumber') Return '1';		
			if($var == 'tag_readytimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));
			if($var == 'tag_latesttimestamp') Return mktime(20, 0, 0, date("m"), date("d")+1, date("Y"));	

			if($var == 'expirationdate') Return date("Y-m-d", mktime(8, 0, 0, date("m"), date("d")+15, date("Y")));
			if($var == 'begindate') Return '2014-07-22';
			if($var == 'enddate') Return '2014-07-25';	
			if($var == 'trackingnumber') Return 'XXX';
			if($var == 'hubid') Return '5531';
			if($var == 'jobid') Return 'XXX';
			if($var == 'searchlocationphonenumber') Return '5555555555';
			if($var == 'customerreference') Return 'Cust_Reference';
			


			//发货方
			if($var == 'shipper') Return array(//用于指定负责托运包裹一方的描述性数据。寄件人和始发地的地址应该相同。
				'Contact' => array(
					'PersonName' => 'Sender Name',
					'CompanyName' => 'Sender Company Name',
					'PhoneNumber' => '1234567890'
				),
				'Address' => array(
					'StreetLines' => array('1202 Chalet Ln'),//必填项，门牌号、街道名称等的组合。至少需要输入一行才能构成有效的实际地址；不应包含空行。
					'City' => 'Harrison',//必须，城市、乡镇等的名称。
					'StateOrProvinceCode' => 'AR',//必须，指定美国的州、加拿大的省等行政区域的缩写。根据不同的国家/地区，此字段的格式和填写要求有所不同。
					'PostalCode' => '72601', //可选，邮件/包裹要递送到的地区（通常是小地区）的标识。根据不同的国家/地区，此字段的格式和填写要求有所不同。
					'CountryCode' => 'US',   //必须，两个字母组成的代码，用于标识某个国家/地区。
					'Residential' => 1  //如果您的寄件人地址被视为住宅区位置，则此为必需元素。如果您不确定，请使用地址验证服务来检查您的地址。
				)
			);
			
		    //收货方
			if($var == 'recipient') Return array(//必须，用于指定包裹接受方的描述性数据
				'Contact' => array(
					'PersonName' => 'Recipient Name',
					'CompanyName' => 'Recipient Company Name',
					'PhoneNumber' => '1234567890'
				),
				'Address' => array( //必须，用于指定收件人地址的描述性数据
					'StreetLines' => array('2000 Freight LTL Testing'),//
					'City' => 'Herndon',
					'StateOrProvinceCode' => 'AR',//必须，指定美国的州、加拿大的省等行政区域的缩写。根据不同的国家/地区，此字段的格式和填写要求有所不同。
					'PostalCode' => '72601',
					'CountryCode' => 'US',
					'Residential' => 1
				)
			);	
			
			if($var == 'address1') Return array(
				    'StreetLines' => array('1202 Chalet Ln'),
					'City' => 'Harrison',
					'StateOrProvinceCode' => 'AR',
					'PostalCode' => '72601',
					'CountryCode' => 'US',
		    );
			
			if($var == 'address2') Return array(
				    'StreetLines' => array('2000 Freight LTL Testing'),//必填项，门牌号、街道名称等的组合。至少需要输入一行才能构成有效的实际地址；不应包含空行。
					'City' => 'ShangHai',//必须，城市、乡镇等的名称。
					'StateOrProvinceCode' => 'SH',
					'PostalCode' => '201600',//可选，邮件/包裹要递送到的地区（通常是小地区）的标识。根据不同的国家/地区，此字段的格式和填写要求有所不同。
					'CountryCode' => 'CN',
			);		
						  
			if($var == 'searchlocationsaddress') Return array(
				'StreetLines'=> array('240 Central Park S'),
				'City'=>'Austin',
				'StateOrProvinceCode'=>'TX',
				'PostalCode'=>'78701',
				'CountryCode'=>'US'
			);
											  
			if($var == 'shippingchargespayment') Return array(
				'PaymentType' => 'SENDER',
				'Payor' => array(
					'ResponsibleParty' => array(
						'AccountNumber' => getProperty('billaccount'),
						'Contact' => null,
						'Address' => array('CountryCode' => 'US')
					)
				)
			);	
			
			if($var == 'freightbilling') Return array(
				'Contact'=>array(
					'ContactId' => 'freight1',
					'PersonName' => 'Big Shipper',
					'Title' => 'Manager',
					'CompanyName' => 'Freight Shipper Co',
					'PhoneNumber' => '1234567890'
				),
				'Address'=>array(
					'StreetLines'=>array(
						'1202 Chalet Ln', 
						'Do Not Delete - Test Account'
					),
					'City' =>'Harrison',
					'StateOrProvinceCode' => 'AR',
					'PostalCode' => '72601-6353',
					'CountryCode' => 'US'
					)
			);
		}


		/**
		 * 绑定交易详情
		 * @param $arr
		 */
		public function buildTransactionDetail($arr){
			//global $CustomerTransactionId;
			$this->request['WebAuthenticationDetail'] = array(//WebAuthenticationDetail元素包括 FedEx 发出的用户凭据，以便您的交易可由 FedEx 后端系统识别。
				'UserCredential' =>array(//用来验证特定软件应用程序的凭据。注册之后，此值由 FedEx 提供。
					'Key' =>$arr['Key'],
					'Password' =>$arr['Password']
				)
			);
			
			$this->request['ClientDetail'] = array(//ClientDetail 元素对于需要帐号和 Meter 号的所有服务而言都是必需的元素。
				'AccountNumber' =>$arr['AccountNumber'], //您的 FedEx 帐号。
				'MeterNumber' => $arr['MeterNumber'],//您的 FedEx 帐号的关联 Meter 号。最多 9 个字符。
				'Localization'=>array(//控制数据有效负载语言/翻译（与 ClientDetail.localization 对照，该元素控制 Notification.localizedMessage 语言选择）。
								'LanguageCode'=>'zh',
								'LocaleCode'=>'CN'
								)
			);
			
			$this->request['TransactionDetail'] = array(//TransactionDetail 元素是所有交易的可选元素。不过，如果您要指定关联的请求和回复交易，请使用此元素。
				'CustomerTransactionId' => $arr['CustomerTransactionId'],//最多 40 个字符。此元素允许您为交易指定唯一的标识符。此元素会在回复中返回，可帮助您比对请求与回复。，这个我们用批次号代替
			    'Localization'=>array(
								'LanguageCode'=>'zh',
								'LocaleCode'=>'CN'
								)
			);
			$this->request['Version'] = array(//VersionId 元素是必需元素，可将 WSDL 版本号上传给 FedEx。FedEx 提供您正在使用的服务的最新版本号。当您实施新版本的服务时，将会更新此版本号。
				'ServiceId' => 'ship', //指定执行操作的系统或子系统。
				'Major' => '7', 	   //指定服务业务级别。
				'Intermediate' => '0', //指定服务接口级别。
				'Minor' => '0' 		   //指定服务代码级别。
			);
		}
		//建立创建开放装运请求
		public function buildCreateOpenShipmentRequest(){

			$this->request['RequestedShipment'] = array(//必须，关于请求人要发送的货件的描述性数据。
			
			    /* ShipTimestamp 可选。指定包裹交给 FedEx 的日期和时间。 */ 
				'ShipTimestamp' => date('c',$this->ship_timestamp),
				
				/* DropoffType 指定将包裹交给 FedEx 所用的方法。此元素不会派遣速递员进行包裹取件。*/
				'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER请求信使, DROP_BOX, BUSINESS_SERVICE_CENTER and STATION 5种
				
				/* ServiceType 为费率请求指定托运包裹时要使用的 FedEx 服务。*/
				'ServiceType' => $this->service_type, // valid values 可用选项有很多，但是我们常用应该有两种 INTERNATIONAL_ECONOMY  INTERNATIONAL_ECONOMY_FREIGHT
				
				/* PackagingType 指定请求人对包裹使用的包装。有关有效枚举值的列表， 请参见 PackagingType。*/
				'PackagingType' => $this->package, // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
				
				/*Shipper 货件始发地实际地点的描述性数据。*/
				'Shipper' => $this-> shipper,
				
				/*Recipient  必需。用于指定包裹接收方的描述性数据。 */
				'Recipient' =>$this-> recipient,
				
				/*必需。由于 FedEx 向客户提供了服务而收取的货币报酬的描述性数据。*/
				'ShippingChargesPayment' =>$this->shippingChargesPayment,
			
				/*必需。用于指定负责托运包裹一方的描述性数据。(固定参数)*/
				'LabelSpecification' =>$this->labelSpecification,
				/**可选
				 * 特定于 Express Freight 货件的详细信息。特快
				 */
				'ExpressFreightDetail'=> array( 'ShippersLoadAndCount' => 3 , 'BookingConfirmationNumber' => '12345678' ),
				/**
				 *清关信息
				 * 有关此包裹的信息，只适用于国际（出口）货件或回件。
				 */
				'CustomsClearanceDetail' =>$this->customerClearanceDetail,
				/*
					 ACCOUNT：使用客户的帐户费率作为计算附加费的基础。
					 LIST：使用 FedEx 列表费率作为计算附加费的基础。
				*/ 
				'RateRequestTypes' => array('LIST'), // valid values ACCOUNT and LIST

				/*
					必需。整个货件中的包裹总数（即使货件分散
					在多个交易中）。对于 OpenShip，这是一个
					预计的包裹数。在 OpenShip 交易中添加和删
					除包裹时，系统会维护实际计数。
				*/
				'PackageCount' => $this->packageNum,
				
				/*
					必需。一个或多个包裹属性描述，其中的每项
					用于描述单个包裹、一组相同的包裹，或者
					（对于统一包装、统一计重的情况）货件中所
					有包裹的共同特征。
					注意：不需要为 CREATE_PACKAGE 操作指
					定此元素。有效值包括：
					 Weight/Units
					 Weight/Value
				*/
				'RequestedPackageLineItems' =>$this->requestedPackageLineItems,
			);
		}
		/**
		 * 创建运单时添加接件方信息
		 * 传入参数  $reci  arr    接件方信息
		 * 返回参数  $$recipient  arr
		 *
		 */
		public function addRecipient($reci){
			$this->recipient = array(//必须，用于指定包裹接收方的描述性数据。
				'Contact' => array(//接收方的联系方式
					'PersonName' =>  $reci['personName'],//接收方姓名
					'CompanyName' => $reci['companyName'],//接收方公司名
					'PhoneNumber' => $reci['phoneNumber']//接收方电话号
				),
				'Address' => array(//接收方地址
					'StreetLines' => $reci['Address_streetLines'],		//地址
					'City' => $reci['Address_City'],      					//城市
					'StateOrProvinceCode' => $reci['Address_StateOrProvinceCode'],   			//国家或省代码
					'PostalCode' => $reci['Address_PostalCode'],  					//邮编
					'CountryCode' => $reci['Address_CountryCode'],    					//国家编号
					'Residential' => $reci['Address_Residential']  					//居民区
				)
			);
		}
		/**
		 * 添加寄货人
		 * 传入参数  $shiper arr  寄件人信息
		 * 返回结果  $shipper;
		 */
		function addShipper($shiper){
			$this->shipper = array(//必须，用于指定负责托运包裹一方的描述性数据。寄件人和始发地的地址应该相同。
				'Contact' => array(//寄件人的联系方式
					'PersonName' => $shiper['personName'],//寄件人姓名
					'CompanyName' => $shiper['companyName'],//寄件人公司名
					'PhoneNumber' => $shiper['phoneNumber']//寄件人联系方式
				),
				'Address' => array(//寄件人的地址
					'StreetLines' => $shiper['Address_streetLines'],//寄件人的街道信息
					'City' => $shiper['Address_City'],//寄件人所在城市
					'StateOrProvinceCode' => $shiper['Address_StateOrProvinceCode'],//寄件人地区缩写
					'PostalCode' => $shiper['Address_PostalCode'],//寄件人区域码
					'CountryCode' => $shiper['Address_CountryCode']//寄件人国家编码
				)
			);
		}

		//修改收件人
		function addModifiedRecipient(){
			$modifiedRecipient = array(
				'Contact' => array(
					'PersonName' => 'Jason.Cui',
					'CompanyName' => 'Toy Store',
					'PhoneNumber' => '(310) 832-6211'
				),
				'Address' => array(
					'StreetLines' => '18115 S Main Street',
					'City' => 'Gardena',      //城市
					'StateOrProvinceCode' => 'CA',   //国家或省代码 
					'PostalCode' => '90248',  //邮编
					'CountryCode' => 'US',    //国家编号
					'Residential' => false  //居民区		
				)
			);
			return $modifiedRecipient;
		}

		/**
		 * 形成运单时
		 * 运费，添加运费付款方的信息
		 * 传入参数 付款信息   $payer  arr
		 * 返回结果 $shippingChargesPayment
		 */
		function addShippingChargesPayment($payer){
			$this->shippingChargesPayment = array(//必需。由于 FedEx 向客户提供了服务而收取的货币报酬的描述性数据。
				'PaymentType' => $payer['paymentType'],//必需。PaymentType 的有效元素为： SENDER  THIRD_PARTY   注意：需要包括 Payor/ResponsibleParty/AccountNumber 元素
		        'Payor' => array(//可选，用于指定负责支付服务费用一方的描述性数据。
					'ResponsibleParty' => array(//可选，与 FedEx 进行交易的个人或公司实体的描述性数据。
						'AccountNumber' =>$payer['account'],//可选，与此事务关联的 FedEx 帐号。
						'Contact'=>array(//付款方联系方式
									'PersonName'=>$payer['personName'],
									'CompanyName'=>$payer['companyName'],
									'PhoneNumber'=>$payer['phoneNumber']
						),
						'Address' => array(//付款方的地址
									'StreetLines' => $payer['Address_streetLines'],
									'City'=>$payer['Address_City'],
									'PostalCode'=>$payer['Address_PostalCode'],
									'CountryCode'=>$payer['Address_CountryCode']
						)
					)
				)
			);

		}
		


		//标签规格
		public function addLabelSpecification(){
			$this->labelSpecification = array(//要指定您想要接收的标签格式类型，应在 ProcessShipment 回复中包含 LabelSpecification 复杂类型元素中的各项元素（根据您的标签格式）。创建标签中提供了有关标签打印的详细信息。
				'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY //必需。指定要返回的标签类型。
				'ImageType' => 'PDF',  // valid values DPL, EPL2, PDF, ZPLII and PNG //指定标签格式
				'LabelStockType' => 'PAPER_8.5X11_TOP_HALF_LABEL'//可选。对于热敏打印机标签，此元素指出标签的大小和文件标签（如果存在）的位置。
			);

		}

		/**
		 * 清关细节
		 * @param  array   $customClearceAccount 清关账号
		 * @param  array   $customValue			 申报值/货币代码
		 * @param  array   $commpdity            货品
		 * @return array   $customerClearanceDetail
		 */
		public function addCustomClearanceDetail($customClearceAccount,$customValue,$commpdity){
			$this->customerClearanceDetail = array(//清关数据，用于国际和国内托运。
				'DutiesPayment' => array(//可选，指出要以哪种方式和途径向 FedEx 支付托运服务费用的描述性数据。
					'PaymentType' => $customClearceAccount['paymentType'], // valid values RECIPIENT, SENDER and THIRD_PARTY  指定服务费用的支付方式。
					'Payor' => array(//可选，用于指定负责支付服务费用一方的描述性数据。
						'ResponsibleParty' => array(//可选，与 FedEx 进行交易的个人或公司实体的描述性数据。
							'AccountNumber' =>$customClearceAccount['dutyaccount'],
							'Contact' => null,
							'Address' => array('CountryCode' =>$customClearceAccount['Address_CountryCode'])
						)
					)
				),
				'DocumentContent' => 'NON_DOCUMENTS',                                                                                            
				'CustomsValue' => array(//指定货品的海关申报值。
					'Currency' => $customValue['currency'], //返回的附加费金额的货币代码。
					'Amount' =>$customValue['amount']//返回的附加费金额。
				),
				'Commodities' => $commpdity,
				'ExportDetail' => array(
					'B13AFilingOption' => 'NOT_REQUIRED'//指定客户采用哪个登记选项。对于从加拿大 发往加拿大、美国、波多黎各或美属维尔京 群岛以外任何国家/地区的非文件货件是必需元素。
				)
			);
		}



		//打印所有的标签
		function printAllLabels($response){
			$packageDetails=$response->CompletedShipmentDetail->CompletedPackageDetails;
			if(is_array($packageDetails)){
				foreach($packageDetails as $packageDetail){
					$this->printLabel($packageDetail);
				}
			}else if(is_object($packageDetails)){
				$this->printLabel($packageDetails);
			}
		}

		//打印面单
		function printLabel($packageDetail){
			$labelName = $packageDetail->TrackingIds->TrackingNumber ;
			if(empty($this->main_index)){
				$this->main_index=$packageDetail->TrackingIds->TrackingNumber;
			}
					
			$label=$labelName."_".self::SHIP_LABEL;
			$fp = fopen(APPPATH.'../web/fedex/'.$label, 'wb');   
			fwrite($fp, ($packageDetail->Label->Parts->Image));
			fclose($fp);
			//echo 'Label <a href='.config_item('base_url').'/fedex/'.$label.'>'.$label."</a> was generated.<br/>\n";
		}

		//打印字符
		function printString($var, $description){
			if(!is_object($var)&&!is_array($var)){
				echo $description . ": " . $var . "<br/>\n";
			}
		}

		//打印舰单成功
		function printOpenShipSuccess($client, $response) {
		    //$this->printRequestResponse($client);
			$this->writeToLog($client);    // Write to log file
		}

		//打印仓单失败
		function printOpenShipError($client, $response){
			//$this->printNotifications($response -> Notifications);
		    //$this->printRequestResponse($client, $response);
			$this->writeToLog($client);    // Write to log file
		}


		//进程创建开放装运响应成功
		function processCreateOpenShipmentResponseSuccess($client, $response){
			//echo "Create OpenShipment was successful.<br>\n";
			//打印job Id
			//$this->printString($response->JobId, "Job Id");
			//成功后返回的托件号码
			//$this->index=$response->Index;
			//$this->printString($this->index, "Index");
			//$this->printString($response->CompletedShipmentDetail->MasterTrackingId->TrackingNumber, "Master Tracking Id");
			$this->printOpenShipSuccess($client, $response);
			return 0;
		}
		//创建开放托件失败
		function processCreateOpenShipmentResponseFailure($client, $response){
			//echo "Create OpenShipment was not successful.<br>\n";
			//echo "No other transactions will be processed.<br>\n";
			$this->printOpenShipError($client, $response);
			return 1;
		}
		

		//修改开放托件
		function buildModifyOpenShipmentRequest($index){
			$request=$this->buildTransactionDetail();
			$request['Index'] = $index;
			$request['RequestedShipment'] = array(
				'ShipTimestamp' => date('c'),
				'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER, DROP_BOX, BUSINESS_SERVICE_CENTER and STATION
				'ServiceType' => 'INTERNATIONAL_ECONOMY_FREIGHT', // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
				'PackagingType' => 'YOUR_PACKAGING', // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
				'Shipper' => $this->addShipper(),
				'Recipient' => $this->addModifiedRecipient(),
				'ShippingChargesPayment' => $this->addShippingChargesPayment(),
				'ExpressFreightDetail'=> array( 'ShippersLoadAndCount' => 3 , 'BookingConfirmationNumber' => '12345678' ),
				'CustomsClearanceDetail' => $this->addCustomClearanceDetail(), //used for international shipments
				'LabelSpecification' => $this->addLabelSpecification(),
				'RateRequestTypes' => array('LIST'), // valid values ACCOUNT and LIST    
				'PackageCount' => 2,
			);
			return $request;
		}
		//验证开放托件
		function buildValidateOpenShipmentRequest($index){
			$request=$this->request;
			$request['Index'] = $index;
			$this->request = $request;
		}

		//验证开放托件成功
		function processValidateOpenShipmentSuccess($client, $response){
			//echo "Validate OpenShipment was successful运单验证成功.<br>\n";
			$this->printOpenShipSuccess($client, $response);
			return 0;
		}

		//验证开放托件失败
		function processValidateOpenShipmentFailure($client, $response){
			//echo "Validate OpenShipment was not successful 运单验证失败.<br>\n";
			//printOpenShipFailure($client, $response);
			$this->printOpenShipError($client, $response);
			return 1 ;
		}

		//确认开放托件
		function buildConfirmOpenShipmentRequest($index){
			$request=$this->request;
			$request['Index'] = $index;
			$this->request = $request;
		}

		//确认开放托件成功
		function processConfirmOpenShipmentSuccess($client, $response){
			//echo "Confirm OpenShipment was successful确认运单成功.<br>\n";
			//$this->printString($response->JobId, "Job Id");
			$this->printOpenShipSuccess($client, $response);
			$this->printAllLabels($response);
			return 0 ;
		}

		//确认开放托件失败
		function processConfirmOpenShipmentFailure($client, $response){
			//echo "Confirm OpenShipment was not successful确认运单失败.<br>\n";
			$this->printOpenShipError($client, $response);
			return 1;
		}

		//修改开放托件成功
		function processModifyOpenShipmentSuccess($client, $response){
			echo "Modify OpenShipment was successful.<br>\n";
			$this->printString($response->JobId, "Job Id");
			$this->printOpenShipSuccess($client, $response);
		}

		//修改开放托件失败
		function processModifyOpenShipmentFailure($client, $response){
			echo "Modify OpenShipment was not successful.<br>\n";
			$this->printOpenShipError($client, $response);
		}
		//建立开放托件添加包裹请求准备
		function buildAddPackagesToOpenShipmentRequest($index){
			$request=$this->buildTransactionDetail();
			$request['Index'] = $index;
			$request['RequestedPackageLineItems'] = array(
				'0' => $this->addPackageLineItem1()
			);
			return $request;
		}
		//开放托件添加包裹请求成功
		function processAddPackageToOpenShipmentResponseSuccess($client, $response){
			echo "Adding package to OpenShipment was successful.<br>\n";
			//
			$this->printString($response->JobId, "Job Id");
			
			//包裹索引
			$this->printString($response->CompletedShipmentDetail->CompletedPackageDetails->SequenceNumber, "Package Sequence Number");
			
			//追踪号
			$this->printString($response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber, "Tracking Number");
			
			$this->printOpenShipSuccess($client, $response);
		}

		//开放托件添加包裹请求失败
		function processAddPackageToOpenShipmentResponseFailure($client, $response){
			echo "Adding package to OpenShipment was not successful.<br>\n";
			$this->printOpenShipError($client, $response);
		}


		//删除开放托件准备
		function buildDeleteOpenShipmentRequest($index){
			$request = $this->request;
			$request['Index'] = $index;	
			$this->request=$request;
		}
		//删除开放托件
		function deleteOpenShipment(){
			$this->responseDeleteOpenShipment = $this->client->deleteOpenShipment($this->request);
			if($this->isSuccess($this->client, $this->responseDeleteOpenShipment)){
				return $this->processDeleteOpenShipmentSuccess($this->client, $this->responseDeleteOpenShipment);
			}else{
				return $this->processDeleteOpenShipmentFailure($this->client, $this->responseDeleteOpenShipment);
			}
		}
		//删除开放托件成功
		function processDeleteOpenShipmentSuccess($client, $response){
			$this->printOpenShipSuccess($client, $response);
			return 0;//删除成功
		}

		//删除开放托件失败
		function processDeleteOpenShipmentFailure($client, $response){
			$this->printOpenShipSuccess($client, $response);
			return 1;//删除失败
		}


		/**
		 * 发起soap请求
		 */
		public function soapClient()
		{
			$this->client =new SoapClient($this->path_to_wsdl, array('trace' => 1));
		}

		
		/**
		 * 创建一个开发装运请求
		 */
		public function  createOpenShipment()
		{
			$this->soapClient();
			@set_time_limit(0);

			try{
				//创建请求
				$responseCreateOpenShipment=$this->client ->createOpenShipment($this->request);
				$this->request=array();
				$this->responseCreateOpenShipment= $responseCreateOpenShipment;
				$this->writeLog($this->client,$responseCreateOpenShipment);
				if($this->isSuccess($this->client,$responseCreateOpenShipment)){//请求成功
					return $this->processCreateOpenShipmentResponseSuccess($this->client, $responseCreateOpenShipment);
				}else{//创建运单失败
					return $this->processCreateOpenShipmentResponseFailure($this->client, $responseCreateOpenShipment);
					//删除运单
					//$this->deleteOpenShipment($this->client, $this->index);
				}

			}catch(SoapFault $exception){
				$this->printFault($exception, $this->client);
				return $exception;
			}

		}

		/**
		 * 验证开放运单
		 *
		 */
		public function validateOpenShipment()
		{
			$this->soapClient();
			@set_time_limit(0);
			try{
				$this->responseValidateOpenShipment = $this->client->validateOpenShipment($this->request);
				$this->request=array();
				if($this->isSuccess($this->client,$this->responseValidateOpenShipment)){
					return $this->processValidateOpenShipmentSuccess($this->client, $this->responseValidateOpenShipment);
				}else{
					return $this->processValidateOpenShipmentFailure($this->client, $this->responseValidateOpenShipment);
				}
			}catch (SoapFault $exception){
				$this->printFault($exception, $this->client);
				return $exception;
			}
			

		}


		/**
		 * 确认开放运单
		 * 
		 */
		public  function confirmOpenShipment()
		{
			$this->soapClient();
			@set_time_limit(0);
			try{
				//确认托件
				$this->responseConfirmOpenShipment = $this->client->confirmOpenShipment($this->request);
				$this->request=array();
				if($this->isSuccess($this->client,$this->responseConfirmOpenShipment)){
					return $this->processConfirmOpenShipmentSuccess($this->client, $this->responseConfirmOpenShipment);
				}else{
					return $this->processConfirmOpenShipmentFailure($this->client, $this->responseConfirmOpenShipment);
				}
			}catch(SoapFault $exception){
				$this->printFault($exception, $this->client);
			}
		}

		/**
		 * 删除运单
		 * 
		 */
		public function delete_fedex_index($arr)
		{	
			//发起请求
			$this->soapClient();
			@set_time_limit(0);
			try
			{
				//删除准备
				$this->buildTransactionDetail($arr);
				//绑定主单号
				$this->buildDeleteOpenShipmentRequest($arr['Index']);
				//返回删除结果  0 成功  1失败
				return $this->deleteOpenShipment();
			}catch(SoapFault $exception){
				$this->printFault($exception, $this->client);
			}

		}
		



	}

