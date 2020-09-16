<?php
if (is_singular() && yogastudio_get_theme_option('use_ajax_views_counter')=='no') {
    yogastudio_set_post_views(get_the_ID());
}
