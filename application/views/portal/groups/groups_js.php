<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

var form = $('form');
var formOriData = $(form).serialize();
var formtype = null;
var surl = null;
var param = null;

    $(".linkClick").click(function(e){

        e.preventDefault();

        var linkName = $(this).attr('name');
        switch (linkName) {
            case "create":
                $('#dialog_title').html('<?php echo lang('confirmation') ?>');
                $('#dialog_text').html('<?php echo lang('create_confirm') ?>');
                $("#content-wrapper").load(base_url + "/portal/groups/create" ,function() {
                    $.getScript(base_url+"/js/jsloader/groups");
                });
                break;
            case "edit":
                $('#dialog_title').html('<?php echo lang('confirmation') ?>');
                $('#dialog_text').html('<?php echo lang('edit_confirm') ?>');
                param = $(this).attr('param');
                $("#content-wrapper").load(base_url + "/portal/groups/edit/" + param ,function() {
                    $.getScript(base_url+"/js/jsloader/groups");
                });
                break;
            case "delete":
                param = $(this).attr('param');
surl = $(this).attr('action');
                $('#dialog_title').html('<?php echo lang('confirmation') ?>');
                $('#dialog_text').html('<?php echo lang('delete_confirm') ?>');
                formtype = 'form-delete_group';
                $("#modal-info").modal();
                break;
        }
    });

    $("#btnCancel").click(function(e){

        goinit();
    });

    $(form).on('submit',function(e){
        e.preventDefault();
        formtype = $(this).attr('id');
surl =  $(this).attr('action');
    });

    /*$( "#modal-info" ).on('shown.bs.modal', function(){
        modal_open = true;
    });

    $( "#modal-info" ).on('hidden.bs.modal', function(){
        console.log('hidden',modal_open);
        modal_open = false;
    });*/

    $("#dialog_confirm").click(function(e){
        e.preventDefault();
        $('#modal-info').modal('hide');

        switch (formtype) {
        case "form-create_group":
            create_submit();
            break;
        case "form-edit_group":
            edit_submit();
            break;
        case "form-delete_group":
            delete_submit(param);
            break;
        }
    });

    function goinit(){
        $("#content-wrapper").load(base_url+"/portal/groups",function() {
            $.getScript(base_url+"/js/jsloader/groups");
        });
    }

    function create_submit(){
        var form = $('#form-create_group');
        var busy = $('#busy');
        var formData = $(form).serialize();
        var status = validate_form( $(form) , formOriData );
        if( status.valid ) {
            $(busy).show();
            $.post($(form).attr('action'),formData)
                .done(
                    function(response){
                        $(busy).hide();
                        goinit();
                    }
                ).fail(
                function(data){
                    $(busy).hide();
                }
            );
        } else {
            showStatus(status);
        }

    }

    function edit_submit(){
        var form = $('#form-edit_group');
        var formData = $(form).serialize();
        var busy = $('#busy');

        var status = validate_form( $(form) , formOriData );

        if( status.valid ) {
            $.post($(form).attr('action'), formData)
                .done(
                    function (response) {
                        $(busy).hide();
                        goinit();
                    }
                ).fail(
                function (response) {
                    status.valid = false;
                    status.prompt = true;
                    status.msg = response;
                    $(busy).hide();
                }
            );
        }else{
            showStatus(status);
        }
    }

    function delete_submit(id){
        if(id){

            var busy = $('#busy');
            $(busy).show();
            $.ajax({
                type: 'POST',
                url: surl + '/delete',
                data: {'id': id},
                success: function(response){

                    $(busy).hide();
                },
                error : function(response) {
                    status.valid = false;
                    status.prompt = true;
                    status.msg = response;
                    console.log('x',status);
                    $(busy).hide();
                },

                dataType: 'json'

            });
           /* $.post(surl + '/delete', {'id': id})
            .done(
                function (response) {

                    $(busy).hide();
                    goinit();
                }
            ).fail(
                function (response) {
                    status.valid = false;
                    status.prompt = true;
                    status.msg = response;

                    $(busy).hide();
                }
            ); */
        }
    }

    function validate_form(form,formOriData) {
        var arrdata = form.serializeArray();
        var formData = form.serialize();

        var status = { 'valid': true, 'prompt': false, 'msg' : 'success' };

        if (formOriData) {


            if(JSON.stringify(formData) === JSON.stringify(formOriData)) {

                status.valid = false;
                status.prompt = false;
                status.msg = 'Nothing To Save';
                return status;
            }
        }

        $.each(arrdata, function(i, field){
            if (field.value === ""){
                status.valid = false;
                status.msg = 'Mandatory Field';
                $("input[name='" + field.name + "']").closest(".form-group").addClass("has-error");
                $("input[name='" + field.name + "']").next(".help-block").html(status.msg);
                $("input[name='" + field.name + "']").next(".help-block").show();

                return status;
            } else {
                $("input[name='" + field.name + "']").closest(".form-group").removeClass("has-error");
                $("input[name='" + field.name + "']").next(".help-block").hide();
            }
        });

        return status;
    }

    function showStatus(status){

        if (status.prompt){
            $("#dialog_text").html(status.msg);
            $("#dialog_text").show();
        } else{
            $("#msg_text").html(status.msg);
            $("#msg_text").show();
        }
    }

