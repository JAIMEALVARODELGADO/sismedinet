<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SIS-MEDinet</title>
    <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
    <?php require_once "scripts.php";?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Manual de Usuario - SIS-MEDinet</h4>
                    </div>
					<div class="accordion" id="accordionManual">
					  <div class="card">
					    <div class="card-header" id="headingGeneralidades">
					      <h5 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Generalidades
					        </button>
					      </h5>
					    </div>

					    <div id="collapseOne" class="collapse" aria-labelledby="headingGeneralidades" data-parent="#accordionManual">
					      <div class="card-body">
					      	En la parte superior, siempre esta visibe el menú por el cual puede navegar (de acuerdo al perfil del usuario). El botón Inicio lo lleva siempre a la pantalla inicial, el Botón Ayuda, le permite visualizar las características de la aplicación, y este manual. El botón Salir, cierra la sesion para terminar el trabajo.
					      	<br><br>Durante la ejecución de la aplicación se muestran ventanas de confirmación de las acciones a realizar y mensajes emergentes del estado de la acción, en color verde, cuando la accion se ejecuta con éxito o de color rojo, cuando no se pudo ejecutar.
					      	<br>La aplicación contiene varios tipos de botones así:
					      	<br><button type="button" class="btn btn-primary">Primario <span class="fas fa-angle-double-left"></span></button>Botón primario: De color azul, Generalmente utilizado para guardar información.
					      	<br><button type="button" class="btn btn-success">Suceso <span class="fas fa-angle-double-left"></span></button>Botón suceso: De color verde, Generalmente utilizado para ejecutar acciones importantes.
					      	<br><button type="button" class="btn btn-warning">Cuidado <span class="fas fa-angle-double-left"></span></button>Botón cuidado: De color amarillo, Generalmente utilizado para ejecutar acciones importantes, que puden alterar la información.
					      	<br><button type="button" class="btn btn-danger">Peligro <span class="fas fa-angle-double-left"></span></button>Botón peligro: De color rojo, Generalmente utilizado para ejecutar acciones irreversibles (como borrar información, etc).
					      	<br><button type="button" class="btn btn-secondary">Secundario <span class="fas fa-angle-double-left"></span></button>Botón secundario: De color gris, el accionar de este botón no implica acciones importantes. En algunos casos indica que la acción no está permitida y no realiza ninguna acción.

					      	<br><br>En toda la aplicación se muestran tablas con la información acorde con la opción seleccionada. Varias de estas tablas (por la cantidad de información), contienen un cuadro de texto llamado Search: que le permite filtrar información más puntual. Tambien tiene un cuadro de selección Show entries, que le permite seleccionar el numero de registros a visualizar por página. Finalmente, en el título de cada columna se muestran una flecha hacia arriba y otra hacia abajo, que le indican que se puede ordenar la información por esta columna.

					      	<br><br>Existen campos autocomplete (donde se solicita información de medicamentos, CUMS, IUMS), donde a medida que se digita la información se despliega un listado de la información que cumple con las condiciones digitadas. Para seleccionar al opcion correcta, debe ubicarse con el puntero del mouse u hacer click en la opcion deseada.

					      	<br><br>Los campos de fecha, se pueden seleccionar del calendario o digitar directamente en el formato <b>dd/mm/aaaa</b>

					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingProceso">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Proceso
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse show" aria-labelledby="headingProceso" data-parent="#accordionManual">
					      <div class="card-body">
					      	El proceso normal para el funcionamiento de la aplicación implica:
					        <br>1.- Registrar la entidad: Con toda la información necesaria para el reporte a SISMED
					        <br>2.- Crear el periodo a reportar (Administración/Periodo de Reporte): Donde se define el rango de fechas del trimestre a reportar y su estado. Esto se debe hacer cada vez, antes de iniciar la digitacion de la información de un nuevo trimestre.
					        <br>3.- Generar Informes: Se puede generar reportes de la información digitada en cualquier momento, durante o posterior al reporte a SISMED.
					        <br>4.- Generar archivo para SISMED: Lo puede realizar en cualquier momento con el fin de hacer pruebas. Al finalizar el trimestre lo debe generar para realizar el reporte definitivo.
					        <br>5.- Posterior al reporte de cada trimestre, se debe crear el nuevo periódo a reportar. En este momento la herramienta genera una cuenta de cobro correspondiente (correspondiente al 1% del valor total reportado en el trimestre inmediatamente anterior), suma que deberá ser consignada y reportada a SISMEDinet, con el fin de activar el nuevo periódo a reportar.
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingAdmision">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          Registro
					        </button>
					      </h5>
					    </div>
					    <div id="collapseThree" class="collapse" aria-labelledby="headingAdmision" data-parent="#accordionManual">
					      <div class="card-body">
					      	<b><h5>Captura de Medicamentos</h5></b>
					        <br>Presenta una tabla con la información digitada, en las siguientes columnas:
					        <br>Factura
					        <br>Fecha
					        <br>Operación
					        <br>Transacción
					        <br>IUM Niv 1 : Al ubicar el puntero del mouse sobre este, se muestra el nombre del medicamento.
					        <br>IUM Niv 2
					        <br>IUM Niv 3
					        <br>Expediente : Al ubicar el puntero del mouse sobre este, se muestra el nombre del medicamento.
					        <br>Consecutivo
					        <br>Unidad
					        <br>Cantidad
					        <br>Valor Unitario
					        <br>Total
					        <br><br>Adicionalmete muestra un botón para editar la información del registro (En caso de errores en el registro) y otro botón para borrar el registro.
					        <br><br>En la parte superior se encuentra el botón nuevo, que le permite el ingreso de un nuevo registro. Solicita la siguiente información:
					        <br>Número de Factura
					        <br>Fecha de la factura
					        <br>Tipo de Operación
					        <br>Tipo de Transacción
					        <br>Medicamento según IUM: Contiene una lista desplegable de acuerdo a la información del medicamento que se ingrese, si selecciona un medicamento de esta lista, automáticamente se llenan los campos IUM de Primer Nivel, IUM de Segundo Nivel, IUM de Tercer Nivel. <b>Importante: </b>Si el IUM no existe en el listado, no significa que el IUM no exista en la clasificación, ya que esta lista se actualiza una vez al mes y puede ser que el  medicamento ya tenga una clasificación IUM. En el caso que exista el IUM y no se encuentre en la lista que se desplega, se debe completar los codigos de primero, segundo y tercer nivel de forma manual.
					        <br>Medicamento según CUM: Contiene una lista desplegable de acuerdo a la información del medicamento que se ingrese, si selecciona un medicamento de esta lista, automáticamente se llenan los campos Expediente y Consecutivo. <b>Importante: </b>Si el CUM no existe en el listado, no significa que el CUM no exista en la clasificación, ya que esta lista se actualiza una vez al mes y puede ser que el  medicamento ya tenga una clasificación CUM. En el caso que exista el CUM y no se encuentre en la lista que se desplega, se debe completar los campos expediente y consecutivo de forma manual.
					        <br>Unidad en la que se factura
					        <br>Cantidad
					        <br>Valor unitario.
					        <br><br>Cuando guarda el registro, valida que la fecha registrada se encuentre dentro del trimestre a reportar

					        <br><br><b><h5>Generación de Archivo SISMED</h5></b>
					        <br>Esta opción genera automáticamente el archivo plano de acuerdo a la circular 006 de 2018.
					        <br>En la parte superior de la pantalla muestra la información del trimestre que se está generando el reporte y en la parte inferior muestra un botón azul <button type="button" class="btn btn-primary">MED100MPREAAAAMMDDxxyyyyyyyyyyyy <span class="fas fa-angle-double-left"></span></button> con las características del nombre del archivo. Este botón permite la descarga del archivo generado con el mismo nombre del botón en formato CSV. Este archivo lo debe editar con cualquier editor de texto (preferiblemente block de notas), quitarle el espacio que genera al final del mismo y guardarlo con la extensión .TXT (Como los pide la circular).  
					        <br>El archivo queda listo para ser validado en la plataforma PISIS.
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingInformes">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
					          Informes
					        </button>
					      </h5>
					    </div>
					    <div id="collapseNine" class="collapse" aria-labelledby="headingInformes" data-parent="#accordionManual">
					      <div class="card-body">
					      	Permite la generación del infome:
					      	<br>Registro de Medicamentos
					      	<br><br>El informe solicita unos parámetros(filtros) para la generación del mismos, los parámetros de fechas, son el rango entre los cuales desea generar el informe.
					      	<br><br>También muestra el listado de campos que puede incluir en el informe. Se muestran marcados, en una caja de chequeo, algunos campos por defecto pero esta se puede cambiar.
					      	<br>Posteriormente solicita la el campo por el cual desea que se muestre ordenado el informe.
					      	<br>El botón buscar, realiza la busqueda de la información que cumpla con estos parámetros.
					      	<br>El botón Imprimir permite la impresión de la información generada.

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingAdministracion">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
					          Administración
					        </button>
					      </h5>
					    </div>
					    <div id="collapseEight" class="collapse" aria-labelledby="headingAdministracion" data-parent="#accordionManual">
					      <div class="card-body">
					      	Permite la gestión de la infomación de la entidad y los periodos de reporte.
					      	<br><br><h5><b>Información de la Entidad</b></h5>
					      	<br>Permite la gestión de la información básica de la entidad, requerida para la generación del archivo plano
					      	

					      	<br><br><h5><b>Peroiodo de Reporte</b></h5>
					      	<br>Permite la gestión de la información del trimestre a registrar y posterior reporte
					      	

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingHerramientas">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
					          Herramientas
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTen" class="collapse" aria-labelledby="headingHerramientas" data-parent="#accordionManual">
					      <div class="card-body">
					      	Esta opción está disponible unicamente para el administrador del sistema, donde le permite generar las consultas que requiere el aplicativo para su funcionamento.

					      </div>
					    </div>
					  </div>

					</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
