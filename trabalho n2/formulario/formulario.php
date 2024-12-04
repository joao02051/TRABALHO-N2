<?php
if (isset($_POST['submit'])) {
    include_once('config.php');

    function validarEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validarTelefone($telefone) {
        return preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $telefone);
    }

    function sanitizarTexto($texto) {
        return htmlspecialchars(trim($texto));
    }

    $nome = sanitizarTexto($_POST['name']);
    $email = sanitizarTexto($_POST['email']);
    $telefone = sanitizarTexto($_POST['phone']);
    $data_nasc = sanitizarTexto($_POST['birthdate']);
    $genero = sanitizarTexto($_POST['gender']);
    $tipo_plano = sanitizarTexto($_POST['plan']);
    $endereco = sanitizarTexto($_POST['address']);
    $comentarios = sanitizarTexto($_POST['comments']);

    $erros = [];

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório.";
    }

    if (!validarEmail($email)) {
        $erros[] = "Email inválido.";
    }

    if (!validarTelefone($telefone)) {
        $erros[] = "Telefone deve estar no formato (DD) 98765-4321.";
    }

    if (empty($data_nasc)) {
        $erros[] = "Data de nascimento é obrigatória.";
    }

    if (empty($genero)) {
        $erros[] = "Gênero é obrigatório.";
    }

    if (empty($tipo_plano)) {
        $erros[] = "Tipo de plano é obrigatório.";
    } elseif (!in_array($tipo_plano, ['mensal', 'trimestral', 'semestral', 'anual'])) {
        $erros[] = "Plano selecionado é inválido.";
    }

    if (empty($endereco)) {
        $erros[] = "Endereço é obrigatório.";
    }

    if (count($erros) > 0) {
        foreach ($erros as $erro) {
            echo "<div class='error'>$erro</div>";
        }
    } else {
        $result = mysqli_query($conexao, "INSERT INTO usuarios (nome, email, telefone, data_nasc, genero, tipo_plano, endereco, comentarios) 
                                          VALUES ('$nome', '$email', '$telefone', '$data_nasc', '$genero', '$tipo_plano', '$endereco', '$comentarios')");

        if ($result) {
            echo "<div class='success'>Cadastro realizado com sucesso!</div>";
        } else {
            echo "<div class='error'>Erro ao cadastrar. Tente novamente.</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Cadastro de Academia</title>
</head>
<body>
    <div class="container">
        <form action="formulario.php" method="POST">
            <h1>Cadastro de Academia</h1>
            <div class="form-group">
                <label for="name">Nome Completo:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefone:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Data de Nascimento:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>
            <div class="form-group">
                <label for="gender">Gênero:</label>
                <select id="gender" name="gender" required>
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="plan">Tipo de Plano:</label>
                <select id="plan" name="plan" required>
                    <option value="">Selecione um plano</option>
                    <option value="mensal">Mensal</option>
                    <option value="trimestral">Trimestral</option>
                    <option value="semestral">Semestral</option>
                    <option value="anual">Anual</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Endereço:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="comments">Comentários:</label>
                <textarea id="comments" name="comments" rows="4"></textarea>
            </div>
            <button type="submit" name="submit">Cadastrar</button>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
