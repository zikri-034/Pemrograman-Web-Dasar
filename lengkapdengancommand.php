<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        /* Gaya untuk tabel agar terlihat lebih rapi */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Produk</h1>
    
    <?php
    // Membuat koneksi ke database MySQL
    $mysqli = new mysqli('localhost', 'root', '', 'nwind');

    // Periksa apakah koneksi berhasil atau gagal
    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    // Query untuk mengambil data produk, kategori, dan pemasok
    $sql = "SELECT products.ProductID, products.ProductName, products.UnitPrice, 
                   categories.CategoryName, suppliers.CompanyName 
            FROM products
            JOIN categories ON products.CategoryID = categories.CategoryID
            JOIN suppliers ON products.SupplierID = suppliers.SupplierID";
    
    // Menjalankan query dan menyimpan hasilnya dalam variabel $result
    $result = $mysqli->query($sql);
    
    // Mengecek apakah ada data yang ditemukan
    if ($result->num_rows > 0) {
        // Membuka tabel HTML
        echo "<table>
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Perusahaan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>";

        // Loop untuk menampilkan semua data hasil query
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ProductID']}</td>
                    <td>{$row['ProductName']}</td>
                    <td>{$row['CategoryName']}</td>
                    <td>{$row['CompanyName']}</td>
                    <td>{$row['UnitPrice']}</td>
                  </tr>";
        }

        // Menutup tabel HTML
        echo "</tbody></table>";
    } else {
        // Jika tidak ada data yang ditemukan
        echo "<p>Tidak ada data produk.</p>";
    }

    // Menutup koneksi ke database
    $mysqli->close();
    ?>

</body>
</html>
