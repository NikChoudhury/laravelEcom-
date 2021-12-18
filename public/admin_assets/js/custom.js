/* Open Url in same Window */
function openUrl(url) {
    window.open(url, "_self");
}

/**
 * Add More attribute on manage Product page
 */
// let loopCount = 0;
function addMoreAttribute() {
    loopCount++;
    let sizeCol = jQuery("#sizeCol").html();
    sizeCol = sizeCol.replace("selected", "");
    let colorCol = jQuery("#colorCol").html();
    colorCol = colorCol.replace("selected", "");
    let attrImageCol = jQuery("#attrImageCol").html();
    let html =
        '<div id="productAttrCard_' + loopCount + '" class="card border-dark productAttrCard" ><div class="card-body"><div class="row">';
    html += '<div class="col-md-8"><div class="row">';
    html += '<input type="hidden" name="product_attr_id[]" value="">';

    html +=
        '<div class="col col-md-6 col-12 form-group"><label for="sku_' + loopCount + '" class="control-label mb-1">SKU*</label><input id="sku_' + loopCount + '" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';
    html +=
        '<div class="col col-md-6 col-12 form-group"><label for="mrp_' + loopCount + '" class="control-label mb-1">MRP*</label><input id="mrp_' + loopCount + '" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';

    html +=
        ' <div class="col col-md-6 col-12 form-group"><label for="price_' + loopCount + '" class="control-label mb-1">Price*</label><input id="price_' + loopCount + '" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';
    html +=
        ' <div class="col col-md-6 col-12 form-group"><label for="qty_' + loopCount + '" class="control-label mb-1">Quantity*</label><input id="qty_' + loopCount + '" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';
    html += '<div class="col col-md-6 col-12 form-group">' + sizeCol + "</div>";
    html +=
        '<div class="col col-md-6 col-12 form-group">' + colorCol + "</div>";
    html += '</div></div>';
    html += '<div class="col col-md-4 col-12"><div class="image-box-card"><div class="image-card-header card-image">';
    html += '<img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview' + loopCount + '" class="img-preview ripple_animate" style="height:250px;" ></div>';
    html += '<div class="image-card-footer"><label for="attr_image_' + loopCount + '" class=""><i class="far fa-image"></i> Choose image</label><input type="file" name="attr_image[]" id="attr_image_' + loopCount + '" class="image-box-input" aria-required="true" aria-invalid="false"></div>'
    html += '</div></div>';
    html +=
        '<div class="col-md-4 col-sm-4 form-group"><button class="btn btn-warning form-control" type="button" onclick="removeAttributeBtn(' + loopCount + ')">Remove</button></div>';
    html += "</div></div></div></div>";
    jQuery("#productAttributeBox").append(html);
}

/**
 * Remove attribute Box
 */
function removeAttributeBtn(loopCount) {
    $("#productAttrCard_" + loopCount).fadeTo(1000, 0.01, function () {
        $(this).slideUp(250, function () {
            $(this).remove();
        });
    });
}

/**
 * Add More Image on manage Product page
 */

function addMoreImage() {
    loopCountForImg++;
    let html = '<div class="image-box-card" id="imageCardBox_' + loopCountForImg + '">';
    html += '<input type="hidden" name="product_images_id[]" value="">';
    html += '<div class="image-card-header card-image" >';
    html += '<img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview_m_' + loopCountForImg + '" class="img-preview ripple_animate" >';
    html += '<button class="remove-image-btn" type="button" style="display: inline;" onclick="removeMoreImage(' + loopCountForImg + ')" title="Remove">&#215;</button>';
    html += '</div>';
    html += '<div class="image-card-footer">';
    html += '<label for="selectOtherImages_' + loopCountForImg + '" class=""><i class="far fa-image"></i> Choose image</label>';
    html += '<input type="file" name="images[]" id="selectOtherImages_' + loopCountForImg + '" class="image-box-input">';
    html += '</div>';
    html += '</div>';
    $(html).insertBefore('#addMoreBtn');
    // jQuery("#moreImageBox").append(html);
}
function removeMoreImage(loopCountForImg) {
    $("#imageCardBox_" + loopCountForImg).fadeTo(500, 0.01, function () {
        $(this).slideUp(250, function () {
            $(this).remove();
        });
    });
}
/**
 * Preview Image Function
 */
$(document).on('change', '.image-box-input', function (event) {
    var selectedImageUrl = URL.createObjectURL(event.target.files[0]);
    var imageElm = $(this).closest('.image-box-card').find('img.img-preview');
    var alinkElm = $(this).closest('.image-box-card').find('a.image-link');
    imageElm.attr("src", selectedImageUrl);
    if (alinkElm) {
        // alinkElm.removeAttr('href');
        alinkElm.prop("href", selectedImageUrl);
    }
})

//Add animation when input is focused
$(".form-control").focus(function () {
    $(this).parent().addClass("animation-color");
});

//Remove animation(s) when input is no longer focused
$(".form-control").focusout(function () {
    if ($(this).val() === "") {
        $(this).parent().removeClass("animation-color");
    }
    $(this).parent().removeClass("animation-color");
})