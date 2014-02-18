--------------------
PiwigoModx
--------------------
Version: 1.0.0-pl
Authors: Epy (webmaster@aide-en-info.net)
         Philippe Juillerat <philippe.juillerat@filago.ch>

PiwigoModx id a MODx addon that displays images from a Piwigo gallery.
Manage your images inside the Piwigo manager and display these inside
your site MODx front-end. This component allows you to easily retrieve
and display categories, tags, images and image metadata. There are
options to filter images by category, tag, aspect ratio, date of creation
and more.

Because PiwigoModx is using Piwigo API (named webservices), its even possible
to install MODx and Piwigo on completely distinct websites.


Installation
============================

1.  Install PiwigoModx via the package manager and set the system
    settings for PiwigoModx via the form displayed during setup:
    - Url or your Piwigo gallery (piwigomodx.piwigo_url):
        The url at which Piwigo is installed.
        Example :
            http://hostname.tld/piwigo/


Snippet usage
============================

Currently there are five snippets available for PiwigoModx:
PiwigoModxImage, PiwigoModxImagesFromCategory, PiwigoModxImagesFromTag,
PiwigoModxCategories and PiwigoModxTags.


PiwigoModxImage
----------------------------
Snippet for retrieving metadata from a picture.

Example usage:
[[PiwigoModxImage? &image_id=`123`]]

This will return the image with id 123 and display it using chunk
piwigoModxImage

The following parameters are supported by PiwigoModxImage:
- image_id
    Piwigo image id
- tpl (optional)
    Chunk to display the image.
    Default: piwigoModxImage
- image_type (optional)
    Type of image to link, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default medium
- thumbnail_type (optional)
    Type of thumbnail to display, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default 2small
- show_linked_categories (optional)
    Flag whether to show linked categories.
    Default: 0
- categories_tpl_outer (optional)
    Chunk that contain the list of categories.
    Default piwigoModxImageCatOuter
- categories_tpl_row (optional)
    Chunk to display each category.
    Default piwigoModxImageCatRow
- show_tags (optional)
    Flag whether to show tags.
    Default: 0
- tags_tpl_outer (optional)
    Chunk that contain the list of tags.
    Default piwigoModxTagsOuter
- tags_tpl_row (optional)
    Chunk to display each tag.
    Default piwigoModxTagsRow
- show_comments (optional)
    Flag whether to show comments.
    Default: 0
- comments_tpl_outer (optional)
    Chunk that contain the list of comments.
    Default piwigoModxCommentsOuter
- comments_tpl_row (optional)
    Chunk to display each comment.
    Default piwigoModxCommentsRow
- comments_page (optional)
    Page of comment to display.
    Default 0
- comments_per_page (optional)
    Number of comments to display per page.
    Default: 10


PiwigoModxImagesFromCategory
----------------------------
Snippet for retrieving pictures from one or more categories.

Example usage:
[[PiwigoModxImagesFromCategory? &cat_id=`5|6` &f_min_date_created=`2013-01-19 00:00:00`]]

This will return the 100 first images from categories with ids 5 and 6,
that have been taken after the 19 january 2013.

The following parameters are supported by PiwigoModxImagesFromCategory:
- cat_id (optional)
    Piwigo category id. To filter by multiple categories, separate ids
    with a pipe |. If empty, display all images.
- recursive (optional)
    Display also children categories.
    Default 0
- per_page (optional)
    Number of images per page.
    Default 100
- page (optional)
    Page number to display.
    Default 0
- order (optional)
    Sort image by:
    - id,
    - file,
    - name,
    - hit,
    - rating_score,
    - date_creation,
    - date_available,
    - random.
- f_min_rate (optional)
    Minimum rating score.
- f_max_rate (optional)
    Maximum rating score.
- f_min_hit (optional)
    Minimum number of hits.
- f_max_hit (optional)
    Maximum number of hits.
- f_min_ratio (optional)
    Minimum aspect ratio.
- f_max_ratio (optional)
    Maximum aspect ratio.
- f_max_level (optional)
    Maximum visibility level.
- f_min_date_available (optional)
    Minimum date of publication. For example: '2011-01-19'.
- f_max_date_available (optional)
    Maximum date of publication. For example: '2011-01-19'.
- f_min_date_created (optional)
    Minimum date of creation. For example: '2011-01-19'.
- f_max_date_created (optional)
    Maximum date of creation. For example: '2011-01-19'.
- show_category_info (optional)
    Flag whether to show category information from cat_id category.
    Default 0
- image_type (optional)
    Type of image to link, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default medium
- thumbnail_type (optional)
    Type of thumbnail to display, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default thumb
- tpl_outer (optional)
    Chunk that contain the list of images.
    Default piwigoModxImagesOuter
- tpl_row (optional)
    Chunk to display each image.
    Default piwigoModxImagesRow
- show_linked_categories (optional)
    Flag whether to show
    Default: 0
- categories_tpl_outer (optional)
    Chunk that contain the list of categories.
    Default piwigoModxImageCatOuter
- categories_tpl_row (optional)
    Chunk to display each category.
    Default piwigoModxImageCatRow


PiwigoModxImagesFromTag
----------------------------
Snippet for retrieving pictures from one or more tags.

Example usage:
[[PiwigoModxImagesFromTag? &tag_name=`Holidays|Hike` &f_min_date_created=`2013-01-19`]]

This will return the 100 first images marked by tags Holidays or Hike
and that have been taken after the 19 january 2013.

The following parameters are supported by PiwigoModxImagesFromTag:

- tag_id (optional)
    Piwigo tag id. To filter by multiple tags, separate ids with a
    pipe |. At least one of tag_id, tag_url_name or tag_name is required.
- tag_url_name (optional)
    Piwigo tag permalink. To filter by multiple tags, separate
    tag_url_names with a pipe |.
- tag_name (optional)
    Piwigo tag name. To filter by multiple tags, separate tag_names
    with a pipe |.
- per_page (optional)
    Number of images per page.
    Default 100
- page (optional)
    Page number to display.
    Default 0
- order (optional)
    Sort image by:
    - id,
    - file,
    - name,
    - hit,
    - rating_score,
    - date_creation,
    - date_available,
    - random.
- f_min_rate (optional)
    Minimum rating score.
- f_max_rate (optional)
    Maximum rating score.
- f_min_hit (optional)
    Minimum number of hits.
- f_max_hit (optional)
    Maximum number of hits.
- f_min_ratio (optional)
    Minimum aspect ratio.
- f_max_ratio (optional)
    Maximum aspect ratio.
- f_max_level (optional)
    Maximum visibility level.
- f_min_date_available (optional)
    Minimum date of publication. For example: '2011-01-19'.
- f_max_date_available (optional)
    Maximum date of publication. For example: '2011-01-19'.
- f_min_date_created (optional)
    Minimum date of creation. For example: '2011-01-19'.
- f_max_date_created (optional)
    Maximum date of creation. For example: '2011-01-19'.
- show_tag_info (optional)
    Flag whether to show tag information from tag_id tag.
    Default 0
- image_type (optional)
    Type of image to link, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default medium
- thumbnail_type (optional)
    Type of thumbnail to display, one of these values:
    - square,
    - thumb,
    - 2small,
    - xsmall,
    - small,
    - medium,
    - large,
    - xlarge,
    - xxlarge.
    Default thumb
- tpl_outer (optional)
    Chunk that contain the list of images.
    Default piwigoModxImagesOuter
- tpl_row (optional)
    Chunk to display each image.
    Default piwigoModxImagesRow
- show_linked_tags (optional)
    Flag whether to show linked tags.
    Default: 0
- tags_tpl_outer (optional)
    Chunk that contain the list of tags.
    Default piwigoModxTagsOuter
- tags_tpl_row (optional)
    Chunk to display each tag.
    Default piwigoModxTagsRow


PiwigoModxCategories
----------------------------
Snippet for retrieving categories related to published pictures.

Example usage:
[[PiwigoModxCategories? &tpl_row=`myCategory`]]

This will return the list of categories and display them with chunk
myCategory

The following parameters are supported by PiwigoModxCategories:
- cat_id (optional)
    Piwigo category id. When 0, display all categories.
    Default 0
- recursive (optional)
    Display also children categories.
    Default 0
- public (optional)
    Display only published categories.
    Default 0
- fullname (optional)
    Display also the parent category name for children categories.
    Default 0
- tpl_outer (optional)
    Chunk that contain the list of categories.
    Default piwigoModxCategoriesOuter
- tpl_row (optional)
    Chunk to display each category.
    Default piwigoModxCategoriesRow


PiwigoModxTags
----------------------------
Snippet for retrieving tags related to published pictures.

Example usage:
[[PiwigoModxTags? &level_classes=`small=1&big=10`]]

This will return a tag cloud sorted by tag name. Each tag related from 1
to 9 images will be displayed using class 'small', while tags related
to more than 10 images will be displayed with class 'big'.

The following parameters are supported by PiwigoModxTags:
- sort_by_counter (optional)
    Flag whether to sort by number of related images. If 0, sort by name.
    Default 0
- tags_tpl_outer (optional)
    Chunk that display the list of tags.
    Default piwigoModxTagsOuter
- tags_tpl_row (optional)
    Chunk to display each tag.
    Default piwigoModxTagsRow
- level_classes (optional)
    List of parameters that define the CSS class (key) to use for
    categories of tags based on the number of related images (value).
    Separate level classes with chararcter '&'
    Default: 'tagLevel1=1&tagLevel2=3&tagLevel3=7tagLevel4=10&taglevel5=13'


Support
============================

Feel free to suggest ideas/improvements/bugs on GitHub:
https://github.com/juillerat/piwigomodx/issues
