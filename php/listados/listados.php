<?php
  session_start();
  require_once('../../class/classBase/DBModelo.class.php');
  require_once('../../class/classBase/Funciones.class.php');
  require_once('../../class/classBase/Consultas.class.php');
  require_once('../../class/Audio.class.php');
  require_once('../../class/Audiovisual.class.php');
  require_once('../../class/Proyecto.class.php');
  require_once('../../configuracion/parametros.conf.php');


  $conexion = new DBModelo($parametros['conexion']);
  $conexion->abrir_conexion();

  $funcion = new Funciones();
  $consulta = new Consultas();


  $result = array();
  $cont_result = array('audios'=>0, 'audiovisuales'=>0, 'proyectos'=>0);

  $q = ( isset($_POST['q']) ) ? $_POST['q'] : null;

  print_r($_SESSION['lim_inf']);

  if (!isset($_SESSION['lim_inf'])) {
    $_SESSION['lim_inf']=0;
  }
  if (isset($_GET['lim_inf'])) {
    $_SESSION['lim_inf'] = $_GET['lim_inf'];
  }


  if(isset($_GET['recurso'])){
     $result[ $_GET['recurso'] ] = $conexion->query( $consulta->get_all( $_GET['recurso'], $q ) );
     $cont_result[ $_GET['recurso'] ] = count( $result[ $_GET['recurso'] ] );
  }else if (isset($_POST['tablas']) ) {

    foreach ($_POST['tablas'] as $tabla) {
      //switch para condicion de consulta por item

      if ($tabla != ''){
        if ( isset($_POST['r_audio']) or isset($_POST['r_audiovisual']) or isset($_POST['r_proyecto'])) {

            if ($tabla=='audios'){
              $campo =  $_POST['r_audio'];
            }
            else if ($tabla=='audiovisuales'){
              $campo = $_POST['r_audiovisual'];
            }
            else if ($tabla == 'proyectos') {
              $campo = $_POST['proyecto'];
            }

            $result[$tabla] = $conexion->query( $consulta->get_for_fied($tabla, $campo, $_POST['q']) );
        }else{
            $result[$tabla] = $conexion->query( $consulta->get_all( $tabla, $q ) );
        }
        $cont_result[$tabla]= count( $result[$tabla] );

      }

    }
  }else{

        $audios = new Audio('audios', $conexion);
        $result['audios'] = $conexion->query( $consulta->get_all_for_q($audios, $q) );

        $audiovisuales = new Audiovisual('audiovisuales', $conexion);
        $result['audiovisuales'] = $conexion->query( $consulta->get_all_for_q($audiovisuales, $q) );


        $proyectos = new Proyecto('proyectos', $conexion);
        $result['proyectos'] = $conexion->query( $consulta->get_all_for_q($proyectos, $q) );

  }

  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        {
          .border-radius(0) !important;
        }

        #field {
            margin-bottom:20px;
        }
        .popover {
          max-width: 100%;
          width: auto;
        }

    </style>
     <!-- jQuery -->

  </head>

  <body>
  <input id="server" type="hidden" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="../../">Inicio</a></li>
            <li role="presentation" class="active"><a href="#">Búsquedas</a></li>
            <li role="presentation"><a href="#">Perfil</a></li>
            <li role="presentation"><a href="#">Cerrar sesión</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Campus RTV</h3>
      </div>

      <div name="result">
        <form action="listados.php" method="post" name="fm_buscar" id="fm_buscar">
          <div class="panel panel-primary">
            <div class="panel-heading">Búsqueda de recursos</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-4">
                  <h4>
                    <input type="checkbox" id="audios" name="tablas[]" value="audios" /> Audios
                    <span id="t_audios" class="badge">0</span>
                  </h4>
                </div>

                <div class="col-lg-4">
                  <h4>
                    <input type="checkbox" id="audiovisual" name="tablas[]" value="audiovisuales" /> Audiovisuales
                    <span id="t_audiovisuales" class="badge">0</span>
                  </h4>
                </div>
                <div class="col-lg-4">
                  <h4>
                    <input type="checkbox" id="proyectos" name="tablas[]" value="proyectos" /> Proyectos
                    <span id="t_proyectos" class="badge">0</span>
                  </h4>
                </div>
              </div>
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Más criterios de búsquedas
                          </a>
                        </h4>
                      </div>

                      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                             <div class="row">
                                <div class="col-lg-4"
                                  <br><b>Audios</b>
                                  <br><input type="radio" name="r_audio" value="nombre"> Nombre
                                  <br><input type="radio" name="r_audio" value="formato"> Formato
                                  <br><input type="radio" name="r_audio" value="tematica"> Temática
                                  <br><input type="radio" name="r_audio" value="duracion"> Duracion
                                  <br><input type="radio" name="r_audio" value="genero"> Género
                                  <br><input type="radio" name="r_audio" value="presentacion"> Presentación
                                </div>
                                <div class="col-lg-4">
                                  <br><b>Audiovisuales</b>
                                  <br><input type="radio" name="r_audiovisual" value="nombre"> Nombre
                                  <br><input type="radio" name="r_audiovisual" value="formato"> Formato
                                  <br><input type="radio" name="r_audiovisual" value="genero"> Género
                                  <br><input type="radio" name="r_audiovisual" value="linea"> Línea
                                  <br><input type="radio" name="r_audiovisual" value="presentacion"> Presentación
                                </div>
                                <div class="col-lg-4">
                                  <br><b>Proyectos</b>
                                  <br><input type="radio" name="r_proyecto" value="nombre"> Nombre
                                  <br><input type="radio" name="r_proyecto" value="tipo_investigacion"> Tipo de investigación
                                  <br><input type="radio" name="r_proyecto" value="tipo_estudio"> Tipo de estudio
                                  <br><input type="radio" name="r_proyecto" value="contexto"> Contexto
                                  <br><input type="radio" name="r_proyecto" value="beneficiario"> Beneficiario
                                  <br><input type="radio" name="r_proyecto" value="producto_final"> Producto final
                                  <br><input type="radio" name="r_proyecto" value="tematica"> Temática
                                  <br><input type="radio" name="r_proyecto" value="bases_teoricas"> Bases teóricas
                                  <br><input type="radio" name="r_proyecto" value="linea_investiacion"> Línea de investigación
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Escriba la palabra relacionada a su búsqueda">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Buscar</button>
                  </span>
                </div>
                <br/>
                <div id="ayuda" class="ayuda"
                  data-toggle="pop_ayuda"
                  data-placement="button"
                  title="Como realizar una búsqueda"
                  data-content="
                  <p>Las búsquedas se pueden realizar de varias maneras</p>
                    <ul>
                      <li>Solo escribiendo en la casilla de búsqueda la palabra relacionada con el recurso que se desea encontrar</li>
                      <li>Seleccionando en que tipo de recurso se desea buscar, se pueden seleccinar los tres</li>
                      <li>Seleccionando que tipo de criterio se debe tener en cuenta se puede seleccionar un criterio por recurso</li>
                    </ul>
                    <p>Se puecen hacer combinaciones entre estas tres opciones</p>
                    <iframe width='420' height='315' src='https://www.youtube.com/embed/GTHehAs5MQY' frameborder='0' allowfullscreen></iframe>
                    <br><a href='https://www.youtube.com/watch?v=GTHehAs5MQY&feature=youtu.be' target='new'>Ver mas...</a>
                  ">
                  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ayuda
                </div>
        </form>

                <ul class="media-list">
                  <?php

                    if ( !empty($result) ) {
                        foreach ($result as $recurso => $resultado) {

                            switch ($recurso) {
                              case 'audios':
                                  echo "<h3>Audios <br/><small>Total audios encontrados: ".$cont_result['audios']."</small></h3><hr>";
                                  if( !empty($resultado) ){
                                    foreach ($resultado as $audio) {
                                       echo "<li class='media'>
                                              <div class='media-left'>
                                                <a class='open-Modal' href='#' recurso='".$recurso."' id='".$audio['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'><i class='fa fa-file-audio-o fa-5x'></i></a>
                                              </div>
                                              <div class='media-body'>
                                                <h4>".$audio['nombre']."</h4>
                                                <h5><span class='label label-default'>".$audio['formato']."</span>
                                                 <a class='open-Modal' href='#' recurso='".$recurso."' id='".$audio['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'> "
                                                  .$funcion->trunk_link( $audio['ruta'], 30).
                                                  "</a> </h5>
                                                <h6>Palabras claves: ".$funcion->get_tag_link( $funcion->get_tag( $audio['tag'] ) ) ."</h6>
                                              </div>
                                            </li>";
                                       }
                                    } else {
                                      echo "<h2> <small><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span>No se encontraron resultados para esta búsqueda</small></h2>";
                                  }
                              break;
                              case 'audiovisuales':
                                    echo "<h3>Audiovisuales <small><br>Total audiovisuales encontrados: ".$cont_result['audiovisuales']."</small></h3><hr>";
                                     if( !empty($resultado) ){
                                      foreach ($resultado as $audiovisuales) {
                                         echo "<li class='media'>
                                                <div class='media-left'>
                                                  <a class='open-Modal' href='#' recurso='".$recurso."' id='".$audiovisuales['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'><i class='fa fa-file-video-o fa-5x'></i></a>
                                                </div>
                                                <div class='media-body'>".
                                                  "<h4>".$audiovisuales['nombre']."</h4>".
                                                  "<h5><span class='label label-default'>".$audiovisuales['formato']."</span>
                                                  <a class='open-Modal' href='#' recurso='".$recurso."' id='".$audiovisuales['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap' target='new'> ".
                                                  $funcion->trunk_link( $audiovisuales['ruta'], 30).
                                                  "</a> </h5>
                                                  <h6>Palabras claves: ".$funcion->get_tag_link( $funcion->get_tag( $audiovisuales['tag'] ) ) ."</h6>

                                                </div>

                                              </li>";
                                      }
                                    } else {
                                      echo "<h2><small><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> No se encontraron resultados para esta búsqueda</small></h2>";
                                  }
                                break;

                                case 'proyectos':
                                    echo "<h3>Proyectos <small><br>Total proyectos encontrados: ".$cont_result['proyectos']."</small></h3><hr>";
                                    if( !empty($resultado) ){
                                      foreach ($resultado as $proyectos) {
                                          echo "<li class='media'>
                                                <div class='media-left'>
                                                  <a class='open-Modal' href='#' recurso='".$recurso."' id='".$proyectos['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap'><i class='fa fa-file-archive-o fa-5x'></i></a>
                                                </div>
                                                <div class='media-body'>".
                                                "<h4>".$proyectos['nombre']."</h4>".
                                                  "<h5><span class='label label-default'>".$proyectos['producto_final']."</span><a class='open-Modal' href='#' recurso='".$recurso."' id='".$proyectos['id']."' data-toggle='modal' data-target='#exampleModal' data-whatever='@getbootstrap' target='new'> ".
                                                  $funcion->trunk_link( $proyectos['ruta'], 30).
                                                  "</a> </h5>
                                                  <h6>Palabras claves: ".$funcion->get_tag_link( $funcion->get_tag( $proyectos['tag'] ) ) ."</h6>
                                                </div>
                                              </li>";
                                      }
                                  } else {
                                      echo "<h2><small><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> No se encontraron resultados para esta búsqueda</small></h2>";
                                  }
                                break;
                                case 'mensaje':
                                   print_r($result['mensaje']);
                                  break;

                            }
                          }
                    } else {
                        echo "<h2><small><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> No se encontraron resultados para esta búsqueda</small></h2>";
                    }

                  ?>
                </ul>
                <nav>
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="active"><a href="#">1</a></li>
                      <li class="disabled"><a href="#">2</a></li>
                      <li class="disabled"><a href="#">3</a></li>
                      <li class="disabled"><a href="#">4</a></li>
                      <li class="disabled"><a href="#">5</a></li>
                      <li>
                        <a href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
            </div>

            <div class="panel-footer">

            </div>
          </div>

      </div>

      <a href="#" class="open-Modal" recurso="audios" id="1" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Mensaje</a>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Previsualización</h4>
            </div>
            <div class="modal-body">
              <div id="preview_audio">
                  <h3>Audio</h3>
                    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
                    <script type="text/javascript" src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
                    <script type='text/javascript' src="http://stratus.sc/stratus.js"></script>
                    <div id="audio_preview"></div>
                    <div id="d_formato"></div>
                    <div id="d_tematica"></div>
                    <div id="d_duracion"></div>
                    <div id="d_genero"></div>
                    <div id="d_presentacion"></div>
                    <div id="d_ruta"></div>
                    <div id="d_tag"></div>
                  <!-- Simple audio playback -->
                  <!-- https://soundcloud.com/campus-rtv/fragmento-cien-anos-de-soledad -->
                  <!--iframe width="100%" height="450" scrolling="no" frameborder="no"
                  src="https://soundcloud.com/campus-rtv/fragmento-cien-anos-de-soledad"--></iframe>
              </div>
              <div id="preview_audiovisual">
                  <h3>Audiovisual</h3>
                    <div id="audiovisual_preview" style="height:400px; width:100%"></div>
                    <div id="d_nombre"></div>
                    <div id="d_formato"></div>
                    <div id="d_genero"></div>
                    <div id="d_linea"></div>
                    <div id="d_presentacion"></div>
                    <div id="d_ruta"></div>
                    <div id="d_tag"></div>
              </div>
              <div id="preview_proyecto">
                  <h3>Proyectos</h3>
                    <div id="proyecto_preview"></div>
                    <div id="d_nombre"></div>
                    <div id="d_tipo_investigacion"></div>
                    <div id="d_tipo_estudio"></div>
                    <div id="d_contexto"></div>
                    <div id="d_beneficiario"></div>
                    <div id="d_producto_final"></div>
                    <div id="d_tematica"></div>
                    <div id="d_bases_teoricas"></div>
                    <div id="d_linea_investigacion"></div>
                    <div id="d_ruta"></div>
                    <div id="d_tag"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>



      <footer class="footer">
        <p>&copy; Campus RTV 2015</p>
      </footer>

    </div>
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
