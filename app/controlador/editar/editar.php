<?php
	class editar extends page
	{
		public function __construct()
		{
			$this->sep = explode("/", $_GET["url"]);
			$this->change = ["recursos" => "/app/visao/templates/santri/", "nomeuser"=>$_SESSION["usuario"]];
		}
		public function usuario()
		{
			$sql = "select * from usuarios where USUARIO_ID=".$this->sep[2];
			$query = queryDb($sql);
			$userstable = "";
			$dados = $query->fetch(PDO::FETCH_ASSOC);
			if($dados["ATIVO"]== "S"){
				$ativooption = '<option value="S" default>Sim</option><option value="N">Não</option>';
			} else {
				$ativooption = '<option value="N" default >Não</option><option value="S">Sim</option>';
			};
			$sql1 = "select * from autorizacoes where USUARIO_ID=".$this->sep[2];
			$query1 = queryDb($sql1);
			$lioption = "";
			$dados1 = $query1->fetch(PDO::FETCH_ASSOC);
			$this->change["usernome"] = $dados["NOME_COMPLETO"];
			$this->change["userlogin"] = $dados["LOGIN"];
			$this->change["userativo"] = $dados["ATIVO"];
			$this->change["usersenha"] = $dados["SENHA"];
			$this->change["userid"] = $dados["USUARIO_ID"];
			$this->change["ativooption"] = $ativooption;
			$this->change["lioptionsuser"] = $lioption;
			$this->change["nomeuser"] = $_SESSION["usuario"];
			$this->loadview("templates.santri.editaruser", $this->change);
		}
		public function confirmaedit()
		{
	 		$sql = 'update usuarios set NOME_COMPLETO="'.$_POST["uname"].'", LOGIN="'.$_POST["ulogin"].'", SENHA="'.$_POST["upass"].'", ATIVO="'.$_POST["uactive"].'" where USUARIO_ID='.$_POST["userid"].'';
	 		fastquery($sql);
	 		$sql2 = "delete from autorizacoes where USUARIO_ID=".$_POST["userid"];
	 		fastquery($sql2);
			$lastid = $_POST["userid"];
	 		$permissoes = [];
	 		if(isset($_POST["cad_client"])){
	 			$sqlP1 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("cadastrar_clientes", '.$lastid.')';
	 			array_push($permissoes, $sqlP1);
	 		};
	 		if(isset($_POST["del_client"])){
	 			$sqlP2 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("excluir_clientes", '.$lastid.')';
	 			array_push($permissoes, $sqlP2);
	 		};
	 		if(isset($_POST["cad_forn"])){
	 			$sqlP3 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("cadastrar_fornecedores", '.$lastid.')';
	 			array_push($permissoes, $sqlP3);
	 		};
	 		if(isset($_POST["del_forn"])){
	 			$sqlP4 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("excluir_fornecedores", '.$lastid.')';
	 			array_push($permissoes, $sqlP4);
	 		};
	 		if(isset($_POST["cad_prod"])){
	 			$sqlP5 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("cadastrar_produtos", '.$lastid.')';
	 			array_push($permissoes, $sqlP5);
	 		};
	 		if(isset($_POST["del_prod"])){
	 			$sqlP6 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("alterar_preco_produtos", '.$lastid.')';
	 			array_push($permissoes, $sqlP6);
	 		};
	 		foreach ($permissoes as $key => $val){
	 			fastquery($val);
	 		};
	 		$this->change["grandemensagem"] = "Usuário <i>".$_POST["ulogin"]."</i> atualizado com sucesso!";
 			$this->change["pequenamensagem"] = "aguarde que você será redirecionado em 5 segundos ou pressione o botão";
 			$this->change["botaotexto"] ="Clique para o Início";
			$this->change["script"]= 'window.setInterval(function(){window.location.href="/";window.location.reload(forceReload);}, 5000);';
			$this->change["linkaviso"]="/";
	 		$this->loadview("templates.santri.atividadeok", $this->change);
		}
	}
?>