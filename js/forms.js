
$(document).ready(function(){

    function get_all(aTabla, span){
      $.post( "../generalidades.php?q=total_recurso", { tabla: aTabla})
        .done(function( data ) {
            //console.log(data);
            $(span).html( data );
        });
    }



    $('#exampleModal').on('hidden.bs.modal', function () {
      //console.log('cerrado');
      $("div#preview_audio > div#audio_preview").html('');
    });

    $(document).on("click", ".open-Modal", function () {
        //console.log( $( this ).attr('recurso')  );
        $('#preview_audio').hide();
        $('#preview_audiovisual').hide();
        $('#preview_proyecto').hide();

        var tb = $(this).attr('recurso');
        var id = $(this).attr('id');
        var server = $('#server').val();


        $.ajax({
                type: "POST",
                url: "../../php/listados/reporte.php",
                data: { tb: tb, id: id },

                success: function(result){
                    //console.log(server);
                    data = JSON.parse(result);
                    switch( tb ) {
                       case 'audios':
                          url_resource = data.ruta;
                          $("div#preview_audio > div#audio_preview").html("<iframe id='fr_preview' src='"+server+"/php/preview_audio.php' width='560' height='40' frameborder='0' allowfullscreen> </iframe>");
                          $("div#preview_audio > div#d_formato").html("<b>Formato: </b>"+data.formato);
                          $("div#preview_audio > div#d_tematica").html("<b>Temática: </b>"+data.tematica);
                          $("div#preview_audio > div#d_duracion").html("<b>Duración: </b>"+data.duracion);
                          $("div#preview_audio > div#d_genero").html("<b>Género: </b>"+data.genero);
                          $("div#preview_audio > div#d_presentacion").html("<b>Presentación: </b>"+data.presentacion);
                          $("div#preview_audio > div#d_ruta").html("<b>Enlace: </b><a href='"+data.ruta+"' target='new'>"+data.ruta+"</a>");
                          $("div#preview_audio > div#d_tag").html("<b>Palabras claves: </b>"+data.tag);
                          $('#preview_audio').show();
                        break;
                       case 'audiovisuales':
                          $("div#preview_audiovisual > div#audiovisual_preview").html("<iframe style='height:100%; width:100%' src='http://www.youtube.com/embed/"+getUrlVars(data.ruta)["v"]+"' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen/>");
                          $("div#preview_audiovisual > div#d_nombre").html("<b>Formato: </b>"+data.formato);
                          $("div#preview_audiovisual > div#d_formato").html("<b>Formato: </b>"+data.formato);
                          $("div#preview_audiovisual > div#d_genero").html("<b>Genero: </b>"+data.genero);
                          $("div#preview_audiovisual > div#d_linea").html("<b>Linea: </b>"+data.linea);
                          $("div#preview_audiovisual > div#d_presentacion").html("<b>Presentacion: </b>"+data.presentacion);
                          $("div#preview_audiovisual > div#d_ruta").html("<b>Enlace: </b><a href='"+data.ruta+"' target='new'>"+data.ruta+"</a>");
                          $("div#preview_audiovisual > div#d_tag").html("<b>Palabras claves: </b>"+data.tag);
                          $('#preview_audiovisual').show();
                        break;
                       case 'proyectos':
                          //<iframe width="560" height="315" scrolling="no" scrolling='yes' style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" allowfullscreen>
                          $("div#preview_proyecto > div#proyecto_preview").html("<iframe width='560' scrolling='yes' height='400'  src='"+data.ruta+"' style='border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px' allowfullscreen/>");
                          $("div#preview_proyecto > div#d_nombre").html("<b>Nombre: </b>"+data.nombre);
                          $("div#preview_proyecto > div#d_tipo_investigacion").html("<b>Tipo de investigacion: </b>"+data.tipo_investigacion);
                          $("div#preview_proyecto > div#d_tipo_estudio").html("<b>Tipo de estudio: </b>"+data.tipo_estudio);
                          $("div#preview_proyecto > div#d_contexto").html("<b>Contexto: </b>"+data.contexto);
                          $("div#preview_proyecto > div#d_beneficiario").html("<b>Beneficiario: </b>"+data.beneficiario);
                          $("div#preview_proyecto > div#d_producto_final").html("<b>Producto final: </b>"+data.producto_final);
                          $("div#preview_proyecto > div#d_tematica").html("<b>Temática: </b>"+data.tematica+"<b>: </b>"+data.tematica);
                          $("div#preview_proyecto > div#d_bases_teoricas").html("<b>Bases teóricas: </b>"+data.bases_teoricas);
                          $("div#preview_proyecto > div#d_linea_investigacion").html("<b>Linea de investigacion: </b>"+data.linea_investigacion);
                          $("div#preview_proyecto > div#d_ruta").html("<b>Enlace: </b><a href='"+data.ruta+"' target='new'>"+data.ruta+"</a>");
                          $("div#preview_proyecto > div#d_tag").html("<b>Palabras claves: </b>"+data.tag);
                          $('#preview_proyecto').show();
                        break;
                  }
                }
            });
    });

    get_all("audios", "#t_audios");
    get_all("audiovisuales", "#t_audiovisuales");
    get_all("proyectos", "#t_proyectos");

    $("#guardado_exitoso").hide();
    $("#guardado_error").hide();
    $("#bi_autor").hide();

    //busqueda dinamica
    $.post( "../forms/buscar_autor.php", function( data ) {
        autores = data.split(',');
        $('#autor_audio').typeahead({source: autores});
        $('#autor_audiovisual').typeahead({source: autores});
        $('#autor_proyecto').typeahead({source: autores});
    });

    //adicion de autor audio
    $('#btAddAutorAudio').click( function() {
        if ( $('#autor_audio').val() ) {
           $nodo = $( "#bi_autor" ).clone().appendTo('#dv_autores_audio').show();
           $nodo.prop("id", "bi_autor_clon");
           $nodo.find('#ch_autor_clon').prop( "id", 'ch_autor' );
           $nodo.find('#ch_autor').prop( "checked", true );
           $nodo.find('#autor_clon').prop( "id", 'autor' );
           $nodo.find('#autor').prop( "name", 'autores[]' );
           $nodo.find('#ch_autor').prop( "name", 'if_check[]' );

           $nodo.find('#autor').val( $('#autor_audio').val() );
           $('#autor_audio').val('');

        };
    });
   //envio de audio
    $('#bt_g_audio').click( function() {

        if ( $('#fm_audio').valid() ) {

            $.ajax({
                type: "POST",
                url: "../../php/save_file.php",
                data: $('#fm_audio').serialize(),

                success: function(data){
                    //console.log(data);
                    $('#fm_audio')[0].reset();
                    $("#dv_autores_audio div").each(function (index){
                        //console.log( data );
                          if( $(this).prop( "id" )=='bi_autor_clon' ){
                            $(this).remove();
                          }
                      });

                    $("#guardado_exitoso").show().fadeOut( 5000 );
                }
            });
       } else {
            $("#guardado_error").show().fadeOut( 5000 );
       }
       $('#nav_tabs').find('.active').toggleClass('active inactive')
       $('#tab_1').prop('class', 'active');

        $('html, body').stop().animate({
                        scrollTop: $('#dv_formularios').offset().top
        }, 200);
    });
    //fin de envio de audio
    //adicion de autor audiovisual
    $('#btAddAutorAudiovisual').click( function() {
        if ( $('#autor_audiovisual').val() ) {
           $nodo = $( "#bi_autor" ).clone().appendTo('#dv_autores_audiovisual').show();
           $nodo.prop("id", "bi_autor_clon");
           $nodo.find('#ch_autor_clon').prop( "id", 'ch_autor' );
           $nodo.find('#ch_autor').prop( "checked", true );
           $nodo.find('#autor_clon').prop( "id", 'autor' );
           $nodo.find('#autor').prop( "name", 'autores[]' );
           $nodo.find('#ch_autor').prop( "name", 'if_check[]' );

           $nodo.find('#autor').val( $('#autor_audiovisual').val() );
           $('#autor_audiovisual').val('');

        };
    });
     //envio de audiovisual
    $('#bt_g_audiovisual').click( function() {

        if ( $('#fm_audiovisual').valid() ) {

            $.ajax({
                type: "POST",
                url: "../../php/save_file.php",
                data: $('#fm_audiovisual').serialize(),

                success: function(data){
                    //console.log(data);
                    $('#fm_audiovisual')[0].reset();
                    $("#dv_autores_audiovisual div").each(function (index){
                       // console.log( $(this).prop( "style" ) );
                          if( $(this).prop( "id" )=='bi_autor_clon' ){
                            $(this).remove();
                          }
                      });
                    $("#guardado_exitoso").show().fadeOut( 5000 );
                }
            });
        } else {
            $("#guardado_error").show().fadeOut( 5000 );
        }
        $('#nav_tabs').find('.active').toggleClass('active inactive')
        $('#tab_2').prop('class', 'active');

        $('html, body').stop().animate({
                        scrollTop: $('#dv_formularios').offset().top
        }, 200);
    });
    //fin de envio de audio
    //adicion de autor proyecto
    $('#btAddAutorProyecto').click( function() {
        if ( $('#autor_proyecto').val() ) {
           $nodo = $( "#bi_autor" ).clone().appendTo('#dv_autores_proyecto').show();
           $nodo.prop("id", "bi_autor_clon");
           $nodo.find('#ch_autor_clon').prop( "id", 'ch_autor' );
           $nodo.find('#ch_autor').prop( "checked", true );
           $nodo.find('#autor_clon').prop( "id", 'autor' );
           $nodo.find('#autor').prop( "name", 'autores[]' );
           $nodo.find('#ch_autor').prop( "name", 'if_check[]' );

           $nodo.find('#autor').val( $('#autor_proyecto').val() );
           $('#autor_proyecto').val('');

        };
    });
     //envio de proyecto
    $('#bt_g_proyecto').click( function() {

        if ( $('#fm_proyecto').valid() ) {

            $.ajax({
                type: "POST",
                url: "../../php/save_file.php",
                data: $('#fm_proyecto').serialize(),

                success: function(data){
                    //console.log(data);
                    $('#fm_proyecto')[0].reset();
                    $("#dv_autores_proyecto div").each(function (index){
                        //console.log( $(this).prop( "style" ) );
                          if( $(this).prop( "id" )=='bi_autor_clon' ){
                            $(this).remove();
                          }
                      });
                    $("#guardado_exitoso").show().fadeOut( 5000 );
                }
            });
        } else {
            $("#guardado_error").show().fadeOut( 5000 );
        }
        $('#nav_tabs').find('.active').toggleClass('active inactive')
        $('#tab_3').prop('class', 'active');

        $('html, body').stop().animate({
                        scrollTop: $('#dv_formularios').offset().top
        }, 200);
    });
    //fin de envio de proyecto

    function getUrlVars(ruta) {
      var vars = {};
      var parts = ruta.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
    }

});