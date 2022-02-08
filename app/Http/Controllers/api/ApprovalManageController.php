<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderApproves;
use Illuminate\Http\Request;
use App\Models\Products;

class ApprovalManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $OrderApproves = OrderApproves::orderBy('id', 'DESC')->get();

        foreach ($OrderApproves as $key => $value) {
            if ($value->PaymentImage != '') {
                $value->PaymentImage = url('/') . '/' . $value->PaymentImage;
            }
        }

        return response()->json($OrderApproves, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts($id, $product_id, $date, $time)
    {
        $array_id = explode(',', $product_id);
        $Products = Products::join('orders', 'orders.product_id', 'products.id')
            ->whereIn('products.id', $array_id)
            ->where('orders.user_id', $id)
            ->where('orders.paymentDate', $date)
            ->where('orders.paymentTime', $time)
            ->get();

        $OrderApproves = OrderApproves::where('product_id', $product_id)
            ->where('user_id', $id)
            ->where('paymentDate', $date)
            ->where('paymentTime', $time)
            ->get();

        foreach ($Products as $key => $value) {
            if ($value->Pimage != '') {
                $value->Pimage = url('/') . '/' . $value->Pimage;
            }
        }

        return response()->json(['Products' => $Products, 'Order' => $OrderApproves], 200);
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
