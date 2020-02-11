<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <!-- <link rel="stylesheet" href="../public/css/main.css"> -->

    <?php \fw\core\base\View::getMeta(); ?>
  </head>
  <body>
    <div class="container">
      <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="/page/about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin">ADMIN</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/signup">Signup</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/login">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/logout">Logout</a></li>

      </ul>
      <h1>Шаблон - default</h1>

    <?php if( isset($_SESSION['error']) ): ?>
      <div class="alert alert-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <?php if( isset($_SESSION['success']) ): ?>
      <div class="alert alert-success">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>
    <?php echo $content; ?>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="../../public/bootstrap/js/bootstrap.min.js" ></script>
    <script>
    // console.log($.ajax);
      $('#send').click(function(){
        $.ajax({
          url: '/main/test',
          type: 'post',
          data: {'id' : 2},
          success: function(res){
            console.log(res);

          },
          error: function(){
            alert('Error!');
          }
        });
      });
    </script>
    <?php
      // foreach($scripts as $script){
      //   echo $script;
      // }
     ?>
  </body>
</html>
