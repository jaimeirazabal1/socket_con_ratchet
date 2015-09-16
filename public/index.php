
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos_chat.css">
</head>
<body>

<?php session_start(); ?>
<?php session_destroy() ?>
<?php if (isset($_POST['usuario']) and isset($_POST['password'])): ?>
    <?php if (!empty($_POST['password']) and $_POST['password'] == "administrador"): ?>
        <?php $_SESSION['usuario'] = 'Administrador' ?>
    <?php elseif(empty($_POST['password'])): ?>
        <?php $_SESSION['usuario'] = ucfirst($_POST['usuario']) ?>
    <?php endif ?>
<?php endif ?>
    
<?php if (isset($_SESSION['usuario']) ): ?>
    <script>
    var conn = new WebSocket('ws://localhost:3333');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e);
        console.log(e.data);
        ventana = document.getElementById('ventana').innerHTML + e.data;
        document.getElementById('ventana').innerHTML = ventana + "<br>";
        console.log(ventana + "<br>")
    };
    window.onload = function(){

        var button = document.getElementById("click");

        button.addEventListener('click',function(){
            var texto = document.getElementById('texto').value;
            conn.send("<?php echo $_SESSION['usuario'] ?>"+" : "+texto);
            document.getElementById('texto').value = '';
        },false);

    }
    </script>
<?php endif ?>
    <!-- Codigo por http://adan-2994.es.tl/Xat_flotante_Efecto.htm -->

    <script type="text/javascript" src="http://disemuchonet.blogcindario.com/ficheros/jquery-1-4-2-min.js">
    </script>

    <script type="text/javascript">
//<![CDATA[
var j = jQuery.noConflict();
j(function (){
    j(".esthela").hover(function(){
        j(".esthela").stop(true, false).animate({right:"0"},"medium");
    },function(){
        j(".esthela").stop(true, false).animate({right:"-400"},"medium");
    },500);
    return false;
});
//]]>
</script>
<?php if (isset($_SESSION['usuario']) ): ?>
<div class="esthela" style="right: -400px;">
    <div style="color: rgb(255, 255, 255); padding: 8px 5px 0pt 50px;">
        <div class="disemucho.jimdo.com">
            <div id="ventana" style="background-color:white;padding:10px;border-radius:10px;height:270px;overflow:scroll;color:black">

            </div>
            <button id="click">Enviar</button>
            <input type="text" id="texto" style="width:330px">
        </div>
    </div>
</div>
<?php else: ?>
    <div class="esthela" style="right: -400px;">
        <div style="color: rgb(255, 255, 255); padding: 8px 5px 0pt 50px;">
            <div class="disemucho.jimdo.com">
                <form action="" method="POST">
                    <input type="text" name="usuario">
                    <input type="password" name="password">
                    <input type="submit" value="Entrar">                    
                </form>
            </div>
        </div>
    </div>
<?php endif ?>

</body>
</html>
