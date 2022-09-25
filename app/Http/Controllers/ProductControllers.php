<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * 
 * @author Hifzon <hifzon746@gmail.com>
 * 
 */

class ProductControllers extends Controller
{   

    /**
     * 
     * List data sales
     */
    function getProduct(){
        $data['result'] = DB::table('msproduct')->select('*')->get();
        return view('dashboard.master.product.index', $data);
    }


    /**
     * 
     * Save data sales after submit
     */
    function savePayment(Request $request){
        $PaymentID = $request->input('PaymentID');
        $PaymentName = $request->input('PaymentName');

        $exec =  DB::table('mspayment')->insert([
            'PaymentID' => $PaymentID,
            'PaymentName' => $PaymentName
        ]);

        return redirect('/payment');
    
    }


    /**
     * 
     * 
     * Delete data sales after click delete 
     * 
     */

    function deletePayment(Request $request){
        $PaymentID = $request->input('id');
        DB::table('mspayment')->where('PaymentID', $PaymentID)->delete();
        return redirect('/payment');
    }


    /**
     * 
     * get 1 rows for edit data
     * 
     * 
     */

    function Edit($id){
        $data['result'] = DB::table('mspayment')
                    ->select('PaymentID','PaymentName')
                    ->where('PaymentID',$id)
                    ->first();
                    
        return view('dashboard.master.payment_type.edit', $data);
    }


    /***
     * 
     * Update data sales after click update
     * 
     * 
     */
    function update(Request $request){
        $PaymentID = $request->input('PaymentID');
        $PaymentName = $request->input('PaymentName');

        $exec =  DB::table('mspayment')
                    ->where('PaymentID', $PaymentID)
                    ->update(['PaymentName' => $PaymentName,"PaymentID" => $PaymentID]);
                    
        return redirect('/payment');

    }

}
