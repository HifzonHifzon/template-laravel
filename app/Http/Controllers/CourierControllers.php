<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * @author Hifzon <hifzon746@gmail.com>
 * 
 */
class CourierControllers extends Controller
{

    /**
     * 
     * List data courier 
     * 
     */
    function getCourier(){
        $data['result']= DB::table('mscourier')->select('CourierID','CourierName')->get();
        return view('dashboard.master.courier.index', $data);
    }


    /**
     * 
     * 
     * Save data courier after click save
     * 
     */
    function saveCourier(Request $request){
        $CourierID = $request->input('CourierID');
        $CourierName = $request->input('CourierName');

        $exec =  DB::table('mscourier')->insert([
            'CourierID' => $CourierID,
            'CourierName' => $CourierName
        ]);

        return redirect('/courier');
    
    }

    /**
     * 
     * Delete 1 data courier after delete 
     * 
     */
    function deleteCourier(Request $request){
        $CourierID = $request->input('id');
        DB::table('mscourier')->where('CourierID', $CourierID)->delete();
        return redirect('/courier');
    }


    /**
     * 
     * get 1 rows data for update 
     * 
     */
    function Edit($id){
        $data['result'] = DB::table('mscourier')
                    ->select('CourierID','CourierName')
                    ->where('CourierID',$id)
                    ->first();
                    
        return view('dashboard.master.courier.edit', $data);
    }

    /**
     * 
     * Update data Courier 
     */
    function update(Request $request){
        $CourierID = $request->input('CourierID');
        $CourierName = $request->input('CourierName');

        $exec =  DB::table('mscourier')
                    ->where('CourierID', $CourierID)
                    ->update(['CourierName' => $CourierName,"CourierID" => $CourierID]);
                    
        return redirect('/courier');

    }



}
