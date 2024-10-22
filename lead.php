<?php
if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])){$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];}
if ($_REQUEST['email']) {
    error_reporting(0);
    header('Access-Control-Allow-Origin: *');

    $setting = array( 'brandUrl'=>'https://www.compressleads.com/api/signup/procform', 'ai'=>'2958170', 'ci'=>'1', 'gi'=>'156', 'fallback'=>'false', 'api_password'=>'Hnjs84n3%6', 'api_username'=>'AffiliateTest' );
    $result_data = sendLeads1($_REQUEST);
    $response = array();
    $integrationResult = explode('@@', $result_data);

    if ($integrationResult['0'] == 'ok') {
        $loginurl = $integrationResult['1'];
        $response['status'] = 'success';
        $response['success'] = 'success';
        $response['url'] = "https://marketingexpertspr.com/thankyou/?v=1&reU=".$integrationResult['1'];
        $response['autologinurl'] = "https://marketingexpertspr.com/thankyou/?v=1&reU=".$integrationResult['1'];
        $response['data'] = $integrationResult['2'];
        $response['broker_lead_id'] = $integrationResult['3'];
    } else {
        $response['status'] = 'failed';
        $response['data'] = $result_data;
        $msg=json_decode($integrationResult['2'],true);
        $response['msg'] = $msg['data'];
    }
    if(str_contains($response['msg'] , "No matching campaign based on country logic."))
        $response['msg'] = "Registration Not allowed for your Country";
    echo json_encode($response);
}

function sendLeads1($leads) {
    global $setting;
    $apiData = array(
        'email' => trim($leads['email']),
        'firstname' => trim($leads['firstname']),
        'lastname' => trim($leads['lastname']),
        'phone' => trim($leads['dialcode'].$leads['phone']),
        'userip' => trim($_SERVER['REMOTE_ADDR']),
        'password' => 'Adhjhj646b',
        'so' => $leads['funnelname'],
        'So' => $leads['funnelname'],
        'source' => $leads['source'],
        'sub' => $leads['sub'],
        'fallback'=> $setting['fallback'],
        'gi' => (trim($leads['gi']) != ''?$leads['gi']:trim($setting['gi'])),
        'ci' => (trim($leads['ci']) != ''?$leads['ci']:trim($setting['ci'])),
        'ai' => (trim($leads['ai']) != ''?$leads['ai']:trim($setting['ai']))
   );

    if ((isset($leads['MPC_1']))&&($leads['MPC_1']!='')){$apiData['MPC_1'] = $leads['MPC_1'];}
    if ((isset($leads['MPC_2']))&&($leads['MPC_2']!='')){$apiData['MPC_2'] = $leads['MPC_2'];}
    if ((isset($leads['MPC_3']))&&($leads['MPC_3']!='')){$apiData['MPC_3'] = $leads['MPC_3'];}
    if ((isset($leads['MPC_4']))&&($leads['MPC_4']!='')){$apiData['MPC_4'] = $leads['MPC_4'];}
    if ((isset($leads['MPC_5']))&&($leads['MPC_5']!='')){$apiData['MPC_5'] = $leads['MPC_5'];}
    if ((isset($leads['MPC_6']))&&($leads['MPC_6']!='')){$apiData['MPC_6'] = $leads['MPC_6'];}
    if ((isset($leads['MPC_7']))&&($leads['MPC_7']!='')){$apiData['MPC_7'] = $leads['MPC_7'];}
    if ((isset($leads['MPC_8']))&&($leads['MPC_8']!='')){$apiData['MPC_8'] = $leads['MPC_8'];}
    if ((isset($leads['MPC_9']))&&($leads['MPC_9']!='')){$apiData['MPC_9'] = $leads['MPC_9'];}
    if ((isset($leads['MPC_10']))&&($leads['MPC_10']!='')){$apiData['MPC_10'] = $leads['MPC_10'];}
    $curl_url = trim($setting['brandUrl']);
    //print_r($apiData);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $curl_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION =>  true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($apiData),
        CURLOPT_HTTPHEADER => array(
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            'Postman-Token: 577fa32f-98ca-4400-a3e8-be8de30a87f6',
            'x-api-key: 2643889w34df345676ssdas323tgc738',
            'x-trackbox-password: '.$setting['api_password'],
            'x-trackbox-username: '.$setting['api_username']
       ),
   ));

    $output1 = curl_exec($curl);
    $data1 = json_decode($output1, TRUE);
    $returnResult = false;
    if ($data1['status']) {
        $returnResult = 'ok@@'.$data1['data'].'@@'.$output1.'@@'.$data1['addonData']['data']['customerId'].'@@'.json_encode($apiData);
    } else {
        $returnResult = 'failed@@@@'.$output1.'@@@@'.json_encode($apiData);
    }
    return $returnResult;

}

?>