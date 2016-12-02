<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title></title>

    <!-- Star CSS and Javascript -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/<?php echo $cssFolder; ?>/css/reset.css" type="text/css" media="screen,projection">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/<?php echo $cssFolder; ?>/css/estilos.css" type="text/css" media="screen,projection">

    <!-- Modal CSS files -->
    <link type='text/css' href='<?php echo base_url(); ?>public/css/demo.css' rel='stylesheet' media='screen' />
    <link type='text/css' href='<?php echo base_url(); ?>public/css/basic.css' rel='stylesheet' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='<?php echo base_url(); ?>public/js/jquery.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>public/js/jquery.simplemodal.js'></script>

    <!-- End CSS and Javascript -->


    <script>
      
        /*
        	Function that execute when user click in girl image. 
        		
        	Open iframe in modal.
        */
        function openModal(url) 
		{
            $.modal(
                '<iframe src="' + url + '" width="1100px" height="750px"></iframe>'
            );
            return false;
        }
    

        $(document).ready(function() 
		{

            //AJAX request to get webcams
            $.ajax({
                type: 'GET',
                url: "http://webcams.cumlouder.com/feed/webcams/online/61/1/",
                dataType: "json",
                success: function(response) 
				{

                    var receivedArray = response;

                    //Block counter
                    var count = 1;

                    //Copies of response array to get elements to insert by big or small thumb
                    var copyToSpliceBigThumbs = receivedArray.slice();
                    var copyToSpliceSmallThumbs = receivedArray.slice();

                    var arraySmallThumbs = copyToSpliceSmallThumbs.splice(1, receivedArray.length);
                    var arrayBigThumbs = copyToSpliceBigThumbs.splice(0, 5);

                    //Number of elements that i must insert
                    var numberOfElements = arrayBigThumbs.length + arraySmallThumbs.length;

                    for (i = 0; i < numberOfElements; i++) 
					{

                        if (count == 6) //If is 6 position, insert element like big thumb from it array. Left side.
                        {
                            var deletedElement = arrayBigThumbs.shift();
                            var url = 'http://webcams.cumlouder.com/joinmb/cumlouder/' + deletedElement.wbmerPermalink + '/?nats=<?php echo $natsWebcams; ?>';

                            $('<div class="chica chica-grande"><a onClick="openModal(\'' + url + '\');" class="link" href="#" title=""><span class="thumb"><img src="http://w0.imgcm.com/modelos/' + deletedElement.wbmerThumb4 + '" width="357" height="307" alt="" title="" /></span><span class="nombre-chica"> <span class="ico-online"></span>' + deletedElement.wbmerNick + '</span><span id="favorito" class="ico-favorito" ></span></a></div>').insertBefore("#clear-listado");
                        } else if (count == 20) //If is 20 position, insert element like big thumb from it array. Right side.
                        {
                            var deletedElement = arrayBigThumbs.shift();
                            var url = 'http://webcams.cumlouder.com/joinmb/cumlouder/' + deletedElement.wbmerPermalink + '/?nats=<?php echo $natsWebcams; ?>';

                            $('<div class="chica chica-grande grande-derecha"><a onClick="openModal(\'' + url + '\');" class="link" href="#" title=""><span class="thumb"><img src="http://w0.imgcm.com/modelos/' + deletedElement.wbmerThumb4 + '" width="357" height="307" alt="" title="" /></span><span class="nombre-chica"> <span class="ico-online"></span>' + deletedElement.wbmerNick + '</span><span id="favorito" class="ico-favorito" ></span></a></div>').insertBefore("#clear-listado");
                        } else //If is other position, insert element like small thumb from it array
                        {
                            var deletedElement = arraySmallThumbs.shift();
                            var url = 'http://webcams.cumlouder.com/joinmb/cumlouder/' + deletedElement.wbmerPermalink + '/?nats=<?php echo $natsWebcams; ?>';

                            $('<div class="chica"><a onClick="openModal(\'' + url + '\');" class="link" href="#" title=""><span class="thumb"><img src="http://w0.imgcm.com/modelos/' + deletedElement.wbmerThumb1 + '" width="175" height="150" alt="" title="" /></span><span class="nombre-chica"> <span class="ico-online"></span>' + deletedElement.wbmerNick + '</span><span id="favorito" class="ico-favorito" ></span></a></div>').insertBefore("#clear-listado");
                        }

                        //End of block. Initialize to create new block
                        if (count == 24) 
						{
                            count = 0;
                        }

                        count += 1;

                    }

                },
                error: function() 
				{
                    alert('Error en la petición, inténtelo de nuevo');
                },
                complete: function() {}
				
            });
			
        });

    </script>
    
    <!-- end CSS and Javascript -->
</head>

<body>


    <!-- modal content -->
    <div id="basic-modal-content">

    </div>

    <!-- preload the images -->
    <div style='display:none'>
        <img src='img/basic/x.png' alt='' />
    </div>


    <div class="box-header">
        <div class="header">
            <h1 class="logo-sitio"><a href="#" title="Babosas.biz">Babosas.biz</a></h1>
            <div class="tit-webcams">Webcams</div>

            <div class="logo-cum"><a href="#" title="Cumlouder.com">Cumlouder.com</a></div>

            <div class="menu">
                <a href="#" title="Acceso a las Chicas en Directo">Acceso a las Chicas en Directo</a> <span>|</span>
                <a href="#" title="Acceso Miembros">Acceso Miembros</a> <span>|</span>
                <a href="#" title="Compra Créditos">Compra Créditos</a>
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <!-- termina HEADER -->

    <div class="listado-chicas">

        <div id="clear-listado" class="clear"></div>

        <a class="btn-mas-modelos" href="#" title="Mostrar más modelos">Mostrar Más Modelos</a>

    </div>


    <!-- termina LISTADO DE CHICAS -->

    <div class="box-footer">
        <div class="menu">
            <a href="#" title="Acceso a las Chicas en Directo">Acceso a las Chicas en Directo</a> <span>|</span>
            <a href="#" title="Acceso Miembros">Acceso Miembros</a> <span>|</span>
            <a href="#" title="Compra Créditos">Compra Créditos</a>
        </div>
    </div>
    <!-- termina MENU FOOTER -->

    <div class="box-copy">
        <div class="menu">
            <p>Copyright © WAMCash Spain Todos los derechos reservados <span>|</span> <a href="#" title="Webmasters">Webmasters</a> </p>
            <p>Contenido para adultos <span>|</span> Tienes que tener mas de 18 años para poder visitarlo. Todas las modelos de esta web son mayores de edad.</p>
        </div>
    </div>
    <!-- termina COPY -->

    <div class="box-data">
        <div class="menu">
            <a href="#" title="Soporte Epoch">Soporte Epoch</a> <span>|</span>
            <a href="#" title="18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement">18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement</a> <span>|</span>
            <a href="#" title="Contacto">Contacto</a> <span>|</span>
            <a href="#" title="Please visit Epoch.com, our authorized sales agent">Please visit Epoch.com, our authorized sales agent</a>
        </div>
    </div>
    <!-- termina DATA -->


</body>

</html>