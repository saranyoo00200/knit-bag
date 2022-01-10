<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\UserProducts;

class UsersProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $Products = Products::join('user_products', 'user_products.product_id', '=', 'products.id')->get();

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
        UserProducts::find($id)->delete();

        return response()->json(['msg' => 'Deleted successfull!'], 200);
    }
}
