<?php
declare(strict_types=1);

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function render(string $page, string $layout, array $params = []): void {
    global $id;
    $pageNames = [
        'dashboard',
        'timetable'
    ];
    extract($params);
    
    ob_start();
    require __DIR__ . '/../views/pages/' . $page . '.php';
    $contents = ob_get_clean();
    
    if ($layout !== 'main.view') {
        $username = explode(' ', fetch_username($id))[0];
    }
    require __DIR__ . '/../views/layouts/' . $layout . '.php';
}

function format_time(string $time) {
    return date('h:ia', strtotime($time));
}
