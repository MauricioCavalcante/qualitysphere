<?php
if (isset($_SESSION['user'])) {
  $id_user = $_SESSION['user'];

  try {
    $conexao = new PDO($dbname, $db_username, $db_password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM tb_user WHERE nome = :id_user";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      include("../layouts/header.php");

      echo "<div class='alert alert-danger text-center m-5'>Usuário não encontrado.</div>";
      exit();
    }
  } catch (PDOException $e) {
    echo 'Erro' . $e->getCode() . ' Mensagem:' . $e->getMessage();
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<body>
  <header>
    <div class="d-flex">
      <div class="p-2 flex-grow-1">
        <nav class="navbar navbar-expand-sm text-light" data-bs-theme="dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $index ?>"><img src="<?php echo $diretorio ?>/public/images/logo-hitss.jpg" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $index; ?>">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Chamados
                  </a>
                  <ul class="dropdown-menu w-25">
                    <li><a class="dropdown-item" href="<?php echo $novo_chamado; ?>">Novo chamado</a></li>
                    <li><a class="dropdown-item" href="<?php echo $chamados; ?>">Painel</a></li>
                  </ul>
                </li>

                <?php if ($user['group'] == 'COORDENADOR') { ?>
                  <li class="nav-item"><a class="nav-link" href="<?php echo $gestor; ?>">Atendentes</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div class="mt-3 d-inline">
        <nav class="navbar sticky-top" data-bs-theme="dark">
          <ul class="list-inline">
            <!-- <li class="list-inline-item">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--secundary-color)" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
              </svg>
            </a>
          </li> -->
            <li class="list-inline-item">
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--secundary-color)" class="bi bi-bell" viewBox="0 0 16 16">
                  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                </svg>
              </a>
            </li>
            <li class="list-inline-item dropstart">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--secundary-color)" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
              </a>
              <ul class="dropdown-menu text-center text-nowrap p-2">
                <li>
                  <?php echo $user['nome'];?>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo $config_usuario; ?>">Perfil</a></li>
                <li><a class="dropdown-item" href="<?php echo $usuario; ?>">Meus Chamados</a></li>
                <li><a class="dropdown-item" href="#">Notificações</a></li>
                <li><a class="dropdown-item" href="<?php echo $logout; ?>"><u>Sair</u></a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../../../public/js/scripts.js"></script>
</body>

</html>