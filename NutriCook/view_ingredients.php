<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Malzeme Kütüphanesi</title>
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
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1; /* Satır üzerine gelindiğinde arka plan rengi değişimi */
        }
        /* Sayfa içi stil düzenlemeleri */
        #ingredientTableBody {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Malzeme Kütüphanesi</h1>
    <table>
        <thead>
            <tr>
                <th>Ad</th>
                <th>Kalori</th>
                <th>Vitamin A</th>
                <th>Vitamin B1</th>
                <th>Vitamin B2</th>
                <th>Vitamin B3</th>
                <th>Vitamin B5</th>
                <th>Vitamin B6</th>
                <th>Vitamin B7</th>
                <th>Vitamin B9</th>
                <th>Vitamin B12</th>
                <th>Vitamin D</th>
                <th>Vitamin E</th>
                <th>Vitamin K</th>
                <th>Vitamin C</th>
                <th>Kalsiyum</th>
                <th>Demir</th>
                <th>Magnezyum</th>
                <th>Fosfor</th>
                <th>Potasyum</th>
                <th>Cinko</th>
                <th>Bakır</th>
                <th>Mangan</th>
                <th>Selenyum</th>
                <th>İyot</th>
                <th>Klorür</th>
                <th>Molibden</th>
            </tr>
        </thead>
        <tbody id="ingredientTableBody">
            <!-- Veriler burada dinamik olarak eklenecek -->
        </tbody>
    </table>

    <script>
        // AJAX ile verileri alıp tabloya ekleyen JavaScript kodu
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_ingredients.php') // Verilerin çekileceği PHP dosyasının adı
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('ingredientTableBody');
                    data.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.ad}</td>
                            <td>${item.kalori}</td>
                            <td>${item.vitamin_a}</td>
                            <td>${item.vitamin_b1}</td>
                            <td>${item.vitamin_b2}</td>
                            <td>${item.vitamin_b3}</td>
                            <td>${item.vitamin_b5}</td>
                            <td>${item.vitamin_b6}</td>
                            <td>${item.vitamin_b7}</td>
                            <td>${item.vitamin_b9}</td>
                            <td>${item.vitamin_b12}</td>
                            <td>${item.vitamin_d}</td>
                            <td>${item.vitamin_e}</td>
                            <td>${item.vitamin_k}</td>
                            <td>${item.vitamin_c}</td>
                            <td>${item.kalsiyum}</td>
                            <td>${item.demir}</td>
                            <td>${item.magnezyum}</td>
                            <td>${item.fosfor}</td>
                            <td>${item.potasyum}</td>
                            <td>${item.cinko}</td>
                            <td>${item.bakir}</td>
                            <td>${item.mangan}</td>
                            <td>${item.selenyum}</td>
                            <td>${item.iyot}</td>
                            <td>${item.klorur}</td>
                            <td>${item.molibden}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>
</html>
