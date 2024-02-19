
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

                // initializa a value for the number of rows to be read
                $rowCount = 0;

                // Loop through each row using a while loop and feof function
                while (!feof($handle)) {
                    // create a variable to hold the data &
                    // pass each row into the variable
                    $rows = fgetcsv($handle);

                    // condition for if the rows are not empty.
                    if (($rows !== false) && ($headers !== false)) {
                        $dataset = array_combine($headers, $rows);
                    }
                }

                // Close the CSV file handle
                print_r($dataset);
                // $product_name = array_column( $dataset, "Product Name");
                // fclose($handle);
                // print_r($product_name);
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