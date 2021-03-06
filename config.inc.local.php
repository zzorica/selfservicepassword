<?php

if (! function_exists('evalBool')) {
      function evalBool($value)
      {
          return (strcasecmp($value, 'true') ? false : true);
      }
}

$debug = evalBool(getenv("SSP_DEBUG"));
$ldap_url = $_ENV["SSP_LDAP_URL"];
$ldap_starttls = evalBool(getenv("SSP_LDAP_STARTTLS"));
$ldap_binddn = $_ENV["SSP_LDAP_BINDDN"];
$ldap_bindpw = $_ENV["SSP_LDAP_BINDPW"];
$ldap_base = $_ENV["SSP_LDAP_BASE"];
$ldap_login_attribute = $_ENV["SSP_LDAP_LOGIN_ATTRIBUTE"];
$ldap_fullname_attribute = $_ENV["SSP_LDAP_FULLNAME_ATTRIBUTE"];
$ldap_filter = $_ENV["SSP_LDAP_FILTER"];
$ad_mode = evalBool(getenv("SSP_AD_MODE"));
$ad_options['force_unlock'] = evalBool(getenv("SSP_AD_OPTIONS_FORCE_UNLOCK"));
$ad_options['force_pwd_change'] = evalBool(getenv("SSP_AD_OPTIONS_FORCE_PWD_CHANGE"));
$ad_options['change_expired_password'] = evalBool(getenv("SSP_AD_OPTIONS_CHANGE_EXPIRED_PASSWORD"));
$samba_mode = evalBool(getenv("SSP_SAMBA_MODE"));
$samba_options['min_age'] = $_ENV["SSP_SAMBA_OPTIONS_MIN_AGE"];
$samba_options['max_age'] = $_ENV["SSP_SAMBA_OPTIONS_MAX_AGE"];
$shadow_options['update_shadowLastChange'] = evalBool(getenv("SSP_SHADOW_OPTIONS_UPDATE_SHADOWLASTCHANGE"));
$shadow_options['update_shadowExpire'] = evalBool(getenv("SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIRE"));
$shadow_options['shadow_expire_days'] = $_ENV["SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIREDAYS"];
$hash = $_ENV["SSP_HASH"];
$hash_options['crypt_salt_prefix'] = $_ENV["SSP_HASH_OPTIONS_CRYPT_SALT_PREFIX"];
$hash_options['crypt_salt_length'] = $_ENV["SSP_HASH_OPTIONS_CRYPT_SALT_LENGTH"];
$pwd_min_length = $_ENV["SSP_PWD_MIN_LENGTH"];
$pwd_max_length = $_ENV["SSP_PWD_MAX_LENGTH"];
$pwd_min_lower = $_ENV["SSP_PWD_MIN_LOWER"];
$pwd_min_upper = $_ENV["SSP_PWD_MIN_UPPER"];
$pwd_min_digit = $_ENV["SSP_PWD_MIN_DIGIT"];
$pwd_min_special = $_ENV["SSP_PWD_MIN_SPECIAL"];
$pwd_special_chars = $_ENV["SSP_PWD_SPECIAL_CHARS"];
$pwd_forbidden_chars = $_ENV["SSP_PWD_FORBIDDEN_CHARS"];
$pwd_no_reuse = evalBool(getenv("SSP_PWD_NO_REUSE"));
$pwd_diff_login = evalBool(getenv("SSP_PWD_DIFF_LOGIN"));
$pwd_complexity = $_ENV["SSP_PWD_COMPLEXITY"];
$use_pwnedpasswords = evalBool(getenv("SSP_USE_PWNEDPASSWORDS"));
$pwd_show_policy = $_ENV["SSP_PWD_SHOW_POLICY"];
$pwd_show_policy_pos = $_ENV["SSP_PWD_SHOW_POLICY_POS"];
$who_change_password = $_ENV["SSP_WHO_CHANGE_PASSWORD"];
$use_change = evalBool(getenv("SSP_USE_CHANGE"));
$change_sshkey = evalBool(getenv("SSP_CHANGE_SSHKEY"));
$change_sshkey_attribute = $_ENV["SSP_CHANGE_SSHKEY_ATTRIBUTE"];
$who_change_sshkey = $_ENV["SSP_WHO_CHANGE_SSHKEY"];
$notify_on_sshkey_change = evalBool(getenv("SSP_NOTIFY_ON_SSHKEY_CHANGE"));
$use_questions = evalBool(getenv("SSP_USE_QUESTIONS"));
$answer_objectClass = $_ENV["SSP_ANSWER_OBJECTCLASS"];
$answer_attribute = $_ENV["SSP_ANSWER_ATTRIBUTE"];
$crypt_answers = evalBool(getenv("SSP_CRYPT_ANSWERS"));
$messages['questions']['ice'] = $_ENV["SSP_MESSAGES_QUESTIONS_ICE"];
$use_tokens = evalBool(getenv("SSP_USE_TOKENS"));
$crypt_tokens = evalBool(getenv("SSP_CRYPT_TOKENS"));
$token_lifetime = $_ENV["SSP_TOKEN_LIFETIME"];
$mail_attribute = $_ENV["SSP_MAIL_ATTRIBUTE"];
$mail_address_use_ldap = evalBool(getenv("SSP_MAIL_ADDRESS_USE_LDAP"));
$mail_from = $_ENV["SSP_MAIL_FROM"];
$mail_from_name = $_ENV["SSP_MAIL_FROM_NAME"];
$mail_signature = $_ENV["SSP_MAIL_SIGNATURE"];
$notify_on_change = $_ENV["SSP_NOTIFY_ON_CHANGE"];
$mail_sendmailpath = $_ENV["SSP_MAIL_SENDMAIL"];
$mail_protocol = $_ENV["SSP_MAIL_PROTOCOL"];
$mail_smtp_debug = $_ENV["SSP_MAIL_SMTP_DEBUG"];
$mail_debug_format = $_ENV["SSP_MAIL_DEBUG_FORMAT"];
$mail_smtp_host = $_ENV["SSP_MAIL_SMTP_HOST"];
$mail_smtp_auth = evalBool(getenv("SSP_MAIL_SMTP_AUTH"));
$mail_smtp_user = $_ENV["SSP_MAIL_SMTP_USER"];
$mail_smtp_pass = $_ENV["SSP_MAIL_SMTP_PASS"];
$mail_smtp_port = $_ENV["SSP_MAIL_SMTP_PORT"];
$mail_smtp_timeout = $_ENV["SSP_MAIL_SMTP_TIMEOUT"];
$mail_smtp_keepalive = evalBool(getenv("SSP_MAIL_SMTP_KEEPALIVE"));
$mail_smtp_secure = $_ENV["SSP_MAIL_SMTP_SECURE"];
$mail_smtp_autotls = evalBool(getenv("SSP_MAIL_SMTP_AUTOTLS"));
$mail_contenttype = $_ENV["SSP_MAIL_CONTENTTYPE"];
$mail_wordwrap = $_ENV["SSP_MAIL_WORDWRAP"];
$mail_charset = $_ENV["SSP_MAIL_CHARSET"];
$mail_priority = $_ENV["SSP_MAIL_PRIORITY"];

if ( getenv("SSP_MAIL_NEWLINE") == "" ) {
  #$mail_newline;
} else {
  $mail_newline = getenv("SSP_MAIL_NEWLINE");
}

$use_sms =  evalBool(getenv("SSP_USE_SMS"));
$sms_method = $_ENV["SSP_SMS_METHOD"];
$sms_api_lib = $_ENV["SSP_SMS_API_LIB"];
$sms_attribute = $_ENV["SSP_SMS_ATTRIBUTE"];
$sms_partially_hide_number = evalBool(getenv("SSP_SMS_PARTIALLY_HIDE_NUMBER"));
$smsmailto = $_ENV["SSP_SMS_MAIL_TO"];
$smsmail_subject = $_ENV["SSP_SMS_MAIL_SUBJECT"];
$sms_message = $_ENV["SSP_SMS_MESSAGES"];
$sms_sanitize_number = evalBool(getenv("SSP_SMS_SANITIZE_NUMBER"));
$sms_truncate_number = evalBool(getenv("SSP_SMS_TRUNCATE_NUMBER"));
$sms_truncate_number_length = $_ENV["SSP_SMS_TRUNCATE_NUMBER_LENGTH"];
$sms_token_length = $_ENV["SSP_SMS_TOKEN_LENGTH"];
$max_attempts = $_ENV["SSP_MAX_ATTEMPTS"];
$keyphrase = $_ENV["SSP_KEYPHRASE"];

if ( $_ENV["SSP_RESET_URL"] == "" ) {
  #$reset_url = $_ENV["SSP_RESET_URL"];
} else {  
  $reset_url = $_ENV["SSP_RESET_URL"];
}

$show_help = evalBool(getenv("SSP_SHOW_HELP"));
$lang = $_ENV["SSP_LANG"];
$allowed_lang = array($_ENV["SSP_ALLOWED_LANG"]);
$show_menu = evalBool(getenv("SSP_SHOW_MENU"));
$logo = $_ENV["SSP_LOGO"];
$background_image = $_ENV["SSP_BACKGROUND_IMAGE"];

if ($_ENV["SSP_RESET_REQUEST_LOG"] == "" ) {
  #$reset_request_log;
} else {
  $reset_request_log = $_ENV["SSP_RESET_REQUEST_LOG"];
}

$login_forbidden_chars = $_ENV["SSP_LOGIN_FORBIDDEN_CHARS"];
$use_recaptcha = evalBool(getenv("SSP_USE_RECAPTCHA"));
$recaptcha_publickey = $_ENV["SSP_RECAPTCHA_PUBLICKEY"];
$recaptcha_privatekey = $_ENV["SSP_RECAPTCHA_PRIVATEKEY"];
$recaptcha_theme = $_ENV["SSP_RECAPTCHA_THEME"];
$recaptcha_type = $_ENV["SSP_RECAPTCHA_TYPE"];
$recaptcha_size = $_ENV["SSP_RECAPTCHA_SIZE"];
$recaptcha_request_method = $_ENV["SSP_RECAPTCHA_REQUEST_METHOD"];
$default_action = $_ENV["SSP_DEFAULT_ACTION"];

if ($_ENV["SSP_MESSAGES_PASSWRODCHANGED_EXTRAMESSAGE"] == "" ) {
  #$messages['passwordchangedextramessage'] 
} else {
  $messages['passwordchangedextramessage'] = $_ENV["SSP_MESSAGES_PASSWRODCHANGED_EXTRAMESSAGE"];
}

if ($_ENV["SSP_MESSAGES_CHANGEHELP_EXTRAMESSAGE"] == "" ) {
  #$messages['changehelpextramessage'] 

} else {
  $messages['changehelpextramessage'] = $_ENV["SSP_MESSAGES_CHANGEHELP_EXTRAMESSAGE"];
}

if ( $_ENV["SSP_POSTHOOK"] == "") {
  #$posthook;
} else {
  $posthook = $_ENV["SSP_POSTHOOK"];
}  

if ( getenv("SSP_DISPLAY_POSTHOOK_ERROR") == "" ) {
  #$display_posthook_error;
} else {  
  $display_posthook_error = evalBool(getenv("SSP_DISPLAY_POSTHOOK_ERROR"));
}

if ( $_ENV["SSP_OBSCURE_FAILURE_MESSAGES"] == "" ) { 
  #$obscure_failure_messages;
} else {
  $obscure_failure_messages = array($_ENV["SSP_OBSCURE_FAILURE_MESSAGES"]);
}

?>
