<?php
/*
* LAST EDIT 25/11/2016
* FREE NOT SELL
* FB: fb.me/mooos.os
*/

class Wallet {	
	private $Username = '';
	private $Password = '';
	
	public function setUsername($Username){
		$this->Username = $Username;
	}
	private function getUsername(){
		return $this->Username;
	}
	
	public function setPassword($Password){
		$this->Password = $Password;
	}
	private function getPassword(){
		return $this->Password;
	}
	
 	public function GetProfile(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/user/login');
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'email=' . $this->getUsername() . '&password=' . $this->getPassword());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie');
		curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/api/profile');
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_COOKIE, 'cookie');		
		return curl_exec($ch);
	}	
	public function GetTransaction(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/user/login');
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='. $this->getUsername() .'&password=' . $this->getPassword());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie');
		curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/v1web/api/transaction_history');
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_COOKIE, 'cookie');
		return curl_exec($ch);
	}
	public function GetTransactionInfo($TransactionID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/user/login');
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='. $this->getUsername() .'&password=' . $this->getPassword());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie');
		curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.truemoney.com/v1web/api/transaction_history_detail?reportID=' . $TransactionID);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_COOKIE, 'cookie');
		return curl_exec($ch);
	}	
}

/*
* FOR USE 
* $aa = new Wallet();
* $aa->setUsername('');
* $aa->setPassword('');
* print_r(json_decode($aa->GetProfile())); 		// SHOW Profile
* print_r(json_decode($aa->GetTransaction())); 	// SHOW TransactionData
*/

/* 
* Show Case 
* VVVVVVVVV
*/

$aa = new Wallet();
$aa->setUsername(''); 						// Set Username
$aa->setPassword(''); 						// Set Password
$Data = json_decode($aa->GetTransaction()); // Call Data

foreach($Data->data->activities as $Reports){
	if($Reports->text3En == 'creditor'){  // Only transfer to me
		$TransactionData = json_decode($aa->GetTransactionInfo($Reports->reportID));
		print_r($TransactionData->data); // Show TransactionData Msg, Phone , Time
	}	
}
?>
