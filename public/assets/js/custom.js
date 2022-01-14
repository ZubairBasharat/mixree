//*****************
// for sidebar
//*****************
// $(".close").click(function() {
//     $(".close").hide();
//     $(".open").show();
// });
// $(".open").click(function() {
//     $(".open").hide();
//     $(".close").show();
// });
// alert(document.URL)

$(document).ready(function () {
    $(".startdate").each(function(){
      $(this).click();
    });
    $(".datetime").each(function(){
        $(this).click();
    });
    $(".details_field").prop('required',false);
    $("#acc_number").keypress(function(evt){
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });
    $(document).on('keypress','.price',function(evt){
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });
    // css("cssText", "background-color: rgba(237, 237, 237, 0.6);color:black;");
     $(document).on('click','.checkboxes',function(){
         if($(this).prop('checked')==true)
         {
            $(this).closest('tr').find('td').each(function(){
                $(this).css("cssText", "background-color: #3A77F6;color:white;");
            })
         }else{
            $(this).closest('tr').find('td').each(function(){
                $(this).css("cssText", "background-color: rgba(237, 237, 237, 0.6);color:black;");
            })
         }
        $('#selected_events').attr('disabled', 'disabled')
         var selected_events = $(".checkboxes:checked").length;
        //  $("#selected_events").text("Delete ("+selected_events+" Events)");
         if(selected_events>0)
         {
            $("#selected_events").removeAttr('disabled');
         }
     });
     $(document).on('click','.participants_checkboxes',function(){
        if($(this).prop('checked')==true)
        {
           $(this).closest('tr').find('td').each(function(){
               $(this).css("cssText", "background-color: #3A77F6;color:white;");
           })
        }else{
           $(this).closest('tr').find('td').each(function(){
               $(this).css("cssText", "background-color: rgba(237, 237, 237, 0.6);color:black;");
           })
        }
       $('#selected_participants').attr('disabled', 'disabled')
        var selected_events = $(".participants_checkboxes:checked").length;
        // $("#selected_participants").text("Cancel ("+selected_events+" Participants)");
        if(selected_events>0)
        {
           $("#selected_participants").removeAttr('disabled');
        }
    });
    $("#registration_form").submit(function(){
        var registration = true;
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (testEmail.test($("#email").val()))
    {
        $("#invalid_email_warn").css('display','none');
    }else{
      $("#invalid_email_warn").css('display','block');
      registration = false;
    }
     if(!registration)
     {
         return false;
     }
    });
    // $('#general_dress_code_div').hide();
    // $('#purchaseEventOutfit').hide();
    // $('#linkToPurchase').hide();
    $('#event_dresscode').change(function() {

        var selectedValue = $(this).val();

        if(selectedValue  === 'general_dress_code') {
            $('#general_dress_code_div').show();
            $('#purchaseEventOutfit').hide();
            $('#linkToPurchase').hide();

        } else if (selectedValue === 'purchase_event_outfit') {
            $('#general_dress_code_div').hide();
            $('#purchaseEventOutfit').show();
            $('#linkToPurchase').hide();
        } else if (selectedValue === 'link_to_purchase') {
            $('#general_dress_code_div').hide();
            $('#purchaseEventOutfit').hide();
            $('#linkToPurchase').show();
        }
         else if (selectedValue === '') {
            $('#general_dress_code_div').hide();
    $('#purchaseEventOutfit').hide();
    $('#linkToPurchase').hide();
        }
    });
    // setTimeout(function() {
    //     $('#ctn-preloader').addClass('loaded');
    //     // Una vez haya terminado el preloader aparezca el scroll
    //     $('body').removeClass('no-scroll-y');

    //     if ($('#ctn-preloader').hasClass('loaded')) {
    //         // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
    //         $('#preloader').delay(1000).queue(function() {
    //             $(this).remove();
    //         });
    //     }
    // }, 3000);

});

function openNav() {
    $("#mySidenav").css("cssText", "z-index:99;width:289px;");
    // document.getElementById("main").style.marginLeft = "295px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}
//*****************
// for image upload
//*****************
function readURL(input) {
    if (input.files && input.files[0]) {
        console.log('first')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
        console.log('second')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview-big').css('background-image', 'url(' + e.target.result + ')');
            $('#groomImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload-big").change(function() {
    readURL2(this);
});
function readURL_witness(input,id) {
    if (input.files && input.files[0]) {
        console.log('second')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+id).css('background-image', 'url(' + e.target.result + ')');
            // $('#'+id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).on("change",".witness_images",function() {
    readURL_witness(this,$(this).attr('data-id'));
});
function readURL3(input) {
    if (input.files && input.files[0]) {
        console.log('second')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview-bride').css('background-image', 'url(' + e.target.result + ')');
            $('#brideImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload-bride").change(function() {
    readURL3(this);
});

function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview-cover').css('background-image', 'url(' + e.target.result + ')');
            $('.img_back').css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload-bride-1").change(function() {
    readURL3(this);
});

function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview-cover').css('background-image', 'url(' + e.target.result + ')');
            $('.img_back').css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload-cover").change(function() {
    readURL4(this);
});
$(document).ready(function() {

    $(".addCF-1").click(renderRegistryFields);
    $("#customFields-1").on('click', '.remCF-1', function() {
        $(this).parent().parent().remove();
    });
    $('.hide-payment').click(function() {
        $(".tab-pane.active").find(("#show-dive-payment")).hide();
        // $(".tab-pane.active").find((".select_event_date")).prop('required', false);
        // $(".tab-pane.active").find((".eventName")).prop('required', false);
        // $("#customField").find(':input').prop('required', false);
    });
    $('.show-payment').click(function() {
        $(".tab-pane.active").find(("#show-dive-payment")).show();
        // $(".tab-pane.active").find((".select_event_date")).prop('required', true);
        // $(".tab-pane.active").find((".eventName")).prop('required', true);
        // $("#customField").find(':input').prop('required', true);
    });
    $('#hide-wedding').click(function() {
        $("#hide-wed-dive").hide();
        $("#customFields-1").find(':input').prop('required', false);
    });
    $('#show-wedding').click(function() {
        $("#hide-wed-dive").show();
        $("#customFields-1").find(':input').prop('required', true);
    });

    function renderRegistryFields() {
        let registryID = Math.random().toString(36).substring(7);
        $("#customFields-1").append(`
<div class="row mt-30px">
   <div class="col-md-4">
      <div class="form-group">
         <div class="input-bg-preview ">
            <label class="lb-start-date w-100 m-0"> Name of the Registry</label>
            <input type="" style="font-weight:bold" maxlength="16" class="details_field registry_name" onkeyup="addRegistry('${registryID}')" id='${registryID}_name' name="registryname[]" placeholder="">
         </div>
         <label id="registery_warn" style="color: red;display:none">Required *</label>
      </div>
   </div>
   <div class="col-md-7">
      <div class="form-group">
         <div class="input-bg-preview ">
            <label class="lb-start-date w-100 m-0"> Link to the website</label>
            <input type="text" style="font-weight:bold" class="details_field registry_link" onkeyup="addRegistry('${registryID}')" id='${registryID}_link' name="registrylink[]" placeholder="">
         </div>
         <label id="link_warn" style="color: red;display:none">Link required *</label>
      </div>
   </div>
   <div class="col-md-1">
      <div class="del-img-1 remCF-1">
         <img src="../public/assets/imgs/ic_round-delete.png" >
      </div>
   </div>
</div>
`)
    }
    // renderRegistryFields();
});
//
$(document).ready(function() {
    $(".addCF-food").click(renderRegistryFields);
    // $("#customFields-1-add-food").on('click', '.remCF-food', function() {
    //     $(this).parent().parent().parent().remove();
    // });

    function renderRegistryFields() {
        let registryIDSingle = Math.random().toString(36).substring(7);
        var active_tab = $('.tab-pane.active').attr('data-id');
        $('.tab-pane.active').find(("#customFields-1-add-food")).append(`
<div class=" mt-30px" id="${registryIDSingle}">
<div class="input-bg-preview-ex-padding ">
   <div class="row">
      <div class="col-10">
         <input  id='${registryIDSingle}' name="food_${active_tab}[]" type="text" onkeypress="KeyPress(event, '${registryIDSingle}')" class=""   placeholder="Ex : Chicken"/>
      </div>
      <div class="col-2 text-end-0">
         <div class="del-img-1-09 remCF-food">
            <img src="../public/assets/imgs/ic_round-delete.png" onclick="removeListItem('${registryIDSingle}')">
         </div>
      </div>
   </div>
</div>
`)
    }
    // renderRegistryFields();
});
$(document).ready(function() {
    $(".addCF-single").click(renderRegistryFields);
    // $("#customFields-1-single-food").on("click", ".remCF-single", function() {
    //     $(this).parent().parent().parent().remove();
});

function renderRegistryFields() {
    let registryIDrt = Math.random().toString(36).substring(7);
    var active_tab = $('.tab-pane.active').attr('data-id');
    $('.tab-pane.active').find(("#customFields-1-single-food")).append(`
        <div class=" mt-30px" id="${registryIDrt}">
        <div class="input-bg-preview-ex-padding ">
           <div class="row">
              <div class="col-10">
                 <input  id='${registryIDrt}' name="drink_${active_tab}[]" type="text" onkeypress="KeyPress(event, '${registryIDrt}')" class="double"   placeholder="Ex : Chicken"/>
              </div>
              <div class="col-2 text-end-0">
                 <div class="del-img-1-09 remCF-food">
                    <img src="../public/assets/imgs/ic_round-delete.png" onclick="removeListItem('${registryIDrt}')">
                 </div>
              </div>
           </div>
        </div>
   `);
}
//     renderRegistryFields();
// });










$(document).ready(function () {



        $(".addPurchase").click(purchase);
    $("#customFieldPurchase").on('click', '.remPurchase', function() {
        $(this).parent().parent().remove();
    });

    function purchase() {
        let donationID = Math.random().toString(36).substring(7);
        let imgInputID = Math.random().toString(36).substring(7);
        let imgPreviewID = Math.random().toString(36).substring(7);
        $("#customFieldPurchase").append(`
   <div class="row event_fashion">
      <div class="col-md-11 col-lg-11">
         <div class="row mt-16px">
            <div class="col-md-12">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input type="text" class="item_name link_item_name" maxlength="16" onkeyup="addDonation('${donationID}')" id='${donationID}_name' name="item_name[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-big mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input class="image link_image" onchange="addDonation('${donationID}', '${imgInputID}','${imgPreviewID}')" type='file' styele="display:none" id='${imgInputID}' accept=".png, .jpg, .jpeg" name="item_image[]"  />
                     <label for='${imgInputID}'></label>
                  </div>
                  <div class="avatar-preview preview-1">
                     <div id="${imgPreviewID}" style="background-image: url('/public/assets/imgs/upload-image.png');">
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-lg-9 col-md-8">
               <div class="form-group">
                  <div class="input-bg-preview">
                     <label class="lb-start-date w-100 m-0"> Item Description</label>
                     <textarea class="form-control link_description description" id="event-description" rows="3" placeholder="" name="item_description[]" ></textarea>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-md-8">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input type="text" class="link_to_purchase" onkeyup="addDonation('${donationID}')" id='${donationID}_purchase' name="item_link[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Link to the Purchase</label>
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input class="price link_price" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_price' name="item_price[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input class="price coupon" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_code' name="coupon_code[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">CouponCode</label>
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required *</label>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-1 col-md-1 p-md-0">
         <div class="del-btn-icon remPurchase mt-3">
            <img src="../public/assets/imgs/delete.png" class="del-img ">
         </div>
      </div>
   </div>
   `)
    }
    // purchase();








    $(".addCF").click(products);
    $("#customField").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
    });
    $(document).on('click', '.remGeneralDressCode', function() {
        $(this).parent().parent().remove();
    });

    function products() {
        let donationID = Math.random().toString(36).substring(7);
        let imgInputID = Math.random().toString(36).substring(7);
        let imgPreviewID = Math.random().toString(36).substring(7);
        $("#customField").append(`
   <div class="row event_fashion">
      <div class="col-md-11 col-lg-11">
         <div class="row mt-16px">
            <div class="col-md-12">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input type="text" class="item_name outfit_name" maxlength="16" onkeyup="addDonation('${donationID}')" id='${donationID}_name' name="outfit_name[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Name of Item</label>
                     </div>
                  </div>
                  <label class="warning" style="color: red;display:none">Required * </label>
               </div>
            </div>
            <div class="col-lg-3 col-md-4 text-center">
               <div class="avatar-upload-big mb-md-0 mb-2">
                  <div class="avatar-edit">
                     <input class="image outfit_image" onchange="addDonation('${donationID}', '${imgInputID}','${imgPreviewID}')" type='file' styele="display:none" id='${imgInputID}' accept=".png, .jpg, .jpeg" name="outfit_image[]"  />
                     <label for='${imgInputID}'></label>
                  </div>
                  <div class="avatar-preview preview-1">
                     <div id="${imgPreviewID}" style="background-image: url('/public/assets/imgs/upload-image.png');">
                     </div>
                  </div>
               </div>
               <label class="warning" style="color: red;display:none">Required *</label>
            </div>
            <div class="col-lg-9 col-md-8">
               <div class="form-group">
                  <div class="input-bg-preview">
                     <label class="lb-start-date w-100 m-0"> Item Description</label>
                     <textarea class="form-control description out_fit_description" id="event-description" rows="3" placeholder="" name="outfit_description[]" ></textarea>
                  </div>
                  <label class="warning" style="color:red;display:none">Required *</label>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <div class="input-bg-preview " style="padding: 1px 19px !important;">
                     <div class="material-form-field">
                        <input class="price outfit_price" type="text" onkeyup="addDonation('${donationID}')" id='${donationID}_price' name="outfit_price[]" id="field-text" />
                        <label class="material-form-field-label lb-start-date w-100 m-0" for="field-text">Price</label>
                     </div>
                  </div>
                  <label class="warning" style="color:red;display:none">Required *</label>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-1 col-md-1 p-md-0">
         <div class="del-btn-icon remCF mt-3">
            <img src="../public/assets/imgs/delete.png" class="del-img ">
         </div>
      </div>
   </div>
   `)
    }
    // products();
});
//*****************
// getting data from create-event-birthday-detail to show in preview modal
//*****************
let weddingRegistry = [];

function addRegistry(registryID) {
    let name = $("#" + registryID + '_name').val();
    let link = $("#" + registryID + '_link').val();
    let reg = weddingRegistry.find(reg => reg.id === registryID);
    let registry = {
        id: registryID,
    };
    if (reg === undefined) {
        registry.name = name;
        registry.link = link;
        weddingRegistry.push(registry)
    } else {
        weddingRegistry.forEach(reg => {
            if (reg.id === registryID) {
                reg.name = name;
                reg.link = link
            }
        })
    }
}
$(".btn_preview").click(function() {
    let donation = $('.donation').val();
    $('#append_donantion').empty().append(donation);
    $('.div_wedding_registry').empty()
    weddingRegistry.forEach(reg => {
        $('.div_wedding_registry').append(`
   <div class="list_wedding row">
      <div class="col-md-10">
         <p class="p_wedding_list">${reg.name}</p>
      </div>
      <div class="col-md-2">
         <a href="${reg.link}" target="_blank">
         <img src="/public/assets/imgs/expand.png" class="icon_expand ">
         </a>
      </div>
   </div>
   `)
    })
});
//*****************
// for datetime picker
//*****************
// $(".form_datetime").datetimepicker({
//     pickTime: false,
//     minView:2,
//     format: "dd MM yyyy",
//     autoclose: true,
//     todayBtn: true,
//     startDate: new Date()
// });

function readURL5(e) {
    return console.log($('#imagePreview-donation').files())
    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview-donation').css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(e.target.files[0]);
    }
}
// $("#imageUpload-donation").change(function(e) {
//     console.log(e)
//     readURL5(this);
// });
function Upload(inputID, previewID) {
    var files = $('#' + inputID).prop('files')[0];
    if (files) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + previewID).css('background-image', 'url(' + e.target.result + ')');
        }
        reader.readAsDataURL(files);
    }
}
let productsArray = [];

function addDonation(productID, inputID, previewID) {
    let name = $("#"+productID +'_name').val();
    let purchase = $("#" + productID + '_purchase').val();
    let price = $("#" + productID + '_price').val();
    let pro = productsArray.find(pro => pro.id === productID);
    let product = {
        id: productID,
    };
    if (pro === undefined) {
        product.name = name;
        product.purchase = purchase;
        product.price = price;
        if (inputID !== undefined) {
            var files = $('#' + inputID).prop('files')[0];
            if (files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+previewID).css('background-image', 'url(' + e.target.result + ')');
                    product.imageBase64 = e.target.result;
                }
                reader.readAsDataURL(files);
            }
        }
        productsArray.push(product)
    } else {
        productsArray.forEach(pro => {
            if (pro.id === productID) {
                pro.name = name;
                pro.purchase = purchase;
                pro.price = price;
                if (inputID !== undefined) {
                    var files = $('#' + inputID).prop('files')[0];
                    if (files) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#' + previewID).css('background-image', 'url(' + e.target.result + ')');
                            pro.imageBase64 = e.target.result;
                        }
                        reader.readAsDataURL(files);
                    }
                }
            }
        })
    }
}
//*****************
// getting data to show in preview modal
//*****************
$(".btn_preview").click(function() {
    console.log(productsArray)
    $('.div_products_row').empty()
    productsArray.forEach(pro => {
        $('.div_products_row').append(`
   <div class="col-md-6">
      <img src="${pro.imageBase64}" class="img_product">
      <p class="product_name">${pro.name}</p>
      <div class="d-inline-flex">
         <p class="p_product_prize">${pro.price}</p>
         <a href="${pro.purchase}">
            <p class="p_product_buyNow">Buy Now</p>
         </a>
      </div>
   </div>
   `)
    })
});
$(document).ready(function() {

    // all checkboxes active
    $('#checkbox_main_all').on('change', function() {
        if ($(this).is(':checked')) {
            // $(".tbl_gray td").css('background-color', "#3A77F6");
            // $(".color_white").css("cssText", "color: white !important;");
            $(".tbl_gray td").css("cssText", "background-color: #3A77F6;color:white;");
            $(".tbl_gray td span").css("cssText", "color:white;");
            $(".tbl_gray td p").css("cssText", "color:white;");
        } else {
            $(".tbl_gray td").css("cssText", "background-color: rgba(237, 237, 237, 0.6);color:black;");
            $(".tbl_gray td span").css("cssText", "color:black;");
            $(".tbl_gray td p").css("cssText", "color:black;");
        }
    });
});
var show = true;
//single Tr selection
function trSelection(id, chId, labelId) {
    var myCheckbox = document.getElementById(chId);
    var myDiv = document.getElementById(id);
    if (show) {
        show = false;
        document.getElementById(labelId).classList.remove('hide');
        // myDiv>td.style.backgroundColor = "#3A77F6";
        var c = document.getElementById(id).children
        var i;
        for (i = 0; i < c.length; i++) {
            c[i].style.backgroundColor = "#3A77F6";
            c[i].style.color = "white";
            $('.' + id).css("cssText", "color:white;");
        }
        document.getElementById(chId).checked = true;
        // $('#' + id).children('td').css("cssText", "background-color: #3A77F6 !important;");
        // $('#' + id).children().css("cssText", "color: white !important;");
    } else {
        show = true;
        document.getElementById(labelId).classList.add('hide');
        var c = document.getElementById(id).children
        var i;
        for (i = 0; i < c.length; i++) {
            c[i].style.backgroundColor = "rgba(237, 237, 237, 0.6)";
            c[i].style.color = "black";
            $('.' + id).css("cssText", "color:black;");
            document.getElementById(chId).checked = false;
        }
        // myDiv.style.backgroundColor = "rgba(237, 237, 237, 0.6)";
        // $('#' + id).children().css("cssText", "color: black !important;");
    }
}
//single checkbox avtive
function myFunction(id, chId) {
    var myCheckbox = document.getElementById(chId);
    var myDiv = document.getElementById(id);
    if (myCheckbox.checked == true) {
        // myDiv>td.style.backgroundColor = "#3A77F6";
        var c = document.getElementById(id).children
        var i;
        for (i = 0; i < c.length; i++) {
            c[i].style.backgroundColor = "#3A77F6";
            c[i].style.color = "white";
            $('.' + id).css("cssText", "color:white;");
        }
        // $('#' + id).children('td').css("cssText", "background-color: #3A77F6 !important;");
        // $('#' + id).children().css("cssText", "color: white !important;");
    } else {
        var c = document.getElementById(id).children
        var i;
        for (i = 0; i < c.length; i++) {
            c[i].style.backgroundColor = "rgba(237, 237, 237, 0.6)";
            c[i].style.color = "black";
            $('.' + id).css("cssText", "color:black;");
        }
        // myDiv.style.backgroundColor = "rgba(237, 237, 237, 0.6)";
        // $('#' + id).children().css("cssText", "color: black !important;");
    }
}
$(".add-food").click(function() {
    let donation = $('.foods').val();
    $('.checker').append(`
   <label class="container_checkbox_all">
   <input type="checkbox" id="checkbox_main_all" >
   <span class="checkmark_all mt-1"></span>
   ${donation}
   </label>
</div>
`)
    $('.foods').val('');
});
$(document).ready(function() {
    $(".slideBtn").click(function() {
        if ($("#sidenav-right").width() == 0) {
            document.getElementById("sidenav-right").style.width = "375px";
            document.getElementById("main").style.paddingRight = "400px";
            document.getElementById("slidebtn").style.paddingRight = "400px";
        } else {
            document.getElementById("sidenav-right").style.width = "0";
            document.getElementById("main").style.paddingRight = "40px";
            document.getElementById("slidebtn").style.paddingRight = "40px";
        }
    });
});
// $('.double').keypress(function(event) {
//     console.log(event.keyCode)
//     var keycode = (event.keyCode ? event.keyCode : event.which);
//     if (keycode == '13') {
//         if ($(this).prop('readonly') === false) {
//             $(this).prop('readonly', true);
//         } else {
//             $(this).prop('readonly', false);
//         }
//     }
// });
function KeyPress(event, id) {
    // var keycode = (event.keyCode ? event.keyCode : event.which);
    if (event.keyCode == '13') {
        if ($("#" + id).prop('readonly') === false) {
            $("#" + id).prop('readonly', true);
        } else {
            $("#" + id).prop('readonly', false);
        }
        event.preventDefault();
        return false;
    }
}

// function onDoubleClick(elem) {
//     var element = $(elem);
//     if (element.prop('readonly') === true) {
//         element.prop('readonly', false);
//         if (!element.val()) {
//             element.val(".").val("");
//         } else {
//             element.val($.trim(element.val(element.val() + " ").val()));
//         }
//     } else {
//         element.prop('readonly', true);
//     }
// }
var today = new Date();
var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date + ' ' + time;
// $("#form-date").datepicker({
//     onSelect: function() {
//         var dateObject = $(this).datepicker('getDate');
//         console.log(dateObject);
//     }
// });
$(".fa-calendar").click(function() {
    $("#input-date").change(function() {
        var fulldate = $("#input-date").val();
        var date = fulldate.split('-');
        $('.p_error').html(`You just can order until ${date[0]}`);
    })
});
//menu pair
// $("#btn_next-paired").click(function() {
//     const checkbox1 = document.getElementById("#checkbox1");
// });
$('.showBtn').click(function() {
    //$('.hideme').hide();
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('.hideme').slideUp();
    } else {
        $('.hideme').slideUp();
        $('.showBtn').removeClass('active');
        $(this).addClass('active');
        $(this).next().filter('.hideme').slideDown();
    }
});
// $('input[type=text]').keypress(function(event) {
//     var keycode = (event.keyCode ? event.keyCode : event.which);
//     if (keycode == '13') {
//         if ($(this).prop('readonly') === false) {
//             $(this).prop('readonly', true);
//         } else {
//             $(this).prop('readonly', false);
//         }
//     }
// });
// function onDoubleClick(elem) {
//     var element = $(elem);
//     if (element.prop('readonly') === true) {
//         element.prop('readonly', false);
//         if (!element.val()) {
//             element.val(".").val("");
//         } else {
//             element.val($.trim(element.val(element.val() + " ").val()));
//         }
//     } else {
//         element.prop('readonly', true);
//     }
// }
$(document).ready(function() {
    $(".btn-suc").click(function() {
        $(".btn-suc").hide();
        $(".btn-end").show();
    });
    $(".btn-end").click(function() {
        $(".btn-end").hide();
        $(".btn-suc").show();
    });
    $(".btn-suc1").click(function() {
        $(".btn-suc1").hide();
        $(".btn-end1").show();
    });
    $(".btn-end1").click(function() {
        $(".btn-end1").hide();
        $(".btn-suc1").show();
    });
    $(".btn-suc2").click(function() {
        $(".btn-suc2").hide();
        $(".btn-end2").show();
    });
    $(".btn-end2").click(function() {
        $(".btn-end2").hide();
        $(".btn-suc2").show();
    });
    $(".btn-suc3").click(function() {
        $(".btn-suc3").hide();
        $(".btn-end3").show();
    });
    $(".btn-end3").click(function() {
        $(".btn-end3").hide();
        $(".btn-suc3").show();
    });
    // $(".button-0").click(function() {
    //     $(".tab-pane.active").find((".uy")).toggle();
    // });
});
let liNodes = [];
$(".eventName").on('keypress', function(e) {
    // if (e.target.value !== '') {
        if (e.keyCode == 13) {
//             let listItemId = Math.random().toString(36).substring(7);
//             liNodes.push(listItemId);
//             $(".tab-pane.active").find((".uy")).toggle();
//             var event_program = $(".tab-pane.active").attr('data-id');
//             $(".tab-pane.active").find((".sortable")).append(`
// <li class="ui-state-default" id='${listItemId}'>
//    <div class="col-md-12">
//       <div class="row mt-40px">
//          <div class="col-10">
//             <div class="input-bg-preview-whit " style="padding: 0px 18px !important;">
//                <div class="row">
//                   <div class="col-10">
//                      <div class="material-form-field">
//                         <input type="text" required="" name="event_program_${event_program}[]" class="place-style"  value='${e.target.value}' >
//                      </div>
//                   </div>
//                   <div class="col-2">
//                      <img src="../public/assets/imgs/drag.png" class="mt-30px">
//                   </div>
//                </div>
//             </div>
//          </div>
       
//          <div class="col-1">
//             <div class="del-img-3 mt-20px ml-4">
//                <img src="../public/assets/imgs/ic_round-delete.png" id="deleteLiItem" onclick="removeListItem('${listItemId}')" >
//             </div>
//          </div>
//       </div>
//    </div>
// </li>
// `)
//             e.target.value = ''
//             e.preventDefault();
            return false;
        //}
   }
})

function removeListItem(listId) {
    $(`#${listId}`).remove();
    liNodes.splice(liNodes.indexOf(listId), 1)
}

function eventPreview() {
    $('#event-program').empty()
    liNodes.forEach(function(node) {
        let value = $(`#${node} input`).val();
        $('#event-program').append(`
<li class="list-group-item completed">
   <div class="div_space">
   </div>
   <div class="list-online">
      <span class="fony-bol">Lorem.</span>
      <div class="d-inline-flex mt-3">
         <img src="assets/imgs/female.png" height="w-50" class="img-m" >
         <img src="assets/imgs/female.png" height="w-50" class="img_mr">
         <img src="assets/imgs/female.png" height="w-50" class="img_mr">
         <p class="ml-3 loin" >Daniella Dewitt and 5 other share memories</p>
      </div>
   </div>
</li>
`)
    })
}
// var startIndex;
// $(function() {
//     $("#sortable").sortable({
//         update: function(event, ui) {
//             liNodes = array_move(liNodes, startIndex, ui.item.index())
//         },
//         start: function(event, ui) {
//             startIndex = ui.item.index();
//         }
//     });
//     $("#sortable").disableSelection();
// });

function array_move(arr, old_index, new_index) {
    if (new_index >= arr.length) {
        var k = new_index - arr.length + 1;
        while (k--) {
            arr.push(undefined);
        }
    }
    arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
    return arr; // for testing
};
let deals = [];
let deals_id = [];

function handleMealCheck(name, id) {
    if (deals.indexOf(name) === -1) {
        deals.push(name)
        deals_id.push(id);
    } else {
        deals.splice(deals.indexOf(name), 1)
        deals_id.splice(deals_id.indexOf(id), 1)
    }
}
// for Paired duplication on click
// $(document).ready(function() {
$(".btn_next-paired").click(renderPairedFields);
// $("#customFields-1-single-food").on("click", ".remCF-single", function() {
//     $(this).parent().parent().parent().remove();
// });
var registryIDrt;
var counter = 0;

function renderPairedFields() {
    var active_tab = $('.tab-pane.active').attr('data-id');
    if (!deals.length) return;
    let id = Math.random().toString(36).substring(7);
    registryIDrt = id;
    $("#paired-values_" + active_tab).append(`
<div class="form-group">
   <div class="input-bg-preview-ex-padding">
      <input readonly id='${registryIDrt}' type="text" value="" />
      <input type="hidden" id='ids_${registryIDrt}' name='ids_${counter}[]' value=""/>
      <input type="hidden" id='pair_meal_name_${registryIDrt}' name='pair_meal_name_${active_tab}[]' value=""/>
   </div>
</div>
`);
    counter++;
}
$('.btn_next-paired').on('click', function() {
    var myinput = "";
    if (!deals.length) return;
    let customMealInputValue = $('.tab-pane.active').find(('.custom-meal-input')).val();
    let previewValue = `${customMealInputValue} (${deals.join(', ')})`
    let hidden_ids = `${deals_id.join(',')}`
    $(`#${registryIDrt}`).val(previewValue);
    $("#ids_" + `${registryIDrt}`).val(hidden_ids);
    $("#pair_meal_name_" + `${registryIDrt}`).val(customMealInputValue);
    $("#myInput").val(myinput);
    $(".selected_check").prop("checked", false);
    deals = [];
    deals_id = [];
});
$('.custom-meal-input').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
        return false;
    }
});
// });
function managePairedCheckboxes(id) {
    const checked = document.getElementById(id).checked;
    if (checked) {
        document.getElementById(id).checked = false;
        handleMealCheck(id);
        $(`.custom-meal-input`).val('');
    }
}
// category meal Tasks
let categories = [];
let paired_meal_ids = [];

function handleCatagoryCheck(name, id) {
    console.log(categories.indexOf(name));
    if (categories.indexOf(name) === -1) {
        categories.push(name)
        paired_meal_ids.push(id);
    } else {
        categories.splice(categories.indexOf(name), 1)
    }
    console.log('categories', categories)
}
// for Paired duplication on click
// $(document).ready(function() {
$(".btn_next-paired").click(renderRegistrycatagory);
// $("#customFields-1-single-food").on("click", ".remCF-single", function() {
//     $(this).parent().parent().parent().remove();
// });
var regitryCatagory;
var categorize_counter = 1;

function renderRegistrycatagory() {
    var active_tab = $('.tab-pane.active.show').attr('data-id');
    if (categories.length === 0) return;
    let id = Math.random().toString(36).substring(7);
    let customMealInputValue = $(".tab-pane.active").find(('.custom-catagory-meal')).val();
    if (customMealInputValue === '') {
        return;
    }
    $(".tab-pane.active").find(('#categorized-meal-segment')).append(`
<div class="col-8 mt-20px">
   <p class="head_detail_ce-1-double" id="category-heading"> ${customMealInputValue} </p>
   <input type="hidden" name="id_${active_tab}[]" value="${paired_meal_ids}">
   <input type="hidden" name="name_${active_tab}[]" value="${customMealInputValue}">
</div>
<div class="mt-15px">
   <div class="row">
      <div class="col-md-12 " id="${id}">
      </div>
   </div>
</div>
`)
    categorize_counter++;
    paired_meal_ids = [];
    console.log(categories.length);
    const length = categories.length;
    for (let i = 0; i < length; i++) {
        $("#" + id).append(`
<div class="form-group">
   <div class="input-bg-preview-ex-padding">
      <input readonly  type="text" value='${categories[i]}'/>
   </div>
</div>
`);
        $(".check").prop("checked", false);
        $(".custom-catagory-meal").val('');
        // categories.splice(categories.indexOf(categories[i]), 1)
        // manageCategoryCheckboxes('burger');
        // manageCategoryCheckboxes('drink');
        // manageCategoryCheckboxes('fun');
        // manageCategoryCheckboxes('noodles');
    }
    console.log(categories.length)
    categories = []
    return;
    for (let index = 0; index < categories.length; index++) {
        let id = Math.random().toString(36).substring(7);
        regitryCatagory = id;
        // let nodes =
        $("#paired-catagory").append(`
<div class="form-group">
   <div class="input-bg-preview-ex-padding">
      <input readonly  type="text" value="" id='${regitryCatagory}'/>
   </div>
</div>
`);
        let customMealInputValue = $('.custom-catagory-meal').val();
        $("#category-heading").html(`${customMealInputValue}`);
        var val = categories[index];
        let previewValue = val;
        categoryName = previewValue;
        $(`#${regitryCatagory}`).val(previewValue);
        // if (categories.length === index) {
        //     categories = [];
        // }
        handleCatagoryCheck(val)
            // manageCategoryCheckboxes('burger');
            // manageCategoryCheckboxes('drink');
            // manageCategoryCheckboxes('fun');
            // manageCategoryCheckboxes('noodles');
    }
}
// var categoryName;
// $('#btn_next-catagory').on('click', function() {
//     if (!categories.length) return;
//     for (let index = 0; index < categories.length; index++) {
//     }
// });
// });
function manageCategoryCheckboxes(id) {
    const checked = document.getElementById(id).checked;
    if (checked) {
        document.getElementById(id).checked = false;
        $(`.custom-catagory-meal`).val('');
    }
}
$.extend(true, $.fn.dataTable.defaults.oLanguage.oPaginate, {
    sNext: '<i class="fa fa-chevron-right" ></i>',
    sPrevious: '<i class="fa fa-chevron-left" ></i>'
});
$("#delete_events_form").submit(function(){
    let events = [];
      var counter = 0;
      $(".checkboxes:checked").each(function(){
        events[counter] = $(this).val();
        counter++;
      });
      $("#deleted_events").val(events);
   });

   $("#delete_participants_form").submit(function(){
    let participants = [];
      var counter = 0;
      $(".participants_checkboxes:checked").each(function(){
        participants[counter] = $(this).val();
        counter++;
      });
      $("#deleted_participants").val(participants);
   });
$("#event_details").submit(function(){
    warning = true;
    $(".name_of_location").each(function(){
        if($(this).val()=="")
        {
            warning = false;
          $(this).parent().parent().find('.name_of_location_warn').css('display','block');
        }else{
          $(this).parent().parent().find('.name_of_location_warn').css('display','none');
        }
      });
  
      $(".addresslocation").each(function(){
         if($(this).val()==""){
             $(this).parent().parent().find('.address_location_warn').css('display','block');
             warning = false;
         }else{
          $(this).parent().parent().find('.address_location_warn').css('display','none');
         }
      });
      var dates = 1;
      $(".dates").each(function(){
       if($(this).val()==""){
           $("#select_date_warn_"+dates).css('display','block');
           warning = false;
       }else{
          $("#select_date_warn_"+dates).css('display','none');
       }
       dates++;
      });
      var times = 1;
      $(".times").each(function(){
       if($(this).val()==""){
           $("#select_time_warn_"+times).css('display','block');
           warning = false;
       }else{
          $("#select_time_warn_"+times).css('display','none');
       }
       times++;
      });
    //event name warning
    if($("#eventName").val()=="")
    {
        $("#event_name_warn").css('display','block');
        warning = false;
    }else{
        $("#event_name_warn").css('display','none');
    }

    //event description warning
    if($("#event-description").val()=="")
    {
      $("#note_warning").css('display','block');
      warning = false;
    }else{
        $("#note_warning").css('display','none');
    }
    //event icon warning
    if($(".icon").length>0)
    {
        if($(".icon")[0].files.length==0)
        {
            $("#iconwarning").css('display','block'); 
            warning = false;
        }else{
            $("#iconwarning").css('display','none'); 
        }
    }
     //event background warning
     if($("#imageUpload-cover").length>0)
     {
        if($("#imageUpload-cover")[0].files.length==0)
        {
            $("#backgroundwarning").css('display','block'); 
            warning = false;
        }else{
            $("#backgroundwarning").css('display','none'); 
        }
    }
     // warning for event type of wedding
     if($("#event_type").val()=="wedding")
     {
         if($(".groom_f_name").val()==""){
            $("#groom_f_name_warn").css('display','block');
            warning = false;
         }else{
            $("#groom_f_name_warn").css('display','none');
         }

         if($(".groom_l_name").val()==""){
            $("#groom_l_name_warn").css('display','block');
            warning = false;
         }else{
            $("#groom_l_name_warn").css('display','none');
         }
 
         if($(".bride_f_name").val()=="")
         {
          $("#bride_f_name_warn").css('display','block');
          warning = false;
         }else{
            $("#bride_f_name_warn").css('display','none');
         }

         if($(".bride_l_name").val()=="")
         {
          $("#bride_l_name_warn").css('display','block');
          warning = false;
         }else{
            $("#bride_l_name_warn").css('display','none');
         }

         $(".witness_f_name").each(function(){
          if($(this).val()==""){
            $(this).parent().parent().parent().find('.witness_f_name_warn').css('display','block');
            warning = false;
          }else{
            $(this).parent().parent().parent().find('.witness_f_name_warn').css('display','none');
          }
         });

         $(".witness_l_name").each(function(){
            if($(this).val()==""){
              $(this).parent().parent().parent().find('.witness_l_name_warn').css('display','block');
              warning = false;
            }else{
              $(this).parent().parent().parent().find('.witness_l_name_warn').css('display','none');
            }
           });
    
         $(".biography").each(function(){
           if($(this).val()==""){
               $(this).parent().parent().parent().find('.biography_warn').css('display','block');
             warning = false;
           }else{
            $(this).parent().parent().parent().find('.biography_warn').css('display','none');
           }
         });
         if($(".groom_img").length>0)
         {
            if($(".groom_img")[0].files.length==0)
            {
                $("#groom_warning").css('display','block'); 
                warning = false;
            }else{
                $("#groom_warning").css('display','none'); 
            }
        }
        if($("#imageUpload-bride").length>0)
        {
            if($("#imageUpload-bride")[0].files.length==0)
            {
                $("#bride_warning").css('display','block'); 
                warning = false;
            }else{
                $("#bride_warning").css('display','none'); 
            }
        }
        if($(".witness_images").length>0)
        {
            $(".witness_images").each(function(){
                if($(this)[0].files.length==0){
                $("#"+$(this).data('warning')).css('display','block');
                warning = false;
                }else{
                    $("#"+$(this).data('warning')).css('display','none');
                }
            });
        }
    }
     if(!warning)
     {
         return false;
     }
    $("#preloader").css("display", 'block');
//    return false;
});
$("#details_form").submit(function() {
    var warning = true;
    var total_tabs = $(".all_tabs").length;
    for (var i = 1; i <= total_tabs; i++) {
        if ($(".payment_" + i).prop("checked")) {
            if ($("#event_date_" + i).val() == "") {
                $(".date_warn_" + i).css('display', "block");
                $(".tab_"+i).css('background','#df4759');
                $(".tab_"+i).css('border-radius','13%');
                warning = false;
            } else {
                $(".date_warn_" + i).css('display', "none");
                $(".tab_"+i).css('background','');
            }
        }
    }
    var visibility = 1;
    $(".all_tabs").each(function(){
        if ($(".payment_" + visibility).prop("checked")) {
         var field = $(this).data('value');
         $(".custom_"+field).each(function(){
            if($(this).val()=="")
            {
                $(this).parent().parent().parent().parent().find('.dexcription_warning').css('display','block');
                $(".tab_"+visibility).css('background','#df4759');
                $(".tab_"+visibility).css('border-radius','13%');
                warning = false;
            }else {
                $(this).parent().parent().parent().parent().find('.dexcription_warning').css('display','none');
                $(".tab_"+visibility).css('background','');
            }
         });
        }
        visibility++;
    });
    if (warning == false) {
        return false;
    }
    $("#preloader").css("display", 'block');
});
function create_event()
{

    var counter = 1;
    var move = true;
    var code = $("#event_code").val();
    if($("#type_of_event").is(':visible'))
    {
        if($("#other_type").val()=="")
        {
            $("#type_event_warn").css('display','block');
            move = false;
        }else{
            $('#event_type').val($("#other_type").val());
        }
    }
    $('.create_event_date').each(function() {
        if($(this).val()=="")
        {
          $("#start_date_warn"+counter).css('display','block');
          move = false;
        }else{
            $("#start_date_warn"+counter).css('display','none');
        }
        counter++;
    });
    $.ajax({
        url : 'check_code',
        type : 'POST',
        data : {code: code},
        success:function(response){
            if(response==false)
            {
               $("#code_warn").css('display','block');
               return false;
            } else {
                $("#code_warn").css('display','none');
                if(move==false){
                    return false;
                }
                $("#preloader").css("display", 'block');
                $("#create_event_form").submit();
            }
        },
    });
}
// $("#create_event_form").submit(function() {
// });
$("#event_fashion_details_form").submit(function() {
    var move = true;
    if($('#visibility').val()==1){
    if($("#showdata_status").val()=="show" && $("#event_dresscode").val()==""){
        $("#dresscode_warn").css('display','block');
        move = false;
    }else{
        // for general_dress_code
        if($("#event_dresscode").find(":selected").val()=="general_dress_code")
        {
          $(".dresscode_description").each(function(){
              if($(this).val()=="")
              {
                  $(this).parent().parent().find('.warning').css('display','block');
                  move = false;
              } else {
                $(this).parent().parent().find('.warning').css('display','none');
              }
          })
        }
        // for purchase_event_outfit
         else if($("#event_dresscode").find(":selected").val()=="purchase_event_outfit"){
              $(".outfit_name").each(function(){
                  // out fit name
                  if($(this).val()=="")
                  {
                     $(this).parent().parent().parent().find('.warning').css('display','block');
                     move = false;
                  } else {
                    $(this).parent().parent().parent().find('.warning').css('display','none');
                  }
                  //out fitt description
                  $(".out_fit_description").each(function(){
                     if($(this).val()=="")
                     {
                         $(this).parent().parent().find('.warning').css('display','block');
                         move = false;
                     } else {
                        $(this).parent().parent().find('.warning').css('display','none');
                     }
                  });
                  //outfit price
                  $(".outfit_price").each(function(){
                      if($(this).val()=="")
                      {
                        $(this).parent().parent().parent().find('.warning').css('display','block');
                        move = false;
                      } else {
                        $(this).parent().parent().parent().find('.warning').css('display','none');
                      }
                  });

                  //out fit images
                  $(".outfit_image").each(function(){
                      if($(this)[0].files.length==0)
                      {
                        $(this).parent().parent().parent().find('.warning').css('display','block');
                        move = false;
                      } else {
                        $(this).parent().parent().parent().find('.warning').css('display','none');
                      }
                  })
              });
        } 
        // for link_to_purchase
        else if($("#event_dresscode").find(":selected").val()=="link_to_purchase") {

            //link to purchase name
            $(".link_item_name").each(function(){
                if($(this).val()=="")
                {
                    $(this).parent().parent().parent().find('.warning').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().parent().find('.warning').css('display','none');
                }
            })
            // link description
            $(".link_description").each(function(){
                if($(this).val()=="")
                {
                    $(this).parent().parent().find('.warning').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().find('.warning').css('display','none');
                }
            });
            // link price 
            $(".link_price").each(function(){
               if($(this).val()=="")
               {
                $(this).parent().parent().parent().find('.warning').css('display','block');
                move = false;
               } else {
                $(this).parent().parent().parent().find('.warning').css('display','none');
               } 
            });
            //link to purchase 
            $(".link_to_purchase").each(function(){
               if($(this).val()=="")
               {
                $(this).parent().parent().parent().find('.warning').css('display','block');
                move = false;
               } else {
                $(this).parent().parent().parent().find('.warning').css('display','none');
               }
            });
            // coupon code 
            $(".coupon").each(function(){
              if($(this).val()=="")
              {
                $(this).parent().parent().parent().find('.warning').css('display','block');
                move = false;
              } else {
                $(this).parent().parent().parent().find('.warning').css('display','none');
              }
            });
            //link image 
            $(".link_image").each(function(){
                if($(this)[0].files.length==0)
                {
                  $(this).parent().parent().parent().find('.warning').css('display','block');
                  move = false;
                } else {
                  $(this).parent().parent().parent().find('.warning').css('display','none');
                }
            });
        }
        $("#dresscode_warn").css('display','none');
        $("#event_dresscode").val();
    }
    // return false;
  }
    if(!move)
    {
        return false;
    }
    $("#preloader").css("display", 'block');
});
$("#add_event_gift_form").submit(function() {
    var move = true;
    if($("input[name='gift']:checked").val()==1)
    {
      $(".method").each(function(){
            if($(this).find(":selected").val()=="bank_account")
            {
                var bank_name = $(this).parent().parent().parent().parent().parent().find('.name_of_bank').val();
                var account_name = $(this).parent().parent().parent().parent().parent().find('.name_of_account').val();
                var account_number = $(this).parent().parent().parent().parent().parent().find('.account_number').val();
                if(bank_name=="")
                {
                    $(this).parent().parent().parent().parent().parent().find('.bank_name_warn').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().parent().parent().parent().find('.bank_name_warn').css('display','none');
                }
                if(account_name=="")
                {
                    $(this).parent().parent().parent().parent().parent().find('.account_name_warn').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().parent().parent().parent().find('.account_name_warn').css('display','none');
                }
                if(account_number=="")
                {
                    $(this).parent().parent().parent().parent().parent().find('.account_number_warn').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().parent().parent().parent().find('.account_number_warn').css('display','none');
                }
            } else {
            var payment_email = $(this).parent().parent().parent().parent().parent().find('.payment_email').val();
                if(payment_email=="")
                {
                    $(this).parent().parent().parent().parent().parent().find('.warning').css('display','block');
                    move = false;
                } else {
                    $(this).parent().parent().parent().parent().parent().find('.warning').css('display','none');
                }
            }
      });
      if($("input[name='registry']:checked").val()==1)
      {
          $(".registry_name").each(function(){
              if($(this).val()=="")
              {
                 move = false;
                 $(this).parent().parent().find('#registery_warn').css('display','block');
              } else {
                $(this).parent().parent().find('#registery_warn').css('display','none');
              }
          });
          $(".registry_link").each(function(){
            if($(this).val()=="")
            {
               move = false;
               $(this).parent().parent().find('#link_warn').css('display','block');
            } else {
              $(this).parent().parent().find('#link_warn').css('display','none');
            }
        });
      }
    }
    if(move==false)
    {
        return false;
    } else {
    $("#preloader").css("display", 'block');
    }
});
$("#single_dish_form").submit(function() {
    var counter = 1;
    var loader = true;
    $('.option-input:checked').each(function(index, data) {
        if ($(this).val() == 1) {
            if($("#menu_type"+counter).find('option:selected').val()==0){
            if ($(".single_meal" + counter).val() == "") {
                $("#food_warn" + counter).css('display', "block");
                $(".tab_"+counter).css('background','#df4759');
                $(".tab_"+counter).css('border-radius','13%');
            } else {
                $("#food_warn" + counter).css('display', "none");
                $(".tab_"+counter).css('background','');
            }
            if ($(".single_drink" + counter).val() == "") {
                $("#drink_warn" + counter).css('display', "block");
                $(".tab_"+counter).css('background','#df4759');
                $(".tab_"+counter).css('border-radius','13%');
            } else {
                $("#drink_warn" + counter).css('display', "none");
                $(".tab_"+counter).css('background','');
            }
            if ($(".single_meal" + counter).val() == "" || $(".single_drink" + counter).val() == "") {
                loader = false;
            }
          }
          else{
            //   alert("ab");
             if($(".platted_category_"+counter).val()==""){
                $(".tab_"+counter).css('background','#df4759');
                $(".tab_"+counter).css('border-radius','13%');
                 loader = false;
             }else{
                $(".tab_"+counter).css('background','');
             }
          }
        }else{
            $(".tab_"+counter).css('background','');
        }
        counter++;
    });
    // return false;
    if (!loader) {
        return false;
    }
    $("#preloader").css("display", 'block');
});
$("#paired_meal_form").submit(function() {
    var pair = 1;
    var loader = true;
    $('.paired_meals').each(function(index, data) {
        if ($(this).children().length == 0) {
            $("#pair_warn_" + pair).css('display', 'block');
            loader = false;
        } else {
            $("#pair_warn_" + pair).css('display', 'none');
        }
        pair++;
    });
    if (loader) {
        $("#preloader").css("display", 'block');
    } else {
        return false;
    }
});
$("#category_form").submit(function() {
    var loader = true;
    var warn = 1;
    $(".categorized_meal_segment").each(function(index, data) {
        if ($(this).children().length == 2) {
            $("#category_warn_" + warn).css("display", "block");
            loader = false;
        } else {
            $("#category_warn_" + warn).css("display", "none");
        }
        warn++;
    });
    if (loader) {
        $("#preloader").css("display", 'block');
    } else {
        return false;
    }
});

function submit_form()
{
    var move = true;
    if($("#full_name").val()=="")
    {
         $("#full_name_warn").css('display','block');
         move = false;
    } else {
        $("#full_name_warn").css('display','none');
    }
    if($("#old_password").val()!="")
    {
        if($("#new_password").val()=="")
        {
            $("#cnfrm_password_warn").css('display','block');
            move = false;
        }
    } else {
        $("#cnfrm_password_warn").css('display','none');
    }
    if($("#new_password").val()!="")
    {
        if($("#new_password").val()!=$("#cnfrm_password").val())
        {
            $("#cnfrm_password_warn").css('display','block');
            move = false;
        } else {
            $("#cnfrm_password_warn").css('display','none');
        }
        if(!move)
        {
          return false;
        } 
        var old_password = $("#old_password").val();
        $.ajax({
         url: "check_old_password",
         type: 'post',
         data: {password: old_password},
         success:function(response)
         {
             if(response)
             {
                $("#old_password_warn").css('display','none');
                $("#update_form").submit();
             } 
             else
             {
               $("#old_password_warn").css('display','block');
               return false;
             }
         }
        });
    } else {
        if(!move)
        {
          return false;
        } else {
            $("#update_form").submit();
        }
    }
}
    
// $('body').on('click', '.fa.fa-clock-o', function() {
//     $(".form_datetime-1").datetimepicker({
//     pickDate: false,
//     minuteStep: 5,
//     pickerPosition: 'bottom-right',
//     format: 'HH:ii p',
//     autoclose: true,
//     showMeridian: false,
//     startView: 1,
//     maxView: 1,
//     // startDate: new Date(),
//     });
//      });