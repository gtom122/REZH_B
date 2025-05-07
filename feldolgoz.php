<?php
$nev = $_POST['nev'] ?? '';
$email = $_POST['email'] ?? '';
$darab = $_POST['darab'] ?? '';
$nap = $_POST['nap'] ?? '';

$hiba = false;
$napok = ["hétfő", "kedd", "szerda", "csütörtök", "péntek"];

function ellenoriz($allapot) {
    return $allapot ? "Helyes" : "Hibás!";
}

$nevHelyes = strlen($nev) >= 8 && strlen($nev) <= 30;
$emailHelyes = preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $email);
$darabHelyes = is_numeric($darab) && $darab >= 1 && $darab <= 10;
$napHelyes = in_array($nap, $napok);

$hiba = !$nevHelyes || !$emailHelyes || !$darabHelyes || !$napHelyes;

echo "Név: $nev " . ellenoriz($nevHelyes) . "<br>";
echo "E-mail: $email " . ellenoriz($emailHelyes) . "<br>";
echo "Darab: $darab " . ellenoriz($darabHelyes) . "<br>";
echo "Nap: $nap " . ellenoriz($napHelyes) . "<br>";

if (!$hiba) {
    
    $conn = new mysqli("localhost", "root", "", "aruhaz");

    if ($conn->connect_error) {
        die("Kapcsolódási hiba: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO rendeles (nev, email, darab, nap) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nev, $email, $darab, $nap);
    $stmt->execute();

    echo "<br><strong>Rendelés elmentve.</strong>";

    $stmt->close();
    $conn->close();
} else {
    echo "<br><strong>Nem történt mentés. Hibás adatok!</strong>";
}
?>
