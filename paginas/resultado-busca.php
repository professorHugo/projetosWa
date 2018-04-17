<?php
  $combustiveis = array(1=>"FLEX",2=>"GASOLINA",3=>"ÁLCOOL",4=>"DIESEL",5=>"GÁS NATURAL",6=>"ELÉTRICO");

  if(isset($_GET['btnBuscar'])) {
    $buscaQuery = "SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE 1 = 1";

    if(isset($_GET['nome']) && $_GET['nome'] != "") {
      $nome = strtoupper($_GET['nome']);
      $buscaQuery .= " AND CONCAT(md.nome, ' ', v.versao) LIKE '%$nome%'";
    }
    if(isset($_GET['marca'])) {
      $marca = $_GET['marca'];
      $buscaQuery .= " AND v.marca = $marca";
    }
    if(isset($_GET['combustivel']) && $_GET['combustivel'] != "") {
      $combustivel = $_GET['combustivel'];
      $buscaQuery .= " AND v.combustivel = '$combustivel'";
    }
    if($_GET['valorMin'] != "") {
      $valorMin = (int)$_GET['valorMin'];
      $buscaQuery .= " AND v.preco >= $valorMin";
    }
    if($_GET['valorMax'] != "") {
      $valorMax = (int)$_GET['valorMax'];
      $buscaQuery .= " AND v.preco <= $valorMax";
    }
    if(isset($_GET['anoModFiltro'])) {
      $anoModFiltro = (int)$_GET['anoModFiltro'];
      $buscaQuery .= " AND v.anomod = $anoModFiltro";
    }
    if(isset($_GET['portasFiltro'])) {
      $portasFiltro = (int)$_GET['portasFiltro'];
      $buscaQuery .= " AND v.portas = $portasFiltro";
    }

    $buscaTotal = mysql_num_rows(mysql_query($buscaQuery));

    // número de linhas exibidas por pag
    $rowsPerPage = 2000;
    // número total de páginas
    $totalPages = ceil($buscaTotal/$rowsPerPage);

    // pega o número da página ou define a atual
    if (isset($_GET['currentPage']) && is_numeric($_GET['currentPage'])) {
      // converte variável para inteiro
      $currentPage = (int)$_GET['currentPage'];
    } else {
      // define a página atual, caso não haja uma
      $currentPage = 1;
    } // fim do if

    // se a página atual for maior que o total de páginas
    if ($currentPage > $totalPages) {
      // define a página atual como última página
      $currentPage = $totalPages;
    } // fim do if
    // se a página atual for menor do que 1/primeira página
    if ($currentPage < 1) {
      // define a página atual como primeira página
      $currentPage = 1;
    } // fim do if

    // define a compensação da lista, com base na página atual
    $offset = ($currentPage - 1) * $rowsPerPage;

    // consulta do banco de dados
    $buscaQuery .= " ORDER BY v.id DESC LIMIT $offset, $rowsPerPage";

    $maisAntigo = mysql_fetch_assoc(mysql_query("SELECT MIN(anomod) FROM veiculos"));
  }
?>
            <!-- </div>
        </div> -->
        <style media="screen">
          option, select {
            text-transform: uppercase;
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
        <div class="breadcrumb">
          <?php #var_dump($_SERVER['REQUEST_URI']); exit; ?>
            <div class="container carros">
                <h1>
                  Busca
                  <?php if(isset($marca)) {
                    $marcaNome = mysql_fetch_assoc(mysql_query("SELECT nome FROM marcas WHERE id = $marca"));
                  ?>
                    <i class="fa fa-angle-right"></i><b><?=$marcaNome['nome']?></b>
                  <?php } ?>
                  <?php if(isset($nome)) {
                    $modeloNome = mysql_fetch_assoc(mysql_query("SELECT nome FROM modelos WHERE id = $nome"));
                  ?>
                    <i class="fa fa-angle-right"></i><?=$nome?>
                  <?php } ?>
                </h1>
                <hr>
            </div>
        </div>
        <?php /*?><div class="container">
          <div class="search d_table">
              <form action="" class="form-inline form_search" method="get">
                  <h1>Buscar</h1>
                  <div class="form-group">
                      <label class="sr-only" for="buscarVeiculo">Buscar Veículos</label>
                      <input name="nome" type="text" class="form-control" id="buscarVeiculo" value="<?php echo (isset($_GET['nome']) ? $_GET['nome'] : '' ); ?>" placeholder="NOME/MODELO">
                  </div>
                  <select name="marca" class="form-control">
                    <option selected="true" disabled>Marca</option>
                  <?php
                    $marcas = array();
                    $marcasQuery = mysql_query("SELECT * FROM marcas WHERE nome <> 'REPASSE' ORDER BY nome");

                    while($marcaCar = mysql_fetch_assoc($marcasQuery)) {
                      array_push($marcas, $marcaCar);
                    }

                    foreach ($marcas as $marcaCar) {
                  ?>
                    <option value="<?=$marcaCar['id']?>" <?php echo ($_GET['marca'] == $marcaCar['id'] ? 'selected' : '' ); ?>><?=$marcaCar['nome']?></option>
                  <?php } ?>
                  </select>
                  <select name="combustivel" class="form-control">
                      <option selected="true" disabled="true">Combustível</option>
                      <option value="1" <?php echo ($_GET['combustivel'] == 1 ? 'selected' : '' ); ?>>FLEX</option>
                      <option value="2" <?php echo ($_GET['combustivel'] == 2 ? 'selected' : '' ); ?>>GASOLINA</option>
                      <option value="3" <?php echo ($_GET['combustivel'] == 3 ? 'selected' : '' ); ?>>ÁLCOOL</option>
                      <option value="4" <?php echo ($_GET['combustivel'] == 4 ? 'selected' : '' ); ?>>DIESEL</option>
                      <option value="5" <?php echo ($_GET['combustivel'] == 5 ? 'selected' : '' ); ?>>GÁS NATURAL</option>
                      <option value="6" <?php echo ($_GET['combustivel'] == 6 ? 'selected' : '' ); ?>>ELÉTRICO</option>
                  </select>
                  <input type="number" name="valorMin" class="form-control" value="<?php echo (isset($_GET['valorMin']) ? $_GET['valorMin'] : '' ); ?>" placeholder="VALOR MÍNIMO" style="width:10.5em;">
                  <input type="number" name="valorMax" class="form-control" value="<?php echo (isset($_GET['valorMax']) ? $_GET['valorMax'] : '' ); ?>" placeholder="VALOR MÁXIMO" style="width:10.5em;">
                  <button name="btnBuscar" type="submit" class="btn_search trans3" value="1">BUSCAR</button>
              </form>
          </div>
        </div><?php */?>
        <div class="container">
          <?php if (mysql_num_rows(mysql_query($buscaQuery)) == 0) { ?>
            <div class="well well-lg not_found">
              Não encontramos nenhum veículo. Por favor, realize a busca novamente.
            </div>
          <?php } else { ?>
            <div class="m_top50 table_busca">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                          <td colspan="5">
                            <form action="" method="get">
                              <div class="thead_busca">
                                <span>Veículos</span>
                                <input type="hidden" name="nome" value="<?=$nome?>">
                                <input type="hidden" name="marca" value="<?=$marca?>">
                                <input type="hidden" name="combustivel" value="<?=$combustivel?>">
                                <input type="hidden" name="valorMin" value="<?=$valorMin?>">
                                <input type="hidden" name="valorMax" value="<?=$valorMax?>">
                                <select name="portasFiltro" class="form-control m_r_30" onchange="this.form.submit()">
                                  <option value="" selected disabled>Portas</option>
                                  <option value="2" <?php echo ($portasFiltro == 2 ? "selected" : "") ?>>2</option>
                                  <option value="3" <?php echo ($portasFiltro == 3 ? "selected" : "") ?>>3</option>
                                  <option value="4" <?php echo ($portasFiltro == 4 ? "selected" : "") ?>>4</option>
                                  <option value="5" <?php echo ($portasFiltro == 5 ? "selected" : "") ?>>5</option>
                                </select>
                                <select name="anoModFiltro" class="form-control m_r_30" onchange="this.form.submit()">
                                  <option value="" selected disabled>Ano</option>
                                  <?php for($i = (date('Y') + 1); $i >= $maisAntigo['MIN(anomod)']; $i--) { ?>
                                    <option value="<?=$i?>" <?php echo ($i == $anoModFiltro ? "selected" : "") ?>><?=$i?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="btnBuscar">
                              </div>
                            </form>
                          </td>
                          <td colspan="2" align="center">
                           		 <button class="btn_search" onclick="window.location.href='/estoque/'">Imprimir estoque</button>
                          </td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $veiculos = array();
                        $veiculosQuery = mysql_query($buscaQuery);
                        $veiculosDir = "./uploads/veiculos/";

                        while ($veiculo = mysql_fetch_assoc($veiculosQuery)) {
                          array_push($veiculos, $veiculo);
                        }

                        foreach($veiculos as $veiculo) {
                          $id = $veiculo['id'];
                          $fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
                          $foto = mysql_fetch_assoc($fotosQuery);

                          if (mysql_num_rows($fotosQuery) <= 0) {
                            $src = "img/sem-foto.png";
                          } else {
                            $src = $veiculosDir.$foto['imagem'];
                          }
                      ?>
                        <tr>
                            <td style="padding:0;"><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><img src="<?=$src?>" alt=""></a></td>
                            <?php/*
                              $id = $veiculo['id'];
                              $rs_imagens = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
                              $ln_imagens = mysql_fetch_assoc($rs_imagens);

                              if (mysql_num_rows($rs_imagens) <= 0) { ?>
                              <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
                            <?php } else { ?>
                              <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><i class="fa fa-camera" aria-hidden="true"></i></a></td>
                            <?php } */?>
                            <td><div><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?=mb_strtoupper($veiculo['marcaNome']." ".$veiculo['modeloNome']." ".$veiculo['versao'])?></a></div></td>
                            <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?=$veiculo['anomod']?></a></td>
                            <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><b>R$ <?=number_format($veiculo['preco'], 2, ',', '.')?></b></a></td>
                            <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?php echo $combustiveis[$veiculo['combustivel']]?></a></td>
                            <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?=$veiculo['portas']?> portas</a></td>
                            <td><a href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?=$veiculo['cor']?></a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
             </div>

             <!-- <div class="pagination">
              <?php
                // range of links
                if($totalPages > 3) {
                  $range = 1;
                } else {
                  $range = $totalPages;
                }

                // se não estiver na página 1, mostrar link para voltar
                if ($currentPage > 1) {
                  // mostra o link para voltar uma página
                  $prevPage = $currentPage - 1;
                  echo "<a href='/resultado-busca/?".(isset($_GET['nome']) ? 'nome='.$_GET['nome'].'&' : '').(isset($_GET['marca']) ? 'marca='.$_GET['marca'].'&' : '').(isset($_GET['combustivel']) ? 'combustivel='.$_GET['combustivel'].'&' : '').(isset($_GET['valorMin']) ? 'valorMin='.$_GET['valorMin'].'&' : '').(isset($_GET['valorMax']) ? 'valorMax='.$_GET['valorMax'].'&' : '').(isset($_GET['btnBuscar']) ? 'btnBuscar='.$_GET['btnBuscar'].'&' : '')."currentPage=$prevPage' class='trans3'>Anteiror</a>";
                }
                // iteração para mostrar os links de páginas envolta da página atual
                for ($i = ($currentPage - $range); $i < (($currentPage + $range) + 1); $i++) {
                  // se for um número válido
                  if (($i > 0) && ($i <= $totalPages)) {
                    // se estivermos na página atual
                    if ($i == $currentPage) {
                      echo "<a class='trans3 active_pagination'>$i</a>";
                    } else {
                      // cria o link
                      echo "<a href='/resultado-busca/?".(isset($_GET['nome']) ? 'nome='.$_GET['nome'].'&' : '').(isset($_GET['marca']) ? 'marca='.$_GET['marca'].'&' : '').(isset($_GET['combustivel']) ? 'combustivel='.$_GET['combustivel'].'&' : '').(isset($_GET['valorMin']) ? 'valorMin='.$_GET['valorMin'].'&' : '').(isset($_GET['valorMax']) ? 'valorMax='.$_GET['valorMax'].'&' : '').(isset($_GET['btnBuscar']) ? 'btnBuscar='.$_GET['btnBuscar'].'&' : '')."currentPage=$i' class='trans3'>$i</a>";
                    } // fim else
                  } // fim if
                } // fim for

                // se não estiver na última página, mostrar o link para a próxima
                if ($currentPage != $totalPages && $totalPages > 1) {
                  // pega a próxima página
                  $nextPage = $currentPage + 1;
                  // mostra o link para a próxima página
                  echo "<a href='/resultado-busca/?".(isset($_GET['nome']) ? 'nome='.$_GET['nome'].'&' : '').(isset($_GET['marca']) ? 'marca='.$_GET['marca'].'&' : '').(isset($_GET['combustivel']) ? 'combustivel='.$_GET['combustivel'].'&' : '').(isset($_GET['valorMin']) ? 'valorMin='.$_GET['valorMin'].'&' : '').(isset($_GET['valorMax']) ? 'valorMax='.$_GET['valorMax'].'&' : '').(isset($_GET['btnBuscar']) ? 'btnBuscar='.$_GET['btnBuscar'].'&' : '')."currentPage=$nextPage' class='trans3'>Próximo</a>";
                }
              ?>
             </div> -->
          <?php } ?>
        </div>
