<?php
include("con.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['upload'])) {
        $dir = "img/";
        $imgFile = $dir . basename($_FILES["image"]["name"]);
        $uploading = 1;
        $imageFileType = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) $uploading = 1;
        else $uploading = 0;

        if (file_exists($imgFile)) $uploading = 0;

        if ($_FILES["image"]["size"] > 500000) $uploading = 0;

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") $uploading = 0;

        if ($uploading == 0) echo "Sorry, your file was not uploaded.";
        else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $imgFile)) {
                $image = $_FILES["image"]["name"];
                $query = "INSERT INTO gallery (image) VALUES (?)";
                $state = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($state, "s", $image);
                mysqli_stmt_execute($state);
                header("Location: gallery.php");
                exit();
            } else echo "Sorry, there was an error uploading your file.";
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "SELECT image FROM gallery WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $query = "DELETE FROM gallery WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $imgFile = "img/" . $image;
        if (file_exists($imgFile)) {
            unlink($imgFile);
        }

        header("Location: gallery.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project.02-CSS (Cat-Gallery)</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .gallery-container{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
        }
        .gallery-item {
            position: relative;
            text-align: center;
        }
        .gallery-item form {
            display: inline;
        }

        .gallery-item img{
            width:400px
        }
        .delete-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <div class="navbar">
        <ul class="ul-navbar">
            <li class="li-navbar">
                <a href="index.html" class="a-navbar">HOME</a>
            </li>
            <li class="li-navbar">
                <a href="gallery.html" class="a-navbar">GALLERY</a>
            </li>
            <li class="li-navbar">
                <a href="blog.html" class="a-navbar">BLOG</a>
            </li>
            <li class="li-navbar">
                <a href="contact.html" class="a-navbar">CONTACT</a>
            </li>
        </ul>
    </div>
    <!-- NAVIGATION BAR END -->

    <!-- CONTENT -->
    <div class="content" style="text-align: center;">
        <br>
        <a id="typewriter"></a> 

        <br>
        <a>Tujuan dibuatnya web ini untuk memenuhi Tugas Project.04-PHP.MYSQL dari Mata Kuliah Pemograman Web</a>
    </div>
    <!-- CONTENT END -->

    <div class="gallery-form" style="text-align: center;">
        <h2>Tambah Gambar</h2>
        <form action="gallery.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <button type="submit" name="upload">Upload Image</button>
        </form>
    </div>

    <!-- FOOTER -->
    <div class="footer" style="text-align: center;">
        <br>
        <h2>GALLERY</h2>
        <div class="gallery-container">
            <?php
                $query = "SELECT * FROM gallery";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)){
                    $id = $row["id"];
                    $image = $row["image"];
                    echo "
                        <div class=\"gallery-item\">
                            <img src=\"img/$image\">
                            <form method=\"post\" action=\"gallery.php\" onsubmit=\"return konfirmasi();\">
                                <input type=\"hidden\" name=\"id\" value=\"$id\">
                                <button type=\"submit\" name=\"delete\" class=\"delete-btn\">Delete</button>
                            </form>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
    <!-- FOOTER END -->
    <script src="script.js"></script>
    <script>
        var text = "Halo.... Perkenalkan nama saya Feykha Koem dengan NIM 220211060326";
        var speed = 100; // milliseconds per character

        function typeWriter() {
            if (text.length > 0) {
                document.getElementById("typewriter").innerHTML += text.charAt(0);
                text = text.substring(1);
                setTimeout(typeWriter, speed);
            }
        }

        typeWriter();
        function konfirmasi(){return confirm('Apakah anda yakin mau hapus blog ini ?')}
    </script>
</body>
</html>
