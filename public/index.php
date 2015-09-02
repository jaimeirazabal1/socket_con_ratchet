
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
    </head>
    <body>
<?php session_start() ?>

<?php if (isset($_POST['nu']) and isset($_POST['pass'])): ?>
    <?php 
        $_SESSION['usuario'] = array(
                                'usuario'=>$_POST['nu'],
                                'pass'=>$_POST['pass']
                                );

     ?>
<?php endif ?>
<?php if (!isset($_SESSION['usuario'])): ?>
        <p>
            <form action="" style="width:80%;margin:auto" method="POST">
                <p><label for="">Nombre de Usuario</label></p>
                <p><input type="text" name="nu"></p>
                <p><label for="">Contraseña</label></p>
                <p><input type="password" name="pass"></p>
                <p><input type="submit"></p>
            </form>
        </p>
<?php else: ?>
        <script>
            var conn = new WebSocket('ws://localhost:3333');
            conn.onopen = function(e) {
                console.log("Connection established!");
            };

            conn.onmessage = function(e) {
                console.log(e);
                console.log(e.data);
                ventana = document.getElementById('ventana').innerHTML + e.data;
                document.getElementById('ventana').innerHTML = ventana;
            };
            window.onload = function(){
                
                var button = document.getElementById("click");

                button.addEventListener('click',function(){
                    var texto = document.getElementById('texto').value;
                    conn.send(texto+"<br>");
                },false);
           
            }
        </script>
        <div>TODO write content</div>
        <button id="click">Send Message!</button>
        <input type="text" id="texto">
        <p id="ventana" style="margin:10px auto;width:50%;border-radius:10px;height:200px;border:1px solid black">
            
        </p>
<?php endif; ?>
    </body>
</html>
