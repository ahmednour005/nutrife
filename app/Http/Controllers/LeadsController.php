<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Leads;
use DB;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Role;
use App\Shipping;
use App\User;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {

        if(request()->ajax())
        {

            return datatables()->of(Leads::latest()->orderBy('id', 'DESC'))
                ->addColumn('Option', function($lead){
                    return view('leadsOption',['id' => $lead->id]);
                })
//                ->filter(function ($instance) use ($request) {
//
//                    if ($request->get('Lead_Category') == 'tagosyl' || $request->get('Lead_Category') == 'croroch') {
//                        $instance->where('Lead_Category', $request->get('Lead_Category'));
//                    }
//                    if (!empty($request->get('search'))) {
//
//                        $instance->where(function($w) use($request){
//                            $search = $request->get('search');
//                            $w->orWhere('Phone', 'LIKE',"%$search%")
//                               ->orWhere('Name', 'LIKE', "%$search%");
//                        });
//                    }
//
//                })
                ->rawColumns(['Option'])
                ->make(true);
        }
        return view('leads');
    }


    function import(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();
        Excel::import(new UsersImport, $path);
        return back()->with('success', 'Excel Data Imported successfully.');
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
        $rules = array(
            'Name'    =>  'required',
            'Address'     =>  'required',
            'Phone'         =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        $form_data = array(
            'Name'        =>  $request->Name,
            'Address'         =>  $request->Address,
            'Phone'             =>  $request->Phone,
            'Status'        =>   $request->Status,
            'Number_Of_Packages'        =>   $request->Number_Of_Packages,
            'Total_Price'        =>   $request->Total_Price,
            'Shipping'        =>   $request->Shipping,
            'Employee_Name'        =>   $request->Employee_Name,
            'Height'        =>   $request->Height,
            'Weight'        =>   $request->Weight,
            'Age'        =>   $request->Age,
            'Date' => $request->Date,
            'Lead_Category' => $request->Lead_Category

        );

        Leads::create($form_data);

        return back()->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = Leads::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Leads::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $rules = array(
                'Name'    =>  'required',
                'Address'     =>  'required',
                'Phone'     =>  'required'
            );

            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

        $callcenter = Role::find(4);
        foreach ( $callcenter->users as $u ){
            if( Auth::user()->id == $u->id){
                $form_data = array(
                    'Name'       =>   $request->Name,
                    'Address'        =>   $request->Address,
                    'Phone'        =>   $request->Phone,
                    'Status'        =>   $request->Status,
                    'Number_Of_Packages'        =>   $request->Number_Of_Packages,
                    'Total_Price'        =>   $request->Total_Price,
                    'Shipping'        =>   $request->Shipping,
                    'Date' => $request->Date,
                    'Height'        =>   $request->Height,
                    'Weight'        =>   $request->Weight,
                    'Age'        =>   $request->Age
                );
                break;
            }
        }
        $callcenterleader = Role::find(5);
        foreach ( $callcenterleader->users as $c ){
            if( Auth::user()->id == $c->id){
                $form_data = array(
                    'Name'       =>   $request->Name,
                    'Address'        =>   $request->Address,
                    'Phone'        =>   $request->Phone,
                    'Status'        =>   $request->Status,
                    'Number_Of_Packages'        =>   $request->Number_Of_Packages,
                    'Total_Price'        =>   $request->Total_Price,
                    'Shipping'        =>   $request->Shipping,
                    'Employee_Name'        =>   $request->Employee_Name,
                    'Height'        =>   $request->Height,
                    'Weight'        =>   $request->Weight,
                    'Age'        =>   $request->Age,
                    'Date' => $request->Date,
                );
                break;
            }
        }
        $admin = Role::find(1);
        foreach ( $admin->users as $a ){
            if( Auth::user()->id == $a->id){
                $form_data = array(
                    'Name'       =>   $request->Name,
                    'Address'        =>   $request->Address,
                    'Phone'        =>   $request->Phone,
                    'Status'        =>   $request->Status,
                    'Number_Of_Packages'        =>   $request->Number_Of_Packages,
                    'Total_Price'        =>   $request->Total_Price,
                    'Shipping'        =>   $request->Shipping,
                    'Employee_Name'        =>   $request->Employee_Name,
                    'Height'        =>   $request->Height,
                    'Weight'        =>   $request->Weight,
                    'Age'        =>   $request->Age,
                    'Date' => $request->Date,
                );
                break;
            }
        }



        $shipping = new Shipping();
        $shipping->Name = $request->Name;
        $shipping->Address = $request->Address;
        $shipping->Phone =  $request->Phone;
        $shipping->Number_Of_Packages    =   $request->Number_Of_Packages;
        $shipping->Total_Price  = $request->Total_Price;
        $shipping->Shipping   = $request->Shipping;
        $shipping->Lead_Category   = $request->Lead_Category;
        $shipping->Age = $request->Age;
        $shipping->Date = $request->Date;
        if ($request->Status == 'Confirm'){
           $shipping->save();
            Leads::whereId($request->hidden_id)->update($form_data);

            return response()->json(['success' => 'Data is successfully updated']);
        }else{
            Leads::whereId($request->hidden_id)->update($form_data);
            return response()->json(['success' => 'Data is successfully updated']);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Leads::findOrFail($id);
        $data->delete();
    }
}
