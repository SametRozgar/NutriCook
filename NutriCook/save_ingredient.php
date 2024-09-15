<?php
include 'db.php';

$ad = $_POST['ad'];
$kalori = $_POST['kalori'];
$vitamin_a = $_POST['vitamin_a'];
$vitamin_b1 = $_POST['vitamin_b1'];
$vitamin_b2 = $_POST['vitamin_b2'];
$vitamin_b3 = $_POST['vitamin_b3'];
$vitamin_b5 = $_POST['vitamin_b5'];
$vitamin_b6 = $_POST['vitamin_b6'];
$vitamin_b7 = $_POST['vitamin_b7'];
$vitamin_b9 = $_POST['vitamin_b9'];
$vitamin_b12 = $_POST['vitamin_b12'];
$vitamin_d = $_POST['vitamin_d'];
$vitamin_e = $_POST['vitamin_e'];
$vitamin_k = $_POST['vitamin_k'];
$vitamin_c = $_POST['vitamin_c'];
$kalsiyum = $_POST['kalsiyum'];
$demir = $_POST['demir'];
$magnezyum = $_POST['magnezyum'];
$fosfor = $_POST['fosfor'];
$potasyum = $_POST['potasyum'];
$cinko = $_POST['cinko'];
$bakir = $_POST['bakir'];
$mangan = $_POST['mangan'];
$selenium = $_POST['selenium'];
$iyot = $_POST['iyot'];
$klorur = $_POST['klorur'];
$molibden = $_POST['molibden'];

$sql = "INSERT INTO malzemeler (
    ad, kalori, vitamin_a, vitamin_b1, vitamin_b2, vitamin_b3, vitamin_b5,
    vitamin_b6, vitamin_b7, vitamin_b9, vitamin_b12, vitamin_d, vitamin_e,
    vitamin_k, vitamin_c, kalsiyum, demir, magnezyum, fosfor, potasyum, cinko,
    bakir, mangan, selenyum, iyot, klorur, molibden
) VALUES (
    '$ad', '$kalori', '$vitamin_a', '$vitamin_b1', '$vitamin_b2', '$vitamin_b3',
    '$vitamin_b5', '$vitamin_b6', '$vitamin_b7', '$vitamin_b9', '$vitamin_b12',
    '$vitamin_d', '$vitamin_e', '$vitamin_k', '$vitamin_c', '$kalsiyum', '$demir',
    '$magnezyum', '$fosfor', '$potasyum', '$cinko', '$bakir', '$mangan', '$selenium',
    '$iyot', '$klorur', '$molibden'
)";

if ($conn->query($sql) === TRUE) {
    echo "Yeni malzeme başarıyla eklendi.";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
