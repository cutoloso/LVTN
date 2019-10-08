<?php

namespace App\Http\Controllers;
use DB;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $user = Auth::user();
        $region = DB::table('devvn_tinhthanhpho')->where('matp',$request->region)->first();
        $cityes = DB::table('devvn_quanhuyen')->where('maqh',$request->city)->first();
        $wards = DB::table('devvn_xaphuongthitran')->where('xaid',$request->ward)->first();
        $address = $request->address.', '.$wards->name.', '.$cityes->name.', '.$region->name;
        Customer::where('usr_id',$user->id)->update([
            'name' => $request->name,
            'phone'=>$request->phone,
//            'email'=>$request->email,
            'address'=>$address
        ]);
        return redirect()->route('get-checkout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function updateI($id, Request $request){
        $user = User::find($id);

        if ($request->phone !='') $user->phone = $request->phone;

        $user->address = $request->address.', '.$request->ward.', '.$request->city.', '.$request->region;
        $user->save();
        return redirect()->route('get-checkout');
    }
}
