<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products = Products::all();

        $destinationPath = 'images/Products/';

        foreach ($Products as $key => $value) {
            $value->Pimage = url('/') . '/' . $value->Pimage;

            if ($value->Pclass = 1) {
                $value->Pclass = 'Bag';
            } elseif ($value->Pclass = 2) {
                $value->Pclass = 'Shirt';
            } elseif ($value->Pclass = 3) {
                $value->Pclass = 'Scarf';
            }
        }

        return response()->json($Products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // //         //เข้ารหัสรูป
        $image = $request->file('Pimage');

        // generate
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file

        $img_name = $name_gen . '.' . $img_ext; // commit image with lastname

        // //upload
        $upload_location = 'images/Products/';
        $full_path = $upload_location . $img_name;

        //up load image
        // dd($full_path);
        Products::insert([
            'Pname' => $request->Pname,
            'Pprice' => $request->Pprice,
            'Pdetail' => $request->Pdetail,
            'Pclass' => $request->Pclass,
            'Pimage' => $full_path,
        ]);

        $image->move(public_path($upload_location), $img_name);

        return response()->json(['msg' => 'Successfull!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Products = Products::find($id);

        return response()->json($Products, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $Products = Products::all();

        foreach ($Products as $key => $value) {
            $value->Pimage = url('/') . '/' . $value->Pimage;
        }

        return response()->json($Products, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClick($id)
    {
        $Products = Products::find($id);

        return response()->json($Products, 200);
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
        $location_unlink = Products::find($id)->Pimage;

        $input['Pname'] = $request->Pname;
        $input['Pdetail'] = $request->Pdetail;
        $input['Pclass'] = $request->Pclass;
        $input['Pprice'] = $request->Pprice;

        if ($image = $request->file('Pimage')) {
            $name_gen = hexdec(uniqid());
            $img_name = $name_gen . '.' . $image->getClientOriginalExtension();

            $upload_location = 'images/Products/';
            $full_path = $upload_location . $img_name;

            // dd($request->all());
            $Products = DB::table('products')
                ->where('id', $id)
                ->update([
                    'Pname' => $request->Pname,
                    'Pprice' => $request->Pprice,
                    'Pdetail' => $request->Pdetail,
                    'Pclass' => $request->Pclass,
                    'Pimage' => $full_path,
                ]);

            $image->move(public_path($upload_location), $img_name);

            if ($location_unlink) {
                unlink($location_unlink);
            }

            return response()->json(['success' => 'Updated Successfull!'], 200);
        }

        $Products = Products::find($id);
        $Products->update($input);
        return response()->json(['success' => 'Updated Successfull!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location_unlink = Products::find($id)->Pimage;

        Products::find($id)->delete();

        if ($location_unlink) {
            unlink($location_unlink);
        }

        return response()->json(['msg' => 'Deleted successfull!'], 200);
    }
}
