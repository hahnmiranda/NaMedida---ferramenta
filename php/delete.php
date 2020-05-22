<?php
// iniciando sessão
session_start();
// conexão
require'db_connect.php';

// deletar organização
if (isset($_POST['btn-deletar-organizacao'])):
	$id = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	// deletando as chaves estrangeiras das organizacoes
	$sql = "UPDATE Projeto SET idOrganizacao = NULL WHERE idOrganizacao =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "UPDATE ObjEstrategico SET idOrganizacao = NULL WHERE idOrganizacao =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM Organizacao WHERE idOrganizacao = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: organizacao.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: organizacao.php?erro');
	endif;
endif;

// deletar projeto
if (isset($_POST['btn-deletar-projeto'])):
	$id = mysqli_escape_string($connect, $_POST['idProjeto']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE Base SET idProjeto = NULL WHERE idProjeto =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM Projeto WHERE idProjeto = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: projeto.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: projeto.php?erro');
	endif;
endif;

// deletar base
if (isset($_POST['btn-deletar-base'])):
	$id = mysqli_escape_string($connect, $_POST['idBase']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE Medida SET idBase = NULL WHERE idBase =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "UPDATE Indicador SET idBase = NULL WHERE idBase =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM Base WHERE idBase = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: base.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: base.php?erro');
	endif;
endif;

// deletar objetivo estrategico
if (isset($_POST['btn-deletar-objestrategico'])):
	$id = mysqli_escape_string($connect, $_POST['idObjEstrategico']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE Pergunta SET idObjEstrategico = NULL WHERE idObjEstrategico =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM ObjEstrategico WHERE idObjEstrategico = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: objestrategico.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: objestrategico.php?erro');
	endif;
endif;

// deletar pergunta
if (isset($_POST['btn-deletar-pergunta'])):
	$id = mysqli_escape_string($connect, $_POST['idPergunta']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE PerguntaMedida SET idPergunta = NULL WHERE idPergunta =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM Pergunta WHERE idPergunta = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: pergunta.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: pergunta.php?erro');
	endif;
endif;

























