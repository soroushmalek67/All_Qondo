function validatePhoneNumber(e) {
    var a = new RegExp(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
    return a.test(e)
}

function hideStep() {
    jQuery(".animated").removeClass("slideOutLeft"), jQuery(".animated").removeClass("slideInRight"), jQuery(".animated").removeClass("slideOutRight"), jQuery(".animated").removeClass("slideInLeft")
}

function initialize() {
//    geocoder = new google.maps.Geocoder;
    var e = new google.maps.LatLng(-34.397, 150.644),
        a = {
            zoom: 8,
            center: e,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    $("#map_canvas").length > 0 && (map = new google.maps.Map(document.getElementById("map_canvas"), a))
}

function codeAddress(e, a) {
    removeMarkerAndCirlce(), a || (a = 5);
    var t = 999.97514509;
    geocoder.geocode({
        address: e
    }, function(e, i) {
        if (i == google.maps.GeocoderStatus.OK) {
            map.setCenter(e[0].geometry.location);
            var n = new google.maps.Marker({
                map: map,
                position: e[0].geometry.location
            });
            null === mapCircle || circleRemovedFromMap === !0 ? (mapCircle = new google.maps.Circle({
                map: map,
                radius: t * a,
                fillColor: "#AA0000"
            }), circleRemovedFromMap = !1) : mapCircle.setOptions({
                radius: t * a
            }), oldMarker = n, mapCircle.bindTo("center", n, "position"), $("[name='lati']").length > 0 && ($("[name='lati']").val(e[0].geometry.location.G), $("[name='longi']").val(e[0].geometry.location.K))
        } else console.log("Geocode was not successful for the following reason: " + i), mapCircle.setMap(null), $("[name='lati']").length > 0 && ($("[name='lati']").val(""), $("[name='longi']").val("")), circleRemovedFromMap = !0
    })
}

function addPinOnMap(e) {
    removeMarkerAndCirlce(), geocoder.geocode({
        address: e
    }, function(e, a) {
        if (a == google.maps.GeocoderStatus.OK) {
            map.setCenter(e[0].geometry.location);
            var t = new google.maps.Marker({
                map: map,
                position: e[0].geometry.location
            });
            oldMarker = t
        } else console.log("Geocode was not successful for the following reason: " + a)
    })
}

function removeMarkerAndCirlce() {
    null !== oldMarker && oldMarker.setMap(null)
}

function showHideField(e, a, t, i) {
    var n = $(e).val();
    "hide" === i ? n === a ? $(t).slideDown() : $(t).slideUp() : n === a ? $(t).removeAttr("disabled") : $(t).attr("disabled", "disabled")
}

function getCities(e, a, t, i) {
    var n = $(e).val();
    $.ajax({
        url: URL + "/ajax/get-cities",
        method: "POST",
        data: {
            stateid: n
        },
        success: function(e) {
            makeDropdownsHTML(e, a, t, i), t && "" !== t && addPinToMapOnRegisterPage()
        }
    })
}

function makeDropdownsHTML(e, a, t, i) {
    if (i) {
        var n = "",
            o = "",
            s = [];
        t && (s = t.split(","));
        for (var r = 0; r < e.length; r++) "" === o && (o = e[r].parentName, n += "<optgroup label='" + o + "'>\n"), o !== e[r].parentName && (o = e[r].parentName, n += "</optgroup>\n", n += "<optgroup label='" + o + "'>\n"), n += "<option value='" + e[r].id + "' ", n += $.inArray(e[r].id.toString(), s) > -1 || $.inArray(parseInt(e[r].id), s) > -1 ? "selected" : "", n += ">" + e[r].name + "</option>\n"
    } else
        for (var n = "<option value=''>- Please Select -</option>\n", r = 0; r < e.length; r++) n += "<option value='" + e[r].id + "' ", n += t == e[r].id ? "selected" : "", n += ">" + e[r].name + "</option>\n";
    jQuery("#" + a).html(n), $(".customDropdown").selectpicker("refresh")
}

function signupShowHideBuyerSupplierFields(e) {
    var a = "1",
        t = "2";
    "3" === $(e).val() && (a = "3", t = "3"), $("[name='approvalPower']").removeAttr("checked"), showHideField("[name='approvalPower']:checked", "2", "#approvalEmail", ""), showHideField(e, a, "[name='approvalPower']", ""), showHideField(e, t, "#supplierServiceInformationSection", "hide")
}

function addPinToMapOnRegisterPage() {
    var e = $("[name='street_address']").val(),
        a = $("[name='state']").val(),
        t = $("[name='city']").val(),
        i = $("[name='postal_code']").val(),
        n = $("[name='country']").val(),
        o = $("[name='service_kilometers']").val(),
        s = "";
    e && "" !== e && (s += e), "" !== t && ("" !== s && (s += ", "), s += $("[name='city'] option:selected").html()), i && "" !== i && ("" !== s && (s += ", "), s += i), "" !== a && ("" !== s && (s += " "), s += $("[name='state'] option:selected").data("stateiso")), "" !== s && (s += " " + n, "" !== o ? codeAddress(s, o) : codeAddress(s, 0))
}

function getSubCategories(e, a, t) {
    var i = $(e).val();
    $.ajax({
        url: URL + "/ajax/get-sub-categories",
        method: "POST",
        data: {
            categoryid: i
        },
        success: function(e) {
            makeDropdownsHTML(e, "sub_categories", a, t)
        }
    })
}

function newsLetter(e) {
    $(e).attr("disabled", "disabled");
    var a = $("#newsletteremail").val(),
        t = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return t.test(a) ? void $.ajax({
        url: URL + "/ajax/newsletter",
        method: "POST",
        data: {
            email: a
        },
        success: function(a) {
            $("#newsletteremail").val(""), $("#response").css("color", "White"), $("#response").html(a), $(e).removeAttr("disabled")
        }
    }) : ($("#response").css("color", "RED"), $("#response").html("Please write a valid email address"), void $(e).removeAttr("disabled"))
}

function loadMoreSuppliers(e) {
    var a = $("input[name='searchKeywork']").val(),
        t = $("input[name='postal_code']").val(),
        i = $("#suppliersOffset").val();
    i % 30 === 0 && ($(e).attr("disabled", "disabled"), $.ajax({
        url: URL + "/ajax/get-suppliers",
        method: "GET",
        data: {
            searchKeywork: a,
            postal_code: t,
            offset: i
        },
        success: function(a) {
            $(e).removeAttr("disabled");
            for (var t = 0, n = "", o = 0; o < a.length; o++) n += makeSuppliserBoxHTML(a[o]), t++;
            $("#suppliersOffset").val(parseInt(i) + t), $("#supplierListCont .row").append(n), 30 > t && $(e).hide()
        }
    }))
}

function makeSuppliserBoxHTML(e) {
    var a = "" == e.company_slug ? "no-slug" : e.company_slug,
        t = URL + "/img/front/placeholder_main_cat.jpg";
    "" != e.company_logo && (t = URL + "/img/compay_logos" + e.created_at_formated + e.company_logo);
    var i = 0;
    null != e.quotesAccepted && (i = e.quotesAccepted);
    var n = "<div class='col-sm-4'>\n<a class='categoryWithImg' href='" + URL + "/supplier-profile/" + a + "/" + e.id + "'>\n<div class='categoryWithImgCaption'>\n" + e.business_name + "<p><small>" + e.city + ", " + e.state + "</small></p>\n<p><small>Accepted Quotes (" + i + ")</small></p>\n</div>\n<img src='" + t + "' alt='" + e.business_name + "'>\n</a>\n</div>\n";
    return n
}

function sendClaimYourProfileEmail(e, a) {
    var t = $("#claimProfileForm").validate({
            errorPlacement: $.noop
        }),
        i = t.element("#supplierEmail");
    if (i) {
        var n = $("#supplierEmail").val();
        $.ajax({
            url: URL + "/ajax/claim-profile",
            method: "POST",
            data: {
                userid: e,
                email: n + "@" + a
            },
            success: function(e) {
                "success" === e ? ($("#supplierEmail").val(""), $(".claimProfileSubmitMessageCont").html("A varification emal is sent on your provided Email Address.")) : $(".claimProfileSubmitMessageCont").html("Something went wrong kindly try again or contact our suppor.")
            }
        }).fail(function() {
            $(".claimProfileSubmitMessageCont").html("Something went wrong kindly try again or contact our suppor.")
        })
    }
}
jQuery(window).ready(function() {
//    alert('hello');
    var e = $(location).attr("href"),
        a = !0;
    e === URL + "/" && (a = !1), e.indexOf("categories") > -1 && (a = !1), a && ($(document).ajaxSend(function(e, a, t) {
        $("#loading-indicator").show("slow")
    }), $(document).ajaxComplete(function(e, a, t) {
        $("#loading-indicator").hide("slow")
    })), $('[data-toggle="tooltip"]').tooltip(), jQuery(".customDropdown").selectpicker();
    var t = new Date;
    t.setDate(t.getDate()), $(".datepicker").datepicker({
        format: "yyyy/mm/dd",
        startDate: t
    }), $("#autocomplete-ajax").autocomplete({
        serviceUrl: URL + "/ajax/autocomplete",
        dataType: "json",
        type: "POST",
        onSelect: function(e) {
            $("#selectedCatID").val(e.data), $("#selectedCatName").val(e.value), $("#selectedOptionType").val(e.optionType), $("#homeSearchForm").submit()
        }
    }), $("#supplierSearchAutoComplete").length > -1 && $("#supplierSearchAutoComplete").autocomplete({
        serviceUrl: URL + "/ajax/autocomplete",
        dataType: "json",
        type: "POST",
        onSelect: function(e) {}
    }), showHideField("[name='when_need_it']:checked", "3", "#whenNeedItDateCont", "hide"), signupShowHideBuyerSupplierFields('[name="iAmA"]:checked');
    var i = document.URL;
    i = i.split("#");
    var n = i[0],
        o = i[1];
    if (n === URL + "/" || n === URL) {
        var s = $(".linkToHowItWorks"),
            r = s.attr("href").split("#")[1],
            l = jQuery("#" + r).offset().top + 30;
        o && jQuery("html, body").delay(1e3).animate({
            scrollTop: l
        }), s.click(function(e) {
            e.preventDefault(), jQuery("html, body").animate({
                scrollTop: l
            })
        })
    }
    $(".btn-file").length > 0 && ($("document").on("change", ".btn-file :file", function() {
        var e = $(this),
            a = e.get(0).files ? e.get(0).files.length : 1,
            t = e.val().replace(/\\/g, "/").replace(/.*\//, "");
        e.trigger("fileselect", [a, t])
    }), $(".btn-file :file").on("fileselect", function(e, a, t) {
        var i = $(this).parents(".input-group").find(":text"),
            n = a > 1 ? a + " files selected" : t;
        i.length ? i.val(n) : n && alert(n)
    })), jQuery.validator.addMethod("validEmail", function(e, a) {
        if ("" == e) return !0;
        var t;
        t = !0;
        var i = e.indexOf("@"),
            n = e.substr(i + 1),
            o = n.substr(0, n.indexOf("."));
        if (o.lastIndexOf("-") == o.length - 1 || o.indexOf("-") != o.lastIndexOf("-")) return !1;
        var s = e.substr(0, i);
        return s.lastIndexOf("_") == s.length - 1 || s.lastIndexOf(".") == s.length - 1 || s.lastIndexOf("-") == s.length - 1 ? !1 : (str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/, t = str.test(e))
    }, "Please enter valid email.");
    var d = null;
    $("#registerationForm").length > 0 && (d = $("#registerationForm").validate({
        errorPlacement: $.noop,
        ignore: [],
        rules: {
            approvalPower: {
                required: {
                    depends: function() {
                        return "2" !== $("input[name='iAmA']:checked").val()
                    }
                }
            },
            approval_email: {
                required: {
                    depends: function() {
                        return "2" === $("input[name='approvalPower']:checked").val()
                    }
                }
            },
            "industries_you_sell[]": {
                required: {
                    depends: function() {
                        return "1" !== $("input[name='iAmA']:checked").val()
                    }
                }
            },
            password: {
                minlength: 6
            },
            password_confirmation: {
                minlength: 6,
                equalTo: "#password"
            },
            email: {
                validEmail: !0
            }
        }
    })), $("#section-1-right").click(function() {
        if ($("[name='iAmA']").length > 0) {
            var e = $("[name='iAmA']:checked").val();
            e && ("2" === e || "3" === e ? ($("#section-2 #section-2-right").css("display", "inline-block"), $("#section-2 input[type='submit']").css("display", "none"), $("[name='main_categories[]']").attr("required", "required"), $("[name='sub_categories[]']").attr("required", "required"), $("[name='service_states[]']").attr("required", "required"), $("[name='service_cities[]']").attr("required", "required"), $("#industriesYouSellAstericBox").css("display", "inline-block")) : ($("#section-2 #section-2-right").css("display", "none"), $("#section-2 input[type='submit']").css("display", "inline-block"), $("[name='main_categories[]']").removeAttr("required"), $("[name='sub_categories[]']").removeAttr("required"), $("[name='service_states[]']").removeAttr("required"), $("[name='service_cities[]']").removeAttr("required"), $("#industriesYouSellAstericBox").css("display", "none")));
            var a = $("[name='phone_number']"),
                t = $("[name='mobile_number']");
            a.removeClass("error"), t.removeClass("error");
            var i = d.element("[name='iAmA']"),
                n = d.element("[name='approvalPower']"),
                o = d.element("[name='first_name']"),
                s = d.element("[name='last_name']"),
                r = d.element("[name='email']"),
                l = d.element("[name='phone_number']"),
                c = validatePhoneNumber(a.val()),
                m = "" !== t.val() ? validatePhoneNumber(t.val()) : !0,
                u = d.element("[name='approval_email']");
            if (!(i && n && o && s && r && l && u && c && m)) return c || a.addClass("error"), m || t.addClass("error"), !1
        }
        hideStep(), jQuery("#section-1").addClass("slideOutLeft").css("display", "none"), jQuery("#section-2").addClass("slideInRight"), jQuery(".requestBusinessHeadingsCont > div").removeClass("active"), jQuery(".requestBusinessHeadingsCont > div:nth-of-type(2)").addClass("active")
    }), $("#section-2-right").click(function() {
        if ($("[name='iAmA']").length > 0) {
            var e = d.element("[name='business_name']"),
                a = d.element("[name='describe_product']"),
                t = d.element("[name='industries_you_buy[]']"),
                i = d.element("[name='industries_you_sell[]']"),
                n = d.element("[name='street_address']"),
                o = d.element("[name='state']"),
                s = d.element("[name='city']"),
                r = d.element("[name='postal_code']"),
                l = d.element("[name='country']"),
                c = d.element("[name='website']");
            if (!(e && a && t && i && n && o && s && r && l && c)) return !1
        }
        hideStep(), jQuery("#section-2").addClass("slideOutLeft").css("display", "none"), jQuery("#section-3").addClass("slideInRight"), jQuery(".requestBusinessHeadingsCont > div").removeClass("active"), jQuery(".requestBusinessHeadingsCont > div:nth-of-type(3)").addClass("active")
    }), $("#section-3-right").click(function() {
        hideStep(), jQuery("#section-3").addClass("slideOutLeft").css("display", "none")
    }), $("#section-3-left").click(function() {
        hideStep(), jQuery("#section-3").addClass("slideOutRight"), jQuery("#section-2").addClass("slideInLeft"), jQuery(".requestBusinessHeadingsCont > div").removeClass("active"), jQuery(".requestBusinessHeadingsCont > div:nth-of-type(2)").addClass("active")
    }), $("#section-2-left").click(function() {
        hideStep(), jQuery("#section-2").addClass("slideOutRight"), jQuery("#section-1").addClass("slideInLeft"), jQuery(".requestBusinessHeadingsCont > div").removeClass("active"), jQuery(".requestBusinessHeadingsCont > div:nth-of-type(1)").addClass("active")
    }), initialize()
});
var geocoder = new google.maps.Geocoder, map, oldMarker = null,
    mapCircle = null,
    circleRemovedFromMap = !1;
$(document).on("change", ".btn-file :file", function() {
    var e = $(this),
        a = e.get(0).files ? e.get(0).files.length : 1,
        t = e.val().replace(/\\/g, "/").replace(/.*\//, "");
    e.trigger("fileselect", [a, t])
}), $(document).ready(function() {
    $(".btn-file :file").on("fileselect", function(e, a, t) {
        var i = $(this).parents(".input-group").find(":text"),
            n = a > 1 ? a + " files selected" : t;
        i.length ? i.val(n) : n && alert(n)
    })
});