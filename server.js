require('dotenv').config();
const app = require('./app');
const { iniciarBancoDados } = require('./config/database');

const PORT = process.env.PORT || 3000;

iniciarBancoDados().then(() => {
  app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
  });
}).catch(err => {
  console.error('Falha ao iniciar o banco de dados:', err);
});
