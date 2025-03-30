<?php
include "./app/main_proc.php"; 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$file = "app/views/{$page}.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>PLSP Enrollment System</title>
</head>
<body data-bs-spy="scroll" data-bs-target="#navlinks"  data-bs-smooth-scroll="true">
    <?php include './shared/nav.php';?>
    
    <div class="container-fluid pt-5 px-5">
        <div class="pt-5"></div>
        <?php
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<p>Page not found.</p>";
        }
        ?>
    </div>
    <?php include './shared/footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./src/js/app.js"></script>
</body>
</html>