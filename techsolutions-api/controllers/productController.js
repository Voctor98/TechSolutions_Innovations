let products = [
    { id: 1, name: 'Laptop', price: 12000 },
    { id: 2, name: 'Mouse', price: 250 },
];

exports.getAllProducts = (req, res) => {
    res.json(products);
};

exports.createProduct = (req, res) => {
    const { name, price } = req.body;
    const newProduct = { id: Date.now(), name, price };
    products.push(newProduct);
    res.status(201).json(newProduct);
};

exports.deleteProduct = (req, res) => {
    const { id } = req.params;
    products = products.filter(p => p.id !== parseInt(id));
    res.status(204).end();
};
