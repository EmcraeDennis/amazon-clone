<?php
require '../api/connect.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["csv_file"])) {
        $file = $_FILES["csv_file"];

        // Check if file is CSV
        $file_info = pathinfo($file["name"]);
        if ($file_info["extension"] == "csv") {
            $filename = $file["tmp_name"];

            // access CSV file using method fopen and option r which is for read/parsing.
            // if statement to determine what happens if the file has been opened for parsing
            if (($handle = fopen($filename, "r")) !== FALSE) {
                //get the headers/column names. This is very important
                $headers = fgetcsv($handle);

                // initialize an empty array to store the date 
                $dataArray = [];

                // Loop through each row using a while loop
                while (($data = fgetcsv($handle)) !== false) {
                    // create an empty array to hold the data
                    $row = [];
                    // iterate through each header and data field
                    foreach ($headers as $index => $header) {
                        // check if there is corresponding data for the cell
                        if (isset($data[$index])) {
                            // Remove dollar sign if the header is 'Price'
                            if ($header === 'Selling Price') {
                                // Remove dollar sign using str_replace
                                $data[$index] = str_replace('$', '', $data[$index]);
                            }
                            // if the data exists add it to the row array with the corresponding header
                            $row[$header] = $data[$index];
                        } else {
                            // add an empty string for that cell
                            $row[$header] = 'Empty String';
                        }
                    }
                    $dataArray[] = $row;
                }
                // Close the CSV file handle
                fclose($handle);

                $product_name = array_column($dataArray, 'Product Name');

            } else {
                echo "Failed to open file.";
            }
        } else {
            echo "Please upload a CSV file.";
        }
    } else {
        echo "No file uploaded.";
    }
}

// $pdo_conn = $pdo;
// function insertProducts(
//     $pdo,
//     $product_name,
//     $brand_id,
//     $price,
//     $image,
//     $category,
//     $product_description,
//     $direction_to_use,
//     $quantity,
//     $product_url,
//     $color,
//     $model_number,
//     $dimension_id,
//     $size_quantity_variant
// ) {
try {
    $stmt = $pdo->prepare("INSERT INTO products_table 
        (
        product_name,
        brand_name,
        price,
        image,
        category,
        product_description,
        direction_to_use,
        quantity,
        product_url,
        color,
        model_number,
        size_quantity_variant
        ) VALUES (
        :product_name,
        :brand_name,
        :price,
        :image,
        :category,
        :product_description,
        :direction_to_use,
        :quantity,
        :product_url,
        :color,
        :model_number,
        :size_quantity_variant
        )");

    for ($i = 0; $i < count($dataArray); $i++) {
        $product_name = $dataArray[$i]['Product Name'];
        $brand_name = $dataArray[$i]['Brand Name'];
        $price = $dataArray[$i]['Selling Price'];
        $image = $dataArray[$i]['Image'];
        $category = $dataArray[$i]['Category'];
        $product_description = $dataArray[$i]['Product Description'];
        $direction_to_use = $dataArray[$i]['Direction To Use'];
        $quantity = $dataArray[$i]['Quantity'];
        $product_url = $dataArray[$i]['Product Url'];
        $color = $dataArray[$i]['Color'];
        $model_number = $dataArray[$i]['Model Number'];
        $size_quantity_variant = $dataArray[$i]['Size Quantity Variant'];

        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':brand_name', $brand_name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':direction_to_use', $direction_to_use);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':product_url', $product_url);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':model_number', $model_number);
        $stmt->bindParam(':size_quantity_variant', $size_quantity_variant);

        $stmt->execute();
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
