$(function(){

    var getDiary = function(target_month)
    {
        var target_month = target_month || $('#js_select_month').val();
        $('#js_select_month').val(target_month);
        
        $.ajax({
            type : 'post',
            url  : '/get_diary/',
            data : {
                target_month : target_month
            }
        }).done(function(data){
            var json = $.parseJSON(data);
            var tpl_source = $("#diary_template").html();
            var h = Mustache.to_html(tpl_source, json);
            $('#diary_space').html(h);

        });
    };

    var getEditDiary = function()
    {
        $.ajax({
            type : 'post',
            url  : '/getDayDiary/',
            data : {
                edit_date : $('#inputSelectDate').val()
            }
        }).done(function(data){
            var json = $.parseJSON(data);
            if ( false !== json )
            {
                $('#inputFact').val(json.fact);
                $('#inputDiscover').val(json.discover);
                $('#inputLesson').val(json.lesson);
                $('#inputDeclaration').val(json.declaration);
            }
        });
    };

    $(document).on('click', '.js_write', function(){
        $('#js_diary_form').toggleClass('hide');
    });

    // Write Data
    $(document).on('submit', '#js_diary_form', function(){

        $.ajax({
            type : 'post',
            url  : '/write/',
            data : $('#js_diary_form').serialize() 
        }).done(function(){
            getDiary($('#inputSelectDate').val().substr(0, 7));
        });

        return false;
    });

    $(document).on('change', '#inputSelectDate', function() {
        getEditDiary();
    });
    $(document).on('click', '#js_select_button', function(){
        getDiary();
    });

    getDiary();
    getEditDiary();
});
