<?php $this->load->view('_blocks/header')?>
    <div class="container">
        <div class="row">
        <div class="col-md-10 centered">
          <h2>Event Places</h2>
            <a href="<?=site_url('backoffice/event') ?>"><button class="btn btn-sm btn-primary"> Create New Place </button></a>  
            <a href="<?=site_url('backoffice/event/create') ?>"><button class="btn btn-sm btn-primary"> Create Event </button></a>
            <br>
            <div class="clearfix">&nbsp;</div>

            <?php if ( !empty($event_places) ) { ?>

            <table class="table table-bordered table-inverse">
              <thead>
                <tr>
                  <th width="25%">Name</th>
                  <th width="65%">Location</th>
                  <th width="10%" style="text-align:center;">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($event_places as $places) : ?>
                <tr>
                  <td><?=$places->event_place_name?></td>
                  <td><?=$places->event_place_location?></td>
                  <td>
                    <a href="<?=site_url()?>"> Edit</a> | 
                    <a href="<?=site_url()?>" onclick="return confirm('Are you sure you want to delete <?php echo $places->event_place_name; ?>?')">Delete </a>
                  </td>
                </tr>

                <?php endforeach; ?>

              </tbody>
            </table>
            
            <?php } else echo '<h1>'.$display_message.'</h1>' ; ?>

        </div>
        </div>
    </div>
<?php $this->load->view('_blocks/footer')?>