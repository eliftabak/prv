<?php


function send_email_to_user_notify_process($user_id)
{
  $user = get_userdata($user_id);
  $user_email = $user->user_email;
  // for simplicity, lets assume that user has typed their first and last name when they sign up
  $user_full_name = $user->user_firstname . " " . $user->user_lastname;

  // Now we are ready to build our welcome email
  $to = $user_email;
  $subject = "Merhabalar " . $user_full_name . ", pruvakademi.com'a hoşeldiniz!";
  $body = '
            <h1>Sayın ' . $user_full_name . '</h1></br>
            <p>Sitemize üye olduğunuz için teşekkür ederiz. Hesabınız şuanda aktif.</p>
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

function send_admin_mail_about_request_form($user_id, $user_message)
{
  $admin_email = get_option('admin_email');
  $user = get_userdata($user_id);
  $user_email = $user->user_email;
  $user_full_name = $user->user_firstname . " " . $user->user_lastname;

  $to = $admin_email;
  $subject = $user_full_name . ", tarafından akıllı tahta talebi yapmılmıştır.";
  $body = '
            <h1>Sayın Yönetici</h1></br>
            <p>Sisteminize bir kullanıcı akıllı tahta talebi yapmıştır</p>
            <p>En kısa zamanda kullanıcının gönderdiği belgeleri onaylayıp kullacıyı tipini öğretmene çevirmelisiniz.</p>
            <h2>Kullacının size özel bir mesajı var. Mesaj aşağıda verilmiştir;</h2>
            <p>' . $user_message . '</p>';
  $headers = array('Content-Type: text/html; charset=UTF-8');
  if (wp_mail($to, $subject, $body, $headers)) {
    error_log("email has been successfully sent to user whose email is " . $user_email);
  } else {
    error_log("email failed to sent to user whose email is " . $user_email);
  }
}
