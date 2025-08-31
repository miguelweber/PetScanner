const express = require('express');
const router = express.Router();
const { registrar, login } = require('../controllers/autenticacaoController');

router.post('/registrar', registrar);
router.post('/login', login);

module.exports = router;
