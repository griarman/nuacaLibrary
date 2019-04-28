<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Մուտք գործել</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="icon"  href="./favicon.png">
    <script src="./assets/JS/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="./assets/JS/login.js"></script>
</head>
<body>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h2 class="active"> Մուտք Գործել </h2>

        <div class="fadeIn first">
<!--          <img src="./favicon.png" id="icon" alt="User Icon" />-->
        </div>

        <form action="Authorization/login" method="post">
          <input type="text" id="login" class="fadeIn second" name="login" placeholder="Մուտքանուն" myRequired value="admin">
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="Գաղտնաբառ" myRequired value="admin">
          <input type="submit" class="fadeIn fourth" value="Մուտք գործել" id="enter">
        </form>
        <div class="error">
            <?= (isset($error))? $error : ''?>
        </div>
        <div id="formFooter">

            <a class="underlineHover" href="#">Մոռացե՞լ եք գաղտնաբառը</a>
        </div>

      </div>
    </div>
</body>
</html>
