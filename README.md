# TrueWalletApi
for wallet.truemoney.com


วิธีใช้

- $aa = new Wallet();
- $aa->setUsername('');                         // Set Username
- $aa->setPassword('');                         // Set Password
- print_r(json_decode($aa->GetProfile())); 		  // SHOW Profile
- print_r(json_decode($aa->GetTransaction())); 	// SHOW TransactionData
