import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/admin.css', // ← wieder dazu
                'resources/js/admin.js'    // ← wieder dazu
            ],

            refresh: true,
        }),
    ],
});
