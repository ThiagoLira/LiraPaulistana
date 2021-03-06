<!DOCTYPE HTML PUBLIC>
<?php
require_once "php/aplicacao.php";

session_start();

$interface = new Aplicacao();

if(!$interface->checkLogin()){
    header("Location: loginAreaUsuario.php");
    exit();
}
if(!$interface->isAdministrador($_SESSION['usuarioId']) && !$interface->isOperador($_SESSION['usuarioId'])){
    header("Location: meuPainel.php");
    exit();
}
?>
<!--[if lt IE 7 ]>
	<html class="ie ie6" lang="en">
	<![endif]-->
	<!--[if IE 7 ]>
		<html class="ie ie7" lang="en">
		<![endif]-->
		<!--[if IE 8 ]>
			<html class="ie ie8" lang="en">
			<![endif]-->
			<!--[if (gte IE 9)|!(IE)]>
				<!-->
				<html lang="en">
				<!--<![endif]-->
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
					<meta name="description" content="">
					<meta name="author" content="">
					<title>Lira Paulistana</title>
					<!-- Favicons==================================================- ->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

 
					<!-- Custom Fonts -->
					<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,600italic,700,700italic,900' rel='stylesheet'
					type='text/css'>
					<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
					<!-- Estilo do Input Field-->
					<link rel="stylesheet" type="text/css" href="css/operador.css" />
					<link rel="stylesheet" type="text/css" href="css/shoko.css" />
					
					<script src="../default/js/jquery.js"></script>
					<script src="js/classie.js"></script>
					<script src="js/regexp.js"></script>
					<script src="js/jquery.maskedinput.min.js"></script>
					<!-- jQuery -->
					
					<script type="text/javascript">
						var _gaq = _gaq || [];
						_gaq.push(['_setAccount', 'UA-7243260-2']);
						_gaq.push(['_trackPageview']);
						(function() {
						var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
						ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
						})();
					</script>


					<script type="text/javascript">

					function	selecionaCadastro (){


						 var e = document.getElementById("profaluno");
						 var strUser = e.options[e.selectedIndex].value; //seleciona se o cadastro é de um aluno ou professor
						 //window.alert(strUser); 



						 if (strUser=="Aluno")
						 {
						 		document.getElementById('alun').style.display='inline-block';
						 		document.getElementById('profe').style.display='none';
						 		document.getElementById('profe1').style.display='none';
						 		document.getElementById('profe2').style.display='none';

						 	
						 }

						 if (strUser=="Professor")
						 {
						 		document.getElementById('alun').style.display='none';
						 		document.getElementById('profe').style.display='inline-block';
						 		document.getElementById('profe1').style.display='inline-block';
						 		document.getElementById('profe2').style.display='inline-block';

						 }



					}				







					</script>







					<style>
						body{
						
						background-color: white !important;
						}
					</style>
				</head>
				<body>
					<section id="cadastro" class="section-white">
            			<h1 class="tituloPagina">Cadastro</h1>
            			<?php if(isset($_SESSION['erro']) && $_SESSION['erro'] != NULL) {
			                echo "<p class='erro'>".$_SESSION['erro']."</p>";
			                $_SESSION['erro'] = NULL;
			            }
			            if(isset($_SESSION['msg']) && $_SESSION['msg'] != NULL) {
			                echo "<p class='msg'>".$_SESSION['msg']."</p>";
			                $_SESSION['msg'] = NULL;
			            }
			            ?>
						<form name="cadastroAluno" method="post" action="cadastroAluno.php">
							<select name="profaluno" class = "selectCadastro" id="profaluno" onchange="selecionaCadastro();">
							  <option value="Professor">Professor</option>
							  <option value="Aluno" selected="selected" >Aluno</option>
							</select>
							<br>
							<span class="input input--hoshi">
								<input class="input__field input__field--hoshi" name="nome" type="text" id="input-1" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
									<span class="input__label-content input__label-content--hoshi">Nome</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input maxlength="15" class="input__field input__field--hoshi" name="rg" type="text" id="rg" 
								required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-5">
									<span class="input__label-content input__label-content--hoshi">RG</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input onBlur="ValidarCPF(cadastroAluno.cpf);" maxlength="14"  name="cpf" class="input__field input__field--hoshi"
								type="text" id="cpf" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">CPF</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input maxlength="20" name="tel"  class="input__field input__field--hoshi"
								type="text" id="tel" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Telefone</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input maxlength="10" id="datanasc" name="datanasc"  class="input__field input__field--hoshi"
								type="text" id="data" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Data de Nascimento</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input name="endereco" onKeyPress="MascaraTelefone(cadastroAluno.tel);" class="input__field input__field--hoshi"
								type="text" id="input-4" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Endereço</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input class="input__field input__field--hoshi" name="email" type="email" id="input-5" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Email</span>
								</label>
							</span>
							<br>
							<span class="input input--hoshi">
								<input maxlength="20" name="cel"  class="input__field input__field--hoshi"
								type="text" id="cel" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Celular</span>
								</label>
							</span>
							<br>
							<span id ="login" class="input input--hoshi">
								<input type="text" name="username"  class="input__field input__field--hoshi"
								type="text" id="input-6" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Login</span>
								</label>
							</span>
							<br>
							<span id ="senha" class="input input--hoshi">
								<input type="password" name="senha"  class="input__field input__field--hoshi"
								type="text" id="input-6" required />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Senha</span>
								</label>
							</span>
							<br>
							<span id ="alun" class="input input--hoshi">
								<select id="profdoaluno" name="professorId">
			                		<?php $interface->selectTodosProfessores() ?>
			                	</select>
							</span>
							<br>
							<span  style="display: none" id ="profe" class="input input--hoshi">
								<input name="instrumento"  class="input__field input__field--hoshi"
								type="text" id="input-6" />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Instrumento</span>
								</label>
							</span>
							<br>
								<span style="display: none" id ="profe1" class="input input--hoshi">
								<input name="formacao"  class="input__field input__field--hoshi"
								type="text" id="input-6" />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Formação</span>
								</label>
							</span>
							<br>
								<span style="display: none" id ="profe2" class="input input--hoshi">
								<input name="preferencia"  class="input__field input__field--hoshi"
								type="text" id="input-6" />
								<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-6">
									<span class="input__label-content input__label-content--hoshi">Preferência</span>
								</label>
							</span>
							<br>
							<div>
								<button type = "submit"  class="btn btn-primary btn-lg border-radius" id="botaoCadastra">Enviar</button>
							</div>
						</form>
						<p><a href="meuPainel.php">Voltar a meu painel.</a></p>
					</section>
				</body>
				<link rel="stylesheet" type="text/css" href="css/normalize.css" />
				<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
				<script>
					
					(function() {
						// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
						if (!String.prototype.trim) {
							(function() {
								// Make sure we trim BOM and NBSP
								var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
								String.prototype.trim = function() {
									return this.replace(rtrim, '');
								};
							})();
						}
		
						[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
							// in case the input is already filled..
							if( inputEl.value.trim() !== '' ) {
								classie.add( inputEl.parentNode, 'input--filled' );
							}
		
							// events:
							inputEl.addEventListener( 'focus', onInputFocus );
							inputEl.addEventListener( 'blur', onInputBlur );
						} );
		
						function onInputFocus( ev ) {
							classie.add( ev.target.parentNode, 'input--filled' );
						}
		
						function onInputBlur( ev ) {
							if( ev.target.value.trim() === '' ) {
								classie.remove( ev.target.parentNode, 'input--filled' );
							}
						}
					})();
				</script>