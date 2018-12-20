<?php
session_start();
include_once('application\controllers\reunioesmembro.php');
$membro = $this->session->userdata('sessao');
$ctrlMembro = new ReunioesMembro();
$id_membro = $this->controllers->reunioesembro->busca_id_membro($membro);
$reunioes = $ctrlMembro->get_reunioes_membro($id_membro);
$_SESSION['reunioes_meliante'] = $reunioes;
?>
<div class="container panel-body row">
    <!-- Modal -->
    <div class="panel-body">
        <div class="container" >

            <div class="container">
                <h2 class="text-center">Reuniões do Conselho Universitário (CONSUNI)</h2>
                <h3 class="text-center">Membro: Membro Genérico</h3>
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


                            <form action="reunioes/abrir/<?php echo $id_membro ?>" method="post">
                                <?php //var_dump($r->getAberta());//var_dump(!(new DateTime($r->getInicio()) < new DateTime() AND new DateTime($r->getFim())) < new DateTime() );var_dump(new DateTime($r->getFim()));var_dump(new DateTime());?>
                                <tr>
                                    <td><?php echo $r->getId();?><input class="invisible" style="width: 0px" name="id_reuniao" value="<?php echo $r->getId();; ?>"> </input></td>
                                    <td><?php echo $r->getInicioFormatado();  ?><input class="invisible" style="width: 0px" name="data_hora_inicio" value="<?php echo print_r($r->getInicio()); ?>"> </input></td>
                                    <td><?php echo $r->getFimFormatado();  ?><input class="invisible" style="width: 0px" name="data_hora_fim" value="<?php echo print_r($r->getFim()); ?>"> </input></td>
                                    <td><?php echo $r->getTipo() ?><input class="invisible" style="width: 0px" name="tipo" value="<?php echo $r->getTipo(); ?>"> </input></td>
                                    <td><?php echo $r->getComissao() ?><input class="invisible" style="width: 0px" name="comissao" value="<?php echo $r->getComissao(); ?>"> </input></td>
                                    <td><?php echo $r->getModerador() ?><input class="invisible" style="width: 0px" name="nome" value="<?php echo $r->getModerador(); ?>"> </input></td>
                                    <td><?php echo $r->getSala() ?><input class="invisible" style="width: 0px" name="sala" value="<?php echo $r->getSala(); ?>"> </input></td>
                                    <td><?php echo $r->getAberta() == 1 ? '<p class="alert-success text-center">ABERTA</p>' : ' <p class="alert-danger text-center"> FECHADA </p>';  ?></td>
                                    <input class="invisible"  style="width: 0px" name="is_openable" value="<?php echo $r->isOpenable(); ?>"> </input>
                                    <td>
                                        <button type="submit" class="btn btn-success" <?php if(!$r->getAberta() == 1){echo 'disabled';}?>>ENTRAR</button>
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
