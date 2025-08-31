const Pet = require('../models/Pet');

const listarPets = (req, res) => {
  const { especie, cidade, eh_adulto } = req.query;
  const filtros = {};

  if (especie) filtros.especie = especie;
  if (cidade) filtros.cidade = cidade;
  if (eh_adulto !== undefined) filtros.eh_adulto = eh_adulto === 'true';

  Pet.listarTodos(filtros, (err, pets) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao buscar pets' });
    }
    res.json(pets);
  });
};

const buscarPet = (req, res) => {
  const { id } = req.params;

  Pet.buscarPorId(id, (err, pet) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao buscar pet' });
    }

    if (!pet) {
      return res.status(404).json({ message: 'Pet não encontrado' });
    }

    res.json(pet);
  });
};

const criarPet = (req, res) => {
  const {
    especie,
    raca,
    cidade,
    eh_adulto,
    descricao,
    contato_email,
    contato_telefone,
    receber_textos,
    receber_ligacoes
  } = req.body;

  // Validações básicas
  if (!especie || !cidade) {
    return res.status(400).json({ message: 'Espécie e cidade são obrigatórios' });
  }

  const novoPet = {
    usuario_id: req.usuario.id,
    especie,
    raca: raca || null,
    cidade,
    eh_adulto: eh_adulto !== undefined ? eh_adulto : true,
    descricao: descricao || null,
    contato_email: contato_email || null,
    contato_telefone: contato_telefone || null,
    receber_textos: receber_textos || false,
    receber_ligacoes: receber_ligacoes || false
  };

  Pet.criar(novoPet, (err, resultado) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao criar pet' });
    }

    res.status(201).json({
      message: 'Pet criado com sucesso',
      id: resultado.id
    });
  });
};

const atualizarPet = (req, res) => {
  const { id } = req.params;
  const {
    especie,
    raca,
    cidade,
    eh_adulto,
    descricao,
    contato_email,
    contato_telefone,
    receber_textos,
    receber_ligacoes
  } = req.body;

  // Primeiro verificar se o pet existe e pertence ao usuário
  Pet.buscarPorId(id, (err, pet) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao buscar pet' });
    }

    if (!pet) {
      return res.status(404).json({ message: 'Pet não encontrado' });
    }

    if (pet.usuario_id !== req.usuario.id) {
      return res.status(403).json({ message: 'Acesso não autorizado' });
    }

    const dadosAtualizados = {
      especie: especie || pet.especie,
      raca: raca !== undefined ? raca : pet.raca,
      cidade: cidade || pet.cidade,
      eh_adulto: eh_adulto !== undefined ? eh_adulto : pet.eh_adulto,
      descricao: descricao !== undefined ? descricao : pet.descricao,
      contato_email: contato_email !== undefined ? contato_email : pet.contato_email,
      contato_telefone: contato_telefone !== undefined ? contato_telefone : pet.contato_telefone,
      receber_textos: receber_textos !== undefined ? receber_textos : pet.receber_textos,
      receber_ligacoes: receber_ligacoes !== undefined ? receber_ligacoes : pet.receber_ligacoes
    };

    Pet.atualizar(id, dadosAtualizados, (err, resultado) => {
      if (err) {
        return res.status(500).json({ message: 'Erro ao atualizar pet' });
      }

      res.json({ message: 'Pet atualizado com sucesso' });
    });
  });
};

const excluirPet = (req, res) => {
  const { id } = req.params;

  // Primeiro verificar se o pet existe e pertence ao usuário
  Pet.buscarPorId(id, (err, pet) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao buscar pet' });
    }

    if (!pet) {
      return res.status(404).json({ message: 'Pet não encontrado' });
    }

    if (pet.usuario_id !== req.usuario.id) {
      return res.status(403).json({ message: 'Acesso não autorizado' });
    }

    Pet.excluir(id, (err, resultado) => {
      if (err) {
        return res.status(500).json({ message: 'Erro ao excluir pet' });
      }

      res.json({ message: 'Pet excluído com sucesso' });
    });
  });
};

const listarMeusPets = (req, res) => {
  Pet.buscarPorUsuario(req.usuario.id, (err, pets) => {
    if (err) {
      return res.status(500).json({ message: 'Erro ao buscar pets' });
    }
    res.json(pets);
  });
};

module.exports = {
  listarPets,
  buscarPet,
  criarPet,
  atualizarPet,
  excluirPet,
  listarMeusPets
};
