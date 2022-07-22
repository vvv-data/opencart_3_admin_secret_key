# Admin secret Key - Secure your admin access for opencart-3
Protect your Opencart admin by disabling direct login URL access. A user defined or a random key is added to login URL to make the URL impossible to guess. Admin login URL will be changed to something like http://www.site.com/admin/?secret=777

## Модуль Защита админки магазина для OpenCart 3
При помощи модуля можно установить защиту доступа к панели администратора. 
### В настройках модуля можно назначить секретный ключ:
![screenshot1](https://user-images.githubusercontent.com/106067946/180408637-8af19fb1-b0b3-4951-a899-2a3f2f508604.jpg)

### После этого для доступа к странице входа /admin/ нужно будет в адресе указать новый параметр:
![screenshot2](https://user-images.githubusercontent.com/106067946/180410197-439a96da-098c-4220-b789-c8d334f6dbb7.jpg)
Если параметр не указан, то происходит редирект, по дефолту на страницу not found 
### Вы также можете указать свою страницу, на которую будет происходить редирект:
![screenshot3](https://user-images.githubusercontent.com/106067946/180412618-73344d7a-7f7f-44df-819b-354710139a1f.jpg)

### Перед установкой модуля, сделайте бэкап сайта, на всякий случай!
### В крайнем случае, если что то пошло не так можно обнулить настройки модуля:
Для этого сделайте запрос в вашей базе данных (например в phpmyadmin) 
```
DELETE FROM oc_setting WHERE `code` = 'module_admin_secret_key';
```
где где "oc_" равен вашему DB_PREFIX 

Это позволит снова входить в админку без секретного ключа.

## Установка
* Скачайте install.xml и upload. 
* Запакуйте их в zip архив. 
* Переименуйте архив в admin_secret_key.ocmod.zip.
* В - Модули / Расширения - Установка расширений  - загрузите архив.
* В - Модификаторы - обновите модификаторы.
* В - Модули / Расширения - установите модуль, и произведите настройки.
