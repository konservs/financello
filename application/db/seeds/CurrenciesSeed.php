<?php
use Phinx\Seed\AbstractSeed;

class CurrenciesSeed extends AbstractSeed{
	/**
	 * Run Method.
	 */
	public function run(){
		$data = [[
			'code3'		=> 'AED',
			'name'		=> 'United Arab Emirates dirham',
			'symbol'	=> 'د.إ',		//
			'fractional'	=> 'Fils',
			'basic'		=> 100,			//number to basic (how much cents in dollar)
			'decimals'	=> 2			//Number of digits after the decimal separator.
			],[
			'code3'		=> 'AFN',
			'name'		=> 'Afghan afghani',
			'symbol'	=> '؋',	
			'fractional'	=> 'Pul',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ALL',
			'name'		=> 'Albanian lek',
			'symbol'	=> 'L',	
			'fractional'	=> 'Qindarke',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'AMD',
			'name'		=> 'Armenian dram',
			'symbol'	=> '',	
			'fractional'	=> 'Luma',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ANG',
			'name'		=> 'Netherlands Antillean guilder',
			'symbol'	=> 'ƒ',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'AOA',
			'name'		=> 'Angolan kwanza',
			'symbol'	=> 'Kz',	
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ARS',
			'name'		=> 'Argentine peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'AUD',
			'name'		=> 'Australian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'AWG',
			'name'		=> 'Aruban florin',
			'symbol'	=> 'ƒ',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'AZN',
			'name'		=> 'Azerbaijani manat',
			'symbol'	=> '₼',	
			'fractional'	=> 'Q?pik',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BAM',
			'name'		=> 'Bosnia and Herzegovina convertible mark',
			'symbol'	=> 'KM',	
			'fractional'	=> 'Fening',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BBD',
			'name'		=> 'Barbadian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BDT',
			'name'		=> 'Bangladeshi taka',
			'symbol'	=> '৳',	
			'fractional'	=> 'Poisha',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BGN',
			'name'		=> 'Bulgarian lev',
			'symbol'	=> 'лв',	
			'fractional'	=> 'Stotinka',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BHD',
			'name'		=> 'Bahraini dinar',
			'symbol'	=> '.د.ب',	
			'fractional'	=> 'Fils',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'BIF',
			'name'		=> 'Burundian franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BMD',
			'name'		=> 'Bermudian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BND',
			'name'		=> 'Brunei dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Sen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BOB',
			'name'		=> 'Bolivian boliviano',
			'symbol'	=> 'Bs.',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BRL',
			'name'		=> 'Brazilian real',
			'symbol'	=> 'R$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BSD',
			'name'		=> 'Bahamian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BTN',
			'name'		=> 'Bhutanese ngultrum',
			'symbol'	=> 'Nu.',	
			'fractional'	=> 'Chetrum',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BWP',
			'name'		=> 'Botswana pula',
			'symbol'	=> 'P',	
			'fractional'	=> 'Thebe',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BYN',
			'name'		=> 'Belarusian ruble',
			'symbol'	=> 'Br',	
			'fractional'	=> 'Kapyeyka',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'BZD',
			'name'		=> 'Belize dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CAD',
			'name'		=> 'Canadian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CDF',
			'name'		=> 'Congolese franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CHF',
			'name'		=> 'Swiss franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Rappen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CLP',
			'name'		=> 'Chilean peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CNY',
			'name'		=> 'Chinese yuan',
			'symbol'	=> '¥',
			'fractional'	=> 'Fen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'COP',
			'name'		=> 'Colombian peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CRC',
			'name'		=> 'Costa Rican colon',
			'symbol'	=> '₡',	
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CUC',
			'name'		=> 'Cuban convertible peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CUP',
			'name'		=> 'Cuban peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CVE',
			'name'		=> 'Cape Verdean escudo',
			'symbol'	=> 'Esc',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'CZK',
			'name'		=> 'Czech koruna',
			'symbol'	=> 'Kc',	
			'fractional'	=> 'Haler',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'DJF',
			'name'		=> 'Djiboutian franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'DKK',
			'name'		=> 'Danish krone',
			'symbol'	=> 'kr',	
			'fractional'	=> 'Ore',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'DOP',
			'name'		=> 'Dominican peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'DZD',
			'name'		=> 'Algerian dinar',
			'symbol'	=> 'د.ج',	
			'fractional'	=> 'Santeem',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'EGP',
			'name'		=> 'Egyptian pound',
			'symbol'	=> '£',
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ERN',
			'name'		=> 'Eritrean nakfa',
			'symbol'	=> 'Nfk',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ETB',
			'name'		=> 'Ethiopian birr',
			'symbol'	=> 'Br',	
			'fractional'	=> 'Santim',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'EUR',
			'name'		=> 'Euro',
			'symbol'	=> '€',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'FJD',
			'name'		=> 'Fijian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'FKP',
			'name'		=> 'Falkland Islands pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GBP',
			'name'		=> 'British pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GEL',
			'name'		=> 'Georgian lari',
			'symbol'	=> '₾',	
			'fractional'	=> 'Tetri',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GGP',
			'name'		=> 'Guernsey pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GHS',
			'name'		=> 'Ghanaian cedi',
			'symbol'	=> '₵',	
			'fractional'	=> 'Pesewa',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GIP',
			'name'		=> 'Gibraltar pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GMD',
			'name'		=> 'Gambian dalasi',
			'symbol'	=> 'D',	
			'fractional'	=> 'Butut',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GNF',
			'name'		=> 'Guinean franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GTQ',
			'name'		=> 'Guatemalan quetzal',
			'symbol'	=> 'Q',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'GYD',
			'name'		=> 'Guyanese dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'HKD',
			'name'		=> 'Hong Kong dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'HNL',
			'name'		=> 'Honduran lempira',
			'symbol'	=> 'L',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'HRK',
			'name'		=> 'Croatian kuna',
			'symbol'	=> 'kn',	
			'fractional'	=> 'Lipa',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'HTG',
			'name'		=> 'Haitian gourde',
			'symbol'	=> 'G',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'HUF',
			'name'		=> 'Hungarian forint',
			'symbol'	=> 'Ft',	
			'fractional'	=> 'Filler',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'IDR',
			'name'		=> 'Indonesian rupiah',
			'symbol'	=> 'Rp',	
			'fractional'	=> 'Sen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ILS',
			'name'		=> 'Israeli new shekel',
			'symbol'	=> '₪',	
			'fractional'	=> 'Agora',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'IMP',
			'name'		=> 'Manx pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'INR',
			'name'		=> 'Indian rupee',
			'symbol'	=> '₹',	
			'fractional'	=> 'Paisa',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'IQD',
			'name'		=> 'Iraqi dinar',
			'symbol'	=> 'ع.د',	
			'fractional'	=> 'Fils',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'IRR',
			'name'		=> 'Iranian rial',
			'symbol'	=> '﷼',	
			'fractional'	=> 'Dinar',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ISK',
			'name'		=> 'Icelandic krona',
			'symbol'	=> 'kr',	
			'fractional'	=> 'Eyrir',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'JEP',
			'name'		=> 'Jersey pound',
			'symbol'	=> '£',	
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'JMD',
			'name'		=> 'Jamaican dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'JOD',
			'name'		=> 'Jordanian dinar',
			'symbol'	=> 'د.ا',	
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'JPY',
			'name'		=> 'Japanese yen',
			'symbol'	=> '¥',	
			'fractional'	=> 'Sen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KES',
			'name'		=> 'Kenyan shilling',
			'symbol'	=> 'Sh',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KGS',
			'name'		=> 'Kyrgyzstani som',
			'symbol'	=> 'с',	
			'fractional'	=> 'Tyiyn',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KHR',
			'name'		=> 'Cambodian riel',
			'symbol'	=> '៛',	
			'fractional'	=> 'Sen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KMF',
			'name'		=> 'Comorian franc',
			'symbol'	=> 'Fr',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KPW',
			'name'		=> 'North Korean won',
			'symbol'	=> '₩',	
			'fractional'	=> 'Chon',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KRW',
			'name'		=> 'South Korean won',
			'symbol'	=> '₩',	
			'fractional'	=> 'Jeon',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KWD',
			'name'		=> 'Kuwaiti dinar',
			'symbol'	=> 'د.ك',	
			'fractional'	=> 'Fils',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'KYD',
			'name'		=> 'Cayman Islands dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'KZT',
			'name'		=> 'Kazakhstani tenge',
			'symbol'	=> '₸',	
			'fractional'	=> 'Tïın',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LAK',
			'name'		=> 'Lao kip',
			'symbol'	=> '₭',
			'fractional'	=> 'Att',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LBP',
			'name'		=> 'Lebanese pound',
			'symbol'	=> 'ل.ل',	
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LKR',
			'name'		=> 'Sri Lankan rupee',
			'symbol'	=> 'රු',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LRD',
			'name'		=> 'Liberian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LSL',
			'name'		=> 'Lesotho loti',
			'symbol'	=> 'L',	
			'fractional'	=> 'Sente',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'LYD',
			'name'		=> 'Libyan dinar',
			'symbol'	=> 'ل.د',	
			'fractional'	=> 'Dirham',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'MAD',
			'name'		=> 'Moroccan dirham',
			'symbol'	=> 'د.م.',	
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MDL',
			'name'		=> 'Moldovan leu',
			'symbol'	=> 'L',	
			'fractional'	=> 'Ban',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			//--------------------------------------------------------------------------------------------
			// The Malagasy ariary and the Mauritanian ouguiya are technically divided into five subunits
			// (the iraimbilanja and khoum respectively) the coins display "1/5" on their face and are
			// referred to as a "fifth" (Khoum/cinquième); These are not used in practice, but when
			// written out, a single significant digit is used. E.g. 1.2 UM.
			//--------------------------------------------------------------------------------------------
			'code3'		=> 'MGA',
			'name'		=> 'Malagasy ariary',
			'symbol'	=> 'Ar',	
			'fractional'	=> 'Iraimbilanja',
			'basic'		=> 5,
			'decimals'	=> 1
			],[
			'code3'		=> 'MKD',
			'name'		=> 'Macedonian denar',
			'symbol'	=> 'ден',	
			'fractional'	=> 'Deni',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MMK',
			'name'		=> 'Burmese kyat',
			'symbol'	=> 'Ks',	
			'fractional'	=> 'Pya',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MNT',
			'name'		=> 'Mongolian tögrög',
			'symbol'	=> '₮',	
			'fractional'	=> 'Möngö',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MOP',
			'name'		=> 'Macanese pataca',
			'symbol'	=> 'P',	
			'fractional'	=> 'Avo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			//--------------------------------------------------------------------------------------------
			// The Malagasy ariary and the Mauritanian ouguiya are technically divided into five subunits
			// (the iraimbilanja and khoum respectively) the coins display "1/5" on their face and are
			// referred to as a "fifth" (Khoum/cinquième); These are not used in practice, but when
			// written out, a single significant digit is used. E.g. 1.2 UM.
			//--------------------------------------------------------------------------------------------
			'code3'		=> 'MRO',
			'name'		=> 'Mauritanian ouguiya',
			'symbol'	=> 'UM',	
			'fractional'	=> 'Khoums',
			'basic'		=> 5,
			'decimals'	=> 1
			],[
			'code3'		=> 'MUR',
			'name'		=> 'Mauritian rupee',
			'symbol'	=> '₨',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MVR',
			'name'		=> 'Maldivian rufiyaa',
			'symbol'	=> '.ރ',	
			'fractional'	=> 'Laari',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MWK',
			'name'		=> 'Malawian kwacha',
			'symbol'	=> 'MK',	
			'fractional'	=> 'Tambala',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MXN',
			'name'		=> 'Mexican peso',
			'symbol'	=> '$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MYR',
			'name'		=> 'Malaysian ringgit',
			'symbol'	=> 'RM',	
			'fractional'	=> 'Sen',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'MZN',
			'name'		=> 'Mozambican metical',
			'symbol'	=> 'MT',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NAD',
			'name'		=> 'Namibian dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NGN',
			'name'		=> 'Nigerian naira',
			'symbol'	=> '₦',	
			'fractional'	=> 'Kobo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NIO',
			'name'		=> 'Nicaraguan cordoba',
			'symbol'	=> 'C$',	
			'fractional'	=> 'Centavo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NOK',
			'name'		=> 'Norwegian krone',
			'symbol'	=> 'kr',	
			'fractional'	=> 'Øre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NPR',
			'name'		=> 'Nepalese rupee',
			'symbol'	=> '₨',	
			'fractional'	=> 'Paisa',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'NZD',
			'name'		=> 'New Zealand dollar',
			'symbol'	=> '$',	
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'OMR',
			'name'		=> 'Omani rial',
			'symbol'	=> 'ر.ع.',	
			'fractional'	=> 'Baisa',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'PAB',
			'name'		=> 'Panamanian balboa',
			'symbol'	=> 'B/.',	
			'fractional'	=> 'Centesimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PEN',
			'name'		=> 'Peruvian sol',
			'symbol'	=> 'S/.',	
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PGK',
			'name'		=> 'Papua New Guinean kina',
			'symbol'	=> 'K',	
			'fractional'	=> 'Toea',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PHP',
			'name'		=> 'Philippine piso',
			'symbol'	=> '₱',	
			'fractional'	=> 'Sentimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PKR',
			'name'		=> 'Pakistani rupee',
			'symbol'	=> '₨',	
			'fractional'	=> 'Paisa',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PLN',
			'name'		=> 'Polish zloty',
			'symbol'	=> 'zl',	
			'fractional'	=> 'Grosz',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PRB',
			'name'		=> 'Transnistrian ruble',
			'symbol'	=> 'р.',	
			'fractional'	=> 'Kopek',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'PYG',
			'name'		=> 'Paraguayan guarani',
			'symbol'	=> '₲',	
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'QAR',
			'name'		=> 'Qatari riyal',
			'symbol'	=> 'ر.ق',	
			'fractional'	=> 'Dirham',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'RON',
			'name'		=> 'Romanian leu',
			'symbol'	=> 'lei',
			'symbol'	=> 'Ban',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'RSD',
			'name'		=> 'Serbian dinar',
			'symbol'	=> 'дин.',
			'symbol'	=> 'Para',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'RUB',
			'name'		=> 'Russian ruble',
			'symbol'	=> '₽',
			'fractional'	=> 'Kopek',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'RWF',
			'name'		=> 'Rwandan franc',
			'symbol'	=> 'Fr',
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SAR',
			'name'		=> 'Saudi riyal',
			'symbol'	=> '?.?',
			'fractional'	=> 'Halala',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SBD',
			'name'		=> 'Solomon Islands dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SCR',
			'name'		=> 'Seychellois rupee',
			'symbol'	=> '?',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SDG',
			'name'		=> 'Sudanese pound',
			'symbol'	=> '?.?.',
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SEK',
			'name'		=> 'Swedish krona',
			'symbol'	=> 'kr',
			'fractional'	=> 'Ore',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SGD',
			'name'		=> 'Singapore dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SHP',
			'name'		=> 'Saint Helena pound',
			'symbol'	=> '?',
			'fractional'	=> 'Penny',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SLL',
			'name'		=> 'Sierra Leonean leone',
			'symbol'	=> 'Le',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SOS',
			'name'		=> 'Somali shilling',
			'symbol'	=> 'Sh',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SRD',
			'name'		=> 'Surinamese dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SSP',
			'name'		=> 'South Sudanese pound',
			'symbol'	=> '?',
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'STD',
			'name'		=> 'Sao Tome and Principe dobra',
			'symbol'	=> 'Db',
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SYP',
			'name'		=> 'Syrian pound',
			'symbol'	=> '? or ?.?',
			'fractional'	=> 'Piastre',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'SZL',
			'name'		=> 'Swazi lilangeni',
			'symbol'	=> 'L',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'THB',
			'name'		=> 'Thai baht',
			'symbol'	=> '?',
			'fractional'	=> 'Satang',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TJS',
			'name'		=> 'Tajikistani somoni',
			'symbol'	=> 'ЅМ',
			'fractional'	=> 'Diram',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TMT',
			'name'		=> 'Turkmenistan manat',
			'symbol'	=> 'm',
			'fractional'	=> 'Tennesi',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TND',
			'name'		=> 'Tunisian dinar',
			'symbol'	=> '?.?',
			'fractional'	=> 'Millime',
			'basic'		=> 1000,
			'decimals'	=> 3
			],[
			'code3'		=> 'TOP',
			'name'		=> 'Tongan pa?anga',
			'symbol'	=> 'T$',
			'fractional'	=> 'Seniti',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TRY',
			'name'		=> 'Turkish lira',
			'symbol'	=> '?',
			'fractional'	=> 'Kurus',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TTD',
			'name'		=> 'Trinidad and Tobago dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TVD',
			'name'		=> 'Tuvaluan dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TWD',
			'name'		=> 'New Taiwan dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'TZS',
			'name'		=> 'Tanzanian shilling',
			'symbol'	=> 'Sh',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'UAH',
			'name'		=> 'Ukrainian hryvnia',
			'symbol'	=> '₴',
			'fractional'	=> 'Kopiyka',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'UGX',
			'name'		=> 'Ugandan shilling',
			'symbol'	=> 'Sh',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'USD',
			'name'		=> 'United States dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'UYU',
			'name'		=> 'Uruguayan peso',
			'symbol'	=> '$',
			'fractional'	=> 'Centesimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'UZS',
			'name'		=> 'Uzbekistani so?m',
			'symbol'	=> '',
			'fractional'	=> 'Tiyin',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'VEF',
			'name'		=> 'Venezuelan bolivar',
			'symbol'	=> 'Bs',
			'fractional'	=> 'Centimo',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'VND',
			'name'		=> 'Vietnamese đồng',
			'symbol'	=> '₫',
			'fractional'	=> 'Hào',
			'basic'		=> 10,
			'decimals'	=> 2
			],[
			'code3'		=> 'VUV',
			'name'		=> 'Vanuatu vatu',
			'symbol'	=> 'Vt',
			'fractional'	=> '',
			'basic'		=> null,
			'decimals'	=> null
			],[
			'code3'		=> 'WST',
			'name'		=> 'Samoan tālā',
			'symbol'	=> 'T',
			'fractional'	=> 'Sene',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'XAF',
			'name'		=> 'Central African CFA franc',
			'symbol'	=> 'Fr',
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'XCD',
			'name'		=> 'Eastern Caribbean dollar',
			'symbol'	=> '$',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'XOF',
			'name'		=> 'West African CFA franc',
			'symbol'	=> 'Fr',
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'XPF',
			'name'		=> 'CFP franc',
			'symbol'	=> 'Fr',
			'fractional'	=> 'Centime',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'YER',
			'name'		=> 'Yemeni rial',
			'symbol'	=> '﷼',
			'fractional'	=> 'Fils',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ZAR',
			'name'		=> 'South African rand',
			'symbol'	=> 'R',
			'fractional'	=> 'Cent',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'ZMW',
			'name'		=> 'Zambian kwacha',
			'symbol'	=> 'ZK',
			'fractional'	=> 'Ngwee',
			'basic'		=> 100,
			'decimals'	=> 2
			],
		//------  Precious metals  -----
			[
			'code3'		=> 'XAU',
			'name'		=> 'Gold ',
			'symbol'	=> 'Au',
			'fractional'	=> '',
			'basic'		=> null,
			'decimals'	=> null
			],[
			'code3'		=> 'XAG',
			'name'		=> 'Silver ',
			'symbol'	=> 'Ag',
			'fractional'	=> '',
			'basic'		=> null,
			'decimals'	=> null
			],
		//------  Cryptocurrencies  -----
			[
			'code3'		=> 'XBT',
			'name'		=> 'Bitcoin',
			'symbol'	=> 'Ƀ',
			'fractional'	=> '',
			'basic'		=> 100000000,
			'decimals'	=> 8
			]];
		$fin_currencies = $this->table('fin_currencies');
		$this->execute('SET FOREIGN_KEY_CHECKS=0');
		$fin_currencies->truncate();
		$fin_currencies->insert($data)->save();
		$this->execute('SET FOREIGN_KEY_CHECKS=1');
		}
	}
