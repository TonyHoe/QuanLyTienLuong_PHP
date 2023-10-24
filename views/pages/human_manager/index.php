<?php
require_once '../../template.php';
$page = $_GET['page'] ?? '';

$template = new Template('');
echo $template->render('navbar_manager', []);

switch ($page) {
    case 'human-manager-add-employee':
        echo $template->render('header_manager', ['css' => '/human_manager/add_employee/add_employee.css', 'js' => '/human_manager/add_employee/add_employee.js']);
        echo $template->render('pages/human_manager/add_employee/add_employee', []);
        break;
    case 'human-manager-add-timesheets':
        echo $template->render('header_manager', ['css' => '/human_manager/add_timesheets/add_timesheets.css', 'js' => '/human_manager/add_timesheets/add_timesheets.js']);
        echo $template->render('pages/human_manager/add_timesheets/add_timesheets', []);
        break;
    case 'human-manager-check-timesheets':
        echo $template->render('header_manager', ['css' => '/human_manager/check_timesheets/check_timesheets.css', 'js' => '/human_manager/check_timesheets/check_timesheets.js']);
        echo $template->render('pages/human_manager/check_timesheets/check_timesheets', []);
        break;
    case 'human-manager-edit-employee':
        echo $template->render('header_manager', ['css' => '/human_manager/check_timesheets/check_timesheets.css', 'js' => '/human_manager/check_timesheets/check_timesheets.js']);
        echo $template->render('pages/human_manager/edit_employee/edit_employee', []);
        break;

    default:
        echo $template->render('header_manager', ['css' => 'list_employee.css', 'js' => 'list_employee.js']);
        echo $template->render('pages/human_manager/list_employee/list_employee', []);
        break;
}
