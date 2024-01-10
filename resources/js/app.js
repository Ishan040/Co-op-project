import './bootstrap';

import Alpine from 'alpinejs';
import QRious from 'qrious';

window.Alpine = Alpine;


document.addEventListener("DOMContentLoaded", function () {
    const generateQrCodeButton = document.getElementById("generateQrCode");
    const qrCodeContainer = document.getElementById("qrCodeContainer");
    const qrCodeCanvas = document.getElementById("qrCodeContainer");
    const qrBox = document.getElementById("qrBox");


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
            element: qrCodeCanvas,
            value: JSON.stringify(userProfile),
            size: 200,
        });

        qrBox.style.display = "block";
        qrCodeContainer.style.width = "200px";
        qrCodeContainer.style.height = "200px";
        qrCodeContainer.style.border = "1px solid black";
        qrCodeContainer.style.background = "#ffffff";
        profileForm.style.width = "50%";

        console.log("Button Element:", generateQrCodeButton);
        console.log("QR Code Container Element:", qrCodeContainer);
        console.log("QRious Instance:", qr);
        console.log("User Profile:", userProfile);


        qrCodeContainer.style.display = "block";
    });
});

Alpine.start();