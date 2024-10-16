## Cinemapp használata

A projekt kipróbálásához a klónozás utáni teendők:
- .env.example és .env.testing.example lemásolása és átnevezése az .example végződés nélkül
- `./vendor/bin/sail up` (vagy alias használata esetén pl.: `sail up`) paranccsal elindítani a dockert
- `composer install` parancs futtatása
- `sail artisan migrate` és `sail artisan migrate --env=testing`
- `sail artisan db:seed` és `sail artisan db:seed --env=testing` parancsok futtatása - ez átmásolja a képeket is
- `sail artisan storage:link`
- `sail test` vagy `sail phpunit` lefuttatásával egy sor teszt lefut


Innentől [localhost] -on elérhető a kezdőoldal.
`http://localhost:80/api/` a `{{baseUrl}}` a PostMan-es teszteléshez.

Api dokumentáció a localhost/docs linken elérhető (scribe-al generálva)
