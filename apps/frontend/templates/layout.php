<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta charset="UTF-8">
        <title>TaxiAdmin</title>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        
    </head>
    <body>
        <div id="bg">
            <!-- Menú Global -->
            <div id="menuGlobal">

                <div id="subMenuGlobal">
                    <img id="image-loader" src="/images/publica/loader.gif" style="vertical-align: middle; display: none" />
                    <h1>Taxi<span class="logo_colour">Admin</span>  <span class="beta"> beta</span></h1>

                    <div id="mainmenu">
                        <div id="contacto">
                            <ul id="menu">
                                <li><a href="" onclick="showEditDialog('Dudas y sugerencias', '<?php echo url_for('email/new') ?>', '450', fValidateEmail, fOkNone); return false;">Dudas y sugerencias</a></li>
                            </ul>
                        </div>
                        <ul id="menu">
                            <li><a href="<?php echo url_for('sesion/logout') ?>">Cerrar Sesión [ <?php echo $sf_user->getAttribute('nombre') ?> ]</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Menú TaxiAdmin -->
                <div id="menuTaxiAdmin">
                    <ul id="menu">
                        <li><?php echo link_to('Inicio', 'paginaInicial/') ?></li>
                        <li><?php echo link_to('Empresas', 'empresa/') ?></li>
                        <li><?php echo link_to('Propietarios', 'propietario/') ?></li>
                        <li><?php echo link_to('Choferes', 'chofer/') ?></li>
                        <li><?php echo link_to('Móviles', 'movil/') ?></li>
                        <li><?php echo link_to('Ingresar Recaudación', 'recaudacion/new') ?></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Cuerpo de la aplicación -->
        <div id="bodyTaxiAdmin" >

            <?php if (has_slot('sidebar')): ?>
                <?php include_slot('sidebar') ?>

            <?php endif; ?>

            <!-- Centro -->
            <div id="bodyCentral" >
                
                <div id="mensaje"></div>

                <?php echo $sf_content ?>

            </div>

        </div>

        <!-- Pié de página -->
        <div id="footer">
            <div id="footerbg">
                <div class="wrap">
                    <p id="copy"> <span> BYG </span> Intelligent Solutions</p>
                </div>
            </div>
        </div>

    </body>
</html>