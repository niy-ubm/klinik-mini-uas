<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Antrian Klinik</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif


<form action="{{ route('queues.store') }}" method="POST">
    @csrf
    
    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Pilih Dokter</label>
        <select name="doctor_id" class="w-full border-gray-300 rounded-md shadow-sm">
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->name }} (Poli {{ $doctor->poli->name }})
                </option>
            @endforeach
        </select>
        @error('doctor_id') 
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Tanggal Kunjungan</label>
        <input type="date" name="appointment_date" value="{{ old('appointment_date', date('Y-m-d')) }}" 
               class="w-full border-gray-300 rounded-md shadow-sm @error('appointment_date') border-red-500 @enderror">
        @error('appointment_date') 
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Keluhan Singkat (Min 10 Karakter)</label>
        <textarea name="complaint" rows="3" 
                  class="w-full border-gray-300 rounded-md shadow-sm @error('complaint') border-red-500 @enderror">{{ old('complaint') }}</textarea>
        @error('complaint') 
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
        @enderror
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
        Kirim Pendaftaran
    </button>
</form>
            </div>
        </div>
    </div>
</x-app-layout>
