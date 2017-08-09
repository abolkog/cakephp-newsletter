$(document).ready(function () {

    var form = $("#campaign-form");

    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            // if (element.attr('id') == 'contents') {
            //     $("#contents-err").after(error);
            // }else {
            //     element.after(error);
            // }
            element.after(error);
        },
        rules: {
            subject: { required: true },
            sender: { required: true },
            contents: { required: true },
            group_id: {
                required: {
                    depends: function () {
                        return $("#group_id").val() == '';
                    }
                }
            }
        },
        messages: {
            subject: "Please provide campaign subject. This will appear as the Email Subject",
            sender: "Please provide campaign from value. This will appear as the Email sender name/email",
            contents: "Contents is a required field",
            group_id: "Please select a mailing list"
        }
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            if (newIndex == 3) {
                showData();
            }
            console.log(form.valid());
            console.log(form.error);
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            console.log('Finishing');
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            $('ul[role="menu"]').html("<button class='btn btn-u' disabled><i class='fa fa-spin fa-spinner'></i></button> ");
            form.submit();
        }
    });

    function showData() {
        $("#selectedTitle").text($("#subject").val());
        $("#selectedFrom").text($("#sender").val());
        $("#selectedList").text($('#group_id').find(":selected").text());
        var templateValue = $('#template_id').find(":selected").text();
        if(templateValue == "Select a template") {
            templateValue = "None";
        }
        $("#selectedTemplate").text(templateValue);

        $("#selectedContents").html($("#contents").val());
    }



});


