@extends('layout')
@section('content');
<section class="container cf pdd2">
	<section class="inner">
       <!--  <div class="solicitar"><span>Gracias tu solicitud a sido procesado</span></div> -->
		<!--<h1>4 art&iacute;culos en el carrito</h1>-->
        <div class="heads">
            <span class="producto-hd">Descripci&oacute;n</span>
            <span class="tiempo-hd">Tiempo (meses)</span>
            <span class="cant-hd">Personas</span>
            <span class="total-hd">Subtotal</span>
        </div>
        <!--producto-->
        <div class="productos-carrito">
            <!--producto-desc y foto-->
            <span class="producto">
				<span class="info-desc right">
                    <span>{{$paquete['nombre']}}</span>
                </span>	
            </span>
            <!--Talla-->
            <div class="tiempo">
                <span>{{$solicitud['meses']}}</span>
            </div>  	
            <!--cant-->
            <span class="cant">
                <span>{{$solicitud['espacios']}}</span>
            </span>
            <!--cant-->			
            <!--precio unitario-->
            <div class="pu-total">
                <span>${{number_format($paquete_precio,2)}} MXN</span>
            </div>
            <!--precio unitario-->		
        </div>
        	<?php foreach($adicionales as $adicional): ?>
            <!--producto-->
            <div class="productos-carrito">
                <!--producto-desc y foto-->
                <span class="producto">
                    <span class="info-desc right">
                        <span>{{$adicional['nombre']}}</span>
                    </span> 
                </span>
                <!--tiempo-->
                <div class="tiempo">
                    <span class="info-desc">
                        <span>{{$adicional['meses']}}</span>
                    </span> 
                </div>      
                <!--cant-->
                <span class="cant">
                    <span class="info-desc">
                        <span>{{$adicional['espacios']}}</span>
                    </span> 
                </span>
                <!--cant--> 
                <!--precio unitario-->      
                <div class="pu-total">
                    <span>
                        ${{ number_format($adicional['precio'], 2) }} MXN
                    </span>
                </div>
                <!--precio unitario-->      
            </div>
            <?php endforeach; ?>
            <!--producto-->
        <!--totales-->
        <section class="totales2 cf">
            <div class="sub">
                <span>IVA</span>
                <p id="ajax_gran_total">${{ number_format($iva, 2)}} MXN</p>
            </div>
            <div class="sub">
                <span>Total </span>
                <p id="ajax_gran_total">${{ number_format($total + $iva, 2) }} MXN</p>
            </div>
            <br>
            <?php echo Form::open(array('url'=>'confirmar-pago', 'id'=>'frm_confirmar')) ?>
            	<input type="hidden" name="total" value="{{$total + $iva}}">
            	<input type="hidden" name="token" value="{{$_GET['token']}}">
            	<input type="hidden" name="payerid" value="{{$detalles['PAYERID']}}">
            <?php echo Form::close() ?>
        	<a style="cursor:pointer;" onclick="$('#frm_confirmar').submit()"><img src="https://www.paypal.com/es_ES/i/btn/btn_paynowCC_LG.gif"></a>
        </section>
        <!--totales-->
	</section>
</section>
<style type="text/css">
	.totales2{
		float: left;
	}
</style>
@stop;