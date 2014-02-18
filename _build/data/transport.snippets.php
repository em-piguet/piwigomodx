<?php
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = trim(str_replace(array('<?php','?>'),'',$o));
    return $o;
}
$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'PiwigoModxImage',
    'description' => 'Snippet for retrieving metadata from a picture.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/piwigomodximage.snippet.php'),
),'',true,true);
$properties = include $sources['data'].'properties/properties.piwigomodximage.php';
$snippets[1]->setProperties($properties);
unset($properties);

$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'PiwigoModxTags',
    'description' => 'Snippet for retrieving tags related to published pictures.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/piwigomodxtags.snippet.php'),
),'',true,true);
$properties = include $sources['data'].'properties/properties.piwigomodxtags.php';
$snippets[2]->setProperties($properties);
unset($properties);

$snippets[3]= $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 3,
    'name' => 'PiwigoModxCategories',
    'description' => 'Snippet for retrieving categories related to published pictures.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/piwigomodxcategories.snippet.php'),
),'',true,true);
$properties = include $sources['data'].'properties/properties.piwigomodxcategories.php';
$snippets[3]->setProperties($properties);
unset($properties);

$snippets[4]= $modx->newObject('modSnippet');
$snippets[4]->fromArray(array(
    'id' => 4,
    'name' => 'PiwigoModxImagesFromCategory',
    'description' => 'Snippet for retrieving pictures from one or more categories.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/piwigomodximagesfromcategory.snippet.php'),
),'',true,true);
$properties = include $sources['data'].'properties/properties.piwigomodximagesfromcategory.php';
$snippets[4]->setProperties($properties);
unset($properties);

$snippets[5]= $modx->newObject('modSnippet');
$snippets[5]->fromArray(array(
    'id' => 5,
    'name' => 'PiwigoModxImagesFromTag',
    'description' => 'Snippet for retrieving pictures from one or more tags.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/piwigomodximagesfromtag.snippet.php'),
),'',true,true);
$properties = include $sources['data'].'properties/properties.piwigomodximagesfromtag.php';
$snippets[5]->setProperties($properties);
unset($properties);

return $snippets;
