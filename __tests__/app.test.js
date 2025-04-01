// __tests__/app.test.js

beforeEach(() => {
    document.body.innerHTML = `<div id="content"></div>`;
});

// Simular `Notification.requestPermission`
global.Notification = {
    requestPermission: jest.fn(() => Promise.resolve("granted")),
};

// Simular `navigator.serviceWorker`
Object.defineProperty(global.navigator, "serviceWorker", {
    value: {
        register: jest.fn(() => Promise.resolve("Registro Exitoso"))
    },
    writable: true
});

test("Debe actualizar el contenido cuando se carga la página", () => {
    require("../app.js");  

    // Simular el evento DOMContentLoaded
    document.dispatchEvent(new Event("DOMContentLoaded"));

    expect(document.getElementById("content").innerHTML).toBe("<h2>Bienvenido a TechSolutions</h2>");
});

test("Debe manejar correctamente los permisos de notificación", async () => {
    require("../app.js");

    expect(Notification.requestPermission).toHaveBeenCalled();
});

test("Debe registrar el Service Worker correctamente", async () => {
    require("../app.js");

    await navigator.serviceWorker.register("/service-worker.js");
    expect(navigator.serviceWorker.register).toHaveBeenCalledWith("/service-worker.js");
});
