<?php
namespace App\Http\Libraries;
use Response;
class Requestor{

    public static function set_curl_bridging($url, $params, $method='post', $consID, $secretKey, $headers=null, $buildQuery=true)
    {
        date_default_timezone_set('UTC');
        $stamp      = strval(time()-strtotime('1970-01-01 00:00:00'));
        $data       = $consID.'&'.$stamp;

        $signature = hash_hmac('sha256', $data, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $key = $consID.$secretKey.$stamp;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            // CURLOPT_PORT => $port,
            CURLOPT_URL  => $url,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
            CURLOPT_HTTPHEADER => array(
                                  "cache-control: no-cache",
                                  "x-cons-id: ".$consID,
                                  "x-signature: ".$encodedSignature,
                                  "x-timestamp: ".$stamp."",
                                  // "user_key:179746f8121268b94e6c5d6832ca77a3",
                                  "user_key:47a01d26e0039db252f0004b0b996ba9",

                                ),
            )
        );
        if($method != 'GET'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
        }
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
            $respon = json_decode($response,true);
            if ($respon != NULL) {
                $string = json_encode($respon['response']);
                // FUNGSI DECRYPT
                $encrypt_method = 'AES-256-CBC';
                // hash
                $key_hash = hex2bin(hash('sha256', $key));
                // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
                return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
            }else{
                return "Data Tidak Ada";
            }
        }
    }
    public static function set_curl_bridging_meta($url, $params, $method='post', $consID, $secretKey, $headers=null, $buildQuery=true)
    {
        date_default_timezone_set('UTC');
        $stamp      = strval(time()-strtotime('1970-01-01 00:00:00'));
        $data       = $consID.'&'.$stamp;

        $signature = hash_hmac('sha256', $data, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $key = $consID.$secretKey.$stamp;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            // CURLOPT_PORT => $port,
            CURLOPT_URL  => $url,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
            CURLOPT_HTTPHEADER => array(
                                  "cache-control: no-cache",
                                  "x-cons-id: ".$consID,
                                  "x-signature: ".$encodedSignature,
                                  "x-timestamp: ".$stamp."",                                  
                                  "user_key:47a01d26e0039db252f0004b0b996ba9",
                                  // "user_key:179746f8121268b94e6c5d6832ca77a3",
                                ),
            )
        );
        if($method != 'GET'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
        }
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
            $respon = json_decode($response,true);
            if ($respon != NULL) {
                $string = json_encode($respon['response']);
                // FUNGSI DECRYPT
                $encrypt_method = 'AES-256-CBC';
                // hash
                $key_hash = hex2bin(hash('sha256', $key));
                // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
                $response = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
                         $metadata = json_encode($respon['metaData']);
                         $data = [
                             'metaData'=>$metadata,
                             'response'=>$response
                         ];
                         return $data;
            }else{
                return "Data Tidak Ada";
            }
        }
    }
}
