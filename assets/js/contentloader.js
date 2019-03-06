var base_url = '/UOLEForms';

$(".sidemenu").click(function(e){

    e.preventDefault();
    var linkName = $(this).attr('name');
    switch (linkName) {
        case "dashboard":
            $("#content-wrapper").load(base_url+"/portal/dashboard",function() {
                $.getScript(base_url+"/assets/js/dashboard.js")
            });
            break;
        case "forms":
            $("#content-wrapper").load(base_url+"/portal/forms",function() {
                $.getScript(base_url+"/assets/js/forms.js")
            });
            break;
        case "users":
            $("#content-wrapper").load(base_url+"/portal/users",function() {
                $.getScript(base_url+"/assets/js/users.js")
            });
            break;
        case "groups":
            $("#content-wrapper").load(base_url+"/portal/groups",function() {
                $.getScript(base_url+"/assets/js/groups.js");
            });
            break;
        case "prefs_admin":
            $("#content-wrapper").load(base_url+"/portal/prefs/interfaces/admin",function() {
                $.getScript(base_url+"/assets/js/prefs_admin.js")
            });
            break;
        case "prefs_public":
            alert('no');
            $("#content-wrapper").load(base_url+"/portal/prefs/interfaces/public",function() {
                $.getScript(base_url+"/assets/js/prefs_public.js")
            });
            break;
    }
});