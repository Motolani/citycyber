<?php
    namespace App\Http\Controllers\Helpers;

    use App\Http\Controllers\Controller;

    class CurlClass extends Controller {

     public static function curlApi($body, $url, $method)
     {
            # code...


                     $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                    CURLOPT_SSL_VERIFYPEER=> false,
                    CURLOPT_SSL_VERIFYHOST=> false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS =>$body,
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/x-www-form-urlencoded",
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);


                    return $response;



     }
    }
