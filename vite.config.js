import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [vue()],
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: {
        index: resolve(__dirname, 'src/pages/index.js'),
        result: resolve(__dirname, 'src/pages/result.js'),
      },
      output: {
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name]-chunk.js',
        assetFileNames: 'assets/[name].[ext]',
      },
    },
  },
  server: {
    origin: 'http://localhost:5173',
  },
})
