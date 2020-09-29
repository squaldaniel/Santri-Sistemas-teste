<?php
class index  extends page {
	public function __construct()
	{
		$this->change = ["recursos" => "app/visao/templates/santri/"];
	}
	public function index()
	{
		if (!isset($_SESSION["LOGADO"]))
		{
			$this->loadview("templates.santri.index", $this->change);
		} else {
			auth::checkAuth();
			$sql = "select * from usuarios";
			$query = queryDb($sql);
			$userstable = "";
			$delfunctions = "";
			while($dados = $query->fetch(PDO::FETCH_ASSOC)){
				$userstable .= '<tr id="user'.$dados["USUARIO_ID"].'"><td>'.$dados["NOME_COMPLETO"].'</td><td>'.$dados["LOGIN"].'</td><td>'.$dados["ATIVO"].'</td><td><a href="/delete/usuario/'.$dados["USUARIO_ID"].'" class="w3-button w3-theme w3-margin-top"><i class="fas fa-user-times"></i></a><a href="/editar/usuario/'.$dados["USUARIO_ID"].'" class="w3-button w3-theme w3-margin-top"><i class="fas fa-edit"></i></a></td></tr>';
			};
			$this->change["usuariostable"] = $userstable;
			$this->change["nomeuser"] = $_SESSION["usuario"];
			$this->loadview("templates.santri.logado", $this->change);
		}
	}
}
?>
