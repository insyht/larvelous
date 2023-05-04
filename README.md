Hoe het moet gaan werken:
Elke website heeft 1 design, hierin worden dingen als kleuren en stijlen gedefinieerd (eigenlijk dus de css).
De website bestaat uit pagina's.
Elke pagina is gelinkt aan een template.
Een template bestaat uit blokken, bijvoorbeeld een introductieblok of een imageslider blok.
Naast blokken heb je ook nog formulieren, deze kun je net als blokken in een template plaatsen.
Je kunt 1 of meer menus hebben, waarin je paginas kan plaatsen.
In sommige blokken kun je een of meer media bestanden plaatsen, deze zijn apart te beheren onder het kopje Media.
Ook heb je plugins, deze kunnen blokken/formulieren/templates/pagina's/menus/designs bevatten/modificeren.

Dus:

                                                Website--Design
                            ____________________________|____________________
                            |                                               |
                        Pagina--template                                    Pagina--template
                ____________________|                                           ________|________
                |                   |                                           |               |         
                Blok                Blok                                        Blok            Blok 
        ________|________
        |               |
        Media           Media




                                                Website--Design
                            _______________________|_______________________
                            |                                             |
                            Menu                                          Menu
          ___________________|____________              ___________________|____________
          |       |       |       |       |             |       |       |       |       |
        Pagina  Pagina  Pagina  Pagina  Pagina          Pagina  Pagina  Pagina  Pagina  Pagina


Deze boomstructuur wordt in de database opgeslagen in de models, en intern als JSON aangeboden via de website API, 
waarmee het CMS een connectie aan kan gaan. Het CMS heeft de website data dus zelf niet, maar baseert alles op de 
JSON die hij krijgt van de verbonden website. Eventueel zou ik deze JSON ook kunnen gebruiken als cache mechanisme 
op de site om deze sneller te maken (geen db queries meer nodig).
Een voorbeeld:

{
  "website": {
    "design": {
      "theme": "vegas", // Gebruik in de SCSS/themes map de SCSS met naam "vegas". Een theme bevat fonts, column structuren, etc.
      "baseColor1": "#000000", // Basiskleur 1
      "baseColor2": "#000000", // Basiskleur 2
      "shadowColor1": "#000000", // Schaduwkleur 1
      "shadowColor2": "#000000", // Schaduwkleur 2
      "darkColor1": "#000000", // Donkere kleur 1
      "darkColor2": "#000000", // Donkere kleur 2
      "lightColor1": "#000000", // Lichte kleur 1
      "lightColor2": "#000000" // Lichte kleur 2
      "fontColor1": "#000000", // Font kleur 1
      "fontColor2": "#000000", // Font kleur 2
      "fontColor3": "#000000" // Font kleur 3
    },
    "pages" : {
        "home" : {
          "id": 1,
          "title": "Startpagina",
          "url": "/",
          "blocks": [
            {
              "view": "introblock",
              "data": [
                {
                  "name": "title", // In de view heb je een variabele met als naam "title"
                  "value": "Dit is de titel van het intro blok"
                },
                {
                  "name": "content", // In de view heb je een variabele met als naam "content"
                  "value": "Dit is een paragraaf voor de intro"
                }
              ]
            },
            {
              "view": "paragraph",
              "data": [
                {
                  "name": "title",
                  "value": "Titel van een alinea"
                },
                {
                  "name": "subtitle",
                  "value": "Subtitel van alinea"
                },
                {
                  "name": "content",
                  "value": "Tekst van de alinea"
                },
                {
                  "name": "image",
                  "value": 1 // Zie element 1 in "media" in deze JSON
                },
                {
                  "name": "imagePosition",
                  "value": "left"
                },
                {
                  "name": "buttonTitle",
                  "value": "Lees meer"
                },
                {
                  "name": "buttonLink",
                  "value": "https://www.mijnsite.nl/landingspagina-1"
                },
                {
                  "name": "buttonAlt",
                  "value": "Lees meer over deze alinea"
                }
              ]
            },
            {
              "view": "cta",
              "data": [
                {
                  "name": "question",
                  "value": "Meer weten?"
                },
                {
                  "name": "employeeName",
                  "value": "Jordy Thijs"
                },
                {
                  "name": "employeePicture",
                  "value": 2
                },
                {
                  "name": "profession",
                  "value": "directeur"
                },
                {
                  "name": "phoneNumber",
                  "value": "06 12 34 56 78"
                }
              ]
            }
          ]
        },
        "landingspagina 1" : {
          "id":  2,
          "title": "Landingspagina 1",
          "url": "/landingspagina-1",
          "blocks": []
        },
        "landingspagina 2" : {
          "id":  3,
          "title": "Landingspagina 2",
          "url": "/landingspagina-2",
          "blocks": []
        },
        "over ons" : {
          "id":  4,
          "title": "Over ons",
          "url": "/over-ons",
          "blocks": []
        }
      },
    "menus": [
      {
        "id": 1,
        "pages": [
          {
          "id": 1,
          "title": "Homepage",
          "customUrl": null // Als null, dan gewoon de url pakken zoals gedefinieerd onder "pages",
          "subPages": []
          },
          {
          "id": 3,
          "title": "Mijn landingspagina",
          "customUrl": null // Als null, dan gewoon de url pakken zoals gedefinieerd onder "pages",
          "subPages":  []
          },
          {
          "id": null,
          "title": "Google",
          "customUrl": "https://www.google.com",
          "subPages":  []
          }
        ]
      }
    ],
    "media": [
      {
        "id": 1,
        "alt": "alinea afbeelding",
        "url": "https://mijnsite.nl/images/alinea.jpg",
        "url-thumbnail": "https://mijnsite.nl/images/alinea_thumbnail.jpg"
      },
      {
        "id": 2,
        "alt": "Jordy Thijs",
        "url": "https://mijnsite.nl/images/jordy.jpg",
        "url-thumbnail": "https://mijnsite.nl/images/jordy_thumbnail.jpg"
      }
    ],
    "settings": {},
    "plugins": {}
  }
}

Database opbouw:
  pages
      id
      language_id
      template_id
      title
      url (of misschien juist de route?)

  templates (dit is het soort pagina, bijvoorbeeld een textuele pagina of productpagina)
    id
    resource_id (hiermee kan een template specifieke data opvragen)
    label
    view (pad van de Blade View, bijvoorbeeld templates/winkelwagen voor resources/views/templates/winkelwagen.blade.php)
  
  blocks
      id
      resource_id (hiermee kan een template specifieke data opvragen)
      view (pad van de Blade view vanaf de root, bijvoorbeeld insyht/larvelous-base-blocks/resources/views/paragraph voor vendor/insyht/larvelous-base-blocks/resources/views/paragraph.blade.php)
      label
      description  
  
  block_variables
      id
      block_id
      name (naam van de var in de Blade view maar dan zonder het dollarteken)
      label (naam vna het veld zoals de gebruiker het ziet in het CMS)
      type (textfield, textarea, imageselector, pageselector)
      required (boolean)
  
  block_variable_values
      id
      block_variable_id
      language_id
      value
  
  block_variable_value_template_block (koppeltabel tussen template_blocks en block_variable_values)
      id
      template_block_id
      block_variable_value_id
      ordering (Voor als je van 1 block meerdere in een template hebt)

  block_templates (koppeltabel tussen templates en blocks)
      id
      page_id
      block_id
      enabled
      ordering
  
  languages
      id
      name
      abbreviation (ISO-639-1)




SQL om bepaalde blokken te maken: