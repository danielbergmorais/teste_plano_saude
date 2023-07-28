<?php
function encrypt($input) {
    $ciphering_value = "AES-128-CTR";  
    $encryption_key = "a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3"; 
    return  openssl_encrypt($input, $ciphering_value, $encryption_key);  
}
function decrypt ($input) {
    $ciphering_value = "AES-128-CTR";  
    $decryption_key = "a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3"; 
    return openssl_decrypt($input, $ciphering_value, $decryption_key);   
 }

