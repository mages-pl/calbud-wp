<div class="row">

	<div class="col-md-4">
		<p class="xs-up-hidden"><strong>Stanowisko:</strong></p>
		<p><?php the_title(); ?></p>
	</div>
	<div class="col-md-4">
		<p class="xs-up-hidden"><strong>Miejsce pracy:</strong></p>
		<p><?php the_field('miejsce_pracy'); ?></p>
	</div>
	<div class="col-md-4 last">

		<a href="<?php the_permalink(); ?>" class="modal-link">Dowiedz się więcej</a>

		<button type="button" class="modal-button" data-toggle="modal" data-target="#exampleModalCenter">
		Aplikuj
		</button>
		<?php /*
		<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample<?php echo uniqid(); ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
			Link with href
		</a>
		*/?>

	</div>

</div>
<?php /*
<div class="collapse" id="collapseExample<?php echo uniqid(); ?>">
      <div class="modal-body">
	  
       <div class="row" style="background:#FAFAFA;">
			<div class="col-md-12 text-center">
				<p class="big">Dziękujemy za zainteresowanie ofertą. Prosimy o wypełnienie poniższego formularza, abyśmy mogli rozpatrzyć tę kandydaturę na dane stanowisko.</p>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-3">
				<h6>Stanowisko</h6>
			</div>
			<div class="col-md-9">
				<h4><?php the_title(); ?> źle pobiera tytuł</h4>			
			</div>
		</div>

		<?php echo do_shortcode('[contact-form-7 id="76b094d" title="Formularz Oferta Pracy"]'); ?>

      </div>
</div>
*/?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
   
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
       <div class="row" style="background:#FAFAFA;">
			<div class="col-md-12 text-center">
				<p class="big">Dziękujemy za zainteresowanie ofertą. Prosimy o wypełnienie poniższego formularza, abyśmy mogli rozpatrzyć tę kandydaturę na dane stanowisko.</p>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-3">
				<h6>Stanowisko</h6>
			</div>
			<div class="col-md-9">
				<h4><?php the_title(); ?> źle pobiera tytuł</h4>			
			</div>
		</div>

		<?php echo do_shortcode('[contact-form-7 id="76b094d" title="Formularz Oferta Pracy"]'); ?>

      </div>

    </div>
  </div>
</div>
