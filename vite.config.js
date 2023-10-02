import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0",
        hmr: { host: "local.beautyflow.com" },
        watch: { usePolling: true },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [...refreshPaths, "app/Livewire/**"],
        }),
    ],
});
