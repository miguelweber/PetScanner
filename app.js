const express = require('express');
const cors = require('cors');

const app = express();

// Middlewares
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Importar rotas individualmente
const authRoutes = require('./routes/autenticacao');
const petsRoutes = require('./routes/pets');
const usuariosRoutes = require('./routes/usuarios');

// Rotas
app.use('/api/auth', authRoutes);
app.use('/api/pets', petsRoutes);
app.use('/api/usuarios', usuariosRoutes);

// Rota de saúde
app.get('/api/health', (req, res) => {
  res.status(200).json({ message: 'Servidor está funcionando!' });
});

// Middleware de erro
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ message: 'Algo deu errado!' });
});

// Rota não encontrada
app.use('*', (req, res) => {
  res.status(404).json({ message: 'Rota não encontrada' });
});

module.exports = app;
