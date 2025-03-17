<?php for ($i = 1; $i <= 5; $i++) { echo "Angka ke-$i <br>"; } ?>

<br>

<?php
$x = 1;
while ($x <= 5) {
    echo "Angka $x <br>";
    $x++;
}
?>

<br>

<?php
$buah = ["Apel", "Jeruk", "Mangga", "Pisang"];
foreach ($buah as $b) {
    echo "Buah: $b <br>";
}
?>