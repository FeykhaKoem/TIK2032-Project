<?php
include ("con.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO blog (title, content) VALUES (?, ?)"; 
    $st = $con->prepare($query);
    $st->bind_param("ss", $title, $content);

    if( $st->execute()) header("Location: blog.php");
    else echo "Error";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Membuat Blog Baru</title>
        <style>
            body{
                background-color: beige;
                color: black;
                font-family: Arial, sans-serif;
            }

            .container{
                max-width: 400px;
                margin: 50px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                background-color: #fff;
            }

            .container h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .form-group{
                display: flex;
                flex: 0 0 auto;
                flex-flow: row wrap;
                align-items: center;
                margin-bottom: 0;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
            }

            .form-group button {
                width: 100%;
                padding: 10px;
                background-color: pink;
                color: black;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }
            .form-group button:hover {
                background-color: #ffb6c1; /* Slightly darker pink */
            }

            .form-control{
                display: block;
                width: 100%;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
            }
            .btn{
                padding: 10px;
                background-color: palegoldenrod;
            }
            .back{
                margin: 5px;
                display: grid;
                place-items: center;
            }

            .back a{
                text-decoration: none;
                color:black
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Tambah Blog</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" id="name" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
            <div class="back">
                <a href="blog.php" class="btn">Kembali</a>
            </div>
        </div>
    </body>
</html>