# MTS Pass

Пример реализации сервиса MTS Pass в связке с OAuth 2.0, позволяющего сторонним разработчикам реализовать возможность авторизации в своих сервисах и приложениях посредством MTS Pass API в один клик.

Так как мы не имеем возможности протестировать работу сервиса в связке с реальной базовой станцией, которая идентифицирует абонента на основе его номера, номер абонента, в качестве теста, передается параметром в API метод.

## API

http://dev1.evgenytk.com/authenticate

 - callback_url - redirect URL сервиса разработчика;
 - phone - телефон для симуляции работы базовой станции;

Пример запроса: 

	http://dev1.evgenytk.com/authenticate?callback_url=http://dev2.evgenytk.com/callback-mts&phone=79121168423
 
После успешной авторизации браузер будет перенаправлен по адресу callback_url. При этом ключ доступа к API token и другие параметры будут переданы в URL-фрагменте ссылки: 

	http://dev2.evgenytk.com/callback-mts?success=1&token=STtytPZEgIVsa95uDajyFAmtigGvAv1K&token_expired=2019-03-24+02%3A06%3A08



