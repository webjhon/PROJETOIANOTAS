<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="js/"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://livejs.com/live.js"></script>
    <script src="js/teste.js"></script>
</head>
<body class="text-bg-primary">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<div class="row h-100 mx-auto">
    <div class="justify-content-center text-center my-auto">
        <div class="col-xl-6 mx-auto">
            <img src="imagens/20220518-ilustracao-ia-transparente.png" alt="logomarca do projeto" class="img-fluid" height="350vh" width="350vh">
                <form action="php/recebe_post.php" method="POST" class="" name="alimentaform">
                    <input type="text" name="nome" id="nome" class="form-control mx-auto" placeholder="Digite seu nome">
                    <div class="form-group">
                      <label for="notas"></label>
                      <select class="form-control mx-auto" name="disciplina" id="notas">
                        <option> Disciplina</option>
                        <option> MATEMÁTICA</option>
                        <option> PORTUGUÊS</option>
                        <option> INFORMÁTICA </option>
                      </select>
                    </div> <br>
                    <input type="number" name="notas" id="notas" class="form-control mx-auto" placeholder="Digite sua nota"> <br>
                    <input type="time" name="tempo" id="tempo" placeholder="Por quanto tempo estudou?" class="form-control mx-auto"><br>
                    <button  name="enviar" type="submit" class="form-control text-bg-dark"> ENVIAR</button>
                </form>
                
        </div>
    </div>
    
</div>    
    
</body>
</html>