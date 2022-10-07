<?php
 /* Send an SMS using this aplication. You can run this file 3 different ways:
     *
     *    Download a local server like WAMP, MAMP or XAMPP. Point the web root
     *    directory to the folder containing this file, and load
     *    localhost:8888/client.php in a web browser.
   */

// include the Sms class
    include_once 'Sms.php';
    class MainSms
    {
        public function call()
        {
            //instantiate a new Sms Rest Client with argument api,senderID,base_URL.
            $sms     = new Sms('Ae1fddd8783f7323fdd22bf035f789c2a', 'ALVASF', 'https://api-alerts.kaleyra.com/v1/?api_key=Ae1fddd8783f7323fdd22bf035f789c2a');
            $dlr_url = '<Delivered_Trigger_URL>?sent={sent}&delivered={delivered}&msgid={msgid}&sid={sid}&status={status}&reference={reference}&custom1={custom1}&custom2={custom2}';

            $arr = array_fill(0, 40, 0);
            // $a = array_fill(0)
            $obj = $sms->sendSms('7892448120', 
            'NOTICE Hello all Just a test Don\'t mind me-ALVAS');

            /*$xml="<?xml version='1.0' encoding='UTF-8'?><xmlapi>
            	<sender>RRRRRR</sender>
            	<message>xml test</message>
            	<unicode>1</unicode>
            	<flash>1</flash>
            	<campaign>xml test</campaign>
            	<dlrURL><![CDATA[http://example.php?sent={sent}&delivered={delivered}&msgid={msgid}&sid={sid}&status={status}&reference={reference}&custom1={custom1}&custom2={custom2}&credits={credits}]]></dlrURL>
            	<sms><to><Mobile_Number></to><custom>22</custom><custom1>99</custom1><custom2>988</custom2></sms>
            	<sms><to><Mobile_Number></to><custom>229</custom><custom1>995</custom1><custom2>98</custom2></sms>
            </xmlapi>";
            $obj = $sms->sendSmsUsingXmlApi($xml,['formate'=>'json']);*/

            /*$json = "{\"message\": \"test json\",
             \"sms\": [{
             	\"to\": \"<Mobile_Number>\",
             	\"msgid\": \"1\",\"message\": \"test json\",
             	\"custom1\": \"11\",
             	\"custom2\": \"22\",
             	\"sender\": \"RRRRRR\"
             	 },
             	 {
             	 	\"to\": \"<Mobile_Number>\",
             	 	 \"msgid\": \"2\",
             	 	 \"custom1\": \"1\",
             	 	 \"custom2\": \"2\"   }],
             	 	 \"unicode\": 1,
             	 	 \"flash\": 1,
             	 	 \"dlrurl\": \"<Delivered_Trigger_URL>?referenceid={reference}%26status={status}%26delivered={delivered}%26messageid={messageid}%26customid1={custom1}%26customid2={custom2}%26senttime={senttime}%26reference={reference}%26message={message}\"
             }";
            $obj = $sms->sendSmsUsingJsonApi($json,['formate'=>'json']);*/

            //$obj = $sms->smsStatusPull("xxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:1",['formate'=>'json']);

            // $obj = $sms->smsStatusPush("8970284736","hi......",$dlr_url);

            /*$obj = $sms->smsToOptinGroup("hello","tipusultan",['time'    => '2017-06-11 11:17:55 AM',
                'unicode' => '1',
                'flash' => '1',
                'formate'=>'json']);
            */

            //$obj = $sms->addContactsToGroup("RRRRRR","<Mobile_Number>",['fullname'=>'abc','formate'=>'json']);

            //$obj = $sms->sendMessageToGroup("helloo testing","<Sender ID>","<Mobile_Number>");

            //$obj = $sms->editSchedule("2017-09-23 11:17:55 AM","<Mobile_Number>",['formate'=>'json']);

            //$obj = $sms->deleteScheduledSms("<Mobile_Number>",['formate'=>'json']);

            //$obj = $sms->creditAvailabilityCheck(['formate'=>'json']);

            //$obj = $sms->SILookup('<Mobile_Number>', ['format' => 'json']);

            //$obj = $sms->createtxtly("https://in.yahoo.com",['format' => 'json']);

            //$obj = $sms->deletetxtly("205",['format' => 'json']);

            //$obj = $sms->txtlyReportExtract(['format' => 'json']);
            //$obj = $sms->pullLogForIndividualtxtl("223",['format' => 'json']);

            //$obj = $sms->smsStatusPull('msg-Id');

            echo '<pre>';
            print_r($obj);
        }
    }
    $main = new MainSms();
    $main->call();
