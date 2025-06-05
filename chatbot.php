<?php
require_once __DIR__.'/php/conectabanco.php';

$resposta = '';
$pergunta = '';
$disciplina_extra = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta = trim($_POST['pergunta'] ?? '');
    $disciplina_extra = trim($_POST['disciplina_extra'] ?? '');
    if ($pergunta !== '') {
        $pergunta_lower = mb_strtolower($pergunta, 'UTF-8');
        if (str_contains($pergunta_lower, 'planejamento') || str_contains($pergunta_lower, 'aula')) {
            $disciplinas = ['matemática', 'português', 'informática'];
            $disciplina = null;
            foreach ($disciplinas as $d) {
                if (str_contains($pergunta_lower, $d)) {
                    $disciplina = $d;
                    break;
                }
            }
            if (!$disciplina) {
                $disciplina = mb_strtolower($disciplina_extra, 'UTF-8');
            }
            if ($disciplina) {
                try {
                    $pdo = new PDO($dsn, $user, $pass, $options);
                    $stmt = $pdo->prepare('SELECT data, conteudo FROM planejamento WHERE disciplina LIKE ? ORDER BY data');
                    $stmt->execute(["%$disciplina%"]);
                    $planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (!$planos) {
                        $resposta = 'Nenhum planejamento encontrado.';
                    } else {
                        $linhas = [];
                        foreach ($planos as $p) {
                            $linhas[] = date('d/m/Y', strtotime($p['data'])) . ': ' . $p['conteudo'];
                        }
                        $resposta = implode('<br>', $linhas);
                    }
                } catch (PDOException $e) {
                    $resposta = 'Erro ao acessar o banco de dados.';
                }
            } else {
                $resposta = 'Por favor, informe a disciplina.';
            }
        } else {
            $resposta = 'Desculpe, não entendi a pergunta.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatbot - Projeto IA Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.html">Projeto IA Notas</a>
        </div>
    </nav>
    <main class="container flex-fill py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">Chatbot do Planejamento</h2>
                <form method="POST" class="mb-3">
                    <div class="mb-3">
                        <label for="pergunta" class="form-label">Pergunta</label>
                        <input type="text" class="form-control" id="pergunta" name="pergunta" value="<?php echo htmlspecialchars($pergunta); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="disciplina_extra" class="form-label">Disciplina (opcional)</label>
                        <input type="text" class="form-control" id="disciplina_extra" name="disciplina_extra" value="<?php echo htmlspecialchars($disciplina_extra); ?>" placeholder="Matemática, Português ou Informática">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <?php if ($resposta !== ''): ?>
                    <div class="alert alert-secondary" role="alert">
                        <?php echo $resposta; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <footer class="bg-body-secondary text-center py-3 mt-auto">
        <small>Projeto IA Notas</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
