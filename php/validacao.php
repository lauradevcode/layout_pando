<?php
echo md5("senha123");
echo "<br>";
echo md5("teste");
?>

<?php

mysql_connect("localhost", "root", "root");


mysql_select_db("noticias");
?>
<?php

require "conexao.php";

session_start();

$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
// criptografando em MD5
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;


if(!$email || !$senha)
{
	echo "Você deve digitar sua senha e email!";
	exit;
}

$SQL = "SELECT email, login, senha,
FROM autenti_users
WHERE login = "" . $email . """;
$result_id = @mysql_query($SQL) or die("Erro no banco de dados!");
$total = @mysql_num_rows($result_id);

if($total)
{
	$dados = @mysql_fetch_array($result_id);

	if(!strcmp($senha, $dados["senha"]))
	{
		$_SESSION["id_email"]= $dados["email"];
		$_SESSION["nome_usuario"] = stripslashes($dados["nome"]);
		header("Location: index.php");
		exit;
	}
	else
	{
	 "Senha inválida!";
	exit;
	}
}
else
{
	echo "O login inexistente!";
	exit;
}

?>