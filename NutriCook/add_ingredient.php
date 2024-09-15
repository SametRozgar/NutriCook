<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Malzeme Ekle</title>
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
        }
        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Doğal yeşil buton arka planı */
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Buton rengi üzerine gelindiğinde */
            transform: scale(1.05); /* Buton üzerine gelindiğinde hafif büyüme efekti */
        }
        input[type="submit"]:active {
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
    <h1>Malzeme Ekle (Bir Gıramındaki Besin Değerlerini Yazınız)</h1>
    <form action="save_ingredient.php" method="post">
        <label>Malzeme Adı: <input type="text" name="ad" required></label>
        <label>Kalori: <input type="number" name="kalori" step="0.01"></label>
        <label>Vitamin A: <input type="number" name="vitamin_a" step="0.01"></label>
        <label>Vitamin B1: <input type="number" name="vitamin_b1" step="0.01"></label>
        <label>Vitamin B2: <input type="number" name="vitamin_b2" step="0.01"></label>
        <label>Vitamin B3: <input type="number" name="vitamin_b3" step="0.01"></label>
        <label>Vitamin B5: <input type="number" name="vitamin_b5" step="0.01"></label>
        <label>Vitamin B6: <input type="number" name="vitamin_b6" step="0.01"></label>
        <label>Vitamin B7: <input type="number" name="vitamin_b7" step="0.01"></label>
        <label>Vitamin B9: <input type="number" name="vitamin_b9" step="0.01"></label>
        <label>Vitamin B12: <input type="number" name="vitamin_b12" step="0.01"></label>
        <label>Vitamin D: <input type="number" name="vitamin_d" step="0.01"></label>
        <label>Vitamin E: <input type="number" name="vitamin_e" step="0.01"></label>
        <label>Vitamin K: <input type="number" name="vitamin_k" step="0.01"></label>
        <label>Vitamin C: <input type="number" name="vitamin_c" step="0.01"></label>
        <label>Kalsiyum: <input type="number" name="kalsiyum" step="0.01"></label>
        <label>Demir: <input type="number" name="demir" step="0.01"></label>
        <label>Magnezyum: <input type="number" name="magnezyum" step="0.01"></label>
        <label>Fosfor: <input type="number" name="fosfor" step="0.01"></label>
        <label>Potasyum: <input type="number" name="potasyum" step="0.01"></label>
        <label>Cinko: <input type="number" name="cinko" step="0.01"></label>
        <label>Bakır: <input type="number" name="bakir" step="0.01"></label>
        <label>Mangan: <input type="number" name="mangan" step="0.01"></label>
        <label>Selenyum: <input type="number" name="selenium" step="0.01"></label>
        <label>İyot: <input type="number" name="iyot" step="0.01"></label>
        <label>Klorür: <input type="number" name="klorur" step="0.01"></label>
        <label>Molibden: <input type="number" name="molibden" step="0.01"></label>
        <input type="submit" value="Kaydet">
    </form>
   
</body>
</html>
