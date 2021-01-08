<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disburse;
use App\User;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function show($transaction_id){
        $data = Disburse::where('transaction_id', $transaction_id)->first();
        return response()->json($data);
    }
    public function index()
    {

        return view('home');
    }


       public function data_disbursement(Request $request){
         if ($request->ajax()) {
            $data = Disburse::orderBy('created_at', 'desc')->get(['id', 'transaction_id', 'bank_code', 'account_number', 'amount', 'remark', 'created_at', 'time_served', 'receipt','status']);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('receipt', function ($row) {
                        if (isset($row->receipt)) {
                             $receipt =  '<a class="fancybox-effects-a" href="' .$row->receipt . '" title="Click aside to exit popup" > <img src="' . $row->receipt . '" alt="image" width="100" height="50" /> </a>';

                             return $receipt;
                        }else{
                            return '';
                        }
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->transaction_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm synchItem">Synch Data</a>';

                        
                            return $btn;
                    })
                    ->rawColumns(['receipt','action'])
                    ->make(true);
        }
    }
}
