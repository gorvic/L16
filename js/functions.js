( function($) {


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

//cashed variables
//# = native browser method getElementById(), that's fastest.
//$(tag) = getElementsByTagName().

//info
var $container = $('#container');
var $containerButton = $container.children('button.btn-sm'); //prefix class by tag
var $containerInfo = $('#container_info');

//form fields and buttons
var $submitButton = $('#submit_button');
var $form = $('#ads_form');
var $formFields = $form.find('input:text, input:password, input:file, #email, select, textarea');
var $formRadiosAndCheckboxes = $form.find('input:radio, input:checkbox');

var $organizationFormId = $form.find('[name="organization_form_id"]');


var $organizationFormIdByValue = [
    $form.find('[name="organization_form_id"][value = "0"]'),
    $form.find('[name="organization_form_id"][value = "1"]')

]

var $table = $('#ads_table');


function info(response) {

    if (response.status == 'success') {
        $container.removeClass('alert-danger').addClass('alert-info');
        $containerButton.removeClass('btn-danger').addClass('btn-info')
        $containerInfo.html(response.message);
        $container.fadeIn('slow');
    } else if (response.status == 'error') {
        $container.removeClass('alert-info').addClass('alert-danger');
        $containerButton.removeClass('btn-info').addClass('btn-danger')
        $containerInfo.html(response.message);
        $container.fadeIn('slow');
    }

    ( function() {
        setTimeout(function() {
            $container.fadeOut("slow")
        }, 2000);
    } )();
}

function resetForm() {
    $formFields.val('');
    $formRadiosAndCheckboxes
        .removeAttr('checked').removeAttr('selected');

    $('#location_id')[0].selectedIndex = 0;
    $('#category_id')[0].selectedIndex = 0;
    $organizationFormId[0].checked = true;
    $submitButton.html('Добавить');

    if ($hiddenField.length) {
        $hiddenField.remove();
    }
}

//event delegation
$('tbody').on('click', 'a.btn.btn-danger', function() {

    var isEditMode = $('#hiddenField').length ? true : false;
    if (isEditMode) {
        $containerInfo.html('First finish updating your current ad');
        $container.fadeIn('slow');
        return false;
    }

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
                $('#allow_mails')[0].checked = (value == 1) ? true : false;
                return true;
            } else if (name == 'organization_form_id') {
                $organizationFormIdByValue[value][0].checked = true;
                return true;
            } else if (name == 'id') {
                $('#hiddenField').remove();
                //$hiddenField = 
                $('<input>',
                    {
                        type: 'hidden',
                        id: 'hiddenField',
                        name: 'id',
                        value: value
                    }
                ).appendTo('.btn-group.btn-group-md');
                $submitButton.html('Записать изменения');
                return true;
            }
            $('#' + name).val(value);

        }); // end of each()
    });
});

$form.submit(function(event) {


    // event.preventDefault();
    // event.stopPropagation();
    // event.stopImmediatePropagation();

    var url = 'index.php';
    var $hiddenField = $('#hiddenField')
    var isEditMode = $hiddenField.length ? true : false;

    $.post(url,
        $(this).serialize(), function(response, textStatus, xhr) {
            info(response);
            if (response.status == 'success') { //fill table
                //if isEditMode get tr element in table for updating
                if (isEditMode) {
                    tr = ('tr[id=' + $hiddenField.val() + ']');

                    //delete hidden field, if exists
                    $('#hiddenField').remove();

                    //update td in tr
                    $table.find(tr + ' td:eq(0)').html($('#title').val());
                    $table.find(tr + 'td:eq(2)').html($('#seller_name').val());
                    $table.find(tr + 'td:eq(3)').html($('#price').val());
                } else {
                    //append new tr
                    $table.find('tr').last().after(getTrBlock(response.data.id));
                    tr = ('tr[id=' + response.data.id + ']');
                }

                //organization has 'warning' class
                if ($organizationFormId.filter('input:checked').val() == '0') {
                    $(tr).removeClass('warning');
                } else {
                    $(tr).addClass('warning');
                }

                resetForm();

            }
        },
        'json');
    return false; //stop event propagating and preventDefault

});
$('#cancel_button').on('click', function() {

    resetForm();


});
} )(jQuery);