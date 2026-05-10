import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

/* ── Store: notificaciones (polling ligero) ── */
Alpine.store('notifs', {
    count: 0,
    init() {
        // Leer el valor inicial del DOM (meta tag o variable Blade)
        const el = document.getElementById('notif-count');
        if (el) this.count = parseInt(el.dataset.count) || 0;
    },
});

/* ── Store: toast global ─────────────────────
   Uso: $store.toast.show('Cuidado guardado', 'success')
────────────────────────────────────────────── */
Alpine.store('toast', {
    visible: false,
    message: '',
    type: 'success',   // success | error | warning | info
    timer: null,
    show(msg, type = 'success', duration = 3500) {
        this.message = msg;
        this.type    = type;
        this.visible = true;
        clearTimeout(this.timer);
        this.timer = setTimeout(() => this.visible = false, duration);
    },
    hide() { this.visible = false; },
});

/* ── Magic: $confirm (reemplaza window.confirm) ──
   Uso: x-on:click="if(await $confirm('¿Eliminar?')) submit()"
────────────────────────────────────────────── */
Alpine.magic('confirm', () => (message) => {
    return new Promise(resolve => {
        // Puedes reemplazar esto con un modal Alpine propio
        resolve(window.confirm(message));
    });
});

Alpine.start();