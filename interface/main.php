<?php
session_start();

//if(isset($_SESSION['email'])
//{
// load graph from mongoID
//}
//else {

//}


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
	<div>
		<button style="margin-left:10%;margin-top:2%;" name="save" onclick="saveGraph()" class="buttonOp">Guardar Grapho</button>
	</div>
	<div class="login-page">
		<h1>Power Grid Simulator</h1>
		<div class="form">
			<input id="fileField" type="file" placeholder="Ler Grapho" >
			<input id="nome" name="nome" type="text" class="pure-input-rounded" placeholder="nome"  >
			<select id="tipo" name="tipo" class="pure-input-1-2" placeholder="Tipo"  >
				<option value="0">Casa</option>
				<option value="1">Posto de energia</option>
				<option value="2">Central Electrica</option>
			</select>
			<input id="potencia" name="potencia" type="text" class="pure-input-rounded" placeholder="Potencia"  >
			<button name="criar" onclick="createNode()" class="pure-button pure-button-primary">criar</button>

			<input id="from" name="nome" type="text" class="pure-input-rounded" placeholder="DE"  >
			<input id="to" name="nome" type="text" class="pure-input-rounded" placeholder="para"  >
			<button name="connect" onclick="connectNode()" class="pure-button pure-button-primary">Connectar Nós</button>
			<button name="display" onclick="displayGraph()" class="pure-button pure-button-primary">Mostrar Grapho</button>
		</div>
	</div>

	<div id="mynetwork" class="mynetwork">
		<h1>Grapho</h1>
	</div>
	<script>
	document.getElementById('fileField').addEventListener('change', loadGraph, false);
	function connectNode(){
		var from=document.getElementById("from").value;
		var to=document.getElementById("to").value;
		if(connect(from,to))
		{
			alert("Nós connectados");
		}
		else {
			alert("Nós não connectados");
		}
		displayGraph();
	}
	function createNode() {
		var id = getNodeID();
		var nome ='"'+document.getElementById("nome").value+'"';
		var tipo =document.getElementById("tipo").value;
		var potencia =document.getElementById("potencia").value;
		if(nome!='""' && tipo!="")
		{
			if(addNode(id,nome, tipo))
			{
				alert("Node criado: "+id+" "+"Nome: "+ nome);
			}
			else {
				alert("Algo correu mal!!");
			}

		}
		displayGraph();
	}
	function displayGraph()
	{
		var nodes=getNode();
		var edges=getEdges();
		var container = document.getElementById('mynetwork');
		var data = {
			nodes: nodes,
			edges: edges
		};
		var options = {};
		var network = new vis.Network(container, data, options);
	}
	function saveGraph()
	{
		var dataJSON=saveFile();
		var element = document.createElement('a');
		element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(dataJSON));
		element.setAttribute('download', "Grapho");
		element.style.display = 'none';
		document.body.appendChild(element);
		element.click();
		document.body.removeChild(element);
	}
	function loadGraph(evt)
	{
		var f = evt.target.files[0];

		if (f) {
			var r = new FileReader();
			r.onload = function(e) {
				var contents = e.target.result;
				loadFile(contents);
				displayGraph();
			}
			r.readAsText(f);
		} else {
			alert("Failed to load file");
		}
	}
</script>


</body>
