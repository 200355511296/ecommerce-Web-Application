<?php

include("connection.php");

$rs = Database::search("SELECT `title`,SUM(`invoice`.`qty`) AS `total` FROM `invoice` INNER JOIN product ON product.id = invoice.product_id
GROUP BY `title` ORDER BY `total` DESC LIMIT 5;");

$rs -> num_rows;

$labels = array();
$data = array();

for($i = 0; $i < $rs -> num_rows; $i++){   
    $d = $rs ->fetch_assoc();

    $labels[] = $d["title"];
    $data[] = $d["total"];
}

$json = array();
$json["label"] = $labels;
$json["data"] = $data;

echo json_encode($json);

?>