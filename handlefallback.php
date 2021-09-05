<?php
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!str_starts_with($url, "https://satyamedh.ml/blog/")){
    http_response_code(404);
    include('404.html');
    die();
}

require __DIR__ . '/vendor/autoload.php';

$Parsedown = new Parsedown();



$config = file_get_contents('config.json');
$details = json_decode($config, true);

$host = $details["sql_creds"]["host"];
$user = $details["sql_creds"]["user"];
$password = $details["sql_creds"]["password"];
$dbname = $details["sql_creds"]["dbname"];
$dsn = "mysql:host=$host;dbname=$dbname";


$db = new PDO($dsn, $user, $password);
$db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$postname = substr($url, 26);

$qry = $db->prepare('SELECT * FROM blogposts WHERE title=?');
$qry->bindParam(1, $postname);
$success = $qry->execute();
$res = $qry->fetch();
if (empty($res)){
    http_response_code(404);
    include('404.html');
    die();
}else {

    $bgs = ['/images/beacon.png', '/images/stash.png', '/images/whole_world.png', '/images/bunker.png', '/images/throne.png'];
    $bg = $bgs[rand(0,sizeof($bgs)-1)];
    $text_style = "";
    $borders = "border: 2px solid white;";
    if (($bg == "/images/stash.png") || ($bg == "/images/throne.png")){
        $text_style = $text_style. " color: white;";
    } else {
        $borders = "border: 2px solid black;";
    }


    $engine = new StringTemplate\Engine;
    $template = file_get_contents("templates/blogpage.html");

    echo $engine->render($template, ["background" => $bg, "borders" => $borders, "text" => $text_style, "title" => $res['real_title'], "content" => $res["content"], "date" => $res['date']]);

}
