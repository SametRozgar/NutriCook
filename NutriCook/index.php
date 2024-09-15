<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
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
        button {
            background-color: #4CAF50; /* Doğal yeşil buton arka planı */
            border: none;
            color: white;
            padding: 15px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #45a049; /* Buton rengi üzerine gelindiğinde */
            transform: scale(1.05); /* Buton üzerine gelindiğinde hafif büyüme efekti */
        }
        button:active {
            background-color: #388e3c; /* Butona tıklanıldığında renk değişimi */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Malzeme Sistemi</h1>
    <button onclick="window.location.href='add_ingredient.php'">Malzeme Ekle</button>
    <button onclick="window.location.href='view_ingredients.php'">Malzeme Kütüphanesi</button>
    <button onclick="window.location.href='make_meal.html'">Yemek Yap</button> <!-- Düzeltme yapıldı -->
    <button onclick="window.location.href='view_meals.php'">Yemekleri Gör</button> <!-- Düzeltme yapıldı -->


    <div class="footer">
        2024 © HEALTH CALCULATOR Tüm Hakları Saklıdır | TASARIM: <a href="https://www.linkedin.com/in/abd%C3%BClsamet-r%C3%B6zgar-31880122a/" target="_blank">SAMET RÖZGAR</a>
    </div>
</body>
</html>
