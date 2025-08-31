const jwt = require('jsonwebtoken');
const Usuario = require('../models/Usuario');

const autenticarToken = (req, res, next) => {
  const authHeader = req.headers['authorization'];
  const token = authHeader && authHeader.split(' ')[1]; // Bearer TOKEN

  if (!token) {
    return res.status(401).json({ message: 'Token de acesso requerido' });
  }

  jwt.verify(token, process.env.JWT_SECRET || 'segredo_temporario', (err, usuario) => {
    if (err) {
      return res.status(403).json({ message: 'Token inválido' });
    }
    
    // Verificar se o usuário ainda existe no banco de dados
    Usuario.buscarPorId(usuario.id, (err, usuarioDB) => {
      if (err || !usuarioDB) {
        return res.status(403).json({ message: 'Usuário não encontrado' });
      }
      
      req.usuario = usuarioDB;
      next();
    });
  });
};

const gerarToken = (usuario) => {
  return jwt.sign(
    { id: usuario.id, email: usuario.email },
    process.env.JWT_SECRET || 'segredo_temporario',
    { expiresIn: '7d' }
  );
};

module.exports = {
  autenticarToken,
  gerarToken
};
