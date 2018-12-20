<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="pt-br" lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MÓDULO GURI</title>
    <!-- BOOTSTRAP -->
    <!-- < ?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>   -->
    <!-- < ?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>     -->
    <!-- < ?php echo base_url('assets/bootstrap/js/jquery.min.js')?>        -->
    <link rel="stylesheet" href=<?php echo base_url("assets/bootstrap/css/bootstrap.css");?>>

    <!-- JAVASCRIPT -->
    <!-- ../../../assets/bootstrap/js/jquery.min.js -->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //<![CDATA[
        (window.jQuery)||document.write('<script type="text/javascript" src="../../../assets/bootstrap/js/jquery.min.js"><\/script>');//]]>
    </script>
    <script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"></script>

    <!-- FONTAWESOME -->
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">-->
    <link rel="stylesheet" href="assets\fontawesome\css\all.css">

    <!-- url(public/themes/moder/imgs/fundo.jpg) -->
    <style rel="stylesheet">
        body { background: #f4f4f4 repeat-x; }
        .barrinha-superior {
            width: 100%;
            height: 6px;
            background: #009045;
        }
        #nav-superior li a {
            padding:2px 4px;
        }
        #nav-superior li a:hover {
            color:#00f;
        }
        #barra1 { background: #f4f4f4; padding: 10px} <!-- #009045 -->
        .texto-logo {
            font-size: 120%;
            color:#fff;
        }
        #barraPrincipal {
            margin-bottom:4px;
            background:#009045!important;
        }
        #barraPrincipal li a {
            font-size:100%;
            text-transform:uppercase;
            padding:5px;
            color:#fff;
        }
        a:hover {
            text-decoration:none;
        }
        #bt_votar {
            background-color: #009045; color: white; padding: 10px 30px; border: none;
        }

        #opcoesvoto {
            text-align: left; display: inline-block; margin: 0 auto;
        }

        #div_voto {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 50%; margin: 0 auto; background-color: white;
        }

        #div_login {
            width: 30%; margin: 0 auto;
        }

        #div_resultado {
            width: 60%; text-align: center; margin: 0 auto; background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-top: 5px;

        }
        @media screen and (max-width: 600px) {
            .navbar {
                min-height:100%;
                margin:0;
                border:none;
                box-shadow:none;
            }
            .navbar li a {
                color:#333;
            }

            #barraPrincipal li ul li a {
                color:#333;
            }
            #div_voto {
                width: 100%;
            }
            #div_login {
            width: 90%; margin: 0 auto;
            }
        }
        .rodape {
            margin: auto;
            width: 100%;
            bottom: 0;
            /*position: fixed;*/
        }
    </style>

</head>

<body> <!-- class="container" -->
<div class="container" style="width: auto;">

    <div class="barrinha-superior"></div>

    <div class="row">
        <div class="col-lg-12">
            <div id="barra1"><img class="img-responsive col-ls-12" src=<?php echo base_url("public/themes/moder/imgs/cabecalho.jpg"); ?> alt="logo GURI">

                <form class="navbar-form navbar-right" role="menu_direita">
                    <!-- <div id="barra1"><img src="public/themes/moder/imgs/marca.png" alt="logo GURI"> -->
                </form>
            </div> <!-- /#barra1 -->
        </div>
    </div> <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barraPrincipal">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="#" data-toggle="collapse" data-target="#barraPrincipal">Menu</a>
                </div>

                <div class="collapse navbar-collapse" id="barraPrincipal">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h4>ADMINISTRATIVO <span class="fas fa-angle-right"></span></h4></a>
                            <ul class="dropdown-menu dropdown-menu" role="menu">
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Java</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h4>ACADÊMICO <span class="fas fa-angle-right"></span></h4></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Java</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h4>SISTEMA <span class="fas fa-angle-right"></span></h4></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Java</a></li>
                            </ul>
                        </li>

                        <?php
                        $nomeMembro = $this->session->userdata('sessao');
                        if (!empty($nomeMembro)){
                            echo ' <li>';
                            echo '<a href="'.base_url('inicio').'" class="dropdown-toggle" role="button" ><h4>HOME <span class="fas fa-angle-right"></span></h4></a>';
                            echo '</li>';

                            echo '<li class="dropdown">';
                            echo '<a href="'.base_url('reunioes').'" class="dropdown-toggle" role="button" aria-expanded="false"><h4>REUNIAO <span class="fas fa-angle-right"></span></h4></a>';
                            echo '</li>';

                            echo '<li class="dropdown">';
                            echo '<a href="#" class="dropdown-toggle" style="
                            pointer-events: none;
                            cursor: default; 
                            text-decoration: none;" 
                            role="button" aria-expanded="false"><h4>'.strtoupper($nomeMembro).' <span class="fas fa-angle-right"></span></h4></a>';
                            echo '</li>';

                            echo ' <li>';
                            echo '<a href="'.base_url('logout').'" class="dropdown-toggle" role="button" ><h4>LOGOUT <span class="fas fa-angle-right"></span></h4></a>';
                            echo '</li>';
                        }
                        ?>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div> <!-- /.row -->
</div> <!-- /.container -->
<script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    //<![CDATA[
    (window.jQuery)||document.write('<script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"><\/script>');//]]>
</script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>