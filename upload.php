<?php
if (isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $upload0k = 1;

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000000) {
                $fileNameNew = "log".".".$fileActualExt;
                $fileDestination = "java/uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                shell_exec("javac -cp java/pdfbox/* java/src/pdf_txt.java");
                shell_exec("java -cp java/pdfbox/* java/src/pdf_txt.java");

                header("Location:converted.html"); //Redirect to website 2 after user upload a pdf file
                echo "File is uploaded successfully";
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}

?>