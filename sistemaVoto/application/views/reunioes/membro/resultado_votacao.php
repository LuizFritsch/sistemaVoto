<?php
?>

<?php if (true): ?>

    <div class="container panel-body row center-block">
        <!-- Modal -->
        <div id="teste"></div>
        <div class="panel-body" style="text-align: center">
            <h1>Aguarde a votação...</h1>
            <form action="votacao_iniciada" method="post">
                <input style="visibility: hidden;" name="id_item" id="idItem" type="text" value="" >
                <button type="submit" style="visibility: hidden" id="botao_invisivel"></button>
            </form>
        </div>
    </div>

    <script>
        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("servidor");
            source.onmessage = function(event) {
                if(event.data !== 'false'){
                    document.getElementById('idItem').value = event.data;
                    if(window.confirm('A votação foi iniciada!')){
                        document.getElementById('botao_invisivel').click();
                    }
                }
            };
        } else {
            document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
        }
    </script>

<?php else: ?>
    <h1>FODASE</h1>
<?php endif; ?>
