<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Tryvlor :: Panel -> Nova Cidade</title>
	<link rel="stylesheet" href="lib/css/materialize.min.css" />
	<link rel="stylesheet" href="lib/css/panelGlobal.css" />
	<link href="lib/css/material-icons.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
</head>
<body>
	<?=get_header_admin()?>

	<main>
		<div class="content">
			<h1>Insira uma nova Cidade</h1>
			<form class="col s12" id="newCity" enctype="multipart/form-data">
				<div class="row">
					<div class="input-field col s12">
						<input id="nameCity" type="text" class="validate" required="required" />
						<label for="nameCity">Nome da Cidade</label>
					</div>	

					<div class="file-field input-field col s12">
						<div class="btn">
							<span>Foto da Cidade</span>
							<input type="file" id="photoCity" required="required" />
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					</div>
					<input type="submit" value="Registrar" />
				</div>
			</form>
		</div>
	</main>

	<script src="lib/js/jquery.min.js"></script>
	<script src="lib/js/materialize.min.js"></script>
	<script src="lib/js/panelGlobal.js"></script>
</body>
</html>