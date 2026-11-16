<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validatie Taalregels
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels bevatten de standaard foutmeldingen die door de
    | validator class worden gebruikt. Sommige regels hebben meerdere versies
    | zoals de size-regels. Voel je vrij om deze berichten aan te passen.
    |
    */

    'accepted' => 'Het :attribute veld moet geaccepteerd worden.',
    'accepted_if' => 'Het :attribute veld moet geaccepteerd worden wanneer :other :value is.',
    'active_url' => 'Het :attribute veld moet een geldige URL zijn.',
    'after' => 'Het :attribute veld moet een datum na :date zijn.',
    'after_or_equal' => 'Het :attribute veld moet een datum na of gelijk aan :date zijn.',
    'alpha' => 'Het :attribute veld mag alleen letters bevatten.',
    'alpha_dash' => 'Het :attribute veld mag alleen letters, cijfers, streepjes en underscores bevatten.',
    'alpha_num' => 'Het :attribute veld mag alleen letters en cijfers bevatten.',
    'any_of' => 'Het :attribute veld is ongeldig.',
    'array' => 'Het :attribute veld moet een array zijn.',
    'ascii' => 'Het :attribute veld mag alleen single-byte alfanumerieke tekens en symbolen bevatten.',
    'before' => 'Het :attribute veld moet een datum voor :date zijn.',
    'before_or_equal' => 'Het :attribute veld moet een datum voor of gelijk aan :date zijn.',
    'between' => [
        'array' => 'Het :attribute veld moet tussen :min en :max items bevatten.',
        'file' => 'Het :attribute veld moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet tussen :min en :max zijn.',
        'string' => 'Het :attribute veld moet tussen :min en :max tekens bevatten.',
    ],
    'boolean' => 'Het :attribute veld moet true of false zijn.',
    'can' => 'Het :attribute veld bevat een niet-toegestane waarde.',
    'confirmed' => 'De bevestiging van het :attribute veld komt niet overeen.',
    'contains' => 'Het :attribute veld mist een vereiste waarde.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Het :attribute veld moet een geldige datum zijn.',
    'date_equals' => 'Het :attribute veld moet een datum gelijk aan :date zijn.',
    'date_format' => 'Het :attribute veld moet overeenkomen met het formaat :format.',
    'decimal' => 'Het :attribute veld moet :decimal decimalen hebben.',
    'declined' => 'Het :attribute veld moet geweigerd worden.',
    'declined_if' => 'Het :attribute veld moet geweigerd worden wanneer :other :value is.',
    'different' => 'Het :attribute veld en :other moeten verschillend zijn.',
    'digits' => 'Het :attribute veld moet :digits cijfers zijn.',
    'digits_between' => 'Het :attribute veld moet tussen :min en :max cijfers zijn.',
    'dimensions' => 'Het :attribute veld heeft ongeldige afbeeldingsafmetingen.',
    'distinct' => 'Het :attribute veld heeft een dubbele waarde.',
    'doesnt_contain' => 'Het :attribute veld mag geen van de volgende bevatten: :values.',
    'doesnt_end_with' => 'Het :attribute veld mag niet eindigen met een van de volgende: :values.',
    'doesnt_start_with' => 'Het :attribute veld mag niet beginnen met een van de volgende: :values.',
    'email' => 'Het :attribute veld moet een geldig e-mailadres zijn.',
    'encoding' => 'Het :attribute veld moet gecodeerd zijn in :encoding.',
    'ends_with' => 'Het :attribute veld moet eindigen met een van de volgende: :values.',
    'enum' => 'De geselecteerde :attribute is ongeldig.',
    'exists' => 'De geselecteerde :attribute is ongeldig.',
    'extensions' => 'Het :attribute veld moet een van de volgende extensies hebben: :values.',
    'file' => 'Het :attribute veld moet een bestand zijn.',
    'filled' => 'Het :attribute veld moet een waarde hebben.',
    'gt' => [
        'array' => 'Het :attribute veld moet meer dan :value items bevatten.',
        'file' => 'Het :attribute veld moet groter zijn dan :value kilobytes.',
        'numeric' => 'Het :attribute veld moet groter zijn dan :value.',
        'string' => 'Het :attribute veld moet groter zijn dan :value tekens.',
    ],
    'gte' => [
        'array' => 'Het :attribute veld moet :value items of meer bevatten.',
        'file' => 'Het :attribute veld moet groter dan of gelijk aan :value kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet groter dan of gelijk aan :value zijn.',
        'string' => 'Het :attribute veld moet groter dan of gelijk aan :value tekens zijn.',
    ],
    'hex_color' => 'Het :attribute veld moet een geldige hexadecimale kleur zijn.',
    'image' => 'Het :attribute veld moet een afbeelding zijn.',
    'in' => 'De geselecteerde :attribute is ongeldig.',
    'in_array' => 'Het :attribute veld moet bestaan in :other.',
    'in_array_keys' => 'Het :attribute veld moet ten minste een van de volgende sleutels bevatten: :values.',
    'integer' => 'Het :attribute veld moet een geheel getal zijn.',
    'ip' => 'Het :attribute veld moet een geldig IP-adres zijn.',
    'ipv4' => 'Het :attribute veld moet een geldig IPv4-adres zijn.',
    'ipv6' => 'Het :attribute veld moet een geldig IPv6-adres zijn.',
    'json' => 'Het :attribute veld moet een geldige JSON-string zijn.',
    'list' => 'Het :attribute veld moet een lijst zijn.',
    'lowercase' => 'Het :attribute veld moet in kleine letters zijn.',
    'lt' => [
        'array' => 'Het :attribute veld moet minder dan :value items bevatten.',
        'file' => 'Het :attribute veld moet kleiner zijn dan :value kilobytes.',
        'numeric' => 'Het :attribute veld moet kleiner zijn dan :value.',
        'string' => 'Het :attribute veld moet kleiner zijn dan :value tekens.',
    ],
    'lte' => [
        'array' => 'Het :attribute veld mag niet meer dan :value items bevatten.',
        'file' => 'Het :attribute veld moet kleiner dan of gelijk aan :value kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet kleiner dan of gelijk aan :value zijn.',
        'string' => 'Het :attribute veld moet kleiner dan of gelijk aan :value tekens zijn.',
    ],
    'mac_address' => 'Het :attribute veld moet een geldig MAC-adres zijn.',
    'max' => [
        'array' => 'Het :attribute veld mag niet meer dan :max items bevatten.',
        'file' => 'Het :attribute veld mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'Het :attribute veld mag niet groter zijn dan :max.',
        'string' => 'Het :attribute veld mag niet groter zijn dan :max tekens.',
    ],
    'max_digits' => 'Het :attribute veld mag niet meer dan :max cijfers hebben.',
    'mimes' => 'Het :attribute veld moet een bestand van het type: :values zijn.',
    'mimetypes' => 'Het :attribute veld moet een bestand van het type: :values zijn.',
    'min' => [
        'array' => 'Het :attribute veld moet ten minste :min items bevatten.',
        'file' => 'Het :attribute veld moet ten minste :min kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet ten minste :min zijn.',
        'string' => 'Het :attribute veld moet ten minste :min tekens bevatten.',
    ],
    'min_digits' => 'Het :attribute veld moet ten minste :min cijfers hebben.',
    'missing' => 'Het :attribute veld moet ontbreken.',
    'missing_if' => 'Het :attribute veld moet ontbreken wanneer :other :value is.',
    'missing_unless' => 'Het :attribute veld moet ontbreken tenzij :other :value is.',
    'missing_with' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig zijn.',
    'multiple_of' => 'Het :attribute veld moet een veelvoud van :value zijn.',
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het formaat van het :attribute veld is ongeldig.',
    'numeric' => 'Het :attribute veld moet een getal zijn.',
    'password' => [
        'letters' => 'Het :attribute veld moet ten minste één letter bevatten.',
        'mixed' => 'Het :attribute veld moet ten minste één hoofdletter en één kleine letter bevatten.',
        'numbers' => 'Het :attribute veld moet ten minste één cijfer bevatten.',
        'symbols' => 'Het :attribute veld moet ten minste één symbool bevatten.',
        'uncompromised' => 'Het opgegeven :attribute is verschenen in een datalek. Kies een ander :attribute.',
    ],
    'present' => 'Het :attribute veld moet aanwezig zijn.',
    'present_if' => 'Het :attribute veld moet aanwezig zijn wanneer :other :value is.',
    'present_unless' => 'Het :attribute veld moet aanwezig zijn tenzij :other :value is.',
    'present_with' => 'Het :attribute veld moet aanwezig zijn wanneer :values aanwezig is.',
    'present_with_all' => 'Het :attribute veld moet aanwezig zijn wanneer :values aanwezig zijn.',
    'prohibited' => 'Het :attribute veld is verboden.',
    'prohibited_if' => 'Het :attribute veld is verboden wanneer :other :value is.',
    'prohibited_if_accepted' => 'Het :attribute veld is verboden wanneer :other geaccepteerd is.',
    'prohibited_if_declined' => 'Het :attribute veld is verboden wanneer :other geweigerd is.',
    'prohibited_unless' => 'Het :attribute veld is verboden tenzij :other in :values is.',
    'prohibits' => 'Het :attribute veld verbiedt dat :other aanwezig is.',
    'regex' => 'Het formaat van het :attribute veld is ongeldig.',
    'required' => 'Het :attribute veld is verplicht.',
    'required_array_keys' => 'Het :attribute veld moet entries bevatten voor: :values.',
    'required_if' => 'Het :attribute veld is verplicht wanneer :other :value is.',
    'required_if_accepted' => 'Het :attribute veld is verplicht wanneer :other geaccepteerd is.',
    'required_if_declined' => 'Het :attribute veld is verplicht wanneer :other geweigerd is.',
    'required_unless' => 'Het :attribute veld is verplicht tenzij :other in :values is.',
    'required_with' => 'Het :attribute veld is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Het :attribute veld is verplicht wanneer :values aanwezig zijn.',
    'required_without' => 'Het :attribute veld is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het :attribute veld is verplicht wanneer geen van :values aanwezig is.',
    'same' => 'Het :attribute veld moet overeenkomen met :other.',
    'size' => [
        'array' => 'Het :attribute veld moet :size items bevatten.',
        'file' => 'Het :attribute veld moet :size kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet :size zijn.',
        'string' => 'Het :attribute veld moet :size tekens zijn.',
    ],
    'starts_with' => 'Het :attribute veld moet beginnen met een van de volgende: :values.',
    'string' => 'Het :attribute veld moet een string zijn.',
    'timezone' => 'Het :attribute veld moet een geldige tijdzone zijn.',
    'unique' => 'Het :attribute is al in gebruik.',
    'uploaded' => 'Het :attribute is niet geüpload.',
    'uppercase' => 'Het :attribute veld moet in hoofdletters zijn.',
    'url' => 'Het :attribute veld moet een geldige URL zijn.',
    'ulid' => 'Het :attribute veld moet een geldige ULID zijn.',
    'uuid' => 'Het :attribute veld moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Aangepaste Validatie Taalregels
    |--------------------------------------------------------------------------
    |
    | Hier kun je aangepaste validatieberichten specificeren voor attributen
    | met de conventie "attribute.rule" om de regels te benoemen. Dit maakt
    | het snel mogelijk om een specifieke aangepaste taalregel te specificeren
    | voor een gegeven attribuutregel.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Aangepaste Validatie Attributen
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels worden gebruikt om onze attribuut-placeholder te
    | vervangen door iets gebruiksvriendelijkers, zoals "E-mailadres" in plaats
    | van "email". Dit helpt ons om onze berichten expressiever te maken.
    |
    */

    'attributes' => [],

];