import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import os from 'os'; // Import modul OS

// Fungsi untuk nyari IP local secara otomatis
function getLocalIp() {
    const interfaces = os.networkInterfaces();
    for (const name of Object.keys(interfaces)) {
        for (const iface of interfaces[name]) {
            // Cari IPv4 yang bukan internal (bukan 127.0.0.1)
            if (iface.family === 'IPv4' && !iface.internal) {
                return iface.address;
            }
        }
    }
    return 'localhost';
}

const currentIp = getLocalIp();

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: currentIp, // Otomatis pake IP yang lagi aktif
        },
    },
});
