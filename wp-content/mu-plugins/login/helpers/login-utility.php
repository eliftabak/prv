<?php


function send_welcome_email_to_new_user($user_id)
{
  $user = get_userdata($user_id);
  $user_email = $user->user_email;
  // for simplicity, lets assume that user has typed their first and last name when they sign up
  $user_full_name = $user->user_firstname . $user->user_lastname;

  // Now we are ready to build our welcome email
  $to = $user_email;
  $subject = "Merhabalar " . $user_full_name . ", sitemize hoşeldiniz!";
  $body = '
            <h1>Sayın ' . $user_full_name . ', Hocam</h1></br>
            <p>Sitemize üye olduğunuz için teşekkürler. Hesabınız şuanda aktif.</p>
            <p>Bize gönderdiğiniz belgeler kısa bir onay aşamasından geçecektir.</p>
            <p>Sistemde kullanıcı adınız onaylanınca tarafınıza mail atılacaktır.</p>
            <p>En iyi dileklerimizle.</p>
            <p>İyi Günler</p>';
  $headers = array('Content-Type: text/html; charset=UTF-8');
  if (wp_mail($to, $subject, $body, $headers)) {
    error_log("email has been successfully sent to user whose email is " . $user_email);
  } else {
    error_log("email failed to sent to user whose email is " . $user_email);
  }
}
