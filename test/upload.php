<?php
if ($_POST["label"]) {
    $label = $_POST["label"];
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["attach"]["name"]);
$extension = end($temp);
if ((($_FILES["attach"]["type"] == "image/gif")
|| ($_FILES["attach"]["type"] == "image/jpeg")
|| ($_FILES["attach"]["type"] == "image/jpg")
|| ($_FILES["attach"]["type"] == "image/pjpeg")
|| ($_FILES["attach"]["type"] == "image/x-png")
|| ($_FILES["attach"]["type"] == "image/png"))
&& ($_FILES["attach"]["size"] < 2000000000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["attach"]["error"] > 0) {
        echo "Return Code: " . $_FILES["attach"]["error"] . "<br>";
    } else {
        $filename = $label.$_FILES["attach"]["name"];
        echo "Upload: " . $_FILES["attach"]["name"] . "<br>";
        echo "Type: " . $_FILES["attach"]["type"] . "<br>";
        echo "Size: " . ($_FILES["attach"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["attach"]["tmp_name"] . "<br>";

        if (file_exists("uploads/" . $filename)) {
            echo $filename . " already exists. ";
        } else {
            move_uploaded_file($_FILES["attach"]["tmp_name"],
            "uploads/" . $filename);
            echo "Stored in: " . "uploads/" . $filename;
        }
    }
} else {
    echo "Invalid file";
}
?>