const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors'); // For handling cross-origin requests

const app = express();
app.use(bodyParser.json());
app.use(cors());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'krispym'
});

db.connect((err) => {
    if (err) {
        console.error('Database connection failed:', err);
        return;
    }
    console.log('Connected to MySQL database');
});

app.get('/api/menu', (req, res) => {
    db.query('SELECT name, price, image_url FROM menu_items', (err, results) => {
        if (err) {
            console.error('Error fetching menu:', err);
            res.status(500).json({ error: 'Failed to fetch menu' });
            return;
        }
        res.json(results);
    });
});

app.post('/api/orders', (req, res) => {
    const orderData = req.body; // Contains the order details from localStorage
    const userId = 1; // Example user ID (you'd handle user authentication properly)
    const totalAmount = calculateTotal(orderData); // Implement this function

    db.query('INSERT INTO orders (user_id, order_date, total_amount, status) VALUES (?, NOW(), ?, ?)', [userId, totalAmount, 'pending'], (err, orderResult) => {
        if (err) {
            console.error('Error creating order:', err);
            res.status(500).json({ error: 'Failed to create order' });
            return;
        }
        const orderId = orderResult.insertId;
        const orderItems = [];
        for (const itemName in orderData) {
            if (orderData[itemName] > 0) {
                // You'd need to fetch the item price from the database again for accuracy
                const quantity = orderData[itemName];
                orderItems.push([orderId, itemName, quantity]);
            }
        }
        db.query('INSERT INTO order_items (order_id, item_name, quantity) VALUES ?', [orderItems], (err) => {
            if (err) {
                console.error('Error adding order items:', err);
                res.status(500).json({ error: 'Failed to add order items' });
                return;
            }
            res.json({ orderId: orderId, message: 'Order created successfully' });
        });
    });
});

// ... (API endpoint for payments) ...

app.listen(3000, () => {
    console.log('Server listening on port 3000');
});