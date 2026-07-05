<?php

class HomeController extends controller
{
    public function index()
    {
        $db = Database::getInstance()->connection();

        // جلب الصفحة الرئيسية
        $stmt = $db->prepare("SELECT * FROM pages WHERE slug = 'home' LIMIT 1");
        $stmt->execute();
        $page = $stmt->fetch(PDO::FETCH_ASSOC);

        $sectionsData = [];

        if (!$page) {
            return $this->view('pages/home', [
                'sections' => []
            ]);
        }

        $sectionModel = new Section();
        $blockModel   = new Block();

        $sections = $sectionModel->getByPage($page['id']);

        if (!is_array($sections)) {
            $sections = [];
        }

        foreach ($sections as $section) {

            if (!is_array($section) || !isset($section['id'])) {
                continue;
            }

            $blocks = $blockModel->getBySection($section['id']);

            if (!is_array($blocks)) {
                $blocks = [];
            }

            $formatted = [];

            foreach ($blocks as $block) {

                if (!is_array($block)) {
                    continue;
                }

                $key = $block['field_name'] ?? null;
                $value = $block['content'] ?? '';

                if ($key) {
                    $formatted[$key] = $value;
                }
            }

            $sectionName = $section['name'] ?? 'unknown';

            $sectionsData[$sectionName] = $formatted;
        }

        return $this->view('pages/home', [
            'sections' => $sectionsData
        ]);
    }
}