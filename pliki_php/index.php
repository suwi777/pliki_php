<?php

$katalog = "dokumenty";
if (!file_exists($katalog)) {
    mkdir($katalog);
}
$elementy = scandir($katalog);
if (isset($_POST["folder"])) {
    $nazwa = $_POST["folder"];
    if ($nazwa != "") {
        mkdir($katalog . "/" . $nazwa);
    }
}
if (isset($_POST["plik"])) {
    $nazwa = $_POST["plik"];
    if ($nazwa != "") {
        $plik = fopen($katalog . "/" . $nazwa . ".txt", "w");
        fclose($plik);
    }
}
$elementy = scandir($katalog);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>MOJE PLIKI</h1>
    <div class="katalog">
        <strong>Aktualny katalog:</strong>
        <p>
            <?php
            echo getcwd();
            ?>
        </p>
    </div>
    <h2>ZAWARTOŚĆ KATALOGU</h2>
    <table>
        <tr>
            <th>Nazwa</th>
            <th>Typ</th>
        </tr>

        <?php
        foreach ($elementy as $element) {
            if ($element != "." && $element != "..") {
                echo "<tr>";
                echo "<td>$element</td>";
                if (is_file($katalog . "/" . $element)) {
                    echo "<td>PLIK</td>";
                }
                if (is_dir($katalog . "/" . $element)) {
                    echo "<td>KATALOG</td>";
                }
                echo "</tr>";
            }
        }

        ?>
    </table>
    <div class="formularz">
        <h2>Dodaj element</h2>
        <form method="post">
            <label>Nazwa folderu:</label>
            <input type="text" name="folder">
            <br><br>
            <label>Nazwa pliku tekstowego:</label>
            <input type="text" name="plik">
            <br><br>
            <button type="submit">Utwórz</button>
        </form>
    </div>
</div>
</body>
</html>