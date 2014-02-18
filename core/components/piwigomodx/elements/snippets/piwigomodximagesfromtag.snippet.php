<?php
/**
 * PiwigoModxImagesFromTag Snippet for retrieving pictures from one or
 * more tags
 *
 * @author Philippe Juillerat (philippe.juillerat@filago.ch)
 *
 * @example [[PiwigoModxImagesFromTag? &tag_name=`Holidays|Hike` &f_min_date_created=`2013-01-19`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package piwigomodx
 *
 * @param int $tag_id optional Piwigo tag id. To filter by multiple tags,
 * separate ids with a pipe |. At least one of tag_id, tag_url_name or
 * tag_name is required. Default null
 * @param string $tag_url_name optional Piwigo tag permalink. To filter
 * by multiple tags, separate tag_url_names with a pipe |. Default null.
 * @param string $tag_name optional Piwigo tag name. To filter by
 * multiple tags, separate tag_names with a pipe |. Default null.
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
 * @param bool|int $show_tag_info optional Flag whether to show
 * tag information from $tag_id tag. Default 0
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
 * @param bool|int $show_linked_tags optional Flag whether to show
 * linked tags. Default: 0
 * @param string $tags_tpl_outer optional Chunk that contain the
 * list of tags. Default piwigoModxTagsOuter
 * @param string $tags_tpl_row optional Chunk to display each tag.
 * Default piwigoModxTagsRow
 */
$piwigoModx = $modx->getService('piwigomodx','PiwigoModx',
    $modx->getOption('piwigomodx.core_path',null,$modx->getOption('core_path').'components/piwigomodx/').
    'model/piwigomodx/',$scriptProperties);

if (!($piwigoModx instanceof PiwigoModx)) {return false;}

/* get snippet properties */
$method = 'pwg.tags.getImages';
$tag_id = $modx->getOption('tag_id',$scriptProperties,null);
$tag_url_name = $modx->getOption('tag_url_name',$scriptProperties,null);
$tag_name = $modx->getOption('tag_name',$scriptProperties,null);
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
$show_tag_info = $modx->getOption('show_tag_info',$scriptProperties,0);
$image_type = $modx->getOption('image_type',$scriptProperties,'medium');
$thumbnail_type = $modx->getOption('thumbnail_type',$scriptProperties,'thumb');
$tpl_outer = $modx->getOption('tpl_outer',$scriptProperties,'piwigoModxImagesOuter');
$tpl_row = $modx->getOption('tpl_row',$scriptProperties,'piwigoModxImagesRow');
$show_linked_tags = $modx->getOption('show_linked_tags',$scriptProperties,0);
$tags_tpl_outer = $modx->getOption('tags_tpl_outer',$scriptProperties,'piwigoModxTagsOuter');
$tags_tpl_row = $modx->getOption('tags_tpl_row',$scriptProperties,'piwigoModxTagsRow');

/* query piwigo */
$options['tag_id'] = $piwigoModx->explodeParams($tag_id);
$options['per_page'] = $per_page;
$options['page'] = $page;
if (!empty($tag_url_name)) {$options['tag_url_name'] = $piwigoModx->explodeParams($tag_url_name);}
if (!empty($tag_name)) {$options['tag_name'] = $piwigoModx->explodeParams($tag_name);}
if (!empty($tpl_outer)) {$options['tpl_outer'] = $tpl_outer;}
if (!empty($tpl_row)) {$options['tpl_row'] = $tpl_row;}
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

    /* linked tags */
    $tags = '';
    $linked_tags = array();
    if ($show_linked_tags) {
        foreach ($image['tags'] as $tag) {
            $tags .= $piwigoModx->getChunk($tags_tpl_row, $tag);
        }
        $tags = $piwigoModx->getChunk($tags_tpl_outer, array(
            'tags' => $tags
        ));
    }
    unset($image['tags']);

    $placeholders = array_merge($image, array(
        'src' => $src,
        'thumbnail_src' => $thumbnail_src,
        'width' => $thumbnail_width,
        'height' => $thumbnail_height,
        'tags' => $tags,
    ));

    $outputImages .= $piwigoModx->getChunk($tpl_row, $placeholders);
}
unset($images);

/* tag information */
$tag_information = array();
if ($show_tag_info && (!empty($tag_id) || !empty($tag_url_name) || !empty($tag_name))) {
    if ($info = $piwigoModx->parseQuery('pwg.tags.getList')) {
        $tags = $info['result']['tags'];
        unset($info);
        foreach ($tags as $tag) {
            if ($tag['id'] == $tag_id || $tag['url_name'] === $tag_url_name || $tag['name'] === $tag_name) {
                $tag_information = $tag;
                $tag_information['total_nb_images'] = $tag_information['counter'];
                unset($tag_information['counter']);
                break;
            }
        }
        unset($tags);
    } else {
        $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find tags');
    }
}

$placeholders = array_merge($tag_information, array(
    'images' => $outputImages,
));

/* output */;
$output = $piwigoModx->getChunk($tpl_outer,$placeholders);
return $output;
