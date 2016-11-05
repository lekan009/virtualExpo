<?php $this->load->view('_blocks/header')?>

<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=site_url()?>">Virtual Exposition</a>
        </div>
      </div>
</nav> 

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<div ng-view></div>

		</div>


		<div class="col-md-12">
			<div class="page-header">&nbsp;</div>
			<p class="text-center">powered by olalekan.pw</p>
		</div>
	</div>
</div>
<?php $this->load->view('_blocks/footer')?>