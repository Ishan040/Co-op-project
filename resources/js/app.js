import './bootstrap';

import Alpine from 'alpinejs';

import QRious from 'qrious';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const generateQrCodeButton = document.getElementById("generateQrCode");
    const qrCodeContainer = document.getElementById("qrCodeContainer");

    generateQrCodeButton.addEventListener("click", function () {
            console.log("Button Clicked");

        const userProfile = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            contact: document.getElementById("contact").value,
            address: document.getElementById("address").value,
        };

        qrCodeContainer.innerHTML = '';

        const qr = new QRious({
            element: qrCodeContainer,
            value: JSON.stringify(userProfile),
            size: 200,
        })

        console.log("Button Element:", generateQrCodeButton);
        console.log("QR Code Container Element:", qrCodeContainer);
        console.log("QRious Instance:", qr);


        qrCodeContainer.style.display = "block";
    });
});