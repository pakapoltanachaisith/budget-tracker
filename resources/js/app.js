import htmx from "htmx.org";

window.htmx = htmx;

document.body.addEventListener("htmx:configRequest", (event) => {
    event.detail.headers["X-CSRF-TOKEN"] = document.querySelector(
        'meta[name="csrf-token"]',
    ).content;
});
