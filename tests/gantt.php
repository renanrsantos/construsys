<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/jquery.gantt.css"/>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/jquery.gantt.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="gantt"></div>
        </div>
        <script>

        $(function() {
            "use strict";
            $(".gantt").gantt({
                source: 'data.php',
                scale: "days",
                navigate: "scroll",
                dow: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                months: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                waitText: "<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Carregando",                
            });
        });
    </script>
    </body>
</html>
