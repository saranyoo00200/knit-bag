<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderApproves;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Order;
use App\Models\Sale;
// use Carbon\Carbon;
use Datetime;

class ApprovalManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $OrderApproves = OrderApproves::orderBy('approvel', 'ASC')->get();

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

        foreach ($Products as $key => $value) {
            if ($value->Pimage != '') {
                $value->Pimage = url('/') . '/' . $value->Pimage;
            }
        }
        $OrderApproves = OrderApproves::where('product_id', $product_id)
            ->where('user_id', $id)
            ->where('paymentDate', $date)
            ->where('paymentTime', $time)
            ->get();

        foreach ($OrderApproves as $key => $item) {
            $item->paymentDate =  date('d/m/Y', strtotime($item->paymentDate));
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
    public function approvalUpdate(Request $request, $id)
    {
        Sale::where('OrderAppID', $id)->update([
            'PaymentStatus' => $request->approval
        ]);
        OrderApproves::find($id)->update([
            'approvel' => $request->approval,
            'alert' => $request->alert
        ]);

        return response()->json(['msg' => 'Successfull!'], 200);
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
    public function approvalDestroy($id)
    {
        $get_id = OrderApproves::where('id', $id)->select('product_id', 'user_id', 'paymentDate', 'paymentTime')->get();
        foreach ($get_id as $value) {
            $del_id = $value->product_id;
            $del_user = $value->user_id;
            $del_date = $value->paymentDate;
            $del_time = $value->paymentTime;
        }
        $array_id = explode(',', $del_id);
        OrderApproves::find($id)->delete();
        Sale::where('OrderAppID', $id)->delete();

        Order::whereIn('product_id', $array_id)->where('user_id', $del_user)
            ->where('paymentDate', $del_date)
            ->where('paymentTime', $del_time)
            ->delete();

        return response()->json(['msg' => 'Deleted Successfull!'], 200);
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
