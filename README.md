# TrueWalletApi
for wallet.truemoney.com


วิธีใช้

$aa = new Wallet();
$aa->setUsername('');
$aa->setPassword('');
print_r(json_decode($aa->GetProfile())); 		// SHOW Profile
print_r(json_decode($aa->GetTransaction())); 	// SHOW TransactionData
