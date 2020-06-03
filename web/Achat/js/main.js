/*

[Core Script]

Project: PopForms - Material Design Modal Forms
Version: 1.3
Author : themelooks.com

*/

;(function(b){b(document).ready(function(){var a=b("#loginForm");a.length&&a.validate({rules:{loginUsername:"required",loginPassword:"required"},errorPlacement:function(a,b){return!0}});a=b("#signupForm");a.length&&a.validate({rules:{singupName:"required",singupUsername:"required",singupEmail:{required:!0,email:!0},singupPassword:"required",singupPasswordAgain:{equalTo:"#singupPassword"}},errorPlacement:function(a,b){return!0}});a=b("#forgotForm");a.length&&a.validate({rules:{forgotEmail:{required:!0,
email:!0}},errorPlacement:function(a,b){return!0}});a=b("#subscribeForm");a.length&&a.validate({rules:{subscribeEmail:{required:!0,email:!0}},errorPlacement:function(a,b){return!0}});a=b("#contactForm");a.length&&a.validate({rules:{contactName:"required",contactEmail:{required:!0,email:!0},contactSubject:"required",contactMessage:"required"},errorPlacement:function(a,b){return!0},submitHandler:function(){var a=b(this.currentForm),c=a.serialize(),d=a.attr("action");b.post(d,c,function(b){a.prepend(b);
setTimeout(function(){a.children(".alert").remove()},3200)})}});b("[data-img-src]").each(function(){var a=b(this).data("img-src");b(this).css("background-image","url("+a+")")})})})(jQuery);