const jwt = require('jsonwebtoken');
const QRCode = require('qrcode');

const SECRET_KEY = "KONSER_SECRET_SUPER_SECURE_2026";

const generateSecureTicketQR = async (ticketId, userId) => {
    try {
    
        const encryptedData = jwt.sign(
            { ticketId, userId, timestamp: Date.now() }, 
            SECRET_KEY
        );

        const qrCodeImage = await QRCode.toDataURL(encryptedData);

        return {
            success: true,
            ticket_code: encryptedData,
            qr_image_base64: qrCodeImage 
        };
    } catch (error) {
        console.error("Gagal generate QR Code:", error);
        return { success: false, error: error.message };
    }
};

module.exports = { generateSecureTicketQR, SECRET_KEY };
