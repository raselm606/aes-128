<?php
// Function to encrypt plaintext using AES-128
error_reporting(0);


function encryptAES($plaintext, $key) {
    // Define the cipher method
    $cipher = "aes-128-cbc";

    // Get the initialization vector length for the cipher method for 16 bytes
    $ivlen = openssl_cipher_iv_length($cipher);

    // Generate a random initialization vector (IV)
    $iv = openssl_random_pseudo_bytes($ivlen);

    // Encrypt the plaintext using OpenSSL encrypt function
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    // Combine IV and ciphertext and then encode it in base64 for storage or transmission
    $ivCiphertext = $iv . $ciphertext;
    $ivCiphertextBase64 = base64_encode($ivCiphertext);

    return $ivCiphertextBase64;
}

// Function to decrypt ciphertext using AES-128
function decryptAES($ciphertextBase64, $key) {
    // Define the cipher method
    $cipher = "aes-128-cbc";

    // Decode the base64-encoded ciphertext to retrieve IV and ciphertext
    $ivCiphertext = base64_decode($ciphertextBase64);

    // Get the initialization vector length for the cipher method
    $ivlen = openssl_cipher_iv_length($cipher);

    // Extract IV from the combined data
    $iv = substr($ivCiphertext, 0, $ivlen);

    // Extract ciphertext from the combined data
    $ciphertext = substr($ivCiphertext, $ivlen);

    // Decrypt the ciphertext using OpenSSL decrypt function
    $plaintext = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    return $plaintext;
}

// Initialize variables for error messages
$inputError = $keyError = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input text
    if (empty($_POST['input_text'])) {
        $inputError = 'Please enter text to encrypt/decrypt.';
    } else {
        $input_text = $_POST['input_text'];
    }

    // Validate encryption key
    if (empty($_POST['encryption_key'])) {
        $keyError = 'Please enter your secret key.';
    } else {
        $encryption_key = $_POST['encryption_key'];

    }

    // If both input text and key are provided and valid, proceed with encryption or decryption
    if (!empty($input_text) && !empty($encryption_key)) {
        // Check if the "Encrypt" button is clicked
        if (isset($_POST['encrypt'])) {
            // Encrypt the input text using AES encryption with the provided key
            $encrypted_text = encryptAES($input_text, $encryption_key);

        }

        // Check if the "Decrypt" button is clicked
        if (isset($_POST['decrypt'])) {
            // Decrypt the input text using AES decryption with the provided key
            $decrypted_text = decryptAES($input_text, $encryption_key);
        }
    }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>AES Encryption and Decryption</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c14c7a982491369ba9e36e9/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>

<body>
  <!-- notice start -->
  <!-- <div class="top_notice fixed-bottomm">
    <div class="container-fluidd">
      <div class="roww">
        <div class="col-lg-12">
          <div class="textt text-center">
            <div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
              
              <strong>Notice:</strong> New code editor added. Please clean browser cache! (Ctrl+ Shift+ R)
              
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- notice end -->

	<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-blak ">
  <div class="container-fluid">
    <a class="navbar-brand logo_f" href="aes128.php"><span class="">AES-128</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto ddnav mr-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="aes128.php">Home 
            <!-- <span class="circle blink" aria-hidden="true"></span> -->
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="https://www.php.net/manual/en/function.openssl-encrypt.php" target="_blank">openssl_encrypt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.php.net/manual/en/function.substr" target="_blank">substr</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.php.net/manual/en/function.base64-encode" target="_blank">base64_encode</a>
        </li>
        
      </ul>
      <form class="d-flex "> 
        <a href="https://eub.com.bd" target="_blank" class="btn btn-dark mr-2" >EUB Website <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-square" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z"/>
</svg></a> 
        <a href="https://www.facebook.com/DRaselMahmud" target="_blank" class="btn btn-dark ml-2" >Contact Me <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
  <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
</svg></a>
      </form>
    </div>
  </div>
</nav>

 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centeredd">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Class Routine - 4th Semester (22 Batch)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="routine.jpg" width="100%" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal sirr fade" id="sir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header text-center sor"> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
        	<div class="row justify-content-center">
        		<div class="col-lg-9">
        			<div class="card sar">
					  <img width="100%" src="images/mehadisir.jpg" class="card-img-top" alt="...">
					  <div class="card sar">
					  <div class="card-body text-center">
					    <h5 class="card-title">Mohammad Mehadi Hasan</h5>
					    <p class="card-text"><span>POSITION: </span> Assistant Professor & Course Coordinator </p>
					    <p class="card-text"><span>EMAIL:  </span> hasanbdmehadi@eub.edu.bd </p>
					    <p class="card-text"><span>MOBILE:  </span> 01631095127 </p>
					    <p class="card-text"><span>Computer Science & Engineering</span> </p>
					    <p class="card-text"><span>European University Of Bangladesh</span> </p> 

					    <a href="https://eub.edu.bd/department-of-cse/01754242590/" target="_blank" class="btn btn-sm btn-outline-dark">Read More</a>
					  </div>
					</div>
					</div>
        		</div> 
        	</div>
        </div>
      </div> 
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal sirr fade" id="rasel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header text-center sor"> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card sar">
                      <img width="100%" src="images/rasel.jpg" class="card-img-top" alt="...">
                      <div class="card sar">
                      <div class="card-body cdbody text-center">
                        <h5 class="card-title">MD. Rasel Mahmud</h5>
                        <p class="card-text"> <span>ID:</span> 220221013 (5th) </p>  
                        <p class="card-text"> <span>EMAIL:</span> raselm606@gmail.com </p>  
                        <p class="card-text"> <span>MOBILE:</span>  01681789989 </p>  
                        <p class="card-text"> <span>Computer Science & Engineering</span> </p>  
                        <p class="card-text"> <span>European University Of Bangladesh</span> </p>  

                        <a href="https://github.com/raselm606" target="_blank" class="btn mt-2 btn-sm btn-outline-dark"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg> Github</a>
                      </div>
                    </div>
                    </div>
                </div> 
            </div>
        </div>
      </div> 
    </div>
  </div>
</div>


<div class="container bg-whitee pt-3 pb-3 mt-3">

	<div class="row">

		<div class="col-lg-12">
			<div class="java_program">
                
				<div class="alert alert-dark alrt text-center" role="alert">

				  <h5>Alogrithm Lab Project: </h5>

				  <p > <a href="" style="color: #bdbdbd;" data-bs-toggle="modal" data-bs-target="#rasel">Rasel Mahmud (220221013)</a> <br> European University of Bangladesh</p>
                  <p><a class="jsir" href="#" data-bs-toggle="modal" data-bs-target="#sir">Submitted to: Mohammad Mehadi Hasan <br> Assistant Professor & Course Coordinator</a></p>

				</div>
				

				<h1 class="display display-6 text-center" style="color:#ffc107;">AES-128 Encryption and Decryption</h1>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="aes_section card">
                    <div class="card-body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <!-- Input field for the text to be encrypted or decrypted -->
                            <div class="mb-3">
                                <label class="form-label" for="input_text">Enter Text to Encrypt/Decrypt:</label>
                                <textarea class="form-control" name="input_text" rows="5" cols="40" placeholder="Enter any text"><?php echo isset($encrypted_text) ? $encrypted_text : (isset($decrypted_text) ? $decrypted_text : ''); ?></textarea>
                                <div class="text-danger"><?php echo $inputError; ?></div>
                            </div>

                            <!-- Input field for the encryption key -->
                            <div class="mb-3">
                                <label class="form-label" for="encryption_key">Enter Your Secret Key:</label>
                                <input class="form-control" type="text" name="encryption_key" placeholder="Enter your secret key">
                                <div class="text-danger"><?php echo $keyError; ?></div>
                            </div>

                            <!-- Submit buttons for encryption and decryption -->
                            <input type="submit" style="font-weight: bold;" class="btn btn-warning" name="encrypt" value="ENCRYPT">
                            <input type="submit" style="font-weight: bold;" class="btn btn-success" name="decrypt" value="DECRYPT">
                        </form>
                    </div>
                </div>

                <div class="explain_img mt-3">
                	<h1 class="display display-6 text-center" style="color:#ffc107;">How it works?</h1>
                	<img class="mb-3" width="100%" src="https://assets-global.website-files.com/5ff66329429d880392f6cba2/618e3ef1d4fd65b58fac771b_AES%20design.png" alt="">

                	<img width="100%" src="https://assets-global.website-files.com/5ff66329429d880392f6cba2/618e3f3ff8ffcc7e84a823cd_AES%20algorithm%20working.png" alt="">
                </div>
            </div>
        </div>
    </div>

	

		</div>

	</div>
</div>

</div>


<footer>

  <div class="container">

    <div class="row">

      <div class="col-lg-12">

        <div class="footer_text text-center mb-3">

          <p class="text-white">  
            <span style="color: rgb(255 193 7) !important; font-family: 'Bebas Neue', sans-serif;
          font-size: 20px;">Copyright &copy; <?php echo date(Y); ?> - AES-128</span> </p>
          <p class="credit">All Credit goes to: 
            <a target="_blank" href="https://php.net/">php.net </a> 
          </p>

        </div>

      </div>

    </div>

  </div>

</footer>





<!-- scroll to top -->

<div class="scroll-container">

  <button class="scroll-to-top" onclick="ScrollToTop()">

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-double-up" viewBox="0 0 16 16">

      <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708l6-6z" />

      <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />

    </svg>

  </button>



</div>

  <script src="js/jquery-3.7.0.min.js"></script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- <script src="js/cdnjs.cloudflare.com_ajax_libs_ace_1.22.1_ace.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.22.1/ace.js"></script> -->

  <script src="js/pluginnss.js"></script>
  <script src="js/src-min-noconflict/ace.js"></script>
  <script src="js/main.js"></script>

<script>

function ScrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}

$(".btshow").click(function(){
  $(".oldcode").toggle();
});


// $( document.body ).click(function() {
//     alert('Hi I am bound to the body!');
// });


function myFunction() {
  alert("You can't copy code!! 😂😂");
}

//php accordion
var editorphp1 = ace.edit("editorphp1");
    editorphp1.setTheme("ace/theme/monokai");
    editorphp1.session.setMode("ace/mode/php");

</script>

	

</body>

</html>
