<?php
require '../../../routes/controllers.php';
require '../../../routes/views.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<title>QualitySphere - Login</title>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../../public/css/login.css">

</head>

<body>
  <form class="form-login" action="<?php echo $AuthController ?>" method="post">

    <div class="header">
      <div class="background-overlay"></div>
      <img src="../../../public/images/bg-00.jpg" class="background-image">
      <span class="titulo">
        SERVICEDESK
      </span>
    </div>

    <div class="card-body">
      <div class="form-group p-2">
        <input name="username" type="text" class="form-control" placeholder="E-mail ou Nome de Usuário">
      </div>
      <div class="form-group p-2">
        <input name="senha" type="password" class="form-control" placeholder="Senha">
      </div>

      <?php if (isset($_GET['login'])) : ?>
        <?php if ($_GET['login'] == 'erro') : ?>
          <div class="text-danger">
            Usuário ou senha inválidos!
          </div>
        <?php elseif ($_GET['login'] == 'erro2') : ?>
          <div class="text-danger">
            Você precisa fazer login!
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <div class="card-footer">
      <button class="btn btn-lg btn-success">Entrar</button>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>