<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('groups_edit_group'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $message;?>

                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_group')); ?>
                                        <div class="form-group">
                                            <?php echo lang('groups_name', 'group_name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($group_name);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('groups_description', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($group_description); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('groups_color', 'bgcolor', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-3">
                                                <?php echo form_input($group_bgcolor); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'none', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'),'data-toggle' =>"modal",'data-target'=>"#modal-info")); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_cancel'), 'name' => 'edit_cancel')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                    <div class="modal fade" id="modal-info">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title"><span id="msg_title">Confirmation</span></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><span id="msg_text"><?php echo lang("edit_confirm")?></span></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" name="edit_submit">Save changes</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
                            <div class="overlay" id="busy" style="display:none">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                         </div>
                    </div>
                </section>