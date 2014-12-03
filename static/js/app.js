$(function(){

    $(document).on('click', '.js_write', function(){
        $('#js_diary_form').toggleClass('hide');
    });

    $(document).on('click', '#js_select_button', function(){
        if ( '' != $('#js_select_month').val() ) {
            $.ajax({
                type : 'post',
                url  : '/get_diary/',
                data : { target_date : $('#js_select_month').val() }
            }).done(function(data){
                console.log(data);

            });
        }
    });

});
