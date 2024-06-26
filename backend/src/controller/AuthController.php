<?php
namespace Controller;

use PDO;
use PDOException;
use Respect\Validation\Validator as v;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

class AuthController 
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($email, $password) 
    {
        if(empty($email) || empty($password)) {
            echo json_encode(["error" => "Preencha os campos."]);
            return;
        }

        if(!v::email()->validate($email)) {
            echo json_encode(["error" => "Email inválido."]);
            return;
        }

        try {
            $query = "SELECT * FROM users WHERE email=:email AND password=:password;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if($stmt->execute()) {
                $count = $stmt->rowCount();
                if($count === 1) {
                    $key = $_ENV["KEY"];
                    $token = $this->generateToken($email, $key);
                    echo json_encode(["token" => $token]);
                } else {
                    echo json_encode(["error" => "Usuário não encontrado."]);
                }
            } else {
                echo json_encode(["error" => "Ocorreu um erro."]);
            }
        } catch(PDOException $e) {
            echo json_encode((["error" => $e->getMessage()]));
        }
    }

    public function signup($name, $email, $password, $confirmPassword)
    {
        if(empty($name) ||empty($email) || empty($password) || empty($confirmPassword)) {
            echo json_encode(["error" => "Preencha os campos."]);
            return;
        }

        if(!v::email()->validate($email)) {
            echo json_encode(["error" => "Email inválido."]);
            return;
        }

        if($password !== $confirmPassword) {
            echo json_encode(["error" => "As senhas não coincidem."]);
            return;
        }

        try {
            $query = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password);";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if($stmt->execute()) {
                $key = $_ENV["KEY"];
                $token = $this->generateToken($email, $key);
                echo json_encode(["token" => $token]);
            } else {
                echo json_encode(["error" => "Ocorreu um erro."]);
            }
        } catch(PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }    

    public function generateToken($email, $key) 
    {
        $payload = [
            'email' => $email,
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}