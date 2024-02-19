<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
    <?php
    $actionStatus = '';
    // try {
    //     if ($_SESSION["updateExecuted"] = True) {
    //         $actionStatus = "Row Update Success.";
    //         $_SESSION["updateExecuted"] = False;
    //     } else if ($_SESSION["deleteExecuted"] = True) {
    //         $actionStatus = "Product deleted successfully.";
    //         $_SESSION["deleteExecuted"] = False;
    //     } else {
    //         $actionStatus = "";
    //     }
    //     echo "<script>function clearActionStatus() { document.getElementById('updateH3').textContent = ''; }</script>";
    //     echo "<script>const timeout = setTimeout(clearActionStatus, 5000);</script>";
    // } catch (Exception $e) {
    //     die("Error: " . $e->getMessage());
    // }
    
    ?>



    <video autoplay muted loop id="myVideo">
        <source src="../media/hi-res-bg.mp4" type="video/mp4" alt="video-unavailable">
    </video>
    <div class="wrapper">
        <header>

        </header>
        <?php
        require 'api/connect.php';



        $sql = "SELECT * FROM product ORDER BY product_id";

        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <h3 id="updateH3">
            <?php echo $actionStatus; ?>
        </h3>
        <main class="table">
            <section class="table-header">
                <h1 class="table-title">Products</h1>
            </section>
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td>
                                    <?= $row['product_id'] ?>
                                </td>

                                <td>
                                    <?php echo $row['product_name']; ?>
                                </td>

                                <td>
                                    <?php echo $row['brand_name'] ?>
                                </td>

                                <td>
                                    <?php echo $row['category']; ?>
                                </td>

                                <td>
                                    <?php echo $row['price']; ?>
                                </td>

                                <td>
                                    <p class="price">
                                        <?php echo '$' . $row['image']; ?>
                                    </p>
                                </td>

                                <td>
                                    <div class="icons">
                                        <?php
                                        echo '<a href="update-product.php?product_id=' . $row["product_id"] . '"><button class="actionBtn"><i class="fa-regular fa-pen-to-square"></i></button></a>';
                                        echo '<a href="delete-product.php?product_id=' . $row["product_id"] . '"><button class="actionBtn"><i class="fa-solid fa-trash-can"></i></button></a>';
                                        ?>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
            <!-- <a href="import-files.php" target="_blank"><button class="add-new-btn" type="button"
                    id="addProductBtn">Import Data</button></a> -->
        </main>
        <a href="import-files.php"><button
                style="height: 35px; background: #010; color: #dfd; border-radius: 12px; font-weight: bold; cursor: pointer; width: 110px;">Import
                Data</button></a>

        <script src="script.js"></script>
</body>

</html>