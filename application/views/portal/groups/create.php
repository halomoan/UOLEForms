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
                                    <h3 class="box-title"><?php echo lang('groups_create'); ?></h3>
                                </div>
                                <div class="box-body">

                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_group')); ?>
                                        <div class="form-group">
                                            <?php echo lang('groups_name', 'group_name', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($group_name);?>
                                                <small class="form-text text-muted">Must be unique and don't leave a space</small>
                                                <span class="help-block" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('groups_description', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($description);?>
                                                <span class="help-block" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('', 'text', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <p class="text-red" id="msg_text" style="display:none"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'none', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'),'data-toggle' =>"modal",'data-target'=>"#modal-confirm")); ?>
                                                    <?php echo form_button(array('type' => 'none', 'class' => 'btn btn-default btn-flat', 'content' => lang('actions_cancel'), 'name' => 'create_cancel', 'id' => 'btnCancel') ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>

                                 <div class="overlay" id="busy" style="display:none">
                                     <i class="fa fa-refresh fa-spin"></i>
                                 </div>
                            </div>
                         </div>
                    </div>
                </section>
