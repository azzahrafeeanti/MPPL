<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;


class FrontController extends Controller
{
    //
    public function index()
    {
        $eventQuery= Event::query()->where('is_active', 1);
        return view('landing.index', [
            'events' => $eventQuery->paginate(3),
        ]);
    }

    public function cariEvent(Request $request)
    {
        $eventQuery= Event::query()->where('is_active', 1);

        // --- Logika Pencarian (Search) ---
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $eventQuery->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
                // Anda bisa menambahkan kolom lain yang ingin dicari
            });
        }

        if ($request->has('filter') && $request->filter != '') {
            $filter = $request->filter;
            $currentDate = Carbon::now('Asia/Jakarta'); // Gunakan timezone spesifik untuk akurasi

            switch ($filter) {
                case 'all':
                    $eventQuery->where('is_active', 1);
                    break;
                case 'free':
                    $eventQuery->where('price', 0)
                            ->where('is_active', 1);
                    break;
                case 'paid':
                    $eventQuery->where('price', '>', 0)
                            ->where('is_active', 1);
                    break;
                default:
                    $eventQuery->where('is_active', 1);
                    break;
            }

        } else {
        // Default jika tidak ada filter, tampilkan event aktif
        $eventQuery->where('is_active', 1);
        }

        return view('landing.cariEvent', [
            'events'=> $eventQuery->paginate(8), // 'events' (key) → untuk banyak data event (list/daftar).
        ]);
    }
    


    // public function eventDetail($slug) // maksudnya adalah
    // {
    //     $event = Event::where('slug', $slug)->
    //     where('is_active', 1)->
    //     firstOrFail();
    //     return view('order.pesanEvent', [
    //         $event->slug
    //         ]);
    //     }
    

    public function csr()
    {
        return view('landing.csr');
    }

    public function aboutUs()
    {
        return view('landing.aboutUs');
    }

    public function panduan()
    {
        return view('landing.panduan');
    }

    public function editprofil()
    {
        return view('landing.editProfil');
    }
}

