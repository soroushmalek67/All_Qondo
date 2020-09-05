var code = '';
var x = 0;
$(document).ready(function(){

    $("#join-qondo").click(function(e) {
        var radioValue = $("input[name='iAmA']:checked").val();
		var personnum = '+1' + $("#personnum").val();
		var email = $("#email_register").val();
		
		if($("input[name='iAmA']:checked").length < 1)
		{
			e.preventDefault();alert('Please select type of user');return false;
		}
		
		/*$.get('/checkEmail/'+email, function(data){
			if(data == '1'){
				e.preventDefault();alert('Email you provided already in use.');return false;
			}	
		});*/
        
		if (radioValue == 2 && $("input[name=password_confirmation]").val() != '' && $("input[name=password]").val() != '' && personnum != '') {
		$(this).attr("disabled", "disabled").css({"cursor":"wait"});//alert(personnum);
        //$("#registerationForm").submit(function (e) {
            //alert(personnum);
			personnum = '+1' + $("#personnum").val();//alert(personnum);
			
			if (x == 0) {
                e.preventDefault();
            }
            
            $.ajax({
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'POST',
                url: '/verifyformsubmit',
                data: {'personnum': personnum, 'email': email},
				statusCode: {
					500: function(response) {//alert(JSON.stringify(response));
							swal({
								title: "Please enter valid mobile number ( 5642589).",
								icon: "error",
								button: "Okay"
							});
							$("#join-qondo").css({"cursor":"pointer"}).removeAttr("disabled");
						
					}
				  },
                success: function (data) {//alert(JSON.stringify(data));
                    if (data.error) {
                        swal({
                            title: data.error,
                            icon: "error",
                            button: "Okay"
                        });
						$("#join-qondo").css({"cursor":"pointer"}).removeAttr("disabled");
                    }
                    else {
                        code = data.success;
                        $("#verifycodemodal").modal({
							backdrop: 'static',
							keyboard: false
						});
                    }
                }
            });
        //});
    }
    });

    $("#verifycodebtn").click(function(){
        if($("#sentcode").val() == code)
        {
            swal("Verified! ", "", "success");
            $("#verifycodemodal").modal('hide');
            x++;
            $("#registerationForm, #updateProfileForm").submit();
            code = '';
            x=0;
        }
        else {
            swal({
                title: "Please Enter Correct Verification Code.",
                icon: "error",
                button: "Okay"
            });
        }
    });

    $("#resendcode").click(function(){
        var personnum = '+1' + $("#personnum").val();
		$.ajax({
            type:'GET',
            url:'/resendcode',
			data: {'personnum': personnum},
            success:function(data){
                if(data.success)
                {
                    swal({
                        title: "Code sent successfully.",
                        icon: "success",
                        button: "Okay"
                    });
                    code = data.success;

                }
                else
                {
                    swal({
                        title: "Sorry, something went wrong.",
                        icon: "error",
                        button: "Okay"
                    });

                }
            }
        });
    });
	
	var mobile_number = '+1' + $("#mobile-number").val();
							
	$("#updateProfileForm").submit(function (e) {
		var new_mobile_number = '+1' + $("#mobile-number").val();
		if(new_mobile_number != mobile_number && $("#mobile-auth").val() == '2')
		{
			if (x == 0) {
                e.preventDefault();
				
            }
			
			$.ajax({
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'POST',
                url: '/verifyformsubmit',
                data: {'personnum': new_mobile_number},
                success: function (data) {
                    if (data.error) {
                        swal({
                            title: "Please Enter Mobile Number.",
                            icon: "error",
                            button: "Okay"
                        });
                    }
                    else {
                        code = data.success;
                        $("#verifycodemodal").modal({
							backdrop: 'static',
							keyboard: false
						});
                    }
                }
            });
		}	
	});
	
	$("#verifycodemodal button").click(function(){$("#join-qondo").css({"cursor":"pointer"}).removeAttr("disabled");});
});