<?php
?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-sm-3">
            <h3 class="panel-heading btn-block btn-success text-center" style="background:#009045">PAUTAS</h3>
            <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-pills nav-stacked well">

                <?php foreach ($pautas as $p): ?>

                    <li><a id="<?= $p->getId(); ?>" class="pauta-button btn-success" href="#" data-toggle="tab"><span
                                    class="fas fa-hashtag"></span> <?php echo $p->getTitulo(); ?> </a></li>
                <?php endforeach ?>

            </ul>
        </div>

        <div class="col-sm-9">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="vtab1">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-title">
                            <h3 class="text-center">Parecer do Item de Pauta</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Todo conteudo do painel começa aqui!-->
                            <p>testtetttetsttttttttttttttttttttttttsssssssss</p>
                        </div>
                    </div>

                    <div class="well well-lg">
                        <p class="row">
                        <p class="badge"><span class="far fa-user fa-2x"></span></p>
                        <span>Relator</span>: <b id="texto-relator"><?php echo $p->getNomeRelator(); ?></b> </p>
                        <p class="row">
                        <p class="badge"><span class="fas fa-thumbtack fa-2x"></span></p> <span>Item de Pauta</span>: <b id="texto-item"><?php echo $p->getTitulo(); ?> </b></p>
                        <p lass="row">
                        <p class="badge"><span class="fas fa-file-alt fa-2x"></span></p>
                        <span>Descrição</span>: <b id="texto-descricao"><?php echo $p->getDescricao(); ?> </b></p>
                    </div>

                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <label class="radio-inline"> <input type="radio" id="radioButDefault" name="optradio" checked>Votação Simples</label>
                            <label class="radio-inline"> <input type="radio" id="radioButCustom" name="optradio">Votação Customizada</label>
                        </div>

                        <!-- Table -->
                        <form class="form-group">
                            <div id="add_opt" hidden>

                                <input type="text" id="new_opt_text" placeholder="Nova opção de voto...">
                                <button type="button" id="add_opt_button" class="glyphicon glyphicon-ok">

                            </div>

                            <table id="options-table" class="table table-responsive">
                                <div>
                                    <h1 class="badge alert-warning col-lg-4"> </h1>
                                </div>
                            </table>
                            <div class="panel-heading">
                                <button class="btn btn-success" type="button" onclick="sendJson()">Encaminhar para Votação</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        .input-borderless {
            border-width: 0px 0px 2px 0px;
        }

        .input-borderless:disabled {
            background-color: white;
            border: none;
        }

        .glyphicon {
            background-color: white;
            border: none;
        }

        #add_opt {
            visibility: hidden;
            display: inline;
        }

        #new_opt_text {
            margin-left: 1%;
            margin-top: 1%;
            border-width: 0 0 1px 0;
        }

        #add_opt_button {
            position: relative;
            margin-top: 1%;
        }
    </style>