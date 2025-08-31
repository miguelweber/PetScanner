const express = require('express');
const router = express.Router();
const { autenticarToken } = require('../middlewares/autenticacao');
const {
  listarPets,
  buscarPet,
  criarPet,
  atualizarPet,
  excluirPet,
  listarMeusPets
} = require('../controllers/petController');

// Rotas públicas
router.get('/', listarPets);
router.get('/:id', buscarPet);

// Rotas protegidas
router.post('/', autenticarToken, criarPet);
router.put('/:id', autenticarToken, atualizarPet);
router.delete('/:id', autenticarToken, excluirPet);
router.get('/usuario/meus-pets', autenticarToken, listarMeusPets);

module.exports = router;
