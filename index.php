<!DOCTYPE html>
<html>

<head>
  <title>Título da página</title>
  <meta charset="utf-8" />
</head>

<body>
  <form method="post">
    <br />
    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" id="modelo" />
    <input type="submit" value="Pesquisar" name="Submit">
    <br /><br />
  </form>
  <?php
  if (isset($_POST["Submit"])) {
    $modelo = isset($_POST["modelo"]) ? $_POST["modelo"] : null;
    $filter = 'a[data-lurker-detail="list_id"]';
    $url = 'https://www.olx.com.br/autos-e-pecas/carros-vans-e-utilitarios';
    include("entity.php");

    $data = new DomOLX();
    $result = $data->preparaAmbiente($filter, $url, $modelo);
    print_r($result);
  }

  ?>
</body>

</html>