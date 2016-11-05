<?php $this->load->view('_blocks/header')?>
<!-- BEGIN PAGE BASE CONTENT -->
                <div class="container">
                    <div class="row">
                        <h2>Create New Event</h2>
                        <div class="col-md-5 centered">
                        	<?php
                        	echo validation_errors(); 
                        	echo $display_message; 
                        	echo $this->session->flashdata('display_message');
                        	?>

                            <!-- BEGIN FORM-->
                        	<?php
								$attributes = array('class' => '');
								echo form_open('backoffice/event/create', $attributes); 
							?>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Title', 'event_title', $attributes);

                                    $txtEventTitle = array(
                                        'name'         => 'txtEventTitle',
                                        'class'        => 'form-control form-control-solid placeholder-no-fix',
                                        'value'        => set_value('txtEventTitle'),
                                        'autocomplete' => 'off',
                                        'placeholder'  => 'Launching of the Igbo Art',
                                    );
                                    echo form_input($txtEventTitle);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    $attribute = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Place', 'event_place', $attribute);

                                    $attributes = array('class' => 'form-control form-control-solid placeholder-no-fix',);
                                    echo form_dropdown('txtEventPlace', $event_places, set_value('txtEventPlace'), $attributes);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Date', 'event_date', $attributes);
                                ?>

                                <input type="text" name="daterange" class="form-control form-control-solid placeholder-no-fix" set_value('daterange') />
                            </div>



                            <div class="form-actions">
                                <div class="row">
                                    <!-- <div class="col-md-5 col-md-offset-5"> -->
                                    	<?php
					                        $attributes = array(
					                            'value' => 'Submit',
					                            'class' => 'btn btn-primary btn-block',
					                        );
					                        echo form_submit($attributes);
					                    ?>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <?=form_close()?>
                            <!-- END FORM-->

                            <!-- list events -->

                        </div>
                    </div>
                    <div class="row">
                        <h2>Events</h2>
                        <div class="col-md-10 centered">
                            <?php if ( !empty($events) ) { ?>

                            <table class="table table-bordered table-inverse">
                              <thead>
                                <tr>
                                  <th width="28%">Title</th>
                                  <th width="30%">Location</th>
                                  <th width="32%">Time</th>
                                  <th width="10%" style="text-align:center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php foreach ($events as $event_list) : ?>
                                <tr>
                                  <td><?=$event_list->event_title?></td>
                                  <td><?=get_event_place_by_id($event_list->event_place_id)->event_place_name?></td>
                                  <td><?=$event_list->event_date?></td>
                                  <td>
                                    <a href="<?=site_url()?>"> Edit</a> | 
                                    <a href="<?=site_url()?>" onclick="return confirm('Are you sure you want to delete <?php echo $event_list->event_title; ?>?')">Delete </a>
                                  </td>
                                </tr>

                                <?php endforeach; ?>

                              </tbody>
                            </table>
                            
                            <?php } else echo '<h1>'.$display_message.'</h1>' ; ?>
                        </div>
                    </div>
                </div>
                    <!-- END PAGE BASE CONTENT -->
<?php $this->load->view('_blocks/footer')?>
