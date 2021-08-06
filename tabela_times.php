<?php
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Tabela\Tabela;

  require_once __DIR__.'/assets/autoload.php';

  $tabela = new Tabela;
  $tabela->getTabela(@$_GET['i']);
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
        <!-- SweetAlert2 -->
        <link href="js/sweetalert2-11.0.7/package/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
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
            <h2>Times Tabela <?php echo $tabela->getNome(); ?></h2>
            <p>Descrição: <?php echo nl2br($tabela->getDescricao()); ?></p>
            <p>Pontuação: <?php echo nl2br($tabela->getPontuacao()); ?></p>
            <p>Regra de Pontuação: <?php echo nl2br($tabela->getRegra()); ?></p>
          </div>
        </header>
        <!-- Page Content-->
        <section class="pt-4">
          <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
              <div class="col-lg-12 col-xxl-4 mb-5">
                <?php
                  if(count($tabela->getTimeTabela()) > 0)
                  {
                    if(empty($tabela->getVencedor()))
                    {
                    ?>
                      <form class="form-horizontal mb-5" method="POST" action="post-tabela_time_ponto.php">
                        <input type="hidden" id="idTabela" name="idTabela" value="<?php echo $tabela->getId(); ?>">
                        <div class="row">
                          <h4>Adicionar Pontuação</h4>
                          <div class="col-lg-4">
                            <div class="input-group">
                              <label class="control-label" for="id">Time:</label><br>
                              <div class="col-lg-12">
                                <select class="form-control" id="id" name="id">
                                  <?php
                                    foreach($tabela->getTimeTabela() as $time)
                                    {
                                      echo '<option value="'.$time['id'].'">'.$time['Tnome'].'</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <div class="input-group">
                              <label class="control-label" for="pontos">Pontos:</label><br>
                              <div class="col-lg-12">
                                <input type="number" class="form-control" id="pontos" name="pontos" value="0" min="0" max="<?php echo $tabela->getPontuacao(); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <br>
                            <div class="input-group">
                              <button type="submit" class="btn btn-md btn-primary">Incluir</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    <?php
                    }
                  }
                ?>

                <table class="table table-striped">
                  <tr>
                    <th class="text-left">
                      <button type="button" id="btnAdd" class="btn btn-primary btn-sm" onclick="javascript: location.href= 'tabela_time_add.php?i=<?php echo $_GET['i'];?>';">+</button>&nbsp;&nbsp;
                      Nome
                    </th>
                    <th class="text-left">Pontuação</th>
                    <th class="text-center">Ações</th>
                  </tr>
                  <?php
                    if(count($tabela->getTimeTabela()) > 0)
                    {
                      $vencedor = false;
                      $nome_vencedor = '';
                      foreach($tabela->getTimeTabela() as $time)
                      {
                        echo '<tr>
                          <td class="text-left">';
                            if(!$vencedor && $time['pontos'] == $tabela->getPontuacao())
                            {
                              echo '<i class="bi bi-flag-fill" style="color: green;" title="Vencedor"></i>&nbsp;';
                              $vencedor = true;
                              $nome_vencedor = $time['Tnome'];
                            }
                        echo 
                            $time['Tnome'].'</td>
                          <td class="text-left">'.$time['pontos'].'</td>
                          <td class="text-center"></td>
                        </tr>';
                      }
                    }
                    else
                    {
                      echo '<tr>
                          <td colspan="3" class="text-center">Nenhum time na tabela</td>
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
        <!-- SweetAlert2 -->
        <script src="js/sweetalert2-11.0.7/package/dist/sweetalert2.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script>
          function alertar(XVencedor) {
            var elemento = document.getElementById("btnAdd");
            console.log(elemento);
            elemento.style.display = "none";
            Swal.fire({
              icon: 'success',
              title: 'Vencedor!',
              text: XVencedor,
            });
          }
          <?php echo ($vencedor ? 'alertar("'.$nome_vencedor.'");' : '');?>
        </script>
    </body>
</html>
