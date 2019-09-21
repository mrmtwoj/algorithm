<?php
function encrypt_decrypt($action, $string) {
	global $site;

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key 	= "3dba4af7a5c9e8c9f1efc34e2af5a908";
    $secret_iv 		= md5($secret_key);
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

$var_orginal 	= "welcome";
$var_encode 	= encrypt_decrypt("encrypt", $var_orginal);
$var_decode 	= encrypt_decrypt("decrypt", $var_encode);
echo "Encode : {$var_encode}";
echo "<br /><br />Decode : {$var_decode}";
?>
