/**
 * Created by K.halomoan on 22/2/2019.
 */
$("button").click(function(event){

    var form = $('#form1');
    form.submit(function(event){
        event.preventDefault();
    });
});
