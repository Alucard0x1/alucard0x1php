<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Calculator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #87ceeb; /* Sky blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator {
            background-color: #2b2f3e; /* Dark blue background */
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 250px;
        }
        .display {
            background-color: #1a2238; /* Darker section for the display */
            color: white;
            text-align: right;
            padding: 15px;
            font-size: 2em;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .button-row {
            display: flex;
            margin-bottom: 10px;
        }
        .button {
            flex: 1;
            background-color: #50738f; /* Teal buttons */
            color: white;
            border: none;
            font-size: 1.5em;
            margin: 5px;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .button.operator {
            background-color: #35748e; /* Dark teal for operators */
        }
        .button.equal {
            background-color: #f1a329; /* Orange color for the equal button */
        }
        .button:hover {
            background-color: #607d8b;
        }
        .button.equal:hover {
            background-color: #d98727;
        }
    </style>
</head>
<body>

<?php
// Initializing variables to handle the display and result
$display = "0";
$result = null;

// Handle form submission and calculations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
    $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;
    $operation = $_POST['operation'];
    
    switch ($operation) {
        case 'add':
            $result = $num1 + $num2;
            break;
        case 'subtract':
            $result = $num1 - $num2;
            break;
        case 'multiply':
            $result = $num1 * $num2;
            break;
        case 'divide':
            $result = ($num2 != 0) ? $num1 / $num2 : "Error (Division by 0)";
            break;
        default:
            $result = "Invalid Operation!";
    }
    
    $display = $result;
}
?>

<div class="calculator">
    <div class="display" id="display">
        <?php echo htmlspecialchars($display); ?>
    </div>
    
    <form action="/" method="POST">
        <input type="hidden" name="num1" value="<?php echo isset($num1) ? htmlspecialchars($num1) : 0; ?>">
        <input type="hidden" name="num2" value="<?php echo isset($num2) ? htmlspecialchars($num2) : 0; ?>">
        
        <div class="button-row">
            <button type="submit" name="operation" value="clear" class="button">C</button>
            <button type="submit" name="operation" value="back" class="button">&#8592;</button>
            <button type="submit" name="operation" value="divide" class="button operator">/</button>
            <button type="submit" name="operation" value="multiply" class="button operator">x</button>
        </div>
        <div class="button-row">
            <button type="submit" name="num" value="7" class="button">7</button>
            <button type="submit" name="num" value="8" class="button">8</button>
            <button type="submit" name="num" value="9" class="button">9</button>
            <button type="submit" name="operation" value="subtract" class="button operator">-</button>
        </div>
        <div class="button-row">
            <button type="submit" name="num" value="4" class="button">4</button>
            <button type="submit" name="num" value="5" class="button">5</button>
            <button type="submit" name="num" value="6" class="button">6</button>
            <button type="submit" name="operation" value="add" class="button operator">+</button>
        </div>
        <div class="button-row">
            <button type="submit" name="num" value="1" class="button">1</button>
            <button type="submit" name="num" value="2" class="button">2</button>
            <button type="submit" name="num" value="3" class="button">3</button>
            <button type="submit" name="operation" value="equal" class="button equal">=</button>
        </div>
        <div class="button-row">
            <button type="submit" name="num" value="0" class="button" style="flex: 2;">0</button>
            <button type="submit" name="operation" value="dot" class="button">.</button>
        </div>
    </form>
</div>

</body>
</html>
