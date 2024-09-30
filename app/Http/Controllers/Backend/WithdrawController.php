<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{

    public function Bkash(){
        $bkash = Withdraw::select('withdraws.*','users.name')
                ->join('users','users.id','withdraws.user_id')
                ->where('method','Bkash')
                ->get();

        return view('backend.withdraw.bkash',compact('bkash'));
    }

    public function Nagad(){
        $nagad = Withdraw::select('withdraws.*','users.name')
                ->join('users','users.id','withdraws.user_id')
                ->where('method','Nagad')
                ->get();

        return view('backend.withdraw.nagad',compact('nagad'));
    }

    public function Bank(){
        $bank = Withdraw::select('withdraws.*','users.name')
                ->join('users','users.id','withdraws.user_id')
                ->where('method','Bank')
                ->get();

        return view('backend.withdraw.bank',compact('bank'));
    }

    public function Cash(){
        $cash = Withdraw::select('withdraws.*','users.name')
                ->join('users','users.id','withdraws.user_id')
                ->where('method','cash')
                ->get();
        return view('backend.withdraw.cash',compact('cash'));
    }


    public function Withdrawstatus($id){
        $withdraw = Withdraw::findOrFail($id);
        $user = User::findOrFail($withdraw->user_id);

        $user->wallet_balance = $user->wallet_balance - $withdraw->amount;
        $user->save();

        $withdraw->status = 1;
        $withdraw->save();

        $notification = array(
            'message' => 'Withdraw Succfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
