<!DOCTYPE html>
<html>

<head>
    <title>Satya's webpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="style.css" rel="stylesheet">

</head>

<body background="images/map_2.png">
<ul>

    <li style="float:left"><a class="active" href="#info">About</a></li>
    <li style="float:left"><a href="mctool/index.php">Tools</a></li>
</ul>

<section id="info">
    <center>
        <div class="shadow_white">
            <h1>Hello <?php echo $_SERVER['REMOTE_ADDR'] ?>!</h1>
            <h2 style="float: left">About</h2>
            <br><br>
            <h3 style="float: left">Me</h3>
            <br><br>
            <h5 style="float: left">

                yoooo! I am satyamedh, a 13 year old short guy. I'm into programming, and electronics in general. I know python, HTML, css, js, java, kotlin, PHP and c#.
                studying 8th grade
            </h5>
            <br><br>
            <h3 style="float: left">This site</h3>
            <br><br>
            <h5 style="float: left; white-space: pre-line;">
                This site serves 2 reasons, for me to learn PHP and to act like my blog. the background of this page is actually the map of a minecraft server, which is for me and my friends :), ik it's streched rn but I'll fix it later(it's 12am, if I'm seen playing MC then gone). you can convert your map_#### to such a png <a href="mctool/map2png/index.php">here</a>
            </h5>
        </div>
    </center>
</section>

</body>
</html>