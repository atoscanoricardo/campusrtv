<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestión</title>
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="../../css/jumbotron-narrow.css" rel="stylesheet"/>

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="../../css/jquery.fileupload.css">
    <style type="text/css">
        {
          .border-radius(0) !important;
        }

        #field {
            margin-bottom:20px;
        }
    </style>

  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="../../">Inicio</a></li>
            <li role="presentation"><a href="#">Perfil</a></li>
            <li role="presentation"><a href="#">Cerrar sesión</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Campus RTV</h3>
      </div>

      <div id="dv_formularios">
        <ul class="nav nav-tabs" id="nav_tabs">
          <li role="presentation" class="active" id="tab_1">
            <a href="#">Audios</a>
          </li>
          <li role="presentation" class="inactive" id="tab_2">
            <a href="#">Audiovisuales</a>
          </li>
          <li role="presentation" class="inactive" id="tab_3">
            <a href="#">Proyectos</a>
          </li>
          <li role="presentation" class="inactive" id="tab_4">
            <a href="#">Imagenes</a>
          </li>
        </ul>

        <br/>
        <div id="guardado_exitoso" class="alert alert-success" role="alert" style='display:hide;'>¡Guardado con exito!</div>
        <div id="guardado_error" class="alert alert-warning" role="alert"  style='display:hide;'>¡Complete el formulario!</div>

        <!-- inicio de formulario de audios -->
        <div id="form_audios" class="dv_form">
          <h5><a href="../listados/listados.php?recurso=audios&q=all">Listado de audios</a></h5><hr>
          <form id="fm_audio">
            <input type="hidden" name="t_archivo" value="audio"/>
            <label class="sr-only">Nombre</label>
            <br><input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            <label class="sr-only">Formato</label>
            <br><select class="form-control" name="formato" required>
                  <option value='' disabled selected style='display:none;'>Selecciona un formato</option>
                  <option value="mp3">MP3</option>
                  <option value="wav">WAV</option>
                  <option value="cda">CDA</option>
                </select>
            <label class="sr-only">Temática</label>
            <br><input type="text" class="form-control" name="tematica" placeholder="Temática" required>
            <label class="sr-only">Duracion</label>
            <br><input type="text" class="form-control" name="duracion" placeholder="Duración (HH:MM:SS)" required>
            <label class="sr-only">Género</label>
            <br><select class="form-control" name="genero"  required>
                  <option value='' disabled selected style='display:none;'>Selecciona un género</option>
                  <option value="periodistico">Periodístico</option>
                  <option value="dramatico">Dramático</option>
                  <option value="magazine">Magazine</option>
                  <option value="publicidad">Publicidad</option>
                </select>

            <label class="sr-only">Presentacion</label>
            <br><input type="text" class="form-control" name="presentacion" placeholder="Presentación" required>
            <label class="sr-only">Ruta del archivo</label>
            <br><input type="text" class="form-control" id="ruta" name="ruta" placeholder="Ruta del archivo" required>
            <label class="sr-only">Palabras claves</label>
            <br><input type="text" class="form-control" name="tag" placeholder="Palbras claves (separe con comas)" required>
            <br>
            <!-- Autores -->
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">
                <div class="input-group">
                  <input id="autor_audio" class="form-control" type="text" placeholder="Escriba el nombre del autor"/>
                  <span class="input-group-btn">
                    <button id='btAddAutorAudio' class="btn btn-default" type="button">Agregar</button>
                  </span>
                </div>
              </div>

              <div id="dv_autores_audio" class="panel-body">
                <!-- para clonar -->
                <div class="input-group" id="bi_autor">
                  <span class="input-group-addon">
                    <input id="ch_autor_clon" type="checkbox" name="if_check_clon[]">
                  </span>
                  <input id="autor_clon" type="text" class="form-control" name="autores_clon[]">
                </div>
                <!-- fin -->
              </div>
            </div>

            <br>
          </form>
          <button class="btn btn-primary" id="bt_g_audio">Guardar</button>
        </div>
        <!-- fin de formulario de audios -->

        <!-- inicio de formulario de audiovisuales -->
        <div id="form_audiovisuales" class="dv_form">
          <h5><a href="../listados/listados.php?recurso=audiovisuales&q=all">Listado de audiovisuales</a></h5><hr>
          <form id="fm_audiovisual">
            <input type="hidden" name="t_archivo" value="audiovisual"/>
            <label class="sr-only">Nombre</label>
            <br><input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            <label class="sr-only">Formato</label>
            <br><select class="form-control" name="formato" required>
                  <option value='' disabled selected style='display:none;'>Selecciona un formato</option>
                  <option value="mov">MOV</option>
                  <option value="mp4">MP4</option>
                  <option value="avi">AVI</option>
                  <option value="vob">VOB</option>
                </select>
            <label class="sr-only">Género</label>
            <br><select class="form-control" name="genero"  required>
                  <option value='' disabled selected style='display:none;'>Selecciona un género</option>
                  <option value="periodistico">Periodístico</option>
                  <option value="dramatico">Dramático</option>
                  <option value="magazine">Magazine</option>
                  <option value="publicidad">Publicidad</option>
                </select>
            <label class="sr-only">Línea</label>
            <br><input type="text" class="form-control" name="linea" placeholder="Linea" required>
            <label class="sr-only">Temática</label>
            <br><input type="text" class="form-control" name="tematica" placeholder="Temática" required>
            <label class="sr-only">Presentacion</label>
            <br><input type="text" class="form-control" name="presentacion" placeholder="Presentación" required>
            <label class="sr-only">Ruta del archivo</label>
            <br><input type="text" class="form-control" id="ruta" name="ruta" placeholder="Ruta del archivo" required>
            <label class="sr-only">Palabras claves</label>
            <br><input type="text" class="form-control" name="tag" placeholder="Palabras clave" required>
            <br>
            <!-- Autores -->
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">
                <div class="input-group">
                  <input id="autor_audiovisual" class="form-control" type="text" placeholder="Escriba el nombre del autor"/>
                  <span class="input-group-btn">
                    <button id='btAddAutorAudiovisual' class="btn btn-default" type="button">Agregar</button>
                  </span>
                </div>
              </div>

              <div id="dv_autores_audiovisual" class="panel-body">
              </div>
            </div>

            <br>
          </form>
          <button class="btn btn-primary" id="bt_g_audiovisual">Guardar</button>
        </div>
        <!-- fin de formulario de audiovisuales -->

        <!-- inicio de formulario de proyectos -->
        <div id="form_proyectos" class="dv_form">
          <h5><a href="../listados/listados.php?recurso=proyectos&q=all">Listado de proyectos</a></h5><hr>
          <form id="fm_proyecto">
            <input type="hidden" name="t_archivo" value="proyecto"/>
            <label class="sr-only">Nombre</label>
            <br><input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            <label class="sr-only">Tipo de investigación</label>
            <br><select class="form-control" name="tipo_investigacion" required>
                  <option value='' disabled selected style='display:none;'>Selecciona un tipo de investigación</option>
                  <option value="cualitativa">Cualitativa</option>
                  <option value="aplicada">Aplicada</option>
                  <option value="basica">Básica</option>
                  <option value="otras">Otras</option>
                </select>
            <label class="sr-only">Tipo de estudio</label>
            <br><select class="form-control" name="tipo_estudio" required>
                  <option value='' disabled selected style='display:none;'>Selecciona un tipo de estudio</option>
                  <option value="descriptivo">Descriptivo</option>
                  <option value="propositivo">Propositivo</option>
                  <option value="exploratorio">Exploratorio</option>
                  <option value="otro">Otro</option>
                </select>
            <label class="sr-only">Contexto</label>
            <br><input type="text" class="form-control" name="contexto" placeholder="contexto" required>
            <label class="sr-only">Beneficiario</label>
            <br><input type="text" class="form-control" name="beneficiario" placeholder="Beneficiario" required>
            <label class="sr-only">Producto final</label>
            <br><input type="text" class="form-control" name="producto_final" placeholder="Producto final" required>
            <label class="sr-only">Tematica</label>
            <br><input type="text" class="form-control" name="Tematica" placeholder="temática" required>
            <label class="sr-only">Bases teóricas</label>
            <br><input type="text" class="form-control" name="bases_teoricas" placeholder="Bases teóricas" required>
            <label class="sr-only">Linea de investigación</label>
            <br><input type="text" class="form-control" name="linea_investigacion" placeholder="Linea de investigación" required>
            <label class="sr-only">Ruta del archivo</label>
            <br><input type="text" class="form-control" id="ruta" name="ruta" placeholder="Ruta del archivo" required>
            <label class="sr-only">Palabras claves</label>
            <br><input type="text" class="form-control" name="tag" placeholder="Palabras claves" required>
            <br>
            <!-- Autores -->
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">
                <div class="input-group">
                  <input id="autor_proyecto" class="form-control" type="text" placeholder="Escriba el nombre del autor"/>
                  <span class="input-group-btn">
                    <button id='btAddAutorProyecto' class="btn btn-default" type="button">Agregar</button>
                  </span>
                </div>
              </div>

              <div id="dv_autores_proyecto" class="panel-body">
              </div>
            </div>
            <br>
          </form>
          <button class="btn btn-primary" id="bt_g_proyecto">Guardar</button>
        </div>
        <!-- fin de formulario de proyectos -->
        <!-- inicio de formulario de imagenes -->
        <div id="form_imagenes" class="dv_form">
          <?php
              require_once("../imagenes.php");
          ?>

        </div>
        <!-- fin de formulario de imagenes -->
        <br/>
      </div>


      <footer class="footer">
        <p>&copy; Campus RTV 2015</p>
      </footer>

    </div>
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>
    <!-- Ventana modal -->
    <script src="../../js/bootstrap-modal.js"></script>
    <!-- Aplicacion -->
    <script src="../../js/main.js"></script>
    <!-- Formularios -->
    <script src="../../js/forms.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="../../js/vendor/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="../../js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="../../js/jquery.fileupload.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap3-typeahead.min.js"></script>


    <!-- validaciones -->
    <script src="../../js/jquery.validate.min.js"></script>
    <script src="../../js/messages_es_AR.min.js"></script>



  </body>
</html>
