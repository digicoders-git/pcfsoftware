<?php 
    class Auth_model extends CI_Model 
    {
    
        public function __construct() 
		{
			parent::__construct();
			// $this->weekDays=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            // $this->cities=array ( 0 => array ( 'city' => 'Achhnera', 'state' => 'Uttar Pradesh', ), 1 => array ( 'city' => 'Adari', 'state' => 'Uttar Pradesh', ), 2 => array ( 'city' => 'Agra', 'state' => 'Uttar Pradesh', ), 3 => array ( 'city' => 'Aligarh', 'state' => 'Uttar Pradesh', ), 4 => array ( 'city' => 'Allahabad', 'state' => 'Uttar Pradesh', ), 5 => array ( 'city' => 'Amroha', 'state' => 'Uttar Pradesh', ), 6 => array ( 'city' => 'Azamgarh', 'state' => 'Uttar Pradesh', ), 7 => array ( 'city' => 'Bahraich', 'state' => 'Uttar Pradesh', ), 8 => array ( 'city' => 'Ballia', 'state' => 'Uttar Pradesh', ), 9 => array ( 'city' => 'Balrampur', 'state' => 'Uttar Pradesh', ), 10 => array ( 'city' => 'Banda', 'state' => 'Uttar Pradesh', ), 11 => array ( 'city' => 'Bareilly', 'state' => 'Uttar Pradesh', ), 12 => array ( 'city' => 'Chandausi', 'state' => 'Uttar Pradesh', ), 13 => array ( 'city' => 'Dadri', 'state' => 'Uttar Pradesh', ), 14 => array ( 'city' => 'Deoria', 'state' => 'Uttar Pradesh', ), 15 => array ( 'city' => 'Etawah', 'state' => 'Uttar Pradesh', ), 16 => array ( 'city' => 'Fatehabad', 'state' => 'Uttar Pradesh', ), 17 => array ( 'city' => 'Fatehpur', 'state' => 'Uttar Pradesh', ), 18 => array ( 'city' => 'Fatehpur', 'state' => 'Uttar Pradesh', ), 19 => array ( 'city' => 'Greater Noida', 'state' => 'Uttar Pradesh', ), 20 => array ( 'city' => 'Hamirpur', 'state' => 'Uttar Pradesh', ), 21 => array ( 'city' => 'Hardoi', 'state' => 'Uttar Pradesh', ), 22 => array ( 'city' => 'Jajmau', 'state' => 'Uttar Pradesh', ), 23 => array ( 'city' => 'Jaunpur', 'state' => 'Uttar Pradesh', ), 24 => array ( 'city' => 'Jhansi', 'state' => 'Uttar Pradesh', ), 25 => array ( 'city' => 'Kalpi', 'state' => 'Uttar Pradesh', ), 26 => array ( 'city' => 'Kanpur', 'state' => 'Uttar Pradesh', ), 27 => array ( 'city' => 'Kota', 'state' => 'Uttar Pradesh', ), 28 => array ( 'city' => 'Laharpur', 'state' => 'Uttar Pradesh', ), 29 => array ( 'city' => 'Lakhimpur', 'state' => 'Uttar Pradesh', ), 30 => array ( 'city' => 'Lal Gopalganj Nindaura', 'state' => 'Uttar Pradesh', ), 31 => array ( 'city' => 'Lalganj', 'state' => 'Uttar Pradesh', ), 32 => array ( 'city' => 'Lalitpur', 'state' => 'Uttar Pradesh', ), 33 => array ( 'city' => 'Lar', 'state' => 'Uttar Pradesh', ), 34 => array ( 'city' => 'Loni', 'state' => 'Uttar Pradesh', ), 35 => array ( 'city' => 'Lucknow', 'state' => 'Uttar Pradesh', ), 36 => array ( 'city' => 'Mathura', 'state' => 'Uttar Pradesh', ), 37 => array ( 'city' => 'Meerut', 'state' => 'Uttar Pradesh', ), 38 => array ( 'city' => 'Modinagar', 'state' => 'Uttar Pradesh', ), 39 => array ( 'city' => 'Muradnagar', 'state' => 'Uttar Pradesh', ), 40 => array ( 'city' => 'Nagina', 'state' => 'Uttar Pradesh', ), 41 => array ( 'city' => 'Najibabad', 'state' => 'Uttar Pradesh', ), 42 => array ( 'city' => 'Nakur', 'state' => 'Uttar Pradesh', ), 43 => array ( 'city' => 'Nanpara', 'state' => 'Uttar Pradesh', ), 44 => array ( 'city' => 'Naraura', 'state' => 'Uttar Pradesh', ), 45 => array ( 'city' => 'Naugawan Sadat', 'state' => 'Uttar Pradesh', ), 46 => array ( 'city' => 'Nautanwa', 'state' => 'Uttar Pradesh', ), 47 => array ( 'city' => 'Nawabganj', 'state' => 'Uttar Pradesh', ), 48 => array ( 'city' => 'Nehtaur', 'state' => 'Uttar Pradesh', ), 49 => array ( 'city' => 'NOIDA', 'state' => 'Uttar Pradesh', ), 50 => array ( 'city' => 'Noorpur', 'state' => 'Uttar Pradesh', ), 51 => array ( 'city' => 'Obra', 'state' => 'Uttar Pradesh', ), 52 => array ( 'city' => 'Orai', 'state' => 'Uttar Pradesh', ), 53 => array ( 'city' => 'Padrauna', 'state' => 'Uttar Pradesh', ), 54 => array ( 'city' => 'Palia Kalan', 'state' => 'Uttar Pradesh', ), 55 => array ( 'city' => 'Parasi', 'state' => 'Uttar Pradesh', ), 56 => array ( 'city' => 'Phulpur', 'state' => 'Uttar Pradesh', ), 57 => array ( 'city' => 'Pihani', 'state' => 'Uttar Pradesh', ), 58 => array ( 'city' => 'Pilibhit', 'state' => 'Uttar Pradesh', ), 59 => array ( 'city' => 'Pilkhuwa', 'state' => 'Uttar Pradesh', ), 60 => array ( 'city' => 'Powayan', 'state' => 'Uttar Pradesh', ), 61 => array ( 'city' => 'Pukhrayan', 'state' => 'Uttar Pradesh', ), 62 => array ( 'city' => 'Puranpur', 'state' => 'Uttar Pradesh', ), 63 => array ( 'city' => 'Purquazi', 'state' => 'Uttar Pradesh', ), 64 => array ( 'city' => 'Purwa', 'state' => 'Uttar Pradesh', ), 65 => array ( 'city' => 'Rae Bareli', 'state' => 'Uttar Pradesh', ), 66 => array ( 'city' => 'Rampur', 'state' => 'Uttar Pradesh', ), 67 => array ( 'city' => 'Rampur Maniharan', 'state' => 'Uttar Pradesh', ), 68 => array ( 'city' => 'Rasra', 'state' => 'Uttar Pradesh', ), 69 => array ( 'city' => 'Rath', 'state' => 'Uttar Pradesh', ), 70 => array ( 'city' => 'Renukoot', 'state' => 'Uttar Pradesh', ), 71 => array ( 'city' => 'Reoti', 'state' => 'Uttar Pradesh', ), 72 => array ( 'city' => 'Robertsganj', 'state' => 'Uttar Pradesh', ), 73 => array ( 'city' => 'Rudauli', 'state' => 'Uttar Pradesh', ), 74 => array ( 'city' => 'Rudrapur', 'state' => 'Uttar Pradesh', ), 75 => array ( 'city' => 'Sadabad', 'state' => 'Uttar Pradesh', ), 76 => array ( 'city' => 'Safipur', 'state' => 'Uttar Pradesh', ), 77 => array ( 'city' => 'Saharanpur', 'state' => 'Uttar Pradesh', ), 78 => array ( 'city' => 'Sahaspur', 'state' => 'Uttar Pradesh', ), 79 => array ( 'city' => 'Sahaswan', 'state' => 'Uttar Pradesh', ), 80 => array ( 'city' => 'Sahawar', 'state' => 'Uttar Pradesh', ), 81 => array ( 'city' => 'Sahjanwa', 'state' => 'Uttar Pradesh', ), 82 => array ( 'city' => 'Sambhal', 'state' => 'Uttar Pradesh', ), 83 => array ( 'city' => 'Samdhan', 'state' => 'Uttar Pradesh', ), 84 => array ( 'city' => 'Samthar', 'state' => 'Uttar Pradesh', ), 85 => array ( 'city' => 'Sandi', 'state' => 'Uttar Pradesh', ), 86 => array ( 'city' => 'Sandila', 'state' => 'Uttar Pradesh', ), 87 => array ( 'city' => 'Sardhana', 'state' => 'Uttar Pradesh', ), 88 => array ( 'city' => 'Seohara', 'state' => 'Uttar Pradesh', ), 89 => array ( 'city' => 'Shahganj', 'state' => 'Uttar Pradesh', ), 90 => array ( 'city' => 'Shahjahanpur', 'state' => 'Uttar Pradesh', ), 91 => array ( 'city' => 'Shamli', 'state' => 'Uttar Pradesh', ), 92 => array ( 'city' => 'Shamsabad', 'state' => ' Farrukhabad', ), 93 => array ( 'city' => 'Sherkot', 'state' => 'Uttar Pradesh', ), 94 => array ( 'city' => 'Shikarpur', 'state' => ' Bulandshahr', ), 95 => array ( 'city' => 'Shikohabad', 'state' => 'Uttar Pradesh', ), 96 => array ( 'city' => 'Shishgarh', 'state' => 'Uttar Pradesh', ), 97 => array ( 'city' => 'Siana', 'state' => 'Uttar Pradesh', ), 98 => array ( 'city' => 'Sikanderpur', 'state' => 'Uttar Pradesh', ), 99 => array ( 'city' => 'Sikandra Rao', 'state' => 'Uttar Pradesh', ), 100 => array ( 'city' => 'Sikandrabad', 'state' => 'Uttar Pradesh', ), 101 => array ( 'city' => 'Sirsaganj', 'state' => 'Uttar Pradesh', ), 102 => array ( 'city' => 'Sirsi', 'state' => 'Uttar Pradesh', ), 103 => array ( 'city' => 'Sitapur', 'state' => 'Uttar Pradesh', ), 104 => array ( 'city' => 'Soron', 'state' => 'Uttar Pradesh', ), 105 => array ( 'city' => 'Suar', 'state' => 'Uttar Pradesh', ), 106 => array ( 'city' => 'Sultanpur', 'state' => 'Uttar Pradesh', ), 107 => array ( 'city' => 'Sumerpur', 'state' => 'Uttar Pradesh', ), 108 => array ( 'city' => 'Tanda', 'state' => 'Uttar Pradesh', ), 109 => array ( 'city' => 'Tanda', 'state' => 'Uttar Pradesh', ), 110 => array ( 'city' => 'Tetri Bazar', 'state' => 'Uttar Pradesh', ), 111 => array ( 'city' => 'Thakurdwara', 'state' => 'Uttar Pradesh', ), 112 => array ( 'city' => 'Thana Bhawan', 'state' => 'Uttar Pradesh', ), 113 => array ( 'city' => 'Tilhar', 'state' => 'Uttar Pradesh', ), 114 => array ( 'city' => 'Tirwaganj', 'state' => 'Uttar Pradesh', ), 115 => array ( 'city' => 'Tulsipur', 'state' => 'Uttar Pradesh', ), 116 => array ( 'city' => 'Tundla', 'state' => 'Uttar Pradesh', ), 117 => array ( 'city' => 'Unnao', 'state' => 'Uttar Pradesh', ), 118 => array ( 'city' => 'Utraula', 'state' => 'Uttar Pradesh', ), 119 => array ( 'city' => 'Varanasi', 'state' => 'Uttar Pradesh', ), 120 => array ( 'city' => 'Vrindavan', 'state' => 'Uttar Pradesh', ), 121 => array ( 'city' => 'Warhapur', 'state' => 'Uttar Pradesh', ), 122 => array ( 'city' => 'Zaidpur', 'state' => 'Uttar Pradesh', ), 123 => array ( 'city' => 'Zamania', 'state' => 'Uttar Pradesh', ), 124 => array ( 'city' => 'Muzaffarnagar', 'state' => 'Uttar Pradesh', ), );
            // $this->languages=array ( 0 => array ( 'code' => 'aa', 'name' => 'Afar', ), 1 => array ( 'code' => 'ab', 'name' => 'Abkhazian', ), 2 => array ( 'code' => 'ae', 'name' => 'Avestan', ), 3 => array ( 'code' => 'af', 'name' => 'Afrikaans', ), 4 => array ( 'code' => 'ak', 'name' => 'Akan', ), 5 => array ( 'code' => 'am', 'name' => 'Amharic', ), 6 => array ( 'code' => 'an', 'name' => 'Aragonese', ), 7 => array ( 'code' => 'ar', 'name' => 'Arabic', ), 8 => array ( 'code' => 'as', 'name' => 'Assamese', ), 9 => array ( 'code' => 'av', 'name' => 'Avaric', ), 10 => array ( 'code' => 'ay', 'name' => 'Aymara', ), 11 => array ( 'code' => 'az', 'name' => 'Azerbaijani', ), 12 => array ( 'code' => 'ba', 'name' => 'Bashkir', ), 13 => array ( 'code' => 'be', 'name' => 'Belarusian', ), 14 => array ( 'code' => 'bg', 'name' => 'Bulgarian', ), 15 => array ( 'code' => 'bh', 'name' => 'Bihari languages', ), 16 => array ( 'code' => 'bi', 'name' => 'Bislama', ), 17 => array ( 'code' => 'bm', 'name' => 'Bambara', ), 18 => array ( 'code' => 'bn', 'name' => 'Bengali', ), 19 => array ( 'code' => 'bo', 'name' => 'Tibetan', ), 20 => array ( 'code' => 'br', 'name' => 'Breton', ), 21 => array ( 'code' => 'bs', 'name' => 'Bosnian', ), 22 => array ( 'code' => 'ca', 'name' => 'Catalan; Valencian', ), 23 => array ( 'code' => 'ce', 'name' => 'Chechen', ), 24 => array ( 'code' => 'ch', 'name' => 'Chamorro', ), 25 => array ( 'code' => 'co', 'name' => 'Corsican', ), 26 => array ( 'code' => 'cr', 'name' => 'Cree', ), 27 => array ( 'code' => 'cs', 'name' => 'Czech', ), 28 => array ( 'code' => 'cu', 'name' => 'Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic', ), 29 => array ( 'code' => 'cv', 'name' => 'Chuvash', ), 30 => array ( 'code' => 'cy', 'name' => 'Welsh', ), 31 => array ( 'code' => 'da', 'name' => 'Danish', ), 32 => array ( 'code' => 'de', 'name' => 'German', ), 33 => array ( 'code' => 'dv', 'name' => 'Divehi; Dhivehi; Maldivian', ), 34 => array ( 'code' => 'dz', 'name' => 'Dzongkha', ), 35 => array ( 'code' => 'ee', 'name' => 'Ewe', ), 36 => array ( 'code' => 'el', 'name' => 'Greek, Modern (1453-)', ), 37 => array ( 'code' => 'en', 'name' => 'English', ), 38 => array ( 'code' => 'eo', 'name' => 'Esperanto', ), 39 => array ( 'code' => 'es', 'name' => 'Spanish; Castilian', ), 40 => array ( 'code' => 'et', 'name' => 'Estonian', ), 41 => array ( 'code' => 'eu', 'name' => 'Basque', ), 42 => array ( 'code' => 'fa', 'name' => 'Persian', ), 43 => array ( 'code' => 'ff', 'name' => 'Fulah', ), 44 => array ( 'code' => 'fi', 'name' => 'Finnish', ), 45 => array ( 'code' => 'fj', 'name' => 'Fijian', ), 46 => array ( 'code' => 'fo', 'name' => 'Faroese', ), 47 => array ( 'code' => 'fr', 'name' => 'French', ), 48 => array ( 'code' => 'fy', 'name' => 'Western Frisian', ), 49 => array ( 'code' => 'ga', 'name' => 'Irish', ), 50 => array ( 'code' => 'gd', 'name' => 'Gaelic; Scomttish Gaelic', ), 51 => array ( 'code' => 'gl', 'name' => 'Galician', ), 52 => array ( 'code' => 'gn', 'name' => 'Guarani', ), 53 => array ( 'code' => 'gu', 'name' => 'Gujarati', ), 54 => array ( 'code' => 'gv', 'name' => 'Manx', ), 55 => array ( 'code' => 'ha', 'name' => 'Hausa', ), 56 => array ( 'code' => 'he', 'name' => 'Hebrew', ), 57 => array ( 'code' => 'hi', 'name' => 'Hindi', ), 58 => array ( 'code' => 'ho', 'name' => 'Hiri Motu', ), 59 => array ( 'code' => 'hr', 'name' => 'Croatian', ), 60 => array ( 'code' => 'ht', 'name' => 'Haitian; Haitian Creole', ), 61 => array ( 'code' => 'hu', 'name' => 'Hungarian', ), 62 => array ( 'code' => 'hy', 'name' => 'Armenian', ), 63 => array ( 'code' => 'hz', 'name' => 'Herero', ), 64 => array ( 'code' => 'ia', 'name' => 'Interlingua (International Auxiliary Language Association)', ), 65 => array ( 'code' => 'id', 'name' => 'Indonesian', ), 66 => array ( 'code' => 'ie', 'name' => 'Interlingue; Occidental', ), 67 => array ( 'code' => 'ig', 'name' => 'Igbo', ), 68 => array ( 'code' => 'ii', 'name' => 'Sichuan Yi; Nuosu', ), 69 => array ( 'code' => 'ik', 'name' => 'Inupiaq', ), 70 => array ( 'code' => 'io', 'name' => 'Ido', ), 71 => array ( 'code' => 'is', 'name' => 'Icelandic', ), 72 => array ( 'code' => 'it', 'name' => 'Italian', ), 73 => array ( 'code' => 'iu', 'name' => 'Inuktitut', ), 74 => array ( 'code' => 'ja', 'name' => 'Japanese', ), 75 => array ( 'code' => 'jv', 'name' => 'Javanese', ), 76 => array ( 'code' => 'ka', 'name' => 'Georgian', ), 77 => array ( 'code' => 'kg', 'name' => 'Kongo', ), 78 => array ( 'code' => 'ki', 'name' => 'Kikuyu; Gikuyu', ), 79 => array ( 'code' => 'kj', 'name' => 'Kuanyama; Kwanyama', ), 80 => array ( 'code' => 'kk', 'name' => 'Kazakh', ), 81 => array ( 'code' => 'kl', 'name' => 'Kalaallisut; Greenlandic', ), 82 => array ( 'code' => 'km', 'name' => 'Central Khmer', ), 83 => array ( 'code' => 'kn', 'name' => 'Kannada', ), 84 => array ( 'code' => 'ko', 'name' => 'Korean', ), 85 => array ( 'code' => 'kr', 'name' => 'Kanuri', ), 86 => array ( 'code' => 'ks', 'name' => 'Kashmiri', ), 87 => array ( 'code' => 'ku', 'name' => 'Kurdish', ), 88 => array ( 'code' => 'kv', 'name' => 'Komi', ), 89 => array ( 'code' => 'kw', 'name' => 'Cornish', ), 90 => array ( 'code' => 'ky', 'name' => 'Kirghiz; Kyrgyz', ), 91 => array ( 'code' => 'la', 'name' => 'Latin', ), 92 => array ( 'code' => 'lb', 'name' => 'Luxembourgish; Letzeburgesch', ), 93 => array ( 'code' => 'lg', 'name' => 'Ganda', ), 94 => array ( 'code' => 'li', 'name' => 'Limburgan; Limburger; Limburgish', ), 95 => array ( 'code' => 'ln', 'name' => 'Lingala', ), 96 => array ( 'code' => 'lo', 'name' => 'Lao', ), 97 => array ( 'code' => 'lt', 'name' => 'Lithuanian', ), 98 => array ( 'code' => 'lu', 'name' => 'Luba-Katanga', ), 99 => array ( 'code' => 'lv', 'name' => 'Latvian', ), 100 => array ( 'code' => 'mg', 'name' => 'Malagasy', ), 101 => array ( 'code' => 'mh', 'name' => 'Marshallese', ), 102 => array ( 'code' => 'mi', 'name' => 'Maori', ), 103 => array ( 'code' => 'mk', 'name' => 'Macedonian', ), 104 => array ( 'code' => 'ml', 'name' => 'Malayalam', ), 105 => array ( 'code' => 'mn', 'name' => 'Mongolian', ), 106 => array ( 'code' => 'mr', 'name' => 'Marathi', ), 107 => array ( 'code' => 'ms', 'name' => 'Malay', ), 108 => array ( 'code' => 'mt', 'name' => 'Maltese', ), 109 => array ( 'code' => 'my', 'name' => 'Burmese', ), 110 => array ( 'code' => 'na', 'name' => 'Nauru', ), 111 => array ( 'code' => 'nb', 'name' => 'Bokmål, Norwegian; Norwegian Bokmål', ), 112 => array ( 'code' => 'nd', 'name' => 'Ndebele, North; North Ndebele', ), 113 => array ( 'code' => 'ne', 'name' => 'Nepali', ), 114 => array ( 'code' => 'ng', 'name' => 'Ndonga', ), 115 => array ( 'code' => 'nl', 'name' => 'Dutch; Flemish', ), 116 => array ( 'code' => 'nn', 'name' => 'Norwegian Nynorsk; Nynorsk, Norwegian', ), 117 => array ( 'code' => 'no', 'name' => 'Norwegian', ), 118 => array ( 'code' => 'nr', 'name' => 'Ndebele, South; South Ndebele', ), 119 => array ( 'code' => 'nv', 'name' => 'Navajo; Navaho', ), 120 => array ( 'code' => 'ny', 'name' => 'Chichewa; Chewa; Nyanja', ), 121 => array ( 'code' => 'oc', 'name' => 'Occitan (post 1500)', ), 122 => array ( 'code' => 'oj', 'name' => 'Ojibwa', ), 123 => array ( 'code' => 'om', 'name' => 'Oromo', ), 124 => array ( 'code' => 'or', 'name' => 'Oriya', ), 125 => array ( 'code' => 'os', 'name' => 'Ossetian; Ossetic', ), 126 => array ( 'code' => 'pa', 'name' => 'Panjabi; Punjabi', ), 127 => array ( 'code' => 'pi', 'name' => 'Pali', ), 128 => array ( 'code' => 'pl', 'name' => 'Polish', ), 129 => array ( 'code' => 'ps', 'name' => 'Pushto; Pashto', ), 130 => array ( 'code' => 'pt', 'name' => 'Portuguese', ), 131 => array ( 'code' => 'qu', 'name' => 'Quechua', ), 132 => array ( 'code' => 'rm', 'name' => 'Romansh', ), 133 => array ( 'code' => 'rn', 'name' => 'Rundi', ), 134 => array ( 'code' => 'ro', 'name' => 'Romanian; Moldavian; Moldovan', ), 135 => array ( 'code' => 'ru', 'name' => 'Russian', ), 136 => array ( 'code' => 'rw', 'name' => 'Kinyarwanda', ), 137 => array ( 'code' => 'sa', 'name' => 'Sanskrit', ), 138 => array ( 'code' => 'sc', 'name' => 'Sardinian', ), 139 => array ( 'code' => 'sd', 'name' => 'Sindhi', ), 140 => array ( 'code' => 'se', 'name' => 'Northern Sami', ), 141 => array ( 'code' => 'sg', 'name' => 'Sango', ), 142 => array ( 'code' => 'si', 'name' => 'Sinhala; Sinhalese', ), 143 => array ( 'code' => 'sk', 'name' => 'Slovak', ), 144 => array ( 'code' => 'sl', 'name' => 'Slovenian', ), 145 => array ( 'code' => 'sm', 'name' => 'Samoan', ), 146 => array ( 'code' => 'sn', 'name' => 'Shona', ), 147 => array ( 'code' => 'so', 'name' => 'Somali', ), 148 => array ( 'code' => 'sq', 'name' => 'Albanian', ), 149 => array ( 'code' => 'sr', 'name' => 'Serbian', ), 150 => array ( 'code' => 'ss', 'name' => 'Swati', ), 151 => array ( 'code' => 'st', 'name' => 'Sotho, Southern', ), 152 => array ( 'code' => 'su', 'name' => 'Sundanese', ), 153 => array ( 'code' => 'sv', 'name' => 'Swedish', ), 154 => array ( 'code' => 'sw', 'name' => 'Swahili', ), 155 => array ( 'code' => 'ta', 'name' => 'Tamil', ), 156 => array ( 'code' => 'te', 'name' => 'Telugu', ), 157 => array ( 'code' => 'tg', 'name' => 'Tajik', ), 158 => array ( 'code' => 'th', 'name' => 'Thai', ), 159 => array ( 'code' => 'ti', 'name' => 'Tigrinya', ), 160 => array ( 'code' => 'tk', 'name' => 'Turkmen', ), 161 => array ( 'code' => 'tl', 'name' => 'Tagalog', ), 162 => array ( 'code' => 'tn', 'name' => 'Tswana', ), 163 => array ( 'code' => 'to', 'name' => 'Tonga (Tonga Islands)', ), 164 => array ( 'code' => 'tr', 'name' => 'Turkish', ), 165 => array ( 'code' => 'ts', 'name' => 'Tsonga', ), 166 => array ( 'code' => 'tt', 'name' => 'Tatar', ), 167 => array ( 'code' => 'tw', 'name' => 'Twi', ), 168 => array ( 'code' => 'ty', 'name' => 'Tahitian', ), 169 => array ( 'code' => 'ug', 'name' => 'Uighur; Uyghur', ), 170 => array ( 'code' => 'uk', 'name' => 'Ukrainian', ), 171 => array ( 'code' => 'ur', 'name' => 'Urdu', ), 172 => array ( 'code' => 'uz', 'name' => 'Uzbek', ), 173 => array ( 'code' => 've', 'name' => 'Venda', ), 174 => array ( 'code' => 'vi', 'name' => 'Vietnamese', ), 175 => array ( 'code' => 'vo', 'name' => 'Volapük', ), 176 => array ( 'code' => 'wa', 'name' => 'Walloon', ), 177 => array ( 'code' => 'wo', 'name' => 'Wolof', ), 178 => array ( 'code' => 'xh', 'name' => 'Xhosa', ), 179 => array ( 'code' => 'yi', 'name' => 'Yiddish', ), 180 => array ( 'code' => 'yo', 'name' => 'Yoruba', ), 181 => array ( 'code' => 'za', 'name' => 'Zhuang; Chuang', ), 182 => array ( 'code' => 'zh', 'name' => 'Chinese', ), 183 => array ( 'code' => 'zu', 'name' => 'Zulu', ), );
		}
        public function getRole($role_id)
        {
            $query = $this->db->where(['id'=>$role_id])
            ->get('roles');
            if($query->num_rows())
            {
                $result = $query->row();
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function getProfileData($id)
        {
            $query = $this->db->where(['id'=>$id])->get('users');
            if($query->num_rows())
            {
                $result = $query->row();
                $result->since=$this->app->humanTiming(strtotime($result->created_at));
                $interests=explode(',',$result->interests);
                $j=0;$return=[];
                for($i=0;$i<count($interests);$i++)
                {
                    $in_query = $this->db->select('id,icon,name,url')->where(['id'=>$interests[$i]])->get('interest_subcategories');
                    if($in_query->num_rows()){
                        $return[$j]=$in_query->row();
                        $j++;
                    }
                }

                $result->interestsData=$return;

                return $result;
            }
            else
            {
                return false;
            }
        }
        public function getProfile($id,$time)
        {
            $query = $this->db->where(['id'=>$id])->get('users');
            if($query->num_rows())
            {
                $result = $query->row();
                $result->since=$this->app->humanTiming(strtotime($result->created_at));
                $result->requesttime=$this->app->humanTiming(strtotime($time));
                $interests=explode(',',$result->interests);
                $j=0;$return=[];
                for($i=0;$i<count($interests);$i++)
                {
                    $in_query = $this->db->select('id,icon,name,url')->where(['id'=>$interests[$i]])->get('interest_subcategories');
                    if($in_query->num_rows()){
                        $return[$j]=$in_query->row();
                        $j++;
                    }
                }

                $result->interestsData=$return;

                return $result;
            }
            else
            {
                return false;
            }
        }
        public function isValid($table,$id)
        {
            $query = $this->db->where(['id'=>$id,'is_status'=>'true','is_verified'=>'true'])
            ->get($table);
            if($query->num_rows())
            {
                $result = $query->row();
                return $result;
            }
            else
            {
                return false;
            }
        }
        public function logout($table,$id)
        {
            $query = $this->db->where(['id'=>$id])->update($table,['logout_at'=>$this->data->timestamp,'is_login'=>'false']);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function getYoutubeLinkData($link)
        {
            $baseUrl='https://www.youtube.com/';
            $baseEmbedUrl='https://www.youtube.com/embed/';
            $baseWatchUrl='https://www.youtube.com/watch';
            $baseVideoUrl='https://youtu';
            
            $embedLinkArr=explode('embed/',$link);
            $watchLinkArr=explode('?v=',$link);
            $videoLinkArr=explode('.be/',$link);
            
            if($baseWatchUrl==$watchLinkArr[0])
            {
                $youtube_id=end($watchLinkArr);
            }
            else if($baseVideoUrl==$videoLinkArr[0])
            {
                $youtube_id=end($videoLinkArr);
            }
            else if($baseUrl==$embedLinkArr[0])
            {
                $youtube_id=end($embedLinkArr);
            }
            else
            {
                $youtube_id=0;
            }
            
            $embedUrl=$baseEmbedUrl.$youtube_id;
            $watchUrl=$baseWatchUrl.'?v='.$youtube_id;
            $videoUrl=$baseVideoUrl.'.be/'.$youtube_id;
            $thumbnailUrl='https://img.youtube.com/vi/'.$youtube_id.'/sddefault.jpg';
            
            $response= (object) ['baseUrl'=>$baseUrl,'id'=>$youtube_id,'embedUrl'=>$embedUrl,'watchUrl'=>$watchUrl,'videoUrl'=>$videoUrl,'thumbnailUrl'=>$thumbnailUrl];
            return $response;
        } 

        public function getData($table,$id)
        {
            $query = $this->db->where('id',$id)->order_by('id','DESC')->get($table);
            if($query)
            {
                $result = $query->row();
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function getRowDesc($table,$whereData,$orderBy)
        {
            $query = $this->db->where($whereData)->order_by($orderBy,'DESC')->get($table);
            if($query)
            {
                $result = $query->row();
                return $result;
            }
            else
            {
                return false;
            }
        }
        public function getRowAsc($table,$whereData,$orderBy)
        {
            $query = $this->db->where($whereData)->order_by($orderBy,'ASC')->get($table);
            if($query)
            {
                $result = $query->row();
                return $result;
            }
            else
            {
                return false;
            }
        }
        public function getResultDesc($table,$whereData,$orderBy)
        {
            $query = $this->db->where($whereData)->order_by($orderBy,'DESC')->get($table);
            if($query)
            {
                $result = $query->result();
                return $result;
            }
            else
            {
                return false;
            }
        }
        public function getResultAsc($table,$whereData)
        {
            $query = $this->db->where($whereData)->order_by($orderBy,'ASC')->get($table);
            if($query)
            {
                $result = $query->result();
                return $result;
            }
            else
            {
                return false;
            }
        }
    }
