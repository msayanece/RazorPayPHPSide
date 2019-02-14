<?php
	// following files need to be included
	include("../Razorpay.php");
	include("config.php");
	use Razorpay\Api\Api;

	$api = new Api(MID, SECRET_KEY);

	// Orders
	//$response = array();
	
	$paramList['receiptId'] = '';
	$paramList['amount']   	= '';
	$paramList['currency'] 	= '';
	foreach($_POST as $key=>$value){  
		$paramList[$key] = $value;
	}
	if($paramList['receiptId'] != '' && $paramList['amount'] != '' && $paramList['currency'] != '' ){
		$order  = $api->order->create					// Creates order
			(array(
				'receipt' => $paramList['receiptId'], 
				'amount' => $paramList['amount'], 
				'currency' => $paramList['currency']
				)
			);

		//$order  = $api->order->fetch($order['id']); 					// Returns a particular order
		//$orders = $api->order->all($options); 						// Returns array of order objects
		//$payments = $api->order->fetch($order['id'])->payments(); 	// Returns array of payment objects against an order

		//print_r($order);
		//print_r($payment);

		$response['result'] = "success";
		$response['order']['orderId'] = isset($order['id']) ? $order['id'].'' : '';
		$response['order']['amount'] = isset($order['amount']) ? $order['amount'].'' : '';
		$response['order']['amountPaid'] = isset($order['amount_paid']) ? $order['amount_paid'].'' : '';
		$response['order']['amountDue'] = isset($order['amount_due']) ? $order['amount_due'].'' : '';
		$response['order']['currency'] = isset($order['currency']) ? $order['currency'].'' : '';
		$response['order']['receipt'] = isset($order['receipt']) ? $order['receipt'].'' : '';
		$response['order']['offerId'] = isset($order['offer_id']) ? $order['offer_id'].'' : '';
		$response['order']['status'] = isset($order['status']) ? $order['status'].'' : '';
		$response['order']['attempts'] = isset($order['attempts']) ? $order['attempts'].'' : '';	
	}else{
		$response['result'] = "failed";
		$response['message'] = "receiptId, amount, currency is mandatory field";
	}
	echo json_encode($response);

?>