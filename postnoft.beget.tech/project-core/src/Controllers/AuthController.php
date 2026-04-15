<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($this->db);
            $user = $userModel->findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];

                header("Location: index.php");
                exit;
            } else {
                $error = "Неверный email или пароль";
            }
        }

        require __DIR__ . '/../../templates/login.php';
    }

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $error = "Пароли не совпадают";
            } else {
                $userModel = new User($this->db);

                $userModel->create([
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'username' => $_POST['email'],
                    'role' => 'client'
                ]);

                header("Location: index.php?route=login&success=1");
                exit;
            }
        }

        require __DIR__ . '/../../templates/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    public function profile() {

        $role = $_SESSION['role'] ?? 'client';
        $userId = $_SESSION['user_id'] ?? 0;

        $adminStats = [];
        $userApplications = [];

        if ($role === 'admin') {

            $adminStats = [
                'total_candidates' => $this->db->query("SELECT COUNT(*) FROM candidates")->fetchColumn(),
                'total_users' => $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
                'total_applications' => $this->db->query("SELECT COUNT(*) FROM applications")->fetchColumn()
            ];

        } else {

            $stmt = $this->db->prepare("
                SELECT a.*, c.full_name, c.position
                FROM applications a
                JOIN candidates c ON c.id = a.candidate_id
                WHERE a.user_id = ?
            ");
            $stmt->execute([$userId]);
            $userApplications = $stmt->fetchAll();
        }

        require_once __DIR__ . '/../../templates/profile.php';
    }
}
