<?php
// ---------------------------------------------------------------- //
//                          WEEK 2 DAY 1                            //
// ---------------------------------------------------------------- //
$buidings = [25, 19, 23, 45, 18, 26, 24, 16]; // GIVEN ARRAY
$buildingsLenght = count($buidings); // COUNT LENGHTOF ARRAY
echo "Given Array:  ";
// DISPLAY ARRAY
for ($i = 0; $i < $buildingsLenght; $i++) {
    echo $buidings[$i] . " ";
}
rsort($buidings); // SORTED ARRAY
echo "<br> Sorted Array:  ";
// DISPLAY AFTER SORT
for ($i = 0; $i < $buildingsLenght; $i++) {
    echo $buidings[$i] . " ";
}
echo "<br> Top 3 Buildings Lenght:  ";
// DISPLAY TOP 3
for ($i = 0; $i < 3; $i++) {
    echo $buidings[$i] . " ";
}

echo "<br><br><br>";

// SHOW TABLE IN ROW AND COLUMNS
function tableForm($givenRow, $givenCol)
{
    for ($row = 1; $row <= $givenRow; $row++) {
        for ($col = 1; $col <= $givenCol; $col++) {
            echo $row * $col . " ";
        }
        echo "<br>";
    }
}
tableForm(5, 6);
