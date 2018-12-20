<?php /*print_r($_POST);*/
include_once('application\models\pautaFactory.php');
include_once('application\models\pautaModel.php');
include_once('application\controllers\pautas.php');

$ctrlR = new Reuniao();
$ctrlR->update_reuniaoModel($_POST['id_reuniao']);
$ctrlP = new PautaFactory();
$pautas = $ctrlP->get_Pautas($_POST['id_reuniao']);

/*print_r($pautas);*/
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
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse blandit euismod
                                neque vel ultricies. Aenean fringilla sapien sit amet vulputate maximus. Proin turpis
                                risus, luctus eget volutpat non, convallis id libero. Nam iaculis id tellus non feugiat.
                                Phasellus tincidunt mattis urna et sagittis. Integer porta ipsum vel metus pretium, eget
                                facilisis neque blandit. Suspendisse pellentesque blandit magna, in semper quam congue
                                nec. Donec odio sapien, fermentum sit amet consectetur nec, semper tincidunt nisi.
                                Aliquam vitae nulla orci. Aliquam lectus eros, scelerisque eget porta et, ultricies
                                pulvinar libero.</p>
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

    <script>

        var idPautaInsert = <?php echo $p->getId() ?>;

        $(function () {
            $('#radioButDefault').click();
        });


        $('#radioButDefault').click(function () {
            $('#add_opt').css('visibility', 'hidden');
            var tabela = $('#options-table');
            tabela.children().remove();
            tabela.append('<tbody>' +
                '<tr>' +
                '<td>Abstencao</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Favoravel</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Contrario</td>' +
                '</tr>' +
                '</tbody>');
        });

        $('#radioButCustom').click(function () {
            $('#options-table').children().remove();
            $('#add_opt').css('visibility', 'visible');

            rowFac(true);
        });
        $('#add_opt_button').click(function () {
            var jaExiste = false;
            var texto = $('#new_opt_text').val();
            if (texto == '') return false;
            $(".added-opt").each(function(i){
                if($(this).text() == texto) {
                    jaExiste = true;
                }
            });
            if (jaExiste) return false;
            $('#options-table').append('<tr>' +
                '<td><span type="text" class="added-opt input-borderless">' + texto + '</span><td>' +
                '<td> <button class="glyphicon glyphicon-trash"/></td>' +
                '</tr>');

            $('.glyphicon-trash').click(function () {
                $(this).parent().parent().remove();
            });

            $('#new_opt_text').val("");
        });

        function rowFac(first = false, placeHolderText = 'Opção para voto', tab) {
            var tabela = $('#options-table');

            if (first) {
                tabela.append('<tr>' +
                    '<td>Abstenção</td>' +
                    '</tr>');
            }

        }

        //PAUTAS --------------------------------------------------

        function getListaPautas() {
            return <?php echo json_encode($pautas, JSON_FORCE_OBJECT);?>
        }

        $('.pauta-button').click(function () {
            var pautas_json = getListaPautas();
            var pauta_selecionada = null;
            var size = Object.keys(pautas_json).length;
            // console.log($(this).attr('id'));
            for (let i = 0; i < size; i++){
                if(pautas_json[i].id == $(this).attr('id')){
                    pauta_selecionada = pautas_json[i];
                    //console.log(i);//pautas_json[i].id == $('.pauta-button').attr('id'));
                    break;
                }
            }
            console.log($('#texto-descricao').val());
            $('#texto-relator').text(pauta_selecionada.nomeRelator);
            $('#texto-item').text(pauta_selecionada.titulo);
            $('#texto-descricao').text(pauta_selecionada.descricao);
            idPautaInsert = pauta_selecionada.id;
        });

        //Contando opções de voto na tabela
        $(document.body)
            .click(function() {
                var n = $( "tr" ).length;
                $( "h1" ).text( "Este tipo tem " + n + " opções de voto");
            })
            .trigger("click");

        function storeHTMLTblValues()
        {
            var TblVotos = new Array();

            $('#options-table tr').each(function(row, tr){
                TblVotos[row]={
                    "idPauta" : idPautaInsert.toString(),
                    "opVoto"  : $(tr).find('td:eq(0)').text()
                }
            });
            return TblVotos;
        }

        function sendJson(){
            var TblVotos;
            TblVotos = JSON.stringify(storeHTMLTblValues());

            /*console.log(TblVotos);*/

            $.ajax({
                type: 'post',
                url: 'pautas/gravarOpcaoVotos',
                dataType: "json",
                data: {votos:TblVotos}
            });

            window.location.replace('votacao/esperamod');
        }

        function print_r(arr,level) {
            var dumped_text = "";
            if(!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for(var j=0;j<level+1;j++) level_padding += "    ";

            if(typeof(arr) == 'object') { //Array/Hashes/Objects
                for(var item in arr) {
                    var value = arr[item];

                    if(typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' \n";
                        dumped_text += print_r(value,level+1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                    }
                }
            } else { //Stings/Chars/Numbers etc.
                dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
            }
            return dumped_text;
        }


    </script>

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