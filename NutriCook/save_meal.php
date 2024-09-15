<?php
include 'db.php'; // db.php dosyasını dahil et

// Form verilerini al
$yemekAdi = $_POST['mealName'] ?? '';
$yemekAciklama = $_POST['mealDescription'] ?? '';
$photo = $_FILES['photo']['name'] ?? '';
$photoTmpName = $_FILES['photo']['tmp_name'] ?? '';
$photoPath = 'uploads/' . basename($photo);
$laborCost = $_POST['laborCost'] ?? 0;

// Fotoğrafı yükle
if (!empty($photo) && !move_uploaded_file($photoTmpName, $photoPath)) {
    die("Fotoğraf yüklenemedi.");
}

// Yemek verisini veri tabanına ekle
$sql = "INSERT INTO yemekler (yemek_adi, yemek_aciklama, foto, iscilik_fiyati) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("SQL sorgusu hazırlanamadı: " . $conn->error);
}

$stmt->bind_param("sssd", $yemekAdi, $yemekAciklama, $photoPath, $laborCost);

if ($stmt->execute()) {
    $yemekId = $stmt->insert_id;

    // Malzeme verilerini al
    $ingredientSearch = $_POST['ingredientSearch'] ?? [];
    $amounts = $_POST['amount'] ?? [];

    if (count($ingredientSearch) == count($amounts)) {
        foreach ($amounts as $index => $amount) {
            if (isset($ingredientSearch[$index]) && !empty($ingredientSearch[$index])) {
                $malzemeAdi = $ingredientSearch[$index];
                $sql = "INSERT INTO yemek_malzemeleri (yemek_id, malzeme_adi, miktar) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die("SQL sorgusu hazırlanamadı: " . $conn->error);
                }

                $stmt->bind_param("isd", $yemekId, $malzemeAdi, $amount);
                $stmt->execute();
            }
        }
    } else {
        echo "Malzeme veya miktar verileri eksik.";
    }

    echo "Yemek başarıyla kaydedildi.";
} else {
    echo "Yemek kaydedilemedi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
