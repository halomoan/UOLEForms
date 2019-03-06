var form = $('form');
var formOriData = $(form).serialize();
var formtype = null;
var surl = null;
var param = null;
var iCall = 0 ;




$(".linkClick").click(function(e){

    e.preventDefault();

    var linkName = $(this).attr('name');
    switch (linkName) {
        case "create":
            //$('#confirm_title').html('<?php echo lang('confirmation') ?>');
            //$('#confirm_text').html('<?php echo lang('create_confirm') ?>');
            $('#confirm_title').html('Confirmation');
            $('#confirm_text').html('Are You Sure to Create?');
            $("#content-wrapper").load(base_url + "/portal/groups/create" ,function() {
                //$.getScript(base_url+"/js/jsloader/groups");
                $.getScript(base_url+"/assets/js/groups.js");
            });
            break;
        case "edit":
            //$('#confirm_title').html('<?php echo lang('confirmation') ?>');
            //$('#confirm_text').html('<?php echo lang('edit_confirm') ?>');
            $('#confirm_title').html('Confirmation');
            $('#confirm_text').html('Are You Sure to Edit?');
            param = $(this).attr('param');
            $("#content-wrapper").load(base_url + "/portal/groups/edit/" + param ,function() {
                //$.getScript(base_url+"/js/jsloader/groups");
                $.getScript(base_url+"/assets/js/groups.js");
            });
            break;
        case "delete":
            //$('#confirm_title').html('<?php echo lang('confirmation') ?>');
            //$('#confirm_text').html('<?php echo lang('delete_confirm') ?>');
            $('#confirm_title').html('Confirmation');
            $('#confirm_text').html('Are You Sure to Delete?');
            param = $(this).attr('param');
            surl = $(this).attr('action');
            formtype = 'form-delete_group';
            $("#modal-confirm").modal();
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

$( "#modal-confirm" ).on('shown.bs.modal', function(){
    iCall = 0;
 });

 /*$( "#modal-confirm" ).on('hidden.bs.modal', function(){
 console.log('hidden',modal_open);
 modal_open = false;
 });*/

$("#btn-confirm").click(function(e){
    e.preventDefault();
    $('#modal-confirm').modal('hide');

    /* Bug to avoid repeating calling */
    if (iCall++ > 0) return;
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

$("#group_bgcolor").colorpicker();

function goinit(){
    $("#content-wrapper").load(base_url+"/portal/groups",function() {
        //$.getScript(base_url+"/js/jsloader/groups");
        $.getScript(base_url+"/assets/js/groups.js");
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
        $(busy).show();
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
         });

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
            success: function(resp){
                if (resp.status) {
                    goinit();
                } else {
                    show_dialog('Error',resp.msg);
                }
                $(busy).hide();
            },
            error : function(response) {
               console.log(response);
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

function show_dialog(title,msg) {
    $('#dialog_title').html(title);
    $('#dialog_text').html(msg);
    $('#modal-dialog').modal('show');
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
        $("#confirm_text").html(status.msg);
        $("#confirm_text").show();
    } else{
        $("#msg_text").html(status.msg);
        $("#msg_text").show();
    }
}

