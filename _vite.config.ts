import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from "path" 
// import checker from 'vite-plugin-checker';


export default defineConfig({
    plugins: [
        // checker({
        //     typescript: true,
        // }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/src/app.ts',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            "~": path.resolve(__dirname + "/resources/src/"),
            "store": path.resolve(__dirname + "/resources/src/store/"),
        },
        extensions: [".mjs", ".js", ".ts", ".jsx", ".tsx", ".json", ".vue"],
    },
});
