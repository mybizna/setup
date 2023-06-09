<?php

// Read the contents of mybizna/composer.json
$mybiznaComposer = file_get_contents('mybizna/composer.json');

// Read the contents of the root composer.json
$rootComposer = file_get_contents('composer.json');

// Decode the JSON content into associative arrays
$mybiznaData = json_decode($mybiznaComposer, true);
$rootData = json_decode($rootComposer, true);

$merge_keys = ["require", "require-dev", "autoload", "autoload-dev", "scripts",
"extra","config"];

foreach ($merge_keys as $key => $merge_key) {
    // Merge the "item" sections
    if (isset($mybiznaData[$merge_key])) {
        $rootData[$merge_key] = array_merge($rootData[$merge_key], $mybiznaData[$merge_key]);
    }
}

// Encode the merged data back to JSON
$mergedComposer = json_encode($rootData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

// Save the merged composer.json to the root folder
file_put_contents('composer.json', $mergedComposer);

echo 'Composer.json merged successfully.';
