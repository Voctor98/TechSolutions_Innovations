/// <reference types="cypress" />

describe("Flujo de usuario en TechSolutions PWA", () => {
    
    beforeEach(() => {
        cy.visit("http://localhost/TechSolutions_Innovations"); // Cambia según tu URL local
    });

    it("Debe mostrar la página de inicio correctamente", () => {
        cy.get("body").should("contain", "Bienvenido a TechSolutions"); // Cambié #content por un selector más general
    });

    it("Debe solicitar permisos de notificación", () => {
        cy.stub(Notification, "requestPermission").resolves("granted");
        cy.reload();
        cy.wrap(Notification.requestPermission).should("have.been.called");
    });

    it("Debe registrar el Service Worker", () => {
        cy.window().then((win) => {
            cy.stub(win.navigator.serviceWorker, "register").resolves();
        });

        cy.reload();
        cy.window().its("navigator.serviceWorker.register").should("have.been.called");
    });

    it("Debe navegar a la página de contacto", () => { // Cambié a "contacto.php" que parece más acorde con una página informativa
        cy.get('a[href="contacto.php"]').click(); // Ajusta la URL según lo que tengas en tu página
        cy.url().should("include", "contacto.php");
        cy.get("h2").should("contain", "Contacto");
    });
});
