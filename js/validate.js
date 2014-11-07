var minYear=1900;
var maxYear = 2010;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}
function isDate1(dtStr, dtCh){
	
	var dtCh = (dtCh == null) ? "-" : dtCh;
	
	var error='';
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		error+="- The date format should be : dd"+dtCh+"mm"+dtCh+"yyyy.\n";
		return error
	}
	if (strMonth.length<1 || month<1 || month>12){
		error+="- Please enter a valid month\n";
		return error
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		error+="- Please enter a valid day.";
		return error
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		error+="- Please enter a valid 4 digit year.\n";
		return error
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		error+="- Please enter a valid date.\n";
		return error
	}
return error;
}


function isValidMobile1(mobileNumber) {
	var error = '';
	var mN = ''; var validChars = '0123456789';
	for(var i = 0; i < mobileNumber.length; i++) {if(validChars.indexOf(mobileNumber.substr(i, 1)) > -1) { mN += mobileNumber.substr(i, 1) } }
	if(mN.length > 0) {
		if(mN.substr(0, 1) == '0') { mN = '44' + mN.substr(1) }
		else if(mN.substr(0, 3) == '440') { mN = '44' + mN.substr(3) }
	}
	else {
		error+="- Please specify a valid mobile number\n";
		return error
	}
	if(mN.length < 9) { 
		if(mN.length > 7) {
			if(!confirm('Please confirm that the mobile number you have\nentered is correct and in international format:.\n\n                      ' + mN + '\n\nIf it is correct click \'OK\', otherwise click \'Cancel\'.')) {
				
				error += 'Sorry but the mobile number you have supplied is too short to be valid.\n'
				return error 	
			}
		}
		else { error += 'Sorry but the mobile number you have supplied is too short to be valid.\n'; 
		 return error }
	}
	if(arguments[1]) { arguments[1].value = mN }
	return error
}

function isUsername(val)
{
	return '';	
}

////// form validation ////////////////////

function formvalid(frmObj) 
{ 
	var i,p,q,nm,test,num,min,max,errors='',args=formvalid.arguments;
	j=0;
	//	/^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)$/;
	var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var regBlank = /[^\s]/;
	var regAlphaNum = /^([a-zA-Z0-9_]+)$/;
	var regDate = /^([0-9_]+-[0-9][0-9]+-[0-9][0-9]+)$/;
	
	var formtype = frmObj.elements;
	//alert (MM_validateForm.arguments[1].name);
	//alert("sss--->"+document.forms[""+args[0]].elements[""+args[0]].value);
	var checked = '';
	for (i=0; i<(formtype.length); i++) 
	{	
		//test1=document.forms[0].elements;
		//alert(formtype[i].name);
		//alert(i);
		
		mesg = formtype[i].title;
		test = formtype[i].lang;
		//alert(test);
		val = formtype[i];
		val_new = formtype[i];
		val_new.style.backgroundColor = '';
		if (val) 
		{	nm=mesg; 
			
			val = val.value;
			if(regBlank.test(val))
			{
				if(test.indexOf('isAlphaNum')!=-1)
				{
				result = trim(val);
				if(result.length==0){
				errors += '- '+nm+' is required.\n'; 
				}else{
					if(!regAlphaNum.test(val))
					{
						errors+='- '+nm+': Only Alpha Numeric and "_" Chars Allowed.\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
				}
				}
				else if(test.indexOf('RisCheck')!=-1)
				{
					
					
						if(!val_new.checked){
						errors += '- '+nm+' is Not Checked.\n';
						}
					
				}
				else if (test.indexOf('isDate2') != -1) 
				{ 
					errors += isDate1(val, '/');
			    }
				else if (test.indexOf('isUsername') != -1) 
				{ 
					errors += isUsername(val);
			    }
				else if (test.indexOf('isDate') != -1) 
				{ 
					errors += isDate1(val);
			    }
				else if (test.indexOf('isMobile') != -1) 
				{ 
					errors += isValidMobile1(val);
				}
				else if (test.indexOf('isEmail')!=-1) 
				{ 
					p=val.indexOf('@');
					s=val.indexOf('.');
			        if (p<1 || p==(val.length-1))
					{
						errors+='- '+nm+' must contain an e-mail Address.\n';
						val_new.style.backgroundColor = '#e2e2e2';
		
					}
					//else if(s<p || s==(val.length-1))
					else if(!regEmail.test(val))
					{
						errors+='- '+nm+' must contain a valid e-mail Address.\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
			     }
				else if (test.indexOf('isAmount')!=-1) 
				{ 		
					
					if (parseFloat(val) < parseFloat(val_new.getAttribute('maxlength')))
					{
						errors+='- You cannot request transfers for amounts under £'+ val_new.getAttribute('maxlength') +'.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isNaN')!=-1) 
				{ 
					if (isNaN(val))
					{
						errors+='- '+nm+' must contain a number.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isMax')!=-1) 
				{ 
					if (getWordCount(val) <= val_new.getAttribute('maxlength'))
					{
						errors+='- '+nm+' must contain more than '+ val_new.getAttribute('maxlength') +' words.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isMin')!=-1) 
				{ 
					if (val.length < val_new.getAttribute('minlength'))
					{
						errors+='- '+nm+' contain at least '+ val_new.getAttribute('minlength') +' Charter. Now only '+ val.length +' Charter\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isUploadP')!=-1) 
				{ 
					var new1 = val.toLowerCase()
					if ((new1.indexOf(".jpg") == -1 && new1.indexOf(".gif") == -1))
					{
						errors+='- '+nm+' Only upload .jpg or .gif.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isUrl')!=-1) 
				{ 
					p=val.indexOf('http://');
					s=val.indexOf('.');
			        if (p<0 || p==(val.length-1))
					{
						errors+='- '+nm+' must be valid URL e.g. http://www.abc.com\n';
						val_new.style.backgroundColor = '#e2e2e2';
		
					}
					else if(s<p || s==(val.length-1))
					{
						errors+='- '+nm+' must be valid URL e.g. http://www.abc.com\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
			     }else if (test.indexOf('isChar')!=-1) 
				 { 
					var first_char;
					first_char= val.charAt(0);
					if(first_char==0||first_char==1||first_char==2||first_char==3||first_char==4||first_char==5||first_char==6||first_char==7||first_char==8||first_char==9){
					 errors+='- '+nm+' must starts with  a char.\n';
					 val_new.style.backgroundColor = '#e2e2e2';
					}
			     }
	   			 else if (test.charAt(0)=='R')
				{
					result = trim(val);
					
				if(result.length==0){
				errors += '- '+nm+' is required.\n'; 
				val_new.style.backgroundColor = '#e2e2e2';
				}
				}
				else if(test.indexOf('isEqual') != -1)
				{
						equal_obj_val = test.substring(7,test.indexOf(":"));
						//alert(equal_obj_val);
						mesg_string =test.substring((test.indexOf(":")+1));
						if(val != formtype[equal_obj_val].value)
						{
							errors+='- '+nm+' must be same to '+mesg_string+'.\n';
							formtype[equal_obj_val].style.backgroundColor = '#e2e2e2';
							val_new.style.backgroundColor = '#e2e2e2';
						}
						
				}
			}
			else if (test.charAt(0) == 'R'){
				errors += '- '+nm+' is required.\n'; 
				val_new.style.backgroundColor = '#e2e2e2';
			}
			
			
		}
		if(errors !="")
		{	if(j<=0)
			{
				
				focusitem = formtype[i];
				j++;
			}
			
		}
	} 
	
//return errors;
  
  if (errors)
  {
	alert('The following error(s) occurred:\n\n'+errors);
	
	focusitem.focus();
	return false;
   }
   else
	return true;

//  document.MM_returnValue = (errors == '');
	
}

function formvalid1() 
{ 
	
	var i,p,q,nm,test,num,min,max,errors='',args=formvalid.arguments;
	j=0;
	//	/^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)$/;
	var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var regBlank = /[^\s]/;
	var regAlphaNum = /^([a-zA-Z0-9_]+)$/;
	var regDate = /^([0-9_]+-[0-9][0-9]+-[0-9][0-9]+)$/;
	var formtype = document.forms[1].elements;
	//alert (MM_validateForm.arguments[1].name);
	//alert("sss--->"+document.forms[""+args[0]].elements[""+args[0]].value);
	var checked = '';
	for (i=0; i<(formtype.length); i++) 
	{	
		//test1=document.forms[0].elements;
		//alert(formtype[i].name);
		//alert(i);
		
		mesg = formtype[i].title;
		test = formtype[i].className;
		//alert(test);
		val = formtype[i];
		val_new = formtype[i];
		val_new.style.backgroundColor = '';
		if (val) 
		{	nm=mesg; 
			
			val = val.value;

			if(regBlank.test(val))
			{
				if(test.indexOf('isEqual')!=-1)
				{
					equal_obj_val = test.substring(8,test.indexOf(":"));
					alert(equal_obj_val);
					mesg_string =test.substring((test.indexOf(":")+1));
					
					if(val != formtype[equal_obj_val].value)
					{
						errors+='- '+nm+' must be same to '+mesg_string+'.\n';
						formtype[equal_obj_val].style.backgroundColor = '#e2e2e2';
						val_new.style.backgroundColor = '#e2e2e2';
					}
				}
				else if(test.indexOf('isAlphaNum')!=-1)
				{
				result = trim(val);
				if(result.length==0){
				errors += '- '+nm+' is required.\n'; 
				}else{
					if(!regAlphaNum.test(val))
					{
						errors+='- '+nm+': Only Alpha Numeric and "_" Chars Allowed.\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
				}
				}
				else if(test.indexOf('RisCheck')!=-1)
				{
					
					
						if(!val_new.checked){
						errors += '- '+nm+' is Not Checked.\n';
						}
					
				}
				else if (test.indexOf('isDate2') != -1) 
				{ 
					/*p=val.indexOf('-');
			        if (p != 2 )
					{
						errors+='- '+nm+' must contain Valid Date DD-MM-YYYY.\n';
		
					}
					else if(!regDate.test(val))
					{
						errors+='- '+nm+' must contain Valid Date DD-MM-YYYY.\n';
					}*/
					
					errors += isDate11(val, '/');
					
			     } 
				else if (test.indexOf('isDate') != -1) 
				{ 
					/*p=val.indexOf('-');
			        if (p != 2 )
					{
						errors+='- '+nm+' must contain Valid Date DD-MM-YYYY.\n';
		
					}
					else if(!regDate.test(val))
					{
						errors+='- '+nm+' must contain Valid Date DD-MM-YYYY.\n';
					}*/
					errors += isDate1(val);
					
			    }
				else if (test.indexOf('isEmail')!=-1) 
				{ 
					p=val.indexOf('@');
					s=val.indexOf('.');
			        if (p<1 || p==(val.length-1))
					{
						errors+='- '+nm+' must contain an e-mail Address.\n';
						val_new.style.backgroundColor = '#e2e2e2';
		
					}
					//else if(s<p || s==(val.length-1))
					else if(!regEmail.test(val))
					{
						errors+='- '+nm+' must contain a valid e-mail Address.\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
			     }
				else if (test.indexOf('isAmount')!=-1) 
				{ 		
					
					if (parseFloat(val) < parseFloat(val_new.getAttribute('maxlength')))
					{
						errors+='- You cannot request transfers for amounts under £'+ val_new.getAttribute('maxlength') +'.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isNaN')!=-1) 
				{ 
					if (isNaN(val))
					{
						errors+='- '+nm+' must contain a number.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isMax')!=-1) 
				{ 
					if (getWordCount(val) <= val_new.getAttribute('maxlength'))
					{
						errors+='- '+nm+' must contain more than '+ val_new.getAttribute('maxlength') +' words.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isMin')!=-1) 
				{ 
					if (val.length < val_new.getAttribute('minlength'))
					{
						errors+='- '+nm+' contain not less than '+ val_new.getAttribute('minlength') +'.\n';
						val_new.style.backgroundColor = '#e2e2e2';		
					}
			    }
				else if (test.indexOf('isUrl')!=-1) 
				{ 
					p=val.indexOf('http://');
					s=val.indexOf('.');
			        if (p<0 || p==(val.length-1))
					{
						errors+='- '+nm+' must be valid URL e.g. http://www.abc.com\n';
						val_new.style.backgroundColor = '#e2e2e2';
		
					}
					else if(s<p || s==(val.length-1))
					{
						errors+='- '+nm+' must be valid URL e.g. http://www.abc.com\n';
						val_new.style.backgroundColor = '#e2e2e2';
					}
			     }else if (test.indexOf('isChar')!=-1) 
				 { 
					var first_char;
					first_char= val.charAt(0);
					if(first_char==0||first_char==1||first_char==2||first_char==3||first_char==4||first_char==5||first_char==6||first_char==7||first_char==8||first_char==9){
					 errors+='- '+nm+' must starts with  a char.\n';
					 val_new.style.backgroundColor = '#e2e2e2';
					}
			     }
	   			 else if (test.charAt(0)=='R')
				{
					result = trim(val);
					
				if(result.length==0){
				errors += '- '+nm+' is required.\n'; 
				val_new.style.backgroundColor = '#e2e2e2';
				}
				} 
			}
			else if (test.charAt(0) == 'R'){
				errors += '- '+nm+' is required.\n'; 
				val_new.style.backgroundColor = '#e2e2e2';
			}
			
			
		}
		if(errors !="")
		{	if(j<=0)
			{
				
				focusitem = formtype[i];
				j++;
			}
			
		}
	} 
	
//return errors;
  
  if (errors)
  {
	alert('The following error(s) occurred:\n\n'+errors);
	
	focusitem.focus();
	return false;
   }
   else
	return true;

//  document.MM_returnValue = (errors == '');
	
}


function trim(inputString) {
   // Removes leading and trailing spaces from the passed string. Also removes
   // consecutive spaces and replaces it with one space. If something besides
   // a string is passed in (null, custom object, etc.) then return the input.
   if (typeof inputString != "string") { return inputString; }
   var retValue = inputString;
   var ch = retValue.substring(0, 1);
   while (ch == " ") { // Check for spaces at the beginning of the string
      retValue = retValue.substring(1, retValue.length);
      ch = retValue.substring(0, 1);
   }
   ch = retValue.substring(retValue.length-1, retValue.length);
   while (ch == " ") { // Check for spaces at the end of the string
      retValue = retValue.substring(0, retValue.length-1);
      ch = retValue.substring(retValue.length-1, retValue.length);
   }
   while (retValue.indexOf("  ") != -1) { // Note that there are two spaces in the string - look for multiple spaces within the string
      retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length); // Again, there are two spaces in each of the strings
   }
   return retValue; // Return the trimmed string back to the doc
} // Ends the "trim" function

//CODE FOR RECURRENCE STUFF

function delete_confirm(form)
{
	if(form.delete1.value == "Delete")
	{	
		if(confirm("Are you sure?"))
		{
			form.submit;
		}
		else
		{
			return false;
		}
	}
}

function confirmation(form)
{
	if(confirm("Are you sure?"))
	{
		form.submit;
	}
	else
	{
		return false;
	}
}

function Decline_confirm(form)
{
	if(form.delete1.value == "Decline")
	{	
		if(confirm("Are you sure?"))
		{
			form.submit;
		}
		else
		{
			return false;
		}
	}
}




function checkall(objForm){

	len = objForm.elements.length;

	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked = objForm.check_all.checked;
			if(objForm.check_all.checked == true)
			{
				if(i == 1) document.adminForm.eid.value = objForm.elements[i].value;
			} 
			else
			{
				document.adminForm.eid.value = '';
			}
		}
	}
}
function checkall1(objForm){

	len = objForm.elements.length;

	var i=0;
	var j=1;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			//objForm.elements[i].checked = objForm.check_all.checked;
			document.getElementById('cid'+j).checked= objForm.check_all.checked;
			if(objForm.check_all.checked == true)
			{
				if(i == 1) document.adminForm.eid.value = objForm.elements[i].value;
			} 
			else
			{
				document.adminForm.eid.value = '';
			}
		}
	j++;
	}
}

function editchk(check,value)
{
	if(check == true)
	{
		document.adminForm.eid.value = value;
	} 
	else
	{
		document.adminForm.eid.value = '';
	}
}

function is_any_check_box_checked(fObj)
{
	found=false;
	for(i=0;i<fObj.length;i++)
	{
		if(fObj[i].type=="checkbox" && fObj[i].checked) 
		{
			found=true;
			break	
		}		
	}
	return found;
}

function editcheckBox(page,name) {

	var val = document.adminForm.eid.value;
	if(!document.adminForm.eid.value){
		alert('Please select a ' + name + ' from the list to edit');
		return false;
	} else {
		if(!document.adminForm.option.value){	
			gopg(page+'?eid='+val);
		}else{
			gopg(page+'eid='+val);
		}
	}
	
}

function deletecheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to delete');
		return false;
	} else {
		gopg(page+'?Delete=yes&cids='+val);
	}
	
}

function unpublishcheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to unpublish');
		return false;
	} else {
		gopg(page+'?Deactivate=yes&cids='+val);
	}
	
}

function unfeaturedcheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to Unfeatured');
		return false;
	} else {
		gopg(page+'?Fno=yes&cids='+val);
	}
	
}

function featuredcheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to Featured');
		return false;
	} else {
		gopg(page+'?Fyes=yes&cids='+val);
	}
	
}

function hotNocheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to Hot No');
		return false;
	} else {
		gopg(page+'?Hot_No=yes&cids='+val);
	}
	
}

function hotYescheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to Hot Yes');
		return false;
	} else {
		gopg(page+'?Hot_Yes=yes&cids='+val);
	}
	
}

function publishcheckBox(page,name) {

	var fObj = document.adminForm;
	var val = getchecked();
	if(is_any_check_box_checked(fObj)==false)
	{
		alert('Please select a ' + name + ' from the list to publish');
		return false;
	} else {
		gopg(page+'?Activate=yes&cids='+val);
	}
	
}

function checkCheckboxes(fObj)
{		
	if(is_any_check_box_checked(fObj)==true)
	{
		if(confirm("Are you sure?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(is_any_check_box_checked(fObj)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}
function checkCheckboxes_album_delete(delete_id,doc_add_auto_id,SET_ID)
{
	//alert("doc_add_auto_id"+doc_add_auto_id);
	//alert("SET_ID"+SET_ID);
	location.href='album-photos.php?SET_ID='+SET_ID+'&image_name[]='+doc_add_auto_id+'&act=deletephoto';
}
function ValidateInfo()
{	with(window.document.ChangePasswordForm)
	{	
		
		if(oldpassword_skip.value=="")
		{	alert("Enter Old Password !"); 
			oldpassword_skip.focus();return false;
		}

		if(password.value=="")
		{	alert("Enter Password !"); 
			password.focus();return false;
		}
		if(confirmpassword_skip.value=="")
		{	alert("Enter Confirm Password !"); 
			confirmpassword_skip.focus();return false;
		}
		if(password.value!=confirmpassword_skip.value)
		{	alert("New Password doesn't match confirm password !"); 
			confirmpassword_skip.focus();return false;
		}
		
		return true;
	}
}

function getWordCount(val) {
	val = val.toString()
	if(val.length == 0) return 0
	var wordslen = val.split(' ')
	return wordslen.length
}


function openwindow(type)
{
	window.open('Sendmail.php?type='+type,'aa','width=400,height=400')
}

function getchecked()
{
	var arr = '';
	if(document.forms['adminForm'].elements['chk[]']) {
		if(document.forms['adminForm'].elements['chk[]'].length)
		{
			for(i = 0; i < document.forms['adminForm'].elements['chk[]'].length;i++)
			{
				if(document.forms['adminForm'].elements['chk[]'][i].checked == true)
				{
					  arr += document.forms['adminForm'].elements['chk[]'][i].value+',';
				}
			}
		}
		else
		{
			 arr += document.forms['adminForm'].elements['chk[]'].value;// + ',';
		}
		return arr;
	}
}
function formSubmit1(task){
	document.adminForm.task.value = task;
	document.adminForm.submit();
	return true;
}
function formSubmit(task)
{
	document.adminForm.task.value = task;
	var frmObj = document.adminForm;
	if(formvalid(frmObj))
	{
		frmObj.submit();
		return true;
	}
	else
	{
		return false;
	}
}

function publish(id,val)
{
	document.getElementById('cid'+id).checked=true;
	var cids = getchecked();
	gopg('?'+val+'=yes&cids='+cids);
}

function hot(id,val)
{
	document.getElementById('cid'+id).checked=true;
	var cids = getchecked();
	gopg('?'+val+'=yes&cids='+cids);
}

function trcolor(id,val)
{
	if(val) {
		id.className='trcolor-hover'
	} else {
		id.className='trcolor'
	}
}

function submit_once(but, frmObj)
{
	if(formvalid(frmObj))
	{
		frmObj.submit();
		but.disabled = true;
		return true;
	}
	else
	{
		return false;
	}
}
function gopg(pagename)
{
	window.location.href=pagename;
}

function Get_Cookie( name ) {

var start = document.cookie.indexOf( name + "=" );
var len = start + name.length + 1;
if ( ( !start ) &&
( name != document.cookie.substring( 0, name.length ) ) )
{
return null;
}
if ( start == -1 ) return null;
var end = document.cookie.indexOf( ";", len );
if ( end == -1 ) end = document.cookie.length;
return unescape( document.cookie.substring( len, end ) );
}


//Drop Down

var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose(){
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime(){
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime(){
	if(closetimer){
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function testURL(Ctrl) {
	if (document.getElementById(Ctrl).value.indexOf("http://",0) == -1) {
		validatePrompt (Ctrl, "Please provide a valid URL")
		return (false);
	} else
		return (true);
}
function checkval(a, is){
	var b="";
	if(a){
		b=a.toLowerCase();
		c=b.split(' ').join('');
	}
	document.getElementById(is).value=c;
}
function toptabs(menu){
	for(var i=1; i<=3; i++){
		document.getElementById("top"+i+'1').style.background = '';	
		document.getElementById("top"+i).style.display='none';	
	}
	document.getElementById('load').style.display = 'block';
	setTimeout(function(){document.getElementById(menu+'1').style.background = 'url(images/tabsbg.gif) repeat-x';document.getElementById('load').style.display = 'none';document.getElementById(menu).style.display = 'block';},500);
}
//window.onload=function(){ for(var i=1; i<=3; i++){document.getElementById("top"+i).style.display='none';}document.getElementById('load').style.display = 'block';setTimeout(function(){document.getElementById('top11').style.background = 'url(images/tabsbg.gif) repeat-x';document.getElementById('load').style.display = 'none';document.getElementById('top1').style.display = 'block';},500);}

function parentchi(p, c, val){
	if(val==1){
		document.getElementById(p).className='effect_r_img';	
		document.getElementById(c).className='effect_text_w';	
	}else{
		document.getElementById(p).className='effect_w_img';	
		document.getElementById(c).className='effect_text';	
	}
}
function top10(tid){
	document.getElementById('Layer1').style.display='block';	
	setTimeout(function(){var a=document.getElementById('hval').value.split(",");
	for(var t=0; t<a.length; t++){
		document.getElementById('top101'+a[t]).style.display='none';		
	}
	document.getElementById(tid).style.display='block';document.getElementById('Layer1').style.display='none';},400);
}

function formvalid21(fm){
		var a=0;
		var b='';
		if(!document.adminForm.name.value){
			document.adminForm.name.focus();
			b = "Please enter the name!\n";
			a=eval(a+1);
		}
		if(!document.adminForm.email.value){
			document.adminForm.email.focus();
			b  = b + "Please enter the email!\n";
			a=eval(a+1);
		}
		if(fm=='cu'){
			if(!document.adminForm.subject.value){
				document.adminForm.subject.focus();
				b = b + "Please enter the subject!\n";
				a=eval(a+1);
			}
		}
		if(!document.adminForm.body.value){
			document.adminForm.body.focus();
			b = b + "Please enter the comments!\n";
			a=eval(a+1);
		}
		if(!document.adminForm.code.value){
			document.adminForm.code.focus();
			b = b + "Please enter the security code!\n";
			a=eval(a+1);
		}
		if(!a){
			return true;	
		}else{
			alert(b);
			return false;
		}
}
function subm(){
	if(document.getElementById('Amount').value=='Amount'){
		alert("Please enter amount!");
		document.getElementById('Amount').focus();
		return false;
	}	
	if(document.getElementById('From').value==''){
		alert("From This Currency!");
		document.getElementById('From').focus();
		return false;
	}
	if(document.getElementById('To').value==''){
		alert("To This Currency!");
		document.getElementById('To').focus();
		return false;
	}
	if(document.getElementById('Amount').value!='Amount'){
		var val ="http://www.xe.com/ucc/convert.cgi?Amount="+document.getElementById('Amount').value+'&From='+document.getElementById('From').value+'&To='+document.getElementById('To').value;
		window.open (val , "mywindow","location=1,status=1,scrollbars=1, width=630,height=500");
		mywindow.moveTo(500,500);
	}
	return false;
}
function deta(a){
	if(document.getElementById('a1').value){
		document.getElementById(document.getElementById('a1').value).style.display='none';
		document.getElementById(a).style.display='block';
		document.getElementById('a1').value=a;
	}else{
		document.getElementById(a).style.display='block';
		document.getElementById('a1').value=a;
	}
}

function download(SITE_PATH, fname){
		location.href=SITE_PATH + "download.php?files="+fname;
}


/*For callender*/
/************************************************************************************************************
JS Calendar
Copyright (C) September 2006  DTHMLGoodies.com, Alf Magne Kalleland

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

Dhtmlgoodies.com., hereby disclaims all copyright interest in this script
written by Alf Magne Kalleland.

Alf Magne Kalleland, 2006
Owner of DHTMLgoodies.com

************************************************************************************************************/

/* Update log:
(C) www.dhtmlgoodies.com, September 2005

Version 1.2, November 8th - 2005 - Added <iframe> background in IE
Version 1.3, November 12th - 2005 - Fixed top bar position in Opera 7
Version 1.4, December 28th - 2005 - Support for Spanish and Portuguese
Version 1.5, January  18th - 2006 - Fixed problem with next-previous buttons after a month has been selected from dropdown
Version 1.6, February 22nd - 2006 - Added variable which holds the path to images.
									Format todays date at the bottom by use of the todayStringFormat variable
									Pick todays date by clicking on todays date at the bottom of the calendar
Version 2.0	 May, 25th - 2006	  - Added support for time(hour and minutes) and changing year and hour when holding mouse over + and - options. (i.e. instead of click)
Version 2.1	 July, 2nd - 2006	  - Added support for more date formats(example: d.m.yyyy, i.e. one letter day and month).

// Modifications by Gregg Buntin
Version 2.1.1 8/9/2007  gfb   - Add switch to turn off Year Span Selection
                                This allows me to only have this year & next year in the drop down
                                     
Version 2.1.2 8/30/2007 gfb  - Add switch to start week on Sunday
                               Add switch to turn off week number display
                               Fix bug when using on an HTTPS page

*/
var turnOffYearSpan = false;     // true = Only show This Year and Next, false = show +/- 5 years
var weekStartsOnSunday = false;  // true = Start the week on Sunday, false = start the week on Monday
var showWeekNumber = true;  // true = show week number,  false = do not show week number

var languageCode = 'en';	// Possible values: 	en,ge,no,nl,es,pt-br,fr
							// en = english, ge = german, no = norwegian,nl = dutch, es = spanish, pt-br = portuguese, fr = french, da = danish, hu = hungarian(Use UTF-8 doctype for hungarian)

var calendar_display_time = true;

// Format of current day at the bottom of the calendar
// [todayString] = the value of todayString
// [dayString] = day of week (examle: mon, tue, wed...)
// [UCFdayString] = day of week (examle: Mon, Tue, Wed...) ( First letter in uppercase)
// [day] = Day of month, 1..31
// [monthString] = Name of current month
// [year] = Current year
var todayStringFormat = '[todayString] [UCFdayString]. [day]. [monthString] [year]';
var pathToImages = 'images/';	// Relative to your HTML file

var speedOfSelectBoxSliding = 200;	// Milliseconds between changing year and hour when holding mouse over "-" and "+" - lower value = faster
var intervalSelectBox_minutes = 5;	// Minute select box - interval between each option (5 = default)

var calendar_offsetTop = 0;		// Offset - calendar placement - You probably have to modify this value if you're not using a strict doctype
var calendar_offsetLeft = 0;	// Offset - calendar placement - You probably have to modify this value if you're not using a strict doctype
var calendarDiv = false;

var MSIE = false;
var Opera = false;
if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0)MSIE=true;
if(navigator.userAgent.indexOf('Opera')>=0)Opera=true;


switch(languageCode){
	case "en":	/* English */
		var monthArray = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		var monthArrayShort = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		var dayArray = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
		var weekString = 'Week';
		var todayString = '';
		break;
	case "ge":	/* German */
		var monthArray = ['Januar','Februar','M?rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
		var monthArrayShort = ['Jan','Feb','Mar','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'];
		var dayArray = ['Mon','Die','Mit','Don','Fre','Sam','Son'];
		var weekString = 'Woche';
		var todayString = 'Heute';
		break;
	case "no":	/* Norwegian */
		var monthArray = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];
		var monthArrayShort = ['Jan','Feb','Mar','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Des'];
		var dayArray = ['Man','Tir','Ons','Tor','Fre','L&oslash;r','S&oslash;n'];
		var weekString = 'Uke';
		var todayString = 'Dagen i dag er';
		break;
	case "nl":	/* Dutch */
		var monthArray = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
		var monthArrayShort = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec'];
		var dayArray = ['Ma','Di','Wo','Do','Vr','Za','Zo'];
		var weekString = 'Week';
		var todayString = 'Vandaag';
		break;
	case "es": /* Spanish */
		var monthArray = ['Enero','Febrero','Marzo','April','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
		var monthArrayShort =['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
		var dayArray = ['Lun','Mar','Mie','Jue','Vie','Sab','Dom'];
		var weekString = 'Semana';
		var todayString = 'Hoy es';
		break;
	case "pt-br":  /* Brazilian portuguese (pt-br) */
		var monthArray = ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
		var monthArrayShort = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
		var dayArray = ['Seg','Ter','Qua','Qui','Sex','S&aacute;b','Dom'];
		var weekString = 'Sem.';
		var todayString = 'Hoje &eacute;';
		break;
	case "fr":      /* French */
		var monthArray = ['Janvier','F?vrier','Mars','Avril','Mai','Juin','Juillet','Ao?t','Septembre','Octobre','Novembre','D?cembre'];
		var monthArrayShort = ['Jan','Fev','Mar','Avr','Mai','Jun','Jul','Aou','Sep','Oct','Nov','Dec'];
		var dayArray = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
		var weekString = 'Sem';
		var todayString = "Aujourd'hui";
		break;
	case "da": /*Danish*/
		var monthArray = ['januar','februar','marts','april','maj','juni','juli','august','september','oktober','november','december'];
		var monthArrayShort = ['jan','feb','mar','apr','maj','jun','jul','aug','sep','okt','nov','dec'];
		var dayArray = ['man','tirs','ons','tors','fre','l&oslash;r','s&oslash;n'];
		var weekString = 'Uge';
		var todayString = 'I dag er den';
		break;
	case "hu":	/* Hungarian  - Remember to use UTF-8 encoding, i.e. the <meta> tag */
		var monthArray = ['Január','Február','Március','??prilis','Május','Június','Július','Augusztus','Szeptember','Október','November','December'];
		var monthArrayShort = ['Jan','Feb','Márc','??pr','Máj','Jún','Júl','Aug','Szep','Okt','Nov','Dec'];
		var dayArray = ['Hé','Ke','Sze','Cs','Pé','Szo','Vas'];
		var weekString = 'Hét';
		var todayString = 'Mai nap';
		break;
	case "it":	/* Italian*/
		var monthArray = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
		var monthArrayShort = ['Gen','Feb','Mar','Apr','Mag','Giu','Lugl','Ago','Set','Ott','Nov','Dic'];
		var dayArray = ['Lun',';Mar','Mer','Gio','Ven','Sab','Dom'];
		var weekString = 'Settimana';
		var todayString = 'Oggi &egrave; il';
		break;
	case "sv":	/* Swedish */
		var monthArray = ['Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December'];
		var monthArrayShort = ['Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'];
		var dayArray = ['M&aring;n','Tis','Ons','Tor','Fre','L&ouml;r','S&ouml;n'];
		var weekString = 'Vecka';
		var todayString = 'Idag &auml;r det den';
		break;
	case "cz":	/* Czech */
		var monthArray = ['leden','&#250;nor','b&#345;ezen','duben','kv&#283;ten','&#269;erven','&#269;ervenec','srpen','z&#225;&#345;&#237;','&#345;&#237;jen','listopad','prosinec'];
		var monthArrayShort = ['led','&#250;n','b&#345;','dub','kv&#283;','&#269;er','&#269;er-ec','srp','z&#225;&#345;','&#345;&#237;j','list','pros'];
		var dayArray = ['Pon','&#218;t','St','&#268;t','P&#225;','So','Ne'];
		var weekString = 't&#253;den';
		var todayString = '';
		break;	
}

if (weekStartsOnSunday) {
   var tempDayName = dayArray[6];
   for(var theIx = 6; theIx > 0; theIx--) {
      dayArray[theIx] = dayArray[theIx-1];
   }
   dayArray[0] = tempDayName;
}



var daysInMonthArray = [31,28,31,30,31,30,31,31,30,31,30,31];
var currentMonth;
var currentYear;
var currentHour;
var currentMinute;
var calendarContentDiv;
var returnDateTo;
var returnFormat;
var activeSelectBoxMonth;
var activeSelectBoxYear;
var activeSelectBoxHour;
var activeSelectBoxMinute;

var iframeObj = false;
//// fix for EI frame problem on time dropdowns 09/30/2006
var iframeObj2 =false;
function EIS_FIX_EI1(where2fixit)
{

		if(!iframeObj2)return;
		iframeObj2.style.display = 'block';
		iframeObj2.style.height =document.getElementById(where2fixit).offsetHeight+1;
		iframeObj2.style.width=document.getElementById(where2fixit).offsetWidth;
		iframeObj2.style.left=getleftPos(document.getElementById(where2fixit))+1-calendar_offsetLeft;
		iframeObj2.style.top=getTopPos(document.getElementById(where2fixit))-document.getElementById(where2fixit).offsetHeight-calendar_offsetTop;
}

function EIS_Hide_Frame()
{		if(iframeObj2)iframeObj2.style.display = 'none';}
//// fix for EI frame problem on time dropdowns 09/30/2006
var returnDateToYear;
var returnDateToMonth;
var returnDateToDay;
var returnDateToHour;
var returnDateToMinute;

var inputYear;
var inputMonth;
var inputDay;
var inputHour;
var inputMinute;
var calendarDisplayTime = false;

var selectBoxHighlightColor = '#D60808'; // Highlight color of select boxes
var selectBoxRolloverBgColor = '#E2EBED'; // Background color on drop down lists(rollover)

var selectBoxMovementInProgress = false;
var activeSelectBox = false;

function cancelCalendarEvent()
{
	return false;
}
function isLeapYear(inputYear)
{
	if(inputYear%400==0||(inputYear%4==0&&inputYear%100!=0)) return true;
	return false;

}
var activeSelectBoxMonth = false;
var activeSelectBoxDirection = false;

function highlightMonthYear()
{
	if(activeSelectBoxMonth)activeSelectBoxMonth.className='';
	activeSelectBox = this;


	if(this.className=='monthYearActive'){
		this.className='';
	}else{
		this.className = 'monthYearActive';
		activeSelectBoxMonth = this;
	}

	if(this.innerHTML.indexOf('-')>=0 || this.innerHTML.indexOf('+')>=0){
		if(this.className=='monthYearActive')
			selectBoxMovementInProgress = true;
		else
			selectBoxMovementInProgress = false;
		if(this.innerHTML.indexOf('-')>=0)activeSelectBoxDirection = -1; else activeSelectBoxDirection = 1;

	}else selectBoxMovementInProgress = false;

}

function showMonthDropDown()
{
	if(document.getElementById('monthDropDown').style.display=='block'){
		document.getElementById('monthDropDown').style.display='none';
		//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	}else{
		document.getElementById('monthDropDown').style.display='block';
		document.getElementById('yearDropDown').style.display='none';
		document.getElementById('hourDropDown').style.display='none';
		document.getElementById('minuteDropDown').style.display='none';
			if (MSIE)
		{ EIS_FIX_EI1('monthDropDown')}
		//// fix for EI frame problem on time dropdowns 09/30/2006

	}
}

function showYearDropDown()
{
	if(document.getElementById('yearDropDown').style.display=='block'){
		document.getElementById('yearDropDown').style.display='none';
		//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	}else{
		document.getElementById('yearDropDown').style.display='block';
		document.getElementById('monthDropDown').style.display='none';
		document.getElementById('hourDropDown').style.display='none';
		document.getElementById('minuteDropDown').style.display='none';
			if (MSIE)
		{ EIS_FIX_EI1('yearDropDown')}
		//// fix for EI frame problem on time dropdowns 09/30/2006

	}

}
function showHourDropDown()
{
	if(document.getElementById('hourDropDown').style.display=='block'){
		document.getElementById('hourDropDown').style.display='none';
		//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	}else{
		document.getElementById('hourDropDown').style.display='block';
		document.getElementById('monthDropDown').style.display='none';
		document.getElementById('yearDropDown').style.display='none';
		document.getElementById('minuteDropDown').style.display='none';
				if (MSIE)
		{ EIS_FIX_EI1('hourDropDown')}
		//// fix for EI frame problem on time dropdowns 09/30/2006
	}

}
function showMinuteDropDown()
{
	if(document.getElementById('minuteDropDown').style.display=='block'){
		document.getElementById('minuteDropDown').style.display='none';
		//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	}else{
		document.getElementById('minuteDropDown').style.display='block';
		document.getElementById('monthDropDown').style.display='none';
		document.getElementById('yearDropDown').style.display='none';
		document.getElementById('hourDropDown').style.display='none';
				if (MSIE)
		{ EIS_FIX_EI1('minuteDropDown')}
		//// fix for EI frame problem on time dropdowns 09/30/2006
	}

}

function selectMonth()
{
	document.getElementById('calendar_month_txt').innerHTML = this.innerHTML
	currentMonth = this.id.replace(/[^\d]/g,'');

	document.getElementById('monthDropDown').style.display='none';
	//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	for(var no=0;no<monthArray.length;no++){
		document.getElementById('monthDiv_'+no).style.color='';
	}
	this.style.color = selectBoxHighlightColor;
	activeSelectBoxMonth = this;
	writeCalendarContent();

}

function selectHour()
{
	document.getElementById('calendar_hour_txt').innerHTML = this.innerHTML
	currentHour = this.innerHTML.replace(/[^\d]/g,'');
	document.getElementById('hourDropDown').style.display='none';
	//// fix for EI frame problem on time dropdowns 09/30/2006
	EIS_Hide_Frame();
	if(activeSelectBoxHour){
		activeSelectBoxHour.style.color='';
	}
	activeSelectBoxHour=this;
	this.style.color = selectBoxHighlightColor;
}

function selectMinute()
{
	document.getElementById('calendar_minute_txt').innerHTML = this.innerHTML
	currentMinute = this.innerHTML.replace(/[^\d]/g,'');
	document.getElementById('minuteDropDown').style.display='none';
	//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	if(activeSelectBoxMinute){
		activeSelectBoxMinute.style.color='';
	}
	activeSelectBoxMinute=this;
	this.style.color = selectBoxHighlightColor;
}


function selectYear()
{
	document.getElementById('calendar_year_txt').innerHTML = this.innerHTML
	currentYear = this.innerHTML.replace(/[^\d]/g,'');
	document.getElementById('yearDropDown').style.display='none';
	//// fix for EI frame problem on time dropdowns 09/30/2006
				EIS_Hide_Frame();
	if(activeSelectBoxYear){
		activeSelectBoxYear.style.color='';
	}
	activeSelectBoxYear=this;
	this.style.color = selectBoxHighlightColor;
	writeCalendarContent();

}

function switchMonth()
{
	if(this.src.indexOf('left')>=0){
		currentMonth=currentMonth-1;;
		if(currentMonth<0){
			currentMonth=11;
			currentYear=currentYear-1;
		}
	}else{
		currentMonth=currentMonth+1;;
		if(currentMonth>11){
			currentMonth=0;
			currentYear=currentYear/1+1;
		}
	}

	writeCalendarContent();


}

function createMonthDiv(){
	var div = document.createElement('DIV');
	div.className='monthYearPicker';
	div.id = 'monthPicker';

	for(var no=0;no<monthArray.length;no++){
		var subDiv = document.createElement('DIV');
		subDiv.innerHTML = monthArray[no];
		subDiv.onmouseover = highlightMonthYear;
		subDiv.onmouseout = highlightMonthYear;
		subDiv.onclick = selectMonth;
		subDiv.id = 'monthDiv_' + no;
		subDiv.style.width = '56px';
		subDiv.onselectstart = cancelCalendarEvent;
		div.appendChild(subDiv);
		if(currentMonth && currentMonth==no){
			subDiv.style.color = selectBoxHighlightColor;
			activeSelectBoxMonth = subDiv;
		}

	}
	return div;

}

function changeSelectBoxYear(e,inputObj)
{
	if(!inputObj)inputObj =this;
	var yearItems = inputObj.parentNode.getElementsByTagName('DIV');
	if(inputObj.innerHTML.indexOf('-')>=0){
		var startYear = yearItems[1].innerHTML/1 -1;
		if(activeSelectBoxYear){
			activeSelectBoxYear.style.color='';
		}
	}else{
		var startYear = yearItems[1].innerHTML/1 +1;
		if(activeSelectBoxYear){
			activeSelectBoxYear.style.color='';

		}
	}

	for(var no=1;no<yearItems.length-1;no++){
		yearItems[no].innerHTML = startYear+no-1;
		yearItems[no].id = 'yearDiv' + (startYear/1+no/1-1);

	}
	if(activeSelectBoxYear){
		activeSelectBoxYear.style.color='';
		if(document.getElementById('yearDiv'+currentYear)){
			activeSelectBoxYear = document.getElementById('yearDiv'+currentYear);
			activeSelectBoxYear.style.color=selectBoxHighlightColor;;
		}
	}
}
function changeSelectBoxHour(e,inputObj)
{
	if(!inputObj)inputObj = this;

	var hourItems = inputObj.parentNode.getElementsByTagName('DIV');
	if(inputObj.innerHTML.indexOf('-')>=0){
		var startHour = hourItems[1].innerHTML/1 -1;
		if(startHour<0)startHour=0;
		if(activeSelectBoxHour){
			activeSelectBoxHour.style.color='';
		}
	}else{
		var startHour = hourItems[1].innerHTML/1 +1;
		if(startHour>14)startHour = 14;
		if(activeSelectBoxHour){
			activeSelectBoxHour.style.color='';

		}
	}
	var prefix = '';
	for(var no=1;no<hourItems.length-1;no++){
		if((startHour/1 + no/1) < 11)prefix = '0'; else prefix = '';
		hourItems[no].innerHTML = prefix + (startHour+no-1);

		hourItems[no].id = 'hourDiv' + (startHour/1+no/1-1);

	}
	if(activeSelectBoxHour){
		activeSelectBoxHour.style.color='';
		if(document.getElementById('hourDiv'+currentHour)){
			activeSelectBoxHour = document.getElementById('hourDiv'+currentHour);
			activeSelectBoxHour.style.color=selectBoxHighlightColor;;
		}
	}
}

function updateYearDiv()
{
    var yearSpan = 5;
    if (turnOffYearSpan) {
       yearSpan = 0;
    }
	var div = document.getElementById('yearDropDown');
	var yearItems = div.getElementsByTagName('DIV');
	for(var no=1;no<yearItems.length-1;no++){
		yearItems[no].innerHTML = currentYear/1 -yearSpan + no;
		if(currentYear==(currentYear/1 -yearSpan + no)){
			yearItems[no].style.color = selectBoxHighlightColor;
			activeSelectBoxYear = yearItems[no];
		}else{
			yearItems[no].style.color = '';
		}
	}
}

function updateMonthDiv()
{
	for(no=0;no<12;no++){
		document.getElementById('monthDiv_' + no).style.color = '';
	}
	document.getElementById('monthDiv_' + currentMonth).style.color = selectBoxHighlightColor;
	activeSelectBoxMonth = 	document.getElementById('monthDiv_' + currentMonth);
}


function updateHourDiv()
{
	var div = document.getElementById('hourDropDown');
	var hourItems = div.getElementsByTagName('DIV');

	var addHours = 0;
	if((currentHour/1 -6 + 1)<0){
		addHours = 	(currentHour/1 -6 + 1)*-1;
	}
	for(var no=1;no<hourItems.length-1;no++){
		var prefix='';
		if((currentHour/1 -6 + no + addHours) < 10)prefix='0';
		hourItems[no].innerHTML = prefix +  (currentHour/1 -6 + no + addHours);
		if(currentHour==(currentHour/1 -6 + no)){
			hourItems[no].style.color = selectBoxHighlightColor;
			activeSelectBoxHour = hourItems[no];
		}else{
			hourItems[no].style.color = '';
		}
	}
}

function updateMinuteDiv()
{
	for(no=0;no<60;no+=intervalSelectBox_minutes){
		var prefix = '';
		if(no<10)prefix = '0';

		document.getElementById('minuteDiv_' + prefix + no).style.color = '';
	}
	if(document.getElementById('minuteDiv_' + currentMinute)){
		document.getElementById('minuteDiv_' + currentMinute).style.color = selectBoxHighlightColor;
		activeSelectBoxMinute = document.getElementById('minuteDiv_' + currentMinute);
	}
}



function createYearDiv()
{

	if(!document.getElementById('yearDropDown')){
		var div = document.createElement('DIV');
		div.className='monthYearPicker';
	}else{
		var div = document.getElementById('yearDropDown');
		var subDivs = div.getElementsByTagName('DIV');
		for(var no=0;no<subDivs.length;no++){
			subDivs[no].parentNode.removeChild(subDivs[no]);
		}
	}


	var d = new Date();
	if(currentYear){
		d.setFullYear(currentYear);
	}

	var startYear = d.getFullYear()/1 - 5;

    var yearSpan = 10;
	if (! turnOffYearSpan) {
    	var subDiv = document.createElement('DIV');
    	subDiv.innerHTML = '&nbsp;&nbsp;- ';
    	subDiv.onclick = changeSelectBoxYear;
    	subDiv.onmouseover = highlightMonthYear;
    	subDiv.onmouseout = function(){ selectBoxMovementInProgress = false;};
    	subDiv.onselectstart = cancelCalendarEvent;
    	div.appendChild(subDiv);
    } else {
       startYear = d.getFullYear()/1 - 0;
       yearSpan = 2;
    }

	for(var no=startYear;no<(startYear+yearSpan);no++){
		var subDiv = document.createElement('DIV');
		subDiv.innerHTML = no;
		subDiv.onmouseover = highlightMonthYear;
		subDiv.onmouseout = highlightMonthYear;
		subDiv.onclick = selectYear;
		subDiv.id = 'yearDiv' + no;
		subDiv.onselectstart = cancelCalendarEvent;
		div.appendChild(subDiv);
		if(currentYear && currentYear==no){
			subDiv.style.color = selectBoxHighlightColor;
			activeSelectBoxYear = subDiv;
		}
	}
	if (! turnOffYearSpan) {
    	var subDiv = document.createElement('DIV');
    	subDiv.innerHTML = '&nbsp;&nbsp;+ ';
    	subDiv.onclick = changeSelectBoxYear;
    	subDiv.onmouseover = highlightMonthYear;
    	subDiv.onmouseout = function(){ selectBoxMovementInProgress = false;};
    	subDiv.onselectstart = cancelCalendarEvent;
    	div.appendChild(subDiv);
	}
	return div;
}

/* This function creates the hour div at the bottom bar */

function slideCalendarSelectBox()
{
	if(selectBoxMovementInProgress){
		if(activeSelectBox.parentNode.id=='hourDropDown'){
			changeSelectBoxHour(false,activeSelectBox);
		}
		if(activeSelectBox.parentNode.id=='yearDropDown'){
			changeSelectBoxYear(false,activeSelectBox);
		}

	}
	setTimeout('slideCalendarSelectBox()',speedOfSelectBoxSliding);

}

function createHourDiv()
{
	if(!document.getElementById('hourDropDown')){
		var div = document.createElement('DIV');
		div.className='monthYearPicker';
	}else{
		var div = document.getElementById('hourDropDown');
		var subDivs = div.getElementsByTagName('DIV');
		for(var no=0;no<subDivs.length;no++){
			subDivs[no].parentNode.removeChild(subDivs[no]);
		}
	}

	if(!currentHour)currentHour=0;
	var startHour = currentHour/1;
	if(startHour>14)startHour=14;

	var subDiv = document.createElement('DIV');
	subDiv.innerHTML = '&nbsp;&nbsp;- ';
	subDiv.onclick = changeSelectBoxHour;
	subDiv.onmouseover = highlightMonthYear;
	subDiv.onmouseout = function(){ selectBoxMovementInProgress = false;};
	subDiv.onselectstart = cancelCalendarEvent;
	div.appendChild(subDiv);

	for(var no=startHour;no<startHour+10;no++){
		var prefix = '';
		if(no/1<10)prefix='0';
		var subDiv = document.createElement('DIV');
		subDiv.innerHTML = prefix + no;
		subDiv.onmouseover = highlightMonthYear;
		subDiv.onmouseout = highlightMonthYear;
		subDiv.onclick = selectHour;
		subDiv.id = 'hourDiv' + no;
		subDiv.onselectstart = cancelCalendarEvent;
		div.appendChild(subDiv);
		if(currentYear && currentYear==no){
			subDiv.style.color = selectBoxHighlightColor;
			activeSelectBoxYear = subDiv;
		}
	}
	var subDiv = document.createElement('DIV');
	subDiv.innerHTML = '&nbsp;&nbsp;+ ';
	subDiv.onclick = changeSelectBoxHour;
	subDiv.onmouseover = highlightMonthYear;
	subDiv.onmouseout = function(){ selectBoxMovementInProgress = false;};
	subDiv.onselectstart = cancelCalendarEvent;
	div.appendChild(subDiv);

	return div;
}
/* This function creates the minute div at the bottom bar */

function createMinuteDiv()
{
	if(!document.getElementById('minuteDropDown')){
		var div = document.createElement('DIV');
		div.className='monthYearPicker';
	}else{
		var div = document.getElementById('minuteDropDown');
		var subDivs = div.getElementsByTagName('DIV');
		for(var no=0;no<subDivs.length;no++){
			subDivs[no].parentNode.removeChild(subDivs[no]);
		}
	}
	var startMinute = 0;
	var prefix = '';
	for(var no=startMinute;no<60;no+=intervalSelectBox_minutes){

		if(no<10)prefix='0'; else prefix = '';
		var subDiv = document.createElement('DIV');
		subDiv.innerHTML = prefix + no;
		subDiv.onmouseover = highlightMonthYear;
		subDiv.onmouseout = highlightMonthYear;
		subDiv.onclick = selectMinute;
		subDiv.id = 'minuteDiv_' + prefix +  no;
		subDiv.onselectstart = cancelCalendarEvent;
		div.appendChild(subDiv);
		if(currentYear && currentYear==no){
			subDiv.style.color = selectBoxHighlightColor;
			activeSelectBoxYear = subDiv;
		}
	}
	return div;
}

function highlightSelect()
{

	if(this.className=='selectBoxTime'){
		this.className = 'selectBoxTimeOver';
		this.getElementsByTagName('IMG')[0].src = pathToImages + '_down_time_over.gif';
	}else if(this.className=='selectBoxTimeOver'){
		this.className = 'selectBoxTime';
		this.getElementsByTagName('IMG')[0].src = pathToImages + '_down_time.gif';
	}

	if(this.className=='selectBox'){
		this.className = 'selectBoxOver';
		this.getElementsByTagName('IMG')[0].src = pathToImages + '_down_over.gif';
	}else if(this.className=='selectBoxOver'){
		this.className = 'selectBox';
		this.getElementsByTagName('IMG')[0].src = pathToImages + '_down.gif';
	}

}

function highlightArrow()
{
	if(this.src.indexOf('over')>=0){
		if(this.src.indexOf('left')>=0)this.src = pathToImages + '_left.gif';
		if(this.src.indexOf('right')>=0)this.src = pathToImages + '_right.gif';
	}else{
		if(this.src.indexOf('left')>=0)this.src = pathToImages + '_left_over.gif';
		if(this.src.indexOf('right')>=0)this.src = pathToImages + '_right_over.gif';
	}
}

function highlightClose()
{
	if(this.src.indexOf('over')>=0){
		this.src = pathToImages + '_close.gif';
	}else{
		this.src = pathToImages + '_close_over.gif';
	}

}

function closeCalendar(){

	document.getElementById('yearDropDown').style.display='none';
	document.getElementById('monthDropDown').style.display='none';
	document.getElementById('hourDropDown').style.display='none';
	document.getElementById('minuteDropDown').style.display='none';

	calendarDiv.style.display='none';
	if(iframeObj){
		iframeObj.style.display='none';
		 //// //// fix for EI frame problem on time dropdowns 09/30/2006
			EIS_Hide_Frame();}
	if(activeSelectBoxMonth)activeSelectBoxMonth.className='';
	if(activeSelectBoxYear)activeSelectBoxYear.className='';


}

function writeTopBar()
{

	var topBar = document.createElement('DIV');
	topBar.className = 'topBar';
	topBar.id = 'topBar';
	calendarDiv.appendChild(topBar);

	// Left arrow
	var leftDiv = document.createElement('DIV');
	leftDiv.style.marginRight = '1px';
	var img = document.createElement('IMG');
	img.src = pathToImages + '_left.gif';
	img.onmouseover = highlightArrow;
	img.onclick = switchMonth;
	img.onmouseout = highlightArrow;
	leftDiv.appendChild(img);
	topBar.appendChild(leftDiv);
	if(Opera)leftDiv.style.width = '16px';

	// Right arrow
	var rightDiv = document.createElement('DIV');
	rightDiv.style.marginRight = '1px';
	var img = document.createElement('IMG');
	img.src = pathToImages + '_right.gif';
	img.onclick = switchMonth;
	img.onmouseover = highlightArrow;
	img.onmouseout = highlightArrow;
	rightDiv.appendChild(img);
	if(Opera)rightDiv.style.width = '16px';
	topBar.appendChild(rightDiv);


	// Month selector
	var monthDiv = document.createElement('DIV');
	monthDiv.id = 'monthSelect';
	monthDiv.onmouseover = highlightSelect;
	monthDiv.onmouseout = highlightSelect;
	monthDiv.onclick = showMonthDropDown;
	var span = document.createElement('SPAN');
	span.innerHTML = monthArray[currentMonth];
	span.id = 'calendar_month_txt';
	monthDiv.appendChild(span);

	var img = document.createElement('IMG');
	img.src = pathToImages + '_down.gif';
	img.style.position = 'absolute';
	img.style.right = '0px';
	monthDiv.appendChild(img);
	monthDiv.className = 'selectBox';
	if(Opera){
		img.style.cssText = 'float:right;position:relative';
		img.style.position = 'relative';
		img.style.styleFloat = 'right';
	}
	topBar.appendChild(monthDiv);

	var monthPicker = createMonthDiv();
	monthPicker.style.left = '37px';
	monthPicker.style.top = monthDiv.offsetTop + monthDiv.offsetHeight + 1 + 'px';
	monthPicker.style.width ='60px';
	monthPicker.id = 'monthDropDown';

	calendarDiv.appendChild(monthPicker);

	// Year selector
	var yearDiv = document.createElement('DIV');
	yearDiv.onmouseover = highlightSelect;
	yearDiv.onmouseout = highlightSelect;
	yearDiv.onclick = showYearDropDown;
	var span = document.createElement('SPAN');
	span.innerHTML = currentYear;
	span.id = 'calendar_year_txt';
	yearDiv.appendChild(span);
	topBar.appendChild(yearDiv);

	var img = document.createElement('IMG');
	img.src = pathToImages + '_down.gif';
	yearDiv.appendChild(img);
	yearDiv.className = 'selectBox';

	if(Opera){
		yearDiv.style.width = '50px';
		img.style.cssText = 'float:right';
		img.style.position = 'relative';
		img.style.styleFloat = 'right';
	}

	var yearPicker = createYearDiv();
	yearPicker.style.left = '113px';
	yearPicker.style.top = monthDiv.offsetTop + monthDiv.offsetHeight + 1 + 'px';
	yearPicker.style.width = '35px';
	yearPicker.id = 'yearDropDown';
	calendarDiv.appendChild(yearPicker);


	var img = document.createElement('IMG');
	img.src = pathToImages + '_close.gif';
	img.style.styleFloat = 'right';
	img.onmouseover = highlightClose;
	img.onmouseout = highlightClose;
	img.onclick = closeCalendar;
	topBar.appendChild(img);
	if(!document.all){
		img.style.position = 'absolute';
		img.style.right = '2px';
	}



}

function writeCalendarContent()
{
	var calendarContentDivExists = true;
	if(!calendarContentDiv){
		calendarContentDiv = document.createElement('DIV');
		calendarDiv.appendChild(calendarContentDiv);
		calendarContentDivExists = false;
	}
	currentMonth = currentMonth/1;
	var d = new Date();

	d.setFullYear(currentYear);
	d.setDate(1);
	d.setMonth(currentMonth);

	var dayStartOfMonth = d.getDay();
	if (! weekStartsOnSunday) {
      if(dayStartOfMonth==0)dayStartOfMonth=7;
      dayStartOfMonth--;
   }

	document.getElementById('calendar_year_txt').innerHTML = currentYear;
	document.getElementById('calendar_month_txt').innerHTML = monthArray[currentMonth];
	document.getElementById('calendar_hour_txt').innerHTML = currentHour/1 > 9 ? currentHour : '0' + currentHour;
	document.getElementById('calendar_minute_txt').innerHTML = currentMinute/1 >9 ? currentMinute : '0' + currentMinute;

	var existingTable = calendarContentDiv.getElementsByTagName('TABLE');
	if(existingTable.length>0){
		calendarContentDiv.removeChild(existingTable[0]);
	}

	var calTable = document.createElement('TABLE');
	calTable.width = '100%';
	calTable.cellSpacing = '0';
	calendarContentDiv.appendChild(calTable);




	var calTBody = document.createElement('TBODY');
	calTable.appendChild(calTBody);
	var row = calTBody.insertRow(-1);
	row.className = 'calendar_week_row';
   if (showWeekNumber) {
      var cell = row.insertCell(-1);
	   cell.innerHTML = weekString;
	   cell.className = 'calendar_week_column';
	   cell.style.backgroundColor = selectBoxRolloverBgColor;
	}

	for(var no=0;no<dayArray.length;no++){
		var cell = row.insertCell(-1);
		cell.innerHTML = dayArray[no];
	}

	var row = calTBody.insertRow(-1);

   if (showWeekNumber) {
	   var cell = row.insertCell(-1);
	   cell.className = 'calendar_week_column';
	   cell.style.backgroundColor = selectBoxRolloverBgColor;
	   var week = getWeek(currentYear,currentMonth,1);
	   cell.innerHTML = week;		// Week
	}
	for(var no=0;no<dayStartOfMonth;no++){
		var cell = row.insertCell(-1);
		cell.innerHTML = '&nbsp;';
	}

	var colCounter = dayStartOfMonth;
	var daysInMonth = daysInMonthArray[currentMonth];
	if(daysInMonth==28){
		if(isLeapYear(currentYear))daysInMonth=29;
	}

	for(var no=1;no<=daysInMonth;no++){
		d.setDate(no-1);
		if(colCounter>0 && colCounter%7==0){
			var row = calTBody.insertRow(-1);
         if (showWeekNumber) {
            var cell = row.insertCell(-1);
            cell.className = 'calendar_week_column';
            var week = getWeek(currentYear,currentMonth,no);
            cell.innerHTML = week;		// Week
            cell.style.backgroundColor = selectBoxRolloverBgColor;
         }
		}
		var cell = row.insertCell(-1);
		if(currentYear==inputYear && currentMonth == inputMonth && no==inputDay){
			cell.className='activeDay';
		}
		cell.innerHTML = no;
		cell.onclick = pickDate;
		colCounter++;
	}


	if(!document.all){
		if(calendarContentDiv.offsetHeight)
			document.getElementById('topBar').style.top = calendarContentDiv.offsetHeight + document.getElementById('timeBar').offsetHeight + document.getElementById('topBar').offsetHeight -1 + 'px';
		else{
			document.getElementById('topBar').style.top = '';
			document.getElementById('topBar').style.bottom = '0px';
		}

	}

	if(iframeObj){
		if(!calendarContentDivExists)setTimeout('resizeIframe()',350);else setTimeout('resizeIframe()',10);
	}




}

function resizeIframe()
{
	iframeObj.style.width = calendarDiv.offsetWidth + 'px';
	iframeObj.style.height = calendarDiv.offsetHeight + 'px' ;


}

function pickTodaysDate()
{
	var d = new Date();
	currentMonth = d.getMonth();
	currentYear = d.getFullYear();
	pickDate(false,d.getDate());

}

function pickDate(e,inputDay)
{
	var month = currentMonth/1 +1;
	if(month<10)month = '0' + month;
	var day;
	if(!inputDay && this)day = this.innerHTML; else day = inputDay;

	if(day/1<10)day = '0' + day;
	if(returnFormat){
		returnFormat = returnFormat.replace('dd',day);
		returnFormat = returnFormat.replace('mm',month);
		returnFormat = returnFormat.replace('yyyy',currentYear);
		returnFormat = returnFormat.replace('hh',currentHour);
		returnFormat = returnFormat.replace('ii',currentMinute);
		returnFormat = returnFormat.replace('d',day/1);
		returnFormat = returnFormat.replace('m',month/1);

		returnDateTo.value = returnFormat;
		try{
			returnDateTo.onchange();
		}catch(e){

		}
	}else{
		for(var no=0;no<returnDateToYear.options.length;no++){
			if(returnDateToYear.options[no].value==currentYear){
				returnDateToYear.selectedIndex=no;
				break;
			}
		}
		for(var no=0;no<returnDateToMonth.options.length;no++){
			if(returnDateToMonth.options[no].value==parseFloat(month)){
				returnDateToMonth.selectedIndex=no;
				break;
			}
		}
		for(var no=0;no<returnDateToDay.options.length;no++){
			if(returnDateToDay.options[no].value==parseFloat(day)){
				returnDateToDay.selectedIndex=no;
				break;
			}
		}
		if(calendarDisplayTime){
			for(var no=0;no<returnDateToHour.options.length;no++){
				if(returnDateToHour.options[no].value==parseFloat(currentHour)){
					returnDateToHour.selectedIndex=no;
					break;
				}
			}
			for(var no=0;no<returnDateToMinute.options.length;no++){
				if(returnDateToMinute.options[no].value==parseFloat(currentMinute)){
					returnDateToMinute.selectedIndex=no;
					break;
				}
			}
		}
	}
	closeCalendar();

}

// This function is from http://www.codeproject.com/csharp/gregorianwknum.asp
// Only changed the month add
function getWeek(year,month,day){
   if (! weekStartsOnSunday) {
	   day = (day/1);
	} else {
	   day = (day/1)+1;
	}
	year = year /1;
    month = month/1 + 1; //use 1-12
    var a = Math.floor((14-(month))/12);
    var y = year+4800-a;
    var m = (month)+(12*a)-3;
    var jd = day + Math.floor(((153*m)+2)/5) +
                 (365*y) + Math.floor(y/4) - Math.floor(y/100) +
                 Math.floor(y/400) - 32045;      // (gregorian calendar)
    var d4 = (jd+31741-(jd%7))%146097%36524%1461;
    var L = Math.floor(d4/1460);
    var d1 = ((d4-L)%365)+L;
    NumberOfWeek = Math.floor(d1/7) + 1;
    return NumberOfWeek;
}

function writeTimeBar()
{
	var timeBar = document.createElement('DIV');
	timeBar.id = 'timeBar';
	timeBar.className = 'timeBar';

	var subDiv = document.createElement('DIV');
	subDiv.innerHTML = 'Time:';

	// hour selector
	var hourDiv = document.createElement('DIV');
	hourDiv.onmouseover = highlightSelect;
	hourDiv.onmouseout = highlightSelect;
	hourDiv.onclick = showHourDropDown;
	hourDiv.style.width = '30px';
	var span = document.createElement('SPAN');
	span.innerHTML = currentHour;
	span.id = 'calendar_hour_txt';
	hourDiv.appendChild(span);
	timeBar.appendChild(hourDiv);

	var img = document.createElement('IMG');
	img.src = pathToImages + '_down_time.gif';
	hourDiv.appendChild(img);
	hourDiv.className = 'selectBoxTime';

	if(Opera){
		hourDiv.style.width = '30px';
		img.style.cssText = 'float:right';
		img.style.position = 'relative';
		img.style.styleFloat = 'right';
	}

	var hourPicker = createHourDiv();
	hourPicker.style.left = '130px';
	//hourPicker.style.top = monthDiv.offsetTop + monthDiv.offsetHeight + 1 + 'px';
	hourPicker.style.width = '35px';
	hourPicker.id = 'hourDropDown';
	calendarDiv.appendChild(hourPicker);

	// Add Minute picker

	// Year selector
	var minuteDiv = document.createElement('DIV');
	minuteDiv.onmouseover = highlightSelect;
	minuteDiv.onmouseout = highlightSelect;
	minuteDiv.onclick = showMinuteDropDown;
	minuteDiv.style.width = '30px';
	var span = document.createElement('SPAN');
	span.innerHTML = currentMinute;

	span.id = 'calendar_minute_txt';
	minuteDiv.appendChild(span);
	timeBar.appendChild(minuteDiv);

	var img = document.createElement('IMG');
	img.src = pathToImages + '_down_time.gif';
	minuteDiv.appendChild(img);
	minuteDiv.className = 'selectBoxTime';

	if(Opera){
		minuteDiv.style.width = '30px';
		img.style.cssText = 'float:right';
		img.style.position = 'relative';
		img.style.styleFloat = 'right';
	}

	var minutePicker = createMinuteDiv();
	minutePicker.style.left = '167px';
	//minutePicker.style.top = monthDiv.offsetTop + monthDiv.offsetHeight + 1 + 'px';
	minutePicker.style.width = '35px';
	minutePicker.id = 'minuteDropDown';
	calendarDiv.appendChild(minutePicker);


	return timeBar;

}

function writeBottomBar()
{
	var d = new Date();
	var bottomBar = document.createElement('DIV');

	bottomBar.id = 'bottomBar';

	bottomBar.style.cursor = 'pointer';
	bottomBar.className = 'todaysDate';
	// var todayStringFormat = '[todayString] [dayString] [day] [monthString] [year]';	;;

	var subDiv = document.createElement('DIV');
	subDiv.onclick = pickTodaysDate;
	subDiv.id = 'todaysDateString';
	subDiv.style.width = (calendarDiv.offsetWidth - 95) + 'px';
	var day = d.getDay();
	if (! weekStartsOnSunday) {
      if(day==0)day = 7;
      day--;
   }

	var bottomString = todayStringFormat;
	bottomString = bottomString.replace('[monthString]',monthArrayShort[d.getMonth()]);
	bottomString = bottomString.replace('[day]',d.getDate());
	bottomString = bottomString.replace('[year]',d.getFullYear());
	bottomString = bottomString.replace('[dayString]',dayArray[day].toLowerCase());
	bottomString = bottomString.replace('[UCFdayString]',dayArray[day]);
	bottomString = bottomString.replace('[todayString]',todayString);


	subDiv.innerHTML = todayString + ': ' + d.getDate() + '. ' + monthArrayShort[d.getMonth()] + ', ' +  d.getFullYear() ;
	subDiv.innerHTML = bottomString ;
	bottomBar.appendChild(subDiv);

	var timeDiv = writeTimeBar();
	bottomBar.appendChild(timeDiv);

	calendarDiv.appendChild(bottomBar);



}
function getTopPos(inputObj)
{

  var returnValue = inputObj.offsetTop + inputObj.offsetHeight;
  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetTop;
  return returnValue + calendar_offsetTop;
}

function getleftPos(inputObj)
{
  var returnValue = inputObj.offsetLeft;
  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;
  return returnValue + calendar_offsetLeft;
}

function positionCalendar(inputObj)
{
	calendarDiv.style.left = getleftPos(inputObj) + 'px';
	calendarDiv.style.top = getTopPos(inputObj) + 'px';
	if(iframeObj){
		iframeObj.style.left = calendarDiv.style.left;
		iframeObj.style.top =  calendarDiv.style.top;
		//// fix for EI frame problem on time dropdowns 09/30/2006
		iframeObj2.style.left = calendarDiv.style.left;
		iframeObj2.style.top =  calendarDiv.style.top;
	}

}

function initCalendar()
{
	if(MSIE){
		iframeObj = document.createElement('IFRAME');
		iframeObj.style.filter = 'alpha(opacity=0)';
		iframeObj.style.position = 'absolute';
		iframeObj.border='0px';
		iframeObj.style.border = '0px';
		iframeObj.style.backgroundColor = '#FF0000';
		//// fix for EI frame problem on time dropdowns 09/30/2006
		iframeObj2 = document.createElement('IFRAME');
		iframeObj2.style.position = 'absolute';
		iframeObj2.border='0px';
		iframeObj2.style.border = '0px';
		iframeObj2.style.height = '1px';
		iframeObj2.style.width = '1px';
		//// fix for EI frame problem on time dropdowns 09/30/2006
		// Added fixed for HTTPS
		iframeObj2.src = 'blank.html';
		iframeObj.src = 'blank.html';
		document.body.appendChild(iframeObj2);  // gfb move this down AFTER the .src is set
		document.body.appendChild(iframeObj);
	}

	calendarDiv = document.createElement('DIV');
	calendarDiv.id = 'calendarDiv';
	calendarDiv.style.zIndex = 1000;
	slideCalendarSelectBox();

	document.body.appendChild(calendarDiv);
	writeBottomBar();
	writeTopBar();



	if(!currentYear){
		var d = new Date();
		currentMonth = d.getMonth();
		currentYear = d.getFullYear();
	}
	writeCalendarContent();



}

function setTimeProperties()
{
	if(!calendarDisplayTime){
		document.getElementById('timeBar').style.display='none';
		document.getElementById('timeBar').style.visibility='hidden';
		document.getElementById('todaysDateString').style.width = '100%';


	}else{
		document.getElementById('timeBar').style.display='block';
		document.getElementById('timeBar').style.visibility='visible';
		document.getElementById('hourDropDown').style.top = document.getElementById('calendar_minute_txt').parentNode.offsetHeight + calendarContentDiv.offsetHeight + document.getElementById('topBar').offsetHeight + 'px';
		document.getElementById('minuteDropDown').style.top = document.getElementById('calendar_minute_txt').parentNode.offsetHeight + calendarContentDiv.offsetHeight + document.getElementById('topBar').offsetHeight + 'px';
		document.getElementById('minuteDropDown').style.right = '50px';
		document.getElementById('hourDropDown').style.right = '50px';
		document.getElementById('todaysDateString').style.width = '115px';
	}
}

function calendarSortItems(a,b)
{
	return a/1 - b/1;
}


function displayCalendar(inputField,format,buttonObj,displayTime,timeInput)
{
	if(displayTime)calendarDisplayTime=true; else calendarDisplayTime = false;
	
	if(inputField.value.length>6){ //dates must have at least 6 digits...
       if(!inputField.value.match(/^[0-9]*?$/gi)){
       	
			var items = inputField.value.split(/[^0-9]/gi);
			var positionArray = new Object();
			positionArray.m = format.indexOf('mm');
			if(positionArray.m==-1)positionArray.m = format.indexOf('m');
			positionArray.d = format.indexOf('dd');
			if(positionArray.d==-1)positionArray.d = format.indexOf('d');
			positionArray.y = format.indexOf('yyyy');
			positionArray.h = format.indexOf('hh');
			positionArray.i = format.indexOf('ii');
			
			this.initialHour = '00';
			this.initialMinute = '00';				
			var elements = ['y','m','d','h','i'];
			var properties = ['currentYear','currentMonth','inputDay','currentHour','currentMinute'];
			var propertyLength = [4,2,2,2,2];
			for(var i=0;i<elements.length;i++) {
				if(positionArray[elements[i]]>=0) {
					window[properties[i]] = inputField.value.substr(positionArray[elements[i]],propertyLength[i])/1;
				}					
			}			
			currentMonth--;
		}else{
			var monthPos = format.indexOf('mm');
			currentMonth = inputField.value.substr(monthPos,2)/1 -1;
			var yearPos = format.indexOf('yyyy');
			currentYear = inputField.value.substr(yearPos,4);
			var dayPos = format.indexOf('dd');
			tmpDay = inputField.value.substr(dayPos,2);

			var hourPos = format.indexOf('hh');
			if(hourPos>=0){
				tmpHour = inputField.value.substr(hourPos,2);
				currentHour = tmpHour;
				if(currentHour.length==1) currentHour = '0'
			}else{
				currentHour = '00';
			}
			var minutePos = format.indexOf('ii');
			if(minutePos>=0){
				tmpMinute = inputField.value.substr(minutePos,2);
				currentMinute = tmpMinute;
			}else{
				currentMinute = '00';
			}
		}
	}else{
		var d = new Date();
		currentMonth = d.getMonth();
		currentYear = d.getFullYear();
		currentHour = '08';
		currentMinute = '00';
		inputDay = d.getDate()/1;
	}

	inputYear = currentYear;
	inputMonth = currentMonth;


	if(!calendarDiv){
		initCalendar();
	}else{
		if(calendarDiv.style.display=='block'){
			closeCalendar();
			return false;
		}
		writeCalendarContent();
	}



	returnFormat = format;
	returnDateTo = inputField;
	positionCalendar(buttonObj);
	calendarDiv.style.visibility = 'visible';
	calendarDiv.style.display = 'block';
	if(iframeObj){
		iframeObj.style.display = '';
		iframeObj.style.height = '140px';
		iframeObj.style.width = '195px';
				iframeObj2.style.display = '';
		iframeObj2.style.height = '140px';
		iframeObj2.style.width = '195px';
	}

	setTimeProperties();
	updateYearDiv();
	updateMonthDiv();
	updateMinuteDiv();
	updateHourDiv();

}

function displayCalendarSelectBox(yearInput,monthInput,dayInput,hourInput,minuteInput,buttonObj)
{
	if(!hourInput)calendarDisplayTime=false; else calendarDisplayTime = true;

	currentMonth = monthInput.options[monthInput.selectedIndex].value/1-1;
	currentYear = yearInput.options[yearInput.selectedIndex].value;
	if(hourInput){
		currentHour = hourInput.options[hourInput.selectedIndex].value;
		inputHour = currentHour/1;
	}
	if(minuteInput){
		currentMinute = minuteInput.options[minuteInput.selectedIndex].value;
		inputMinute = currentMinute/1;
	}

	inputYear = yearInput.options[yearInput.selectedIndex].value;
	inputMonth = monthInput.options[monthInput.selectedIndex].value/1 - 1;
	inputDay = dayInput.options[dayInput.selectedIndex].value/1;

	if(!calendarDiv){
		initCalendar();
	}else{
		writeCalendarContent();
	}



	returnDateToYear = yearInput;
	returnDateToMonth = monthInput;
	returnDateToDay = dayInput;
	returnDateToHour = hourInput;
	returnDateToMinute = minuteInput;




	returnFormat = false;
	returnDateTo = false;
	positionCalendar(buttonObj);
	calendarDiv.style.visibility = 'visible';
	calendarDiv.style.display = 'block';
	if(iframeObj){
		iframeObj.style.display = '';
		iframeObj.style.height = calendarDiv.offsetHeight + 'px';
		iframeObj.style.width = calendarDiv.offsetWidth + 'px';
		//// fix for EI frame problem on time dropdowns 09/30/2006
		iframeObj2.style.display = '';
		iframeObj2.style.height = calendarDiv.offsetHeight + 'px';
		iframeObj2.style.width = calendarDiv.offsetWidth + 'px'
	}
	setTimeProperties();
	updateYearDiv();
	updateMonthDiv();
	updateHourDiv();
	updateMinuteDiv();

}