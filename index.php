<!DOCTYPE html>
<html>

<head>
    <title>Satya's webpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="style.css" rel="stylesheet">
    <script async="async" src="https://arc.io/widget.min.js#x2EhNawj"></script>
    <script data-ad-client="ca-pub-8556006122224174" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<?php
$bgs = ['images/beacon.png', 'images/stash.png', 'images/whole_world.png', 'images/bunker.png', 'images/throne.png'];
$bg = $bgs[rand(0,sizeof($bgs)-1)];
$text_style = "";
$borders = "border: 2px solid white;";
if (($bg == "images/stash.png") || ($bg == "images/throne.png")){
    $text_style = $text_style. " color: white;";
} else {
    $borders = "border: 2px solid black;";
}

?>
<body background="<?php echo $bg; ?>">
<ul class="ul">

    <li style="float:left" class="li"><a class="active" href="#info">About</a></li>
    <li style="float:left" class="li"><a href="mctool/index.php">Tools</a></li>
    <li style="float:right" class="li"><a href="/admin.php" class="admin">Admin</a></li>
    <li style="float:left" class="li"><a href="/blogposts.php">Blog</a></li>
</ul>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8556006122224174"
        crossorigin="anonymous"></script>
<!-- index1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8556006122224174"
     data-ad-slot="8042215045"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<section id="info">
    <center>
        <div class="shadow_white first" style="<?php echo $borders; ?>">
            <h1 style="<?php echo $text_style ?>">Hello <?php echo $_SERVER['REMOTE_ADDR'] ?>!</h1>
            <h2 style="float: left; <?php echo $text_style ?>">About</h2>
            <br><br>
            <h3 style="float: left; <?php echo $text_style ?>">Me</h3>
            <br><br>
            <h5 style="float: left; <?php echo $text_style ?>">

                yoooo I am satyamedh! I'm into programming, and electronics in general. I know python, HTML, css, js, java, kotlin, PHP and c#.
            </h5>
            <br><br>
            <h3 style="float: left; <?php echo $text_style ?>">This site</h3>
            <br><br>
            <h5 style="float: left; <?php echo $text_style ?>">
                This site serves 2 reasons, for me to learn PHP and to act like my blog.
            </h5>
        </div>
    </center>
</section>

</body>
</html>