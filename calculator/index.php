<?php
class Calculator
{
    // VARIABLES
    public $number1;
    public $number2;
    public $operator;

    // CONSTRUCTOR
    function __construct($num1, $num2, $operator)
    {
        $this->number1 = $num1;
        $this->number2 = $num2;
        $this->opertaor = $operator;
    }
    // METHIOD RETURN RESULT
    function calculate_result()
    {
        switch ($this->opertaor) {
            case '*':
                echo $this->number1 * $this->number2;
                break;
            case '/':
                if ($this->number2 == 0) {
                    echo -1;
                } else {
                    echo $this->number1 / $this->number2;
                }
                break;
            case '-':
                echo $this->number1 - $this->number2;
                break;
            case '+*':
                echo $this->number1 + $this->number2;
                break;
            default:
                echo "0";
                break;
        }
    }
}

// OBJECT OF CALCULATOR CLASS
$cal = new Calculator(2, 0, '$');
$cal->calculate_result();
