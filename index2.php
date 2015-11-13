<!DOCTYPE html>
<html>
<head>
	<title>Account Details:</title>
</head>

	<body>
	<?php
		if(isset($_POST['name'])){
			echo "<p style='color:red'>Wrote Details to output.txt</p>";
			$a = "";
			$a = $a."Name: ";
			$a = $a.$_POST["name"];
			$a = $a."\n";
			
			$a = $a."User Name: ";
			$a = $a.$_POST["uName"];
			$a = $a."\n";
			
			$a = $a."Email: ";
			$a = $a.$_POST["email"];
			$a = $a."\n";
			
			$a = $a."Mobile: ";
			$a = $a.$_POST["mobile"];
			$a = $a."\n";

			$a = $a."Sex: ";
			$a = $a.$_POST["sex"];
			$a = $a."\n";

			$a = $a."Address: ";
			$a = $a.$_POST["address"];
			$a = $a."\n";

			$a = $a."Country: ";
			$a = $a.$_POST["country"];
			$a = $a."\n";

			//echo $a;
			//echo "lola";
			// Write final string to file
			file_put_contents("output.txt", $a);
		}
	?>
		<form  method="post">
			<div id="p2" style="display:none">
			</div>
			<div id="p3" style="display:none">
			</div>
			<div id="p4" style="display:none">
			</div>
		 	<!--  ----------------------------------------------------------------- -->
		 	<div class="page1" id="page1" >

		 	Name*: <input type="text" name="name" id="name" required><br>
		 	
		 	Username*: <input type="text" name="uName" id="uName" required><br>
		 	
		 	E-mail*: <input type="email" name="email" id="email" required><br>

		 	Password*: <input type="password" name="password" id="password" required><br>
		 	Confirm Password*: <input type="password" name="cPassword" id="cPassword" required><br>
		 	
		 	<br>
		 	<input type="button" onclick="p1Next()" value="Next">
		 	<br>
		 	</div>

		 	<!--  ----------------------------------------------------------------- -->
		 	<div class="page2" id="page2" style="display:none">

		 	<br><br>
		 	Mobile*: <input type="text" name="mobile" id="mobile" pattern="[0-9]{10}" title="10 digit mobile number" required>
		 	<br>
		 	Gender*:<input type="radio" name="sex" id="msex" value="male" checked> Male
			<input type="radio" name="sex" id="fsex" value="female"> Female
			<br>
		 	
		 	<input type="button" onclick="p2Prev()" value="Prev">
		 	<input type="button" onclick="p2Next()" value="Next">
		 	<br>
		 	</div>
		 	<!--  ----------------------------------------------------------------- -->
		 	<div class="page3" id="page3" style="display:none">

		 	<br><br>
		 	Address:
		 	<br>
		 	<textarea name="address" id="address" rows="4" cols="50" required></textarea>
			<br>
			Country:
			<select name="country" id="country">
				<option value="India">India</option>
				<option value="Pakistan">Pakistan</option>
				<option value="China">China</option>
	  			<option value="USA">USA</option>
			</select>
			<br>

		 	<input type="button" onclick="p3Prev()" value="Prev">
		 	<input type="button" onclick="p3Next()" value="Next">
		 	<br>
		 	
		 	</div>
		 	<!--  ----------------------------------------------------------------- -->
	  		<div class="page4" id="page4" style="display:none">
	  		
	  		<br><br>
	  		<input type="checkbox" name="allcorrect" id="allcorrect" required >All data inserted are correct<br>
	  		<input type="button" onclick="p4Prev()" value="Prev">
	  		<br>
	  		<input type="submit" value="Submit">
			
			</div>
			<!--  ----------------------------------------------------------------- -->
		</form>


		
	</body>
	
	<script>
		var name="",uName="",pwd="",pwd2="",address="",mobile="",sex="",country="",email="";

		function getAll(){
			pwd = document.getElementById("password").value;
			pwd2 = document.getElementById("cPassword").value;
			name = document.getElementById("name").value;
			uName = document.getElementById("uName").value;
			address = document.getElementById("address").value;
			mobile = document.getElementById("mobile").value;
			//sex = document.getElementById("sex").value;
			country = document.getElementById("country").value;
			email = document.getElementById("email").value;

			var radios = document.getElementsByName('sex');

			for (var i = 0, length = radios.length; i < length; i++) {
			    if (radios[i].checked) {
			        // do whatever you want with the checked radio
			        sex=radios[i].value
			    }
			}
		}

		///////////////////////////////////////////////////////////////////////////////////////////////
		function checkPassword(str)
		{
		  return str.length >= 6;
		}

		function verifyEmail(){
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		    if(!re.test(email)){
		    	alert("The email you have entered is not valid!");
		    	document.getElementById("password").focus();
		    	return false;	
		    }
		    return true;
		}
		function verifyPassword()
		{
		  if(pwd != "" && pwd == pwd2) {
		    if(!checkPassword(pwd)) {
		      alert("The password you have entered is not valid! It must contain 6 characters");
		      document.getElementById("password").focus();
		      return false;
		    }
		  } else {
		    alert("Error: Please check that you've entered and confirmed your password!");
		    document.getElementById("password").focus();
		    return false;
		  }
		  return true;
		}
		function verifyUname(){
			if(uName=="") {
		      alert("enter a non-empty username");
		      document.getElementById("uName").focus();
		      return false;
		    }
		    return true;
		}
		
		function verifyName(){
			if(name=="") {
		      alert("enter a non-empty name");
		      document.getElementById("name").focus();
		      return false;
		    }
		    return true;
		}
		function generateP2html(){
			passtr = "******";
			for (var i = 6; i < pwd.length; i++) {
				passtr.concat("*");
			}
			var str2 = "";
			str2=str2.concat("Name:",name,"<br>");
			str2=str2.concat("User Name:",uName,"<br>");
			str2=str2.concat("Password:",passtr,"<br>");
			str2=str2.concat("Email:",email,"<br>");
			
			return str2;
		}

		function p1Next(){
			getAll();
			// verify password before everything else
			if(verifyName()){
				if(verifyUname())
					if(verifyEmail())
						if(verifyPassword()){
							document.getElementById('page1').style.display="none";
							document.getElementById('page2').style.display="inline";
							document.getElementById('page3').style.display="none";
							document.getElementById('page4').style.display="none";
							
							html = generateP2html();
							document.getElementById("p2").innerHTML = html;
							console.log(html);
							document.getElementById('p2').style.display="inline";
							document.getElementById('p3').style.display="none";
							document.getElementById('p4').style.display="none";
						}
			}
		}
		/////////////////////////////////////////////////////////////////////////////////////////

		function verifyMobile(){
			regex = /^\d{10}$/; 
			if(!regex.test(mobile)) {
		      alert("enter a valid 10 digit mobile no");
		      document.getElementById("mobile").focus();
		      return false;
		    }
		    return true;
		}
		function generateP3html(){
			html = "";
			html=html.concat("Mobile No:",mobile,"<br>");
			html=html.concat("Sex:",sex,"<br>");
			
			return html;
		}

		function p2Next(){
			getAll();
			
			if(verifyMobile()){
				document.getElementById('page1').style.display="none";
				document.getElementById('page2').style.display="none";
				document.getElementById('page3').style.display="inline";
				document.getElementById('page4').style.display="none";
				
				html = generateP2html();
				document.getElementById("p2").innerHTML = html;
				document.getElementById('p2').style.display="inline";

				html3 = generateP3html();
				document.getElementById("p3").innerHTML = html3;
				document.getElementById('p3').style.display="inline";
				
				document.getElementById('p4').style.display="none";
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		function verifyAddress(){
			if(address=="") {
		      alert("enter a non-empty address");
		      document.getElementById("address").focus();
		      return false;
		    }
		    return true;
		}
		function generateP4html(){
			html = "";
			html=html.concat("Address:",address,"<br>");
			html=html.concat("Country:",country,"<br>");
			return html;
		}
		function p3Next(){
			getAll();
			
			if(verifyAddress()){
				document.getElementById('page1').style.display="none";
				document.getElementById('page2').style.display="none";
				document.getElementById('page3').style.display="none";
				document.getElementById('page4').style.display="inline";

				html = generateP2html();
				document.getElementById("p2").innerHTML = html;
				document.getElementById('p2').style.display="inline";

				html3 = generateP3html();
				document.getElementById("p3").innerHTML = html3;
				document.getElementById('p3').style.display="inline";
				
				html4=generateP4html();
				document.getElementById("p4").innerHTML = html4;
				document.getElementById('p4').style.display="inline";

			}
		}

		//////////////////////////////////////////////////////////////////////////////////////
		function p2Prev(){
			document.getElementById('page1').style.display="inline";
			document.getElementById('page2').style.display="none";
			document.getElementById('page3').style.display="none";
			document.getElementById('page4').style.display="none";
			document.getElementById('p2').style.display="none";
			document.getElementById('p3').style.display="none";
			document.getElementById('p4').style.display="none";
		}
		function p3Prev(){
			document.getElementById('page1').style.display="none";
			document.getElementById('page2').style.display="inline";
			document.getElementById('page3').style.display="none";
			document.getElementById('page4').style.display="none";
			document.getElementById('p2').style.display="inline";
			document.getElementById('p3').style.display="none";
			document.getElementById('p4').style.display="none";	
		}
		function p4Prev(){
			document.getElementById('page1').style.display="none";
			document.getElementById('page2').style.display="none";
			document.getElementById('page3').style.display="inline";
			document.getElementById('page4').style.display="none";
			document.getElementById('p2').style.display="inline";
			document.getElementById('p3').style.display="inline";
			document.getElementById('p4').style.display="none";
		}
	</script>
</html>
