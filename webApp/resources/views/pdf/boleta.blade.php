<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boleta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <style>
        
        @page {
            /*
            size: portrait;
            
            size: 5in 20in; 
            */
            margin: 0mm;
        }
        *{
            letter-spacing: 1px!important;
        }
        #header, #nav, .noprint
        {
        display: none;
        }
        hr{
            border:0.09px solid #999;
            opacity: 0.3;
        }
        .Scontainer-content{
            margin: 0 auto;
            text-align:center;
            max-width: 226.771654pt;
            min-width: 164.409448pt;
            
        }
        .Sclient-container{
            text-align:left;
        }
        .Sfacture,.Sruc{
            font-weight:bold;
        }
        @media print {
            body{

                letter-spacing: 10px;
                font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            }
            .footer,
            #non-printable {
                display: none !important;
            }
            #printable {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="Scontainer-fluid">
       <div class="Scontainer-content">
        <div>
                <h3>FAGUM</h3> 
            <div>
            <div class="Sdireccion">
                <span>Real n° 234</span>
            </div>
            <div class="Scity">
                <span>Junin</span> -
                <span>Huancayo</span> -
                <span>Huancayo</span>
            </div>
            <div class="Sruc">
                <span>20760379897</span>
            </div>
            <div class="Scontact">
                <span>234323 </span>
            </div>
            <div class="Sdate">
                <span>{{date('d/m/Y')}}</span>&nbsp;
                <span>{{date('h:m:s')}}</span>
            </div>
            <hr>
            <div class="Sfacture">
                @if($comprobante[0]->tipo_comprobante=='01')
                <span>FACTURA ELECTRONICA</span><br>
                @else
                <span>  BOLETA DE VENTA ELECTRONICA</span><br>
                @endif
                <span>{{$serieNum}}</span>
            </div>
            <hr>
            <div class="Sclient-container">
               
                <div class="Sclient-item">
                    
                @if($comprobante[0]->tipo_comprobante=='01')
                    <span>RUC</span>
                    @else
                    <span>DNI</span>
                @endif    
                    :<span>---------</span>
                </div>

                <div class="Sclient-item">
                    <span>NOMBRE</span>:<span>{{$entidad[0]->Usuario}}</span>
                </div>
                <div class="Sclient-item">
                    <span>DIRECCION</span>:<span>---------------</span>
                </div>
                <!--
                <div class="Sclient-item" style="text-align:center;">
                    <span>Junin</span> -
                    <span>Huancayo</span> -
                    <span>El tambo</span>
                </div>
                -->
            </div>    
            <hr>
            <div class="Sdetail-container">
                    <table class="table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th style="padding-left:10px">Cant</th>
                            <th>Precio</th>
                            <th style="text-align: right">Importe</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $subtotal=0;?>
                            @foreach($detalleComprobante as $item)
                            <tr>
                                <td>{{$item->nombre}}</td>
                                <td style="padding-left:10px">{{$item->cantidad}}</td>
                                <td>{{$item->precio}}</td>
                                <td style="text-align: right">{{$item->cantidad*$item->precio}}</td>
                            </tr>
                            <?php $subtotal+=($item->cantidad*$item->precio);?>
                            @endforeach

                            <?php 
                                $gravada=round((($subtotal)/1.18)*100)/100;
                                $igv=round(($gravada*0.18)*100)/100;
                            ?>
                        <tr>
                            <td></td>
                            <td style="font-weight:bold;text-align: right">GRAVADA</td>
                            <td style="font-weight:bold;text-align: right">S/:</td>

                            <td style="text-align: right">{{$gravada}}</td>
                        </tr>
                        <!--
                        <tr>
                            <td></td>
                            <td style="font-weight:bold;text-align: right">SUBTOTAL</td>
                            <td style="font-weight:bold;text-align: right">S/:</td>

                            <td style="text-align: right">{{$subtotal}}</td>
                        </tr>
                        -->
                        <tr>
                            <td></td>
                            <td  style="font-weight:bold;text-align: right">IGV[18]</td>
                            <td style="font-weight:bold;text-align: right">:</td>
                            <td style="text-align: right;text-align: right">{{$igv}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-weight:bold;text-align: right">TOTAL</td>
                            <td style="font-weight:bold;text-align: right">S/:</td>
                            <td style="text-align: right">{{ $subtotal }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="Simporte-container">
                    <span style="font-weight:bold;">IMPORTE EN LETRAS:</span><span></span>
                </div>
                <hr>
                <div class="SVendedor-container">
                    <span>Vendedor(a):</span><span>{{Auth::user()->Usuario}}</span>
                </div>
                <div class="Srepresentacion-container">
                    <span>Representación impresa de la 
                    @if($comprobante[0]->tipo_comprobante=='01')
                        <span>FACTURA ELECTRONICA, visita</span>
                        @else
                        <span>BOLETA DE VENTA ELECTRONICA, visita</span>
                    @endif    
                    <br>
                    <span style="font-weight:bold;">www.hoole.com/20760379897/{{$serieNum}}</span>
                </div>
                <div class="SVendedor-container">
                    <span>Autorizado mediante Resolución de Intendencia</span><br>No.<span style="font-weight:bold;">034-005-0005315</span>
                </div>
                <div class="SVendedor-container">
                    <span style="font-weight:bold;">Resumen:</span><span>{{$digestValue}}</span>
                </div>
                <div class="Scodigoqr_container">
                    <img src="{{public_path('comprobantes/qr/'.$serieNum.'.png')}}"/>
                </div>
        </div>
    </div>
    @if($type==1)
    <script type="text/javascript">
        try { this.print(); } catch (e) { window.onload = window.print; } 
        var cancelButton=document.getElementsByClassName('cancel');
        cancelButton[0].addEventListener('click',function(){
            window.close();
            console.log('prueba');
        });
    </script>
    @endif
</body>
</html>