<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class Test extends MY_Controller
{
	public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
	}

	public function test1()
	{

		//加载类库
		$this->load->library('CI_Fedex'); 
		//绑定交易信息详情
		$CustomerTransactionId= array(
			'CustomerTransactionId' => '201611120002'
		);
		$this->ci_fedex->buildTransactionDetail($CustomerTransactionId);

		//绑定发件人信息
		$shiper = array(
			'personName' => 'Jason.Cui',
			'companyName' => 'Toy Store',
			'phoneNumber' => '(310) 832-6211',
			'Address_streetLines' =>'18115 S Main Street',
			'Address_City' => 'Gardena',
			'Address_StateOrProvince' => 'CA',
			'Address_PostalCode' => '90248',
			'Address_CountryCode' => 'US'
		);
		$this->ci_fedex->addShipper($shiper);

		//绑定收件人信息
		$reci = array(
			'personName' => 'Per pan',
			'companyName' => 'FedEx Express',
			'phoneNumber' => '22193999',
			'Address_streetLines' =>'Warehouse B, No.628 Sui Ning Road',
			'Address_City' => 'Shanghai',
			'Address_StateOrProvince' => 'SH',
			'Address_PostalCode' => '201106',
			'Address_CountryCode' => 'CN',
			'Address_Residential' =>false
		);
		$this->ci_fedex->addRecipient($reci);

		//设置运费信息
		$payer = array(
			'paymentType'=>'SENDER',
			'billaccount' => '510087968',
			'personName' => 'Jason.Cui',
			'companyName' => 'Toy Store',
			'phoneNumber' => '(310) 832-6211',
			'Address_streetLines' =>'18115 S Main Street',
			'Address_City' => 'Gardena',
			'Address_StateOrProvince' =>'CA',
			'Address_PostalCode' => '90248'

		);
		$this->ci_fedex->addShippingChargesPayment($payer);

		//设置标签信息
		$this->ci_fedex->addLabelSpecification();

		//设置清关信息
		$customClearceAccount = array(
			'paymentType' => 'SENDER',
			'dutyaccount' => '510051408',
			'Address_CountryCode' => 'CA'
		);
		$customValue = array(
			'currency'	=>'USD',
			'amount' =>125.00
         

		);
		$commdity = array(
			'0' => array(
				'NumberOfPieces' => 1,//必须，货品的件数
				'Description' => "Men's 100% Polyester Knitted Jacket",//货品的完整描述
				'CountryOfManufacture' => 'CN',//必须，指定制造货品的国家/地区。
				'Weight' => array(//货品的装量
					'Units' => 'KG', //重量单位
					'Value' => 50   //重量数量
				),
				'Quantity' => 5,   //数量
				'QuantityUnits' => 'PCS',//用于表示此货品行项目数量的度量单位。
				'UnitPrice' => array(//可选，每个数量单位的值。包含六个显式小数位，最大长度是 18（包括小数点）。
					'Currency' => 'USD',
					'Amount' => 25.00
				),
				'CustomsValue' => array(//指定货品的海关申报值。
					'Currency' => 'USD',
					'Amount' => 125.00
				)
			),
			'1' => array(
				'NumberOfPieces' => 1,
				'Description' => "Men's 80% Nylon 20% Spandex Knitted Short.",
				'CountryOfManufacture' => 'IN',
				'Weight' => array(
					'Units' => 'KG',
					'Value' => 50
				),
				'Quantity' => 5,
				'QuantityUnits' => 'PCS',
				'UnitPrice' => array(
					'Currency' => 'USD',
					'Amount' => 15.00
				),
				'CustomsValue' => array(
					'Currency' => 'USD',
					'Amount' => 75.00
				)
			),
			'2' => array(
				'NumberOfPieces' => 1,
				'Description' => "Ladies' 50% Wool 25% Nylon 25% Elite Knitted Gloves.",
				'CountryOfManufacture' => 'IN',
				'Weight' => array(
					'Units' => 'KG',
					'Value' => 100
				),
				'Quantity' => 5,
				'QuantityUnits' => 'PCS',
				'UnitPrice' => array(
					'Currency' => 'USD',
					'Amount' => 9.00
				),
				'CustomsValue' => array(
					'Currency' => 'USD',
					'Amount' => 45.00
				)
			)
		);
		$this->ci_fedex->addCustomClearanceDetail($customClearceAccount,$customValue,$commdity);

		//设置包裹数量
		$this->ci_fedex->packageNum = 2;

		//设置包裹描述
		$package = array(//必须，定义要添加的包裹的元素
			'SequenceNumber'=>1, //货件中包裹的序列号，如果此包裹是4个包裹中的第2个，则此值为2
			'GroupPackageCount'=>1,//可选。仅与单个包裹配合使用，作为每个请求包裹的唯一标识符。添加或删除包裹时，将在货件级别进行调整
			'Weight' => array(//必需。适用于单个包裹和包裹组。
				'Value' => 200,
				'Units' => 'KG'
			),
			'Dimensions' => array(//可选。此包裹的尺寸，以及用于计量的单位类型。
				'Length' => 302,
				'Width' => 200,
				'Height' => 178,
				'Units' => 'CM'
			),
			'CustomerReferences' => array(//可选。指定有关关联货件的附加客户参考数据。
				// valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
				'0' => array(
					'CustomerReferenceType' => 'CUSTOMER_REFERENCE', //可选。此元素中最多接受 40 个字符。此元素允许在托运标签上打印客户定义的备注。对于 RMA 编号，请使用以下值：
					'Value' => 'Business Order #0001'
				),
				'1' => array(
					'CustomerReferenceType' => 'INVOICE_NUMBER',
					'Value' => 'INV#1234567890'
				),
				'2' => array(
					'CustomerReferenceType' => 'P_O_NUMBER',
					'Value' => 'PO1234'
				)
			)
		);
		$this->ci_fedex->requestedPackageLineItems =array();
		$this->ci_fedex->requestedPackageLineItems[0]= $package;

		//创建运单所需信息
		$this->ci_fedex->buildCreateOpenShipmentRequest();

		echo '<pre>';
		print_r($this->ci_fedex->request);

		//创建运单
		$this->ci_fedex->createOpenShipment();

		//验证运单
		//$this->ci_fedex->validateOpenShipment();

	
	}

	public function test2()
	{
		if(!empty($_POST)){
			$this->load->model('Base_Test_model');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username',
				array(
					'required',
					array('valid_username',array($this->Base_Test_model,'valid_username'))
				));
			$this->form_validation->set_rules('password', 'Password', 'required', array('required' => '密码不恁为空.'));
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->ci_smarty->assign('info',validation_errors());
			}
			else
			{
				$this->ci_smarty->assign('info','验证成功');
			}
		}

		$this->ci_smarty->display('test2.html');
	}


	public function test3()
	{
		//加载类库
		$this->load->library('CI_FedexRate');

		$this->ci_fedexrate->getRate();
	}
} 
