<?php
// FUNCTION 1 & 2
function decimalToBinary($decimal) {
    if ($decimal > 3999) {
        echo "<br>";
        echo "Error: Number exceeds maximum limit of 3999.";
        return;
    }
    
    $binary = decbin($decimal);
    return $binary;
}

function decimalToRoman($decimal) {
    if ($decimal > 3999) {
        echo "<br>";
        echo "Error: Number exceeds maximum limit of 3999.";
        return;
    }
    
    $roman = "";
    $decimalValues = array(1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1);
    $romanSymbols = array("M", "CM", "D", "CD", "C", "XC", "L", "XL", "X", "IX", "V", "IV", "I");
    
    for ($i = 0; $i < count($decimalValues); $i++) {
        while ($decimal >= $decimalValues[$i]) {
            $roman .= $romanSymbols[$i];
            $decimal -= $decimalValues[$i];
        }
    }
    
    return $roman;
}
// FUNCTION 3 & 4
function binaryToDecimal($binary) {
    $decimal = bindec($binary);
    return $decimal;
}

function romanToDecimal($roman) {
    $romanNumerals = array(
        "M" => 1000,
        "CM" => 900,
        "D" => 500,
        "CD" => 400,
        "C" => 100,
        "XC" => 90,
        "L" => 50,
        "XL" => 40,
        "X" => 10,
        "IX" => 9,
        "V" => 5,
        "IV" => 4,
        "I" => 1
    );
    
    $decimal = 0;
    $previousValue = 0;
    
    for ($i = 0; $i < strlen($roman); $i++) {
        $currentValue = $romanNumerals[$roman[$i]];
        
        if ($currentValue > $previousValue) {
            $decimal += $currentValue - (2 * $previousValue);
        } else {
            $decimal += $currentValue;
        }
        
        $previousValue = $currentValue;
    }
    
    return $decimal;
}
// PART 3
function checkAndConvertNumber($number) {
    $isDecimal = false;
    $isBinary = false;
    $isRoman = false;
    // Check if the number is decimal
    if (preg_match('/^[+-]?\d+$/', $number)) {
        $isDecimal = true;
        $decimal = intval($number);
        // Convert decimal to binary
        $binary = decimalToBinary($decimal);
        // Convert decimal to roman
        $roman = decimalToRoman($decimal);
    }
    // Check if the number is binary
    if (preg_match('/^[01]+$/', $number)) {
        $isBinary = true;
        $binary = $number;
        
        // Convert binary to decimal
        $decimal = bindec($binary);
        
        // Convert decimal to roman
        $roman = decimalToRoman($decimal);
    }
    
    // Check if the number is roman
    if (preg_match('/^[IVXLCDM]+$/', $number)) {
        $isRoman = true;
        $roman = $number;
        
        // Convert roman to decimal
        $decimal = romanToDecimal($roman);
        
        // Convert decimal to binary
        $binary = decimalToBinary($decimal);
    }
    
    // Print the converted numbers
    echo "Number: $number\n";
    if ($isDecimal) {
        echo "<br>";
        echo "Decimal: $decimal\n";
        echo "<br>";
        echo "Binary: $binary\n";
        echo "<br>";
        echo "Roman: $roman\n";
        echo "<br>";
        echo "<br>";
    } else {
        echo "Error: Invalid number format.\n";
        echo "<br>";
    }
    echo "\n";
}
// CHECK
$numbers = array(
    "+10",
    "01",
    "IV",
    "-545",
    "100",
    "3135",
    "-8",
    "+3999999",
    "0",
    "+0123"
);

foreach ($numbers as $number) {
    checkAndConvertNumber($number);
}
?>