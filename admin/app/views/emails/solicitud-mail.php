<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/normalize.css" type="text/css" media="all">

<script src="js/modernizr.js" type="text/javascript"></script>
<script src="js/prefixfree.min.js" type="text/javascript"></script>
<title>NuWork - Ticket de Venta</title>
</head>

<body>
<!--Header-->
<?php include("views/header.php"); ?>
<section class="container cf pdd2">
        <section class="inner">
            <page style="background-color:#FFF;">
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
            <tbody><tr>
            <td style="width:100%;"><img alt="" src="img/nuworkbg.jpg"></td>
            </tr>
            </tbody>
            </table>
            <table style="width:560px; margin:0 auto; text-align:center;" height="100" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
            <td style="width:100%;"><h1 style="font-weight: bold; margin:5.5%;">¡En hora buena!</h1>
            <p style="font-size:1.2em;"><span>Fuiste aceptado para entrar al<br>equipo de NuWork</span></p><br>
            </td>
            </tr>
            </tbody>
            </table>
            <table style="width:560px; margin:0 auto; text-align:center;" height="100" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
            <td style="width:100%;"><p><span>Completa el proceso para comenzar a hacer<br>uso de los beneficios que te ofrecemos.</span></p><br>
            </td>
            </tr>
            </tbody>
            </table>
            <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
            <td style="width:100%;"><p><span>ID. 10</span></p>
            <p><span>CORREO: pablop.dis@gmail.com</span></p><br>
            </td>
            </tr>
            </tbody>
            </table>
            <table style="width:560px; margin:0 auto; text-align:center;" height="70" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
            <td style="width:100%;">
            <a href="<?php echo asset('../../login') ?>" 
                style="background: #488dd8; border-radius: 4px; border: 1px solid rgba(176,175,170,0); font-weight:bold; -webkit-box-sizing: border-box; -o-box-sizing: border-box; -ms-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; color: #fff; transition: 1s ease; margin: 0 auto; padding: 5% 14%; text-decoration: none; width: 9%;" onClick="imprSelec('imprimir_html');" class="imprimir bold">
                Ir al login
            </a>
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
<!--footer-->
<?php include("views/footer.php"); ?>
</body>
</html> 