<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
<ul>
    <li><input type="text" class='search' value="<?php echo esc_html($s, 1); ?>" name="s" id="s" /></li>
    <li><input type="submit" class="button" id="searchsubmit" value="<?php _e('Search','rt_theme') ?> " /> </li>
</ul>
</form>
