<?php
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Time\Time;

  require_once __DIR__.'/assets/autoload.php';

  $time= new Time;
  $Xtimes = $time->getAllTimes();
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Teste Sistema Sinuca</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-lg-5">
                <a class="navbar-brand" href="#!">Teste Sistema Sinuca</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
          <div class="container px-lg-5">
            <h2>Times</h2>
          </div>
        </header>
        <!-- Page Content-->
        <section class="pt-4">
          <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
              <div class="col-lg-12 col-xxl-4 mb-5">
                <table class="table table-striped">
                  <tr>
                    <th class="text-left">
                      <button type="button" class="btn btn-primary btn-sm" onclick="javascript: location.href= 'time_new.php';">+</button>&nbsp;&nbsp;
                      Nome
                    </th>
                    <th class="text-left">Jogador 1</th>
                    <th class="text-left">Jogador 2</th>
                    <th class="text-center">Ações</th>
                  </tr>
                  <?php
                    foreach($Xtimes as $time)
                    {
                      echo '<tr>
                        <td class="text-left">'.$time->getNome().'</td>
                        <td class="text-left">'.$time->getJogador1().'</td>
                        <td class="text-left">'.$time->getJogador2().'</td>
                        <td class="text-center">
                          <button type="button" class="btn btn-sm btn-info" title="Editar" onclick="javascript: location.href=\'time_edit.php?i='.$time->getId().'\'";><i class="bi bi-pencil"></i></button>
                        </td>
                      </tr>';
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <!-- <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div> -->
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
