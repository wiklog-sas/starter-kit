import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from "@rollup/plugin-inject";

import path from 'path'; // en remplacement de `const path = require('path')` car `"type": "module"` dans le fichier package.json

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~node_modules': path.resolve(__dirname, 'node_modules')
        }
    },
    build: {
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }
    }
});
