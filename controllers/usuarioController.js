const Usuario = require('../models/Usuario');

const obterPerfil = (req, res) => {
  res.json(req.usuario);
};

const atualizarPerfil = (req, res) => {
  const { nome, telefone, receber_emails, receber_sms, receber_ligacoes } = req.body;

  const dadosAtualizados = {
    nome: nome !== undefined ? nome : req.usuario.nome,
    telefone: telefone !== undefined ? telefone : req.usuario.telefone,
    receber_emails: receber_emails !== undefined ? receber_emails : req.usuario.receber_emails,
    receber_sms: receber_sms !== undefined ? receber_sms : req.usuario.receber_sms,
    receber_ligacoes: receber_ligacoes !== undefined ? receber_ligacoes : req.usuario.receber_ligacoes
  };

  Usuario.atualizar(req.usuario.id, dadosAtualizados, (err, resultado) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao atualizar perfil' });
    }

    if (resultado.changes === 0) {
      return res.status(404).json({ message: 'Usuário não encontrado' });
    }

    res.json({ message: 'Perfil atualizado com sucesso' });
  });
};

const atualizarSenha = (req, res) => {
  const { senha_atual, nova_senha } = req.body;

  if (!senha_atual || !nova_senha) {
    return res.status(400).json({ message: 'Senha atual e nova senha são obrigatórias' });
  }

  // Primeiro verificar a senha atual
  Usuario.buscarPorId(req.usuario.id, (err, usuario) => {
    if (err) {
      return res.status(500).json({ message: 'Erro interno do servidor' });
    }

    Usuario.compararSenha(senha_atual, usuario.senha, (err, resultado) => {
      if (err || !resultado) {
        return res.status(401).json({ message: 'Senha atual incorreta' });
      }

      // Atualizar a senha
      Usuario.atualizarSenha(req.usuario.id, nova_senha, (err, resultado) => {
        if (err) {
          return res.status(500).json({ message: 'Erro ao atualizar senha' });
        }

        res.json({ message: 'Senha atualizada com sucesso' });
      });
    });
  });
};

module.exports = {
  obterPerfil,
  atualizarPerfil,
  atualizarSenha
};
