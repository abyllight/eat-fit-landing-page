<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*
     * id Статусы
     *  142 => Успешно реализовано
     *  16536847 => Пробная доставка
     *  16566964 => В работе
     *  27248140 => Доставлено
     *
     *
     * */

    public $errors = [
        0   => 'Ошибка в данных',
        101 => 'Общая ошибка авторизации. Не существующий аккаунт',
        110 => 'Общая ошибка авторизации. Неправильный логин или пароль.',
        111 => 'Общая ошибка авторизации. Превышен лимит попыток',
        112 => 'Общая ошибка авторизации. Ограничение прав',
        113 => 'Общая ошибка авторизации. Доступ к данному аккаунту запрещён с Вашего IP адреса',
        202 => 'Добавление контактов: нет прав',
        203 => 'Добавление контактов: системная ошибка при работе с дополнительными полями',
        205 => 'Добавление контактов: контакт не создан',
        212 => 'Обновление контактов: контакт не обновлён',
        219 => 'Список контактов: ошибка поиска, повторите запрос позднее',
        220 => 'Добавление/Обновление контактов: количество привязанных сделок слишком большое',
        235 => 'Добавление задач: не указан тип элемента',
        236 => 'Добавление задач: по данному ID элемента не найдены некоторые контакты',
        237 => 'Добавление задач: по данному ID элемента не найдены некоторые сделки',
        244 => 'Добавление сделок: нет прав.',
        301 => 'Moved permanently',
        330 => 'Добавление/Обновление сделок: количество привязанных контактов слишком большое',
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    public function doCurl(string $link,  string $method = 'GET', array $data = []): array
    {
        $curl = curl_init();

        curl_setopt($curl,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        if (!empty($data)) {
            curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query($data));
        }
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

        $out  = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_HTTP_CODE);

        curl_close($curl);

        return [
            'code' => $code,
            'data' => $out
        ];
    }

    public function amo_auth(): array
    {
        $link = 'https://'. env('AMO_SUBDOMAIN', '') . '.amocrm.ru/private/api/auth.php?type=json';

        $user = [
            'USER_LOGIN' => env('AMO_LOGIN', ''),
            'USER_HASH'  => env('AMO_HASH', '')
        ];

        $out = $this->doCurl($link, 'POST', $user);

        $code    = (int) $out['code'];
        $data    = json_decode($out['data'], true);
        $message = 'Авторизован!';
        $status  = true;

        if (!$data['response']['auth'])
        {
            $message = array_key_exists($code, $this->errors) ? $this->errors[$code] : 'Неизвестная ошибка! Код: ' . $code;
            $status  = false;
        }

        return [
            'code'    => $code,
            'status'  => $status,
            'message' => $message,
            'data'    => $data
        ];
    }

    public function getUtm(Request $request, array $leads): array
    {
        $utm_tags = [
            [
                'tag_name' => 'utm_source',
                'tag_id' => 432407
            ],
            [
                'tag_name' => 'utm_medium',
                'tag_id' => 432409
            ],
            [
                'tag_name' => 'utm_term',
                'tag_id' => 432411
            ],
            [
                'tag_name' => 'utm_campaign',
                'tag_id' => 432415
            ],
            [
                'tag_name' => 'utm_content',
                'tag_id' => 434565
            ]
        ];

        if (!$request->has('utm')) {
            return $leads;
        }

        $utm = $request['utm'];

        foreach ($utm_tags as $tag) {
            if (array_key_exists($tag['tag_name'], $utm)) {
                $leads['add'][0]['custom_fields'][] = array(
                    'id' => $tag['tag_id'],
                    'values' => array(
                        array(
                            'value' => $utm[$tag['tag_name']],
                        )
                    ),
                );
            }
        }

        return $leads;
    }

    public function placeOrder(Request $request){
        return response()->json(true);
        $auth = $this->amo_auth();

        if (!$auth['status']) {
            return response()->json(false);
        }

        $subdomain = env('AMO_SUBDOMAIN', '');

        $name = $request['name'];

        if ($request['isPersonal']) {
            $name = $name . ' Индивидуальное меню';
        }else {
            $name = $name . ' ' . $request['title'] . ' ' . $request['day'] . ' ' . $request['promo'];
        }

        $leads['add'] = [
            [
                'name' => $name,
                'status_id' => 28039639, //Тег присвоен
                'pipeline_id' => 1783882, //Первичные продажи
                'tags' => 'Заявка с сайта',
                'custom_fields' => [
                    [
                        'id' => 478771, //Телефон
                        'values' => [
                            [
                                'value' => $request['phone']
                            ],
                        ],
                    ],
                    [
                        'id' => 320995, //Источник
                        'values' => [
                            [
                                'id' => 766689,
                                'value' => 'Сайт',
                            ]
                        ],
                    ],
                    [
                        'id' => 868945, //cid
                        'values' => [
                            [
                                'value' => $request['ga'],
                            ]
                        ],
                    ],
                ]
            ]
        ];

        $leads = $this->getUtm($request, $leads);


        $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';

        $order = $this->doCurl($link, 'POST', $leads);

        $embedded = json_decode($order['data'], true);

        if (array_key_exists('_embedded', $embedded)) {
            $lead_id = $embedded['_embedded']['items'][0]['id'];

            $add_contact['add'] = [
                [
                    'name' => $request['name'],
                    'leads_id' => [
                        $lead_id
                    ],
                    'custom_fields' => [
                        [
                            'id' => 306229,
                            'name' => $request['name'],
                            'type_id' => 8,
                            'code' => 'PHONE',
                            'values' => [
                                [
                                    'value' => $request['phone'],
                                    'enum' => '635201'
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts';
            $this->doCurl($link, 'POST', $add_contact);
        }

        $code = (int) $order['code'];

        if($code == 200 || $code == 204){
            return response()->json(true);
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
