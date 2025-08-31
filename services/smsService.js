// Serviço simplificado de SMS (implementação real depende do provedor)
const enviarSMS = (numero, mensagem) => {
  console.log(`SMS enviado para: ${numero}`);
  console.log(`Mensagem: ${mensagem}`);
  // Aqui você integraria com um serviço de SMS real como Twilio, etc.
  return Promise.resolve();
};

module.exports = {
  enviarSMS
};
