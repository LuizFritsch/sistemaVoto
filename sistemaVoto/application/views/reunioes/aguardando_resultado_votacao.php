<?php
include_once('application\models\pautaFactory.php');
$pautasFac = new PautaFactory();
$votos = $pautasFac->get_resultados(2);
print_r($pautasFac->id_pauta);
$data = array();
$total_votos = count($votos);
foreach ($votos as $v) {
    $o = $v['opcao'];
    $data[$o][] = $v;
}
$grafico = array();
foreach ($data as $k => $d) {
    $grafico[] = array('opcao' => $k, 'y' => (count($d) / $total_votos) * 100);
}
$data = null;
?>

<?php if (false): ?>
    <div class="container panel-body row center-block" xmlns="">
        <!-- Modal -->
        <div class="panel-body" style="text-align: center">
            <h1>Pessoal ainda ta votando</h1>
        </div>
    </div>

<?php else: ?>
    <h1>Resultados</h1>
    <div class="container panel-body row center-block" xmlns="">
        <button class="btn btn-success">Encerrar</button>

        <div class="panel-body" style="margin: 0 25% 0 25%;">
            <table class="table">
                <thead>
                <th scope="col">Nome</th>
                <th scope="col">Voto</th>
                </thead>
                <tbody>
                <?php foreach ($votos as $v): ?>
                    <tr>
                        <td><?= $v['nome'] ?></td>
                        <td><?= $v['opcao'] ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td><span><b>Total</b></span></td>
                    <td><span><b><?= $total_votos ?></b></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart('grafico', {
            animationEnabled: true,
            title: {
                text: 'Resultados da votação'
            },
            data: [{
                type: 'pie',
                indexLabel: '{opcao} ({y}%)',
                dataPoints: <?php echo json_encode($grafico, JSON_NUMERIC_CHECK);?>
            }]
        });
        chart.render();
    }
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>