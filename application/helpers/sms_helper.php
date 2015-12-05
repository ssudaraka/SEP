<?php

include 'IntelliSMS.php';

function send_sms(){
	// Initialize the SMS Library
	$objIntelliSMS = new IntelliSMS();

	// Set your username and passsword
	$objIntelliSMS->Username = 'rishysr';
	$objIntelliSMS->Password = 'x1304310';

	//Send end SMS
    $SendStatusCollection  = $objIntelliSMS->SendMessage ( '+94716544554', 'Hello, I am here', 'ecole' );
    // Return the status
    return $SendStatusCollection;
}