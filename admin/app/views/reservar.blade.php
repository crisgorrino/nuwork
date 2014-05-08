@extends('layout')
@section('content');
<section class="container cf pdd2" ng-app="app">
	<section class="inner" ng-controller="Reservar">
        <div class="solicitar"><span>Gracias tu solicitud a sido procesado</span></div>
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
                    <span ng-init="paquete_id={{$paquete['id']}}"><?php echo $paquete['nombre'] ?></span>
                </span>	
            </span>
            <!--Talla-->
            <div class="tiempo" ng-init="meses={{$meses}}">
                <span><?php echo $meses ?></span>
            </div>  	
            <!--cant-->
            <span class="cant" ng-init="espacios={{$espacios}}">
                <span><?php echo $espacios ?></span>
            </span>
            <!--cant-->			
            <!--precio unitario-->
            <div class="pu-total" ng-init="getPaquetePrecioMensual()">
                <span><% precio_mensual | currency:"$" %> MXN</span>
            </div>
            <!--precio unitario-->		
        </div>
        <?php foreach($adicionales as $adicional): ?>
            <!--producto-->
            <div class="productos-carrito">
                <!--producto-desc y foto-->
                <span class="producto">
                    <span class="info-desc right">
                        <span><?php echo $adicional['nombre'] ?></span>
                    </span> 
                </span>
                <!--tiempo-->
                <div class="tiempo" ng-init="meses_{{ $adicional['id']}} = 1">
                    <select ng-model="meses_{{$adicional['id']}}" class="seleccionar">
                        <?php  for($i = 1; $i <= $meses; $i++ ): ?>
                            <option value="{{$i}}">{{$i}}</option>
                        <?php   endfor; ?>
                    </select>
                    <a style="cursor:pointer;" class="icon-loop"></a>
                </div>      
                <!--cant-->
                <span class="cant" ng-init="cantidad_{{$adicional['id']}} = 1">
                    <select ng-model="cantidad_{{$adicional['id']}}" class="seleccionar">
                        <?php  for($i = 1; $i <= $espacios; $i++ ): ?>
                            <option value="{{$i}}">{{$i}}</option>
                        <?php   endfor; ?>
                    </select>
                    <a style="cursor:pointer;" class="icon-loop"></a>
                </span>
                <!--cant--> 
                <!--precio unitario-->      
                <div class="pu-total" ng-init="costo.{{$adicional['id']}} = {{ $adicional['precio_mensual']}}">
                    <span>
                        <%  costo_total.{{$adicional['id']}} = cantidad_{{$adicional['id']}} * meses_{{$adicional['id']}}  * costo.{{$adicional['id']}} | currency:"$" %> MXN
                    </span>
                </div>
                <!--precio unitario-->      
            </div>
            <!--producto-->
        <?php endforeach; ?>
        
        <div ng-init="total_adicionales = 0"></div>
        <!--Datos de Rewservación-->
        <section class="datos-d-reserva cf">
            <div class="namedata">
                <input type="text" placeholder="Nombres">
                <input type="text" placeholder="Apellidos">
                <input type="text" placeholder="Titulo/puesto">
                <input type="text" placeholder="URL de Facebook">
            </div>
            <div class="contactdata">
                <input class="medio" type="text" placeholder="Correo">
                <input class="medio" type="text" placeholder="Celular">
                <input type="text" placeholder="Proyecto / empresa">
                <textarea placeholder="¿Porqué quieres estar aquí?"></textarea>
            </div>
        </section>
        <!--totales-->
        <section class="totales2 cf">
                <div class="sub">
                    <span>IVA</span>
                    <p id="ajax_gran_total"><% iva = ( precio_mensual + (costo_total | totalPrice) ) * (.16) | currency:'$' %>  MXN</p>
                </div>
                <div class="sub">
                    <span>Total </span>
                    <p id="ajax_gran_total"><% precio_mensual + (costo_total | totalPrice) + iva | currency: '$' %> MXN</p>
                </div>
            <a style="cursor:pointer;" onclick="document.getElementById('ver_pedido').submit();" class="aplicar-btn">Aplicar</a>
        </section>
        <!--totales-->
	</section>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/ReservarController.js') ?>"></script>
@stop;