<?php

require_once __DIR__ . '/../Models/Candidate.php';

class CandidateController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {

        $limit = 6;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        $position = $_GET['position'] ?? '';

        $model = new Candidate($this->db);

        $candidates = $model->getAll($position, $limit, $offset);
        $total = $model->count($position);

        $totalPages = ceil($total / $limit);

        $appliedMap = [];

        if (isset($_SESSION['user_id'])) {

            $stmt = $this->db->prepare("
                SELECT id, candidate_id
                FROM applications
                WHERE user_id = ?
            ");

            $stmt->execute([$_SESSION['user_id']]);

            foreach ($stmt->fetchAll() as $a) {
                $appliedMap[$a['candidate_id']] = $a['id'];
            }
        }

        require_once __DIR__ . '/../../templates/main_page.php';
    }

    public function form() {

        $model = new Candidate($this->db);
        $candidate = null;

        if (!empty($_GET['id'])) {
            $candidate = $model->getById($_GET['id']);
        }

        require_once __DIR__ . '/../../templates/candidate_form.php';
    }

    public function save() {

        $model = new Candidate($this->db);

        $photo = $_POST['old_photo'] ?? '';
        $resume = $_POST['old_resume'] ?? '';

        if (!empty($_FILES['photo']['name'])) {

            $photoName = time() . '_' . basename($_FILES['photo']['name']);

            $uploadPath = __DIR__ . '/../../../public_html/uploads/photos/' . $photoName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
                $photo = 'photos/' . $photoName; 
            }
        }

        if (!empty($_FILES['resume']['name'])) {

            $resumeName = time() . '_' . basename($_FILES['resume']['name']);

            $uploadPath = __DIR__ . '/../../../public_html/uploads/resumes/' . $resumeName;

            if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadPath)) {
                $resume = 'resumes/' . $resumeName; 
            }
        }

        $model->save([
            'id' => $_POST['id'] ?? null,
            'full_name' => $_POST['full_name'],
            'position' => $_POST['position'],
            'expected_salary' => $_POST['expected_salary'],
            'photo_url' => $photo,
            'resume_pdf' => $resume
        ]);

        header("Location: index.php?route=home");
        exit;
    }

    public function delete() {

        $model = new Candidate($this->db);
        $model->delete($_GET['id']);

        header("Location: index.php?route=home");
        exit;
    }

    public function admin() {
        require_once __DIR__ . '/../../templates/admin_panel.php';
    }
}
