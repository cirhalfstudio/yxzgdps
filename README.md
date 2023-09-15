# yxzgdps
## better geometry dash private server by yxzhin studio
### note: still in development

powerful & highly secure gd private server emulator
### note: currently only gd 2.1 is supported

## features
1. three types of verification - captcha, email & discord integration
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
3. check if database update is required (it's on dashboard too)
4. if required, import `latest.sql` from `src/gd_version/database_sql`
