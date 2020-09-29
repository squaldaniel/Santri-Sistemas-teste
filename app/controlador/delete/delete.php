<?php
	class delete extends page
	{
		public function __construct()
		{
			$this->param = explode("/", $_GET["url"]);
			$this->change = ["recursos" => "app/visao/templates/santri/", "nomeuser"=>$_SESSION["usuario"]];
		}
		public function usuario()
		{
			$sql = "select * from usuarios where USUARIO_ID=".$this->param[2];
			$query = queryDb($sql);
			$dados = $query->fetch(PDO::FETCH_ASSOC);
			$del1 = 'delete from autorizacoes where USUARIO_ID="'.$dados["USUARIO_ID"].'"';
			fastquery($del1);
			$del2 = 'delete from usuarios where USUARIO_ID="'.$dados["USUARIO_ID"].'"';
			fastquery($del2);
			$this->change["grandemensagem"] = "Usuário <i>".$dados["NOME_COMPLETO"]."</i> deletado com sucesso!";
 			$this->change["pequenamensagem"] = "aguarde que você será redirecionado em 5 segundos ou pressione o botão";
 			$this->change["botaotexto"] ="Clique para o Início";
			$this->change["script"]= 'window.setInterval(function(){window.location.href="/";window.location.reload(forceReload);}, 5000);';
			$this->loadview("templates.santri.atividadeok", $this->change);
		}
	}
?>