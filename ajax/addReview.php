<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<form id="feedback-form" action="" method="post">
    <input type="text" name="text" placeholder="Введите ващ отзыв">
    <input type="submit" name="submit" value="Отправить">
</form>
<script>
    $(document).ready(function () {
        $("form").submit(function () {
            // Получение ID формы
            var formID = $(this).attr('id');
            // Добавление решётки к имени ID
            var formNm = $('#' + formID);
            $.ajax({
                type: "POST",
                url: '/../ajax/send.php',
                data: formNm.serialize(),
                beforeSend: function () {
                    // Вывод текста в процессе отправки
                    $(formNm).html('<p style="text-align:center">Отправка...</p>');
                },
                success: function (data) {
                    // Вывод текста результата отправки
                    $(formNm).html('<p style="text-align:center">'+data+'</p>');
                },
                error: function (jqXHR, text, error) {
                    // Вывод текста ошибки отправки
                    $(formNm).html(error);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
