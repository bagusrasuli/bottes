
var qid = window.Telegram.WebApp.initDataUnsafe.query_id;
var cid = null;
if (typeof window.Telegram.WebApp.initDataUnsafe.user !== 'undefined') {
        cid = Telegram.WebApp.initDataUnsafe.user.id;
}

$("#initData").val(window.Telegram.WebApp.initData)

window.Telegram.WebApp.MainButton.text = "AJUKAN"
window.Telegram.WebApp.MainButton.color = '#28a745' // green
window.Telegram.WebApp.MainButton.isVisible = true

setTimeout(() => {
    window.Telegram.WebApp.enableClosingConfirmation()
}, 9000);

if(window.Telegram.WebApp.initData == ''){
    $("html").css('pointer-events', 'none')
    alert('Bot Not Detected!!');
}
setTimeout(() => {
    // window.Telegram.WebApp.expand() // langsung besar
    // window.Telegram.WebApp.close()
}, 500);

Telegram.WebApp.onEvent('mainButtonClicked', ()=>{
    $("form#form-nya").submit();
})

$(`#form-nya`)
    .on("beforeSubmit", function (e) {
        e.preventDefault();
            window.Telegram.WebApp.showConfirm("Ajukan Surat?", (isOk)=>{
                // console.log(isOk)
                if(isOk == true){
                    kirim()
                }
            })
        var formData = new FormData($("#form-submit-nya")[0]);
    })
    
// $(`#form-nya`).on("submit", function (e) {
//     e.preventDefault();
//     window.Telegram.WebApp.showConfirm("Ajukan Surat?", (isOk)=>{
//         // console.log(isOk)
//         if(isOk == true){
//             kirim()
//         }
//     })
//     // kirim()
//     return false;
// })

function bukaUrl(){
    window.Telegram.WebApp.showAlert("Tight")
    setTimeout(() => {
        window.Telegram.WebApp.openLink("https://wa.me/6282236674177")
    }, 500);   
    // window.Telegram.WebApp.close()
}

function kirim(){
    window.Telegram.WebApp.MainButton.showProgress()
    $("html").css('pointer-events', 'none')
    formURL = 'kirim-surat?cid=' + cid + '&qid=' + qid;
    // formURL = 'kirim-surat-cuti'
    // formData = {
    //     initData: window.Telegram.WebApp.initData
    // };
   
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
            window.Telegram.WebApp.showPopup({title:'Berhasil',message:result.msg,buttons:[{'type':'default', 'text':'Tutup'}]})
            window.Telegram.WebApp.close()
        }else{
            window.Telegram.WebApp.MainButton.hideProgress()
            window.Telegram.WebApp.showPopup({title:'Warning',message:result.msg,buttons:[{'type':'default', 'text':'Tutup'}]})
        }
    },
    error: function (xhr, status, error) {
        window.Telegram.WebApp.showPopup({title:'Error',message:error,buttons:[{'type':'default', 'text':'Oke'}]})
    },
    complete: function(ini){
        window.Telegram.WebApp.MainButton.hideProgress()
        $("html").css('pointer-events', 'auto')
    }
    });
}

// function toSubmit() {

// }

//  Telegram.WebApp.onEvent('mainButtonClicked', ()=>{

//     //  window.Telegram.WebApp.MainButton.isVisible = false
//     // alert("anak anj")
//     //  window.Telegram.WebApp.MainButton.isVisible = true
    
//     // window.Telegram.WebApp.showPopup({title:'judull',message:'pesannya',buttons:[{'type':'close'}]})
//     var pesannya = '';
//     pesannya += window.Telegram.WebApp.initDataUnsafe.user.id
//     pesannya += '-' + window.Telegram.WebApp.initDataUnsafe.user.first_name
//     pesannya += '-' + window.Telegram.WebApp.platform // PLATFORM GET
//     // window.Telegram.WebApp.close()
    
//     // window.Telegram.WebApp.MainButton.disable()
//     window.Telegram.WebApp.MainButton.showProgress()
//     // window.Telegram.WebApp.MainButton.color = '#ffc925'
//     setTimeout(() => {
//         window.Telegram.WebApp.MainButton.hideProgress()
//         window.Telegram.WebApp.showPopup({title:'judull',message:pesannya,buttons:[{'type':'close'}]})
//     }, 3000);

//     window.Telegram.WebApp.showConfirm("asdasd asd", (hasil)=>{
//         console.log(hasil)
//     })
// })