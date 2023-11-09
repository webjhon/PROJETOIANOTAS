<?php

require_once'conectabanco.php';

$nome_frompost = isset($_POST["nome"]) ? $_POST["nome"] : "";
$disciplina_frompost = isset($_POST["disciplina"]) ? $_POST["disciplina"] : "";
$notas_frompost = isset($_POST["notas"]) ? $_POST["notas"] : "";
$tempo_frompost = isset($_POST["tempo"]) ? $_POST["tempo"] : "";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $stmt = $pdo->prepare("INSERT INTO dados (Disciplina, Nota, Hora,nome) VALUES (?, ?, ?,?)");
    $stmt->execute([$disciplina_frompost, $notas_frompost, $tempo_frompost,$nome_frompost]);   
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

?>