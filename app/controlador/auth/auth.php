<?php
/*
data de criação: 2016
Última Alteração: 14/01/2018
*/
class auth {
		public function __construct(){
			$this->user = $_POST["loginuser"];
			$this->password  = $_POST["keypass"];
			if(!isset($_POST["loginuser"])||!isset($_POST["keypass"])){
			echo "Usuário inexistente ou senha inválida";
		}
	}
	public function index(){
		/**
		captura os dados do formulario
		**/
		//cria a query
		$sql = "call loginuser(\"$this->user\", \"$this->password\")";
		$dados = queryDb($sql);
		$linha = $dados->fetch(PDO::FETCH_ASSOC);
		if ($linha["permitido"] == 1){
			$_SESSION["LOGADO"] = TRUE;
			$_SESSION["usuario"] = $_POST["loginuser"];
			header("Location: /");
			echo "<script>document.reload();</script>";
		} else {
			echo "Usuário inexistente ou senha inválida";
		}
	}
	public function logout(){
		session_unset($_SESSION["LOGADO"]);
		session_destroy();
		header("Location: /");
		echo "<script>document.reload();</script>";
		echo "saiu";
	}
	public function checkAuth(){
		if(!isset($_SESSION["LOGADO"]) || !isset($_SESSION["usuario"])){
			unset($_SESSION);
			header("Location: /");
			echo "<script>document.reload();</script>";
		}
	}
	
}
?>