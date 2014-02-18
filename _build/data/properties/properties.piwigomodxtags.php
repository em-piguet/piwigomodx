<?php
$properties = array(
    array(
        'name' => 'sort_by_counter',
        'desc' => 'Flag whether to sort by number of related images. If 0, sort by name',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'tags_tpl_outer',
        'desc' => 'Chunk that contain the list of tags',
        'type' => 'textfield',
        'options' => '',
        'value' => 'piwigoModxTagsOuter',
    ),
    array(
        'name' => 'tags_tpl_row',
        'desc' => 'Chunk to display each tag',
        'type' => 'textfield',
        'options' => '',
        'value' => 'piwigoModxTagsRow',
    ),
    array(
        'name' => 'level_classes',
        'desc' => 'List of parameters that define the CSS class (key) to use for categories of tags based on the number of related images (value). Separate level classes with chararcter &amp;',
        'type' => 'textfield',
        'options' => '',
        'value' => 'tagLevel1=1&tagLevel2=3&tagLevel3=7tagLevel4=10&taglevel5=13',
    ),
);
return $properties;
