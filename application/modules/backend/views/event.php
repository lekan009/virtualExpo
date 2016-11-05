<?php $this->load->view('_blocks/header')?>
<!-- BEGIN PAGE BASE CONTENT -->
                <div class="container">
                    <div class="row">
                        <h2>Create New Event Places</h2>
                        <div class="col-md-5 centered">
                        	<?php
                        	echo validation_errors(); 
                        	echo $display_message; 
                        	echo $this->session->flashdata('display_message');
                        	?>

                            <!-- BEGIN FORM-->
                        	<?php
								$attributes = array('class' => '');
								echo form_open_multipart('backoffice/event', $attributes); 
							?>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Place Name', 'place_name', $attributes);
                                ?>

                                <?php
                                    $txtEventPlace = array(
                                        'name'         => 'txtEventPlace',
                                        'class'        => 'form-control form-control-solid placeholder-no-fix',
                                        'value'        => set_value('txtEventPlace'),
                                        'autocomplete' => 'off',
                                        'placeholder'  => 'Staple Centre',
                                    );
                                    echo form_input($txtEventPlace);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Place Location', 'place_location', $attributes);
                                ?>

                                <?php
                                    $txtEventLocation = array(
                                        'name'         => 'txtEventLocation',
                                        'class'        => 'form-control form-control-solid placeholder-no-fix',
                                        'value'        => set_value('txtEventLocation'),
                                        'autocomplete' => 'off',
                                        'placeholder'  => 'Huston, Texas',
                                    );
                                    echo form_input($txtEventLocation);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Place Latitude', 'place_latitude', $attributes);
                                ?>

                                <?php
                                    $txtLocationLat = array(
                                        'name'         => 'txtLocationLat',
                                        'class'        => 'form-control form-control-solid placeholder-no-fix',
                                        'value'        => set_value('txtLocationLat'),
                                        'autocomplete' => 'off',
                                        'placeholder'  => '6.99908',
                                    );
                                    echo form_input($txtLocationLat);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
                                    echo form_label('Event Place Longtitude', 'place_longtitude', $attributes);
                                ?>

                                <?php
                                    $txtLocationLong = array(
                                        'name'         => 'txtLocationLong',
                                        'class'        => 'form-control form-control-solid placeholder-no-fix',
                                        'value'        => set_value('txtLocationLong'),
                                        'autocomplete' => 'off',
                                        'placeholder'  => '7.56770',
                                    );
                                    echo form_input($txtLocationLong);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
			                        $attributes = array('class' => 'control-label visible-ie8 visible-ie9',);
			                        echo form_label('Event Place Image', 'image', $attributes);
			                    ?>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <span class="input-group-addon btn default btn-file">
                                        <input type="file" name="image"> </span>
                                    </div>
                                </div>
                                <br>
                                <small>Image size shouldnot be more than 350kb</small>
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
                        </div>
                    </div>
                </div>
                    <!-- END PAGE BASE CONTENT -->
<?php $this->load->view('_blocks/footer')?>
