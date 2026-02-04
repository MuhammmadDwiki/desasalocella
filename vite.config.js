import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx'
            ],
            refresh: [
                'resources/views/**', // Watch all Blade files in resources/views
                'routes/**',          // Watch your route files as well
            ],
        }),
        react(),
    ],
});
