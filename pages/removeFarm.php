<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FILE_PATH = "../data/farms.json";
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);
    $farm = null;
    if (isset($_POST['remove-name']) && isset($_POST['remove-owner'])) {
        foreach ($JSON_DATA as &$item) {
            if ($item['name'] == $_POST['remove-name'] && $item['owner'] == $_POST['remove-owner'])
                unset($JSON_DATA[array_search($item, $JSON_DATA)]);
        }
    }
    file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);
}
header("Location:myFarms.php");