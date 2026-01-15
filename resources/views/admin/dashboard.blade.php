<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Petugas Klinik
            </h2>
            <span id="refresh-status" class="text-xs text-gray-400 italic">Auto-refresh aktif...</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div id="queue-container" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($doctors as $doctor)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">{{ $doctor->name }}</h3>
                            <form action="{{ route('admin.call_next', $doctor->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                                    Panggil
                                </button>
                            </form>
                        </div>
                        <div class="space-y-2">
                            @forelse($doctor->queues as $q)
                                <div class="p-3 {{ $q->status == 'CALLED' ? 'bg-blue-50 border-l-4 border-blue-500' : 'bg-gray-50' }} rounded">
                                    #{{ $q->queue_number }} - {{ $q->user->name }}
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">Kosong.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        setInterval(function() {
            const statusIndicator = document.getElementById('refresh-status');
            statusIndicator.innerText = 'Mengecek antrian baru...';

            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('queue-container').innerHTML;
                    
                    // Update hanya bagian container antrian
                    document.getElementById('queue-container').innerHTML = newContent;
                    
                    statusIndicator.innerText = 'Terakhir update: ' + new Date().toLocaleTimeString();
                })
                .catch(err => {
                    statusIndicator.innerText = 'Koneksi terputus...';
                    console.error(err);
                });
        }, 10000); // 10000ms = 10 detik
    </script>
</x-app-layout>
