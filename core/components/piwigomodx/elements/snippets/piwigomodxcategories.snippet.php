<?php
/**
 * PiwigoModxCategories Snippet for retrieving categories related to
 * published pictures
 *
 * @author Philippe Juillerat (philippe.juillerat@filago.ch)
 *
 * @example [[PiwigoModxCategories? &tpl_row=`myCategory`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package piwigomodx
 *
 * @param int $cat_id optional Piwigo category id. When 0, display all
 * categories. Default 0
 * @param bool|int $recursive optional Display also children categories.
 * Default 0
 * @param bool|int $public optional Display only published categories.
 * Default 0
 * @param bool|int $fullname optional Display also the parent category
 * name for children categories. Default 0
 * @param string $tpl_outer optional Chunk that contain the list of
 * categories. Default piwigoModxCategoriesOuter
 * @param string $tpl_row optional Chunk to display each category.
 * Default piwigoModxCategoriesRow
 */
$piwigoModx = $modx->getService('piwigomodx','PiwigoModx',
    $modx->getOption('piwigomodx.core_path',null,$modx->getOption('core_path').
    'components/piwigomodx/').'model/piwigomodx/',$scriptProperties);

if (!($piwigoModx instanceof PiwigoModx)) {return false;}

/* get snippet properties */
$method = 'pwg.categories.getList';
$cat_id = $modx->getOption('cat_id',$scriptProperties,0);
$recursive = $modx->getOption('recursive',$scriptProperties,0);
$public = $modx->getOption('public',$scriptProperties,0);
$fullname = $modx->getOption('fullname',$scriptProperties,0);
$tpl_outer = $modx->getOption('tpl_outer',$scriptProperties,'piwigoModxCategoriesOuter');
$tpl_row = $modx->getOption('tpl_row',$scriptProperties,'piwigoModxCategoriesRow');

/* query piwigo */
$options = array(
    'cat_id' => $cat_id,
    'recursive' => $recursive,
    'public' => $public,
    'fullname' => $fullname,
);
$results = $piwigoModx->parseQuery($method,$options);
if (!$results) {
    $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find categories');
    return false;
}

/* only keep keys and values */
$categories = $results['result']['categories'];
unset($results);

/* output */
$outputCategories = '';
foreach ($categories as $category) {
    $outputCategories .= $piwigoModx->getChunk($tpl_row, $category);
}
$placeholders = array(
    'categories' => $outputCategories
);

$output = $piwigoModx->getChunk($tpl_outer,$placeholders);
return $output;
