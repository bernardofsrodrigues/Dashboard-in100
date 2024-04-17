<?php
if ($_FILES["file"]["error"] > 0) {
    $response = array(
        "success" => false,
        "message" => "Erro ao fazer upload do arquivo."
    );
} else {
    
    $conn = new mysqli("localhost", "root", "", "inmaster");

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $arquivo = $_FILES['file'];
    $nome = $arquivo['name'];
    $arquivoNovo = explode('.',$arquivo['name']);
    $caminho = 'arq_master/'.$nome;
    move_uploaded_file($arquivo['tmp_name'],$caminho);
    $caminho = 'arq_master/'.$nome;
    $caminhonovo = 'C:/xampp/htdocs/masterin100/'.$caminho;

    $sql = "LOAD DATA INFILE '$caminhonovo' INTO TABLE in100master FIELDS TERMINATED BY ';' LINES TERMINATED BY  '\n' (cpf,numeroMatricula)";
    $query = mysqli_query($conn,$sql);

    if ($query) {
        echo "Arquivo importado com sucesso, Acompanhe pelo painel de gestão !";
        header("location:index.html");
        }else{
            echo "Não foi possivel carregar seu arquivo";
            header("location:index.html");
        }

    $conn->close();
}

?>