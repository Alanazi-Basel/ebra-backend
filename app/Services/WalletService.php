<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    public function createWallet(User $user): Wallet
    {
        return Wallet::firstOrCreate(['user_id' => $user->id]);
    }

    public function deposit(User $user, float $amount): Wallet
    {
        return DB::transaction(function () use ($user, $amount) {
            $wallet = $this->createWallet($user);
            $wallet->deposit($amount);
            return $wallet;
        });
    }

    public function withdraw(User $user, float $amount): bool
    {
        return DB::transaction(function () use ($user, $amount) {
            $wallet = $this->createWallet($user);
            return $wallet->withdraw($amount);
        });
    }
}
