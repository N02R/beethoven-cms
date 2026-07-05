<?php

class HomeController extends controller
{
    public function index()
    {
        $db = Database::getInstance()->connection();

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

        $sections = $sectionModel->getByPage((int)$page['id']);

        foreach ($sections as $section) {

            if (!is_array($section)) continue;

            $blocks = $blockModel->getBySection((int)$section['id']);

            $formatted = [];

            foreach ($blocks as $block) {

                if (!is_array($block)) continue;

                $formatted[$block['field_name']] = $block['content'];
            }

            $sectionsData[$section['name']] = $formatted;
        }

        return $this->view('pages/home', [
            'sections' => $sectionsData
        ]);
    }
}