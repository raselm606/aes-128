<?php
// Encrypt function using AES-128
function encryptAES($plaintext, $key) {
     $cipher = "aes-128-cbc";
     $ivlen = openssl_cipher_iv_length($cipher);
     $iv = openssl_random_pseudo_bytes($ivlen);
     $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
     return base64_encode($iv . $ciphertext); // Return Base64 encoded ciphertext
}

// Decrypt function using AES-128
function decryptAES($ciphertextBase64, $key) {
    $cipher = "aes-128-cbc";
     $ciphertext = base64_decode($ciphertextBase64);
     $ivlen = openssl_cipher_iv_length($cipher);
     $iv = substr($ciphertext, 0, $ivlen);
     $ciphertext = substr($ciphertext, $ivlen);
     return openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}

// Example usage:
$plaintext = "This is a secret message."; // Replace this with user input
$key = "SecretKey123"; // Replace this with your secret key

// Encrypt the plaintext
$encrypted = encryptAES($plaintext, $key);
echo "Encrypted: $encrypted <br>";

// Decrypt the ciphertext
$decrypted = decryptAES($encrypted, $key);
echo "Decrypted: $decrypted <br>";
?>
