<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function checkPasswprd(Request $request, $id)
    {
        $password = User::find($id)->password;
        if (Hash::check($request->current_password, $password)) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 201);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePasswprd(Request $request, $id)
    {
        $input['password'] = Hash::make($request->new_password);
        User::find($id)->update($input);
        return response()->json(['success' => true], 200);
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
        $location_unlink = User::find($id)->image;

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        if ($image = $request->file('image')) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $upload_location = 'images/Users/';
            $full_path = $upload_location . $img_name;
            $input['image'] = $full_path;
            User::find($id)->update($input);
            $image->move(public_path($upload_location), $img_name);
            if ($location_unlink) {
                unlink($location_unlink);
            }
            return response()->json(['success', 'Updated Successfull!'], 200);
        }

        User::find($id)->update($input);
        return response()->json(['success', 'Updated Successfull!'], 200);
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
