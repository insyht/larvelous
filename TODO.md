- Dit moet voor elke plugin worden uitgevoerd elke keer als een plugin wordt geupdate via het systeem (de tag is str_replace('/', '-', $plugin->path)):
  - php artisan vendor:publish --tag=insyht-larvelous-shop --force
- Even de TODOs nalopen in larvelous-shop
- Deployment werkt niet meer, hij loopt te zeuren over een missende versie van insyht/larvelous
- Unit en feature test in larvelous-shop werkend maken


Larvelous package:
- Alle migraties en seeders opschonen en misschien mergen/verplaatsen?
- Alle data in de seeders aanpassen zodat het algemenere informatie is, dus niet meer dingen als linda@musthaves4u.nl. Misschien d.m.v. Faker?
- Een installatiescriptje maken voor alles in INSTALL.md
- Categorie producten pagination aantal items per pagina instelbaar maken
