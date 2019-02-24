$(".linkClick").click(function(e){

    e.preventDefault();
    var linkName = $(this).attr('name');
    switch (linkName) {
        case "prefs_public":
            $("#content-wrapper").load(base_url+"/portal/prefs/interfaces/public",function() {
                $.getScript(base_url+"/assets/js/prefs_public.js")
            });
            break;
    }
});