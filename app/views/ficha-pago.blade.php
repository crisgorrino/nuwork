@extends('layout')
@section('content')
<section class="container cf pdd">
		<section class="inner">
		<table style="width:900px; " align="center">
        <tr>
            <td>
            <?php
            $beneficiario='ALEJANDRO CRESPO GONZALEZ';
            $no_cuenta='4043505981'; //'01002633906';
            $CLABE='021320040435059811'; //'044320010026339067';
            $rfc='GOGR910620JF2'; //'CEUC8912016GA';
            $referencia='PAGO MERCANC&Iacute;A TIENDA  ONLINE <a href="http://www.nuwork.mx" target="_blank">www.nuwork.mx</a> NO. DE ORDEN '.$solicitud['id'];
            $pago_total="$".number_format($orden['AMT'], 2)." MXN";
            ?>
            <p style="border-bottom: 1px solid rgb(0, 0, 0); padding: 2% 0; text-align:justify;">Gracias por comprar en nuestra Online Store. Usted a elegido dep&oacute;sito o transferencia bancaria como m&eacute;todo de pago. Para continuar con el proceso de compra usted deberá de realizar el pago a la cuenta que se encuentra a continuación.</p>
            <div class="registro_form">
                <!--<img src="img/bank.png" alt="ScotiaBank" class="in_line">-->
                <p class="in_line deposito_titulo center">DATOS PARA DEP&Oacute;SITO O TRANSFERENCIA BANCARIA </p>
                <img src="img/hsbc.png" alt="" class="">
                <hr>
                <br>
                
                <table border="0" bordercolor="#0000" style="background-color:transparent; width:900px;" cellpadding="3" cellspacing="1">
                    <tr style="">
                        <td style="" colspan="2">
                        <p style="padding: 2%; border: 1px solid rgb(0, 0, 0); vertical-align: middle; width: 96%;"><strong>Lugar y Fecha:</strong><br />ZAPOPAN, JAL&nbsp;&nbsp;&nbsp;{{date('d/m/Y')}}<br> 
                        </p>
                        </td>
                        <td colspan="2">
                        <p style="border: 1px solid rgb(0, 0, 0); vertical-align: middle; padding: 2%; width: 96%;"><strong>Beneficiario:</strong><br /><?php echo $beneficiario; ?><br></p>    
                        </td>
                    </tr>
                    <tr>
                        <td style="width:33%;">
                        <p style="padding: 2%; border: 1px solid rgb(0, 0, 0); vertical-align: middle; width: 96%;"> <strong>Cuenta:</strong><br /><?php echo $no_cuenta; ?> </p>
                        </td>
                        <td style="width:33%;" colspan="2">
                        <p style="border: 1px solid rgb(0, 0, 0); vertical-align: middle; padding: 2%; width: 96%;"> <strong>CLABE:</strong><br /><?php echo $CLABE; ?> </p>
                        </td>
                        <td style="width:33%;">
                        <p style="border: 1px solid rgb(0, 0, 0); vertical-align: middle; padding: 2%; width: 96%;"> <strong>RFC:</strong><br /><?php echo $rfc; ?></p>     
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                        <p style="border: 1px solid rgb(0, 0, 0); vertical-align: middle; padding: 2%; width: 96%;"><strong>*Referencia:</strong><br /><?php echo $referencia; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>
                        <h4 style="border: 1px solid #000000; text-align: right; padding: 2%;text-align: center;width: 96%;"><strong>TOTAL:&nbsp;</strong> <?php echo $pago_total; ?></h4> 
                        </td>
                    </tr>
            </table>
                
                <div style="clear:both;"></div>
            </div>
            <p>*Para su tranquilidad anote el n&uacute;mero de referencia y arch&iacute;velo en un lugar seguro.</p>
            <p>
            Tienes 48 hrs. para realizar tu pago, de lo contrario tu pedido ser&aacute; cancelado.
            </p>            
            <br>
            <p>Una vez realizado el dep&oacute;sito o la transferencia bancaria, deber&aacute;s cargar el comprobante ya sea escaneado o impresi&oacute;n de pantalla en nuestro sistema ingresando a Carga tu Comprobante ubicado en la parte superior de nuestra p&aacute;gina, &oacute; bien haciendo <a href="<?php echo url('pago') ?>" class="turq" target="_blank">click aqu&iacute;</a>, con los siguientes datos de usuario:</p>
                <br>
                    <strong>E-mail: </strong>{{$solicitud['correo']}}<br>
                    <strong>No. Orden: </strong>{{$solicitud['id']}}<br>
                
            <p>Para cualquier duda o aclaraci&oacute;n favor de contact&aacute;rse al (044) 33 1325 0788 &oacute; env&iacute;e un correo a ventas@nuwork.mx.</p>
            </td>
        </tr>
        </table>
		</section>
	</section>
@stop