<?php
include 'db.php'; // Veritabanı bağlantısını dahil et

// Yemek ID'sini al
$yemek_id = $_GET['id'] ?? 0;

// Yemek bilgilerini al
$sql = "SELECT * FROM yemekler WHERE yemek_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $yemek_id);
$stmt->execute();
$meal_result = $stmt->get_result()->fetch_assoc();

if (!$meal_result) {
    die("Yemek bulunamadı.");
}

// Malzemeleri al
$sql = "SELECT malzeme_adi, miktar FROM yemek_malzemeleri WHERE yemek_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $yemek_id);
$stmt->execute();
$ingredients_result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Malzemelerin besin değerlerini al
$ingredient_ids = array_column($ingredients_result, 'malzeme_adi');
$placeholders = implode(',', array_fill(0, count($ingredient_ids), '?'));
$sql = "SELECT * FROM malzemeler WHERE ad IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('s', count($ingredient_ids)), ...$ingredient_ids);
$stmt->execute();
$nutrients_result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$nutrient_map = [];
foreach ($nutrients_result as $nutrient) {
    $nutrient_map[$nutrient['ad']] = $nutrient;
}

// İşçilik fiyatını al
$işçilik_fiyatı = $meal_result['işçilik_fiyatı'] ?? 0;

$total_nutrients = [
    'kalori' => 0,
    'vitamin_a' => 0,
    'vitamin_b1' => 0,
    'vitamin_b2' => 0,
    'vitamin_b3' => 0,
    'vitamin_b5' => 0,
    'vitamin_b6' => 0,
    'vitamin_b7' => 0,
    'vitamin_b9' => 0,
    'vitamin_b12' => 0,
    'vitamin_d' => 0,
    'vitamin_e' => 0,
    'vitamin_k' => 0,
    'vitamin_c' => 0,
    'kalsiyum' => 0,
    'demir' => 0,
    'magnezyum' => 0,
    'fosfor' => 0,
    'potasyum' => 0,
    'cinko' => 0,
    'bakir' => 0,
    'mangan' => 0,
    'selenyum' => 0,
    'iyot' => 0,
    'klorur' => 0,
    'molibden' => 0,
];

foreach ($ingredients_result as $ingredient) {
    $nutrient = $nutrient_map[$ingredient['malzeme_adi']] ?? [];
    $miktar = $ingredient['miktar'];

    foreach ($total_nutrients as $key => $value) {
        $total_nutrients[$key] += isset($nutrient[$key]) ? $nutrient[$key] * $miktar : 0;
    }
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yemek Detayları</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .meal-card {
            margin-bottom: 20px;
        }
        .meal-card h2 {
            color: #4CAF50;
        }
        .meal-card p {
            font-size: 1.1em;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .bar-container {
            margin-top: 20px;
        }
        .bar {
            height: 30px;
            line-height: 30px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin: 5px 0;
            padding: 0 10px;
            text-align: left;
            font-weight: bold;
        }
        .bar-container h2 {
            margin: 20px 0 10px;
        }
    </style>
</head>
<body>
    <h1>Yemek Detayları</h1>
        <div class="meal-card">
            <h2><?php echo htmlspecialchars($meal_result['yemek_adi']); ?></h2>
            <p><?php echo htmlspecialchars($meal_result['yemek_aciklama']); ?></p>
            <p><strong>İşçilik Fiyatı:</strong> <?php echo number_format($işçilik_fiyatı, 2); ?> TL</p>
        </div>

        <h2>Malzemeler ve Besin Değerleri</h2>
        <table>
            <thead>
                <tr>
                    <th>Malzeme</th>
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
                    <th>Manganez</th>
                    <th>Selenyum</th>
                    <th>İyot</th>
                    <th>Klorür</th>
                    <th>Molibden</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredients_result as $ingredient): ?>
                    <?php
                    $nutrient = $nutrient_map[$ingredient['malzeme_adi']] ?? [];
                    $miktar = $ingredient['miktar'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ingredient['malzeme_adi']); ?></td>
                        <td><?php echo isset($nutrient['kalori']) ? number_format($nutrient['kalori'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_a']) ? number_format($nutrient['vitamin_a'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b1']) ? number_format($nutrient['vitamin_b1'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b2']) ? number_format($nutrient['vitamin_b2'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b3']) ? number_format($nutrient['vitamin_b3'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b5']) ? number_format($nutrient['vitamin_b5'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b6']) ? number_format($nutrient['vitamin_b6'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b7']) ? number_format($nutrient['vitamin_b7'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b9']) ? number_format($nutrient['vitamin_b9'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_b12']) ? number_format($nutrient['vitamin_b12'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_d']) ? number_format($nutrient['vitamin_d'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_e']) ? number_format($nutrient['vitamin_e'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_k']) ? number_format($nutrient['vitamin_k'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['vitamin_c']) ? number_format($nutrient['vitamin_c'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['kalsiyum']) ? number_format($nutrient['kalsiyum'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['demir']) ? number_format($nutrient['demir'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['magnezyum']) ? number_format($nutrient['magnezyum'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['fosfor']) ? number_format($nutrient['fosfor'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['potasyum']) ? number_format($nutrient['potasyum'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['cinko']) ? number_format($nutrient['cinko'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['bakir']) ? number_format($nutrient['bakir'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['mangan']) ? number_format($nutrient['mangan'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['selenyum']) ? number_format($nutrient['selenyum'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['iyot']) ? number_format($nutrient['iyot'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['klorur']) ? number_format($nutrient['klorur'] * $miktar, 2) : 'Veri Yok'; ?></td>
                        <td><?php echo isset($nutrient['molibden']) ? number_format($nutrient['molibden'] * $miktar, 2) : 'Veri Yok'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Toplam Besin Değerleri</h2>
        <div class="bar-container">
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['kalori'] / 2000 * 100); ?>%;">Kalori: <?php echo number_format($total_nutrients['kalori'], 2); ?> kcal</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_a'] / 900 * 100); ?>%;">Vitamin A: <?php echo number_format($total_nutrients['vitamin_a'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b1'] / 1.2 * 100); ?>%;">Vitamin B1: <?php echo number_format($total_nutrients['vitamin_b1'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b2'] / 1.3 * 100); ?>%;">Vitamin B2: <?php echo number_format($total_nutrients['vitamin_b2'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b3'] / 16 * 100); ?>%;">Vitamin B3: <?php echo number_format($total_nutrients['vitamin_b3'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b5'] / 5 * 100); ?>%;">Vitamin B5: <?php echo number_format($total_nutrients['vitamin_b5'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b6'] / 2 * 100); ?>%;">Vitamin B6: <?php echo number_format($total_nutrients['vitamin_b6'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b7'] / 30 * 100); ?>%;">Vitamin B7: <?php echo number_format($total_nutrients['vitamin_b7'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b9'] / 400 * 100); ?>%;">Vitamin B9: <?php echo number_format($total_nutrients['vitamin_b9'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_b12'] / 2.4 * 100); ?>%;">Vitamin B12: <?php echo number_format($total_nutrients['vitamin_b12'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_d'] / 20 * 100); ?>%;">Vitamin D: <?php echo number_format($total_nutrients['vitamin_d'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_e'] / 15 * 100); ?>%;">Vitamin E: <?php echo number_format($total_nutrients['vitamin_e'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_k'] / 120 * 100); ?>%;">Vitamin K: <?php echo number_format($total_nutrients['vitamin_k'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['vitamin_c'] / 90 * 100); ?>%;">Vitamin C: <?php echo number_format($total_nutrients['vitamin_c'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['kalsiyum'] / 1000 * 100); ?>%;">Kalsiyum: <?php echo number_format($total_nutrients['kalsiyum'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['demir'] / 18 * 100); ?>%;">Demir: <?php echo number_format($total_nutrients['demir'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['magnezyum'] / 400 * 100); ?>%;">Magnezyum: <?php echo number_format($total_nutrients['magnezyum'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['fosfor'] / 700 * 100); ?>%;">Fosfor: <?php echo number_format($total_nutrients['fosfor'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['potasyum'] / 3500 * 100); ?>%;">Potasyum: <?php echo number_format($total_nutrients['potasyum'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['cinko'] / 11 * 100); ?>%;">Cinko: <?php echo number_format($total_nutrients['cinko'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['bakir'] / 0.9 * 100); ?>%;">Bakır: <?php echo number_format($total_nutrients['bakir'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['mangan'] / 2.3 * 100); ?>%;">Manganez: <?php echo number_format($total_nutrients['mangan'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['selenyum'] / 55 * 100); ?>%;">Selenyum: <?php echo number_format($total_nutrients['selenyum'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['iyot'] / 150 * 100); ?>%;">İyot: <?php echo number_format($total_nutrients['iyot'], 2); ?> µg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['klorur'] / 2300 * 100); ?>%;">Klorür: <?php echo number_format($total_nutrients['klorur'], 2); ?> mg</div>
            <div class="bar" style="width: <?php echo min(100, $total_nutrients['molibden'] / 45 * 100); ?>%;">Molibden: <?php echo number_format($total_nutrients['molibden'], 2); ?> µg</div>
        </div>
</body>
</html>
