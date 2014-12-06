$(function(){

    var getDiary = function()
    {
        $.ajax({
            type : 'post',
            url  : '/get_diary/',
            data : {
                target_date : $('#js_select_month').val()
            }
        }).done(function(data){
            var json = $.parseJSON(data);
            console.log(json);

            var tpl_source = $("#diary_template").html();
            var h = Mustache.to_html(tpl_source, json);
            $('#diary_space').html(h);
        });
    }

    $(document).on('click', '.js_write', function(){
        $('#js_diary_form').toggleClass('hide');
    });

    $(document).on('click', '#js_select_button', function(){
        getDiary();
    });

    getDiary();
});
