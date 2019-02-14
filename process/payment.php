<?php
	// following files need to be included
	include("../Razorpay.php");
	include("config.php");
	use Razorpay\Api\Api;

	$api = new Api(MID, SECRET_KEY);

	// Orders
	//$response = array();
	
	$paramList['paymentId'] = '';
	foreach($_GET as $key=>$value){  
		$paramList[$key] = $value;
	}
	if($paramList['paymentId'] != ''){
		// Payments
		//$payments = $api->payment->all(); 											// Returns array of payment objects
		$payment  = $api->payment->fetch($paramList['paymentId']); 					// Returns a particular payment
		//$payment  = $api->payment->fetch($paramList['paymentId'])->capture(array('amount'=>$amount)); 
																						// Captures a payment
		//print_r($order);
		//print_r($payment);

		$response['result'] = "success";
		$test = array();
		foreach($payment as $key=>$value){  
			if($value == null){
				$test[$key] = '';
			}else {
				$test[$key] = $value;
			}
		}
		$response['paymentDetails'] = $test;
		//$response['order']['orderId'] = isset($order['id']) ? $order['id'].'' : '';
		//$response['order']['amount'] = isset($order['amount']) ? $order['amount'].'' : '';
		//$response['order']['amountPaid'] = isset($order['amount_paid']) ? $order['amount_paid'].'' : '';
		//$response['order']['amountDue'] = isset($order['amount_due']) ? $order['amount_due'].'' : '';
		//$response['order']['currency'] = isset($order['currency']) ? $order['currency'].'' : '';
		//$response['order']['receipt'] = isset($order['receipt']) ? $order['receipt'].'' : '';
		//$response['order']['offerId'] = isset($order['offer_id']) ? $order['offer_id'].'' : '';
		//$response['order']['status'] = isset($order['status']) ? $order['status'].'' : '';
		//$response['order']['attempts'] = isset($order['attempts']) ? $order['attempts'].'' : '';
			
	}else{
		$response['result'] = "failed";
		$response['message'] = "receiptId, amount, currency is mandatory field";
	}
	echo json_encode($response);

?>