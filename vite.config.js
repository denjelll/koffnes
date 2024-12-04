import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fg from "fast-glob";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                ...fg.sync("resources/js/**/*.js"),
            ],
            refresh: true,
        }),
    ],
});
