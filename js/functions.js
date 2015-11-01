( function() {
var h = $("#panel1").height();
$("#panel2").height(h);
} )();

function getTrBlock(id) {

    return '<tr id="' + id + '">'
        + '<td>' + $('#title').val() + '</td>'
        + '<td><a class="btn btn-success btn-xs glyphicon glyphicon-search" title="Показать объявление"></a></td>'
        + '<td>' + $('#seller_name').val() + '</td>'
        + '<td>' + $('#price').val() + '</td>'
        + '<td><a class="btn btn-danger btn-xs glyphicon glyphicon-remove" title="Удалить объявление"></a></td>'
        + ' </tr>';

}

function info(response) {
    if (response.status == 'success') {
        $('#container').removeClass('alert-danger').addClass('alert-info');
        $('#container>.btn-sm').removeClass('btn-danger').addClass('btn-info')
        $('#container_info').html(response.message);
        $('#container').fadeIn('slow');
    } else if (response.status == 'error') {
        $('#container').removeClass('alert-info').addClass('alert-danger');
        $('#container>.btn-sm').removeClass('btn-info').addClass('btn-danger')
        $('#container_info').html(response.message);
        $('#container').fadeIn('slow');
    }

    ( function() {
        setTimeout(function() {
            $('#container').fadeOut("slow")
        }, 2000);
    } )();
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, #email, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');

    $form.find("#location_id")[0].selectedIndex = 0;
    $form.find("#category_id")[0].selectedIndex = 0;
    $form.find('[name="organization_form_id"]')[0].checked = true;
}

//event delegation
$('tbody').on('click', 'a.btn.btn-danger', function() {

    var $row = $(this).closest('tr');
    var id = $row[0].getAttribute('id');

    var url = 'index.php';
    var data = {
        'id': id,
        'mode': 'delete'
    };


    $.getJSON(url, data, function(response) {

        $row.fadeOut('slow', info(response)).remove();

    });
}).on('click', 'a.btn.btn-success', function() { //Edit form

    var $row = $(this).closest('tr');
    var id = $row[0].getAttribute('id');

    var url = 'index.php';
    var data = {
        'id': id,
        'mode': 'show'
    }

    $.getJSON(url, data, function(response) {


        $.each(response.data, function(name, value) {

            if (name == 'allow_mails') {
                $('#' + name)[0].checked = (value == 1) ? true : false;
            } else if (name == 'organization_form_id') {
                $('[name="' + name + '"][value="' + value + '"]', '#ad_form')[0].checked = true;
            } else if (name == 'id') {
                $('#hiddenField').remove();
                $('<input>',
                    {
                        type: 'hidden',
                        id: 'hiddenField',
                        name: 'id',
                        value: value
                    }
                ).appendTo('.btn-group.btn-group-md');
                $('#submit_button').html('Записать изменения');
                return true;
            }
            $('#' + name).val(value);

        }); // end of each()
    });
});

$('#ad_form').submit(function(event) {


    // event.preventDefault();
    // event.stopPropagation();
    // event.stopImmediatePropagation();

    var url = 'index.php'
    var isEditMode = $('#hiddenField').length ? true : false;

    $.post(url,
        $(this).serialize(), function(response, textStatus, xhr) {
            info(response);
            if (response.message = 'success') { //fill table
                //if isEditMode get tr element in table for updating
                if (isEditMode) {
                    $hiddenField = $('#hiddenField');
                    tr = ('tr[id=' + $hiddenField.val() + ']');

                    //delete hidden field, if exists
                    $('#hiddenField').remove();

                    //update td in tr
                    $("td:eq(0)", tr).html($('#title').val());
                    $("td:eq(2)", tr).html($('#seller_name').val());
                    $("td:eq(3)", tr).html($('#price').val());
                } else {
                    //append new tr
                    $('tbody tr:last').after(getTrBlock(response.data.id));
                    tr = ('tr[id=' + response.data.id + ']');
                }

                //organization has 'warning' class
                if ($('[name ="organization_form_id"]:checked ', '#ad_form').val() == '0') {
                    $(tr).removeClass('warning');
                } else {
                    $(tr).addClass('warning');
                }
                $('#submit_button').html('Добавить');
                resetForm($('#ad_form'));
            }
        },
        'json');
    return false; //stop event propagating and preventDefault

});
$('#cancel_button').on('click', function() {
    $('#submit_button').html('Добавить');
    resetForm($('#ad_form'));

});
