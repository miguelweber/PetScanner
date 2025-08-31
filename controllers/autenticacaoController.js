const Usuario = require('../models/Usuario');
const { gerarToken } = require('../middlewares/autenticacao');

const registrar = (req, res) => {
  const { email, senha, nome, telefone } = req.body;

  // Validações básicas
  if (!email || !senha) {
    return res.status(400).json({ message: 'Email e senha são obrigatórios' });
  }

  // Verificar se usuário já existe
  Usuario.buscarPorEmail(email, (err, usuarioExistente) => {
    if (err) {
      return res.status(500).json({ message: 'Erro interno do servidor' });
    }

    if (usuarioExistente) {
      return res.status(409).json({ message: 'Email já cadastrado' });
    }

    // Criar novo usuário
    Usuario.criar({ email, senha, nome, telefone }, (err, novoUsuario) => {
      if (err) {
        return res.status(500).json({ message: 'Erro ao criar usuário' });
      }

      // Gerar token
      const token = gerarToken(novoUsuario);

      res.status(201).json({
        message: 'Usuário criado com sucesso',
        token,
        usuario: {
          id: novoUsuario.id,
          email: novoUsuario.email,
          nome: novoUsuario.nome,
          telefone: novoUsuario.telefone
        }
      });
    });
  });
};

const login = (req, res) => {
  const { email, senha } = req.body;

  if (!email || !senha) {
    return res.status(400).json({ message: 'Email e senha são obrigatórios' });
  }

  // Buscar usuário
  Usuario.buscarPorEmail(email, (err, usuario) => {
    if (err) {
      return res.status(500).json({ message: 'Erro interno do servidor' });
    }

    if (!usuario) {
      return res.status(401).json({ message: 'Credenciais inválidas' });
    }

    // Verificar senha
    Usuario.compararSenha(senha, usuario.senha, (err, resultado) => {
      if (err || !resultado) {
        return res.status(401).json({ message: 'Credenciais inválidas' });
      }

      // Gerar token
      const token = gerarToken(usuario);

      res.json({
        message: 'Login realizado com sucesso',
        token,
        usuario: {
          id: usuario.id,
          email: usuario.email,
          nome: usuario.nome,
          telefone: usuario.telefone
        }
      });
    });
  });
};

module.exports = {
  registrar,
  login
};
