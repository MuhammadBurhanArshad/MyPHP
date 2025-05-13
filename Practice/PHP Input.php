<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Input</title>
</head>
<body>
    <form name="form" action="" method="get">
    <input type="humber" min="1" max="100" name="subject" id="subject" placeholder="Enter You Age">
    <input type="submit" >
    </form>
    <?php
    echo $_GET['subject'];

    ?>
</body>
</html>