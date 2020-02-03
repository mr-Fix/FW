<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <!-- <link rel="stylesheet" href="../public/css/main.css"> -->

    <?php \fw\core\base\View::getMeta(); ?>
  </head>
  <body>
    <h1>Hello, world! im AAAADMIN default</h1>
    <?php echo $content; ?>
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
