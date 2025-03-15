## Installation sur `Windows`

#### Installation de `php` 8 :

Téléchargez (https://www.php.net/downloads.php) la dernière version stable de
`php 8`

Dézippez le fichier et ajoutez le répertoire `php-8.x` dans un dossier nommé
`PHP` à la racine de votre disque `c:\` ou dans `program files`

> Exemple :
>
> ```
> C:\PHP\PHP-8.x
> ```
>
> ou
>
> ```
> C:\Program Files\PHP\PHP-8.x
> ```

### Installation de `Composer`

Téléchargez la dernière version du gestionnaire de libraire `Composer`
(https://getcomposer.org/download/)

Suivez les étapes et veillez à choisir la bonne version de `php` :eyes:

> Remarques :
>
> - Ne cochez pas la case `Developer mode`
> - Cochez la case `Add this PHP to your path`
> - Ne cochez pas la case `Use a proxy server to connect to Internet`

#### Configuration du fichier php.ini

Pour savoir où est le fichier `php.ini`

```
php --ini
```

Ouvrez le fichier `php.ini` et :

- Mettre la variable `display_errors` à `On` (ligne ~503)

```
display_errors = On
```

et activez les extensions suivantes : (ligne ~923)

- fileinfo
- intl
- pdo_mysql
- pdo_sqlite

#### Installation du créateur de squelette d'application `Laravel`

Dans une fenêtre de type `invite de commande` (Cliquez sur l'icône `windows` en
bas à gauche de votre écran et tapez : cmd ) Lancez la commande :

```
composer global require "laravel/installer"
```

> Remarque :
>
> - Les fichiers seront installés dans
>   c:\users\VOTRE_NOM\AppData\Roaming\Composer\...

Voilà, tout le nécessaire a été installé.
