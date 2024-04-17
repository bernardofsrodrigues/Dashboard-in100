<?php
$conn = new mysqli("localhost", "root", "", "inmaster");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$query = "SELECT * FROM `in100master` WHERE SIT IN (1,2)";
$result = $conn->query($query);

$nome_arquivo = 'master-in100.csv';
$arquivo_csv = fopen('php://temp', 'w+');

if (!$arquivo_csv) {
    die("Erro ao abrir o arquivo CSV");
}

// Escreve o cabeçalho no arquivo CSV
$campos = array();
while ($campo = $result->fetch_field()) {
    $campos[] = $campo->name;
}
fputcsv($arquivo_csv, $campos, ';');

// Escreve os dados no arquivo CSV
while ($linha = $result->fetch_assoc()) {
    array_walk($linha, function(&$value) {
        $value = utf8_decode($value);
    });
    fputcsv($arquivo_csv, $linha, ';');
}

// Volta para o início do arquivo
rewind($arquivo_csv);

// Configura os cabeçalhos HTTP para forçar o download do arquivo
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $nome_arquivo . '"');

// Transmite o conteúdo do arquivo para a saída do PHP
fpassthru($arquivo_csv);

fclose($arquivo_csv);

$conn->close();
?>
