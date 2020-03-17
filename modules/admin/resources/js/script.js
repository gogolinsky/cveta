$(function() {
    //Транслитерация
    $('.transIt').liTranslit({
        elAlias: $('.transTo'),
        reg: '" "="-","«"="","»"=""'
    });
    $('.transItName').liTranslit({
        elAlias: $('.transToAlias'),
        reg: '" "="_","«"="","»"="","-"="_"'
    });

    $(document).on('hidden.bs.modal', '#modal, #modal-lg', function (e) {
        $(this).removeData('bs.modal').find('.modal-content').empty();
    });

    let $body = $('body');

    $body.on('click', '.pjax-action', function(e){
        e.preventDefault();
        e.stopPropagation();

        let $this = $(this);
        let pjaxId = $this.data('pjax-container') || 'pjax-widget';

        if(!$this.data('confirm') || confirm($this.data('confirm'))) {
            $.post($this.attr('href'), function(){
                $.pjax.reload('#' + pjaxId);
            });
        }
    });

    // $body.on('click', 'a[data-pjax-link]', function(e) {
    //     e.preventDefault();
    //     e.stopPropagation();
    //
    //     let $this = $(this);
    //     let pjaxId = $this.data('pjax-link') || 'pjax-widget';
    //
    //     $.pjax.reload({
    //         container: '#' + pjaxId,
    //         url        : this.href,
    //         push       : true,
    //         replace    : false,
    //         timeout    : 1000,
    //     });
    // });

    $body.on('submit', '#js-modal-form', function(e) {
        e.preventDefault();
        let $form = $(this);
        let pjaxId = $form.data('pjax-id') || 'pjax-widget';

        if ($form.find('.has-error').length) {
            return false;
        }

        $.ajax({
            url         : $form.attr('action'),
            type        : 'POST',
            data        : new FormData(this),
            cache       : false,
            processData : false,
            contentType : false
        }).done(function(result) {
            if (result.message === 'success') {
                $form.closest('.modal').modal('hide');
                $.pjax.reload('#' + pjaxId);
            } else {
                $form.trigger('reset');
            }
        }).fail(function() {
            console.log('server error');
        });

        return false;
    });

    // confirm при удалении картинки
    $(document).on("filepredelete", function(jqXHR) {
        return !confirm("Подтвердите удаление файла."); //is_abort
    });

});