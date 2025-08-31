const { db } = require('../config/database');

class Pet {
  static criar(petData, callback) {
    const {
      usuario_id,
      especie,
      raca,
      cidade,
      eh_adulto,
      descricao,
      contato_email,
      contato_telefone,
      receber_textos,
      receber_ligacoes
    } = petData;

    const sql = `INSERT INTO pets 
                 (usuario_id, especie, raca, cidade, eh_adulto, descricao, contato_email, contato_telefone, receber_textos, receber_ligacoes)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;

    db.run(sql, [
      usuario_id, especie, raca, cidade, eh_adulto, descricao, 
      contato_email, contato_telefone, receber_textos, receber_ligacoes
    ], function(err) {
      if (err) return callback(err);
      callback(null, { id: this.lastID });
    });
  }

  static listarTodos(filtros = {}, callback) {
    let sql = `SELECT p.*, u.nome as usuario_nome 
               FROM pets p 
               LEFT JOIN usuarios u ON p.usuario_id = u.id 
               WHERE 1=1`;
    let params = [];

    if (filtros.especie) {
      sql += ' AND p.especie = ?';
      params.push(filtros.especie);
    }

    if (filtros.cidade) {
      sql += ' AND p.cidade LIKE ?';
      params.push(`%${filtros.cidade}%`);
    }

    if (filtros.eh_adulto !== undefined) {
      sql += ' AND p.eh_adulto = ?';
      params.push(filtros.eh_adulto);
    }

    sql += ' ORDER BY p.data_criacao DESC';

    db.all(sql, params, callback);
  }

  static buscarPorId(id, callback) {
    const sql = `SELECT p.*, u.nome as usuario_nome 
                 FROM pets p 
                 LEFT JOIN usuarios u ON p.usuario_id = u.id 
                 WHERE p.id = ?`;
    
    db.get(sql, [id], callback);
  }

  static buscarPorUsuario(usuario_id, callback) {
    const sql = 'SELECT * FROM pets WHERE usuario_id = ? ORDER BY data_criacao DESC';
    db.all(sql, [usuario_id], callback);
  }

  static atualizar(id, petData, callback) {
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
    } = petData;

    const sql = `UPDATE pets 
                 SET especie = ?, raca = ?, cidade = ?, eh_adulto = ?, descricao = ?,
                     contato_email = ?, contato_telefone = ?, receber_textos = ?, receber_ligacoes = ?,
                     data_atualizacao = CURRENT_TIMESTAMP
                 WHERE id = ?`;

    db.run(sql, [
      especie, raca, cidade, eh_adulto, descricao,
      contato_email, contato_telefone, receber_textos, receber_ligacoes, id
    ], function(err) {
      if (err) return callback(err);
      callback(null, { changes: this.changes });
    });
  }

  static excluir(id, callback) {
    const sql = 'DELETE FROM pets WHERE id = ?';
    db.run(sql, [id], function(err) {
      if (err) return callback(err);
      callback(null, { changes: this.changes });
    });
  }
}

module.exports = Pet;
