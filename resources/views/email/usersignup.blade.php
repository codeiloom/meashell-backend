<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
</head>

<body>

    <h2> سلام {{ $name }}</h2>

    <p>ثبت نام شما با موفقیت تکمیل شد جهت فعالسازی حساب روی دکمه یر کلیک بکنید</p>

    <a href={{ 'http://localhost:8000/api/v1/register/activation/' . $activation_token }}> فعالسازی</a>

</body>

</html>