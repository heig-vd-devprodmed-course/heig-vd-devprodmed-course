## Installation sur `Mac`

#### Installation de `Xcode`

Se rendre dans l'`App Store` et installer `Xcode` 

> Remarque : Prévoir du temps... :roll_eyes:

Lancer `Xcode`, qui va installer les derniers composants nécessaires. Fermer `Xcode`. Redémarrer.

#### Installation de Homebrew

Se rendre à l'url
    https://brew.sh/fr/

Lancer un `terminal` sur mac.

> Pour lancer un `terminal` vous avez différentes options :
>
> - Si vous avez activé `Spotlight` (ou un programme similaire `Alfred`), appuyez sur `COMMAND` + `ESPACE` puis tapez `terminal`
> - Lancez le `Finder`, puis dans le menu `Aller` choisissez l'option `Utilitaires`, puis cliquez sur le programme `Terminal` 
> - Dans `Application`, ouvrir le répertoire nommé `Utilitaires`, puis cliquez sur le programme `Terminal`
> - Dans `Application`, ouvrir le répertoire nommé `Utilitaires`, glissez-déposez le programme `Terminal` dans le `Dock`. Du coup, il suffira de cliquez sur l'icône dans le `Dock`
> - Ouvrir `Lauchpad` et dans la partie recherche tapez `Terminal`, puis cliquez sur le programme `Terminal`
> - Demandez à `Siri` de lancer le `Terminal`

Une fois dans le `Terminal` lancez la commande (!!!!!! le tout sur 1 seule ligne :wink: : 

```
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Entrez votre mot de passe et patientez durant l'installation (cela prend un peu de temps)

#### Installation de `php`, [`composer`](https://getcomposer.org/doc/00-intro.md)et un éditeur de texte [`macVim`](https://www.vim.org/)

Toujours depuis le `terminal`, installez `php`, `composer` et `macvim` à l'aide de la commande :

```
brew install php composer macvim
```

Patientez durant l'installation de ces trois outils.

Pour vous assurer que `php` est installé correctement tapez :

```
php --version
```

ou 

```
php -v
```

> PHP est installé dans `/usr/bin/`
> pour y accéder depuis le `finder` : Aller dans le menu "Aller" puis "Aller au dossier..." puis taper `/usr/bin/`)

Pour savoir où est le fichier `php.ini`

```
php --ini
```

Pour s'assurer que `Composer` est installé, taper :

```
composer
```

#### Installation de [`Valet`](https://laravel.com/docs/10.x/valet#:~:text=Laravel%20Valet%20is%20a%20development,background%20when%20your%20machine%20starts.&text=In%20other%20words%2C%20Valet%20is,roughly%207%20MB%20of%20RAM.) à l'aide de `Composer`

```
composer global require laravel/valet
```

#### Installation du générateur de squelette d'application `Laravel`

```
composer global require laravel/installer
```

Les commandes :

```
laravel
```

et

```
valet
```

ne répondent peut-être pas... (c'est normal !)

Il reste à indiquer à notre `Mac` dans quels répertoires il doit chercher ces commandes. Afin de pouvoir configurer correctement note `Mac`, il faut savoir quel est le terminal utilisé.

> Le mac peut utiliser deux type de terminal :
>
> - `z shell (zsh)` utilisé par défaut sur les `Mac` les plus récents.
> - `bash` utilisé par défaut sur les anciens `Mac`
>
> Pour connaître le terminal utilisé, il suffit de lancer une commande que le `mac`ne connaît pas et de jeter un œil au message d'erreur :wink:
>
> tapons :
>
> ```
> whoareyou
> ```
>
>  Si on obtient le message :
>
> ```
> zsh : command not found : whoareyou
> ```
>
> C'est que le terminal est `zsh` .
>
> Si par contre on obtient le message suivant :
>
> ```
> -bash: whoareyou: command not found
> ```
>
> c'est que le terminal est `bash`.
>
> Pour simplifier la configuration du `Mac`, nous allons utiliser `zsh`
>
> Si le terminal utilisé est un `bash`, voici la commande permettant de passer à `zsh`
>
> ```
> chsh -s $(which zsh)
> ```

Pour indiquer à notre `Mac` dans quel répertoire il doit chercher les commandes `laravel` et `valet`, il faut éditer (ou créer) un fichier nommé `.zprofile` dans notre répertoire de base (maison).
Or, les fichiers commençant par un point (.) sont par cachés par défaut par notre `Mac`. Pour pouvoir visualiser ces fichiers, lancez la commande suivante : 

```
defaults write com.apple.finder AppleShowAllFiles TRUE
```

Puis, pour fermer tous les `Finder` qui seraient ouvert, lancez la commande

```
killall Finder
```

Ouvrez maintenant un nouveau `Finder`, et déplacez vous dans le répertoire de base (icône maison) qui porte normalement votre nom.

> Sinon, dans le menu du haut choisissez `Aller` puis `Allez au dossier...` et tapez :
>
> ```
> ~/
> ```
>
> Le tilde  (~) s'obtient à l'aide de la combinaison de touche `OPTION` et `N` puis espace.

Les fichiers cachés sont maintenant visibles :thumbsup:

Pour éditer ou créer le fichier `.zprofile nous allons utiliser l'éditeur de texte `macvim` fraîchement installé. Dans un `terminal`, lancez la commande :

```
mvim ~/.zprofile
```

> Le tilde  (~) s'obtient toujours à l'aide de la combinaison de touche `OPTION` et `N`

Un carré noir clignote. Pour passer en mode `insertion`, tapez la touche `i` de votre clavier.

Ajoutez la ligne suivante (export...) :

```
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

Pour quitter le mode `insertion` tapez la touche `ESC` (Le carré noir devrait à nouveau clignoter), puis pour sauver et quitter, tapez les 3 (TROIS) lettres suivantes :

```
:wq
```

Pour que notre `Mac` puisse "voir" le nouveau chemin, il faut fermer la fenêtre du `terminal` puis ouvrir un nouveau `terminal`.

La commande : 

```
laravel
```

devrait maintenant fonctionner.

Ainsi que la commande : 

```
valet
```

> Cette commande nécessite votre mot de passe (ou taper `CTRL` et `C` pour quitter `valet`.

Voilà, tout est prêt.
