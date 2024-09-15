<?php
include 'db.php'; // Veritabanı bağlantısını dahil et

// Yemekleri al
$sql = "SELECT * FROM yemekler";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yemekleri Gör</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-image: url('uploads/bg.jpg'); /* Arka plan resmi */
    background-color: #f5f5f5; /* Gri arka plan, resmi görünür kılmak için */
    background-size: cover; /* Resmi sayfayı kaplayacak şekilde ayarla */
    background-attachment: fixed; /* Arka planı sabit tutar */
    color: #333; /* Koyu gri yazı rengi */
    margin: 0;
    padding: 0;
    text-align: center;
}
        h1 {
            background-color: #4CAF50; /* Doğal yeşil başlık arka planı */
            color: white;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .meal-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .meal-card {
            flex: 1 1 calc(25% - 20px);
            border: 1px solid #d1e0e0; /* Soluk mavi-yeşil border */
            border-radius: 10px;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .meal-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .meal-card h2 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #4CAF50; /* Doğal yeşil başlık rengi */
        }
        .meal-card p {
            font-size: 0.9em;
            color: #666;
        }
        .meal-card button {
            background-color: #4CAF50; /* Doğal yeşil buton arka planı */
            border: none;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .meal-card button:hover {
            background-color: #45a049; /* Buton hover rengi */
            transform: scale(1.05); /* Buton hover efekti */
        }
        .meal-card:hover {
            border-color: #4CAF50; /* Kart hover border rengi */
            transform: translateY(-5px); /* Kart hover efekti */
        }

        @media (max-width: 1200px) {
            .meal-card {
                flex: 1 1 calc(33.333% - 20px);
            }
        }

        @media (max-width: 900px) {
            .meal-card {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 600px) {
            .meal-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Yemekler</h1>
    <div class="container">
        <div class="meal-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="meal-card">';
                    echo '<img src="' . htmlspecialchars($row['foto']) . '" alt="' . htmlspecialchars($row['yemek_adi']) . '">';
                    echo '<h2>' . htmlspecialchars($row['yemek_adi']) . '</h2>';
                    echo '<p>' . htmlspecialchars($row['yemek_aciklama']) . '</p>';
                    echo '<button onclick="window.location.href=\'meal_details.php?id=' . $row['yemek_id'] . '\'">Detayları Gör</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>Yemek bulunamadı.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
