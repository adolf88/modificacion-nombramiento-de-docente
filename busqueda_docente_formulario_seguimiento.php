<?php  
	
	require('class/database.php');
	$objData = new Database();
	
	if (isset($_GET['criterio']) && isset($_GET['nomAp'])) {
		$r = '%'.$_GET['criterio'].'%';
		
		if ($_GET['nomAp'] == 0) {
	
			$sth = $objData->prepare('SELECT D.APE_PATERNO, D.APE_MATERNO, D.NOMBRE2, D.CODIGO2 FROM docente D WHERE D.NOMBRE2 LIKE :nombre');
			$sth->bindParam(':nombre',$r);

		} else {
			$sth = $objData->prepare('SELECT D.APE_PATERNO, D.APE_MATERNO, D.NOMBRE2, D.CODIGO2 FROM docente D WHERE D.APE_PATERNO LIKE :apellido');
			$sth->bindParam(':apellido', $r);
		}

	} else {
		$sth = $objData->prepare('SELECT D.APE_PATERNO, D.APE_MATERNO, D.NOMBRE2, D.CODIGO2 FROM docente D');
		
	}
	$sth->execute();
	$result = $sth->fetchAll();
	#print_r($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>BUSQUEDA DOCENTE</title>
	<link rel="stylesheet" type="text/css" href="css/estilosTabla.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<form class="form-horizontal">
		<div class="container">
			<fieldset>
				<div id="titulo_Busqueda" class="jumbotron text-center">
					<h1>BUSQUEDA DE DOCENTE</h2>
				</div>
				<div class="well">
					<div class="form-group">
						<div class="">
							<label  class="">Criterio:</label>
							<input type="text" name="criterio" id="cr" class="">
						</div>
						<div class="col-xs-2">
	        			    <label class="radio-inline">
	            			    <input type="radio" name="nameRadios" value="nombre"> Nombre
	           				 </label>
	        			</div>
	       				 <div class="col-xs-2">
	       				     <label class="radio-inline">
	        			        <input type="radio" name="nameRadios" value="apellido"> Apellido Paterno
	        			    </label>
	       				 </div>
	       				 <div class="form-group">
	       				 	<button type="button" id="boton_buscar" class="btn btn-primary" onclick="buscar()" >BUSCAR</button>
	       				 </div>

					</div>
					<div id="tabla_docentes">
						<table >
							<thead>
								<th>NOMBRE</th>
								<th>APELLIDO PATERNO</th>
								<th>APELLIDO MATERNO</th>
							</thead>
							<tbody>
								
								<?php  

								if (isset($result) && isset($_GET['criterio']) && isset($_GET['nomAp'])) {
									
									for ($i=0; $i < sizeof($result) ; $i++) { ?>
										<tr style='cursor: pointer' onclick='muestra(this)'>
											<td><?php echo $result[$i]['NOMBRE2']; ?></td>
											<td><?php echo $result[$i]['APE_PATERNO']; ?></td>
											<td><?php echo $result[$i]['APE_MATERNO']; ?></td>
											
										</tr>
										<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<br>
					<div class="">
						<div class="form-group">
							<label>Resultado:</label>
							<input type="text" name="resultado_busqueda" id="res_b" class="form-control">
						</div>
					</div>
				</div>
			</fieldset>
			<div>
				<button type="button" name="aceptar" value="ACEPTAR" class="btn-primary btn" onclick="">ACEPTAR</button>
				<button type="button" id="salir" class="btn btn-primary">SALIR</button>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		function muestra(ObjetoTR){
			var nombre = ObjetoTR.cells[0].childNodes[0].nodeValue;
			var apellidoPat = ObjetoTR.cells[1].childNodes[0].nodeValue;
			var apellidoMat = ObjetoTR.cells[2].childNodes[0].nodeValue;
			ObjetoTR.style.color = "#4d4dff";
			//ObjetoTR.style.setProperty('background-color','#4d4dff','');

			document.getElementById("res_b").value = nombre + " " + apellidoPat + " " + apellidoMat;
			//window.location.href = 'http://localhost/Modificacion%20nombramiento%20docente/busqueda_docente_formulario_seguimiento.php?nom'+nombre+'apeP='+apellidoPat+'apeM='+apellidoMat;
		}

		function buscar(){ 

			var crit = document.getElementById("cr").value;

			if (crit == null || crit.length == 0 || /^\s+$/.test(crit) || !isNaN(crit)) {
				alert("ERROR DE ESCRITURA");
				//return false;
			} else {
				radiobutton_opciones = document.getElementsByName("nameRadios");
				var seleccionado = false;

				for (var i = 0; i < radiobutton_opciones.length; i++) {
											
					if (radiobutton_opciones[i].checked) {
						seleccionado = true;				
						break;
					}
				}

				if (!seleccionado) {
					alert("SELECCIONE NOMBRE O APELLIDO");
					//return false;

				} else {
					//alert("bien");
					window.location.href = 'busqueda_docente_formulario_seguimiento.php?criterio='+crit+'&nomAp='+i;
				}
			}
		}		
	</script>
</body>
</html>