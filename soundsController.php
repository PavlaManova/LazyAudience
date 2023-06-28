<?php
require_once './userModel.php';
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

//when loading the sounds of the user in event
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['get_user_categories'])) {
    // echo $user->getUserSoundsCategories($_SESSION['user_id']);
    $userCategoriesJson = json_encode($user->getUserSoundsCategories($_SESSION['user_id']));
    header('Content-Type: application/json');
    echo $userCategoriesJson;
}


//for loading sounds in homepage
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category'])) {
    // echo $user->getUserSoundsCategories($_SESSION['user_id']);
    $allSoundsFromCategory = $user->getAllSoundsFromCategory($_SESSION['user_id'], $_GET['category']);

    $randomKey = array_rand($allSoundsFromCategory, 1);

    header("Content-Type: text/plain");
    echo $allSoundsFromCategory[$randomKey]['path'];
    ;
}

//for getting the current user sounds (owned)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['load_sounds'])) {
    $ownedSounds = [];
    for ($i = 0; $i < count($categories); $i++) {
        $ownedSounds[$i][$categories[$i]] = $user->getAllSoundsFromCategory($_SESSION['user_id'], $categories[$i]);
    }

    $userSoundsInfoJson = json_encode($ownedSounds);
    header('Content-Type: application/json');
    echo $userSoundsInfoJson;
}

//for loading sounds that can be bought
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['load_sounds_for_buying'])) {
    $soundsForBuying = [];
    for ($i = 0; $i < count($categories); $i++) {
        $soundsForBuying[$i][$categories[$i]] = $user->getAllNotOwnedSounds($_SESSION['user_id'], $categories[$i]);
    }

    $soundsForBuyingJson = json_encode($soundsForBuying);
    header('Content-Type: application/json');
    echo $soundsForBuyingJson;
}


?>