<?php
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));
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
            <h2>Novo Time</h2>
          </div>
        </header>
        <!-- Page Content-->
        <section class="pt-4">
          <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
              <div class="col-lg-6 col-xxl-4 mb-5">
                <form class="form-horizontal" method="POST" action="post-time.php">
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label" for="nome">Nome:</label><br>
                      <div class="col-lg-12">
                        <input class="form-control" type="text" id="nome" name="nome"><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="jogador1">Jogador 1:</label><br>
                      <div class="col-lg-12">
                        <input class="form-control" type="text" id="jogador1" name="jogador1"><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="jogador2">Jogador 2:</label><br>
                      <div class="col-lg-12">
                        <input class="form-control" type="text" id="jogador2" name="jogador2"><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-md btn-secondary" onclick="javascript: window.history.back();">Voltar</button>
                        <button type="submit" class="btn btn-md btn-primary">Salvar</button>
                      </div>
                    </div>
                  </div>
                </form>
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
