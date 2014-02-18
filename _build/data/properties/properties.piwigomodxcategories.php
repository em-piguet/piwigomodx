<?php
$properties = array(
    array(
        'name' => 'cat_id',
        'desc' => 'Piwigo category id. When 0, display all categories',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'recursive',
        'desc' => 'Display also children categories',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'public',
        'desc' => 'Display only published categories',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'fullname',
        'desc' => 'Display also the parent category name for children categories',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'tpl_outer',
        'desc' => 'Chunk that contain the list of categories',
        'type' => 'textfield',
        'options' => '',
        'value' => 'piwigoModxCategoriesOuter',
    ),
    array(
        'name' => 'tpl_row',
        'desc' => 'Chunk to display each category',
        'type' => 'textfield',
        'options' => '',
        'value' => 'piwigoModxCategoriesRow',
    ),
);
return $properties;
