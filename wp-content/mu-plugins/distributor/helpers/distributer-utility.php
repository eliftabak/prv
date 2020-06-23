<?php


function send_welcome_email_to_distributer($args)
{

  $user_email = $args["personel_email"];
  $user_firstname = $args["personel_first_name"];
  $user_lastname = $args["personel_last_name"];
  $user_full_name = $user_firstname . " " . $user_lastname;
  $to = $user_email;
  $subject = "Merhabalar " . $user_full_name . ", bayilik başvurunuz başarıyla tarafımıza ulaşmıştır.";
  $body = '
            <h1>Sayın ' . $user_full_name . ',</h1></br>
            <p>Bayilik başvurunuz tarafımızca incelenecektir.</p>
            <p>İnceleme tamamlandıktan sonra, size mail veya telefon ile dönüş yapılacaktır.</p>
            <p>En içten dileklerimizle.</p>
            <p>İyi günler dileriz.</p>';
  $headers = array('Content-Type: text/html; charset=UTF-8');
  if (wp_mail($to, $subject, $body, $headers)) {
    error_log("email has been successfully sent to user whose email is " . $user_email);
  } else {
    error_log("email failed to sent to user whose email is " . $user_email);
  }
}

function notify_admin_for_new_dealer_register($args, $user_message)
{

  $admin_email = get_option('admin_email');
  $user_email = $args["personel_email"];
  $user_firstname = $args["personel_first_name"];
  $user_lastname = $args["personel_last_name"];
  $user_full_name = $user_firstname . " " . $user_lastname;
  $to = $admin_email;
  $subject = $user_full_name . ", tarafından bayilik talebi yapmılmıştır.";

  $message_html = "";
  if (!empty($user_message)) {
    $message_html =  '<h2>Kullacının size özel bir mesajı var. Mesaj aşağıda verilmiştir;</h2>
    <p>' . $user_message . '</p>';
  }

  $body = '
          <h1>Kişisel Bilgiler</h1></br>
            <ul>
              <li>Mail Adresi : ' . $args["personel_email"] . '</li>
              <li>İsim : ' . $args["personel_first_name"] . '</li>
              <li>Soyisim : ' . $args["personel_last_name"] . '</li>
              <li>Telefon : ' . $args["personel_phone"] . '</li>
            </ul>
          <h1>Firma Bilgileri</h1></br>
            <ul>
              <li>Firma : ' . $args["company_name"] . '</li>
              <li>Telefon : ' . $args["company_phone"] . '</li>
              <li>Vergi dairesi : ' . $args["company_tax_office"] . '</li>
              <li>Vergi Numarası : ' . $args["company_tax_number"] . '</li>
              <li>İl : ' . $args["company_city"] . '</li>
              <li>İlçe: ' . $args["company_district"] . '</li>
              <li>Açık adres : ' . $args["company_adress"] . '</li>
            </ul>
          <h1>Bayilik talep edilen lokasyon bilgileri</h1></br>
            <ul>
              <li>İl : ' . $args["dealer_city"] . '</li>
              <li>İlçe : ' . $args["dealer_district"] . '</li>
              <li>Çalışma şekli : ' . $args["dealer_work_style"] . '</li>
              <li>Ürün grupları : ' . $args["dealer_product_category"] . '</li>
              <li>Yayınlar : ' . $args["dealer_publishing"] . '</li>
              <li>Personel sayısı: ' . $args["dealer_field_personel"] . '</li>
              <li>Firma bilgisi : ' . $args["dealer_history"] . '</li>
            </ul>
          ' . $message_html;
  $headers = array('Content-Type: text/html; charset=UTF-8');
  if (wp_mail($to, $subject, $body, $headers)) {
    error_log("email has been successfully sent to user whose email is " . $user_email);
  } else {
    error_log("email failed to sent to user whose email is " . $user_email);
  }
}
