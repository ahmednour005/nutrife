<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Exports\ShippingExport;
use App\Leads;
use Illuminate\Http\Request;
use DB;
use Excel;

class ExportExcelController extends Controller
{
    function leadexcel()
    {
        return Excel::download(new LeadsExport(), 'leads.xlsx');
    }

    function shippingexcel()
    {
        return Excel::download(new ShippingExport(), 'shipping.xlsx');
    }


}
