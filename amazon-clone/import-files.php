<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV File Uploader</title>
    <link rel="stylesheet" href="css/upload-form.css">
</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="../media/stars.mp4" type="video/mp4" alt="video-unavailable">
    </video>
    <!-- File Input -->
    <div class="form">
        <form action="database/read-csv.php" method="post" enctype="multipart/form-data" id="uploadForm">

            <h1 id="myHeader"> Select file</h1>
            <hr />
            <input type="file" name="csv_file" id="fileUpload" accept=".csv">
            <hr />
            <input id="submitBtn" type="submit" value="Upload CSV" name="submit">

        </form>
        <h1></h1>
    </div>


</body>

</html>