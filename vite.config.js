import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fg from "fast-glob";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/bootstrap.js",
                ...fg.sync("resources/js/**/*.js"),
            ],
            refresh: true,
        }),
    ],
});
