- Seeder maken die alle data die ik nu heb, bevat. Op die manier kan ik zonder problemen migraties terug -en vooruitspoelen
- Dit moet voor elke plugin worden uitgevoerd elke keer als een plugin wordt geupdate via het systeem (de tag is str_replace('/', '-', $plugin->path)):
  - php artisan vendor:publish --tag=insyht-larvelous-shop --force
- Even de TODOs nalopen in larvelous-shop
- Deployment werkt niet meer, hij loopt te zeuren over een missende versie van insyht/larvelous
- Unit en feature test in larvelous-shop werkend maken


Larvelous package:
- Alle migraties en seeders opschonen en misschien mergen/verplaatsen? Ook kijken wat ik nog meer kan seeden door af te kijken bij iwscms2.local
- Een installatiescriptje maken voor alles in INSTALL.md
