<?php
//dados
// selecionando o usuário da sessão
$id = $_SESSION['idUsuario'];
// buscando os dados do usuário com a id
$sql = "SELECT * FROM Usuario WHERE idUsuario = '$id'";
// conectando com o banco
$resultado = mysqli_query($connect, $sql);
// salvando os dados em um array
$dados = mysqli_fetch_array($resultado);

// Abaixo estão em arrays todos os ids dos dados
// do usuário para cada tipo de registro

$sql = "SELECT * FROM Usuario WHERE idUsuario = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados_usuario= array();


// organizacao
$id = $dados['idUsuario'];
$sql = "SELECT * FROM Organizacao WHERE idUsuario = '$id'";
$resultado = mysqli_query($connect, $sql);
// obtendo todos os ids das organizacoes do usuario
$ids_organizacao = array();
$count_while = 0;
while ($organizacao_dados = mysqli_fetch_array($resultado)) {	
	if ($count_while == 0) {
		array_push($ids_organizacao, $organizacao_dados['idOrganizacao']);
	} else{
		$count_while++;
		$cont_comparador = 0;
		for ($i=0; $i < count($ids_organizacao); $i++) { 
			if ($ids_organizacao[$i] == $organizacao_dados['idOrganizacao']) {
				$cont_comparador++;
			}
		}
		if ($cont_comparador == 0) {
			array_push($ids_organizacao, $organizacao_dados['idOrganizacao']);
		}
	}	
}

// objetivo estrategico
$ids_objestrategico = array();
for ($i=0; $i < count($ids_organizacao); $i++) { 
	$sql = "SELECT * FROM ObjEstrategico WHERE idOrganizacao = '$ids_organizacao[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($objestrategico_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_objestrategico, $objestrategico_dados['idObjEstrategico']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_objestrategico); $r++) { 
					if ($ids_objestrategico[$r] == $objestrategico_dados['idObjEstrategico']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_objestrategico, $objestrategico_dados['idObjEstrategico']);
				}
			}
		}	
	}
}

// projeto
$ids_projeto = array();
for ($i=0; $i < count($ids_organizacao); $i++) { 
	$sql = "SELECT * FROM Projeto WHERE idOrganizacao = '$ids_organizacao[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($projeto_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_projeto, $projeto_dados['idProjeto']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_projeto); $r++) { 
					if ($ids_projeto[$r] == $projeto_dados['idProjeto']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_projeto, $projeto_dados['idProjeto']);
				}
			}
		}	
	}
}

// pergunta
$ids_pergunta = array();
for ($i=0; $i < count($ids_objestrategico); $i++){ 
	$sql = "SELECT * FROM Pergunta WHERE idObjEstrategico = '$ids_objestrategico[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($pergunta_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_pergunta, $pergunta_dados['idPergunta']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_pergunta); $r++) { 
					if ($ids_pergunta[$r] == $pergunta_dados['idPergunta']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_pergunta, $pergunta_dados['idPergunta']);
				}
			}
		}	
	}
}

// base
$ids_base = array();
for ($i=0; $i < count($ids_projeto); $i++) { 
	$sql = "SELECT * FROM Base WHERE idProjeto = '$ids_projeto[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($base_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_base, $base_dados['idBase']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_base); $r++) { 
					if ($ids_base[$r] == $base_dados['idBase']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_base, $base_dados['idBase']);
				}
			}
		}	
	}
}

// medida
$ids_medida = array();
for ($i=0; $i < count($ids_base); $i++) { 
	$sql = "SELECT * FROM Medida WHERE idBase = '$ids_base[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($medida_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_medida, $medida_dados['idMedida']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_medida); $r++) { 
					if ($ids_medida[$r] == $medida_dados['idMedida']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_medida, $medida_dados['idMedida']);
				}
			}
		}	
	}
}

// indicador
$ids_indicador = array();
for ($i=0; $i < count($ids_base); $i++) { 
	$sql = "SELECT * FROM Indicador WHERE idBase = '$ids_base[$i]'";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		// obtendo todos os ids dos objetivos estrategicos das organizacoes
		$count_while = 0;
		while ($indicador_dados = mysqli_fetch_array($resultado)) {
			if ($count_while == 0) {
				array_push($ids_indicador, $indicador_dados['idIndicador']);
				$count_while++;
			} else {
				$count_while++;
				$cont_comparador = 0;
				for ($r=0; $r < count($ids_indicador); $r++) { 
					if ($ids_indicador[$r] == $indicador_dados['idIndicador']) {
						$cont_comparador++;
					}
				}
				if ($cont_comparador == 0) {
					array_push($ids_indicador, $indicador_dados['idIndicador']);
				}
			}
		}	
	}
}