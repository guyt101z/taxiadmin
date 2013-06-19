<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <title>TaxiAdmin</title>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="bg">
            <div class="wrap">

                <!-- logo -->
                <h1>Taxi<span class="logo_colour">Admin</span><span class="beta"> beta</span></h1>
                <!-- /logo -->

                <!-- menu -->
                <div id="mainmenu">
                    <ul id="menu">

                        <?php if ($sf_user->isAuthenticated()): ?>
                            <li><?php echo link_to('Inicio', 'paginaInicial/index') ?> </li>
                            <li><?php echo link_to('Cerrar Sesión', 'sesion/logout') ?> </li>
                        <?php else : ?>
                            <li><label onclick="showEditDialog('Contacto', '<?php echo url_for('email/new') ?>', '400', fValidateEmail, fOkContacto); return false;">Contacto</label></li>
                            <li><label onclick="alert('Para ingresar al sistema debe solicitar su invitación en la opción de Contacto.'); return false;">Registrarse</label></li>
                            <li><label onclick="showEditDialog('Ingresar al sistema', '<?php echo url_for('sesion/new') ?>', '320', fValidateSesion); return false;">Ingresar</label></li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- /menu -->

                <!-- pitch -->
                <div id="pitch">
                    <div id="slideshow">

                        <!-- 1st frame -->
                        <div class="active">
                            <?php echo image_tag('publica/pitch1.jpg', 'alt=pitch1') ?>
                            <div class="overlay transparent">
                                <h2>Tenga su información protegida</h2>
                                <p>Tenga toda su información siempre y desde cualquier PC.</p>
                            </div>
                        </div>
                        <!-- /1st frame -->

                        <!-- 2nd frame -->
                        <div>
                            <?php echo image_tag('publica/pitch2.jpg', 'alt=pitch2') ?>
                            <div class="overlay transparent">
                                <h2>Precios acorde a su tamaño</h2>
                                <p>El precio se ajusta a la cantidad de móviles que usted administre.</p>
                            </div>
                        </div>
                        <!-- /2nd frame -->

                        <!-- 3rd frame -->
                        <div>
                            <?php echo image_tag('publica/pitch3.jpg', 'alt=pitch3') ?>
                            <div class="overlay transparent">
                                <h2>Ingresar desde cualquier dispsitivo</h2>
                                <p>Al ser una aplicación web usted puede ingresar a TaxiAdmin desde cualquier dispositivo que 
                                    disponga de una conexión a Internet.</p>
                            </div>
                        </div>
                        <!-- 3rd frame -->

                    </div>
                </div>
                <!-- /pitch -->

                <!-- main -->
                <div id="main">

                    <!-- bits -->
                    <div id="bits">
                        <div class="bit">
                            <h2 class="inner">¿Qué es TaxiAdmin?</h2>
                            <p>
                                TaxiAdmin es una aplicación diseñada específicamente para la administración de taxímetros.
                                Con el cual usted podrá administrar sus choferes, moviles, empresas y sus propietarios.
                                Llevar un registro de todos los gastos del móvil, multas, accidentes y mas.
                                <br>Tendrá a su disposición graficas para poder comparar rendimientos entre móviles y choferes.
                                <br>No se olvide de pagar ni una cuenta más, con nuestro servicio de avisos de vencimientos, usted siempre sabrá cuando se vencen las multas, mensualidades y demás.
                                <br>Como TaxiAdmin es una aplicación web, usted podrá ingresar desde cualquier computadora o dispositivo móvil, de esta manera podrá trabajar desde el lugar que desee.
                            </p>
                        </div>
                        <div class="bit">
                            <h2 class="inner">¿Qué costo tiene?</h2>
                            <p>
                                TaxiAdmin tiene costo por móvil administrado, esto es, si usted administra 5 móviles va a pagar el costo de móvil por 5.
                                <br>De esta manera va a pagar solamente por lo que utiliza del sistema.
                                <br>En este momento TaxiAdmin esta en su versión Beta, esto quiere decir que aún estamos en desarrollo y por lo tanto los usuarios son ingresados por invitación para probar la aplicación y enviarnos sus comentarios. 
                                <br>Para adquirir un usuario y probar la aplicación envíanos un <a onclick="showEditDialog('Contacto', '<?php echo url_for('email/new') ?>', '400', fValidateEmail, fOkContacto); return false;" style="cursor: pointer;" >email</a>.
                            </p>
                        </div>
                        <div class="bit">
                            <h2 class="inner"></h2>
                            <p></p>
                        </div>
                    </div>
                    <!-- /bits -->

                </div>
                <!-- /main -->

            </div>

            <!-- footer -->
            <div id="footer">
                <div id="footerbg">
                    <div class="wrap">
                        <p id="copy"> <span> BYG </span> Intelligent Solutions</p>
                    </div>
                </div>
            </div>
            <!-- /footer -->

        </div>
    </body>
</html>