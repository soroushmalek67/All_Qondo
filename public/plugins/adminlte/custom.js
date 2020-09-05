jQuery(document).ready(function() {
//    alert('hello');
    //Process icon
    $(document).ajaxSend(function(event, request, settings) {
    $('#loading-indicator').show('slow');
    });

    $(document).ajaxComplete(function(event, request, settings) {
    $('#loading-indicator').hide('slow');
    });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    jQuery('.customDropdown').selectpicker();
    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD'
        }
        }, 
        function(start, end, label) {
            $("[name='startDate']").val(start.format('YYYY-MM-DD'));
            $("[name='endDate']").val(end.format('YYYY-MM-DD'));
    });
    
    if ($(".btn-file").length > 0 ) {
        $('document').on('change', '.btn-file :file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
//                if( log ) /*alert(log);*/
            }

        });
    }
    
    jQuery.validator.addMethod("validEmail", function(value, element) {
	    if(value == '') 
	        return true;
	    var temp1;
	    temp1 = true;
	    var ind = value.indexOf('@');
	    var str2=value.substr(ind+1);
	    var str3=str2.substr(0,str2.indexOf('.'));
	    if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
	        return false;
	    var str1=value.substr(0,ind);
	    if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
	        return false;
	    str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
	    temp1 = str.test(value);
	    return temp1;
	}, "Please enter valid email.");
    
    var validator = null;
    if ($("#registerationForm").length > 0) {
        validator = $("#registerationForm").validate({
            errorPlacement: $.noop,
            ignore: [],
            rules: {
                approvalPower: {
                    required: {
                        depends: function() {
                            return $("input[name='iAmA']:checked").val() !== '2';
                        }
                    }
                },
                approval_email: {
                    required: {
                        depends: function() {
                            return $("input[name='approvalPower']:checked").val() === '2';
                        }
                    }
                },
                'industries_you_sell[]': {
                    required: {
                        depends: function() {
                            return $("input[name='iAmA']:checked").val() !== '1';
                        }
                    }
                },
                password: {
                                minlength: 6,
                },
                password_confirmation: {
                                minlength: 6,
                                equalTo: "#password"
                },
                email: {
                	validEmail: true,
            	}
            }
        });
    }
    
});

function validatePhoneNumber (phoneNumber) {
//	var phoneNumberRegex = new RegExp(/^(?(\d{3}))?[- ]?(\d{3})[- ]?(\d{4})$/);
	var phoneNumberRegex = new RegExp(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
	return phoneNumberRegex.test(phoneNumber)
}

function showHideField (radioBtn, trueValue, objToChange, fieldMethod) {
    var radioBtnValue = $(radioBtn).val();
    
    if (fieldMethod === "hide") {
        if (radioBtnValue === trueValue) {
            $(objToChange).slideDown();
        } else {
            $(objToChange).slideUp();
        }
    } else {
        if (radioBtnValue === trueValue) {
            $(objToChange).removeAttr("disabled");
        } else {
            $(objToChange).attr("disabled", "disabled");
        }
    }
}

function getCities (dropdown, dropdownid, selectedValue, grouped) {
    var state = $(dropdown).val();
    $.ajax({
        url: URL+"/ajax/get-cities",
        method: "POST",
        data: {
            stateid: state
        },
        success: function(response) {
            makeDropdownsHTML(response, dropdownid, selectedValue, grouped);
            if (selectedValue && selectedValue !== "") {
                addPinToMapOnRegisterPage();
            }
        }
    });
}

function makeDropdownsHTML(response, dropdown, selectedValue, grouped) {
    if (grouped) {
        var optionsHTML = "",
//            optionsMaskHTML = "",
            groupName = "",
            selectedValuesArray = [];
        if (selectedValue) 
            selectedValuesArray = selectedValue.split(',');
                
        for (var i = 0; i < response.length; i++) {
            if (groupName === "") {
                groupName = response[i].parentName;
                optionsHTML += "<optgroup label='"+groupName+"'>\n";
//                optionsMaskHTML += "<li class='dropdown-header' data-original-index='null'>\n"
//                                        +"<span class='text'>"+groupName+"</span>\n"
//                                    +"</li>";
            }
            
            if (groupName !== response[i].parentName) {
                groupName = response[i].parentName;
                optionsHTML += "</optgroup>\n";
                optionsHTML += "<optgroup label='"+groupName+"'>\n";
            }
            optionsHTML += "<option value='"+response[i].id+"' ";
            optionsHTML += ($.inArray(response[i].id.toString(), selectedValuesArray) > -1 || 
                                $.inArray(parseInt(response[i].id), selectedValuesArray) > -1) ? "selected" : "";
            optionsHTML += ">"+response[i].name+"</option>\n";
        }
    } else {
        var optionsHTML = "<option value=''>- Please Select -</option>\n";
//        var optionsMaskHTML = "<li data-original-index='0' class=''>\n"
//                                +"<a tabindex='0' class='' data-normalized-text='<span class=&quot;text&quot;>- Please Select -</span>'>\n"
//                                    +"<span class='text'>- Please Select -</span>\n"
//                                    +"<span class='glyphicon glyphicon-ok check-mark'></span>\n"
//                                +"</a></li>\n";

        for (var i = 0; i < response.length; i++) {
            optionsHTML += "<option value='"+response[i].id+"' ";
            optionsHTML += (selectedValue == response[i].id) ? "selected" : "";
            optionsHTML += ">"+response[i].name+"</option>\n";
//            optionsMaskHTML += "<li data-original-index='"+(i+1)+"' class=''>\n"
//                                +"<a tabindex='0' class='' data-normalized-text='<span class=&quot;text&quot;>"+response[i].name+"</span>'>\n"
//                                    +"<span class='text'>"+response[i].name+"</span>\n"
//                                    +"<span class='glyphicon glyphicon-ok check-mark'></span>\n"
//                                +"</a></li>\n";
        }
    }
    jQuery("#"+dropdown).html(optionsHTML);
    $('.customDropdown').selectpicker('refresh');

//    jQuery("#"+dropdown+" + .bootstrap-select .dropdown-menu ul").html(optionsMaskHTML);
//    jQuery("#"+dropdown+" + .error + .bootstrap-select .dropdown-menu ul").html(optionsMaskHTML);
//
//    jQuery("#"+dropdown+" + .bootstrap-select .dropdown-toggle").attr("title", selectedValueName);
//    jQuery("#"+dropdown+" + .error + .bootstrap-select .dropdown-toggle").attr("title", selectedValueName);
//
//    jQuery("#"+dropdown+" + .bootstrap-select .dropdown-toggle .filter-option").html(selectedValueName);
//    jQuery("#"+dropdown+" + .error + .bootstrap-select .dropdown-toggle .filter-option").html(selectedValueName);
}

function getSubCategories (dropdown, selectedValue, grouped) {
    var mainCategory = $(dropdown).val();
    
    $.ajax({
        url: URL+"/ajax/get-sub-categories",
        method: "POST",
        data: {
            categoryid: mainCategory
        },
        success: function(response) {
            makeDropdownsHTML(response, "sub_categories", selectedValue, grouped);
        }
    });
}

/*Messages*/

$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
//    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
//        
//        var input = $(this).parents('.input-group').find(':text'),
//            log = numFiles > 1 ? numFiles + ' files selected' : label;
//        
//        if( input.length ) {
//            input.val(log);
//        } else {
//            if( log ) alert(log);
//        }
//        
//    });
});