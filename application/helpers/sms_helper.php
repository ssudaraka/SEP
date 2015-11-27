<?php

include 'IntelliSMS.php';

//Required php.ini settings:
// allow_url_fopen = On
// track_errors = On



function send_sms(){
	$objIntelliSMS = new IntelliSMS();

$objIntelliSMS->Username = 'rishysr';
$objIntelliSMS->Password = 'x1304310';
    $SendStatusCollection  = $objIntelliSMS->SendMessage ( '+94716544554', 'Hello, I am here', 'ecole' );
    return $SendStatusCollection;
}