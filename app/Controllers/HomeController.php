<?php

class HomeController extends controller
{
    public function index()
    {
        $db = Database::getInstance()->connection();

        // 1. جلب الصفحة
        $stmt = $db->prepare("SELECT * FROM pages WHERE slug = 'home' LIMIT 1");
        $stmt->execute();
        $page = $stmt->fetch();

        // 2. جلب Sections
        $sectionModel = new Section();
        $sections = $sectionModel->getByPage($page['id']);

        // 3. تجهيز Blocks
        $blockModel = new Block();

        $data = [];

        foreach ($sections as $section) {
            $data[$section['name']] = $blockModel->getBySection($section['id']);
        }

        return $this->view('pages/home', [
            'sections' => $data
        ]);
    }
}