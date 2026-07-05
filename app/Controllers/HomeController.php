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
    $blockModel = new Block();

    $sectionsData = [];

    if ($page) {

        $sections = $sectionModel->getByPage($page['id']);

        if (!is_array($sections)) {
            $sections = [];
        }

        foreach ($sections as $section) {

            if (!is_array($section)) {
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

                $formatted[$block['field_name']] = $block['content'];
            }

            $sectionsData[$section['name'] ?? 'unknown'] = $formatted;
        }
    }

    return $this->view('pages/home', [
        'sections' => $sectionsData
    ]);
}
}