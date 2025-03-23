<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
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
    // Koneksi ke database
    $mysqli = new mysqli('localhost', 'root', '', 'nwind');

    // Periksa koneksi
    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    // Query dengan JOIN tambahan ke suppliers jika ingin mengambil CompanyName
    $sql = "SELECT products.ProductID, products.ProductName, products.UnitPrice, 
                   categories.CategoryName, suppliers.CompanyName 
            FROM products
            JOIN categories ON products.CategoryID = categories.CategoryID
            JOIN suppliers ON products.SupplierID = suppliers.SupplierID";
    
    $result = $mysqli->query($sql);
    
    if ($result->num_rows > 0) {
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

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ProductID']}</td>
                    <td>{$row['ProductName']}</td>
                    <td>{$row['CategoryName']}</td>
                    <td>{$row['CompanyName']}</td>
                    <td>{$row['UnitPrice']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Tidak ada data produk.</p>";
    }

    // Tutup koneksi
    $mysqli->close();
    ?>

</body>
</html>
