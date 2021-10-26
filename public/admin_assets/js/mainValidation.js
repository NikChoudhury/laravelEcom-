/***
 * Additional Validation Function For jquery,validate
 * ****/
$(function () {
    $.validator.addMethod(
        "noSpace",
        function (value, element) {
            return value == "" || value.trim().length != 0;
        },
        "Spaces are not allowed !"
    );
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );
});
/***
 * --------------------------------- *
 * ****/

/**
 * Validation Function For Various Form
 * **/

$(function () {
    //  All admin Side Form Start
    /* START Category Manage Form */
    $("form[name='category_manage_form']").validate({
        rules: {
            category_name: {
                required: true,
                minlength: 2,
                noSpace: true,
            },
            category_slug: {
                required: true,
                minlength: 2,
                noSpace: true,
            },
            category_status: {
                required: true,
            },
        },
        messages: {
            category_name: {
                required: "Please Insert Category Name !!",
                minlength: "Atleast 2 character required !!",
            },
            category_slug: {
                required: "Please Insert Category Slug !!",
                minlength: "Atleast 2 character required !!",
            },
            category_status: "Please Select Category Status !!!",
        },
    });
    /* END Category Manage Form */

    /* START Coupon Manage Form */
    $("form[name='coupon_manage_form']").validate({
        rules: {
            title: {
                required: true,
                minlength: 2,
                noSpace: true,
            },
            code: {
                required: true,
                minlength: 2,
                noSpace: true,
            },
            value: {
                required: true,
                noSpace: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please Insert Coupon Title !!",
                minlength: "Atleast 2 character required !!",
            },
            code: {
                required: "Please Insert Coupon Code !!",
                minlength: "Atleast 2 character required !!",
            },
            value: {
                required: "Please Insert Coupon Value !!",
            },
            status: "Please Select Status !!!",
        },
    });
    /* END Coupon Manage Form */

    /* START Size Manage Form */
    $("form[name='size_manage_form']").validate({
        rules: {
            size: {
                required: true,
                minlength: 1,
                noSpace: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            size: {
                required: "Please Insert Size !!",
                minlength: "Atleast 1 character required !!",
            },

            status: "Please Select Category Status !!!",
        },
    });
    /* END Size Manage Form */

    /* START Color Manage Form */
    $("form[name='color_manage_form']").validate({
        rules: {
            color_code: {
                required: true,
                regex: /^#[0-9a-fA-F]{8}$|#[0-9a-fA-F]{6}$|#[0-9a-fA-F]{4}$|#[0-9a-fA-F]{3}$/,
            },
            color_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
                noSpace: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            color_code: {
                required: "Please Insert Color Code !!",
                regex: "Color Code Should Be A hex Value !!",
            },
            color_name: {
                required: "Please Insert Color Name !!",
                minlength: "Atleast 2 character required !!",
                maxlength: "Max Length is 30 characters !!",
            },

            status: "Please Select Category Status !!!",
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "color_code") {
                error.appendTo(element.parents(".color-code-div"));
            } else if (element.attr("name") == "color_name") {
                error.appendTo(element.parents(".color-name-div"));
            } else {
                error.insertAfter(element);
            }
        },
    });
    /* END Color Manage Form */

    /* START Brand Manage Form */
    $("form[name='brand_manage_form']").validate({
        rules: {
            brand_name: {
                required: true,
                minlength: 1,
                noSpace: true,
            },
            brand_logo: {
                extension: "png|jpe?g|gif",
            },
            brand_website: "noSpace",
            brand_description: "noSpace",
            status: {
                required: true,
            },
        },
        messages: {
            brand_name: {
                required: "Please Insert Brand Name !!",
                minlength: "Atleast 1 character required !!",
            },
            status: "Please Select Status !!!",
        },
    });
    /* END Brand Manage Form */

    //  All admin Side Form END
});
