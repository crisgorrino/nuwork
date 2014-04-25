<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?php echo asset('css/style.css') ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo asset('css/normalize.css') ?>" type="text/css" media="all">

    <script src="<?php echo asset('js/modernizr.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('js/prefixfree.min.js') ?>" type="text/javascript"></script>
    <title>NuWork - Ticket de Venta</title>
</head>

<body>
    <section class="container cf pdd2" style="background:url(<?php echo asset('img/bg1.png') ?>) no-repeat; background-size: 100%;">
        <section class="inner">
            <page style="background-color:#FFF; background:url(<?php echo asset('img/bg1.png') ?>) no-repeat; background-size: 100%;">
                <style type="text/css">
                    a:link {
                        color: #3f3f3f;
                        text-decoration: none;
                    }
                    a:visited {
                        color:#3f3f3f;
                        text-decoration:none;
                    }
                    a:hover {
                        color:#3f3f3f;
                        text-decoration:underline;
                    }
                    a:active {
                        color:#3f3f3f;
                        text-decoration:none;
                    }
                    p{font-family:Helvetica, Arial, sans-serif; margin:0px; padding:0px;
                        color:#3f3f3f;}
                        h1,h2,h3,h4{font-family:Helvetica, Arial, sans-serif; font-weight:normal; color:#3f3f3f; margin: 0;}
                        h2{font-size: 16px;}
                        .img_border{border:1px solid #686565;}
                    </style>

                    <table style="width:560px; padding:25px 25px 0 25px; margin:0 auto;" height="200" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td style="width:100%;"><img alt="" src="<?php echo $message->embed('img/nuworkbg.jpg') ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:560px; margin:0 auto; text-align:center;" height="100" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td style="width:100%;"><h1 style="font-weight: bold; margin:5.5%;">¡En hora buena!</h1>
                                    <p style="font-size:1.2em;"><span>Hay una nueva solicitud para ingresar al <br>equipo de NuWork</span></p><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:560px; margin:0 auto; text-align:center;" height="100" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td style="width:100%;"><p><span>Ingresa al administrador para aprobar la solicitud</span></p><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td><label>Nombre:</label></td>
                            <td><input type="text" name="nombre" value="<?php echo $datos['nombre'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Apellidos:</label></td>
                            <td><input type="text" name="apellidos" value="<?php echo $datos['apellidos'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Título:</label></td>
                            <td><input type="text" name="titulo" value="<?php echo $datos['titulo'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Facebook:</label></td>
                            <td><input type="text" name="facebook" value="<?php echo $datos['facebook'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                            <td><input class="medio" name="correo" type="text" value="<?php echo $datos['correo'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Celular:</label></td>
                            <td><input class="medio" name="celular" type="text" value="<?php echo $datos['celular'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>Proyecto/Empresa:</label></td>    
                            <td><input type="text" name="proyecto" value="<?php echo $datos['proyecto'] ?>" disabled></td>
                        </tr>
                        <tr>
                            <td><label>¿Por qué quiere estar aquí?</label></td>
                            <td><textarea name="que_hacer" value="<?php echo $datos['que_hacer'] ?>" disabled><?php echo $datos['que_hacer'] ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <fieldset style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                    <legend>Datos de la Solicitud</legend>
                    <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <th>Paquete: </th>
                            <td><?php echo $paquete->nombre ?></td>
                        </tr>
                        <tr>
                            <th>No. Espacios:</th>
                            <td><?php echo $datos['espacios'] ?></td>
                        </tr>
                        <tr>
                            <th>Meses:</th>
                            <td><?php echo $datos['meses'] ?></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                    <legend>Serivicios Adicionales</legend>
                      <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                            <th>Servicio</th>
                            <th>Meses</th>
                            <th>Espacios</th>
                        </thead>
                        <?php foreach($adicionales as $adicional): ?>
                            <tr>
                                <td><?php echo $adicional['nombre'] ?></td>
                                <td><?php echo $adicional['meses'] ?></td>
                                <td><?php echo $adicional['espacios'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>                    
                </fieldset>

                <br><br>
                <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
                    <tbody><tr>
                        <td style="width:100%;"><a style="background: #488dd8; border-radius: 4px; border: 1px solid rgba(176,175,170,0); font-weight:bold; -webkit-box-sizing: border-box; -o-box-sizing: border-box; -ms-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; color: #fff; transition: 1s ease; margin: 0 auto; padding: 5% 14%; text-decoration: none; width: 9%;" onClick="imprSelec('imprimir_html');" class="imprimir bold">Ir al login</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width:560px; margin:0 auto; text-align:center;" height="150" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
                    <td style="width:100%;"><p style="color: #7b7a7a; font-weight:bold;"><span>www.nuwork.mx</span><br><br>
                        <span>Mar mediterráneo 1255 int. 2, col. Country Club, Guadalajara Jal.</span><br><br>
                        <span>ventas@nuwork.mx</span></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </page>
</section>
</section>
</body>
</html> 