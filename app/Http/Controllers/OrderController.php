<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\JsonResponse;
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

        $auth = $this->amo_auth();

        if (!$auth['status']) {
            return response()->json(false);
        }

        $subdomain = env('AMO_SUBDOMAIN', '');

        $name = $request['name'];

        if ($request['isPersonal']) {
            $name = $name . ' Индивидуальное меню';
        }else {
            $name = $name . ', ' . $request['title'] . ' - ' . $request['day'] . ' ' . $request['promo'];
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

    public function eatFitGo(Request $request): JsonResponse
    {
        $name = $request->name ?? '';
        $address = $request->address ?? '';
        $phone = $request->phone ?? '';
        $cart = $request->cart ?? [];
        $card_type = $request->payment;
        $cutlery = $request->cutlery;
        $total = $request->total + $request->delivery + $cutlery['total'];
        $wholesale = $request->wholesale ?? 0;
        $products = 'Приборы - '. $cutlery['q'] . 'шт,'.PHP_EOL;
        //872351 Мультизлаковая каша
        //872353 Творожный маффин
        //872355 Гранола с ягодой и орехом, йогурт
        //872357 Омлет "Тамагояки"
        //872359 Ролл пшеничный с курицей и яйцом
        //872361 Ролл пшеничный с лососем и яйцом
        //872363 Курица терияки и лапша удон
        //872365 Фрикасе из курицы с гречей
        //872367 Курица BBQ с картофелем
        //872369 Боул с курицей
        //872371 Поке с лососем
        //872373 Боул с тофу
        //872375 Чизкейк творожный диетический
        //872377 Сырники с ягодным соусом
        //872379 Испанский творожный пирог
        //872381 Чай "Английский завтрак"
        //872383 Чай "Венецианская ночь"
        //872385 Чай "Имбирный"
        //872387 Кофе "Турецкий"

        try {
            $amo = new \AmoCRM\Client(env('AMO_SUBDOMAIN'), env('AMO_LOGIN'), env('AMO_HASH'));

            $lead = $amo->lead;
            $lead['name'] = $name;
            $lead['status_id'] = 40592377; //Заказ поступил
            $lead['pipeline_id'] = 4359841; //EatFitGo
            $lead['tags'] = 'Заявка с сайта';
            $lead['price'] = $wholesale;

            if ($card_type === 'card') {
                $lead->addCustomField(321139, $total); //Фактический оплачено
                $lead->addCustomField(869811, '969831'); //Оплачено картой на сайте
            }elseif ($card_type === 'kaspi_pay') {
                $lead->addCustomField(869811, '968303'); //kaspi pay
            }else{
                $lead->addCustomField(869811, '968307'); //Расчетный счет
            }

            if ($cart) {
                foreach ($cart as $item) {
                    $product = Product::find($item['id']);

                    if ($product) {
                        $lead->addCustomField($product->amo_id, $item['q']); //Адрес
                    }

                    $q = $item['q'];
                    $products .= $item['title'] . ' - ' . $q;
                    if (end($cart) !== $item) {
                        $products .= ', '.PHP_EOL;
                    }
                }
            }

            $lead->addCustomField(456321, $card_type === 'cashless' ? $wholesale : $total); //Стоимость курса
            $lead->addCustomField(478771, $phone); //Телефон для звонков
            $lead->addCustomField(478763, $address); //Адрес
            $lead->addCustomField(478765, $address); //Адрес доп
            $lead->addCustomField(373971, $request->time); //Время доставки
            $lead->addCustomField(478705, $request->time); //Время доставки доп
            $lead->addCustomField(321277, $products); //Комм. кухня
            $lead->addCustomField(327953,  '929511'
            ); //Size
            $lead->addCustomField(321197,  '833911'
            ); //Type
            $id = $lead->apiAdd();

            $contact = $amo->contact;
            $contact['name'] = $name;
            $contact->setLinkedLeadsId($id);
            $contact->addCustomField(306229, [
                [$phone, '635201']
            ]);

            $contact->apiAdd();

            return response()->json('Success');
        }catch (\AmoCRM\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
