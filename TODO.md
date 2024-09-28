- Dit moet voor elke plugin worden uitgevoerd elke keer als een plugin wordt geupdate via het systeem (de tag is str_replace('/', '-', $plugin->path)):
  - php artisan vendor:publish --tag=insyht-larvelous-shop --force
- Alle migraties en seeders opschonen en misschien mergen/verplaatsen?
- Alle data in de seeders aanpassen zodat het algemenere informatie is, dus niet meer dingen als linda@musthaves4u.nl. Misschien d.m.v. Faker?
- Een installatiescriptje maken voor alles in INSTALL.md

- Testen of install_in_droplet.sh werkt in een splinternieuwe droplet




- Updaten
  - Van tevoren een backup maken van de composer.lock en database, in een mapje met de datum en tijd erbij. Deze moeten terug te zetten zijn via het systeem
- Checken of in de skeleton plugin het InstallPlugin commando wordt aangeroepen wanneer fresh_install true is, en hij moet dit daarna op false zetten
- Themas
  - Installeren
  - Updaten van themes testen (en misschien ook die van plugins weer opnieuw testen vanwege alle wijzigingen)
  - Skeleton theme maken
  - Nieuwe theme maken gebaseerd op https://tailoredtots.ca
