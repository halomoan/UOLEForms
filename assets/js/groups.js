/* init function */
$(function () {
    var form = $('form');
    var formOriData = $(form).serialize();

    $(".linkClick").click(function(e){
        e.preventDefault();
        var linkName = $(this).attr('name');
        switch (linkName) {
            case "create":
                $("#content-wrapper").load(base_url + "/portal/groups/create" ,function() {
                    $.getScript(base_url+"/assets/js/groups.js")
                });
                break;
            case "edit":
                var param = $(this).attr('param');
                $("#content-wrapper").load(base_url + "/portal/groups/edit/" + param ,function() {
                    $.getScript(base_url+"/assets/js/groups.js")
                });
                break;

        }
    });

    $("button").click(function(e){
        e.preventDefault();
        var linkName = $(this).attr('name');
        switch (linkName) {
            case "create_submit":
                create_submit();
                break;
            case "create_cancel":
                goinit();
                break;
            case "edit_submit":
                edit_submit();
                break;
            case "edit_cancel":
                goinit();
                break;
        }
    });

    function goinit(){
        $("#content-wrapper").load(base_url+"/portal/groups",function() {
            $.getScript(base_url+"/assets/js/groups.js")
        });
    }

    function create_submit(){
        var form = $('#form-create_group');
        var formData = $(form).serialize();
        var status = validate_form( $(form) , formOriData );
        if( status.valid ) {
            $.post($(form).attr('action'),formData)
                .done(
                    function(response){
                        goinit();
                    }
                ).fail(
                function(data){
                    console.log(data);
                }
            );
        } else {
            if (status.prompt) {
                alert(status.msg);
            }
        }

    }

    function edit_submit(){
        var form = $('#form-edit_group');
        var formData = $(form).serialize();


        if(JSON.stringify(formData) != JSON.stringify(formOriData)) {
            $.post($(form).attr('action'), formData)
                .done(
                    function (response) {
                        goinit();
                    }
                ).fail(
                function (data) {
                    console.log(data);
                }
            );
        }else{
            alert('nothing is changed');
            console.log(JSON.stringify(formData) , JSON.stringify(formOriData))
        }
    }

    function validate_form(form, oriData) {
        var arrdata = form.serializeArray();
        var formData = form.serialize();

        var status = { 'valid': true, 'prompt': false, 'msg' : 'success' };

        if (oriData) {
            if(JSON.stringify(formData) === JSON.stringify(formOriData)) {
                status.valid = false;
                status.prompt = true;
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

});


