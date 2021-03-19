<!DOCTYPE html>
<head>
  <title></title>
  <meta charset="utf-8" />
</head>

<body>
  <form method="post">
    <ul>
      <li>
        <label for="modelo">Marca:</label>
        <input type="text" name="marca" id="marca" />
      </li>
      <br/>
      <li>
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" id="modelo" />
      </li>
    </ul>
    <br />
      <input type="submit" value="Pesquisar" name="Submit">
      <br /><br />
  </form>
  <?php
  /**
   * Obtêm os dados para realizar a pesquisar.
   * @category Projeto crawler de carros da olx
   * @license MIT
   */

        require_once '../vendor/autoload.php';

  if (isset($_POST['Submit'])) {
      $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : null;
      $marca = isset($_POST['marca']) ? $_POST['marca'] : null;
      $filter = 'a[data-lurker-detail="list_id"]';
      $url = 'https://www.olx.com.br/autos-e-pecas/carros-vans-e-utilitarios';

      $tempoInicial = new DateTime(date('H:i:s'));

      $ctl = new src\Controller\CrawlerController();
      $result = $ctl->percorrerPagina($filter, $url, $marca, $modelo);

      $tempoFinal = new DateTime(date('H:i:s'));

      $output = $tempoInicial->diff($tempoFinal)->format('%H:%I:%S');
      $tempoExec = 'O tempo de execução foi de '.strval($output);

      echo $tempoExec.'<br>';

      $i = 0;
      $result = [$output => $result];
      var_export($result);

      file_put_contents(
          'links.json',
          json_encode($result, JSON_UNESCAPED_SLASHES),
          FILE_APPEND
      );
  }
  ?>
</body>
</html>