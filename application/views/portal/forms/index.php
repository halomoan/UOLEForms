<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('form1_title'); ?></h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->

                                <form id="form1">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="reporter"><?php echo lang('form1_reporter'); ?></label>
                                            <input type="text" class="form-control" name="reporter" id="reporter" placeholder="Enter Name" value="<?php echo $form1['reporter']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"><?php echo lang('form1_email'); ?></label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo $form1['email']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile">

                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                </section>
