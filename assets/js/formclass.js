$(document).ready(function() {
    $(document).on("submit", ".ajaxform", function(e) {
		if(typeof(pageckeditor)!='undefined'){
			CKupdate();
		}
        var a = $(this).attr("id");
        if (a) var t = "#" + a;
        else var t = ".ajaxform";
        var o = $(this).attr("action");
        return $(this).ajaxSubmit({
            url: o,
            dataType: "json",
            beforeSend: function() {
                wait(), $("#loginButon").attr("disabled", "disabled")
            },
            success: function(e) {
				waitEnd();
                $(t).find(".ajax_report").removeClass("alert-success").removeClass("alert-danger"), $("#wait-div").hide(), $("#loginButon").removeAttr("disabled"), $(t).find(".ajax_report").fadeIn(600), e.success ? $(t).find(".ajax_report").addClass("alert-success").children(".ajax_message").html(e.success_message) : $(t).find(".ajax_report").addClass("alert-danger").children(".ajax_message").html(e.error_message), e.url && setTimeout(function() {
                    window.location.href = e.url
                }, 1e3), e.parentUrl && setTimeout(function() {
                    window.top.location.href = e.parentUrl
                }, 1e3), e.resetForm && $(t).resetForm(), e.scrollToElement && scrollToElement(e.scrollToElement, 1e3), e.scrollToThisForm && scrollToElement(t, 1e3), e.selfReload && location.reload(), e.popup && parent.$.venobox.frameheight(), e.ajaxtCallBackFunction && ajaxtCallBackFunction(e), setTimeout(function() {
                    $(t).find(".notification").fadeOut(1000)
                }, 3000), "popup-login" == e.message && openLoginPopUp(e.return_url), e.ajaxPageCallBack && (e.formClass = t, ajaxPageCallBack(e)), e.ajaxPageAgencyCallBack && (e.formClass = t, ajaxPageAgencyCallBack(e)), e.capchaRefresh && security_code_refresh(e.capchaWidth, e.capchaHeight), e.disableButton && $("#" + disableButton).removeAttr("disabled"), e.readonly && $("#" + e.readonly).attr("readonly", "readonly"), e.disable && $("#" + e.disable).attr("disabled", "disabled"), e.imageUrl && $(t).find("#imageUrl").attr("src", e.imageUrl)
            },
            error: function(e) {
                showConnectionError()
            }
        }), !1
    })
	$(document).on('click','.close',function(){
		$(this).parent('div').fadeOut(1000);
	});
});

function CKupdate() {
    for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement()
}

function scrollToElement(e, a) {
    $("html, body").animate({
        scrollTop: $(e).position().top - 70
    }, a)
}

function showConnectionError() {
    console.log("server error");
}
function wait() {
    console.log("wait start");
}
function waitEnd() {
    console.log("wait end");
}