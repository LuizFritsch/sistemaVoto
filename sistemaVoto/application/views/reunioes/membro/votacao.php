<?php
?>

<div style=" text-align: center;">
<br>
<form action="mandar_voto" method="POST">
    <div id="div_voto">
        <br>
        <h3><?= $item[0]['descricao'] ?>.</h3>
        <br>
        <div id="opcoesvoto">
            <?php foreach ($opcoes as $opcao) : ?>
            
                <input id="opcao<?= $opcao['opcao'] ?>" type="radio" name="opcaoVotada" value="<?= $opcao['opcao'] ?>"> <label for="opcao<?= $opcao['opcao'] ?>"><?= strtoupper($opcao['opcao']) ?></label><br>
            
            <?php endforeach ?>
        </div>
    <br><br>
    <button id="bt_votar" type="submit" onclick="alert('Deseja realmente votar nesta opção?')">Votar
    </button>
    <br><br>
    </div>
    <input style="visibility: hidden" name="id_item" value="<?= $item[0]['id_pauta'] ?>">
</form>
</div>