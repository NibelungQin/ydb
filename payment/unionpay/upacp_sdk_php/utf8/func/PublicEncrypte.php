<?php
function EncryptedPin($sPin, $sCardNo, $sPubKeyURL)
{
    global $log;
    $sPubKeyURL = trim(SDK_ENCRYPT_CERT_PATH, " ");
    $fp = fopen($sPubKeyURL, "r");
    if ($fp != null) {
        $sCrt = fread($fp, 8192);
        fclose($fp);
    }
    $sPubCrt = openssl_x509_read($sCrt);
    if ($sPubCrt === false) {
        print("openssl_x509_read in false!");
        return (-1);
    }
    $sPubKey = openssl_x509_parse($sPubCrt);

    $sInput = Pin2PinBlockWithCardNO($sPin, $sCardNo);
    if ($sInput == 1) {
        print("Pin2PinBlockWithCardNO Error ! : " . $sInput);
        return (1);
    }
    $iRet = openssl_public_encrypt($sInput, $sOutData, $sCrt, OPENSSL_PKCS1_PADDING);
    if ($iRet === true) {
        $sBase64EncodeOutData = base64_encode($sOutData);
        return $sBase64EncodeOutData;
    } else {
        print("openssl_public_encrypt Error !");
        return (-1);
    }
}


