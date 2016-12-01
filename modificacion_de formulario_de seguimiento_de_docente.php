<?php  

#Realiza modificacioneds en y actualizaciones en el formulario de seguimiento de docentes y lo guarda en la base de datos.
require('class/database.php');
$objData = new Database();
#$facultades = array("ARQUITECTURA Y CIENCIAS DEL HABITAD", "CIENCIAS Y TECNOLOGIA", "ECONOMIA", "ODONTOLOGIA","MEDICINA", "CIENCIAS DE LA EDUCACION", "AGRONOMIA");
#$carreras = array("INFORMATICA", "SISTEMAS");
#$departamentos = array("INFORMATICA-SISTEMAS");
#$categorias = array("INTERINO", "INVITADO", "ASISTENTE", "ADJUNTO", "CATEDRATICO");

if (isset($_GET['opcion'])) {
	$sth1 = $objData->prepare('SELECT * FROM segui_doc SD, docente D WHERE D.CODIGO2 = SD.FK_DOCENTE AND D.CODIGO2 = :codigo2');
	$sth1->bindParam(':codigo2', $_GET['opcion']);
	$sth1->execute();

	$result1 = $sth1->fetchAll();
	
}

$sth = $objData->prepare('SELECT M.SIGLA2, M.NOMBRE3 FROM materia M');
$sth->execute();

$result = $sth->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		MODIFICACION DE SEGUIMIENTO DE DOCENTE
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<header>
		<dir id="titulo_pagina" class="jumbotron container">
			<h1 class="text-center">Registro de Seguimiento de Docentes</h1>
		</dir>
	</header>
	<div class="container">
		<div class="col_md_12">
			<div class="well well-sm">
				<form id="form-segimiento-doc" >
					<div class="form-group">
						<label class="control-label">MATERIAS</label>
					</div>
					<div class="form-group col-xs-3">
						<select class="form-control" multiple size="10">

							<?php 

							foreach ($result as $key => $value) { ?>
							 	<option><?php echo $value['NOMBRE3']; ?></option>
							 	<?php  
							 } 
							 ?>
							
						</select>
					</div>
					<div class="form-group col-xs-4">
						<div class="col-xs-9 form-group">
							<button type="button" id="b-add-mat" name="btn-add-materia" onclick="anadirMateria()" class="btn btn-primary">
								AGREGAR MATERIA 
							</button>
						</div>
						<div class="col-xs-9 form-group">
							<button type="button" id="b-del-mat" name="btn-eliminar-materia" onclick="eliminarMateria()" class="btn btn-primary">
								ELIMINAR MATERIA
							</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">MATERIAS QUE DICTARA:</label>
					</div>
					<div class="form-group col-xs-3">
						<?php  

						if (isset($resul1)) { ?>
							<select class="form-control" multiple size="10">

								<?php 

								foreach ($result as $key => $value) { ?>
								 	<option><?php echo $value['NOMBRE3']; ?></option>
								 	<?php  
								 } 
								 ?>
								
							</select>
							<?php

						} else { ?>
							<select class="form-control" multiple size="10">

								<?php 

								foreach ($result as $key => $value) { ?>
								 	<option><?php echo $value['NOMBRE3']; ?></option>
								 	<?php  
								 } 
								 ?>
								
							</select>
							<?php
						}
						?>
					</div>
					<br>
					<br>
					<fieldset class="form-group col-xs-4 well well-sm">
					<legend>HORARIO:</legend>
						<div class="form-group">
							<div class="col-xs-6 form-group">
								<label class="control-label">Día</label>
								<select class="form-control" name="dia-horario">
									<option>--</option>
									<option>LUNES</option>
									<option>MARTES</option>
									<option>MIERCOLES</option>
									<option>JUEVES</option>
									<option>VIERNES</option>
									<option>SABADO</option>
								</select>
							</div>
							<div class="form-group col-xs-6">
								<label class="control-label">HORA INICIO</label>
								<select class="form-control" name="hora-inicio-horario">
									<option>--</option>
									<option>06:45</option>
									<option>08:15</option>
									<option>09:45</option>
									<option>11:15</option>
									<option>12:45</option>
									<option>14:15</option>
									<option>15:45</option>
									<option>17:15</option>
									<option>19:45</option>
									<option>20:15</option>
								</select>
							</div>
							<div class="col-xs-6 form-group">
								<label class="control-label">HORA FIN</label>
								<select class="form-control" name="hora-fin-horario">
									<option>--</option>
									<option>08:15</option>
									<option>09:45</option>
									<option>11:15</option>
									<option>12:45</option>
									<option>14:15</option>
									<option>15:45</option>
									<option>17:15</option>
									<option>19:45</option>
									<option>20:15</option>
									<option>21:45</option>
								</select>
							</div>
							<div class="col-xs-6 form-group">
								<label class="control-label ">AULA</label>
								<input type="text" name="aula" class="form-control">
							</div>
						</div>
					</fieldset>
					<br>
					<br>
					<div class="form-group col-xs-6">
						<button type="button" class="btn btn-primary">AGREGAR</button>
					</div>
					<div class="form-group col-xs-6">
						<button type="button" class="btn btn-primary">QUITAR</button>
					</div>
					<div class="form-group">
						<?php

						if (isset($result1)) { ?>
							<table class="table table-bordered">
							    <thead>
							    	<tr>
							        	<th>RANGO</th>
							        	<th>LUN</th>
							        	<th>MAR</th>
							        	<th>MIE</th>
							        	<th>JUE</th>
							        	<th>VIE</th>
							        	<th>SAB</th>
							      	</tr>
							    </thead>
							    <tbody>
							      	<tr>
							        	<<!--<td><?php echo $result1[0]['NOMBRE_MAT']; ?></td>
							        	<td><?php echo $result1[0]['SIGLA']; ?></td>-->
							        
							      	</tr>
							      
							    </tbody>
							</table>
							<?php

						} else { ?>
							<table class="table table-bordered">
						    	<thead>
						    		<tr>
						        		<th>RANGO</th>
							        	<th>LUN</th>
							        	<th>MAR</th>
							        	<th>MIE</th>
							        	<th>JUE</th>
							        	<th>VIE</th>
							        	<th>SAB</th>
						      		</tr>
						   		</thead>
						   		<tbody>
						   	   		<tr>
						        		<td>--</td>
						    	    	<td>--</td>
						    	    	<td>--</td>
						    	    	<td>--</td>
						    	    	<td>--</td>
						        		<td>--</td>
						 	     	</tr>
						      	
						    	</tbody>
							</table>
							<?php
						}
						?>
					</div>
					
				</form>
			</div>
		</div>
	</div>

</body>
</html>