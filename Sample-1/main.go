package main

import (
    "fmt"
)

func main() {
    var num1, num2 float64
    var operator string

    // Prompt sa user para sa una nga number
    fmt.Println("Simple Go Calculator")
    fmt.Print("Enter first number: ")
    fmt.Scanln(&num1)

    // para sa operator (+, -, *, /)
    fmt.Print("Enter operator (+, -, *, /): ")
    fmt.Scanln(&operator)

    //  para sa ikaduhang number
    fmt.Print("Enter second number: ")
    fmt.Scanln(&num2)

    // Condition nga mag-handle sa mga operasion
    switch operator {
    case "+":
        fmt.Printf("Result: %.2f\n", num1+num2) // Add 
    case "-":
        fmt.Printf("Result: %.2f\n", num1-num2) // Subtract 
    case "*":
        fmt.Printf("Result: %.2f\n", num1*num2) // Multiply 
    case "/":
        if num2 != 0 {
            fmt.Printf("Result: %.2f\n", num1/num2) // Divide 
        } else {
            fmt.Println("Error: Division by zero") // Kung mag-divide sa zero
        }
    default:
        fmt.Println("Invalid operator") // if mali anf operator
    }
}
