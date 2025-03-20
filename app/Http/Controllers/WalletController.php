<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use Bavix\Wallet\Models\Wallet;
use App\Http\Requests\DepositPostRequest;
use App\Http\Requests\WithdrawPostRequest;
class WalletController extends Controller
{

    public function getBalance()
    {
        $user = auth()->user();
        return response()->json([
            'balance' => $user->balance,
        ]);
    }

    public function deposit(DepositPostRequest $request)
    {
        $user = auth()->user();
        $user->deposit($request->amount);
        return response()->json([
            'message' => 'Deposit successful',
        ]);
    }

    public function withdraw(WithdrawPostRequest $request)
    {
        $user = auth()->user();
        $user->withdraw($request->amount);
        return response()->json([
            'message' => 'Withdrawal successful',
        ]);
    }
}
