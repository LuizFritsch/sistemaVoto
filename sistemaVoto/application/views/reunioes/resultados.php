<?php 

?>

<div id="div_resultado">


    <div id="bloco_resultado">
        <h2 style="color: green; font-weight: bolder;"><?php echo $opcaoVencedora?></h2>        
    </div>


    <table id="tabela_votos" class="table table-bordered table-striped">
        <thead>
        <tr class="alert-success" style="font-weight: bolder; color: green;">
            <td class="tg-lrvc">NOME</td>
            <td class="tg-lrvc">VOTO</td>
        </tr>
        </thead>
        <?php foreach ($listaVoto as $voto) : ?>
            <tr>
                <td><?= $voto['nome'] ?></td>
                <td><?= $voto['opcao'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <table id="tabela_resultado" class="table table-bordered table-striped">
        <thead>
        <tr class="alert-success" style="font-weight: bolder; color: green;">
            <td class="tg-lrvc">OPÇÃO DE VOTO</td>
            <td class="tg-lrvc">PORCENTAGEM</td>
        </tr>
        </thead>

        <?php foreach ($listaOpcoes as $opcao) : ?>
            <tr>
                <td><?= $opcao['opcao'] ?></td>
                <td><?= $opcao['porcentagem'] ?>%</td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
