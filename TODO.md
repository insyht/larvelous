- Iets maken waarmee ik alle plugins kan opvragen, zodat ik o.a. weet waar ik de seeders van elke plugin kan vinden
- Alle pagina's nabouwen in de database d.m.v. blokken (zie /test waarin ik de homepage nabouw)
  - Maak hier ook migraties / seeds voor!
  - Zie als voorbeeld van een nieuwe pagina met een nieuw block: https://github.com/insyht/larvelous/commit/edae3ff538bf5139e9a551200bfbe855ee890185


Filament:
- Werkend krijgen op iwsklanten.nl. Er is nu CORS gezeik wanneer je naar Pagina's > Home > ImageAttention bewerken
  gaat. Ik zie ook dat ik geen config/cors.php heb, die is mogelijk niet meegekomen toen ik een upgrade gedaan had
  naar Laravel 10?

- Ik wil automatisch deployen naar larvelous.app via Deployer. Zie:
  - https://deployer.org/docs/7.x/ci-cd
  - larvelous.app deploy.yaml
  - https://lorisleiva.com/deploy-your-laravel-app-from-scratch/install-and-configure-deployer (Our main deploy task)
  - https://stefanzweifel.dev/posts/2021/05/24/deployer-on-github-actions
