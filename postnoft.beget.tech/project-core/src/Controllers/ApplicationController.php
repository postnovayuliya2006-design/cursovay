<?php

require_once __DIR__ . '/../Models/Application.php';

class ApplicationController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function apply() {

        $userId = $_SESSION['user_id'];
        $candidateId = $_GET['id'];

        $model = new Application($this->db);

        if ($model->exists($userId, $candidateId)) {
            header("Location: index.php?route=home");
            exit;
        }

        $model->create($userId, $candidateId);

        header("Location: index.php?route=home");
        exit;
    }

    public function delete() {

        $userId = $_SESSION['user_id'];
        $applicationId = $_GET['id'];

        $model = new Application($this->db);
        $model->delete($applicationId, $userId);

        header("Location: index.php?route=home");
        exit;
    }

    public function admin() {

        $stmt = $this->db->query("
            SELECT 
                a.id AS application_id,
                a.status,
                u.email,
                c.full_name,
                c.position
            FROM applications a
            JOIN users u ON u.id = a.user_id
            JOIN candidates c ON c.id = a.candidate_id
            ORDER BY a.id DESC
        ");

        $applications = $stmt->fetchAll();

        require __DIR__ . '/../../templates/admin_applications.php';
    }

    public function updateStatus() {

        if (!isset($_GET['id'], $_GET['status'])) {
            header("Location: index.php?route=admin_applications");
            exit;
        }

        $id = (int) $_GET['id'];
        $status = $_GET['status'];

        if (!in_array($status, ['approved', 'rejected'])) {
            header("Location: index.php?route=admin_applications");
            exit;
        }

        $stmt = $this->db->prepare("
            UPDATE applications
            SET status = ?
            WHERE id = ?
        ");

        $stmt->execute([$status, $id]);

        header("Location: index.php?route=admin_applications");
        exit;
    }
}