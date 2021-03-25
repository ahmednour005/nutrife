<?php

namespace App\Http\Controllers;

use App\Leads;
use App\Role;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        DELETE FROM satellites WHERE id NOT IN (SELECT * FROM (SELECT MAX(n.id) FROM satellites n GROUP BY n.norad_cat_id) x)


        if(request()->ajax())
        {
            return datatables()->of(Shipping::latest()->orderBy('id', 'DESC'))
                ->addColumn('Option', function($shipping){
                    return view('shippingsOption',['id' => $shipping->id]);
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
//                })
                ->rawColumns(['Option'])
                ->make(true);
        }
        $callcenter = Role::find(4);
        $callcenterleader = Role::find(1);
        $admin = Role::find(5);
        $users = $callcenter->users;
        $get_admin = $admin->users;
        $get_callcenterleader = $callcenterleader->users;
       return view('shippings')->with(['users'=>$users,
           'get_admin'=>$get_admin,'get_callcenterleader'=>$get_callcenterleader ]);
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
            'Date' => $request->Date,
            'Number_Of_Packages'        =>   $request->Number_Of_Packages,
            'Total_Price'        =>   $request->Total_Price,
            'Shipping'        =>   $request->Shipping,
            'Age'        =>   $request->Age,
            'Lead_Category' => $request->Lead_Category

        );

        Shipping::create($form_data);

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
            $data = Shipping::findOrFail($id);
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
            $data = Shipping::findOrFail($id);
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


                $form_data = array(
                    'Name'       =>   $request->Name,
                    'Address'        =>   $request->Address,
                    'Phone'        =>   $request->Phone,
                    'Number_Of_Packages'        =>   $request->Number_Of_Packages,
                    'Total_Price'        =>   $request->Total_Price,
                    'Shipping'        =>   $request->Shipping,
                    'Lead_Category'        =>   $request->Lead_Category,
                    'Age'        =>   $request->Age,
                    'Date' => $request->Date,
                );

            Leads::whereId($request->hidden_id)->update($form_data);
            return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Shipping::findOrFail($id);
        $data->delete();
    }
}
