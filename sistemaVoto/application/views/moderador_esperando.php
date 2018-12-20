<?php 

?>

<div style="width: 60%; margin: 0 auto; text-align: center;">
	<form action="resultado_votacao" method="POST">
        <input style="visibility: hidden" name="id_pauta" value="<?= $pauta[0]['id_pauta'] ?>">
		<table class="table table-bordered table-striped">
		    <thead>
		    <tr class="alert-success">
		        <th>PERFIL</th>
		        <th>VOTO</th>
		    </tr>
		    </thead>
		    <tbody>
            <?php foreach ($votos as $vot) : ?>
                <tr>
                    <td><?= $vot['nome'] ?></td>
                    <td><?= $vot['opcao'] ?></td>
                </tr>
            <?php endforeach; ?>
		</table>

		<input style="background-color: red; color: white; padding: 10px; border: none;" type="submit" name="deletar_votacao" value="Cancelar">
		<input style="background-color: #009045; color: white; padding: 10px; border: none;" type="submit" name="encerrar_votacao" value="Encerrar">

	</form>

	<br><br>
</div>
