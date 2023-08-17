- Iets maken waarmee ik alle plugins kan opvragen, zodat ik o.a. weet waar ik de seeders van elke plugin kan vinden
- Alle pagina's nabouwen in de database d.m.v. blokken (zie /test waarin ik de homepage nabouw)
  - Maak hier ook migraties / seeds voor!
  - Zie als voorbeeld van een nieuwe pagina met een nieuw block: https://github.com/insyht/larvelous/commit/edae3ff538bf5139e9a551200bfbe855ee890185


Filament:
- Seeder maken die alle data die ik nu heb, bevat. Op die manier kan ik zonder problemen migraties terug -en vooruitspoelen
- Dit moet voor elke plugin worden uitgevoerd elke keer als een plugin wordt geupdate via het systeem (de tag is str_replace('/', '-', $plugin->path)):
  - php artisan vendor:publish --tag=insyht-larvelous-shop --force
- Even de TODOs nalopen in larvelous-shop
