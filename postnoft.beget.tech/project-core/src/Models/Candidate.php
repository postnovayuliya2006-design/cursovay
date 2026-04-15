<?php

class Candidate {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll($position = '', $limit = 6, $offset = 0) {

        $sql = "
            SELECT * 
            FROM candidates
            WHERE position LIKE :position
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':position', "%$position%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function count($position = '') {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) 
            FROM candidates 
            WHERE position LIKE ?
        ");
        $stmt->execute(["%$position%"]);
        return $stmt->fetchColumn();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM candidates 
            WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("
            DELETE FROM candidates 
            WHERE id = ?
        ");
        $stmt->execute([$id]);
    }

    public function save($data) {

        if (!empty($data['id'])) {

            $stmt = $this->db->prepare("
                UPDATE candidates 
                SET full_name = ?, position = ?, expected_salary = ?, photo_url = ?, resume_pdf = ?
                WHERE id = ?
            ");

            $stmt->execute([
                $data['full_name'],
                $data['position'],
                $data['expected_salary'],
                $data['photo_url'],
                $data['resume_pdf'],
                $data['id']
            ]);

        } else {

            $stmt = $this->db->prepare("
                INSERT INTO candidates 
                (full_name, position, expected_salary, photo_url, resume_pdf)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $data['full_name'],
                $data['position'],
                $data['expected_salary'],
                $data['photo_url'],
                $data['resume_pdf']
            ]);
        }
    }
}