vex.defaultOptions.className = 'vex-theme-wireframe';
vex.dialog.buttons.YES.text = 'Tamam';
vex.dialog.buttons.NO.text = 'İptal';

$(document).ready(function () {



    $("[data-destroy]").on('click', function (e) {

        e.preventDefault();

        var elm = $(this);

        var url = elm.attr('href');

        vex.dialog.confirm({
            message: '<p><i class="fa fa-warning fa-2x"></i></p><b>Bu kaydı silmek istediğinize emin misiniz?</b><br><small>Devam ettiğiniz taktirde bu kayda bağlı diğer kayıtlar da silinecek!</small>',
            callback: function(value) {
                if(value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: _token
                        },
                        success: function (res) {
                            if (res.error) {
                                vex.dialog.alert(res.message);
                            } else {
                                window.location.reload();
                            }
                        }
                    });
                }
            }
        });



    });

});