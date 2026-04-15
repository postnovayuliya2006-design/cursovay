<?php

class Application {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $candidateId) {
        $stmt = $this->db->prepare("
            INSERT INTO applications (user_id, candidate_id, status)
            VALUES (?, ?, 'sent')
        ");

        return $stmt->execute([$userId, $candidateId]);
    }

    public function delete($applicationId, $userId) {
        $stmt = $this->db->prepare("
            DELETE FROM applications
            WHERE id = ? AND user_id = ?
        ");

        return $stmt->execute([$applicationId, $userId]);
    }

    public function exists($userId, $candidateId) {
        $stmt = $this->db->prepare("
            SELECT id FROM applications
            WHERE user_id = ? AND candidate_id = ?
        ");

        $stmt->execute([$userId, $candidateId]);

        return $stmt->fetchColumn();
    }
}