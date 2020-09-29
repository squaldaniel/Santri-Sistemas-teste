<?php
 class  cadastrar extends page
 {
 	public function __construct()
 	{
 		$this->change = ["recursos" => "/app/visao/templates/santri/", "nomeuser"=>$_SESSION["usuario"]];
 	}
 	public function usuarios()
 	{
 		$this->change["nomeuser"] = $_SESSION["usuario"];
 		$this->loadview("templates.santri.cadastrouser", $this->change);
 	}
 	public function newuser()
 	{
 		$sql = 'call sp_addusuario("'.$_POST["unome"].'", "'.$_POST["ulogin"].'", "'.$_POST["ukeypass"].'")';
 		$query = fastquery($sql);
 		$sqlpre = 'select USUARIO_ID as id from usuarios where login="'.$_POST["ulogin"].'"';
 		$querypre = queryDb($sqlpre);
 		$dados = $querypre->fetch(PDO::FETCH_ASSOC);
 		$lastid = $dados["id"];
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
 			$sqlP5 = 'insert into autorizacoes (CHAVE_AUTORIZACAO, USUARIO_ID) VALUES ("alterar_preco_produtos", '.$lastid.')';
 			array_push($permissoes, $sqlP5);
 		};
 		foreach ($permissoes as $key => $val){
 			fastquery($val);
 		};
 		$this->change["grandemensagem"] = "Usuário <i>".$_POST["unome"]."</i> adicionado com sucesso!";
 		$this->change["pequenamensagem"] = "agurde que você será redirecionado em 10 segundos ou pressione o botão";
 		$this->change["botaotexto"] ="Clique para o Início";
 		$this->change["script"]= 'window.setInterval(function(){window.location.href="/";window.location.reload(forceReload);}, 10000);';
 		$this->change["linkaviso"]="/";
 		$this->loadview("templates.santri.atividadeok", $this->change);
 	}
 }
?>