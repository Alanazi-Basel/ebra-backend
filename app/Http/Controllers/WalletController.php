<?php
namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepositPostRequest;
use App\Http\Requests\WithdrawPostRequest;

class WalletController extends Controller
{
    protected WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function getBalance(): JsonResponse
    {
        $wallet = Auth::user()->wallet;
        return response()->json(['balance' => $wallet ? $wallet->balance : 0.00]);
    }

    public function deposit(DepositPostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $wallet = $this->walletService->deposit(Auth::user(), $validated['amount']);

        return response()->json(['message' => 'Deposit successful', 'balance' => $wallet->balance]);
    }

    public function withdraw(WithdrawPostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($this->walletService->withdraw(Auth::user(), $validated['amount'])) {
            return response()->json(['message' => 'Withdrawal successful']);
        }

        return response()->json(['message' => 'Insufficient balance'], 400);
    }
}
