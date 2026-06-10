const jwt = require('jsonwebtoken');
const QRCode = require('qrcode');

const SECRET_KEY = "KONSER_SECRET_SUPER_SECURE_2026"; // Kunci enkripsi JWT

// Fungsi untuk membuat data transaksi terenkripsi dalam bentuk QR Code
const generateSecureTicketQR = async (ticketId, userId) => {
    try {
        // 1. Enkripsi data ke dalam JWT payload agar tidak bisa dipalsukan/diedit orang lain
        const encryptedData = jwt.sign(
            { ticketId, userId, timestamp: Date.now() }, 
            SECRET_KEY
        );

        // 2. Ubah string JWT terenkripsi tersebut menjadi Data URL QR Code (Gambar Base64)
        const qrCodeImage = await QRCode.toDataURL(encryptedData);

        return {
            success: true,
            ticket_code: encryptedData, // Disimpan ke database tabel tickets
            qr_image_base64: qrCodeImage // Dikirim ke frontend/email user untuk ditampilkan
        };
    } catch (error) {
        console.error("Gagal generate QR Code:", error);
        return { success: false, error: error.message };
    }
};

module.exports = { generateSecureTicketQR, SECRET_KEY };
