<?php
// Function to encrypt text using Caesar Cipher (supports letters and numbers)
function caesarEncrypt($text, $shift) {
    $result = "";
    
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        
        if (ctype_alpha($char)) {
            $asciiOffset = ctype_upper($char) ? 65 : 97;
            $result .= chr((ord($char) + $shift - $asciiOffset) % 26 + $asciiOffset);
        } elseif (ctype_digit($char)) {
            $result .= ($char + $shift) % 10; // Shift numbers within 0-9 range
        } else {
            $result .= $char;
        }
    }
    return $result;
}

// Function to decrypt text (supports letters and numbers)
function caesarDecrypt($text, $shift) {
    return caesarEncrypt($text, 10 - ($shift % 10)); // Reverse shift for numbers too
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputText = $_POST['text'] ?? '';
    $shift = (int) ($_POST['shift'] ?? 3);
    $action = $_POST['action'] ?? 'encrypt';
    
    if ($action == 'encrypt') {
        $output = caesarEncrypt($inputText, $shift);
    } else {
        $output = caesarDecrypt($inputText, $shift);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Caesar Cipher Tool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 50%;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        input[type="text"], input[type="number"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color:rgb(124, 8, 240);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Caesar Cipher Encryption & Decryption</h2>
        <form method="post">
            <label>Enter Text:</label><br>
            <input type="text" name="text" required><br><br>
            
            <label>Shift Value:</label><br>
            <input type="number" name="shift" value="3" required><br><br>
            
            <input type="radio" name="action" value="encrypt" checked> Encrypt
            <input type="radio" name="action" value="decrypt"> Decrypt<br><br>
            
            <input type="submit" value="Submit">
        </form>
        
        <?php if (isset($output)) { ?>
            <div class="result">
                <h3>Result:</h3>
                <p><?php echo htmlspecialchars($output); ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
