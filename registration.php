<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Регистрация</title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous"
  />

  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />

  <link rel="stylesheet" href="./styles/registration2.css" />
</head>
<body>
  <div class="container my-5">
    <noscript>
      <p class="alert alert-warning" role="alert">
        У вас отключён JavaScript, его необходимо включить.<br />
        После включения перезагрузите страницу.
      </p>
    </noscript>

    <div class="row justify-content-center align-items-center">
      <div class="col-md-6">
        <h1 class="mb-4 text-center">Создание аккаунта</h1>

        <form action="validation_form/check.php" method="post" id="form" novalidate>
          <div class="mb-3 form-control position-relative">
            <label for="login" class="form-label">Логин</label>
            <input
              type="text"
              id="login"
              name="login"
              class="form-control"
              placeholder="Введите логин"
              pattern="\d+"
              title="Можно вводить только цифры"
              required
            />
            <small class="form-text text-muted">Можно вводить только цифры</small>
            <i class="fa fa-check position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
            <i class="fa fa-exclamation position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
          </div>

          <div class="mb-3 form-control position-relative">
            <label for="number" class="form-label">Номер телефона</label>
            <input
              type="tel"
              id="number"
              name="number"
              class="form-control"
              placeholder="88008893553"
              pattern="\d{11}"
              title="Номер телефона должен содержать ровно 11 цифр"
              maxlength="11"
              required
            />
            <small class="form-text text-muted">Можно вводить только цифры</small>
            <i class="fa fa-check position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
            <i class="fa fa-exclamation position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
          </div>

          <div class="mb-3 form-control position-relative">
            <label for="pass" class="form-label">Пароль</label>
            <input
              type="password"
              id="pass"
              name="pass"
              class="form-control"
              placeholder="Введите пароль"
              required
            />
            <div class="form-check mt-2">
              <input
                type="checkbox"
                class="form-check-input"
                id="pass_box"
                onclick="togglePasswordVisibility()"
              />
              <label class="form-check-label" for="pass_box">Показать пароль</label>
            </div>
            <small class="form-text text-muted">
              Пароль должен содержать минимум 8 символов, заглавную и прописную буквы, цифру и спец. символ
            </small>
            <i class="fa fa-check position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
            <i class="fa fa-exclamation position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
          </div>

          <div class="mb-3 form-control position-relative">
            <label for="confirm_pass" class="form-label">Повтор пароля</label>
            <input
              type="password"
              id="confirm_pass"
              name="confirm_pass"
              class="form-control"
              placeholder="Повторите пароль"
              required
            />
            <i class="fa fa-check position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
            <i class="fa fa-exclamation position-absolute end-0 top-50 translate-middle-y me-3 d-none"></i>
          </div>

          <div class="mb-3 form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="checkboxId"
              required
            />
            <label class="form-check-label" for="checkboxId">
              Я согласен с <a href="/political.php">Политикой обработки персональных данных</a>
            </label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <a href="login.html">Логин</a>
            <button type="submit" class="btn btn-primary" id="button1">Регистрация</button>
          </div>
        </form>
      </div>

      <div class="col-md-4">
        <div class="border rounded p-3 bg-light">
          <div class="text-center">
            <i class="fa fa-question-circle fa-2x mb-2"></i>
            <small id="errorMessage" class="text-muted">
              Пароль должен содержать минимум:<br />
              8 символов,<br />
              заглавную и прописную буквы,<br />
              цифру и спец. символ
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    function togglePasswordVisibility() {
      const passInput = document.getElementById('pass');
      const confirmInput = document.getElementById('confirm_pass');
      const type = passInput.type === 'password' ? 'text' : 'password';
      passInput.type = type;
      confirmInput.type = type;
    }
  </script>
</body>
</html>
