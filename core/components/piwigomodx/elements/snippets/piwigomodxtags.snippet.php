<?php
/**
 * PiwigoModxTags Snippet for retrieving tags related to published pictures
 *
 * @author Philippe Juillerat (philippe.juillerat@filago.ch)
 *
 * @example [[PiwigoModxTags? &level_classes=`small=1&big=10`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package piwigomodx
 *
 * @param bool|int $sort_by_counter optional Flag whether to sort by
 * number of related images. If 0, sort by name. Default 0
 * @param string $tags_tpl_outer optional Chunk that display the list of
 * tags. Default piwigoModxTagsOuter
 * @param string $tags_tpl_row optional Chunk to display each tag.
 * Default piwigoModxTagsRow
 * @param string $level_classes optional List of parameters that define
 * the CSS class (key) to use for categories of tags based on the number
 * of related images (value). Separate level classes with chararcter '&'
 * Default :'tagLevel1=1&tagLevel2=3&tagLevel3=7tagLevel4=10&taglevel5=13'
 */
$piwigoModx = $modx->getService('piwigomodx','PiwigoModx',
    $modx->getOption('piwigomodx.core_path',null,$modx->getOption('core_path').
    'components/piwigomodx/').'model/piwigomodx/',$scriptProperties);

if (!($piwigoModx instanceof PiwigoModx)) {return false;}

/* get snippet properties */
$method = 'pwg.tags.getList';
$default_level_classes = array(
    'tagLevel1' => 1,
    'tagLevel2' => 3,
    'tagLevel3' => 7,
    'tagLevel4' => 10,
    'tagLevel5' => 13
);
$sort_by_counter = $modx->getOption('sort_by_counter',$scriptProperties,0);
$tags_tpl_outer = $modx->getOption('tags_tpl_outer',$scriptProperties,'piwigoModxTagsOuter');
$tags_tpl_row = $modx->getOption('tags_tpl_row',$scriptProperties,'piwigoModxTagsRow');
$level_classes = $modx->getOption('level_classes',$scriptProperties,$default_level_classes);
if (!is_array($level_classes)) {
    parse_str($level_classes,$level_classes);
}
arsort($level_classes);

/* query piwigo */
$options['sort_by_counter'] = $sort_by_counter;
$results = $piwigoModx->parseQuery($method,$options);
if (!$results) {
    $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find tags related to pictures');
    return false;
}

/* only keep keys and values */
$tags = $results['result']['tags'];
unset($results);

/* output */
$outputTags = '';
foreach ($tags as $tag) {
    /* define classes based of the number of related images */
    foreach ($level_classes as $class => $level) {
        if ($tag['counter'] >= $level) {
            break;
        }
    }
    $tag['class'] = $class;
    $outputTags .= $piwigoModx->getChunk($tags_tpl_row, $tag);
}
$placeholders = array(
    'tags' => $outputTags
);

$output = $piwigoModx->getChunk($tags_tpl_outer,$placeholders);
return $output;
