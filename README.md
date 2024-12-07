# yxzgdps v1.0
## better geometry dash private server emulator
made by @yxzhin-studio-inc with love <3
special thanks to @svlemogames

## note: still in development
## note: currently only gd 2.1 is supported
- latest version: backend - vBK-0.1_alpha, database - vDB-0.1_alpha
- last update: 10:36 27.09.2023.

## changelog/version history
- see `/changelog`
- latest log: backend - `/vBK-0.1_alpha/27-09-2023/18-10`, database - `/vDB-0.1_alpha/27-09-2023/18-10`

## contact/devlog
- my telegram (russian/english/serbian): @yxzhin
- telegram channel (russian only): t.me/ae_yuzhin
- discord: currently unavailable

## credits
- @Cvolton for the original GMDprivateServer: https://github.com/Cvolton/GMDprivateServer
- @CryptonGamesInc for the `yxzcore/lib/encryptor.php` algorithm: https://github.com/CryptonGamesInc/CryptonEncryption
- @sathoro for the `yxzcore/lib/XORCipher.php` code: https://github.com/sathoro/php-xor-cipher

## features
1. three types of verification - captcha, email verifying & discord integration
2. auto giving creator points
3. auto banning exploits
4. better cron
5. working ip ban
6. better dashboard
7. better logs
8. caching system for better perfomance
9. optimization
10. more tools

## requirements
1. php >7.3 (tested on 8.0)
2. discord webhook for integration (if enabled)
3. smtp server for email verifying (if enabled)

## setup
1. upload all from `src/gd_version/backend/latest` on the webserver
2. edit `yxzcore/config/connection.php` & other config
3. import `latest.sql` from `src/gd_version/database_sql` into the database

## updating
0. check if update is actually required (backend version can be found on `dashboard`)
1. if required, delete everything from your webserver **EXCEPT** the `yxzcore/config, data/accounts & data/levels`
2. upload new version from `src/gd_version/backend/latest` (do not forget to **disable** the "replace existing folders")
3. check if database update is required (its version is on dashboard too)
4. if required, import `latest.sql` from `src/gd_version/database_sql`
