<?php
namespace Controller;

use PDO;
use PDOException;

class PostController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createPost($title, $summary, $content, $author, $date, $time)
    {
        try {
            $query = "INSERT INTO posts (title, summary, content, author, date, time) VALUES (:title, :summary, :content, :author, :date, :time)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':summary', $summary);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);

            if ($stmt->execute()) {
                echo json_encode(["success" => "Post criado com sucesso."]);
            } else {
                echo json_encode(["error" => "Erro ao tentar criar o post."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getPosts()
    {
        try {
            $query = "SELECT * FROM posts";
            $stmt = $this->conn->query($query);
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($posts);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function updatePost($id, $title, $summary, $content, $date, $time)
    {
        try {
            $query = "UPDATE posts SET title = :title, summary = :summary, content = :content, date = :date, time = :time WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':summary', $summary);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);

            if ($stmt->execute()) {
                echo json_encode(["success" => "Post atualizado com sucesso."]);
            } else {
                echo json_encode(["error" => "Erro ao tentar atualizar o post."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function deletePost($id)
    {
        try {
            $query = "DELETE FROM posts WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(["success" => "Post deletado com sucesso."]);
            } else {
                echo json_encode(["error" => "Erro ao tentar deletar o post."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}