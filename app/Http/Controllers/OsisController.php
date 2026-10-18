<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OsisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $daftar = Http::get('http://localhost:8000/api/pendaftaran-osis');
        if($daftar->failed()){
            return response()->json(['message' => 'Gagal mengambil data dari API']);
        }
        return view('welcome', ['daftar' => $daftar->json('data') ?? []]);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|integer',
            'pilihan_bidang' => 'required|string|in:kepemimpinan,keagamaan,olahraga,seni',
            'motivasi' => 'required|string|min:20|max:300',
        ]);

        $daftar = Http::post(
            'http://localhost:8000/api/pendaftaran-osis',
            $validated
        );

        if ($daftar->failed()) {
            return back()
                ->withErrors(
                    $daftar->json('errors') ?? [
                        'api' => 'Gagal melakukan pendaftaran.'
                    ]
                )
                ->withInput();
        }

        return redirect()
            ->route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daftar = Http::get("http://localhost:8000/api/pendaftaran-osis/{$id}");

        if ($daftar->failed()){
            abort(404, 'Pendaftaran tidak ditemukan');
        }

        $daftar = $daftar->json('data');

        return view('edit', compact('daftar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pilihan_bidang' => 'required|string|in:kepemimpinan,keagamaan,olahraga,seni',
            'motivasi' => 'required|string|min:20|max:300',
        ]);

        $daftar = Http::put(
            "http://localhost:8000/api/pendaftaran-osis/{$id}",
            $validated
        );

        if ($daftar->failed()) {
            return back()
                ->withErrors(
                    $daftar->json('errors') ?? [
                        'api' => 'Gagal melakukan edit.'
                    ]
                )
                ->withInput();
        }

        return redirect()
            ->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete(
            "http://localhost:8000/api/pendaftaran-osis/{$id}"
        );

        if ($response->failed()) {
            return back()->withErrors([
                'api' => 'Gagal menghapus pendaftaran.'
            ]);
        }

        return redirect()
            ->route('welcome');
    }
    }
