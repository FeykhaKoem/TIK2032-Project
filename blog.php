
<?php
    include("con.php");
    
    // Baca Data
    $query = "SELECT * FROM blog";
    $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project.04-PHP.MYSQL</title>
    <link rel="stylesheet" href="style.css">
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
    </div>
    <!-- NAVIGATION BAR END -->

    <!-- CONTENT -->
    <div class="content" style="text-align:center;">
        <br>
        <a id="typewriter"></a> 

        <br>
        <a>Tujuan dibuatnya web ini untuk memenuhi Tugas Project.04-PHP.MYSQL dari Mata Kuliah Pemograman Web</a>
    </div>
    <!-- CONTENT END -->

    <!-- FOOTER -->
    <div class="footer1">
        <ul class="ul-footer1" style="text-align: center;">
            <li class="li-footer1">
                <h2> Random Article</h2>
            </li>
        </ul>
        <div class="insert">
            <a href="create_blog.php" class="btn">Tambah Blog +</a>
        </div>
        
        <?php
        // Hapus Data
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $query = "DELETE FROM blog WHERE id = ?";
            $st = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($st, 'i', $id);

            if(mysqli_stmt_execute($st)) header('Location: blog.php');
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $title = $row['title'];
            $content = $row['content'];
            echo "
            <a href=\"edit_blog.php?id=$id\" class=\"btn\">Edit</a>
            <form method=\"post\" action=\"\" style=\"display:inline;\" onsubmit=\"return konfirmasi()\">
                <input type=\"hidden\" name=\"id\" value=\"$id\">
                <button type=\"submit\" name=\"delete\" class=\"btn\">Delete</button>
            </form>
            <div class=\"footer2\">
                <h1 class=\"p-footer2\">$title</h1>
                    <p>$content</p>    
                    <hr>
            </div>
            ";
        }
        ?>
    </div>
    <!-- FOOTER END -->
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
