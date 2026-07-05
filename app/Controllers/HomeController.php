<?php

class HomeController extends controller
{
    public function index()
    {
        $db = Database::getInstance()->connection();

        $stmt = $db->prepare("SELECT * FROM pages WHERE slug = 'home' LIMIT 1");
        $stmt->execute();
        $page = $stmt->fetch(PDO::FETCH_ASSOC);

        $sectionModel = new Section();
        $blockModel   = new Block();

        $sectionsData = [];

        if ($page) {

            $sections = $sectionModel->getByPage($page['id']);

            foreach ($sections as $section) {

                $blocks = $blockModel->getBySection($section['id']);

                $formatted = [];

                foreach ($blocks as $block) {
                    $formatted[$block['field_name']] = $block['content'];
                }

                // 🔥 التوحيد هنا
                $key = strtolower($section['name']);
                $sectionsData[$key] = $formatted;
            }
        }

        return $this->view('pages/home', [
            'sections' => $sectionsData
        ]);
    }
}