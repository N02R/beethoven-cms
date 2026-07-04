<?php

class Router {

    public static function getPage() {

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            return $_GET['page'];
        }

        return 'home'; // الصفحة الافتراضية
    }

}