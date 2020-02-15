<?php 
    Class ml_booking{
        function ml_api(){
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://api.jsonbin.io/b/5c52a1be15735a25423d3540");
                curl_setopt($curl, CURLOPT_ENCODING, "");
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 60);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); 
                curl_setopt($curl, CURLOPT_GSSAPI_DELEGATION, CURLGSSAPI_DELEGATION_FLAG);    
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_GSSNEGOTIATE);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $expert = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $respone = json_decode($expert, true);
            return $respone;
        }
    }
?>