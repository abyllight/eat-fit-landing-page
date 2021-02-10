<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function amo_query($array){
        $subdomain = env('AMO_SUBDOMAIN', '');
        $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($array));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $out = curl_exec($curl);
        $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);

        if($code == 200 || $code == 204){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function placeOrder(Request $request){
        $link = 'https://'. env('AMO_SUBDOMAIN', '') .'.amocrm.ru/private/api/auth.php?type=json';
        $user = [
            'USER_LOGIN' => env('AMO_LOGIN', ''),
            'USER_HASH' => env('AMO_HASH', '')
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($user));
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

        $out = curl_exec($curl);

        $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);

        $name_keys = ['utm_source', 'utm_campaign', 'utm_medium', 'utm_term', 'utm_content'];

        $query = $_SERVER['QUERY_STRING'];

        if($query || $query !== '') {
            $array = [];
            parse_str($query, $array);
        }

        if($code == 200 || $code == 204){
            if ($request['isPersonal'] === false){
                $leads['add']=array(
                    array(
                        'name'=>$request['name'].' '.$request['title'].' '.$request['day'].' '.$request['promo'],
                        'custom_fields'=>array(
                            array(
                                'id'=>478771,
                                'values'=>array(
                                    array(
                                        'value'=>$request['phone'],
                                    ),
                                ),
                            ),
                            array(
                                'id'=>320995,
                                'values'=>array(
                                    array(
                                        'id'=>766689,
                                        'value'=>'Сайт',
                                    )
                                ),
                            ),
                        ),
                    ));
                return $this->amo_query($leads);
            }else{
                $leads['add']=array(
                    array(
                        'name'=>$request['name'].' Индивидуальное меню',
                        'custom_fields'=>array(
                            array(
                                'id'=>478771,
                                'values'=>array(
                                    array(
                                        'value'=>$request['phone'],
                                    ),
                                ),
                            ),
                            array(
                                'id'=>320995,
                                'values'=>array(
                                    array(
                                        'id'=>766689,
                                        'value'=>'Сайт',
                                    )
                                ),
                            ),
                        ),
                    ));
                return $this->amo_query($leads);
            }
        }else{
            return response()->json(false);
        }
    }

    public function placeCartOrder(Request $request){
        $total = array();
        $products = '';

        foreach ($request['cart'] as $item){
            $total[] += (int) $item['total'];
        }

        $t = array_reduce($total, function ($carry, $item){
            $carry += $item;
            return $carry;
        });

        foreach ($request['cart'] as $item){
            $products .= ' '. $item['title'].' - '.$item['q'].', ';
        }

        $link = 'https://'.env('AMO_SUBDOMAIN', '').'.amocrm.ru/private/api/auth.php?type=json';
        $user = [
            'USER_LOGIN' => env('AMO_LOGIN', ''),
            'USER_HASH' => env('AMO_HASH', '')
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($user));
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

        $out = curl_exec($curl);

        $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);

        if($code == 200 || $code == 204){
            $leads['add']=array(
                array(
                    'name' => $request['name'].' Бюджет- '.$t.'тг.',
                    'custom_fields'=>array(
                        array(
                            'id'=>478771,
                            'values'=>array(
                                array(
                                    'value'=>$request['phone'],
                                ),
                            ),
                        ),
                        array(
                            'id'=>478763,
                            'values'=>array(
                                array(
                                    'value' => $request['address'],
                                ),
                            ),
                        ),
                        array(
                            'id'=>321277,
                            'values'=>array(
                                array(
                                    'value' => $products,
                                ),
                            ),
                        ),
                        array(
                            'id'=>320995,
                            'values'=>array(
                                array(
                                    'id' => 766689,
                                    'value' => 'Сайт',
                                )
                            ),
                        ),
                    ),
                ));
            return $this->amo_query($leads);
        }else{
            return response()->json(false);
        }
    }
}
