<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 22/11/2020 - 13:26
 */

namespace Kernel\Classes\Payment\Payu;


use Kernel\Classes\DataOperations\JSON;
use Kernel\Classes\Security\Restrictions;

class OAuth
{

    //curl -X POST https://secure.payu.com/pl/standard/user/oauth/authorize \
    //-d 'grant_type=client_credentials&client_id=145227&client_secret=12f071174cb7eb79d4aac5bc2f07563f'
    public function doAuth(){
        $json = new JSON();
        JSON::setJsonHeader();
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => Restrictions::PAYU_CLIENT_ID,
            'client_secret' => Restrictions::PAYU_CLIENT_SECRET
        );
        $query = http_build_query($data, '', '&');

        $curlConn = curl_init(Restrictions::PAYU_AUTH_LINK);
        curl_setopt($curlConn, CURLOPT_POSTFIELDS, $query);
        curl_setopt($curlConn, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curlConn, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curlConn);
        curl_close($curlConn);
        return json_decode($response)->access_token;
    }
    public function doOrder(){

        $token = $this->doAuth();

        $headers =  array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $token
        );
        $data = array(
            "customerIp"=>"127.0.0.1",
            "merchantPosId"=>Restrictions::PAYU_POSID,
            "customerIp"=>"DEMO ORDER 1",
            "currencyCode"=>"PLN",
            "totalAmount"=>"21000",
            "products"=>array(
                "name"=>"beginer packet",
                "unitPrice"=>"21000",
                "quantity"=>"1"
            )
        );
        $query = http_build_query($data, '', '&');
        $curlConn = curl_init(Restrictions::PAYU_AUTH_LINK);
        curl_setopt($curlConn, CURLOPT_HEADER, false);
        curl_setopt($curlConn, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlConn, CURLOPT_POSTFIELDS, $query);
        curl_setopt($curlConn, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curlConn, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curlConn);
        curl_close($curlConn);
        echo $response;
    }
}