<?php
require __DIR__ . '/vendor/autoload.php';
$passwd_file = fopen("passwd.txt", 'r');

$Parsedown = new Parsedown();

if (isset($_COOKIE['adminpasswd'])) if (fread($passwd_file, filesize("passwd.txt")) == $_COOKIE['adminpasswd']){
    $content = $Parsedown->text($_POST['markdown']);

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

    echo $engine->render($template, ["background" => $bg, "borders" => $borders, "text" => $text_style, "title" => $_POST['title'], "content" => $content, "date" => "draft"]);
    if (isset($_POST['publish'])){
        $config = file_get_contents('config.json');
        $details = json_decode($config, true);

        $host = $details["sql_creds"]["host"];
        $user = $details["sql_creds"]["user"];
        $password = $details["sql_creds"]["password"];
        $dbname = $details["sql_creds"]["dbname"];
        $dsn = "mysql:host=$host;dbname=$dbname";

        $db = new PDO($dsn, $user, $password);
        $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $qry = $db->prepare('INSERT INTO website.blogposts(title, content, date, markdown, real_title) VALUES(?, ?, ?, ?, ?);');
        $urlencode = urlencode($_POST['title']);
        $qry->bindParam(1, $urlencode);
        $qry->bindParam(2, $content);
        $date = date(DATE_RFC850);
        $qry->bindParam(3, $date);
        $qry->bindParam(4, $_POST['markdown']);
        $qry->bindParam(5, $_POST['title']);
        $qry->execute();

    }


} else {
    http_response_code(403);
    die();
}
