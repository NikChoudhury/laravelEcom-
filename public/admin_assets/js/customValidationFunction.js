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
