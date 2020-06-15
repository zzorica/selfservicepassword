FROM php:7.2-apache

ARG SSP_VERSION=1.3
ARG SSP_URL=https://github.com/ltb-project/self-service-password/archive/v${SSP_VERSION}.tar.gz

RUN cd /var/www/ && \
    curl -SL $SSP_URL | tar -xz -C /var/www/ && \
    mv self-service-password-${SSP_VERSION}/* html/ && \
    rm -rf self-service-password-${SSP_VERSION}

COPY ssp.conf /etc/apache2/sites-enabled/000-default.conf
COPY config.inc.local.php /var/www/html/conf/config.inc.local.php
RUN chown -R www-data:www-data /var/www/html

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions ldap mcrypt

ENV SSP_DEBUG=false \
    SSP_LDAP_URL="ldap://localhost" \
    SSP_LDAP_STARTTLS=false \
    SSP_LDAP_BINDDN="cn=manager,dc=example,dc=com" \
    SSP_LDAP_BINDPW="secret" \
    SSP_LDAP_BASE="dc=example,dc=com" \
    SSP_LDAP_LOGIN_ATTRIBUTE="uid" \
    SSP_LDAP_FULLNAME_ATTRIBUTE="cn" \
    SSP_LDAP_FILTER="(&(objectClass=person)(uid={login}))" \
    SSP_AD_MODE=false \
    SSP_AD_OPTIONS_FORCE_UNLOCK=false \
    SSP_AD_OPTIONS_FORCE_PWD_CHANGE=fales \
    SSP_AD_OPTIONS_CHANGE_EXPIRED_PASSWORD=false \
    SSP_SAMBA_MODE=false \
    SSP_SAMBA_OPTIONS_MIN_AGE=5 \
    SSP_SAMBA_OPTIONS_MAX_AGE=45 \
    SSP_SHADOW_OPTIONS_UPDATE_SHADOWLASTCHANGE=false \
    SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIRE=false \
    SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIREDAYS=false \
    SSP_HASH="ssha" \
    SSP_HASH_OPTIONS_CRYPT_SALT_PREFIX="$6$" \
    SSP_HASH_OPTIONS_CRYPT_SALT_LENGTH="6" \
    SSP_PWD_MIN_LENGTH=6 \
    SSP_PWD_MAX_LENGTH=0 \
    SSP_PWD_MIN_LOWER=1 \
    SSP_PWD_MIN_UPPER=1 \
    SSP_PWD_MIN_DIGIT=1 \
    SSP_PWD_MIN_SPECIAL=0 \
    SSP_PWD_SPECIAL_CHARS="^a-zA-Z0-9" \
    SSP_PWD_FORBIDDEN_CHARS="@%" \
    SSP_PWD_NO_REUSE=true \
    SSP_PWD_DIFF_LOGIN=true \
    SSP_PWD_COMPLEXITY=3 \
    SSP_USE_PWNEDPASSWORDS=true \
    SSP_PWD_SHOW_POLICY="never" \
    SSP_PWD_SHOW_POLICY_POS="above" \
    SSP_WHO_CHANGE_PASSWORD="user" \
    SSP_USE_CHANGE=true \
    SSP_CHANGE_SSHKEY=true \
    SSP_CHANGE_SSHKEY_ATTRIBUTE="sshPublicKey" \
    SSP_WHO_CHANGE_SSHKEY="user" \
    SSP_NOTIFY_ON_SSHKEY_CHANGE=false \
    SSP_USE_QUESTIONS=false \
    SSP_ANSWER_OBJECTCLASS="extensibleObject" \
    SSP_ANSWER_ATTRIBUTE="info" \
    SSP_CRYPT_ANSWERS=true \
    SSP_MESSAGES_QUESTIONS_ICE="" \
    SSP_USE_TOKENS=true \
    SSP_CRYPT_TOKENS=true \
    SSP_TOKEN_LIFETIME="3600" \
    SSP_MAIL_ATTRIBUTE="mail" \
    SSP_MAIL_ADDRESS_USE_LDAP=true \
    SSP_MAIL_FROM="admin@example.com" \
    SSP_MAIL_FROM_NAME="Self Service Password" \
    SSP_MAIL_SIGNATURE="" \
    SSP_NOTIFY_ON_CHANGE=false \
    SSP_MAIL_SENDMAIL="/usr/sbin/sendmail" \
    SSP_MAIL_PROTOCOL="smtp" \
    SSP_MAIL_SMTP_DEBUG=0 \
    SSP_MAIL_DEBUG_FORMAT="error_log" \
    SSP_MAIL_SMTP_HOST="localhost" \
    SSP_MAIL_SMTP_AUTH=false \
    SSP_MAIL_SMTP_USER="" \
    SSP_MAIL_SMTP_PASS="" \
    SSP_MAIL_SMTP_PORT=25 \
    SSP_MAIL_SMTP_TIMEOUT=30 \
    SSP_MAIL_SMTP_KEEPALIVE=false \
    SSP_MAIL_SMTP_SECURE="tls" \
    SSP_MAIL_SMTP_AUTOTLS=true \
    SSP_MAIL_CONTENTTYPE="text/plain" \
    SSP_MAIL_WORDWRAP=0 \
    SSP_MAIL_CHARSET="utf-8" \
    SSP_MAIL_PRIORITY=3 \
    SSP_MAIL_NEWLINE="PHP_EOL" \
    SSP_USE_SMS=false \
    SSP_SMS_METHOD="mail" \
    SSP_SMS_API_LIB="lib/smsapi.inc.php" \
    SSP_SMS_ATTRIBUTE="mobile" \
    SSP_SMS_PARTIALLY_HIDE_NUMBER=true \
    SSP_SMS_MAIL_TO="{sms_attribute}@service.provider.com" \
    SSP_SMS_MAIL_SUBJECT="Provider code" \
    SSP_SMS_MESSAGES="{smsresetmessage} {smstoken}" \
    SSP_SMS_SANITIZE_NUMBER=false \
    SSP_SMS_TRUNCATE_NUMBER=false \
    SSP_SMS_TRUNCATE_NUMBER_LENGTH=10 \
    SSP_SMS_TOKEN_LENGTH=6 \
    SSP_MAX_ATTEMPTS=3 \
    SSP_KEYPHRASE="secret" \
    SSP_RESET_URL="$_SERVER['HTTP_X_FORWARDED_PROTO'] . \"://\" . $_SERVER['HTTP_X_FORWARDED_HOST'] . $_SERVER['SCRIPT_NAME']" \
    SSP_SHOW_HELP=false \
    SSP_LANG="en" \
    SSP_ALLOWED_LANG="" \
    SSP_SHOW_MENU=true \
    SSP_LOGO="images/ltb-logo.png" \
    SSP_BACKGROUND_IMAGE="images/unsplash-space.jpeg" \
    SSP_LOGIN_FORBIDDEN_CHARS="*()&|" \
    SSP_USE_RECAPTCHA=false \
    SSP_RECAPTCHA_PUBLICKEY="" \
    SSP_RECAPTCHA_PRIVATEKEY="" \
    SSP_RECAPTCHA_THEME="light" \
    SSP_RECAPTCHA_TYPE="image" \
    SSP_RECAPTCHA_SIZE="normal" \
    SSP_RECAPTCHA_REQUEST_METHOD=null \
    SSP_DEFAULT_ACTION="change" \
    SSP_MESSAGES_PASSWRODCHANGED_EXTRAMESSAGE="" \
    SSP_MESSAGES_CHANGEHELP_EXTRAMESSAGE="" \
    SSP_POSTHOOK="/usr/share/self-service-password/posthook.sh" \
    SSP_DISPLAY_POSTHOOK_ERROR=false \
    SSP_OBSCURE_FAILURE_MESSAGES="mailnomatch" \
    SSP_RESET_REQUEST_LOG="" 

