<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        if (!$request->has('utm')) {
            return $leads;
        }

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

    public function placeOrder(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required|not_in:0',
            'phone' => 'required|min:17'
        ]);

        $tags = ['Заявка с сайта'];

        // Set lead name
        $name = $request->name;
        if ($request->isPersonal) {
            $name .= ' Индивидуальное меню';
        } elseif ($request->isDaily) {
            $name .= ' Daily';
        }


        // Build lead payload (v4 format)
        $leadPayload = [
            'name'        => $name,
            'price'       => 0,
            'status_id'   => 28039639, //Тег присвоен
            'pipeline_id' => 1783882,  //Первичные продажи
            '_embedded'   => [
                'tags' => array_map(function($tag){ return ['name' => $tag]; }, $tags),
            ],
            'custom_fields_values' => [
                [
                    'field_id' => 478771, //Телефон
                    'values'   => [['value' => $request->phone]],
                ],
                [
                    'field_id' => 320995, //Источник
                    'values'   => [['enum_id' => 766689, 'value' => 'Сайт']],
                ],
                [
                    'field_id' => 868945, //cid
                    'values'   => [['value' => $request->ga]],
                ],
                [
                    'field_id' => 881669, //City
                    'values'   => [['enum_id' => $request->city_id === 1 ? 977019 : 977021]],
                ],
            ],
        ];

        // Size, Type, Course, Price
        if (!$request->isPersonal && !$request->isDaily) {
            $sizeFieldId = 327953; //Size
            $typeFieldId = 321197; //Type
            $dayFieldId  = 321235; //Course
            $priceFieldId = 456321; //Стоимость курса

            if (!empty($request->title)) {
                switch ($request->title) {
                    case 'XS':
                        $sizeEnum = 678741;
                        break;
                    case 'S':
                        $sizeEnum = 678743;
                        break;
                    case 'M':
                        $sizeEnum = 678745;
                        break;
                    case 'L':
                        $sizeEnum = 678747;
                        break;
                    case 'XL':
                        $sizeEnum = 678749;
                        break;
                    default:
                        $sizeEnum = null;
                }
                if ($sizeEnum) {
                    $leadPayload['custom_fields_values'][] = [
                        'field_id' => $sizeFieldId,
                        'values'   => [['enum_id' => $sizeEnum]],
                    ];
                }
            }

            $leadPayload['custom_fields_values'][] = [
                'field_id' => $typeFieldId,
                'values'   => [['enum_id' => 678649]],
            ];

            $leadPayload['custom_fields_values'][] = [
                'field_id' => $dayFieldId,
                'values'   => [['value' => (string)$request->day]],
            ];

            $leadPayload['custom_fields_values'][] = [
                'field_id' => $priceFieldId,
                'values'   => [['value' => (string)$request->total]],
            ];

            $leadPayload['price'] = $request->discount;
        }

        // Promo
        if ($request->promoStatus === true) {
            $skidka = null;
            if ($request->promoType === 0) {
                $skidka = $request->total * $request->promoVal / 100;
            }
            if ($request->promoType === 1) {
                $skidka = $request->promoVal;
            }
            if ($skidka) {
                $leadPayload['custom_fields_values'][] = [
                    'field_id' => 479179, //сумма скидки
                    'values'   => [['value' => (string)$skidka]],
                ];
            }

            $leadPayload['custom_fields_values'][] = [
                'field_id' => 321259, //комм менеджер
                'values'   => [['value' => $request->promoMsg]],
            ];

            $leadPayload['_embedded']['tags'][] = ['name' => $request->promo];
        }

        // Save lead
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_ADMIN_LONG_TOKEN'),
        ])->post("https://eatandfitkz.amocrm.ru/api/v4/leads", [$leadPayload]);

        if ($response->failed()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Lead creation failed',
                'errors' => $response->json(),
            ]);
        }

        $lead = $response->json()['_embedded']['leads'][0] ?? null;
        if (!$lead) {
            return response()->json(false);
        }

        $lead_id = $lead['id'];

        // Create contact and link to lead
        $contactPayload = [
            'name' => $request->name,
            'custom_fields_values' => [
                [
                    'field_code' => 'PHONE',
                    'values'   => [['value' => $request->phone, 'enum_code' => 'MOB']],
                ]
            ],
            '_embedded' => [
                'leads' => [
                    ['id' => $lead_id]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_ADMIN_LONG_TOKEN'),
        ])->post("https://eatandfitkz.amocrm.ru/api/v4/contacts", [$contactPayload]);

        if ($response->failed()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Contact creation failed',
                'errors' => $response->json(),
            ]);
        }

        $contactId = $response->json()['_embedded']['contacts'][0]['id'];

        if ($contactId) {
            $linkPayload = [
                [
                    'to_entity_id' => $contactId,
                    'to_entity_type' => 'contacts',
                ],
            ];

            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('AMO_ADMIN_LONG_TOKEN'),
                'Content-Type'  => 'application/json',
            ])->post("https://eatandfitkz.amocrm.ru/api/v4/leads/{$lead_id}/link", $linkPayload);
        }

        return response()->json(true);
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
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:17',
            'address' => 'required'
        ]);

        $name = $request->name ?? '';
        $city_id = $request->city_id ?? 1;
        $address = $request->address ?? '';
        $phone = $request->phone ?? '';
        $cart = $request->cart ?? [];
        $card_type = $request->payment;
        $cutlery = $request->cutlery;
        $total = $request->total + $request->delivery + $cutlery['total'];
        $wholesale = $request->wholesale ?? 0;
        $products = 'Приборы - '. $cutlery['q'] . ' x ' . $cutlery['price'] . ','.PHP_EOL;
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

        //882665 Скрэмбл с сосисками
        //882667 Мясо по-Тайски
        //882669 3. Бефстроганов
        //882671 1. Хэшбраун с яйцом
        //882673 2. Клаб сэндвич с курицей

        try {
            $accessToken = env('AMO_ADMIN_LONG_TOKEN');
            $baseUrl     = rtrim(env('AMOCRM_BASE_URL'), '/');
            $customFields = [];

            if ($card_type === 'card') {
                $customFields[] = [
                    'field_id' => 321139, // Фактический оплачено
                    'values'   => [['value' => $total]],
                ];
                $customFields[] = [
                    'field_id' => 869811, // Оплата тип
                    'values'   => [['value' => '969831']], // Оплачено картой на сайте
                ];
            } elseif ($card_type === 'kaspi_pay') {
                $customFields[] = [
                    'field_id' => 869811,
                    'values'   => [['value' => '968303']], // kaspi pay
                ];
            } else {
                $customFields[] = [
                    'field_id' => 869811,
                    'values'   => [['value' => '968307']], // Расчетный счет
                ];
            }

            if ($cart) {
                $products = '';
                foreach ($cart as $item) {
                    $product = Product::find($item['id']);

                    if ($product) {
                        $customFields[] = [
                            'field_id' => $product->amo_id,
                            'values'   => [['value' => $item['q']]],
                        ];
                    }

                    $q = $item['q'];
                    $price = $card_type === 'cashless' ? $product->wholesale : $product->price;
                    $products .= $item['title'] . " - {$q} x {$price}";
                    if (end($cart) !== $item) {
                        $products .= ', ' . PHP_EOL;
                    }
                }
            }

            $customFields[] = [
                'field_id' => 456321, // Стоимость курса
                'values'   => [['value' => $card_type === 'cashless' ? $wholesale + $cutlery['total'] : $total]],
            ];
            $customFields[] = [
                'field_id' => 478771, // Телефон для звонков
                'values'   => [['value' => $phone]],
            ];
            $customFields[] = [
                'field_id' => 478763, // Адрес
                'values'   => [['value' => $address]],
            ];
            $customFields[] = [
                'field_id' => 478765, // Адрес доп
                'values'   => [['value' => $address]],
            ];
            $customFields[] = [
                'field_id' => 373971, // Время доставки
                'values'   => [['value' => $request->time]],
            ];
            $customFields[] = [
                'field_id' => 478705, // Время доставки доп
                'values'   => [['value' => $request->time]],
            ];
            $customFields[] = [
                'field_id' => 321277, // Комм. кухня
                'values'   => [['value' => $products]],
            ];
            $customFields[] = [
                'field_id' => 327953, // Size
                'values'   => [['value' => '929511']],
            ];
            $customFields[] = [
                'field_id' => 321197, // Type
                'values'   => [['value' => '833911']],
            ];
            $customFields[] = [
                'field_id' => 881669, // City
                'values'   => [['value' => $city_id === 1 ? '977019' : '977021']],
            ];

            $leadPayload = [
                [
                    'name'         => $name,
                    'status_id'    => 40592377,
                    'pipeline_id'  => 4359841,
                    'price'        => $wholesale + $cutlery['total'],
                    'tags'         => [['name' => 'Заявка с сайта']],
                    'custom_fields_values' => $customFields,
                ]
            ];

            $leadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ])->post("{$baseUrl}/api/v4/leads", $leadPayload);

            $leadData = $leadResponse->json();
            $leadId   = $leadData['_embedded']['leads'][0]['id'] ?? null;

            if ($leadId) {
                $contactPayload = [
                    [
                        'name' => $name,
                        'custom_fields_values' => [
                            [
                                'field_id' => 306229, // Phone field
                                'values'   => [
                                    ['value' => $phone, 'enum_id' => 635201] // мобильный
                                ],
                            ]
                        ],
                        '_embedded' => [
                            'leads' => [
                                ['id' => $leadId]
                            ]
                        ]
                    ]
                ];

                $contactResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type'  => 'application/json',
                ])->post("{$baseUrl}/api/v4/contacts", $contactPayload);

                $contactId = $contactResponse->json()['_embedded']['contacts'][0]['id'];

                if ($contactId) {
                    $linkPayload = [
                        [
                            'to_entity_id' => $contactId,
                            'to_entity_type' => 'contacts',
                        ],
                    ];

                    Http::withHeaders([
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type'  => 'application/json',
                    ])->post("{$baseUrl}/api/v4/leads/{$leadId}/link", $linkPayload);
                }
            }

            return response()->json('Success');
        }catch (\AmoCRM\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
