// Serviço simplificado de email (implementação real depende do provedor)
const enviarEmail = (destinatario, assunto, mensagem) => {
  console.log(`Email enviado para: ${destinatario}`);
  console.log(`Assunto: ${assunto}`);
  console.log(`Mensagem: ${mensagem}`);
  // Aqui você integraria com um serviço de email real como SendGrid, Mailgun, etc.
  return Promise.resolve();
};

module.exports = {
  enviarEmail
};
