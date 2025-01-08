<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(){
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $registrationFee = 100000; // Biaya registrasi tetap

        // Validasi input pembayaran
        $validated = $request->validate([
            'payment' => ['required', 'numeric', 'min:1'],
        ]);

        $paidAmount = $validated['payment'];
        $excessAmount = $paidAmount - $registrationFee;
        $underpaidAmount = $registrationFee - $paidAmount;

        // Jika pembayaran kurang dari biaya registrasi
        if ($paidAmount < $registrationFee) {
            session(['underpaid' => $underpaidAmount]);
            return redirect()->route('payment')->with('underpaid', $underpaidAmount);
        }

        // Jika pembayaran lebih dari biaya registrasi
        if ($excessAmount > 0) {
            $coins = floor(($excessAmount / 1000)) + 100;  // Pastikan pembulatan dan penambahan koin dilakukan dengan benar.

            $user = Auth::user();
            $user->coin += $coins;  // Tambahkan coin ke saldo pengguna
            $user->save();

            // Menyimpan session untuk pembayaran lebih
            session(['overpaid' => $excessAmount]);
            session(['coins' => $coins]);
            return redirect()->route('payment')->with('overpaid', $excessAmount);
            // return redirect('/')->with('success', 'Payment received. Overpayment has been converted to ' . $coins . ' coins.');
        }

        // Jika pembayaran sesuai
        if ($paidAmount == $registrationFee) {
            $user = Auth::user();
            $user->coin += 100;  // Tambahkan coin ke saldo pengguna
            $user->save();
            return redirect('/')->with('success', 'Registration successful!');
        }
    }

    public function confirmOverpayment(Request $request)
    {
        $user = Auth::user();
        $excessAmount = session('overpaid', 0);
        $coins = session('coins', 0) + 100;  // Penambahan koin 100 sebagai default

        if ($request->input('confirm') === 'yes') {
            $user->coin += $coins;  // Tambahkan coin ke saldo pengguna
            $user->save();

            // Simpan jumlah coin terbaru ke session
            session(['userCoins' => $user->coin]);

            return redirect('/')->with('success', 'Overpayment has been converted to ' . $coins . ' coins.');
        }

        return redirect()->route('payment')->with('error', 'Please enter the correct payment amount again.');
    }
}
