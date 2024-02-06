<?php

$jsonString = file_get_contents('/assets/product_data/product.json');

$phpArray = json_decode($jsonString, true); // Second argument set to true for an associative array

foreach ($phpArray as $item) {
    echo $item['name'] . ': ' . $item['price'] . ': ' . $item['was_price'] . ': ' . $item['reviews'] . ': ' . $item['img'] . '<br/>';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Products Page - Bruce Tomalin Task</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Site style -->
    <link href="css/site.css" rel="stylesheet" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $(function() {
            $("#navigation").load("navigation.html");
        });
    </script>
</head>

<body>


    <div id="navigation"></div>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">All Products - Database call</p>
            </div>
        </div>
    </header>
    <!-- Section-->

    <?php

    //Database connection setup

    $config = require 'config.php';
    $configDb = $config['database'];

    try {

        $pdo = new PDO(

            $configDb['connection'] . ';dbname=' . $configDb['name'],
            $configDb['username'],
            $configDb['password'],
            $configDb['options']

        );
    } catch (PDOException $e) {

        die("could not connect");
    }


    //-query  the database table
    $sqlProducts = "SELECT  name, price, was_price, reviews, img FROM products";

    $queryProducts = $pdo->prepare($sqlProducts);

    //echo($sql);

    $queryProducts->execute();

    $resultProducts = $queryProducts->fetchAll();

    // var_dump($resultProducts);


    ?>
    <section class="py-5">
        <div class="text-center text-black">
            <div class="container px-4 px-lg-5 mt-5">
                <h1 class="display-4 fw-bolder">Office Essentials</h1>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a id="sortBtnPrice" class="btn btn-outline-dark mt-auto" href="#">Sort by Price</a></div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a id="sortBtnRev" class="btn btn-outline-dark mt-auto" href="#">Sort by Review</a></div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a id="sortBtnName" class="btn btn-outline-dark mt-auto" href="#">Sort by Name</a></div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a id="sortBtnSaving" class="btn btn-outline-dark mt-auto" href="#">Sort by Saving</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-4 px-lg-5 mt-5">

            <div id="productList" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php

                $fmt = numfmt_create('en_GBP', NumberFormatter::CURRENCY);


                foreach ($resultProducts as $product) {
                    echo '<div class="col mb-5">';
                    echo '<div class="card h-100">';
                    //<!-- Sale badge-->
                    if ($product['was_price'] != null) {
                        echo '<div class="badge bg-orange text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>';
                    }
                    //<!-- Product image-->
                    echo "<img class='card-img-top' src='/assets/product_images/" . $product['img'] . ".jpg' alt=" . $product['img'] . " />";
                    //<!-- Product details-->
                    echo '<div class="card-body p-4">';
                    echo '<div class="text-center">';
                    //<!-- Product name-->
                    echo "<h5 class='fw-bolder'>" . $product['name']  . "</h5>";
                    //<!-- Product price-->
                    $numberWithoutCommas = number_format($product['price'], 2, ".", "");
                    // echo "<p id='price'>" . numfmt_format_currency($fmt, $numberWithoutCommas, "GBP") . "\n </p>";
                    echo "<p id='price'>£" . $numberWithoutCommas . "</p>";
                    if ($product['was_price'] != null) {
                        echo "<p class='text-red'> Was <span class='text-decoration-line-through'>" . numfmt_format_currency($fmt, $product['was_price'], "GBP") . "\n </p>";
                        echo "<p class='hiddenP'> <span style='display: none'>" . $product['was_price'] . "</span></p>";
                    } else {
                        echo "<p class='hiddenP'> <span style='display: none'>0</span></p>";
                    }
                    echo '</div>';
                    echo '</div>';
                    //<!-- Product actions-->
                    echo '<div class="text-center text-green">';
                    if ($product['reviews'] != null) {
                        echo '<p id="review-score">' . $product['reviews'] . '% Review Score</p>';
                        echo "<p class='hiddenR'> <span style='display: none'>" . $product['reviews'] . "</span></p>";
                    } else {
                        echo "<p class='hiddenR'> <span style='display: none'>0</span></p>";
                    }
                    echo '</div>';
                    echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                    echo '<div class="text-center"><a class="btn btn-outline-dark btn-orange mt-auto" href="#">Add to Basket</a></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Bruce Tomalin 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="js/product_sort.js"></script>
</body>

</html>