<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseLog;
use App\Models\SalesLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogsheetController extends Controller
{
    //
    public function purchaseIndex()
    {
        //session
        Session::put('admin_page','log');
        //
        $purchase = PurchaseLog::orderby('SKU', 'asc')->get();
        return view('admin.logsheet.purchaselog',compact('purchase'));
    }
    public function salesIndex()
    {
        //s
        Session::put('admin_page','log');
        //
        $sales = SalesLog::orderby('SKU', 'asc')->get();
        return view('admin.logsheet.saleslog',compact('sales'));
    }
}
