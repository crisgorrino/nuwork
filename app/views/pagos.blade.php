@extends('layout')
@section('content')
<section class="container cf pdd2" ng-app="app">    
    <section class="inner" ng-controller="Pago">
        <!--metodo de pago-->
        <div class="metodos-d-pago">
            <h2>Confirmaci&oacute;n de pedido</h2>
            <h3>M&eacute;todo de pago</h3>
            <div class="metodo-cred cf">
                <label for="paypal">
                    <img src="<?php echo asset('img/paypal.jpg') ?>" alt="">
                    <p class="right">Pago con tarjeta de credito:</p>
                    <input id="paypal" type="radio" name="metodo" class="left" ng-model="metodo" value="credito">
                    <img src="<?php echo asset('img/tarjeta-cred.jpg') ?>" alt=""> 
                </label>
                <label for="banco">
                    <img src="<?php echo asset('img/blank.jpg') ?>" alt="">
                    <p class="right">Pago con tarjetas de débito emitidas por:</p>
                    <input id="banco" type="radio" name="metodo" class="left" value="debito"  ng-model="metodo" class="left">
                    <img src="<?php echo asset('img/tarjeta-deb.jpg') ?>" alt="" class="right">
                </label>
            </div>
            
            <div class="metodo-trans cf">
                <label for="metodo-cred cf">
                    <img src="<?php echo asset('img/hsbc.jpg') ?>" alt="">
                    <p class="right">Dep&oacute;sito o transferencia bancaria</p>
                    <input id="transferencia" type="radio" name="metodo" class="left"  ng-model="metodo" value="transferencia">
                </label>
            </div>
        </div>
        <!--metodo de pago-->   
    
        <!--totales-->
        <section class="totales cf">
            <span>TOTAL</span>
            <p id="ajax_gran_total">$<?php echo number_format($total) ?> MXN</p>
            <% metodo %>
            <?php echo Form::open() ?>
                <input type="hidden" name="metodo" value="<% metodo %>">
                <input type="submit" class="confirm-btn" value="Continuar">
            <?php echo Form::close() ?>
            <ul>   
                <li>El precio es la suma de todas las personas.</li>
                <li>El pago es por anticipado.</li>
                <li>Al momento que no se cumpla la forma de pago especificada anteriormente, se les negará el acceso.</li>
                <li>Se les entregará un contrato al firmar el día que se haga el pago.</li>
                <li>Firmar el reglamento y cumplirlas en todo momento.</li>
            </ul>
        </section>
        <!--totales-->
    </section>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/PagoController.js') ?>"></script>
 @stop