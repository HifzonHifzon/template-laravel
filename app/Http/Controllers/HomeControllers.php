<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeControllers extends Controller
{
    /**
     * 
     * @author Hifzon <hifzon746@gmail.com>
     * 
     * 
     */

    public function index(){

        $data['invoice_all'] = $this->getAllInvoice();
        return view('dashboard.transaksi.search_form', $data);
    }

    function listInvoice(){
        $data["result"] = DB::select(
            "SELECT * FROM trinvoice AS a 
                INNER JOIN mssales as b ON a.SalesID = b.SalesId
                INNER JOIN mspayment as c ON a.PaymentType = c.PaymentID
                INNER JOIN mscourier as d ON a.CourierID = d.CourierID"
        );  

        $data['courier_list'] = $this->getCourier();
        $data['sales_list'] = $this->getSales();
        $data['payment_list'] = $this->getPayment();

         return view('dashboard.transaksi.list_invoice', $data);
    }


    /**
     * 
     * 
     * @author hifzon 
     * 
     * form transaksi invoice 
     */
    function formInvoice(Request $request){
        $invoice_id = $request->input('invoice_id');

        $data['invoice_list'] = $this->getInvoice($invoice_id);

        $data['courier_list'] = $this->getCourier();
        $data['sales_list'] = $this->getSales();
        $data['payment_list'] = $this->getPayment();

        return view('dashboard.transaksi.form_invoice', $data);

    }


     /**
     * 
     * @author Hifzon 
     * 
     * Get update header invoice
     * 
     */

    function updateInvoice(Request $request){
        $InvoiceNo = $request->input('InvoiceNo');
        $InvoiceDate = $request->input('InvoiceDate');
        $InvoiceTo = $request->input('InvoiceTo');
        $SalesID = $request->input('SalesID');
        $CourierID = $request->input('CourierID');
        $ShipTo = $request->input('ShipTo');
        $PaymentType = $request->input('PaymentType');

        $data = [
            "InvoiceNo" =>  $InvoiceNo,
            "InvoiceDate" =>  $InvoiceDate,
            "InvoiceTo" =>  $InvoiceTo,
            "SalesID" =>  $SalesID,
            "CourierID" =>  $CourierID,
            "ShipTo" =>  $ShipTo,
            "PaymentType" =>  $PaymentType,
        ];


        $exec = DB::table('trinvoice')
                ->where('InvoiceNo', $InvoiceNo)
                ->update($data);

        redirect('/');

    }   


    function detailSave(Request $request){
        $InvoiceNo = $request->input('InvoiceNo');
        $ProductID = $request->input('ProductID');
        $Qty = $request->input('Qty');

        $getOneProduct = DB::select("SELECT ProductID, ProductName, Weight, Price FROM msproduct WHERE ProductID = '".$ProductID."'");

        $data = [
            "InvoiceNo" => $InvoiceNo,
            "ProductID" => $ProductID,
            "Weight" => $getOneProduct[0]->Weight,
            "Price" => $getOneProduct[0]->Price,
            "Qty" => $Qty
        ];

        DB::table('trinvoicedetail')->insert($data);
        return redirect('/');

    }


     function saveInvoice(Request $request){


        $InvoiceDate = $request->input('InvoiceDate');
        $InvoiceTo = $request->input('InvoiceTo');
        $SalesID = $request->input('SalesID');
        $CourierID = $request->input('CourierID');
        $ShipTo = $request->input('ShipTo');
        $PaymentType = $request->input('PaymentType');

        $generateInvoice = DB::select("SELECT CONCAT ('IN000',invoice) as InvoiceNo FROM (SELECT substr(InvoiceNo,5,10) + 1 AS invoice FROM trinvoice ORDER BY InvoiceNo DESC limit 1) AS x");


        $data = [
            "InvoiceNo" =>  "IN000".substr(rand(),6),
            "InvoiceDate" =>  $InvoiceDate,
            "InvoiceTo" =>  $InvoiceTo,
            "SalesID" =>  $SalesID,
            "CourierID" =>  $CourierID,
            "ShipTo" =>  $ShipTo,
            "PaymentType" =>  $PaymentType,
            "CourierFee" => 0
        ];


        $exec = DB::table('trinvoice')
                ->insert($data);

        return redirect('/invoice');

    }  


     /**
     * 
     * @author Hifzon 
     * 
     * Get rows Invoice Transaction
     * 
     */

    function getInvoice($invoice_id){
        $get= DB::table('trinvoice')
                    ->select('InvoiceNo','InvoiceDate','InvoiceTo','ShipTo','SalesID','CourierID','PaymentType','CourierFee')
                    ->where('InvoiceNo',$invoice_id)
                    ->first();
        return $get;
    }


    function detailInvoice(Request $request){

        $InvoiceNo = $request->input('InvoiceNo');
        $data['total'] = DB::select("SELECT max(InvoiceNo) InvoiceNo, sum(weight * QTY * price) as total FROM trinvoicedetail WHERE InvoiceNo = '".$InvoiceNo."' GROUP BY InvoiceNo");

        $data['product'] = DB::select("SELECT ProductID, ProductName, Weight, Price FROM msproduct");
        $data['InvoiceNo'] = $InvoiceNo;
        $data['result'] = $this->getDetailInvoice($InvoiceNo);
        return view('dashboard.transaksi.detail_invoice', $data);

    }


    function getAllInvoice(){
        $get= DB::table('trinvoice')
                    ->select('InvoiceNo')
                    ->get();
        return $get;
    }

    /**
     * 
     * @author Hifzon 
     * 
     * List Master Referensi Invoice Courier, Sales, Payment
     * 
     */
    function getCourier(){
        $get= DB::table('mscourier')->select('CourierID','CourierName')->get();
        return $get;
    }

    function getSales(){
        $get= DB::table('mssales')->select('SalesID','SalesName')->get();
        return $get;
    }

    function getPayment(){
        $get= DB::table('mspayment')->select('PaymentID','PaymentName')->get();
        return $get;
    }

    function getDetailInvoice($InvoiceNo){
         $get= DB::table('trinvoicedetail as a')
                    ->join('msproduct as b', 'a.ProductID', '=', 'b.ProductID')
                    ->select('a.InvoiceNo','b.ProductName','a.Weight','a.Qty','a.Price')
                    ->where('InvoiceNo', $InvoiceNo)
                    ->get();
        return $get;
    }
}
