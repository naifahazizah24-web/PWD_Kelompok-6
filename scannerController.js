const jwt = require('jsonwebtoken');
const db = require('./db');
const { SECRET_KEY } = require('./ticketSecurityService');

const scanTicketGate = async (req, res) => {
    try {
        const { qr_code_string } = req.body; 

        // 1. Dekripsi dan Verifikasi apakah QR Code tersebut asli/buatan sistem kita
        let decoded;
        try {
            decoded = jwt.verify(qr_code_string, SECRET_KEY);
        } catch (err) {
            return res.status(401).json({ 
                access_granted: false, 
                message: "QR Code PALSU atau tidak valid!" 
            });
        }

        const { ticketId } = decoded;

        // 2. VALIDASI & UPDATE DALAM 1 QUERY (PENTING untuk mencegah Double Scanning/Race Condition)
        // Query ini hanya akan mengupdate jika is_used bertanda 'FALSE'
        const [result] = await db.query(
            "UPDATE tickets SET is_used = TRUE WHERE id = ? AND is_used = FALSE",
            [ticketId]
        );

        // Jika row affected = 0, artinya tiket sudah pernah digunakan sebelumnya (atau ID salah)
        if (result.affectedRows === 0) {
            return res.status(409).json({ 
                access_granted: false, 
                message: "PERINGATAN: Tiket ini SUDAH PERNAH DI-SCAN sebelumnya!" 
            });
        }

        // 3. Jika berhasil lolos validasi, izinkan masuk konser
        return res.status(200).json({
            access_granted: true,
            message: "Tiket VALID. Selamat menikmati konser!",
            ticket_info: decoded
        });

    } catch (error) {
        return res.status(500).json({ access_granted: false, error: error.message });
    }
};

module.exports = { scanTicketGate };