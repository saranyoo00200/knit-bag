<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Sale;
use App\Models\OrderApproves;

class SelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Order = Sale::where('PaymentStatus', 1)->get();
        $Total = Sale::where('PaymentStatus', 1)->selectRaw('sum(TotalPrice) as Total')->get();
        return response()->json(['Order' => $Order, 'Total' => $Total], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProducts($id)
    {
        $OrderApproves = OrderApproves::where('id', $id)
            ->select('product_id', 'user_id', 'paymentDate', 'paymentTime', 'amount_money')
            ->get();

        foreach ($OrderApproves as $value) {
            $amount_money = $value->amount_money;
            $_id = $value->product_id;
            $_user = $value->user_id;
            $_date = $value->paymentDate;
            $_time = $value->paymentTime;
        }

        $array_id = explode(',', $_id);
        $Products = Products::join('orders', 'orders.product_id', 'products.id')
            ->whereIn('products.id', $array_id)
            ->where('orders.product_id', $_id)
            ->where('orders.user_id', $_user)
            ->where('orders.paymentDate', $_date)
            ->where('orders.paymentTime', $_time)
            ->get();

        foreach ($Products as $value) {
            if ($value->Pimage != '') {
                $value->Pimage = url('/') . '/' . $value->Pimage;
            }
        }

        return response()->json(['products' => $Products, 'amount_money' => $amount_money], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
