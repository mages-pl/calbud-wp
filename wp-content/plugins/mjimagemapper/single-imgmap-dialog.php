<div id="dialog-meta">
	<?php
	if(current_user_can('edit_post', $post->ID)) {
		?><a class="post-edit-link" href="<?php echo get_edit_post_link($post->ID); ?>" title="Edit">Edit</a><?php
	} ?>
</div>
<div id="dialog-content">
	<?php 
		$content = apply_filters('the_content', $post->post_content);
	//	echo str_replace(']]>', ']]&gt;', $content);
	?>
    <div class="row">
    <div class="col-md-4">
    <h4>Lokal:
    <?php 
     echo get_field("numerlokalu", $post->ID);
     ?>
    </h4>
            <h6>
        <b>Piętro:</b> <?php echo get_field("pietro", $post->ID); ?>
            </h6>
    <br/>
        <b>Status:</b> <?php echo get_field("status", $post->ID); ?>
    <br/>
        <b>Pokoje:</b> <?php echo get_field("pokoje", $post->ID); ?>
    <br/>
    
    <b>Powierzchnia:</b> <?php echo get_field("powierzchnia", $post->ID); ?>
    <?php 
    if(!empty(get_field("powierzchnia", $post->ID))) {
    ?>
     m<sup>2</sup>
     <?php
     }
     ?>
    <br/>
        <b>Cena:</b> <?php echo number_format(get_field("cena", $post->ID),2,'.',' '); ?> 
        <?php
        if(!empty(get_field("cena", $post->ID))) {
        ?>
        zł
        <?php
            }
        ?>
    <br/>
    <br/>
    <?php
    if(empty(get_field("rzut", $post->ID)['url'])) {
        ?>
        <a target="_blank" id="pobierz-rzut" href="#pobierz-rzut" class="inwestycja more more-reverse btn btn-primary" style="cursor:not-allowed;margin: 50px auto;display: block;border: 0px;"><em>Pobierz rzut</em></a>
        <?php
    } else {
        ?>
    <a target="_blank" href="<?php echo get_field("rzut", $post->ID)['url']; ?>" class="inwestycja more more-reverse btn btn-primary" style="margin: 50px auto;display: block;border: 0px;"><em>Pobierz rzut</em></a>
        <?php
    }
        ?>
    
    <a href="tel:<?php echo get_option('phone_contact_imagemapping'); ?>" style="color: inherit;    display: block;
    color: inherit;
    text-align: center;">tel.  <?php echo get_option('phone_contact_imagemapping'); ?></a>
</div>
    <div class="col-md-8 imgmap_prawy_panel">
    <?php
    if(empty(str_replace(".pdf", "-pdf.jpg", get_field("rzut", $post->ID)['url']))) {
    ?>
    <img src="<?php echo bloginfo('url'); ?>/wp-content/plugins/mjimagemapper/images/placeholder.jpg"/>
    <?php
    } else {
    ?>
    <img src="<?php echo str_replace(".pdf", "-pdf.jpg", get_field("rzut", $post->ID)['url']); ?>"/>
    <?php
    }
    ?>
    </div>
</div>
    </div>