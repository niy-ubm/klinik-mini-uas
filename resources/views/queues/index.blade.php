<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Antrian Lu</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">No</th>
                            <th class="p-2">Dokter</th>
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queues as $q)
                        <tr class="border-b">
                            <td class="p-2 font-bold text-blue-600">#{{ $q->queue_number }}</td>
                            <td class="p-2">{{ $q->doctor->name }}</td>
                            <td class="p-2">{{ $q->appointment_date }}</td>
                            <td class="p-2">
                                <span class="px-2 py-1 text-xs rounded-full {{ $q->status == 'WAITING' ? 'bg-yellow-100' : 'bg-gray-100' }}">
                                    {{ $q->status }}
                                </span>
                            </td>
                            <td class="p-2">
                                @if($q->status == 'WAITING')
                                <form action="{{ route('queues.cancel', $q->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="text-red-500 hover:underline">Cancel</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
