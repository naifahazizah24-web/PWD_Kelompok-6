const db = require('./db');

const handlePaymentCallback = async (req, res) => {
    try {
        const { order_id, status_pembayaran } = req.body;

        if (status_pembayaran === 'success') {
           
            await db.query(
                "UPDATE transactions SET status = 'success' WHERE order_id = ?",
                [order_id]
            );

            return res.status(200).json({
                success: true,
                message: `Status pembayaran untuk ${order_id} berhasil diubah menjadi success.`
            });
        }

        return res.status(400).json({ success: false, message: "Status tidak valid" });
    } catch (error) {
        return res.status(500).json({ success: false, error: error.message });
    }
};

module.exports = { handlePaymentCallback };
