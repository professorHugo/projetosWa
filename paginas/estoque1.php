<?php
  $combustiveis = array(1=>"FLEX",2=>"GASOLINA",3=>"ÁLCOOL",4=>"DIESEL",5=>"GÁS NATURAL",6=>"ELÉTRICO");

  // total de linhas da busca
  $buscaQuery = "SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE 1 = 1";
?>

        <style media="screen">
          tr td {
            width: auto;
          }
          td:first-child {
            text-align: center;
            font-size: 1.4em;
          }
          option, select {
            text-transform: uppercase;
          }
          .table-responsive {
            margin-top: 1em;
          }
          .print_cons {
            display: none;
          }
          .consignado {
            background-color: #AAA !important;
            -webkit-print-color-adjust: exact !important;
          }

          @media (max-width: 992px) {
            body {
              max-width: 100%;
            }
            .form_search input, .form_search select {
              margin: 1em auto !important;
              width: 100% !important;
            }
          }
        </style>
        <div class="breadcrumb no-print">
            <div class="container carros">
                <h1>
                  Estoque de Veículos
                </h1>
                <hr>
            </div>
        </div>
        <div class="container no-print">
          <div class="search d_table">
              <form action="" class="form-inline form_search" method="get">
                  <h1>Ordenar</h1>
                  <select name="orderBy" class="form-control">
                    <option value="marca_asc">Marca - Crescente</option>
                    <option value="marca_desc">Marca - Decrescente</option>
                    <option value="v.anofab_asc">Ano Fabricação - Crescente</option>
                    <option value="v.anofab_desc">Ano Fabricação - Decrescente</option>
                    <option value="v.anomod_asc">Ano Modelo - Crescente</option>
                    <option value="v.anomod_desc">Ano Modelo - Decrescente</option>
                    <option value="v.preco_asc">Preço - Crescente</option>
                    <option value="v.preco_desc">Preço - Decrescente</option>
                    <option value="v.cor_asc">Cor - Crescente</option>
                    <option value="v.cor_desc">Cor - Decrescente</option>
                  </select>
                  <button name="btnOrder" type="submit" class="btn_search trans3" value="1">ORDERNAR</button>
                  <button class="btn_search trans3" type="button" name="print" onclick="window.print(); return 0;">IMPRIMIR</button>
              </form>
          </div>
        </div>
        <div id="section-to-print" class="container-fluid">
          <!-- <img src="img/campovel-logo.jpg" alt="" class="img-responsive print_logo"> -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th style="width:30px;">Foto</th>
                          <th>Veículo</th>
                          <th>Ano</th>
                          <th>Valor</th>
                          <th>Combustível</th>
                          <th>Portas</th>
                          <th>Cor</th>
                          <th>Repasse</th>
                          <th class="print_cons">Consignado</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $veiculos = array();
                        if (isset($_GET['orderBy']) && $_GET['orderBy'] != 'marca_asc' && $_GET['orderBy'] != 'marca_desc') {
                          $get = explode('_', $_GET['orderBy']);
                          $by = $get[0];
                          $order = $get[1];
                          $veiculosQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE 1 = 1 ORDER BY $by $order");
                        } else {
                          $get = explode('_', $_GET['orderBy']);
                          $by = $get[0];
                          $order = $get[1];
                          $veiculosQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE 1 = 1 ORDER BY CONCAT(mc.nome, ' ', md.nome, ' ', v.versao) $order");
                        }
                        $veiculosDir = "./uploads/veiculos/";

                        $numRows = mysql_num_rows($veiculosQuery);

                        while ($veiculo = mysql_fetch_assoc($veiculosQuery)) {
                          array_push($veiculos, $veiculo);
                        }

                        foreach($veiculos as $veiculo) {
                      ?>
                        <tr class="<?php echo ($veiculo['consignado'] == 1 ? 'consignado' : ''); ?>" <?php echo ($veiculo['consignado'] == 1 ? "style='background-color:#AAA;-webkit-print-color-adjust: exact !important;'" : ''); ?>>
                          <?php
                            $id = $veiculo['id'];
                            $rs_imagens = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
                            $ln_imagens = mysql_fetch_assoc($rs_imagens);

                            if (mysql_num_rows($rs_imagens) <= 0) { ?>
                            <td><i class="fa fa-ban" aria-hidden="true"></i></td>
                          <?php } else { ?>
                            <td><i class="fa fa-camera" aria-hidden="true"></i></td>
                          <?php } ?>
                            <td><div><a class="callModal" style="color:inherit;" href="javascript:void(0)" data-id="<?=$veiculo['id']?>" data-toggle="modal" data-target="#myModal"><?=mb_strtoupper($veiculo['marcaNome']." ".$veiculo['modeloNome']." ".$veiculo['versao'])?></a></div></td>
                            <td><?=$veiculo['anomod']?></td>
                            <td><b>R$ <?=number_format($veiculo['preco'], 2, ',', '.')?></b></td>
                            <td><?php echo $combustiveis[$veiculo['combustivel']]?></td>
                            <td style="white-space:nowrap;"><?=$veiculo['portas']?> portas</td>
                            <td><?=$veiculo['cor']?></td>
                            <td><?php echo ($veiculo['repasse'] == 0 ? 'Não' : 'Sim'); ?></td>
                            <td class="print_cons" style="text-align:center"><?php echo ($veiculo['consignado'] == 1 ? 'Sim' : ''); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
             </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Ficha do Veículo</h3>
              </div>
              <div id="modalDiv" class="modal-body">
                <!-- <img class="img-responsive" src="img/campovel-ficha-logo2.png" alt=""> -->
                <img src="img/campovel-logo.jpg" alt="" class="img-responsive print_logo">
                <h4 class="">Ficha do Veículo</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn_search trans3 pull-left" data-dismiss="modal">Fechar</button>
                <button id="printModal" type="button" class="btn_search trans3">Imprimir</button>
              </div>
            </div>
          </div>
        </div>
