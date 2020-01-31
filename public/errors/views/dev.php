<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Произошла ошибка</h1>
  <p><b>Код ошибки:</b> <?php echo $errno; ?></p>
  <p><b>Текст ошибки:</b> <?php echo $errstr; ?></p>
  <p><b>Файл, в котором произошла ошибка:</b> <?php echo $errfile; ?></p>
  <p><b>Строка, в которойм произошла ошибка:</b> <?php echo $errline; ?></p>

</body>
</html>
