<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tambah Pendaftaran OSIS</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50">
<div class="bg-[#222A68] p-5 flex justify-between items-center">
    <div class="flex gap-5">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        <h1 class="text-white font-bold text-[25px] text-start">Tambah Pendaftaran OSIS</h1>
    </div>

    <a href="{{ route('welcome') }}"
        class="rounded-md bg-white px-g4 py-2 text-sm font-semibold text-[#222A68] hover:bg-gray-200">
        &larr; Kembali
    </a>
</div>

<div class="mt-20 px-4 max-w-xl mx-auto">
    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-100 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm bg-white">
        <div class="bg-[#222A68] text-white px-4 py-3 text-sm font-semibold">
            Form Pendaftaran
        </div>

        <form action="{{ route('osis.store') }}" method="POST" class="p-6 flex flex-col gap-4 text-sm">
            @csrf

            <div>
                <label for="siswa_id" class="block mb-1 font-medium text-gray-700">ID Siswa</label>
                <input type="number" id="siswa_id" name="siswa_id" value="{{ old('siswa_id') }}" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:border-[#222A68] focus:ring ring-gray-300">
            </div>

            <div>
                <label for="pilihan_bidang" class="block mb-1 font-medium text-gray-700">Bidang</label>
                <select id="pilihan_bidang" name="pilihan_bidang" required
                        class="w-full rounded-md border border-gray-300 px-4 py-2 bg-white focus:outline-none focus:border-[#222A68] focus:ring ring-gray-300">
                    <option value="" disabled {{ old('pilihan_bidang') ? '' : 'selected' }}>-- Pilih bidang --</option>
                    @foreach (['kepemimpinan', 'keagamaan', 'olahraga', 'seni'] as $bidang)
                        <option value="{{ $bidang }}" {{ old('pilihan_bidang') === $bidang ? 'selected' : '' }}>
                            {{ ucfirst($bidang) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="motivasi" class="block mb-1 font-medium text-gray-700">Motivasi</label>
                <textarea id="motivasi" name="motivasi" rows="5" required minlength="20" maxlength="300"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:border-[#222A68] focus:ring ring-gray-300">{{ old('motivasi') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Minimal 20 karakter, maksimal 300 karakter.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <a href="{{ route('welcome') }}"
                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit"
                        class="rounded-md bg-[#222A68] px-4 py-2 text-sm font-semibold text-white hover:bg-black">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
    </body>
</html>