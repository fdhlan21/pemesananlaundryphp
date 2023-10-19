const express = require('express');
const mysql = require('mysql');

const app = express();
const connection = mysql.createConnection({
host: 'localhost',
user: 'your_username',
password: 'your_password',
database: 'your_database',
});

// Endpoint untuk mengambil data pengguna
app.get('/users', (req, res) => {
const query = 'SELECT * FROM users';

connection.query(query, (error, results) => {
if (error) {
console.log('Terjadi kesalahan saat mengambil data pengguna');
res.status(500).json({ error: 'Terjadi kesalahan saat mengambil data pengguna' });
} else {
res.json(results);
}
});
});

// Menjalankan server pada port tertentu
app.listen(3000, () => {
console.log('Server berjalan pada port 3000');
});