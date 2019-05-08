<?php

    require_once('class/classBase/DBModelo.class.php');
    require_once('configuracion/parametros.conf.php');
    require_once('class/classBase/Consultas.class.php');

    require_once('class/classBase/Funciones.class.php');
    require_once('class/Imagen.class.php');

    $conexion = new DBModelo($parametros['conexion']);
    $conexion->abrir_conexion();

    $funciones = new Funciones();

    $consulta = new Consultas();

    $imagen = new Imagen('imagenes', $conexion);

    $audios = $conexion->query( $consulta->get_first(10, "audios") );
    $cant_audio = count($audios);

    $audiovisuales = $conexion->query( $consulta->get_first(10, "audiovisuales") );
    $cant_audiovisual = count($audiovisuales);

    $proyectos = $conexion->query( $consulta->get_first(10, "proyectos") );
    $cant_proyecto = count($proyectos);


    $arr_imagenes = $imagen->get(array("*"),'visible=true', 'ORDER BY id DESC');
    $capa='';
    $li_data='';
    $cont = 2;
    foreach ($arr_imagenes as $value) {
         $li_data.= '<li data-target="#carousel-example-generic" data-slide-to="'.$cont.'" class=""></li>';
         $capa.= '<div class="item">'.
                '<img src="img/carrusel/'.$value['ruta'].'" alt="'.$value['ruta'].'">'.
                    '<div class="carousel-caption">'.
                        '<h3></h3>'.
                        '<p></p>'.
                    '</div>'.
            '</div>';
        $cont++;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Campus RTV</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/font1.css" rel="stylesheet" type="text/css">
    <link href="css/font2.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">
                    <img src="img/logo.png">
                    Campus RTV
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#archivos">Archivos</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#busquedas">Búsquedas</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#noticias">Noticias</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#quienesomos">Quiénes somos</a>
                    </li>
                    <li class="page-scroll">
                        <a href="php/forms/gestion.php">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                      <div class="col-xs-12 col-md-12 col-centered">
                        <div class="row">
                          <div class="col-xs-2 col-md-2 col-centered"></div>
                          <div class="col-xs-8 col-md-8 col-centered">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <!-- Indicators -->
                              <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                <?php echo $li_data; ?>
                              </ol>

                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                  <img src="img/carrusel/img_1.png" alt="Uniautonoma">
                                  <div class="carousel-caption">
                                    <h3></h3>
                                    <p></p>
                                  </div>
                                </div>
                                <?php echo $capa; ?>
                              </div>

                              <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <div class="col-xs-2 col-md-2 col-centered"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="intro-text">
                        <span class="name">Campus RTV</span>
                        <span class="skills">Plataforma de recursos digitales</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Archivos -->
    <section id="archivos">


        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Archivos</h2>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="php/listados/listados.php?recurso=audios" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-music fa-3x"></i> <h6><?php echo $cant_audio ?> Audios en total</h6>
                            </div>
                        </div>
                    </a>
                    <?php print_r( $funciones->report_resource( $audios ) ); ?>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="php/listados/listados.php?recurso=audiovisuales" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-video-camera fa-3x"></i> <h6><?php echo $cant_audiovisual ?> Audiovisuales en total</h6>
                            </div>
                        </div>
                    </a>
                     <?php print_r( $funciones->report_resource( $audiovisuales ) ); ?>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="php/listados/listados.php?recurso=proyectos" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-file fa-3x"></i> <h6><?php echo $cant_proyecto ?> Proyectos en total</h6>
                            </div>
                        </div>
                    </a>
                    <?php print_r( $funciones->report_resource( $proyectos ) ); ?>
                </div>

            </div>
        </div>
    </section>
    <!-- foro -->
    <section id="busquedas">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><a href="php/listados/listados.php">Búsquedas</a> </h2>
                </div>
            </div><br/>
            <form action="php/listados/listados.php" method="post" name="fm_buscar" id="fm_buscar">
                <div class="row">
                  <div class="col-lg-12">
                      <h4>
                        <input type="checkbox" id="audios" name="tablas[]" value="audios" /> Audio
                        <input type="checkbox" id="audiovisual" name="tablas[]" value="audiovisuales" /> Audiovisuales
                        <input type="checkbox" id="proyectos" name="tablas[]" value="proyectos" /> Proyectos <br />
                      </h4>
                    <input type="hidden" name="seleccion" id="seleccion">
                    <div class="input-group">
                      <input name="q" type="text" class="form-control" aria-label="..." placeholder="Escriba aquí su criterio de búsqueda">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Buscar<span class="caret"></span></button>
                        <ul id="q_option_index" class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#" data-value="4">Palabras claves</a></li>
                          <li><a href="#" data-value="10">Todos los existentes</a></li>
                          <!--li class="divider"></li-->
                        </ul>
                      </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div>
            </form>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="noticias">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Noticias</h2>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="img/mini_64x64.svg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Nested media heading</h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p><small>3/3/2015 4:00 a.m.</small>
                      </div>
                    </div><br/>

                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="img/mini_64x64.svg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Nested media heading</h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p><small>3/3/2015 4:00 a.m.</small>
                      </div>
                    </div><br/>

                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="img/mini_64x64.svg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Nested media heading</h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p><small>3/3/2015 4:00 a.m.</small>
                      </div><br/>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="success" id="quienesomos">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>¿Qué es campus rtv?</h2>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p>La plataforma digital “Campus RTV” es una propuesta virtual donde reposan los proyectos sonoros, audiovisuales y de grado, desarrollados  a lo largo del programa de Dirección y Producción de Radio y Televisión de la Universidad Autónoma del Caribe.</p>


                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/sKMPdN9F28k"></iframe>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-6">
                    <h3>CINE & DIGITAL</h3>
                    <p>Experiencias contemporáneas de creación audiovisual latinoamericana y mundial. Videos, formatos interactivos en web, narraciones no lineales y documentales abiertos son algunas de las expresiones que presentará este espacio abierto al audiovisual contemporáneo.</p>
                </div>
                <div class="col-lg-6">
                    <h3>SEMINARIO INTERNACIONAL</h3>
                    <p>Evento central del Festival Internacional de la Imagen, que presenta diversas miradas en temas de diseño, arte, ciencia y tecnología, a partir de las ponencias de teóricos, investigadores, realizadores y académicos, que son invitados a compartir sus producciones y experiencias.</p>
                </div>
                <div class="col-lg-6">
                    <h3>TALLERES</h3>
                    <p>Espacios dedicados a la aplicación de conocimientos dirigido a los inscritos al evento, con temáticas que abordan diferentes áreas del diseño, la creación, hardware y software libre, curadurías digitales, fotografía, performance, emprendimiento, nuevos medios, graficas contemporáneas, entre otras.</p>
                </div>
                <div class="col-lg-6">
                    <h3>EVENTOS ESPECIALES</h3>
                    <p>Espacios abiertos a la presentación de conferencias, conversatorios y eventos con temáticas relacionadas con las investigaciones académicas, los desarrollos empresariales, los emprendimientos culturales, entre otros. Entrada abierta al público.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Ubicación</h3>
                        <p><small>3481 Zona centro<br>Barranquilla, Atlantico, Colombia</small></p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Redes sociales</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Contactenos</h3>
                        <p>
                            <small>
                                Celular: 300 399292<br/>
                                Whatsapp: 300 399295<br/>
                                Telefono: (02) 658900976<br/>
                                Correo Electrónico: contactenos@campusrtv.com.co<br/>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Campus RTV 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!--script src="js/contact_me.js"></script-->


    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>


    <script type="text/javascript">
        $(function(){
            $('.dropdown-menu li a').click(function(){
                $('#seleccion').val( $(this).attr('data-value') );
                $(".btn:first-child").text($(this).text());
                $(".btn:first-child").val($(this).text());
                $('#fm_buscar').submit();
            });
        });



    </script>

</body>

</html>
