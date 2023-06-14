import { defineConfig } from "vite"
import vue from "@vitejs/plugin-vue"
import laravel from 'laravel-vite-plugin'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  base: "./",
  // css: {
  //   devSourcemap: true,
  // },
  plugins: [
    vue(),
    laravel([
      path.resolve(__dirname, 'resources/sass/app.scss'),
      path.resolve(__dirname, 'resources/src/app.ts'),
    ]),
  ],
  resolve: {
    alias: {
      '@': '/resources/src',
    }
  },
  define: {
    'process.env.VITE_PUSHER_HOST': `"${process.env.VITE_PUSHER_HOST}"`
  }
})
