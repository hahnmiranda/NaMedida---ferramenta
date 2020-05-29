<?php
// conexao
include_once 'db_connect.php';

// header
include_once 'includes/header.php';

// message
include_once 'includes/message.php';

// sessao
session_start();

// verificando se usuario esta logado
// caso não esteja retorna para tela login
if (!isset($_SESSION['logado'])) {
	header('Location: ../index.php');
}

// dados usuario $dados[]
include_once 'includes/dados-usuario.php';

// incluindo cabecalhos
include_once 'includes/cabecalhos.php';

// incluindo navbar
include_once 'includes/navbar.php';

// incluindo os estilos
include_once 'includes/style.php';

?>

<div class="row">
	<div class="col s12 m7 push-m3">
		<h3 class="light"> Olá <?php echo $dados['nome']; ?>,</h3>
		<h5 class="light">Essa é a sua lista de perguntas </h5>
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<!-- Buscando dados da base no arquivo cabecalhos.php -->
				<?php
					$contador = count($pergunta);
					foreach ($pergunta as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<!-- Criando a variável sql para buscar no bd -->
				<?php
					$sql = "SELECT * FROM Pergunta WHERE ";
					for ($i=0; $i < count($ids_objestrategico); $i++) {
						if ($i == 0):
							// buscando as bases que tenham os ids de objetivo estrategicos
							// pertencentes ao usuário
							$sql = $sql."idObjEstrategico = '$ids_objestrategico[$i]'";
						else:
							$sql = $sql." or idObjEstrategico = '$ids_objestrategico[$i]'";
						endif;
					}
					$resultado = mysqli_query($connect, $sql);

					while ($pergunta_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr>
					<!-- Imprimindo os dados da base -->
					<td><?php
					// buscando nome dos projetos aos quais a base pertence
						$id = $pergunta_dados['idObjEstrategico'];
						$sql = "SELECT nome FROM ObjEstrategico WHERE idObjEstrategico = '$id'";
						$objestrategico_nome = mysqli_query($connect, $sql);
						$objestrategico_nome = mysqli_fetch_array($objestrategico_nome);
						echo $objestrategico_nome['nome'];
					?></td>
					<td><?php echo $pergunta_dados['nome']; ?></td>
					<td><?php echo $pergunta_dados['descricao']; ?></td>
					
					<td><a href="editar-pergunta.php?idPergunta=<?php echo $pergunta_dados['idPergunta']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
					<td><a href="#modal<?php echo $pergunta_dados['idPergunta']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $pergunta_dados['idPergunta']; ?>" class="modal">
						<div class="modal-content">
						  	<h4>Opa!</h4>
						  	<p>Tem certeza que deseja excluir este registro? (Você irá perder todos os registros vinculados a este.)</p>
						</div>
						<div class="modal-footer">
						</div>
						<div>
							<form action="delete.php" method="POST">
								<input type="hidden" name="idPergunta" value="<?php echo $pergunta_dados['idPergunta']; ?>">
								<button type="submit" name="btn-deletar-pergunta" class="btn red modal-deletar-botao">Sim, quero deletar!</button>
								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
							</form>
						</div>
					</div>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		<br>
		<a class='btn waves-effect waves-light blue' href='adicionar-pergunta.php'>adicionar pergunta<i class="material-icons left">add</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>