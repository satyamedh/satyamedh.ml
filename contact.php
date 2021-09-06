<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="style.css" rel="stylesheet">
    <script async="async" src="https://arc.io/widget.min.js#x2EhNawj"></script>
</head>
<?php
$bgs = ['images/beacon.png', 'images/stash.png', 'images/whole_world.png', 'images/bunker.png', 'images/throne.png'];
$bg = $bgs[rand(0,sizeof($bgs)-1)];
$text_style = "";
$recaptcha_theme = "dark";
$borders = "border: 2px solid white;";
if (($bg == "images/stash.png") || ($bg == "images/throne.png")){
    $text_style = $text_style. " color: white;";
    $recaptcha_theme = "light";
} else {
    $borders = "border: 2px solid black;";
}

?>
<body background="<?php echo $bg?>">
<ul class="ul">

    <li style="float:left" class="li"><a class="active" href="/index.php#info">About</a></li>
    <li style="float:left" class="li"><a href="/mctool/index.php">Tools</a></li>
    <li style="float:right" class="li"><a href="/admin.php" class="admin">Admin</a></li>
    <li style="float:left" class="li"><a href="/blogposts.php">Blog</a></li>
    <li style="float:right" class="li"><a href="/contact.php">Contact</a></li>
</ul>
<center>
    <div class="shadow_white first" style="<?php echo $text_style; echo $borders;?>">
        <h5>My emails: <a href="mailto:me@satyamedh.ml" target="_blank">me@satyamedh.ml</a>  and <a href="mailto:satyamedh9@gmail.com" target="_blank">satyamedh9@gmail.com</a></h5> <h6>You'll 99% of the time get a response from my gmail tho cuz google doesn't accept mail sent from my IP</h6>
        <br><br><h5>Discord: <a href="https://discord.com/users/605364556465963018" target="_blank"><kbd>! Satyamedh#2579</kbd></a></h5>
        <br><br><hr>
        <h4>Socials:</h4><br>
        <a href="https://github.com/satyamedh" target="_blank"><button class="btn btn-outline-dark">Github</button></a><br><br>
        <a href="https://twitter.com/SatyamedhH" target="_blank"><button class="btn btn-outline-primary">Twitter</button></a><br><Br>
        <a href="https://www.twitch.tv/satyamedh" target="_blank"><button class="btn btn-outline-secondary">Twitch</button></a><br><br>
        <a href="https://open.spotify.com/user/oaddeg3bmhapv7nbc4astkjzd" target="_blank"><button class="btn btn-outline-success">Spotify(I don't use it lol)</button></a><br><br>
        <a href="https://steamcommunity.com/profiles/76561198991421737" target="_blank"><button class="btn btn-outline-secondary">Steam(I don't use it much)</button></a><br><br>


    </div>
</center>
</body>
</html>