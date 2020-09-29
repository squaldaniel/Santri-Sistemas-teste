<?php
class ajax {
	public function __construct(){
    auth::checkAuth();
	}
	public function buscauser()
  {
    if(!isset($_POST["uname"])){
      header("Location: /");
      echo "<script>document.reload();</script>";
    } else {
      $nome = $_REQUEST["uname"];
      $sql = "select * from usuarios where LOGIN like '%".$nome."%' OR NOME_COMPLETO like '%".$nome."%'";
      $query = queryDb($sql);
       while($dados=$query->fetch(PDO::FETCH_ASSOC)){
          echo '<tr><td>'.$dados["NOME_COMPLETO"].'</td><td>'.$dados["LOGIN"].'</td><td>'.$dados["ATIVO"].'</td><td><a href="/delete/usuario/'.$dados["USUARIO_ID"].'" class="w3-button w3-theme w3-margin-top"><i class="fas fa-user-times"></i></a><a href="/editar/usuario/'.$dados["USUARIO_ID"].'" class="w3-button w3-theme w3-margin-top"><i class="fas fa-edit"></i></a></td></tr>';
      };
    }
	}
  public function deletauser()
  {
    $sql = "select * from usuarios where USUARIO_ID=".$this->param[2];
    echo $sql;
  }
}
?>