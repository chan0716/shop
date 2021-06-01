
 function validateform(){  
	var email=document.billing_form.mail.value;  
	var phone=document.billing_form.phone_number.value;  
	var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	if (!testEmail.test(email))
{
	alert('Enter Valid Email Address');
	return false;
}
if(phone.length == 10){
	return true;
}else{
	alert('Enter Valid Phone Number');
	return false;
}
	return true;
	}  

	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
