const sqlite3 = require('sqlite3').verbose();
const path = require('path');

const dbPath = path.join(__dirname, '..', 'database.sqlite');
const db = new sqlite3.Database(dbPath);

const iniciarBancoDados = () => {
  return new Promise((resolve, reject) => {
    db.serialize(() => {
      // Tabela de usuários
      db.run(`CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        senha TEXT NOT NULL,
        nome TEXT,
        telefone TEXT,
        receber_emails BOOLEAN DEFAULT 1,
        receber_sms BOOLEAN DEFAULT 0,
        receber_ligacoes BOOLEAN DEFAULT 0,
        data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
      )`);

      // Tabela de pets
      db.run(`CREATE TABLE IF NOT EXISTS pets (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        usuario_id INTEGER NOT NULL,
        especie TEXT NOT NULL,
        raca TEXT,
        cidade TEXT NOT NULL,
        eh_adulto BOOLEAN DEFAULT 1,
        descricao TEXT,
        contato_email TEXT,
        contato_telefone TEXT,
        receber_textos BOOLEAN DEFAULT 0,
        receber_ligacoes BOOLEAN DEFAULT 0,
        data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
        data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
      )`);

      console.log('Banco de dados inicializado com sucesso');
      resolve();
    });
  });
};

module.exports = {
  db,
  iniciarBancoDados
};
