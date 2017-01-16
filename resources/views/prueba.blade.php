<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="http://blog.rappi.com/wp-content/uploads/2016/07/favicon.ico" type="image/x-icon">
	<link rel="icon" href="http://blog.rappi.com/wp-content/uploads/2016/07/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src = "https://code.jquery.com/jquery-3.1.1.min.js" ></script>
	<script type="text/javascript" src = "js/modulo.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title>Prueba Rappi</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="page-header">
			  <h1>Prueba Rappi <small>Cube Summation</small></h1>
			</div>
		</div>
		<div class="row">
			<form id = "formulario_comandos">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Escribe los comandos en el area de texto</label>
			    <textarea rows="7" class="form-control" id = "entrada_comandos"></textarea>
			  </div> 
			    <h5> ó </h5>
			  <div class="form-group">
			  	<h5>Sube el archivo .txt de comandos</h5>
			    <div class="input-group">
	                <label class="input-group-btn">
	                    <span class="btn btn-primary">
	                       <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>  Buscar Archivo&hellip; <input type="file" id = "archivo_comandos" accept=".txt" style="display: none;">
	                    </span>
	                </label>
	                <input type="text" class="form-control" readonly>
	            </div>
			  </div>
			  <button type="button" id = "procesar_comandos" class="btn btn-primary"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>   Procesar</button>
			</form>
		</div>
		<div class="row">
			<form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Resultados</label>
			    <textarea rows="8" class="form-control" id = "resultados_comandos"></textarea>
			  </div>
			  <button type="button" id = "resetear" class="btn btn-success"> <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>   Refrescar</button>
			</form>
		</div>
	</div>
</body>
</html>