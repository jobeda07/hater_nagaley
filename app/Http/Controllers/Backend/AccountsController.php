<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use Session;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_heads = AccountHead::OrderBy('id', 'ASC')->get();
        //$account_heads = AccountHead::where('status', 1)->latest()->get();

        return view('backend.accounts.heads', compact('account_heads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function heads()
    {
        $account_heads = AccountHead::OrderBy('id', 'ASC')->get();
        //$account_heads = AccountHead::where('status', 1)->latest()->get();

        return view('backend.accounts.heads', compact('account_heads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ledgers(Request $request)
    {
        $account_ledgers = AccountLedger::OrderBy('id', 'ASC')->get();

        return view('backend.accounts.ledgers', compact('account_ledgers'));
    }
    
    
    public function ledger_report(Request $request){
        $account = $request->account;
        $startDate = date('Y-m-d',strtotime($request->start_date));
        $endDate = date('Y-m-d',strtotime($request->end_date));

        // session_start();

        // $request->session()->put('account', $account);
        // $request->session()->put('startDate', $startDate);
        // $request->session()->put('endDate', $endDate);

        // $expense_count = Expense::whereBetween('date', ['startDate', 'endDate'])->get();
        // return view('admin.report.expense_count',compact('expense_count'));
        if($request->account == 'credit'){
            $account_ledgers = AccountLedger::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('credit', $account)
                            ->get();
        }else{
            $account_ledgers = AccountLedger::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('debit', $account)
                            ->get();
        }
        //dd($account_ledgers);
        return view('backend.accounts.ledger_report',compact('account_ledgers','account'));
    }
    
    
    public function ledger_report_print(Request $request){
        $account = $request->account;
        $startDate = date('Y-m-d',strtotime($request->start_date));
        $endDate = date('Y-m-d',strtotime($request->end_date));

        // session_start();

        // $request->session()->put('account', $account);
        // $request->session()->put('startDate', $startDate);
        // $request->session()->put('endDate', $endDate);

        // $expense_count = Expense::whereBetween('date', ['startDate', 'endDate'])->get();
        // return view('admin.report.expense_count',compact('expense_count'));
        if($request->account == 'credit'){
            $account_ledgers = AccountLedger::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('credit', $account)
                            ->get();
        }else{
            $account_ledgers = AccountLedger::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('debit', $account)
                            ->get();
        }
        return view('backend.accounts.ledger_report_print',compact('account_ledgers','account'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_head()
    {
        return view('backend.accounts.create_head');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_ledger()
    {   $account_heads = AccountHead::where('status', 1)->OrderBy('id', 'ASC')->get();
        return view('backend.accounts.create_ledger', compact('account_heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_head(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        if($request->status == Null){
            $request->status = 0;
        }

        $account_head = new AccountHead();
        $account_head->title = $request->title;
        $account_head->slug = $slug;
        $account_head->status = $request->status;
        $account_head->save();

        Session::flash('success','New Account Head created Successfully.');

        return redirect()->route('accounts.heads');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_ledger(Request $request)
    {
        $this->validate($request,[
            'head_id' => 'required',
            'type_id' => 'required',
            'amount' => 'required',
            'head_id' => 'required',
        ]);

        //dd($request);

        $amount = get_account_balance();

        $account_ledger = new AccountLedger();
        $account_ledger->account_head_id = $request->head_id;
        $account_ledger->particulars = $request->particulars;
        $account_ledger->type = $request->type_id;
        $account_ledger->save();

        if($request->type_id == 1){
            $account_ledger->debit = $request->amount;
            $account_ledger->balance = $amount - $request->amount;
        }else if($request->type_id == 2){
            $account_ledger->credit = $request->amount;
            $account_ledger->balance = $amount + $request->amount;
        }

        $account_ledger->save();

        Session::flash('success','New Account Head created Successfully.');

        return redirect()->route('accounts.ledgers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function head_destroy($id)
    {
        $head = AccountHead::find($id);
        $head->delete();
        Session::flash('success','Account Head Deleted Successfully.');
        return redirect()->back();
    }

    public function ledger_destroy($id)
    {
        $ledger = AccountLedger::find($id);
        $ledger->delete();
        Session::flash('success','Account Ledger Deleted Successfully.');
        return redirect()->back();
    }

    public function change_status_head($id){
        $head = AccountHead::find($id);
        if($head){
            if($head->status == 1){
                $head->status = 0;
            }else{
                $head->status = 1;
            }
            $head->save();
        }        

        Session::flash('success','Status Updated Successfully.');
        return redirect()->back();
    }
}