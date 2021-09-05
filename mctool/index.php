<!DOCTYPE html>
<html>

<head>
    <title>Satya's webpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="../style.css" rel="stylesheet">
    <script async="async" src="https://arc.io/widget.min.js#x2EhNawj"></script>

</head>
<?php
$bgs = ['/images/beacon.png', '/images/stash.png', '/images/whole_world.png', '/images/bunker.png', '/images/throne.png'];
$bg = $bgs[rand(0,sizeof($bgs)-1)];
$text_style = "";
$borders = "border: 2px solid white;";
if (($bg == "/images/stash.png") || ($bg == "/images/throne.png")){
    $text_style = $text_style. " color: white;";
} else {
    $borders = "border: 2px solid black;";
}

?>
<body background="<?php echo $bg; ?>">
<ul class="ul">

    <li style="float:left" class="li"><a class="active" href="/index.php#info">About</a></li>
    <li style="float:left" class="li"><a href="/mctool/index.php">Tools</a></li>
    <li style="float:right" class="li"><a href="/admin.php" class="admin">Admin</a></li>
</ul>

<center>
    <div class="shadow_white" style="<?php echo $borders; ?>">
        <a href="map2png/index.php" style="<?php echo $text_style ?>">
            <h5>Convert map_####.dat to a png</h5>
        </a>
    </div>
</center>

</body>
</html>