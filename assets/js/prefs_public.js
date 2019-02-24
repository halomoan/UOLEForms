$(".linkClick").click(function(e){

    e.preventDefault();
    var linkName = $(this).attr('name');
    switch (linkName) {
        case "prefs_admin":
            $("#content-wrapper").load(base_url+"/portal/prefs/interfaces/admin",function() {
                $.getScript(base_url+"/assets/js/prefs_admin.js")
            });
            break;
    }
});