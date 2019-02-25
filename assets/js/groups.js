
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
            $("#content-wrapper").load(base_url+"/portal/groups",function() {
                $.getScript(base_url+"/assets/js/groups.js")
            });
            break;
        case "edit_submit":
                alert('yes');
            break;
        case "edit_cancel":
            break;
    }
});

function create_submit(){
    var form = $('#form-create_group');
    var formData = $(form).serialize();

    $.post($(form).attr('action'),formData)
        .done(
            function(response){
                console.log(data);
            }
        ).fail(
            function(data){
                console.log(data);
            }
    );
}
