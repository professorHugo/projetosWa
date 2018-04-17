
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
        <?php /*?><div class="container">
            <div class="search d_table">
                <form action="/resultado-busca/" class="form-inline form_search" method="get">
                    <h1>Buscar</h1>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail3">Buscar Veículos</label>
                        <input name="nome" type="text" class="form-control" id="buscarVeiculo" placeholder="NOME/MODELO">
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
                      <option value="<?=$marcaCar['id']?>"><?=$marcaCar['nome']?></option>
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
        </div><?php */?>
        <div class="container">
            <div class="row m_t_50">
              <div class="slick">
                <?php
                  $rs_marcas = mysql_query("SELECT DISTINCT marcas.* FROM marcas INNER JOIN veiculos ON marcas.id = veiculos.marca ORDER BY marcas.nome");
                  while($ln_marcas = mysql_fetch_assoc($rs_marcas)) { ?>
                      <a href="/resultado-busca/?marca=<?=$ln_marcas['id']?>&btnBuscar=true" class="img_montadoras_home"><img src="uploads/marcas/<?php echo $ln_marcas['logo'] ?>" title="Logo da <?php echo $ln_marcas['nome'] ?>" alt="Logo da <?php echo $ln_marcas['nome'] ?>" class="img-responsive trans3"></a>
                <?php } ?>
              </div>
            </div>
        </div>
        <?php /*
        <div class="container m_t_50">
        <div class="title_border_gray m_b_50">
        <h4>Veículos em Destaque</h4>
        </div>
        <div class="row">
        <?php
        $veiculosDir = "./uploads/veiculos/";
        $destaques = array();
        $destaquesQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome, ft.imagem AS foto FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id INNER JOIN imagens AS ft ON v.id = ft.id_referencia WHERE ft.posicao = 1 ORDER BY v.id DESC LIMIT 0,4");
        // $destaquesQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id ORDER BY v.id DESC LIMIT 0,4");

        while ($destaque = mysql_fetch_assoc($destaquesQuery)) {
        array_push($destaques, $destaque);
      }

      foreach($destaques as $destaque) {
      $id = $destaque['id'];
      $fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
      $foto = mysql_fetch_assoc($fotosQuery);

      if (mysql_num_rows($fotosQuery) <= 0) {
      $src = "img/sem-foto.png";
    } else {
    $src = $veiculosDir.$foto['imagem'];
  }

  $imgProperties = getimagesize($src);
  ?>
  <div class="col-md-3">
  <div class="box_car">
  <a href="/veiculo/<?php echo formataURL($destaque['marcaNome']); ?>/<?php echo formataURL($destaque['modeloNome']." ".$destaque['versao']); ?>/?id=<?=$destaque['id']?>">
  <style media="screen">
  .pin_box_car {
  height: 263px;
  text-align: right;
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: center;
  width: 262.5px;
}
.pin_box_car img {
height: auto;
}
</style>
<div class="pin_box_car trans3">
<img src="<?=$src?>" alt="" class="img-responsive">
<span>Saiba <br /> Mais <i class="fa fa-plus"></i></span>
</div>
<span class="car_name"><?=$destaque['marcaNome']." ".$destaque['modeloNome']." ".$destaque['versao']?></span>
<h3>R$ <?=number_format($destaque['preco'],2,',','.')?></h3>
<span class="car_year"><?=$destaque['anofab']?> / <?=$destaque['anomod']?></span>
<div class="mask_box_car trans3"></div>
</a>
</div>
</div>
<?php } ?>
</div>
<div class="row">
<?php
$veiculosDir = "./uploads/veiculos/";
$destaques = array();
$destaquesQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome, ft.imagem AS foto FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id INNER JOIN imagens AS ft ON v.id = ft.id_referencia WHERE ft.posicao = 1 ORDER BY v.id DESC LIMIT 5,4");

while ($destaque = mysql_fetch_assoc($destaquesQuery)) {
array_push($destaques, $destaque);
}

foreach($destaques as $destaque) {
$id = $destaque['id'];
$fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
$foto = mysql_fetch_assoc($fotosQuery);

if (mysql_num_rows($fotosQuery) <= 0) {
$src = "img/sem-foto.png";
} else {
$src = $veiculosDir.$foto['imagem'];
}
?>
<div class="col-md-3">
<div class="box_car">
<a href="/veiculo/<?php echo formataURL($destaque['marcaNome']); ?>/<?php echo formataURL($destaque['modeloNome']." ".$destaque['versao']); ?>/?id=<?=$destaque['id']?>">
<style media="screen">
.pin_box_car {
height: 263px;
text-align: right;
display: flex;
flex-flow: column nowrap;
justify-content: center;
align-items: center;
width: 262.5px;
}
.pin_box_car img {
height: auto;
}
</style>
<div class="pin_box_car trans3">
<img src="<?=$src?>" alt="" class="img-responsive">
<span>Saiba <br /> Mais <i class="fa fa-plus"></i></span>
</div>
<span class="car_name"><?=$destaque['marcaNome']." ".$destaque['modeloNome']." ".$destaque['versao']?></span>
<h3>R$ <?=number_format($destaque['preco'],2,',','.')?></h3>
<span class="car_year"><?=$destaque['anofab']?> / <?=$destaque['anomod']?></span>
<div class="mask_box_car trans3"></div>
</a>
</div>
</div>
<?php } ?>
</div>
</div>
        */ ?>
