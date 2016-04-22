$(document).ready(function () {
    var $error = $('#error');
    var $loading = $('#loading');
    var $content_ = $('.content');

    var $btn_del = $('.btn-del');
    var $btn_payment = $('.btn-payment');
    $loading.hide();
    $content_.fadeIn(500);

    $('.parallax').parallax();

    if ($error.length) {
        if ($error.val() == 'max') {
            sweetAlert("ข้อผิดพลาด", "ไม่สามารถลงทะเบียนได้ จำนวนคนลงทะเบียนครบแล้ว", "error");
        }
    }

    $('#max_user_alert').click(function () {
        sweetAlert("ไม่สามารถลงทะเบียนได้", "จำนวนคนลงทะเบียนครบแล้ว", "error");
    });

    $btn_del.click(function () {
        deleteEnroll($btn_del.attr('course_id'));
    });

    $btn_payment.click(function () {
        payment($btn_payment.attr('course_id'));
    });

    window.onbeforeunload = function (e) {
        $loading.show();
        $content_.hide();
    };

});
var payment = function ($id) {

};

var deleteEnroll = function ($id) {
    swal({
        title: "คุณต้องการยกเลิก",
        text: "คุณต้องการยกเลิกคอร์สนี้หรือไม่",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ใช่",
        closeOnConfirm: false
    }, function () {
        $.post(SITE_URL + 'enroll/' + $id + '/delete', {_token: TOKEN}, function (data, status) {
            if (status === 'success') {
                if (data === 'ok') {
                    // Delete success
                    swal({
                        title: "ยกเลิกลงทะเบียน!",
                        text: "ยกเลิกการลงทะเบียนเรียบร้อยแล้ว",
                        type: 'success'
                    }, function () {
                        location.reload();
                    });
                }
            }
        });
    });
};