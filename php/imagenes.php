    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="../../js/jquery.cropit.js"></script>
    <script src="../../js/forms.js"></script>

    <style>
      .cropit-image-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 600px;
        height: 339px;
        cursor: move;
      }

      .cropit-image-background {
        opacity: .2;
        cursor: auto;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input {
        display: block;
      }

      .export {
        margin-top: 10px;
      }
      .cropit-image-background {
        opacity: .2;
      }
      /*
       * If the slider or anything else is covered by the background image,
       * use relative or absolute position on it
       */
      input.cropit-image-zoom-input {
        position: relative;
      }
      /* Limit the background image by adding overflow: hidden */
      #image-cropper {
        overflow: hidden;
      }
    </style>

  <div class="row">
    <div class="image-editor">
      <div class="col-md-12 col-xs-12">
        <input id="filename" type="file" class="cropit-image-input form-control">
      </div>
      <div class="col-md-12 col-xs-12">
        <div class="cropit-image-preview-container">
            <div class="cropit-image-preview"></div>
            <p>El tamaño mínimo de la imagen es ancho: 600px por
        alto: 339px</p>

        </div>
        <hr/>
          <table style="width:100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="3">
              <input type="range" class="cropit-image-zoom-input form-control">
            </td>
          </tr>
          <tr>
            <td style="width:20%; vertical-align:top;">
              <h5><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></h5>
            </td>
            <td style="width:60%; vertical-align:top;">
              <div class="image-size-label text-center">
                Cambiar tamaño de la imagen
              </div>
            </td>
            <td style="width:20%; vertical-align:top;">
              <div class="image-size-label text-right">
                <h3><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></h3>
              </div>
            </td>
          </tr>
        </table>
        <br/>
        <button class="export btn btn-primary">Guardar imagen</button>
        <hr/>
      </div>
      <div class="col-md-12 col-xs-12">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Imágenes de la portada</div>
          <div class="panel-body">
            Estas imagenes seran visibles en la página principal, dé click en <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> para activar o click en <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> para desactivar su visualización. De click en el siguiente icono
            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> para eliminar la imagen, <b>ATENCION!</b> esta opción no requiere verificación por lo tanto su eliminación será inmediata.

          </div>
          <div class="row" id="thumbnails_portada"></div>
        </div>
      </div>
    </div>
  </div>
    <script>
    $.noConflict();
      jQuery(function($) { ({  });
        show_images_all();
        $('.image-editor').cropit({
          imageBackground: false,
          imageState: {
            src: '../../img/empty_bg.png',
          },
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          //console.log(imageData);
          var filename = $('#filename').val();
          //$( "#thumbnails_portada" ).empty();
          $.post( "../save_image_news.php", { imageData: imageData, filename: filename})
            .done(function( data ) {
                //console.log(data);
                thumbnails(data);
            });
        });

        function thumbnails(data){
          //console.log(data);
          $( "#thumbnails_portada" ).empty();
          data = JSON.parse(data);
          if (data) {
            $.each(data, function(i, item){
              var capa = '<div class="col-xs-6 col-md-6">'+
                        '<span class="glyphicon glyphicon-eye-open hide-show-image" aria-hidden="true" id="'+item.id+'"></span> '+item.ruta+
                        '<div class="thumbnail">'+
                        '  <img src="../../img/carrusel/'+item.ruta+'" alt="'+item.ruta+'">'+
                        '<span class="glyphicon glyphicon-remove-sign delete" aria-hidden="true" id="'+item.id+'" name="'+item.ruta+'"></span>'+
                        'Eliminar</div>'+
                      '</div>';
              $( "#thumbnails_portada" ).append( capa );
          });

             $('#thumbnails_portada').on('click', '.delete', function() {
                console.log($(this).attr("id"));
                $.post( "../edit_image.php", { metodo:'delete', id: $(this).attr("id"), ruta:$(this).attr("name")})
                   .done(function( data ) {
                      //console.log(data);
                      show_images_all();
                  });
             });

            $('#thumbnails_portada').on('click', '.hide-show-image', function() {
                  if ($(this).attr("class")=='glyphicon glyphicon-eye-open hide-show-image' ) {
                    $(this).prop("class", "glyphicon glyphicon-eye-close hide-show-image");
                    is_visible = 0;
                  }else{
                    $(this).prop("class", "glyphicon glyphicon-eye-open hide-show-image");
                    is_visible = 1;
                  }

                  $.post( "../edit_image.php", { metodo:'edit', id: $(this).attr("id"), visible: is_visible})
                   .done(function( data ) {
                      //console.log(data);
                  });
              });

          };

        }

        function show_images_all(){
            $.post( "../get_imagenes.php", { get_images:'all'})
            .done(function( data ) {
                //console.log(data);
                  thumbnails(data);
            });
        }



      });
    </script>



