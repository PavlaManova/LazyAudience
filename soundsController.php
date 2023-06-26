<?php
require_once 'userModel.php';
$user = new User();
session_start();
$userInfo;

$categories = array(
    "Applause",
    "Laugh",
    "Booing",
    "Bravo!",
    "Whistle",
    "Cheering",
    "Disappointment",
    "Distinct Chatter"
  );

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['get_user_categories'])) {
    // var_dump(33);
    // echo $user->getUserSoundsCategories($_SESSION['user_id']);
    $userCategoriesJson = json_encode($user->getUserSoundsCategories($_SESSION['user_id']));
    header('Content-Type: application/json');
    echo $userCategoriesJson;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category'])) {
    // echo $user->getUserSoundsCategories($_SESSION['user_id']);
    $allSoundsFromCategory = $user->getAllSoundsFromCategory($_SESSION['user_id'], $_GET['category']);

    $randomKey = array_rand($allSoundsFromCategory, 1);

    header("Content-Type: text/plain");
    echo $allSoundsFromCategory[$randomKey]['path'];;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['load_sounds'])) {
    $data = [];
    for($i=0; $i<count($categories); $i++)
    {
        $data[$i][$categories[$i]] = $user->getAllSoundsFromCategory($_SESSION['user_id'], $categories[$i]);
    }

    $userSoundsInfoJson = json_encode($data);
    header('Content-Type: application/json');
    echo $userSoundsInfoJson;
}

?>