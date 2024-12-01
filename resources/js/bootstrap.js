import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

console.log("PUSHER_APP_KEY:", import.meta.env.VITE_PUSHER_APP_KEY);
console.log("PUSHER_APP_CLUSTER:", import.meta.env.VITE_PUSHER_APP_CLUSTER);

try {
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        forceTLS: true,
    });

    console.log("Echo initialized:", window.Echo);
} catch (error) {
    console.error("Error initializing Echo:", error);
}
