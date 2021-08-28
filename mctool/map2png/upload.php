<?php
$target_dir = "uploads/map2png-perl/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.\n";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "dat") {
    echo "Sorry, the file should be a .dat file\n";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded, processing file\n";
        shell_exec("perl ". $target_dir. "map2png.pl ". $target_dir. basename( $_FILES["fileToUpload"]["name"]));
        $file_url = str_replace(".dat", ".png", $target_dir. basename( $_FILES["fileToUpload"]["name"]));
        header("Location: ". $file_url);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>