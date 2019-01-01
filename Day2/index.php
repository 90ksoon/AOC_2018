<?php

$raw_input = file_get_contents("input.txt");

$input = explode(PHP_EOL,$raw_input);

$threes = $twice = 0;

$time = -microtime(true);

foreach($input as $row){

    $wordCounts = array_count_values( // get grouping of each word count
                    array_count_values(str_split($row,1) // to get each string count
                    )
                );

    if( array_key_exists( 2 , $wordCounts)) $twice += 1;
    if( array_key_exists( 3 , $wordCounts)) $threes += 1;
    
}

echo "Result for Question 1: " , $twice * $threes;

echo "<br>", round($time += microtime(true), 5) . ' s <br>' ;



$time2 = -microtime(true);

$wordStructure = [];

$i = 0;

/// getting all words into arrays
foreach($input as $row){

    $wordStructure[$i] = str_split($row,1);

    $i++;

}


$result = null;
foreach($wordStructure as $words){
    // flip index to value so for easier reference
    array_flip($words);

    foreach($wordStructure as $words_clone){

        array_flip($words_clone);

        if(count(array_diff_assoc( $words , $words_clone)) == 1){
            echo "Words to match: ", implode("",$words);
            echo "<br>Words match with close proximity: ", implode("",$words_clone);

            $removeStringForResult = array_values(array_diff($words,$words_clone))[0];

            $result = implode("",$words);
            $result = str_replace($removeStringForResult,"", $result);
            break 2;
        } 
    }
}

echo "<br>,Result for Question 2 : " , $result;
echo "<br>", round($time2 += microtime(true), 5) . ' s <br>' ;