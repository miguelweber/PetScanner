const express = require('express');
const router = express.Router();
const { autenticarToken } = require('../middlewares/autenticacao');
const {
  obterPerfil,
  atualizarPerfil,
  atualizarSenha
} = require('../controllers/usuarioController');

// Todas as rotas requerem autenticação
router.use(autenticarToken);

router.get('/perfil', obterPerfil);
router.put('/perfil', atualizarPerfil);
router.put('/senha', atualizarSenha);

module.exports = router;
