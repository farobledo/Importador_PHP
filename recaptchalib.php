<script>
grecaptcha.ready(function() {
grecaptcha.execute(' 6Ld5esgUAAAAAO8WHsnbkvr_bxe_KA--V-vUEcUo', {action: 'ejemplo'})
.then(function(token) {
var recaptchaResponse = document.getElementById('recaptchaResponse');
recaptchaResponse.value = token;
});});

$secret = " web: 6Ld5esgUAAAAAO8WHsnbkvr_bxe_KA--V-vUEcUo";
 $response = null;
 // Verificamos la clave secreta
 $reCaptcha = new ReCaptcha($secret);
 if ($_POST["g-recaptcha-response"]) {
     $response = $reCaptcha->verifyResponse(
     $_SERVER["REMOTE_ADDR"],
     $_POST["g-recaptcha-response"]
     );
  }
 
 if ($response != null && $response->success) {
    // Añade aquí el código que desees en el caso de que la validación sea correcta
     
  } else {
    // Añade aquí el código que desees en el caso de que la validación no sea correcta o muestra
  }
</script>