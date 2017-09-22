<?php
$filterData = $_GET['data'];

$json_data = '<h2>Absofruitly Delicious</h2>

                <p>When you’re craving something cool, add ice cream or sorbet to your favorite Sara Lee dessert. You
                    can go way beyond vanilla with these fun, fruity flavor combinations: </p>';


$json_data = str_replace("\r\n",'',$json_data);
$json_data = str_replace("\n",'',$json_data);

echo $json_data;
exit;
?>