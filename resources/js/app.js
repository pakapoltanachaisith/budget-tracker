import htmx from "htmx.org";
import Alpine from "alpinejs";

window.htmx = htmx;
window.Alpine = Alpine;

Alpine.start();

document.body.addEventListener("htmx:configRequest", (event) => {
    event.detail.headers["X-CSRF-TOKEN"] = document.querySelector(
        'meta[name="csrf-token"]',
    ).content;
});
