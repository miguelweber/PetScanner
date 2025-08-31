const { db } = require('../config/database');
const bcrypt = require('bcryptjs');

class Usuario {
  static criar(usuarioData, callback) {
    const { email, senha, nome, telefone } = usuarioData;
    
    bcrypt.hash(senha, 10, (err, hash) => {
      if (err) return callback(err);
      
      const sql = `INSERT INTO usuarios (email, senha, nome, telefone) 
                   VALUES (?, ?, ?, ?)`;
      
      db.run(sql, [email, hash, nome, telefone], function(err) {
        if (err) return callback(err);
        callback(null, { id: this.lastID, email, nome, telefone });
      });
    });
  }

  static buscarPorEmail(email, callback) {
    const sql = 'SELECT * FROM usuarios WHERE email = ?';
    db.get(sql, [email], callback);
  }

  static buscarPorId(id, callback) {
    const sql = 'SELECT id, email, nome, telefone, receber_emails, receber_sms, receber_ligacoes FROM usuarios WHERE id = ?';
    db.get(sql, [id], callback);
  }

  static atualizar(id, dadosAtualizados, callback) {
    const { nome, telefone, receber_emails, receber_sms, receber_ligacoes } = dadosAtualizados;
    
    const sql = `UPDATE usuarios 
                 SET nome = ?, telefone = ?, receber_emails = ?, receber_sms = ?, receber_ligacoes = ?
                 WHERE id = ?`;
    
    db.run(sql, [nome, telefone, receber_emails, receber_sms, receber_ligacoes, id], function(err) {
      if (err) return callback(err);
      callback(null, { changes: this.changes });
    });
  }

  static atualizarSenha(id, novaSenha, callback) {
    bcrypt.hash(novaSenha, 10, (err, hash) => {
      if (err) return callback(err);
      
      const sql = 'UPDATE usuarios SET senha = ? WHERE id = ?';
      db.run(sql, [hash, id], function(err) {
        if (err) return callback(err);
        callback(null, { changes: this.changes });
      });
    });
  }

  static compararSenha(senha, hash, callback) {
    bcrypt.compare(senha, hash, callback);
  }
}

module.exports = Usuario;
