<?php
$passwd_file = fopen("passwd.txt", 'r');
$ip = $_SERVER['REMOTE_ADDR'];
$cookie_login = false;
if(sizeof($_POST) != 0) {
    $config = file_get_contents('config.json');
    $details = json_decode($config, true);

    $host = $details["sql_creds"]["host"];
    $user = $details["sql_creds"]["user"];
    $password = $details["sql_creds"]["password"];
    $dbname = $details["sql_creds"]["dbname"];
    $dsn = "mysql:host=$host;dbname=$dbname";


    $db = new PDO($dsn, $user, $password);
    $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    if(!isset($_POST['g-recaptcha-response'])){
        $login_successful = false;
    } else {
        if (fread($passwd_file, filesize("passwd.txt")) == hash("sha256", $_POST['password'])) {
            $secret_file = fopen("recaptcha.txt", 'r');
            $secret = fread($secret_file, filesize("recaptcha.txt"));
            $fields = [
                'secret' => $secret,
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
            $fields_string = http_build_query($fields);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch), true);
            if ($result['success']){
                $login_successful = true;
            } else {
                $login_successful = false;
            }
        } else {
            $login_successful = false;
        }
    }

    $qry = $db->prepare('INSERT INTO admin_logins(ip,attempted_password,captcha,success) VALUES(?, ?, ?, ?);');
    $qry->bindParam(1, $ip);
    $qry->bindParam(2, $_POST['password']);
    $qry->bindParam(3, $result['success'], PDO::PARAM_BOOL);
    $qry->bindParam(4, $login_successful, PDO::PARAM_BOOL);
    $qry->execute();
}

if (isset($_COOKIE['adminpasswd'])) if (fread($passwd_file, filesize("passwd.txt")) == $_COOKIE['adminpasswd']){
    $login_successful = true;
    $cookie_login = true;
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>admin page</title>
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
$recaptcha_theme = "dark";
$borders = "border: 2px solid white;";
if (($bg == "images/stash.png") || ($bg == "images/throne.png")){
    $text_style = $text_style. " color: white;";
    $recaptcha_theme = "light";
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
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8556006122224174"
        crossorigin="anonymous"></script>
<!-- admin1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8556006122224174"
     data-ad-slot="3162806344"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<center>
    <div class="shadow_white" style="<?php echo $borders; ?>">
        <?php

        if(isset($login_successful)) {
            if (!$login_successful) {
                echo "
            <h3 style='$text_style'>Wrong password or invalid captcha, press <kbd>Alt</kbd> <kbd>F4</kbd> to try again</h3>
            <form action=\"admin.php\" method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"password\" class=\"form-control\" style=\"width: 10%\" name=\"password\" placeholder=\"Password\"'>
            <br>
            <div id='recaptcha'></div><br>
            <input class=\"btn btn-outline-danger\" type=\"submit\" value=\"Log in\" name=\"submit\">
        </form>
            ";
            } else {
                if(!$cookie_login) setcookie("adminpasswd", hash("sha256", $_POST['password']));
                echo "
                <form action='preview.php' method='post' enctype='multipart/form-data' target='_blank'>
                <input name=\"title\" cols=\"40\" rows=\"5\" class='form-control' style='width: 10%' placeholder='title'><br>
                <textarea name=\"markdown\" cols=\"40\" rows=\"5\" class='form-control' style='width: 100%; float: left;' placeholder='markdown/html'></textarea>
                <br>
                <input type='checkbox' name='publish'><label>Publish</label><br>
                <input class=\"btn btn-outline-danger\" type=\"submit\" value=\"Preview\" name=\"submit\">
                </form>
                ";
            }
        } else {
            echo "
            <form action=\"admin.php\" method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"password\" class=\"form-control\" style=\"width: 10%\" name=\"password\" placeholder=\"Password\"'>
            <br>
            <div id='recaptcha'></div><br>
            <input class=\"btn btn-outline-danger\" type=\"submit\" value=\"Log in\" name=\"submit\">
        </form>
            ";
        }
        ?>
        <br>
        <br>

    </div>
</center>

<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render("recaptcha", {sitekey: "6LclhTscAAAAANhAWi6uqq5btYcFXb0d9AcwhEIY",theme: "<?php echo $recaptcha_theme ?>"});
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>

</body>
</html>