<?php
include_once('application\models\pautaModel.php');
include_once('application\controllers\pautas.php');
$id_Pauta = $_POST['id_reuniao'];
$pautasCtrl = new Pautas();
$pauta_ativa = $pautasCtrl->get_pauta_ativa($id_Pauta);

?>

<?php if ($pauta_ativa == null): ?>
    <div class="container panel-body row center-block">
        <!-- Modal -->
        <div class="panel-body" style="text-align: center">
            <h1>Aguarde o inicio da reunião</h1>
        </div>
    </div>

<?php else: ?>
    <div class="container panel-body row center-block">
        <!-- Modal -->
        <div class="panel-body left" style="text-align: center">
            <h1><?= $pauta_ativa->getTitulo() ?></h1>
            <h2><?= $pauta_ativa->getDescricao() ?></h2>

            <form action="../submeter_voto" method="post">
                <div class="btn-group-vertical">
                    <?php foreach ($pauta_ativa->getOpcoesDeVoto() as $key => $op): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="id_voto" id="<?='exampleRadios'.$key?>" value="<?= $key ?>">
                            <label class="form-check-label" for="<?='exampleRadios'.$key?>" name='opcao' value="<?= $op ?>">
                                <?= $op ;?>
                            </label>

                        </div>
                    <?php endforeach ?>
                </div>
                <br>
                <button class="btn btn-primary btn-success" type="submit">Submeter voto</button>

            </form>


        </div>

    </div>
<?php endif; ?>
