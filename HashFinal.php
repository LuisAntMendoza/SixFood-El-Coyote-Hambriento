<?php

  define("PASSWORD", "Shrek Amo Del Multiverso");
  define("HASH", "sha256");
  define("METHOD", "aes-128-cbc-hmac-sha1");

  function Cifrar($text){
    // Espero funcione xd
    $key = openssl_digest(PASSWORD, HASH);
    $iv_len = openssl_cipher_iv_length (METHOD);
    $iv = openssl_random_pseudo_bytes ($iv_len);

    $key = openssl_digest(PASSWORD,HASH);

    $rawCiff = openssl_encrypt(
    $text,
    METHOD,
    $key,
    OPENSSL_RAW_DATA,
    $iv
    );
    $textoCifrado = base64_encode($iv.$rawCiff);

    return $textoCifrado;
  }
  function Decifrar ($textoCifrado){
    // Espero funcione x2
    $key = openssl_digest(PASSWORD, HASH);
    $iv_len = openssl_cipher_iv_length (METHOD);

    $cifrado = base64_decode($textoCifrado);
    $iv = substr($cifrado, 0, $iv_len);
    $rawCiff = substr($cifrado, $iv_len);

    $originalText = openssl_decrypt(
    $rawCiff,
    METHOD,
    $key,
    OPENSSL_RAW_DATA,
    $iv
    );
    return $originalText;
  }

  $mensaje = "Equipo-Sombra";
  $ciff = Cifrar($mensaje);
  $original = Decifrar($ciff);

  echo "Mensaje original: ".$mensaje."<br>";
  echo "Mensaje cifrado: ".$ciff."<br>";
  echo "Mensaje decifrado: ".$original."<br>";



?>
