document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const birthdate = document.getElementById('birthdate').value;
    const gender = document.getElementById('gender').value;
    const plan = document.getElementById('plan').value;
    const address = document.getElementById('address').value.trim();
    const comments = document.getElementById('comments').value.trim();

    if (!name || !email || !phone || !birthdate || !gender || !plan || !address) {
        document.getElementById('message').innerText = "Por favor, preencha todos os campos obrigatórios.";
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById('message').innerText = "Por favor, insira um email válido.";
        return;
    }

    const message = `Cadastro realizado com sucesso!\n\nNome: ${name}\nEmail: ${email}\nTelefone: ${phone}\nData de Nascimento: ${birthdate}\nGênero: ${gender}\nPlano: ${plan}\nEndereço: ${address}\nComentários: ${comments}`;
    document.getElementById('message').innerText = message;

    document.getElementById('registrationForm').reset();
});
