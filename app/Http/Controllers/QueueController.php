<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    // 1. Tampilkan Form
    public function create()
    {
        $doctors = Doctor::with('poli')->get(); // Ambil semua dokter & polinya
        return view('queues.create', compact('doctors'));
    }

    // 2. Simpan Data (Logic Spek Ada di Sini)
    public function store(Request $request)
    {


$request->validate([
    'doctor_id' => 'required|exists:doctors,id',
    'appointment_date' => 'required|date|after_or_equal:today',
    'complaint' => 'required|string|min:10',
], [
    'complaint.min' => 'Keluhannya yang lengkap dong bung, minimal 10 karakter!',
    'appointment_date.after_or_equal' => 'Masa mau daftar buat kemarin? Pilih tanggal hari ini atau besok ya.',
]);

        // CEK 1: Apakah user sudah daftar di dokter yang sama pada tanggal tersebut?
        $alreadyRegistered = Queue::where('user_id', Auth::id())
            ->where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'Bung, lu sudah terdaftar di dokter ini untuk tanggal tersebut.');
        }

        // CEK 2: Apakah kuota dokter sudah penuh (Maks 20)?
        $currentCount = Queue::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->count();

        if ($currentCount >= 20) {
            return back()->with('error', 'Maaf bung, kuota dokter ini sudah penuh (Max 20).');
        }

        // SIMPAN: Generate nomor antrian (jumlah orang hari itu + 1)
        Queue::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'queue_number' => $currentCount + 1,
            'complaint' => $request->complaint,
            'status' => 'WAITING',
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil daftar! Nomor antrian lu: ' . ($currentCount + 1));
    }

// Tampilkan riwayat user
public function index()
{
    $queues = Queue::with('doctor.poli')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('queues.index', compact('queues'));
}

// Fitur Cancel (Hanya jika WAITING)
public function cancel(Queue $queue)
{
    // Pastikan ini milik user yang login
    if ($queue->user_id !== auth()->id()) {
        abort(403);
    }

    if ($queue->status !== 'WAITING') {
        return back()->with('error', 'Cuma antrian WAITING yang bisa di-cancel bung!');
    }

    $queue->update(['status' => 'CANCELED']);
    return back()->with('success', 'Antrian berhasil dibatalkan.');
}


public function adminIndex()
{
    // Cek role admin
    if (auth()->user()->role !== 'admin') abort(403);

    $doctors = Doctor::with(['queues' => function($q) {
        $q->where('appointment_date', now()->toDateString())
          ->whereIn('status', ['WAITING', 'CALLED'])
          ->orderBy('queue_number');
    }])->get();

    return view('admin.dashboard', compact('doctors'));
}

public function callNext($doctorId)
{
    $next = Queue::where('doctor_id', $doctorId)
        ->where('appointment_date', now()->toDateString())
        ->where('status', 'WAITING')
        ->orderBy('queue_number', 'asc')
        ->first();

    if (!$next) {
        return back()->with('error', 'Gak ada antrian lagi buat dokter ini bung.');
    }

    $next->update(['status' => 'CALLED']);
    return back()->with('success', 'Memanggil nomor ' . $next->queue_number);
}

}
