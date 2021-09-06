<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blogposts</title>
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
<body background="<?php echo $bg ?>">
<ul class="ul">
    <li style="float:left" class="li"><a class="active" href="/index.php#info">About</a></li>
    <li style="float:left" class="li"><a href="/mctool/index.php">Tools</a></li>
    <li style="float:right" class="li"><a href="/admin.php" class="admin">Admin</a></li>
    <li style="float:left" class="li"><a href="/blogposts.php">Blog</a></li>
</ul>
<center>

    <?php

    $config = file_get_contents('config.json');
    $details = json_decode($config, true);

    $host = $details["sql_creds"]["host"];
    $user = $details["sql_creds"]["user"];
    $password = $details["sql_creds"]["password"];
    $dbname = $details["sql_creds"]["dbname"];
    $dsn = "mysql:host=$host;dbname=$dbname";


    $db = new PDO($dsn, $user, $password);
    $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $qry = $db->prepare('SELECT * FROM website.blogposts;');
    $qry->execute();

    $res = $qry->fetchAll();

    require __DIR__ . '/vendor/autoload.php';

    $engine = new StringTemplate\Engine;

    for ($i=0;$i<count($res);$i++){
        $first = "";
        if ($i == 0) $first = "first";
        echo $engine->render("
        
        <div class='shadow_white {first}' style='{borders} {textstyle} cursor: pointer;' onclick=\"location.href='{link}';\" >
        
        <h3 onclick=\"location.href='{link}';\">{title}</h3><label style='float: left' onclick=\"location.href='{link}';\">posted on {date}</label>
                
        </div>
        
        ", ["borders" => $borders, "textstyle" => $text_style, "title" => $res[$i]["real_title"], "date" => $res[$i]['date'], "link" => "https://satyamedh.ml/blog/". $res[$i]["title"], "first" => $first]);
    }

    ?>

</center>
</body>
</html>