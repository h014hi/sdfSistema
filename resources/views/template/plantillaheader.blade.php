<div id="header">
    <img class="imgHeader" src="{{asset('image/logopuno.png')}}" alt="">
    <div class="infoHeader">
        <p><b>DIRECCION REGIONAL DE TRANSPORTES Y COMUNICACIONES PUNO</b></p>
        <p><b>DIRECCION DE CIRCULACION TERRESTRE</b></p>
        <p><b>SUBDIRECCION DE FISCALIZACION</b></p>
    </div>
    <img class="imgHeader2" src="{{asset('image/drtc.jpg')}}" alt="">
</div>

<!-- *********************ESTILOS******************-->
<style>
    @page{
        margin:4cm 1cm 0cm 1cm;
    }
    #header{
        position: fixed;
        top: -4cm;
        left: 0cm;
        width: 100%;
    }
    .imgHeader{
        float: left;
        width: 3cm;
    }
    .imgHeader2{
        margin-top: 20px;
        width: 3cm;
        right: 0cm;
    }
    .infoHeader{
        float: left;
        margin-left: 1cm;
        font-size: 0.8em;
        text-align: center;
        margin-top:10px;
    }
</style>
