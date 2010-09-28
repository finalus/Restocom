<?php
echo $html->css('css_home_restoranes');
echo $javascript->link('jquery-latest.min');
?>
    <div class="contenido" align="center">
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_inventario.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Inventario</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_cotizar.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Cotizar</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_comprar.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Comprar</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_recepcion.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Recepci&oacute;n</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_seguimiento.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Seguimiento</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_pagos.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Pagos</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_facturas.png">
                <div class="texto" align="center">
                    <span class="cont2">
                        <span class="link2">&Oacute;rdenes de Compra</span>
                    </span>
                </div>
            </div>
        </span>
        <span class="content" align="center">
            <div class="caja" align="center">
                <img src="/img/btn_reportes.png">
                <div class="texto" align="center">
                    <span class="cont">
                        <span class="link">Reportes</span>
                    </span>
                </div>
            </div>
        </span>
    </div>
<script>
  $(".caja").mouseover(function() {
   $(this).removeClass("caja").addClass("cajaOver");
  }).mouseout(function(){
    $(this).removeClass("cajaOver").addClass("caja");
  });

</script> 
