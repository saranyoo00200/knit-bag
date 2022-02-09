<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\UserProducts;
use App\Models\OrderApproves;
use App\Models\Order;
use App\Models\Sale;

class UsersProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $Products = Products::join('user_products', 'user_products.product_id', '=', 'products.id')
            ->where('user_id', $id)
            ->get();

        return response()->json($Products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $info_duplicate = UserProducts::Where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->get();

        foreach ($info_duplicate as $key => $value) {
            $id = $value->id;
            $product_number = $value->number;
        }

        if (count($info_duplicate) == 1) {
            $input['user_id'] = $request->user_id;
            $input['product_id'] = $request->product_id;
            $input['number'] = $request->number + $product_number;
            UserProducts::find($id)->update($input);

            return response()->json(['success' => 'Created successfull!'], 200);
        } else {
            $input['user_id'] = $request->user_id;
            $input['product_id'] = $request->product_id;
            $input['number'] = $request->number;
            UserProducts::create($input);

            return response()->json(['success' => 'Created successfull!'], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function plus(Request $request, $id)
    {
        $info_duplicate = UserProducts::Where('id', $id)
            ->where('user_id', $request->user_id)
            ->get();

        foreach ($info_duplicate as $key => $value) {
            $product_id = $value->product_id;
            $product_number = $value->number;
        }

        $input['user_id'] = $request->user_id;
        $input['product_id'] = $product_id;
        $input['number'] = $product_number + 1;
        UserProducts::find($id)->update($input);

        return response()->json(['success' => 'Updated successfull!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function minus(Request $request, $id)
    {
        $info_duplicate = UserProducts::Where('id', $id)
            ->where('user_id', $request->user_id)
            ->get();

        foreach ($info_duplicate as $key => $value) {
            $product_id = $value->product_id;
            $product_number = $value->number;
        }

        $input['user_id'] = $request->user_id;
        $input['product_id'] = $product_id;
        $input['number'] = $product_number - 1;
        UserProducts::find($id)->update($input);

        return response()->json(['success' => 'Updated successfull!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderApprove(Request $request, $id)
    {
        $input['fname'] = $request->fname;
        $input['lname'] = $request->lname;
        $input['address'] = $request->address;
        $input['tel'] = $request->tel;
        $input['subdistrict'] = $request->subdistrict;
        $input['district'] = $request->district;
        $input['province'] = $request->province;
        $input['code_zip'] = $request->code_zip;
        $input['bank'] = $request->bank;
        $input['paymentDate'] = $request->paymentDate;
        $input['paymentTime'] = $request->paymentTime;
        $input['bankTransfer'] = $request->bankTransfer;
        $input['toBank'] = $request->toBank;
        $input['amount_money'] = $request->amount_money;
        $input['paymentCode'] = $request->paymentCode;
        $input['product_id'] = $request->product_id;
        $input['user_id'] = $id;

        if ($image = $request->file('PaymentImage')) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $upload_location = 'images/order_approvel/';
            $full_path = $upload_location . $img_name;
            $input['PaymentImage'] = $full_path;
            $OrderApp_id = OrderApproves::create($input)->id;
            $image->move(public_path($upload_location), $img_name);
            // create orders
            $idArray = explode(',', $request->product_id);
            $idProducts = DB::table('user_products')
                ->whereIn('product_id', $idArray)
                ->where('user_id', $id)
                ->get();
            // add to sales
            $OrderApproves = OrderApproves::where('id', $OrderApp_id)->get();
            foreach ($OrderApproves as $key => $value) {
                Sale::create([
                    'TotalPrice' => $request->amount_money,
                    'SaleDate' =>  $value->updated_at,
                    'OrderAppID' => $OrderApp_id,
                ]);
            }
            // dd($nunber);
            foreach ($idProducts as $value) {
                Order::create([
                    'amount_products' => $value->number,
                    'paymentDate' => $request->paymentDate,
                    'paymentTime' => $request->paymentTime,
                    'user_id' => $id,
                    'product_id' => $value->product_id,
                ]);
                // delete UserProducts
                UserProducts::where('product_id', $value->product_id)
                    ->where('user_id', $id)
                    ->delete();
            }
            return response()->json(['msg' => 'Successfull!'], 200);
        }
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
    public function getMyHistorys($id)
    {
        $OrderApproves = OrderApproves::where('user_id', $id)->get();

        return response()->json($OrderApproves, 200);
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
        UserProducts::find($id)->delete();

        return response()->json(['msg' => 'Deleted successfull!'], 200);
    }
}
