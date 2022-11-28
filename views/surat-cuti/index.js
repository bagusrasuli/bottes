
var qid = window.Telegram.WebApp.initDataUnsafe.query_id;
var cid = null;
if (typeof window.Telegram.WebApp.initDataUnsafe.user !== 'undefined') {
    cid = Telegram.WebApp.initDataUnsafe.user.id;
}

$("#initData").val(window.Telegram.WebApp.initData)

window.Telegram.WebApp.MainButton.text = "KIRIM"
window.Telegram.WebApp.MainButton.color = '#28a745' // green
window.Telegram.WebApp.MainButton.isVisible = true

if (window.Telegram.WebApp.initData == '') {
    $("html").css('pointer-events', 'none')
    alert('Bot Not Detected!!');
}

Telegram.WebApp.onEvent('mainButtonClicked', () => {
    $("form#form-nya").submit();
})

$(`#form-nya`)
    .on("beforeSubmit", function (e) {
        e.preventDefault();
        kirim()
    })

function bukaUrl() {
    window.Telegram.WebApp.showAlert("Tight")
    setTimeout(() => {
        window.Telegram.WebApp.openLink("https://wa.me/6282236674177")
    }, 500);
    // window.Telegram.WebApp.close()
}

function kirim() {
    window.Telegram.WebApp.MainButton.showProgress()
    $("html").css('pointer-events', 'none')
    formURL = 'login?cid=' + cid + '&qid=' + qid;

    var formData = new FormData($("#form-nya")[0]);
    $.ajax({
        url: formURL,
        type: "post",
        // dataType: "json",
        // data: $(this).serialize(),
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (result) {
            if (result.con) {
                window.Telegram.WebApp.MainButton.hideProgress()
                window.Telegram.WebApp.showPopup({ title: 'Berhasil Login', message: result.msg, buttons: [{ 'type': 'default', 'text': 'Tutup' }] })
                window.Telegram.WebApp.close()
            } else {
                window.Telegram.WebApp.MainButton.hideProgress()
                window.Telegram.WebApp.showPopup({ title: 'Warning', message: result.msg, buttons: [{ 'type': 'default', 'text': 'Tutup' }] })
            }
        },
        error: function (xhr, status, error) {
            window.Telegram.WebApp.showPopup({ title: 'Error', message: error, buttons: [{ 'type': 'default', 'text': 'Oke' }] })
        },
        complete: function (ini) {
            window.Telegram.WebApp.MainButton.hideProgress()
            $("html").css('pointer-events', 'auto')
        }
    });
}
