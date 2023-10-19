<?php

class ValidarCliente
{
    protected int $id;
    protected string $name;
    protected string $lastName;
    protected string $residence;
    protected string $dni;
    protected string $dniLetter;
    protected int $phone;
    protected string $email;
    protected string $password;


    public function __construct(int $id, string $name, string $lastName, string $residence, string $NIF, string $dniLetter, int $phone, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->residence = $residence;
        $this->dni = $NIF;
        $this->dniLetter = $dniLetter;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }

    public function validateName($username): string
    {
        $pattern = '/^[A-Za-z ]{1,30}$/';
        if (empty($username))
            return "El campo no puede estar vacio";
        else if (!preg_match($pattern, $username))
            return "El campo solo puede contener letras";
        else
            return "Correcto";
    }

    public function validateEmail(): string
    {
        if (empty($this->email))
            return "El campo no puede estar vacío";
        else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            return "El email no es correcto";
        else
            return "Correcto";
    }

    public function validatePhone(): string
    {
        if ($this->phone < 600000000 || $this->phone > 999999999)
            return "Numero incorrecto";
        else
            return "Correcto";
    }
    public function validateDNI(): string
    {
        $dniLetters = ["T", "R", "W", "A", "G", "M", "Y", "F", "P",
            "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

        if (empty($this->dni))
            return "El campo no puede estar vacío";

        else if($this->dni <= 99999999 && $this->dni >= 10000000) {
            $letter = $dniLetters[$this->dni % 23];

            if ($letter == $this->dniLetter )
                return "Correcto";
            else
                return "El DNI es incorrecto";
        }
        else
            return "El DNI es incorrecto";
    }
    function validatePassword(): string {
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/";

        if (empty($this->password))
            return "El campo no puede estar vacío";
        else if (preg_match($pattern, $this->password))
            return "Correcto";
         else
            return "La contraseña es incorrecta";
    }
}