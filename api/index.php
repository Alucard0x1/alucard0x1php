<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        .calculator {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        input {
            width: calc(100% - 20px); /* Adjust padding for input fields */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.2em;
        }
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.2em;
        }
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .result {
            font-size: 1.5em;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="calculator">
    <h2>Simple Calculator</h2>
    <form action="/" method="POST">
        <input type="number" name="num1" placeholder="Enter First Number" required>
        <input type="number" name="num2" placeholder="Enter Second Number" required>
        <select name="operation" required>
            <option value="add">+</option>
            <option value="subtract">−</option>
            <option value="multiply">×</option>
            <option value="divide">÷</option>
        </select>
        <button type="submit" name="submit">Calculate</button>
    </form>

    <div class="result">
        <?php
        if (isset($_POST['submit'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operation = $_POST['operation'];
            $result = '';

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
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = "Division by zero error!";
                    }
                    break;
                default:
                    $result = "Invalid Operation!";
            }

            echo "Result: $result";
        }
        ?>
    </div>
</div>

</body>
</html>
