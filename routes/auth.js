// routes/auth.js
const express = require('express');
const router = express.Router();
const jwt = require('jsonwebtoken');

// Aquí deberías tener tu modelo de usuario (User) para la autenticación con JWT
// const User = require('../models/User');

// Ruta para el login
router.post('/login', async (req, res) => {
    const { email, password } = req.body;

    // Aquí debes validar al usuario con tu base de datos (ejemplo usando el modelo User)
    // const user = await User.findOne({ email });
    
    // Para este ejemplo, vamos a simular una validación exitosa
    if (email === "test@example.com" && password === "password") {
        const token = jwt.sign({ email }, 'your_jwt_secret', { expiresIn: '1h' }); // Secret key
        return res.json({ token });
    }

    res.status(401).json({ message: 'Credenciales inválidas' });
});

module.exports = router;
