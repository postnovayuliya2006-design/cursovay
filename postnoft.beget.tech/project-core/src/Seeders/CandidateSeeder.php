<?php

class CandidateSeeder {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function run($count = 10) {

        $positions = [
            'Frontend Developer',
            'Backend Developer',
            'HR Manager',
            'UI/UX Designer',
            'Project Manager',
            'QA Engineer'
        ];

        for ($i = 0; $i < $count; $i++) {

            $name = "Candidate " . rand(1000, 9999);
            $position = $positions[array_rand($positions)];
            $salary = rand(800, 5000) . "€";

            $this->db->prepare("
                INSERT INTO candidates (full_name, position, expected_salary, photo_url, resume_pdf)
                VALUES (?, ?, ?, '', '')
            ")->execute([
                $name,
                $position,
                $salary
            ]);
        }
    }
}