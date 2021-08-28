<!DOCTYPE html>
<html>

<head>
    <title>Satya's webpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="../../style.css" rel="stylesheet">

</head>

<body background="../../images/map_2.png">
<ul>

    <li style="float:left"><a href="../../index.php">About</a></li>
    <li style="float:left"><a class="active">Tools</a></li>
</ul>

<center>
    <div class="shadow_white">
        <h1>Credits to <a href="https://www.reddit.com/user/ExtraStrengthFukitol/" target="_blank">u/ExtraStrengthFukitol</a> for the script, I found it on <a href="https://www.reddit.com/r/Minecraft/comments/ek5yp3/convert_map_dat_to_png_in_114_java/" target="_blank">this</a> reddit thread(after hours of searching :/)</h1>

        <h3>To get the map_###.dat file, go to the .minecraft/saves/world_name/data and there should be map files, in MC the map id should be the value of x in map_x.dat. upload it here</h3>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" accept=".dat">
            <input type="submit" value="Upload Image" name="submit">
        </form>


    </div>
</center>

</body>
</html>