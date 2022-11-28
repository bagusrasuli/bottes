
var qid = window.Telegram.WebApp.initDataUnsafe.query_id;
var cid = null;
if (typeof window.Telegram.WebApp.initDataUnsafe.user !== 'undefined') {
    cid = Telegram.WebApp.initDataUnsafe.user.id;
}

// $("#initData").val(window.Telegram.WebApp.initData)
$(".form-control").addClass("form-control-sm");

window.Telegram.WebApp.MainButton.text = "Logout"
window.Telegram.WebApp.MainButton.color = '#CD5C5C';//'#F08080';//'#FF6347' // green
window.Telegram.WebApp.MainButton.isVisible = true

if (window.Telegram.WebApp.initData == '') {
    $("html").css('pointer-events', 'none')
    alert('Bot Not Detected!!');
}

Telegram.WebApp.onEvent('mainButtonClicked', () => {
    // alert()
    // e.preventDefault();
    window.Telegram.WebApp.showConfirm("Yakin logout?", (isOk) => {
        // console.log(isOk)
        if (isOk == true) {
            logout()
        }
    })
})

function bukaUrl() {
    window.Telegram.WebApp.showAlert("Login HRD Syafira")
    setTimeout(() => {
        window.Telegram.WebApp.openLink("https://wa.me/6282236674177")
    }, 500);
    // window.Telegram.WebApp.close()
}

function logout() {
    window.Telegram.WebApp.MainButton.showProgress()
    $("html").css('pointer-events', 'none')
    formURL = 'logout-pengguna?cid=' + cid + '&qid=' + qid;

    // var formData = new FormData($("#form-nya")[0]);
    var formData = new FormData();
    formData.append('initData', window.Telegram.WebApp.initData);
    // window.Telegram.WebApp.initData
    // var formData = {};
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
                window.Telegram.WebApp.showPopup({ title: 'Berhasil Logout', message: result.msg, buttons: [{ 'type': 'default', 'text': 'Tutup' }] })
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
