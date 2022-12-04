<?php
function get_count_words() {
    function get_words($count) {
        $request = "SELECT * FROM words WHERE strong=?";
	    $execute = array($count);
	    $array = connect_bd($request, $execute, false);
        return $array;
    }
    $strong_words = get_words(1);
    $light_words = get_words(0);
    $_SESSION['strong_words'] = count($strong_words);
    $_SESSION['light_words'] = count($light_words);
    $_SESSION['all_words'] = count($light_words) + count($strong_words);
}