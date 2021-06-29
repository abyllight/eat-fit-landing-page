<?php

namespace App\Http\Controllers;

use AmoCRM\Client;
use App\ProductCart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index() {
        $list = ProductCart::whereDate('created_at', Carbon::today())->get();
        return view('list', ['list' => $list]);
    }

    public function fetchOrders(Request $request) {

        try {
            $amo = new Client(env('AMO_SUBDOMAIN'), env('AMO_LOGIN'), env('AMO_HASH'));

            //40592380 Заказ оформлен

            $leads = $amo->lead->apiList([
                'status'     => 40592377,
                'limit_rows' => 200
            ]);



        }catch (\AmoCRM\Exception $e) {
            return redirect()->route('admin.list')->with('error', $e->getMessage() . ', ' . $e->getCode());
        }
    }
}
