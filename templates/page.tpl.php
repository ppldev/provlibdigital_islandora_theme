<?php

/**
* @file
*/

?>

<?php include('includes/header.php'); ?>

<div id="page" class="<?php print $classes; ?>" <?php print $attributes; ?>>
	<div id="main">
		<div id="container">
			<section id="content">
				<?php if ($breadcrumb || $title || $messages || $tabs || $action_links): ?>

					<?php  print $breadcrumb; ?>

					<?php if ($page['highlighted']) : ?>
						<div id="highlighted">
							<?php print render($page['highlighted']) ?>
						</div>
					<?php endif; ?>

					<?php if ($title): ?>
						<!--<h1 class="title"><?php print $title; ?></h1>-->
					<?php endif; ?>

					<?php if(theme_get_setting('pld_collections_description_text') && drupal_is_front_page()): ?>
						<div class="pld-collections-text__wrapper">
							<?php print theme_get_setting('pld_collections_description_text'); ?>
						</div>
					<?php endif; ?>

					<?php print render($title_suffix); ?>
					<?php print $messages; ?>
            		<?php print render($page['help']); ?>		
            		
            		<?php if (render($tabs)): ?>
              		<div class="tabs"><?php print render($tabs); ?></div>
            		<?php endif; ?>

            		<?php if ($action_links): ?>
              		<ul class="action-links"><?php print render($action_links); ?></ul>
            		<?php endif; ?>			

				<?php endif; ?>

				 <div id="content-area">
         		 <?php print render($page['content']) ?>
        		</div>

        		<?php print $feed_icons; ?>

			</section><!-- ./content -->
			<?php if ($page['sidebar_first']): ?>
		        <aside id="sidebar-first">
		          <?php print render($page['sidebar_first']); ?>
		        </aside>
      		<?php endif; ?><!-- /sidebar-first -->

		      <?php if ($page['sidebar_second']): ?>
		        <aside id="sidebar-second">
		          <?php print render($page['sidebar_second']); ?>
		        </aside>
		      <?php endif; ?><!-- /sidebar-second -->
		</div>
	</div><!-- ./main -->
</div>

<?php include('includes/footer.php'); ?>