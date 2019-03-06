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
                                    <h3 class="box-title"><a href="#" class="linkClick btn btn-block btn-primary btn-flat" name="create"><?php echo lang('groups_create')?></a></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('groups_name');?></th>
                                                <th><?php echo lang('groups_description');?></th>
                                                <th><?php echo lang('groups_color');?></th>
                                                <th><?php echo lang('groups_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($groups as $values):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($values->description, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><i class="fa fa-stop" style="color:<?php echo $values->bgcolor; ?>"></i></td>
                                                <td><a href="#" class="linkClick" name="edit" param="<?php echo $values->id; ?>"><?php echo lang('actions_edit')?>&nbsp;|&nbsp;
                                                    <a href="#" class="linkClick" name="delete" param="<?php echo $values->id; ?>" action="<?php echo current_url()?>"><?php echo lang('actions_delete')?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>

                                </div>
                                 <div class="overlay" id="busy" style="display:none">
                                     <i class="fa fa-refresh fa-spin"></i>
                                 </div>
                            </div>
                         </div>
                    </div>
                </section>