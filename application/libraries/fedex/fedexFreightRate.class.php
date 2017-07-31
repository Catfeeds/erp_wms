<?php
/*
 * fedex 获取单个费率  国际优先重货 和 国际经济重货
 */

   class fedexFreightRateClass
   {

       public $path_to_wsdl            ='';
       public $Shipper;
       public $Recipient;
       public $totalInsuredValue;
       public $shippingChargesPayment  =array();
       public $packageLineItem         =array();
       public $request                 =array();
       public $service_type='INTERNATIONAL_ECONOMY_FREIGHT';//默认国际经济服务
       public $package='YOUR_PACKAGING';//默认自定义包裹
       public $response;

       public $UserCredential;



       public function __construct()
       {
           $this->path_to_wsdl =APPPATH."libraries/fedex/wsdl//RateService_v16.wsdl";

       }


       function printSuccess($client, $response) {
           printReply($client, $response);
       }

       function printReply($client, $response){
           $highestSeverity=$response->HighestSeverity;
           printNotifications($response -> Notifications);
           printRequestResponse($client, $response);
       }

       function printRequestResponse($client){
           echo '<h2>Request</h2>' . "\n";
           echo '<pre>' . htmlspecialchars($client->__getLastRequest()). '</pre>';
           echo "\n";

           echo '<h2>Response</h2>'. "\n";
           echo '<pre>' . htmlspecialchars($client->__getLastResponse()). '</pre>';
           echo "\n";
       }

       /**
        *  Print SOAP Fault
        */
       function printFault( $client) {
           writeToLog($client);
       }

       /**
        * SOAP request/response logging to a file
        */
       function writeToLog($client){
           /**
            * __DIR__ refers to the directory path of the library file.
            * This location is not relative based on Include/Require.
            */
           if (!$logfile = fopen(__DIR__.'/fedex.log', "a"))
           {
               error_func("Cannot open ".__DIR__.'/fedex.log' . " file.\n", 0);
               exit(1);
           }
           fwrite($logfile, sprintf("\r%s:- %s",date("D M j G:i:s T Y"), $client->__getLastRequest(). "\r\n" . $client->__getLastResponse()."\r\n\r\n"));
       }

       /**
        * This section provides a convenient place to setup many commonly used variables
        * needed for the php sample code to function.
        */
       function getProperty($var){
           if($var == 'key') Return '05TG5AVXaIiSe6ZS';
           if($var == 'password') Return 'OTiF5eucYiTB0IQUvFzdFvZs2';
           if($var == 'shipaccount') Return '510087968';
           if($var == 'billaccount') Return '510087968';
           if($var == 'dutyaccount') Return '510051408';
           if($var == 'freightaccount') Return '510087020';
           if($var == 'trackaccount') Return '510051408';
           if($var == 'dutiesaccount') Return 'XXX';
           if($var == 'importeraccount') Return 'XXX';
           if($var == 'brokeraccount') Return 'XXX';
           if($var == 'distributionaccount') Return 'XXX';
           if($var == 'locationid') Return 'PLBA';
           if($var == 'printlabels') Return false;
           if($var == 'printdocuments') Return true;
           if($var == 'packagecount') Return '4';

           if($var == 'meter') Return '118756395';

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

           if($var == 'shipper') Return array(
               'Contact' => array(
                   'PersonName' => 'Sender Name',
                   'CompanyName' => 'Sender Company Name',
                   'PhoneNumber' => '1234567890'
               ),
               'Address' => array(
                   'StreetLines' => array('Address Line 1'),
                   'City' => 'Collierville',
                   'StateOrProvinceCode' => 'TN',
                   'PostalCode' => '38017',
                   'CountryCode' => 'US',
                   'Residential' => 1
               )
           );
           if($var == 'recipient') Return array(
               'Contact' => array(
                   'PersonName' => 'Recipient Name',
                   'CompanyName' => 'Recipient Company Name',
                   'PhoneNumber' => '1234567890'
               ),
               'Address' => array(
                   'StreetLines' => array('Address Line 1'),
                   'City' => 'Herndon',
                   'StateOrProvinceCode' => 'VA',
                   'PostalCode' => '20171',
                   'CountryCode' => 'US',
                   'Residential' => 1
               )
           );

           if($var == 'address1') Return array(
               'StreetLines' => array('10 Fed Ex Pkwy'),
               'City' => 'Memphis',
               'StateOrProvinceCode' => 'TN',
               'PostalCode' => '38115',
               'CountryCode' => 'US'
           );
           if($var == 'address2') Return array(
               'StreetLines' => array('13450 Farmcrest Ct'),
               'City' => 'Herndon',
               'StateOrProvinceCode' => 'VA',
               'PostalCode' => '20171',
               'CountryCode' => 'US'
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

       function setEndpoint($var){
           if($var == 'changeEndpoint') Return false;
           if($var == 'endpoint') Return 'XXX';
       }

       function printNotifications($notes){
           foreach($notes as $noteKey => $note){
               if(is_string($note)){
                   echo $noteKey . ': ' . $note . Newline;
               }
               else{
                   printNotifications($note);
               }
           }
           echo Newline;
       }

       function printError($client, $response){
           printReply($client, $response);
       }

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


       public function addRecipient($reci){
           $recipient = array(
               'Contact' => array(
                   'PersonName' =>  $reci['personName'],
                   'CompanyName' => $reci['companyName'],
                   'PhoneNumber' => $reci['phoneNumber']
               ),
               'Address' => array(
                   'StreetLines' => $reci['Address_streetLines'],
                   'City' => $reci['Address_City'],
                   'StateOrProvinceCode' => $reci['Address_StateOrProvinceCode'],
                   'PostalCode' => $reci['Address_PostalCode'],
                   'CountryCode' =>$reci['Address_CountryCode'],
                   'Residential' =>$reci['Address_Residential']
               )
           );
           $this->Recipient = $recipient;
       }


       function addFreightShipper($shipper)
       {
           $Shipper=array(
                'Contact'=>array(
                    'ContactId' => 'freight1',
                    'PersonName' => $shipper['personName'],
                    'Title' => 'Manager',
                    'CompanyName' =>  $shipper['companyName'],
                    'PhoneNumber' => $shipper['phoneNumber']
                ),
                'Address'=>array(
                    'StreetLines'=>array(
                        '1202 Chalet Ln',
                        'Do Not Delete - Test Account'
                    ),
                    'City' =>$shipper['Address_City'],
                    'StateOrProvinceCode' => $shipper['Address_StateOrProvinceCode'],
                    'PostalCode' => $shipper['Address_PostalCode'],
                    'CountryCode' => $shipper['Address_CountryCode']
                )
            );
           $this->Shipper=$Shipper;
       }
       public function addShippingChargesPayment($payer){
           $shippingChargesPayment = array(
               'PaymentType' => $payer['paymentType'], // valid values RECIPIENT, SENDER and THIRD_PARTY
               'Payor' => array(
                   'ResponsibleParty' => array(
                       'AccountNumber' => $payer['account'],
                       'CountryCode' => $payer['Address_CountryCode']
                   )
               )
           );
           $this->shippingChargesPayment = $shippingChargesPayment;
       }

       public function createFedexFreightRateRequest()
       {

           $request['WebAuthenticationDetail'] = array(
               'UserCredential' =>array(
                   'Key' => $this->UserCredential['Key'],
                   'Password' =>$this-> UserCredential['Password']
               )
           );
           $request['ClientDetail'] = array(
               'AccountNumber' => $this->UserCredential['AccountNumber'],
               'MeterNumber' => $this->UserCredential['MeterNumber']
           );
           $request['TransactionDetail'] =array('CustomerTransactionId' => $this->UserCredential['CustomerTransactionId'] );
           $request['Version'] = array(
               'ServiceId' => 'crs',
               'Major' => '16',
               'Intermediate' => '0',
               'Minor' => '0'
           );
           $request['ReturnTransitAndCommit'] = true;
           $request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
           $request['RequestedShipment']['ShipTimestamp'] = date('c');
           $request['RequestedShipment']['ServiceType'] = $this->service_type; // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
           $request['RequestedShipment']['PackagingType'] = $this->package; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
           $request['RequestedShipment']['Shipper'] = $this->Shipper;
           $request['RequestedShipment']['Recipient'] = $this->Recipient;
           $request['RequestedShipment']['ShippingChargesPayment'] = $this->shippingChargesPayment;


          
           $request['RequestedShipment']['FreightShipmentDetail'] = array(
               'FedExFreightAccountNumber' => $this->Shipper,
               'FedExFreightBillingContactAndAddress' =>$this->UserCredential['AccountNumber'],
               'PrintedReferences' => array(
                   'Type' => 'SHIPPER_ID_NUMBER',
                   'Value' => 'RBB1057'
               ),
               'Role' => 'SHIPPER',
               'PaymentType' => 'PREPAID',
               'CollectTermsType' => 'STANDARD',
               'DeclaredValuePerUnit' => array(
                   'Currency' => 'USD',
                   'Amount' => 50
               ),
               'LiabilityCoverageDetail' => array(
                   'CoverageType' => 'NEW',
                   'CoverageAmount' => array(
                       'Currency' => 'USD',
                       'Amount' => '50'
                   )
               ),
               'TotalHandlingUnits' => 15,
               'ClientDiscountPercent' => 0,
               'PalletWeight' => array(
                   'Units' => 'LB',
                   'Value' => 20
               ),
               'ShipmentDimensions' => array(
                   'Length' => 90,
                   'Width' => 30,
                   'Height' => 50,
                   'Units' => 'IN'
               ),
               'LineItems' => array(
                   'FreightClass' => 'CLASS_050',
                   'ClassProvidedByCustomer' => false,
                   'HandlingUnits' => 15,
                   'Packaging' => 'PALLET',
                   'BillOfLaddingNumber' => 'BOL_12345',
                   'PurchaseOrderNumber' => 'PO_12345',
                   'Description' => 'Heavy Stuff',
                   'Weight' => array(
                       'Value' => 50.0,
                       'Units' => 'LB'
                   ),
                   'Dimensions' => array(
                       'Length' => 90,
                       'Width' => 30,
                       'Height' => 50,
                       'Units' => 'IN'
                   ),
                   'Volume' => array(
                       'Units' => 'CUBIC_FT',
                       'Value' => 30
                   )
               )
           );
           $request['RequestedShipment']['PackageCount'] = '1';

           $this->request=$request;
       }

       public  function getFreightRate()
       {

           //The WSDL is not included with the sample code.
           //Please include and reference in $path_to_wsdl variable.
           $path_to_wsdl = $this->path_to_wsdl;

           ini_set("soap.wsdl_cache_enabled", "0");

           $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information
           try {

               $response = $client -> getRates($this->request);
               $this->response =$response;
               $this->writeToLog($client);// Write to log file
               if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){

                   return 0;//成功
               }else{
                   return  1;//失败
               }

           } catch (SoapFault $exception) {
               $this->writeToLog($client);
           }
       }
   }