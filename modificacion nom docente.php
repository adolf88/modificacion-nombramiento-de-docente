<?php 

require('class/database.php');
$objData = new Database();
$facultades = array("ARQUITECTURA Y CIENCIAS DEL HABITAD", "CIENCIAS Y TECNOLOGIA", "ECONOMIA", "ODONTOLOGIA","MEDICINA", "CIENCIAS DE LA EDUCACION", "AGRONOMIA");
$carreras = array("INFORMATICA", "SISTEMAS");
$departamentos = array("INFORMATICA-SISTEMAS");
$categorias = array("INTERINO", "INVITADO", "ASISTENTE", "ADJUNTO", "CATEDRATICO");

if (isset($_GET['opcion'])) {
	$sth1 = $objData->prepare('SELECT * FROM nombra_doc ND, categoria_doc CD, materia_dicta MD WHERE ND.CODIGO = :codigo AND ND.CODIGO = CD.FK_NOMBRA_DOC AND MD.FK_NOMBRA_DOC = ND.CODIGO');
	$sth1->bindParam(':codigo', $_GET['opcion']);
	$sth1->execute();

	$result1 = $sth1->fetchAll();
	
}

$sth = $objData->prepare('SELECT NOMBRE, CODIGO FROM nombra_doc');
$sth->execute();

$result = $sth->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MODIFICACION DE NOMBRAMIENTO DE DOCENTE</title>
	<!--<link rel="stylesheet" type="text/css" href="css/estilos.css">-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<header>
		<dir id="titulo_pagina" class="jumbotron container page-header">
			<h1 class="text-center">Modificacion de Nombramiento de Docentes</h1>
			<h2 class="text-right">Gestion 1/2016</h2>
		</dir>
	</header>
	<div id="formulario" class="form-group container well well-sm">
		<form action="modificacion_nom_docente_en_pdf.php" method="post" name="formulario_modificacion_docente" onsubmit="return validacion()" role="form">
			<div class="form-group">
				<label id="seleccionar_docente" for="selecconar_docente" class="control-label col-xs-3">Docente:</label>
				<div class="col-xs-9">
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
								<option value="<?php echo $value['CODIGO']; ?>"><?php echo $value['NOMBRE']; ?></option>
								<?php
							}
						
							
					}
					?>
					</select>
				</div>
			</div>
			<br>
			<br>
			<section class="form-group">
				<div id="datos_docente" class="form-group">
					
						
						<br>
						<label class="control-label col-xs-3" for="facultad_doc"> Facultad:             </label>
				
						<div class="col-xs-9">
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
						</div>
						
						<br>
						<br>
						<br>
						<label for="carrera" class="control-label col-xs-3"> Carrera:                   </label>
						<div class="col-xs-9">
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
						</div>
						
						<br>
						<br>
						<br>
						<label for="departamento" class="control-label col-xs-3"> Departamento:         </label>
						<div class="col-xs-9">
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
						</div>
						<br>
						<br>
						<br>
						<div class="form-group">
							<label for="diploma_academico" class="control-label col-xs-3"> Diploma Academico:</label>

							<div class="col-xs-9">
								<?php

								if (isset($result1)) { ?>
									<input type="text" name="dip_ac_doc" id="dipd" class="form-control" value="<?php echo $result1[0]['DIPLOMA']; ?>" >
									<?php

								} else { ?>
									<input type="text" name="dip_ac_doc" id="dipd" class="form-control">
									<?php
								}
								?>
							</div>
						</div>
						<br>
						<br>
						<div class="form-group">
							<label for="titulo_docente" class="control-label col-xs-3"> Titulo Profesional en provision nacional:         </label>
							<div class="col-xs-9">
								<?php

								if (isset($result1)) { ?>
									<input type="text" name="tit_doc" size="50" id="tpd" class="form-control"  value="<?php echo $result1[0]['TITULO'] ?>" >
									<?php

								} else { ?>
									<input type="text" name="tit_doc" size="50" id="tpd" class="form-control">
									<?php
								}
								?>
							</div>
							
						</div>
						<br>
						
				</div>

			</section>
			<section>
				<div id="categoria_nombramiento" class="form-group"> 
					
						<h3>Categoria del Nombramiento Solicitado:</h3>
						<div class="col-xs-offset-3 col-xs-9 checkbox-inline">
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
					<div class="control-label col-xs-3">
						<label>Tiempo de dedicacion:</label>
						<br>
						<?php  

						if (isset($result1)) { 

							if ($result1[0]['TIEMPO'] == "PARCIAL") { ?>
								<div>
									<label class="radio-inline">
										<input type="radio" name="dedicacion" value="parcial" checked="">Parcial
									</label>
								</div>
								<div>
									<label class="radio-inline">
										<input type="radio" name="dedicacion" value="exclusivo">Exclusivo
									</label>
								</div>
								
								<?php 

							} else { ?>
								<div>
									<label class="radio-inline">
										<input type="radio" name="dedicacion" value="parcial">Parcial
									</label>
								</div>
								<div>
									<label class="radio-inline">
										<input type="radio" name="dedicacion" value="exclusivo" checked="">Exclusivo
									</label>
								</div>
								<?php
							}
							
							
						} else { ?>
							<div>
								<label class="radio-inline">
									<input type="radio" name="dedicacion" value="parcial">Parcial
								</label>
							</div>
							<div>
								<label class="radio-inline">
									<input type="radio" name="dedicacion" value="exclusivo">Exclusivo
								</label>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</section>
			<section>
				<div id="fechas" class="form-group">

				<?php 

				if (isset($result1)) { ?>
					<label><input type="date" name="fecha_inicio" value="<?php echo $result1[0]['FECHA_NOM']; ?>">Nombramiento a partir de:</label>
					
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
			<footer class="form-group">
				<input type="submit" value="Aceptar" id="enviar_datos" class="btn btn-primary btn-lg">
				<button type="button" onclick="volverInicio()" class="btn-primary btn-lg btn" >Salir</button>
			</footer>
			

		</form>
	</div>

	<!--Boton para salir a la pagina de nicio-->
	<script type="text/javascript">
		function volverInicio() {
			window.location.href = 'index.html';
		}
	</script>
	
	<!--Llenado de la lista de la base de datos-->
	<script type="text/javascript">
		function optenerLista() {
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
				var facultad_docente = document.getElementById("lis_fac").selectedIndex;

					if (facultad_docente == null || facultad_docente == 0) {
						alert("SELECCIONE LA FACULTAD");
						return false;

					} else {
						var carrera_docente = document.getElementById("lis_carr").selectedIndex;
						
						if (carrera_docente == null || carrera_docente == 0) {
							alert("SELECCIONE LA CARRERA");
							return false;
						} else {
							var departamento_docente = document.getElementById("ld").selectedIndex;

							if (departamento_docente == null || departamento_docente == 0) {
								alert("SELECCIONE EL DEPARTAMENTo");
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

											radiobutton_dedicacion = document.getElementsByName("dedicacion");
											var seleccionado = false;

											for (var i = 0; i < radiobutton_dedicacion.length; i++) {
												
												if (radiobutton_dedicacion[i].checked) {
													seleccionado = true;
													break;
												}
											}

											if (!seleccionado) {
												alert("SELECCIONE EL TIEMPO DE DEDICACION");
												return false;

											} else {

												var fecha_ini = document.getElementsByName("fecha_inicio").value;
												var fecha_sol = document.getElementsByName("fecha_solicitud").value;

												
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