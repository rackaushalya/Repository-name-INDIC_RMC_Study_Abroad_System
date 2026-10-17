<?php

namespace App\Support;

/**
 * Every country (ISO 3166-1), so the site can fill in country codes and show
 * flags automatically. Each entry: [2-letter code, 3-letter code, names...].
 * The first name is the everyday English name.
 *
 * Generated from the official ISO 3166-1 list, with common extra names
 * (UK, USA, UAE, South Korea, ...) added.
 */
class CountryCodes
{
    public const COUNTRIES = [
        ['AF', 'AFG', ['Afghanistan', 'Islamic Republic of Afghanistan']],
        ['AL', 'ALB', ['Albania', 'Republic of Albania']],
        ['DZ', 'DZA', ['Algeria', 'People\'s Democratic Republic of Algeria']],
        ['AS', 'ASM', ['American Samoa']],
        ['AD', 'AND', ['Andorra', 'Principality of Andorra']],
        ['AO', 'AGO', ['Angola', 'Republic of Angola']],
        ['AI', 'AIA', ['Anguilla']],
        ['AQ', 'ATA', ['Antarctica']],
        ['AG', 'ATG', ['Antigua & Barbuda', 'Antigua and Barbuda']],
        ['AR', 'ARG', ['Argentina', 'Argentine Republic']],
        ['AM', 'ARM', ['Armenia', 'Republic of Armenia']],
        ['AW', 'ABW', ['Aruba']],
        ['AU', 'AUS', ['Australia']],
        ['AT', 'AUT', ['Austria', 'Republic of Austria']],
        ['AZ', 'AZE', ['Azerbaijan', 'Republic of Azerbaijan']],
        ['BS', 'BHS', ['Bahamas', 'Commonwealth of the Bahamas']],
        ['BH', 'BHR', ['Bahrain', 'Kingdom of Bahrain']],
        ['BD', 'BGD', ['Bangladesh', 'People\'s Republic of Bangladesh']],
        ['BB', 'BRB', ['Barbados']],
        ['BY', 'BLR', ['Belarus', 'Republic of Belarus']],
        ['BE', 'BEL', ['Belgium', 'Kingdom of Belgium']],
        ['BZ', 'BLZ', ['Belize']],
        ['BJ', 'BEN', ['Benin', 'Republic of Benin']],
        ['BM', 'BMU', ['Bermuda']],
        ['BT', 'BTN', ['Bhutan', 'Kingdom of Bhutan']],
        ['BO', 'BOL', ['Bolivia', 'Bolivia, Plurinational State of', 'Plurinational State of Bolivia']],
        ['BA', 'BIH', ['Bosnia & Herzegovina', 'Bosnia and Herzegovina', 'Republic of Bosnia and Herzegovina']],
        ['BW', 'BWA', ['Botswana', 'Republic of Botswana']],
        ['BV', 'BVT', ['Bouvet Island']],
        ['BR', 'BRA', ['Brazil', 'Federative Republic of Brazil']],
        ['IO', 'IOT', ['British Indian Ocean Territory']],
        ['VG', 'VGB', ['British Virgin Islands', 'Virgin Islands, British']],
        ['BN', 'BRN', ['Brunei', 'Brunei Darussalam']],
        ['BG', 'BGR', ['Bulgaria', 'Republic of Bulgaria']],
        ['BF', 'BFA', ['Burkina Faso']],
        ['BI', 'BDI', ['Burundi', 'Republic of Burundi']],
        ['KH', 'KHM', ['Cambodia', 'Kingdom of Cambodia']],
        ['CM', 'CMR', ['Cameroon', 'Republic of Cameroon']],
        ['CA', 'CAN', ['Canada']],
        ['CV', 'CPV', ['Cape Verde', 'Cabo Verde', 'Republic of Cabo Verde']],
        ['BQ', 'BES', ['Caribbean Netherlands', 'Bonaire, Sint Eustatius and Saba']],
        ['KY', 'CYM', ['Cayman Islands']],
        ['CF', 'CAF', ['Central African Republic']],
        ['TD', 'TCD', ['Chad', 'Republic of Chad']],
        ['CL', 'CHL', ['Chile', 'Republic of Chile']],
        ['CN', 'CHN', ['China', 'People\'s Republic of China']],
        ['CX', 'CXR', ['Christmas Island']],
        ['CC', 'CCK', ['Cocos (Keeling) Islands']],
        ['CO', 'COL', ['Colombia', 'Republic of Colombia']],
        ['KM', 'COM', ['Comoros', 'Union of the Comoros']],
        ['CG', 'COG', ['Congo - Brazzaville', 'Congo', 'Republic of the Congo', 'Congo Brazzaville']],
        ['CD', 'COD', ['Congo - Kinshasa', 'Congo, The Democratic Republic of the', 'DR Congo', 'Democratic Republic of the Congo', 'Congo Kinshasa']],
        ['CK', 'COK', ['Cook Islands']],
        ['CR', 'CRI', ['Costa Rica', 'Republic of Costa Rica']],
        ['HR', 'HRV', ['Croatia', 'Republic of Croatia']],
        ['CU', 'CUB', ['Cuba', 'Republic of Cuba']],
        ['CW', 'CUW', ['Curaçao']],
        ['CY', 'CYP', ['Cyprus', 'Republic of Cyprus']],
        ['CZ', 'CZE', ['Czechia', 'Czech Republic']],
        ['CI', 'CIV', ['Côte d’Ivoire', 'Côte d\'Ivoire', 'Republic of Côte d\'Ivoire', 'Ivory Coast']],
        ['DK', 'DNK', ['Denmark', 'Kingdom of Denmark']],
        ['DJ', 'DJI', ['Djibouti', 'Republic of Djibouti']],
        ['DM', 'DMA', ['Dominica', 'Commonwealth of Dominica']],
        ['DO', 'DOM', ['Dominican Republic']],
        ['EC', 'ECU', ['Ecuador', 'Republic of Ecuador']],
        ['EG', 'EGY', ['Egypt', 'Arab Republic of Egypt']],
        ['SV', 'SLV', ['El Salvador', 'Republic of El Salvador']],
        ['GQ', 'GNQ', ['Equatorial Guinea', 'Republic of Equatorial Guinea']],
        ['ER', 'ERI', ['Eritrea', 'the State of Eritrea']],
        ['EE', 'EST', ['Estonia', 'Republic of Estonia']],
        ['SZ', 'SWZ', ['Eswatini', 'Kingdom of Eswatini', 'Swaziland']],
        ['ET', 'ETH', ['Ethiopia', 'Federal Democratic Republic of Ethiopia']],
        ['FK', 'FLK', ['Falkland Islands', 'Falkland Islands (Malvinas)']],
        ['FO', 'FRO', ['Faroe Islands']],
        ['FJ', 'FJI', ['Fiji', 'Republic of Fiji']],
        ['FI', 'FIN', ['Finland', 'Republic of Finland']],
        ['FR', 'FRA', ['France', 'French Republic']],
        ['GF', 'GUF', ['French Guiana']],
        ['PF', 'PYF', ['French Polynesia']],
        ['TF', 'ATF', ['French Southern Territories']],
        ['GA', 'GAB', ['Gabon', 'Gabonese Republic']],
        ['GM', 'GMB', ['Gambia', 'Republic of the Gambia']],
        ['GE', 'GEO', ['Georgia']],
        ['DE', 'DEU', ['Germany', 'Federal Republic of Germany']],
        ['GH', 'GHA', ['Ghana', 'Republic of Ghana']],
        ['GI', 'GIB', ['Gibraltar']],
        ['GR', 'GRC', ['Greece', 'Hellenic Republic']],
        ['GL', 'GRL', ['Greenland']],
        ['GD', 'GRD', ['Grenada']],
        ['GP', 'GLP', ['Guadeloupe']],
        ['GU', 'GUM', ['Guam']],
        ['GT', 'GTM', ['Guatemala', 'Republic of Guatemala']],
        ['GG', 'GGY', ['Guernsey']],
        ['GN', 'GIN', ['Guinea', 'Republic of Guinea']],
        ['GW', 'GNB', ['Guinea-Bissau', 'Republic of Guinea-Bissau']],
        ['GY', 'GUY', ['Guyana', 'Republic of Guyana']],
        ['HT', 'HTI', ['Haiti', 'Republic of Haiti']],
        ['HM', 'HMD', ['Heard & McDonald Islands', 'Heard Island and McDonald Islands']],
        ['HN', 'HND', ['Honduras', 'Republic of Honduras']],
        ['HK', 'HKG', ['Hong Kong SAR China', 'Hong Kong', 'Hong Kong Special Administrative Region of China']],
        ['HU', 'HUN', ['Hungary']],
        ['IS', 'ISL', ['Iceland', 'Republic of Iceland']],
        ['IN', 'IND', ['India', 'Republic of India']],
        ['ID', 'IDN', ['Indonesia', 'Republic of Indonesia']],
        ['IR', 'IRN', ['Iran', 'Iran, Islamic Republic of', 'Islamic Republic of Iran']],
        ['IQ', 'IRQ', ['Iraq', 'Republic of Iraq']],
        ['IE', 'IRL', ['Ireland']],
        ['IM', 'IMN', ['Isle of Man']],
        ['IL', 'ISR', ['Israel', 'State of Israel']],
        ['IT', 'ITA', ['Italy', 'Italian Republic']],
        ['JM', 'JAM', ['Jamaica']],
        ['JP', 'JPN', ['Japan']],
        ['JE', 'JEY', ['Jersey']],
        ['JO', 'JOR', ['Jordan', 'Hashemite Kingdom of Jordan']],
        ['KZ', 'KAZ', ['Kazakhstan', 'Republic of Kazakhstan']],
        ['KE', 'KEN', ['Kenya', 'Republic of Kenya']],
        ['KI', 'KIR', ['Kiribati', 'Republic of Kiribati']],
        ['KW', 'KWT', ['Kuwait', 'State of Kuwait']],
        ['KG', 'KGZ', ['Kyrgyzstan', 'Kyrgyz Republic']],
        ['LA', 'LAO', ['Laos', 'Lao People\'s Democratic Republic']],
        ['LV', 'LVA', ['Latvia', 'Republic of Latvia']],
        ['LB', 'LBN', ['Lebanon', 'Lebanese Republic']],
        ['LS', 'LSO', ['Lesotho', 'Kingdom of Lesotho']],
        ['LR', 'LBR', ['Liberia', 'Republic of Liberia']],
        ['LY', 'LBY', ['Libya']],
        ['LI', 'LIE', ['Liechtenstein', 'Principality of Liechtenstein']],
        ['LT', 'LTU', ['Lithuania', 'Republic of Lithuania']],
        ['LU', 'LUX', ['Luxembourg', 'Grand Duchy of Luxembourg']],
        ['MO', 'MAC', ['Macao SAR China', 'Macao', 'Macao Special Administrative Region of China', 'Macau']],
        ['MG', 'MDG', ['Madagascar', 'Republic of Madagascar']],
        ['MW', 'MWI', ['Malawi', 'Republic of Malawi']],
        ['MY', 'MYS', ['Malaysia']],
        ['MV', 'MDV', ['Maldives', 'Republic of Maldives']],
        ['ML', 'MLI', ['Mali', 'Republic of Mali']],
        ['MT', 'MLT', ['Malta', 'Republic of Malta']],
        ['MH', 'MHL', ['Marshall Islands', 'Republic of the Marshall Islands']],
        ['MQ', 'MTQ', ['Martinique']],
        ['MR', 'MRT', ['Mauritania', 'Islamic Republic of Mauritania']],
        ['MU', 'MUS', ['Mauritius', 'Republic of Mauritius']],
        ['YT', 'MYT', ['Mayotte']],
        ['MX', 'MEX', ['Mexico', 'United Mexican States']],
        ['FM', 'FSM', ['Micronesia', 'Micronesia, Federated States of', 'Federated States of Micronesia']],
        ['MD', 'MDA', ['Moldova', 'Moldova, Republic of', 'Republic of Moldova']],
        ['MC', 'MCO', ['Monaco', 'Principality of Monaco']],
        ['MN', 'MNG', ['Mongolia']],
        ['ME', 'MNE', ['Montenegro']],
        ['MS', 'MSR', ['Montserrat']],
        ['MA', 'MAR', ['Morocco', 'Kingdom of Morocco']],
        ['MZ', 'MOZ', ['Mozambique', 'Republic of Mozambique']],
        ['MM', 'MMR', ['Myanmar (Burma)', 'Myanmar', 'Republic of Myanmar', 'Burma']],
        ['NA', 'NAM', ['Namibia', 'Republic of Namibia']],
        ['NR', 'NRU', ['Nauru', 'Republic of Nauru']],
        ['NP', 'NPL', ['Nepal', 'Federal Democratic Republic of Nepal']],
        ['NL', 'NLD', ['Netherlands', 'Kingdom of the Netherlands', 'Holland', 'The Netherlands']],
        ['NC', 'NCL', ['New Caledonia']],
        ['NZ', 'NZL', ['New Zealand']],
        ['NI', 'NIC', ['Nicaragua', 'Republic of Nicaragua']],
        ['NE', 'NER', ['Niger', 'Republic of the Niger']],
        ['NG', 'NGA', ['Nigeria', 'Federal Republic of Nigeria']],
        ['NU', 'NIU', ['Niue']],
        ['NF', 'NFK', ['Norfolk Island']],
        ['KP', 'PRK', ['North Korea', 'Korea, Democratic People\'s Republic of', 'Democratic People\'s Republic of Korea']],
        ['MK', 'MKD', ['North Macedonia', 'Republic of North Macedonia', 'Macedonia']],
        ['MP', 'MNP', ['Northern Mariana Islands', 'Commonwealth of the Northern Mariana Islands']],
        ['NO', 'NOR', ['Norway', 'Kingdom of Norway']],
        ['OM', 'OMN', ['Oman', 'Sultanate of Oman']],
        ['PK', 'PAK', ['Pakistan', 'Islamic Republic of Pakistan']],
        ['PW', 'PLW', ['Palau', 'Republic of Palau']],
        ['PS', 'PSE', ['Palestinian Territories', 'Palestine, State of', 'the State of Palestine', 'Palestine']],
        ['PA', 'PAN', ['Panama', 'Republic of Panama']],
        ['PG', 'PNG', ['Papua New Guinea', 'Independent State of Papua New Guinea']],
        ['PY', 'PRY', ['Paraguay', 'Republic of Paraguay']],
        ['PE', 'PER', ['Peru', 'Republic of Peru']],
        ['PH', 'PHL', ['Philippines', 'Republic of the Philippines']],
        ['PN', 'PCN', ['Pitcairn Islands', 'Pitcairn']],
        ['PL', 'POL', ['Poland', 'Republic of Poland']],
        ['PT', 'PRT', ['Portugal', 'Portuguese Republic']],
        ['PR', 'PRI', ['Puerto Rico']],
        ['QA', 'QAT', ['Qatar', 'State of Qatar']],
        ['RO', 'ROU', ['Romania']],
        ['RU', 'RUS', ['Russia', 'Russian Federation']],
        ['RW', 'RWA', ['Rwanda', 'Rwandese Republic']],
        ['RE', 'REU', ['Réunion']],
        ['WS', 'WSM', ['Samoa', 'Independent State of Samoa']],
        ['SM', 'SMR', ['San Marino', 'Republic of San Marino']],
        ['SA', 'SAU', ['Saudi Arabia', 'Kingdom of Saudi Arabia']],
        ['SN', 'SEN', ['Senegal', 'Republic of Senegal']],
        ['RS', 'SRB', ['Serbia', 'Republic of Serbia']],
        ['SC', 'SYC', ['Seychelles', 'Republic of Seychelles']],
        ['SL', 'SLE', ['Sierra Leone', 'Republic of Sierra Leone']],
        ['SG', 'SGP', ['Singapore', 'Republic of Singapore']],
        ['SX', 'SXM', ['Sint Maarten', 'Sint Maarten (Dutch part)']],
        ['SK', 'SVK', ['Slovakia', 'Slovak Republic']],
        ['SI', 'SVN', ['Slovenia', 'Republic of Slovenia']],
        ['SB', 'SLB', ['Solomon Islands']],
        ['SO', 'SOM', ['Somalia', 'Federal Republic of Somalia']],
        ['ZA', 'ZAF', ['South Africa', 'Republic of South Africa']],
        ['GS', 'SGS', ['South Georgia & South Sandwich Islands', 'South Georgia and the South Sandwich Islands']],
        ['KR', 'KOR', ['South Korea', 'Korea, Republic of', 'Korea', 'Republic of Korea']],
        ['SS', 'SSD', ['South Sudan', 'Republic of South Sudan']],
        ['ES', 'ESP', ['Spain', 'Kingdom of Spain']],
        ['LK', 'LKA', ['Sri Lanka', 'Democratic Socialist Republic of Sri Lanka']],
        ['BL', 'BLM', ['St. Barthélemy', 'Saint Barthélemy']],
        ['SH', 'SHN', ['St. Helena', 'Saint Helena, Ascension and Tristan da Cunha']],
        ['KN', 'KNA', ['St. Kitts & Nevis', 'Saint Kitts and Nevis']],
        ['LC', 'LCA', ['St. Lucia', 'Saint Lucia']],
        ['MF', 'MAF', ['St. Martin', 'Saint Martin (French part)']],
        ['PM', 'SPM', ['St. Pierre & Miquelon', 'Saint Pierre and Miquelon']],
        ['VC', 'VCT', ['St. Vincent & Grenadines', 'Saint Vincent and the Grenadines']],
        ['SD', 'SDN', ['Sudan', 'Republic of the Sudan']],
        ['SR', 'SUR', ['Suriname', 'Republic of Suriname']],
        ['SJ', 'SJM', ['Svalbard & Jan Mayen', 'Svalbard and Jan Mayen']],
        ['SE', 'SWE', ['Sweden', 'Kingdom of Sweden']],
        ['CH', 'CHE', ['Switzerland', 'Swiss Confederation']],
        ['SY', 'SYR', ['Syria', 'Syrian Arab Republic']],
        ['ST', 'STP', ['São Tomé & Príncipe', 'Sao Tome and Principe', 'Democratic Republic of Sao Tome and Principe']],
        ['TW', 'TWN', ['Taiwan', 'Taiwan, Province of China']],
        ['TJ', 'TJK', ['Tajikistan', 'Republic of Tajikistan']],
        ['TZ', 'TZA', ['Tanzania', 'Tanzania, United Republic of', 'United Republic of Tanzania']],
        ['TH', 'THA', ['Thailand', 'Kingdom of Thailand']],
        ['TL', 'TLS', ['Timor-Leste', 'Democratic Republic of Timor-Leste', 'East Timor', 'Timor Leste']],
        ['TG', 'TGO', ['Togo', 'Togolese Republic']],
        ['TK', 'TKL', ['Tokelau']],
        ['TO', 'TON', ['Tonga', 'Kingdom of Tonga']],
        ['TT', 'TTO', ['Trinidad & Tobago', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago']],
        ['TN', 'TUN', ['Tunisia', 'Republic of Tunisia']],
        ['TM', 'TKM', ['Turkmenistan']],
        ['TC', 'TCA', ['Turks & Caicos Islands', 'Turks and Caicos Islands']],
        ['TV', 'TUV', ['Tuvalu']],
        ['TR', 'TUR', ['Türkiye', 'Republic of Türkiye', 'Turkey', 'Turkiye']],
        ['UM', 'UMI', ['U.S. Outlying Islands', 'United States Minor Outlying Islands']],
        ['VI', 'VIR', ['U.S. Virgin Islands', 'Virgin Islands, U.S.', 'Virgin Islands of the United States']],
        ['UG', 'UGA', ['Uganda', 'Republic of Uganda']],
        ['UA', 'UKR', ['Ukraine']],
        ['AE', 'ARE', ['United Arab Emirates', 'UAE', 'Emirates', 'Dubai']],
        ['GB', 'GBR', ['United Kingdom', 'United Kingdom of Great Britain and Northern Ireland', 'UK', 'Britain', 'Great Britain', 'England', 'Scotland', 'Wales', 'Northern Ireland']],
        ['US', 'USA', ['United States', 'United States of America', 'USA', 'America', 'US']],
        ['UY', 'URY', ['Uruguay', 'Eastern Republic of Uruguay']],
        ['UZ', 'UZB', ['Uzbekistan', 'Republic of Uzbekistan']],
        ['VU', 'VUT', ['Vanuatu', 'Republic of Vanuatu']],
        ['VA', 'VAT', ['Vatican City', 'Holy See (Vatican City State)', 'Vatican']],
        ['VE', 'VEN', ['Venezuela', 'Venezuela, Bolivarian Republic of', 'Bolivarian Republic of Venezuela']],
        ['VN', 'VNM', ['Vietnam', 'Viet Nam', 'Socialist Republic of Viet Nam']],
        ['WF', 'WLF', ['Wallis & Futuna', 'Wallis and Futuna']],
        ['EH', 'ESH', ['Western Sahara']],
        ['YE', 'YEM', ['Yemen', 'Republic of Yemen']],
        ['ZM', 'ZMB', ['Zambia', 'Republic of Zambia']],
        ['ZW', 'ZWE', ['Zimbabwe', 'Republic of Zimbabwe']],
        ['AX', 'ALA', ['Åland Islands']],
    ];

    /**
     * Find a country by its code (2 or 3 letters) and/or its name.
     * 
     *
     * @return array{alpha2: string, alpha3: string, name: string}|null
     */
    public static function find(?string $name = null, ?string $code = null): ?array
    {
        $wanted = self::normalize((string) $name);
        $code = strtoupper(trim((string) $code));

        // 1. Exact name (or one of its other names). Checked before the code,
        //    because a wrongly typed code (e.g. "SL" for Sri Lanka, which is
        //    really Sierra Leone) shouldn't win over a correct name.
        if ($wanted !== '') {
            foreach (self::COUNTRIES as $country) {
                foreach ($country[2] as $countryName) {
                    if (self::normalize($countryName) === $wanted) {
                        return self::format($country);
                    }
                }
            }
        }

        // 2. The 2- or 3-letter code.
        if ($code !== '') {
            foreach (self::COUNTRIES as $country) {
                if ($code === $country[0] || $code === $country[1]) {
                    return self::format($country);
                }
            }
        }

        // 3. Close spelling, e.g. "Afghanisthan" -> Afghanistan.
        //    Only used when one country is clearly the closest.
        if (strlen($wanted) < 4) {
            return null;
        }

        $allowed = max(1, intdiv(strlen($wanted), 5));
        $best = null;
        $bestDistance = PHP_INT_MAX;
        $tie = false;

        foreach (self::COUNTRIES as $country) {
            $countryBest = PHP_INT_MAX;

            foreach ($country[2] as $countryName) {
                $countryBest = min($countryBest, levenshtein($wanted, self::normalize($countryName)));
            }

            if ($countryBest < $bestDistance) {
                $best = $country;
                $bestDistance = $countryBest;
                $tie = false;
            } elseif ($countryBest === $bestDistance) {
                $tie = true;
            }
        }

        return ($best && !$tie && $bestDistance <= $allowed) ? self::format($best) : null;
    }

    /**
     * Automatic flag picture for a country, or null if it can't be worked out.
     */
    public static function flagUrl(?string $name = null, ?string $code = null, int $width = 320): ?string
    {
        $country = self::find($name, $code);

        return $country
            ? 'https://flagcdn.com/w' . $width . '/' . strtolower($country['alpha2']) . '.png'
            : null;
    }

    /**
     * Compact list for the admin page's JavaScript: [alpha2, alpha3, [names]].
     */
    public static function forJs(): array
    {
        return self::COUNTRIES;
    }

    /** Lower case, no accents, letters and single spaces only. */
    public static function normalize(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        $value = $ascii !== false ? $ascii : $value;
        $value = preg_replace('/[^a-z]+/', ' ', $value);

        return trim(preg_replace('/\\s+/', ' ', $value));
    }

    private static function format(array $country): array
    {
        return [
            'alpha2' => $country[0],
            'alpha3' => $country[1],
            'name' => $country[2][0],
        ];
    }
}