@extends('layout')
@section('content');
<section class="container cf pdd2" ng-app="app">
	<section class="inner" ng-controller="Reservar">
       <!--  <div class="solicitar"><span>Gracias tu solicitud a sido procesado</span></div> -->
		<!--<h1>4 art&iacute;culos en el carrito</h1>-->
        <div class="heads">
            <span class="producto-hd">Descripci&oacute;n</span>
            <span class="tiempo-hd">Tiempo (meses)</span>
            <span class="cant-hd">Personas</span>
            <span class="total-hd">Subtotal</span>
        </div>

        <?php echo Form::open(array('url' => 'sendSolicitud', 'id'=>'frm_solicitud')) ?>
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
        <?php foreach(Session::get('adicionales') as $adicional): ?>
            <!--producto-->
            <div class="productos-carrito">
                <!--producto-desc y foto-->
                <span class="producto">
                    <span class="info-desc right" ng-init="adicional_{{$adicional['id']}} = 'checked'">
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
            <input type="checkbox" checked="checked" value="{{$adicional['id']}}" name="adicionales[]" style="display:none">
            <input type="hidden" value="<% meses_{{$adicional['id']}} %>" name="meses_{{$adicional['id']}}">
            <input type="hidden" value="<% cantidad_{{$adicional['id']}} %>" name="espacios_{{$adicional['id']}}">
        <?php endforeach; ?>
        
        <div ng-init="total_adicionales = 0"></div>
        <!--Datos de Rewservación-->
        <section class="datos-d-reserva cf">
            
            <div class="namedata"> 
                <input type="text" name="nombre" placeholder="Nombres" class="validate[required]">
                <input type="text" name="apellidos" placeholder="Apellidos" class="validate[required]">
                <input type="text" name="titulo" placeholder="Titulo/puesto" class="validate[required]">
                <input type="text" name="facebook" placeholder="URL de Facebook" class="validate[required,custom[url]]">
            </div>
            <div class="contactdata">
                <input class="medio validate[required, custom[email]]" name="correo" type="text" placeholder="Correo">
                <input class="medio validate[required, custom[onlyNumberSp]]" name="celular" type="text" placeholder="Celular">
                <input type="text" name="proyecto" placeholder="Proyecto / empresa" class="validate[required]">
                <textarea name="que_hacer" placeholder="¿Porqué quieres estar aquí?" class="validate[required]"></textarea>
            </div>
            <input type="hidden" name="meses" value="<%  meses %>" >
            <input type="hidden" name="espacios" value="<%  espacios %>" >
            <input type="hidden" name="paquete_id" value="<% paquete_id %>">
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
            <input type="submit" class="aplicar-btn" value="Aplicar">
        </section>
        <?php echo Form::close() ?>
        <!--totales-->
	</section>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/ReservarController.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/jquery.validationEngine.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/languages/jquery.validationEngine-es.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset('css/validationEngine.jquery.css') ?>">
<script type="text/javascript">
    $("#frm_solicitud").validationEngine({
        autoPositionUpdate:true,
        focusFirstField : true,
        autoPositionUpdate: true,
        autoHidePrompt: true,
        autoHideDelay: 5000,
    });
</script>
@stop;