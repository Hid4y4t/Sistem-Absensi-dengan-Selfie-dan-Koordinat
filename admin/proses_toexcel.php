<?php
if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid CSV file
    if ($fileType != "csv") {
        echo "Only CSV files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "File not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "File uploaded successfully.";

            // Langkah 3: Proses Import ke Tabel users_k dengan ID Otomatis
            $csvFile = $target_file; // Path ke file CSV
            $tableName = "users_k"; // Nama tabel di database

            require_once '../koneksi/koneksi.php';
            // Baca file CSV dan generate ID otomatis
            $csvData = array_map('str_getcsv', file($csvFile));
            $idCounter = 1;

            foreach ($csvData as $key => $row) {
                // Generate ID dengan format "KRY001", "KRY002", dst.
                $id_karyawan = 'KRY' . str_pad($idCounter, 3, '0', STR_PAD_LEFT);

                // Assign ID ke kolom pertama di setiap baris
                array_unshift($csvData[$key], $id_karyawan);

                // Increment counter untuk ID berikutnya
                $idCounter++;
            }

            // Buat temporary file CSV yang sudah dimodifikasi
            $tempCsvFile = tempnam(sys_get_temp_dir(), 'csv');
            $fp = fopen($tempCsvFile, 'w');

            foreach ($csvData as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);

            // Import data ke tabel users_k
            $query = "LOAD DATA LOCAL INFILE '$tempCsvFile' INTO TABLE $tableName FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES";

            $result = $conn->query($query);

            if ($result) {
                echo "Data imported successfully.";
            } else {
                echo "Error importing data: " . $conn->error;
            }

            // Hapus temporary file CSV
            unlink($tempCsvFile);

            $conn->close();
        } else {
            echo "Error uploading file.";
        }
    }
}
?>
