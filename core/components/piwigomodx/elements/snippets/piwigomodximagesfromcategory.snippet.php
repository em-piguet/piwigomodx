<?php
/**
 * PiwigoModxImagesFromCategory Snippet for retrieving pictures from one
 * or more categories
 *
 * @author Philippe Juillerat (philippe.juillerat@filago.ch)
 *
 * @example [[PiwigoModxImagesFromCategory? &cat_id=`5|6` &f_min_date_created=`2013-01-19 00:00:00`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package piwigomodx
 *
 * @param mixed $cat_id optional Piwigo category id. To filter by multiple
 * categories, separate ids with a pipe |. If empty, display all images.
 * Default null
 * @param bool|int $recursive optional Display also children categories.
 * Default 0
 * @param int $per_page optional Number of images per page. Default 100
 * @param int $page optional Page number to display. Default 0
 * @param string $order optional Sort image by: id, file, name, hit,
 * rating_score, date_creation, date_available, random. Default null
 * @param float $f_min_rate optional Minimum rating score. Default null
 * @param float $f_max_rate optional Maximum rating score. Default null
 * @param int $f_min_hit optional Minimum number of hits. Default null
 * @param int $f_max_hit optional Maximum number of hits. Default null
 * @param float $f_min_ratio optional Minimum aspect ratio. Default null
 * @param float $f_max_ratio optional Maximum aspect ratio. Default null
 * @param int $f_max_level optional Maximum visibility level. Default null
 * @param string $f_min_date_available optional Minimum date of publication.
 * For example: '2011-01-19'. Default null
 * @param string $f_max_date_available optional Maximum date of publication.
 * For example: '2011-01-19'. Default null
 * @param string $f_min_date_created optional Minimum date of creation.
 * For example: '2011-01-19'. Default null
 * @param string $f_max_date_created optional Maximum date of creation.
 * For example: '2011-01-19'. Default null
 * @param bool|int $show_category_info optional Flag whether to show
 * category information from $cat_id category. Default 0
 * @param string $image_type optional Type of image to link (square,
 * thumb, 2small, xsmall, small, medium, large, xlarge, xxlarge).
 * Default medium
 * @param string $thumbnail_type optional Type of thumbnail to display
 * (square, thumb, 2small, xsmall, small, medium, large, xlarge, xxlarge).
 * Default thumb
 * @param string $tpl_outer optional Chunk that contain the list of
 * images. Default piwigoModxImagesOuter
 * @param string $tpl_row optional Chunk to display each image.
 * Default piwigoModxImagesRow
 * @param bool|int $show_linked_categories optional Flag whether to show
 * linked categories. Default: 0
 * @param string $categories_tpl_outer optional Chunk that contain the
 * list of categories. Default piwigoModxImageCatOuter
 * @param string $categories_tpl_row optional Chunk to display each
 * category. Default piwigoModxImageCatRow
 */
$piwigoModx = $modx->getService('piwigomodx','PiwigoModx',
    $modx->getOption('piwigomodx.core_path',null,$modx->getOption('core_path').'components/piwigomodx/').
    'model/piwigomodx/',$scriptProperties);

if (!($piwigoModx instanceof PiwigoModx)) {return false;}

/* get snippet properties */
$method = 'pwg.categories.getImages';
$cat_id = $modx->getOption('cat_id',$scriptProperties,null);
$recursive = $modx->getOption('recursive',$scriptProperties,0);
$per_page = $modx->getOption('per_page',$scriptProperties,100);
$page = $modx->getOption('page',$scriptProperties,0);
$order = $modx->getOption('order',$scriptProperties,null);
$f_min_rate = $modx->getOption('f_min_rate',$scriptProperties,null);
$f_max_rate = $modx->getOption('f_max_rate',$scriptProperties,null);
$f_min_hit = $modx->getOption('f_min_hit',$scriptProperties,null);
$f_max_hit = $modx->getOption('f_max_hit',$scriptProperties,null);
$f_min_ratio = $modx->getOption('f_min_ratio',$scriptProperties,null);
$f_max_ratio = $modx->getOption('f_max_ratio',$scriptProperties,null);
$f_max_level = $modx->getOption('f_max_level',$scriptProperties,null);
$f_min_date_available = $modx->getOption('f_min_date_available',$scriptProperties,null);
$f_max_date_available = $modx->getOption('f_max_date_available',$scriptProperties,null);
$f_min_date_created = $modx->getOption('f_min_date_created',$scriptProperties,null);
$f_max_date_created = $modx->getOption('f_max_date_created',$scriptProperties,null);
$show_category_info = $modx->getOption('show_category_info',$scriptProperties,0);
$image_type = $modx->getOption('image_type',$scriptProperties,'medium');
$thumbnail_type = $modx->getOption('thumbnail_type',$scriptProperties,'thumb');
$tpl_outer = $modx->getOption('tpl_outer',$scriptProperties,'piwigoModxImagesOuter');
$tpl_row = $modx->getOption('tpl_row',$scriptProperties,'piwigoModxImagesRow');
$show_linked_categories = $modx->getOption('show_linked_categories',$scriptProperties,0);
$categories_tpl_outer = $modx->getOption('categories_tpl_outer',$scriptProperties,'piwigoModxImageCatOuter');
$categories_tpl_row = $modx->getOption('categories_tpl_row',$scriptProperties,'piwigoModxImageCatRow');

/* query piwigo */
$options = array(
    'cat_id' => $piwigoModx->explodeParams($cat_id),
    'recursive' => $recursive,
    'per_page' => $per_page,
    'page' => $page,
    'tpl_outer' => $tpl_outer,
    'tpl_row' => $tpl_row,
);

if (!empty($order)) {$options['order'] = $order;}
if (!empty($f_min_rate)) {$options['f_min_rate'] = $f_min_rate;}
if (!empty($f_max_rate)) {$options['f_max_rate'] = $f_max_rate;}
if (!empty($f_min_hit)) {$options['f_min_hit'] = $f_min_hit;}
if (!empty($f_max_hit)) {$options['f_max_hit'] = $f_max_hit;}
if (!empty($f_min_ratio)) {$options['f_min_ratio'] = $f_min_ratio;}
if (!empty($f_max_ratio)) {$options['f_max_ratio'] = $f_max_ratio;}
if (!empty($f_max_level)) {$options['f_max_level'] = $f_max_level;}
if (!empty($f_min_date_available)) {$options['f_min_date_available'] = $f_min_date_available;}
if (!empty($f_max_date_available)) {$options['f_max_date_available'] = $f_max_date_available;}
if (!empty($f_min_date_created)) {$options['f_min_date_created'] = $f_min_date_created;}
if (!empty($f_max_date_created)) {$options['f_max_date_created'] = $f_max_date_created;}

$results = $piwigoModx->parseQuery($method,$options);
if (!$results) {
    $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find images');
    return false;
}

/* only keep keys and values */
$images = $results['result']['images'];
unset($results);

/* images */
$outputImages = '';
foreach ($images as $image) {
    /* derivatives */
    $src = $image['derivatives'][$image_type]['url'];
    $thumbnail_src = $image['derivatives'][$thumbnail_type]['url'];
    $thumbnail_width = $image['derivatives'][$thumbnail_type]['width'];
    $thumbnail_height = $image['derivatives'][$thumbnail_type]['height'];
    unset($image['derivatives']);

    /* linked categories */
    $categories = '';
    if ($show_linked_categories) {
        foreach ($image['categories'] as $category) {
            $categories .= $piwigoModx->getChunk($categories_tpl_row, $category);
        }
        $categories = $piwigoModx->getChunk($categories_tpl_outer, array(
            'categories' => $categories
        ));
    }
    unset($image['categories']);

    $placeholders = array_merge($image, array(
        'src' => $src,
        'thumbnail_src' => $thumbnail_src,
        'width' => $thumbnail_width,
        'height' => $thumbnail_height,
        'categories' => $categories,
    ));

    $outputImages .= $piwigoModx->getChunk($tpl_row, $placeholders);
}
unset($images);

/* category information */
$category_information = array();
if ($cat_id > 0 && $show_category_info) {
    $info = $piwigoModx->parseQuery('pwg.categories.getList',array(
        'cat_id' => $cat_id,
        'recursive' => '0',
        'public' => '1',
    ));
    if ($info) {
        $category_information = $info['result']['categories'][0];
    } else {
        $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find category');
        unset($info);
    }
}

$placeholders = array_merge($category_information, array(
    'images' => $outputImages,
));

/* output */;
$output = $piwigoModx->getChunk($tpl_outer,$placeholders);
return $output;
