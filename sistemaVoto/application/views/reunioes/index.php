<div class="container panel-body row" style="margin: 0 auto">
    <!-- Modal -->

    <div class="panel-body">
        <div class="container" >
            <div class="container">
                <h2 class="text-center">Reuniões do Conselho Universitário (CONSUNI)</h2>
                <div class="table-responsive form-group">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr class="alert-success">
                            <th>ID</th>
                            <th>INÍCIO</th>
                            <th>LIMITE</th>
                            <th>TIPO</th>
                            <th>COMISSÃO</th>
                            <th>MODERADOR</th>
                            <th>SALA</th>
                            <th>SITUAÇÃO</th>
                            <th>AÇÃO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php // var_dump($reunioes);?>
                        <?php foreach ($reunioes as $r): ?>
                            <?php echo $msg_erro!='';?>

                            <form action="detalhes" method="post">
                                <?php //var_dump($r->getAberta());//var_dump(!(new DateTime($r->getInicio()) < new DateTime() AND new DateTime($r->getFim())) < new DateTime() );var_dump(new DateTime($r->getFim()));var_dump(new DateTime());?>
                                <tr>
                                    <td><?php echo $r['id_reuniao'];?><input class="invisible" style="width: 0px" name="id_reuniao" value="<?php echo $r['id_reuniao'] ?>"> </input></td>
                                    <td><?php echo $r['data_hora_inicio'];  ?><input class="invisible" style="width: 0px" name="data_hora_inicio" value="<?php echo $r['data_hora_inicio']?>"> </input></td>
                                    <td><?php echo $r['data_hora_fim'];  ?><input class="invisible" style="width: 0px" name="data_hora_fim" value="<?php echo print_r($r['data_hora_fim']) ?>"> </input></td>
                                    <td><?php echo $r['tipo'] ?><input class="invisible" style="width: 0px" name="tipo" value="<?php echo $r['tipo'] ?>"> </input></td>
                                    <td><?php echo $r['comissao'] ?><input class="invisible" style="width: 0px" name="comissao" value="<?php echo $r['comissao'] ?>"> </input></td>
                                    <td><?php echo $r['id_moderador'] ?><input class="invisible" style="width: 0px" name="nome" value="<?php echo $r['id_moderador'] ?>"> </input></td>
                                    <td><?php echo $r['sala'] ?><input class="invisible" style="width: 0px" name="sala" value="<?php echo $r['sala']; ?>"> </input></td>
                                    <td><?php echo $r['is_aberta'] == 1 ? '<p class="alert-success text-center">ABERTA</p>' : ' <p class="alert-danger text-center"> FECHADA </p>';  ?></td>
                                    <input type="text" 
                                    style="
                                    visibility: hidden;
                                    position: fixed;
                                    top: -9999px;
                                    left: -9999px;"
                                    name="is_openable" value="<?php echo $r['is_aberta'] ?>">

                                    <td>
                                        <input  type="submit" name="botao_logar"
                                        <?php
                                         if ($r['is_aberta']==0) {
                                            
                                            date_default_timezone_set('America/Sao_Paulo');
                                            if ((date("Y-m-d H:i:s") >= $r['data_hora_inicio']) && (date("Y-m-d H:i:s") <= $r['data_hora_fim'])) {
                                                echo 'style="border: none; color: white; background-color: #009045; cursor: pointer;"';
                                                echo 'value="ABRIR"';
                                            } else {
                                                echo 'style="border: none; color: black; background-color: grey; cursor: default;"';
                                                echo 'value="ABRIR" ';
                                                echo 'disabled';
                                            }
                                         } else {
                                            echo 'style="border: none; color: white; background-color:#1e90ff ; cursor: pointer;"';
                                            echo 'value="ENTRAR"';
                                         }

                                         ?> >
                                    </td>

                                </tr>
                            </form>

                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Ops!</h4>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $msg_erro?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok...</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        if(<?php echo ($msg_erro!='');?>) {
            $('#myModal').modal('show');
        }
    });
</script>
