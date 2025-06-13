<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Promo;


class OrderController extends Controller
{
    
    
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->
        where('is_active', 1)->
        firstOrFail();

        return view('order.pesanEvent', [
            'event' => $event,
            ]);
        }

    public function successPage($slug, $transaction_id)
    {
        $event = Event::where('slug', $slug)->
        where('is_active', 1)->
        firstOrFail();

        $transaction = Transaction::where('id', $transaction_id)
        ->where('user_id', Auth::id())
        ->with(['event', 'promo']) // Eager load jika data event/promo dibutuhkan di successPage.blade.php
        ->firstOrFail();

        return view('order.successPage', compact("event", "transaction")); // PERBAIKAN: Lewatkan event juga

    }

    public function detailPemesanan($slug, $transaction_id)
    {
        $event = Event::where('slug', $slug)->
        where('is_active', 1)->
        firstOrFail();

        if(!Auth::check())
        {
            return redirect()->route("landing.signIn");
        }
    $transaction = Transaction::where('id', $transaction_id)
        ->where('user_id', Auth::id())
        ->where('event_id', $event->id)
        ->with(['promo'])
        ->firstOrFail();

    // return view('order.detailPemesanan', [
    //     'event' => $event,
    //     // 'transaction' => $transactions
    // ]);
    return view('order.detailPemesanan', [
        'event' => $event,
        'transaction' => $transaction
    ]);
}

// Handle creation of a new transaction (step 1)
public function handleDetailPemesanan(Request $request, $slug)
{
    if (!Auth::check()) {
        return redirect()->route('landing.signIn');
    }

    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $event = Event::where('slug', $slug)->firstOrFail();

    // Calculate amounts
    $subTotalAmount = $event->price * $request->quantity;
    $discount = 0; // Set your discount logic here if needed
    $grandTotalAmount = $subTotalAmount - $discount;

    // Generate a unique booking transaction ID
    $bookingTrxId = Transaction::generateUniqueTrxId();

    $transaction = Transaction::create([
        'user_id' => Auth::user()->id,
        'event_id' => $event->id,
        'quantity' => $request->quantity,
        'sub_total_amount' => $subTotalAmount,
        'discount_amount' => $discount,
        'grand_total_amount' => $grandTotalAmount,
        'booking_trx_id' => $bookingTrxId,
        'is_paid' => false,
        'name' => null, 'email' => null, 'date' => null, 'gender' => null, 'NIK' => null, 'proof' => null,
    ]);

    return redirect()->route('order.detailPemesanan', [
        'slug' => $slug,
        'transaction_id' => $transaction->id
    ]);
}

// Handle updating personal details (step 2)
public function updatePersonalDetails(Request $request, $slug, $transaction_id)
{
    if (!Auth::check()) {
        return redirect()->route('landing.signIn');
    }

    $event = Event::where('slug', $slug)->firstOrFail();
    $transaction = Transaction::where('id', $transaction_id)
                                ->where('user_id', Auth::id())
                                ->where('event_id', $event->id)
                                ->firstOrFail();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'date' => 'required|date',
        'gender' => 'required|in:laki-laki,perempuan',
        'NIK' => 'required|string|max:20',
        'akunSosmed' => 'required|string|max:255',
        'bersediaHandbook' => 'required|in:YA,TIDAK',
    ]);

    // Handle unggah file 'proof'
    $proofPath = $transaction->proof; // Pertahankan path lama jika tidak ada unggahan baru

    if ($request->hasFile('proof')) {
        // Hapus bukti lama jika ada dan file-nya benar-benar ada di storage
        if ($proofPath && Storage::disk('public')->exists($proofPath)) {
            Storage::disk('public')->delete($proofPath);
        }
        // Simpan file baru ke direktori 'proofs' di disk 'public'
        $proofPath = $request->file('proof')->store('proofs', 'public');
    }

    // Update transaksi HANYA dengan data yang ada di DB
    $transaction->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'date' => $validated['date'],
        'gender' => $validated['gender'],
        'NIK' => $validated['NIK'],
        'proof' => $proofPath,
        'social_media_account' => $validated['akunSosmed'],
        'agree_handbook' => ($validated['bersediaHandbook'] == 'YA'),
    ]);

    return redirect()->route('order.successPage', [
        'slug' => $slug,
        'transaction_id' => $transaction->id
    ]);
}

public function tiketSaya()
{
    if (!Auth::check()) {
        return redirect()->route('landing.signIn');
    }
    $transactions = Transaction::where('user_id', Auth::id())
                            ->with(['event']) // Eager load event relationship
                            ->orderBy('created_at', 'desc')
                            ->get(); // Gunakan get() untuk mengambil SEMUA hasil

    // Lewatkan data transaksi ke view
    return view('order.tiketSaya', [
        'transactions' => $transactions,
    ]);
}
}
