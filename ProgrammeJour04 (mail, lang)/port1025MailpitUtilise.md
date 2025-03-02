Démarrer mailpit sur un port différent:

```
mailpit -s localhost:3000
```

Ensuite on modifie le .env

```plaintext
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=3000
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="monServeurMail@monSuperSite.ch"
MAIL_FROM_NAME="${APP_NAME}"
```

 

On éxécute les commandes:

> php artisan route:clear
> php artisan config:cache