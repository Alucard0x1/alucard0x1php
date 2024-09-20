<?php
session_start();
if (!isset($_SESSION['display'])) {
    $_SESSION['display'] = '0';
}
if (!isset($_SESSION['num1'])) {
    $_SESSION['num1'] = null;
}
if (!isset($_SESSION['operation'])) {
    $_SESSION['operation'] = null;
}
if (!isset($_SESSION['num2'])) {
    $_SESSION['num2'] = null;
}
if (!isset($_SESSION['expression'])) {
    $_SESSION['expression'] = '';
}

if (isset($_POST['operation']) && $_POST['operation'] === 'clear') {
    $_SESSION['display'] = '0';
    $_SESSION['num1'] = null;
    $_SESSION['operation'] = null;
    $_SESSION['num2'] = null;
    $_SESSION['expression'] = '';
}

if (isset($_POST['operation']) && $_POST['operation'] === 'back') {
    if (strlen($_SESSION['expression']) > 0) {
        $_SESSION['expression'] = substr($_SESSION['expression'], 0, -1);
        if (strpos($_SESSION['expression'], ' + ') !== false ||
            strpos($_SESSION['expression'], ' - ') !== false ||
            strpos($_SESSION['expression'], ' × ') !== false ||
            strpos($_SESSION['expression'], ' ÷ ') !== false) {
            $_SESSION['display'] = '0';
        } else {
            $_SESSION['display'] = $_SESSION['expression'] !== '' ? $_SESSION['expression'] : '0';
        }
    }
}

if (isset($_POST['num'])) {
    if ($_SESSION['display'] === '0' || $_SESSION['display'] === 'Error') {
        $_SESSION['display'] = $_POST['num'];
        if ($_SESSION['operation'] === null) {
            $_SESSION['expression'] = $_POST['num'];
        } else {
            $_SESSION['expression'] .= $_POST['num'];
        }
    } else {
        $_SESSION['display'] .= $_POST['num'];
        $_SESSION['expression'] .= $_POST['num'];
    }
}

if (isset($_POST['operation']) && $_POST['operation'] === 'dot') {
    if (strpos($_SESSION['display'], '.') === false) {
        $_SESSION['display'] .= '.';
        $_SESSION['expression'] .= '.';
    }
}

if (isset($_POST['operation']) && in_array($_POST['operation'], ['add', 'subtract', 'multiply', 'divide'])) {
    $operatorMap = [
        'add' => ' + ',
        'subtract' => ' - ',
        'multiply' => ' × ',
        'divide' => ' ÷ '
    ];
    $currentOperation = $_POST['operation'];

    if ($_SESSION['operation'] !== null && $_SESSION['num1'] !== null) {
        $_SESSION['num2'] = $_SESSION['display'];
        $num1 = (float)$_SESSION['num1'];
        $num2 = (float)$_SESSION['num2'];

        switch ($_SESSION['operation']) {
            case 'add':
                $_SESSION['display'] = $num1 + $num2;
                break;
            case 'subtract':
                $_SESSION['display'] = $num1 - $num2;
                break;
            case 'multiply':
                $_SESSION['display'] = $num1 * $num2;
                break;
            case 'divide':
                $_SESSION['display'] = ($num2 != 0) ? $num1 / $num2 : 'Error';
                break;
        }

        $_SESSION['expression'] = $_SESSION['display'] !== 'Error' ? strval($_SESSION['display']) . $operatorMap[$currentOperation] : 'Error';
        $_SESSION['num1'] = $_SESSION['display'] !== 'Error' ? $_SESSION['display'] : null;
    } else {
        $_SESSION['num1'] = $_SESSION['display'];
        $_SESSION['expression'] .= $operatorMap[$currentOperation];
    }

    $_SESSION['operation'] = $currentOperation;
    $_SESSION['display'] = '0';
}

if (isset($_POST['operation']) && $_POST['operation'] === 'equal') {
    if (isset($_SESSION['operation']) && isset($_SESSION['num1'])) {
        $_SESSION['num2'] = $_SESSION['display'];
        $num1 = (float)$_SESSION['num1'];
        $num2 = (float)$_SESSION['num2'];

        switch ($_SESSION['operation']) {
            case 'add':
                $_SESSION['display'] = $num1 + $num2;
                break;
            case 'subtract':
                $_SESSION['display'] = $num1 - $num2;
                break;
            case 'multiply':
                $_SESSION['display'] = $num1 * $num2;
                break;
            case 'divide':
                $_SESSION['display'] = ($num2 != 0) ? $num1 / $num2 : 'Error';
                break;
        }

        $_SESSION['expression'] = $_SESSION['display'];

        $_SESSION['operation'] = null;
        $_SESSION['num1'] = null;
        $_SESSION['num2'] = null;
    }
}

$_SESSION['display'] = strval($_SESSION['display']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Calculator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #87ceeb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator {
            background-color: #2b2f3e;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 280px;
        }
        .display {
            background-color: #1a2238;
            color: white;
            text-align: right;
            padding: 15px;
            font-size: 1.5em;
            border-radius: 10px;
            margin-bottom: 20px;
            min-height: 50px;
            word-wrap: break-word;
        }
        .button-row {
            display: flex;
            margin-bottom: 10px;
        }
        .button {
            flex: 1;
            background-color: #50738f;
            color: white;
            border: none;
            font-size: 1.2em;
            margin: 5px;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .button.operator {
            background-color: #35748e;
        }
        .button.equal {
            background-color: #f1a329;
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

<div class="calculator">
    <div class="display" id="display">
        <?php echo htmlspecialchars($_SESSION['expression'] !== '' ? $_SESSION['expression'] : $_SESSION['display']); ?>
    </div>
    
    <form action="" method="POST">
        <div class="button-row">
            <button type="submit" name="operation" value="clear" class="button">C</button>
            <button type="submit" name="operation" value="back" class="button">&#8592;</button>
            <button type="submit" name="operation" value="divide" class="button operator">÷</button>
            <button type="submit" name="operation" value="multiply" class="button operator">×</button>
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
