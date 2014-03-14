<?php
/**
 * PiwigoModxImage Snippet for retrieving metadata from a picture
 *
 * @author Philippe Juillerat (philippe.juillerat@filago.ch)
 *
 * @example [[PiwigoModxImage? &image_id=`123`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package piwigomodx
 *
 * @param int $image_id Piwigo image id
 * @param string $tpl optional Chunk to display the image. Default:
 * piwigoModxImage
 * @param string $cls optional CSS class name for the template.
 * Default: null
 * @param string $image_type optional Type of image to link (square,
 * thumb, 2small, xsmall, small, medium, large, xlarge, xxlarge).
 * Default medium
 * @param string $thumbnail_type optional Type of thumbnail to display
 * (square, thumb, 2small, xsmall, small, medium, large, xlarge, xxlarge).
 * Default 2small
 * @param bool|int $show_linked_categories optional Flag whether to show
 * linked categories. Default: 0
 * @param string $categories_tpl_outer optional Chunk that contain the
 * list of categories. Default piwigoModxImageCatOuter
 * @param string $categories_tpl_row optional Chunk to display each
 * category. Default piwigoModxImageCatRow
 * @param bool|int $show_tags optional Flag whether to show tags.
 * Default: 0
 * @param string $tags_tpl_outer optional Chunk that contain the list of
 * tags. Default piwigoModxTagsOuter
 * @param string $tags_tpl_row optional Chunk to display each tag.
 * Default piwigoModxTagsRow
 * @param bool|int $show_comments optional Flag whether to show comments.
 * Default: 0
 * @param string $comments_tpl_outer optional Chunk that contain the list
 * of comments. Default piwigoModxCommentsOuter
 * @param string $comments_tpl_row optional Chunk to display each comment.
 * Default piwigoModxCommentsRow
 * @param int $comments_page optional Page of comment to display.
 * Default 0
 * @param int $comments_per_page optional Number of comments to display
 * per page. Default: 10
 */
$piwigoModx = $modx->getService('piwigomodx','PiwigoModx',
    $modx->getOption('piwigomodx.core_path',null,$modx->getOption('core_path').'components/piwigomodx/').
    'model/piwigomodx/',$scriptProperties);

if (!($piwigoModx instanceof PiwigoModx)) {return false;}

/* get snippet properties */
$method = 'pwg.images.getInfo';
$image_id = $modx->getOption('image_id',$scriptProperties,'');
$tpl = $modx->getOption('tpl',$scriptProperties,'piwigoModxImage');
$cls = $modx->getOption('cls',$scriptProperties,null);
$image_type = $modx->getOption('image_type',$scriptProperties,'medium');
$thumbnail_type = $modx->getOption('thumbnail_type',$scriptProperties,'2small');
$show_linked_categories = $modx->getOption('show_linked_categories',$scriptProperties,0);
$categories_tpl_outer = $modx->getOption('categories_tpl_outer',$scriptProperties,'piwigoModxImageCatOuter');
$categories_tpl_row = $modx->getOption('categories_tpl_row',$scriptProperties,'piwigoModxImageCatRow');
$show_tags = $modx->getOption('show_tags',$scriptProperties,0);
$tags_tpl_outer = $modx->getOption('tags_tpl_outer',$scriptProperties,'piwigoModxTagsOuter');
$tags_tpl_row = $modx->getOption('tags_tpl_row',$scriptProperties,'piwigoModxTagsRow');
$show_comments = $modx->getOption('show_comments',$scriptProperties,0);
$comments_tpl_outer = $modx->getOption('comments_tpl_outer',$scriptProperties,'piwigoModxCommentsOuter');
$comments_tpl_row = $modx->getOption('comments_tpl_row',$scriptProperties,'piwigoModxCommentsRow');
$comments_page = $modx->getOption('comments_page',$scriptProperties,0);
$comments_per_page = $modx->getOption('comments_per_page',$scriptProperties,10);

/* query piwigo */
$options['image_id'] = $image_id;
if ($show_comments) {
    $options['comments_page'] = $comments_page;
    if ($comments_per_page > 0) {
        $options['comments_per_page'] = $comments_per_page;
    }
}
$results = $piwigoModx->parseQuery($method,$options);
if (!$results) {
    $modx->log(modX::LOG_LEVEL_WARN, 'Can\'t find image_id: '.$image_id);
    return false;
}

/* only keep keys and values */
$image = $results['result'];
unset($results);

/* derivatives */
$src = $image['derivatives'][$image_type]['url'];
$thumbnail_src = $image['derivatives'][$thumbnail_type]['url'];
$thumbnail_width = $image['derivatives'][$thumbnail_type]['width'];
$thumbnail_height = $image['derivatives'][$thumbnail_type]['height'];
unset($image['derivatives']);

/* rating scores */
$rate_score = $image['rates']['score'];
$rate_count = $image['rates']['count'];
unset($image['rates']);

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

/* tags */
$tags = '';
if ($show_tags) {
    foreach ($image['tags'] as $tag) {
        $tags .= $piwigoModx->getChunk($tags_tpl_row, $tag);
    }
    $tags = $piwigoModx->getChunk($tags_tpl_outer, array(
        'tags' => $tags
    ));
}
unset($image['tags']);

/* comments */
$comments = '';
if ($show_comments) {
    foreach($image['comments']['_content'] as $comment) {
        $comments .= $piwigoModx->getChunk($comments_tpl_row, $comment);
    }
    $comments = $piwigoModx->getChunk($comments_tpl_outer, array(
        'comments' => $comments
    ));
}
unset($image['comments']);

$placeholders = array_merge($image, array(
    'cls' => $cls,
    'src' => $src,
    'thumbnail_src' => $thumbnail_src,
    'width' => $thumbnail_width,
    'height' => $thumbnail_height,
    'rate_score' => $rate_score,
    'rate_count' => $rate_count,
    'categories' => $categories,
    'tags' => $tags,
    'comments' => $comments,
));

/* output */
$output = $piwigoModx->getChunk($tpl,$placeholders);
return $output;

