<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * 
 * @author Hifzon <hifzon746@gmail.com>
 * 
 */

class SalesControllers extends Controller
{   

    /**
     * 
     * List data sales
     */
    function getSales(){
        $data['result'] = DB::table('mssales')->select('SalesID','SalesName')->get();
        return view('dashboard.master.sales.index', $data);
    }


    /**
     * 
     * Save data sales after submit
     */
    function saveSales(Request $request){
        $SalesID = $request->input('SalesID');
        $SalesName = $request->input('SalesName');

        $exec =  DB::table('mssales')->insert([
            'SalesID' => $SalesID,
            'SalesName' => $SalesName
        ]);

        return redirect('/sales');
    
    }


    /**
     * 
     * 
     * Delete data sales after click delete 
     * 
     */

    function deleteSales(Request $request){
        $SalesID = $request->input('id');
        DB::table('mssales')->where('SalesID', $SalesID)->delete();
        return redirect('/sales');
    }


    /**
     * 
     * get 1 rows for edit data
     * 
     * 
     */

    function Edit($id){
        $data['result'] = DB::table('mssales')
                    ->select('SalesID','SalesName')
                    ->where('SalesID',$id)
                    ->first();
                    
        return view('dashboard.master.sales.edit', $data);
    }


    /***
     * 
     * Update data sales after click update
     * 
     * 
     */
    function update(Request $request){
        $SalesID = $request->input('SalesID');
        $SalesName = $request->input('SalesName');

        $exec =  DB::table('mssales')
                    ->where('SalesID', $SalesID)
                    ->update(['SalesName' => $SalesName,"SalesID" => $SalesID]);
                    
        return redirect('/sales');

    }

}
