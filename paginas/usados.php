<?php
  $combustiveis = array(1=>"FLEX",2=>"GASOLINA",3=>"ÁLCOOL",4=>"DIESEL",5=>"GÁS NATURAL",6=>"ELÉTRICO");

  // total de linhas da busca
  $buscaQuery = "SELECT * FROM veiculos";
  $buscaTotal = mysql_num_rows(mysql_query($buscaQuery));

  // número de linhas exibidas por pag
  $rowsPerPage = 10;
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
  $buscaQuery = "SELECT * FROM veiculos ORDER BY datacad LIMIT $offset, $rowsPerPage";
?>
            </div>
        </div>
        <div class="breadcrumb">
            <div class="container carros">
                <h1>
                  Busca<i class="fa fa-angle-right"></i>
                  Usados
                </h1>
                <hr>
            </div>
        </div>
        <div class="container">
          <div class="search d_table">
              <form action="/resultado-busca/" class="form-inline form_search" method="get">
                  <h1>Buscar</h1>
                  <div class="form-group">
                      <label class="sr-only" for="buscarVeiculo">Buscar Veículos</label>
                      <input name="nome" type="text" class="form-control" id="buscarVeiculo" placeholder="NOME/MODELO">
                  </div>
                  <select name="marca" class="form-control">
                    <option selected="true" disabled>Marca</option>
                  <?php
                    $marcas = array();
                    $marcasQuery = mysql_query("SELECT * FROM marcas");

                    while($marcaCar = mysql_fetch_assoc($marcasQuery)) {
                      array_push($marcas, $marcaCar);
                    }

                    foreach ($marcas as $marcaCar) {
                  ?>
                    <option value="<?=$marcaCar['nome']?>"><?=$marcaCar['nome']?></option>
                  <?php } ?>
                  </select>
                  <select name="combustivel" class="form-control">
                      <option selected="true" disabled="true">Combustível</option>
                      <option value="1">FLEX</option>
                      <option value="2">GASOLINA</option>
                      <option value="3">ÁLCOOL</option>
                      <option value="4">DIESEL</option>
                      <option value="5">GÁS NATURAL</option>
                      <option value="6">ELÉTRICO</option>
                  </select>
                  <input type="number" name="valorMin" class="form-control" placeholder="VALOR MÍNIMO" style="width:10.5em;">
                  <input type="number" name="valorMax" class="form-control" placeholder="VALOR MÁXIMO" style="width:10.5em;">
                  <button name="btnBuscar" type="submit" class="btn_search trans3">BUSCAR</button>
              </form>
          </div>
        </div>
        <div class="container">
            <div class="table-responsive m_top50 table_busca">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="5">
                                <div class="thead_busca">
                                    <span>Veículos Usados</span>
                                    <select class="form-control m_r_30">
                                        <option value="" selected disabled>Portas</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">3</option>
                                        <option value="5">5</option>
                                    </select>
                                    <!-- <form> -->
                                    <select class="form-control m_r_30">
                                        <option value="" selected disabled>Ano</option>
                                        <?php for($i = 1950; $i <= (date('Y') + 1); $i++) { ?>
                                          <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- </form> -->
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $veiculos = array();
                        $veiculosQuery = mysql_query($buscaQuery);
                        $veiculosDir = "./uploads/veiculos/";

                        $numRows = mysql_num_rows($veiculosQuery);

                        while ($veiculo = mysql_fetch_assoc($veiculosQuery)) {
                          array_push($veiculos, $veiculo);
                        }

                        foreach($veiculos as $veiculo) {
                          $id = $veiculo['id'];
                          $fotos = array();
                          $fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id ORDER BY id DESC");

                          while ($foto = mysql_fetch_assoc($fotosQuery)) {
                            array_push($fotos, $foto);
                          }
                      ?>
                        <tr>
                            <td><img src="<?=$veiculosDir.$fotos[0]['imagem']?>" alt="" class="img-responsive"></td>
                            <td><div><a href="/veiculos/?id=<?=$veiculo['id']?>"><?=$veiculo['nome']?></a></div></td>
                            <td><?=$veiculo['anomod']?></td>
                            <td><b>R$ <?=number_format($veiculo['preco'], 2, ',', '.')?></b></td>
                            <td><?php echo $combustiveis[$veiculo['combustivel']]?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
             </div>
             <div class="pagination">
              <?php
                // range of links
                if($totalPages > 3) {
                  $range = 3;
                } else {
                  $range = $totalPages;
                }

                // se não estiver na página 1, mostrar link para voltar
                if ($currentPage > 1) {
                  // mostra o link para voltar uma página
                  $prevPage = $currentPage - 1;
                  echo "<a href='/usados/?currentPage=$prevPage' class='trans3'>Anteiror</a>";
                }
                // iteração para mostrar os links de páginas envolta da página atual
                for ($i = ($currentPage - $range); $i < (($currentPage + $range) + 1); $i++) {
                  // se for um número válido
                  if (($i > 0) && ($i <= $totalPages)) {
                    // se estivermos na página atual
                    if ($i == $currentPage) {
                      echo "<a href='#' class='trans3 active_pagination'>$i</a>";
                    } else {
                      // cria o link
                      echo "<a href='/usados/?currentPage=$i' class='trans3'>$i</a>";
                    } // fim else
                  } // fim if
                } // fim for

                // se não estiver na última página, mostrar o link para a próxima
                if ($currentPage != $totalPages && $totalPages > 1) {
                  // pega a próxima página
                  $nextPage = $currentPage + 1;
                  // mostra o link para a próxima página
                  echo "<a href='/usados/?currentPage=$nextPage' class='trans3'>Próximo</a>";
                }
              ?>
             </div>
        </div>
