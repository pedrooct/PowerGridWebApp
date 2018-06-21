<?php
session_start();
require_once "../api/query.php";
?>
<html lang="pt-PT">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Main Page">
	<title>web page of &ndash; Pedro Costa &ndash; Pure</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="../style/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
	<script type="text/javascript" src="../api/graph.js"></script>

	<title></title>

</head>
<body>
	<div class="login-page">
		<h1>Power Grid Simulator</h1>
		<div class="form">
			<form method="post">
				<input id="email" name="email" type="email" class="pure-input-rounded" placeholder="Insira o email de registo" requireD>
				<input id="password" name="password" type="password" class="pure-input-rounded" placeholder="Password" required>
				<button name="login"class="button-line">Entrar</button>
			</form>
			<?php
			if(isset($_POST['login']))
			{
				if(!empty($_POST['email']) && !empty($_POST['password']))
				{
					if(verifyUser($_POST['email'],$_POST['password']))
					{
						$_SESSION['email']=$_POST['email'];
						header('location: main.php');
					}
					else {
						echo '<div class="error">OOOPS! Utilizador não existe ou a palavra passe está errada!! </div>';
					}
				}
				else {
					echo '<div class="error">OOOPS! Não preencheu os campos todos !! </div>';
				}
			}
			?>
		</div>
	</div>
	<div style="margin-top: 20px">
		<a class="button-line" href="register.php">Registar!</a>
	</div>
	<div style="margin-top: 60px">
		<form  method="post">
			<button name="jump" class="button-line">Saltar!</button>
			<?php
			if(isset($_POST['login']))
			{
				$_SESSION['email']="";
				header('location: main.php');
			}
			?>
		</form>

	</div>
</body>
</html>
