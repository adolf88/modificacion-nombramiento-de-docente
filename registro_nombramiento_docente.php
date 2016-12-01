<?php 

require('class/database.php');
$objData = new Database();
$facultades = array("ARQUITECTURA Y CIENCIAS DEL HABITAD", "CIENCIAS Y TECNOLOGIA", "ECONOMIA", "ODONTOLOGIA","MEDICINA", "CIENCIAS DE LA EDUCACION", "AGRONOMIA");
$carreras = array("INFORMATICA", "SISTEMAS");
$departamentos = array("INFORMATICA-SISTEMAS");
$categorias = array("INTERINO", "INVITADO", "ASISTENTE", "ADJUNTO", "CATEDRATICO");

if (isset($_GET['opcion'])) {
	$sth1 = $objData->prepare('SELECT * FROM segui_doc SD, docente D WHERE D.CODIGO2 = SD.FK_DOCENTE AND D.CODIGO2 = :codigo2');
	$sth1->bindParam(':codigo2', $_GET['opcion']);
	$sth1->execute();

	$result1 = $sth1->fetchAll();
	
}

$sth = $objData->prepare('SELECT D.APE_PATERNO, D.APE_MATERNO, D.NOMBRE2, D.CODIGO2 FROM segui_doc SD, docente D WHERE D.CODIGO2 = SD.FK_DOCENTE');
$sth->execute();

$result = $sth->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REGISTRO DE NOMBRAMIENTO DE DOCENTE</title>
	<!--<link rel="stylesheet" type="text/css" href="css/estilos.css">-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<header>
		<dir id="titulo_pagina" class="jumbotron container">
			<h1 class="text-center">Registro de Nombramiento de Docentes</h1>
		</dir>
	</header>
	<div id="formulario" class="container">
		<form action="modificacion_nom_docente_en_pdf.php" method="post" name="formulario_modificacion_docente" onsubmit="return validacion()" role="form">
			<label id="seleccionar_docente" for="selecconar_docente" class="bg-info">Docente:</label>
			<select name="lista_de_docentes" id="lista_docentes" class="form-control" onchange= "return optenerLista();" >
			<?php  

			if (isset($result1)) { ?>
				
				<option value="SELECCIONE_EL_DOCENTE">--SELECCIONE EL DOCENTE--</option>
				<?php 

					foreach ($result as $key => $value) { 

						if ($result1[0]['NOMBRE'] == $value['NOMBRE'] ) { ?>
							<option value="<?php echo $value['CODIGO']; ?>" selected><?php echo $value['NOMBRE']; ?></option>
							<?php

						} else { ?>
							<option value="<?php echo $value['CODIGO']; ?>"><?php echo $value['NOMBRE']; ?></option>
							<?php
						}
					}
				?>
				
			<?php  

			} else { ?>
				<option value="SELECCIONE_EL_DOCENTE">--SELECCIONE EL DOCENTE--</option>
				<?php 
				
					foreach ($result as $key => $value) { ?>
						<option value="<?php echo $value['CODIGO2']; ?>"><?php echo $value['APE_PATERNO']; echo " "; echo $value['APE_MATERNO']; echo " "; echo $value['NOMBRE2']; ?></option>
						<?php
					}
				
					
			}
			?>
			</select>
			<br>
			<br>
			<section>
				<div id="datos_docente" class="bg-info form-group">
					
						
						<br>
						<label for="facultad_doc">- Facultad:             </label>
						<br>
					
						<select name="lista_facultades" id="lis_fac" class="form-control">
							<option>--</option>
							<?php 

							if (isset($result1)) {

								for ($i=0; $i < sizeof($facultades); $i++) { 

									if ($result1[0]['FACULTAD'] == $facultades[$i]) { ?>
										<option value="<?php echo $facultades[$i]; ?>" selected><?php echo $facultades[$i]; ?></option>
										<?php  

									} else { ?>
										<option value="<?php echo $facultades[$i]; ?>"><?php echo $facultades[$i]; ?></option>
										<?php
									}
								}

							} else { 

								for ($i=0; $i < sizeof($facultades); $i++) { ?>

									<option value="<?php echo $facultades[$i]; ?>"><?php echo $facultades[$i]; ?></option>
										<?php
								}
							}
							?>
						</select>
						
						<br>
						<label for="carrera">- Carrera:                   </label>
						<br>
						<select name="lista_carreras" id="lis_carr" class="form-control">
							<option>--</option>
							<?php 

							if (isset($result1)) {

								for ($i=0; $i < sizeof($carreras); $i++) { 

									if ($result1[0]['CARRERA'] == $carreras[$i]) { ?>
										<option value="<?php echo $carreras[$i]; ?>" selected><?php echo $carreras[$i]; ?></option>
										<?php  

									} else { ?>
										<option value="<?php echo $carreras[$i]; ?>"><?php echo $carreras[$i]; ?></option>
										<?php
									}
								}

							} else { 

								for ($i=0; $i < sizeof($carreras); $i++) { ?>

									<option value="<?php echo $carreras[$i]; ?>"><?php echo $carreras[$i]; ?></option>
										<?php
								}
							}
							?>
						</select>
						<br>
						<label for="departamento">- Departamento:         </label>
						<br>
						<select name="lista_departamentos" id="ld" class="form-control">
							<option value="">--</option>
							<?php  

							if (isset($result1)) { 

								for ($i=0; $i < sizeof($departamentos); $i++) { 

									if ($result1[0]['DEPARTAMENTO'] == $departamentos[$i]) { ?>
										<option value="<?php echo $departamentos[$i]; ?>" selected><?php echo $departamentos[$i]; ?></option>
										<?php  

									} else { ?>
										<option value="<?php echo $departamentos[$i]; ?>"><?php echo $departamentos[$i]; ?></option>
										<?php
									}
								}

							} else { 

								for ($i=0; $i < sizeof($departamentos); $i++) { ?>

									<option value="<?php echo $departamentos[$i]; ?>"><?php echo $departamentos[$i]; ?></option>
										<?php
								}
							}
							?>
						</select>
						<br>
						<label for="diploma_academico">- Diploma Academico:         </label>
						<br>
						<input type="text" name="dip_ac_doc" size="50" id="dipd" class="form-control">
						<br>
						<label for="titulo_docente">- Titulo Profesional en provision nacional:         </label>
						<br>
						<input type="text" name="tit_doc" size="50" id="tpd" class="form-control">
						<br>
						
				</div>

			</section>
			<section>
				<div id="categoria_nombramiento" class="bg-info"> 
					
						<h4>Categoria del Nombramiento Solicitado:</h3>
						<?php

						if (isset($result1)) { 
							
							if ($result1[0]['INTERNO'] == 'S') { ?>
								<input type="checkbox" id="inter" name="interino" checked>
								<label for="interino">Interino</label>
								<br>
								<?php

							} else { ?>
								<input type="checkbox" id="inter" name="interino">
								<label for="interino">Interino</label>
								<br>
								<?php
							}

							if ($result1[0]['INVITADO'] == 'S') { ?>
								<input type="checkbox" id="invit" name="invitado" checked>
								<label for="invitado">Invitado</label>
								<br>
								<?php

							} else { ?>
								<input type="checkbox" id="invit" name="invitado">
								<label for="invitado">Invitado</label>
								<br>
								<?php
							}

							if ($result1[0]['ASISTENTEA'] == 'S') { ?>
								<input type="checkbox" id="asist" name="asistente" checked>
								<label for="asistene">Asistente</label>
								<br>
								<?php

							} else { ?>
								<input type="checkbox" id="asist" name="asistente">
								<label for="asistene">Asistente</label>
								<br>
								<?php
							}

							if ($result1[0]['ADJUNTOB'] == 'S') { ?>
								<input type="checkbox" id="adju" name="adjunto" checked>
								<label for="adjunto">Adjunto</label>
								<br>
								<?php

							} else { ?>
								<input type="checkbox" id="adju" name="adjunto">
								<label for="adjunto">Adjunto</label>
								<br>
								<?php
							}

							if ($result1[0]['CATEDRATICOC'] == 'S') { ?>
								<input type="checkbox" id="catedra" name="catedratico" checked>
								<label for="catedratico">Catedratico</label>
								<br>
								<?php

							} else { ?>
								<input type="checkbox" id="catedra" name="catedratico">
								<label for="catedratico">Catedratico</label>
								<br>
								<?php
							}

						} else { ?>
							<input type="checkbox" id="inter" name="interino">
							<label for="interino">Interino</label>
							<br>
							<input type="checkbox" id="invit" name="invitado">
							<label for="invitado">Invitado</label>
							<br>
							<input type="checkbox" id="asist" name="asistente">
							<label for="asistene">Asistente</label>
							<br>
							<input type="checkbox" id="adju" name="adjunto">
							<label for="adjunto">Adjunto</label>
							<br>
							<input type="checkbox" id="catedra" name="catedratico">
							<label for="catedratico">Catedratico</label>
							<br>
							<?php
						}
						?>
						

					
				</div>
			</section>
			<section>
				<div id="materias_asignadas" class="form-group">
					<label for="asignatura">Asignatura(s):</label>
					<br>
					
					<?php

					if (isset($result1)) { ?>
						<table class="table table-bordered">
						    <thead>
						    	<tr>
						        	<th>ASIGNATURA</th>
						        	<th>CODIGO</th>
						      	</tr>
						    </thead>
						    <tbody>
						      	<tr>
						        	<td><?php echo $result1[0]['NOMBRE_MAT']; ?></td>
						        	<td><?php echo $result1[0]['SIGLA']; ?></td>
						        
						      	</tr>
						      
						    </tbody>
						</table>
						<?php

					} else { ?>
						<table class="table table-bordered">
					    	<thead>
					    		<tr>
					        		<th>ASIGNATURA</th>
					        		<th>CODIGO</th>
					      		</tr>
					   		</thead>
					   		<tbody>
					   	   		<tr>
					        		<td>--</td>
					    	    	<td>--</td>
					        
					 	     	</tr>
					      	
					    	</tbody>
						</table>
						<?php
					}
					?>
					<br>
					<label>Tiempo de dedicacion:</label>
					<br>
					<?php  

					if (isset($result1)) { 

						if ($result1[0]['TIEMPO'] == "PARCIAL") { ?>
							<input type="radio" name="dedicacion" value="parcial" checked="">Parcial
							<input type="radio" name="dedicacion" value="exclusivo">Exclusivo
							<?php 

						} else { ?>
							<input type="radio" name="dedicacion" value="parcial">Parcial
							<input type="radio" name="dedicacion" value="exclusivo" checked="">Exclusivo
							<?php
						}
						
						
					} else { ?>
						<input type="radio" name="dedicacion" value="parcial">Parcial
						<input type="radio" name="dedicacion" value="exclusivo">Exclusivo
						<?php
					}
					?>
				</div>
			</section>
			<section>
				<div id="fechas" class="bg-info form-group">

				<?php 

				if (isset($result1)) { ?>
					<label>Nombramiento a partir de:</label>
					<input type="date" name="fecha_inicio" value="<?php echo $result1[0]['FECHA_NOM']; ?>">
					<label>Fecha de solicitud:</label>
					<input type="date" name="fecha_solicitud" value="<?php echo $result1[0]['FECHA_SOL']; ?>">
					<label>Tiempo de duracion:</label>
					<input type="text" name="tiempo" value="<?php echo $result1[0]['DURACION']; ?>">
					<br>
					<?php
				} else { ?>
					<label>Nombramiento a partir de:</label>
					<input type="date" name="fecha_inicio" value="">
					<label>Fecha de solicitud:</label>
					<input type="date" name="fecha_solicitud">
					<label>Tiempo de duracion:</label>
					<input type="text" name="tiempo">
					<br>
					<?php
				}
				?>

				</div>
			</section>
			<input type="submit" value="Aceptar" id="enviar_datos" class="btn btn-primary btn-lg">

		</form>
	</div>
	
	<!--Llenado de la lista de la base de datos-->
	<script type="text/javascript">
		function optenerLista(){
			var opcion = document.getElementById("lista_docentes").value;
			window.location.href = 'http://localhost/Modificacion%20nombramiento%20docente/modificacion nom docente.php?opcion='+opcion;
		}
	</script>

	<!--Validacion de todos los campos del formulario-->
	<script>
		function validacion() {

			var valor_lista = document.getElementById("lista_docentes").selectedIndex;

			if (valor_lista == null || valor_lista == 0) {
				alert("DEBE SELECCIONAR UN DOCENTE");
				return false;

			} else {
				var nommbre_docente = document.getElementById("np").value;

				if (nommbre_docente == null || nommbre_docente.length == 0 || /^\s+$/.test(nommbre_docente) || !isNaN(nommbre_docente)) {
					alert("INTRODUSCA UN NOMBRE DE DOCENTE VALIDO");
					return false;

				} else {
					var facultad_docente = document.getElementById("fc").value;

					if (facultad_docente == null || facultad_docente.length == 0 || /^\s+$/.test(facultad_docente) || !isNaN(facultad_docente)) {
						alert("INTRODUSCA LA FACULTAD");
						return false;

					} else {
						var carrera_docente = document.getElementById("cd").value;
						
						if (carrera_docente == null || carrera_docente.length == 0 || /^\s+$/.test(carrera_docente) || !isNaN(carrera_docente)) {
							alert("INTRODUSCA LA CARRERA");
							return false;
						} else {
							var departamento_docente = document.getElementById("dd").value;

							if (departamento_docente == null || departamento_docente.length == 0 || /^\s+$/.test(departamento_docente) || !isNaN(departamento_docente)) {
								alert("INTRODUSCA EL DEPARTAMENTo");
								return false;
							} else {
								var diploma_docente = document.getElementById("dipd").value;
								
								if (diploma_docente == null || diploma_docente.length == 0 || /^\s+$/.test(diploma_docente) || !isNaN(diploma_docente)) {
									alert("INTRODUSCA EL DIPLOMA ACADEMICO");
									return false;
								} else {
									var titulo_profecional_docente = document.getElementById("tpd").value;

									if (titulo_profecional_docente == null || titulo_profecional_docente.length == 0 || /^\s+$/.test(titulo_profecional_docente) || !isNaN(titulo_profecional_docente)) {
										alert("DEBE INTRODUCIR EL TITULO PROFECIONAL DEL DOCENTE");
										return false;
									} else {
										var check_interino = document.getElementById("inter");
										var check_invitado = document.getElementById("invit");
										var check_asistente = document.getElementById("asist");
										var check_adjunto = document.getElementById("adju");
										var check_catedratico = document.getElementById("catedra");

										if (!check_interino.checked && !check_invitado.checked && !check_asistente.checked && !check_adjunto.checked && !check_catedratico.checked) {
											alert("SELECCIONE UNA CATEGORIA PARA EL DOCENTE");
											return false;
										} else {
											alert("MODIFICACION GUARDADA. HAGA CLIK EN ACEPTAR PARA VER EL FORMULARIO DE SOLICITUD E IMPRIMIRLO")
										}
									}
								}
							}
							
						}
					}
					
				}
				
			}
			
		}
	</script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>