<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (email, password_hash, role, username)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['email'],
            $data['password'],
            $data['role'],
            $data['username']
        ]);
    }
}