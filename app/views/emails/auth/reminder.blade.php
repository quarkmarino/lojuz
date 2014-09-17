<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Reinicio de contraseña</h2>

		<div>
			Por favor haga click en el siguiente enlace y complete el formulario para cambiar su contraseña por una nueva: {{ URL::to("reset/$token") }}.
		</div>
	</body>
</html>