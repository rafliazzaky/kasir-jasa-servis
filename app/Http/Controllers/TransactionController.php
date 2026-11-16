<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('transactions.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        DB::beginTransaction();
        try {
            // Hitung Total Harga
            $totalPrice = 0;
            $services = Service::whereIn('id', $request->service_ids)->get();
            foreach ($services as $service) {
                $totalPrice += $service->price;
            }

            // Simpan Transaksi Utama
            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . date('YmdHis') . '-' . rand(100, 999),
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
            ]);

            // Simpan Detail Servis
            foreach ($services as $service) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'service_id' => $service->id,
                    'qty' => 1,
                    'subtotal' => $service->price,
                ]);
            }

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Transaksi ' . $transaction->invoice_number . ' berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
}