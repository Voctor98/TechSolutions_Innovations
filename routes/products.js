// routes/products.js
const express = require('express');
const router = express.Router();
const Product = require('../models/Product');

// Ruta para agregar un producto
router.post('/', async (req, res) => {
    const { name, price, description, imageUrl } = req.body;

    const newProduct = new Product({ name, price, description, imageUrl });
    try {
        const savedProduct = await newProduct.save();
        res.status(201).json(savedProduct);
    } catch (error) {
        res.status(500).json({ message: 'Error al agregar producto', error });
    }
});

// Ruta para obtener todos los productos
router.get('/', async (req, res) => {
    try {
        const products = await Product.find();
        res.json(products);
    } catch (error) {
        res.status(500).json({ message: 'Error al obtener productos', error });
    }
});

module.exports = router;
