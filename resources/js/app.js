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

        const qrData = JSON.stringify(userProfile);
            localStorage.setItem('qrData', qrData);
            console.log("Stored QR Data:", qrData);

        qrCodeContainer.innerHTML = '';

        const qr = new QRious({
            element: qrCodeCanvas,
            value: JSON.stringify(userProfile),
            size: 200,
        });

        qrBox.style.display = "block";
        qrCodeContainer.style.width = "200px";
        qrCodeContainer.style.height = "200px";
        profileForm.style.width = "100%";

        console.log("Button Element:", generateQrCodeButton);
        console.log("QR Code Container Element:", qrCodeContainer);
        console.log("QRious Instance:", qr);
        console.log("User Profile:", userProfile);

        const storedQrData = localStorage.getItem('qrData');
        console.log("Retrieved QR Data:", storedQrData);
        if (storedQrData) {
            const userProfile = JSON.parse(storedQrData);

            const qr = new QRious({
                element: qrCodeCanvas,
                value: JSON.stringify(userProfile),
                size: 200,
            });
        }


        qrCodeContainer.style.display = "block";
    });
});

Alpine.start();