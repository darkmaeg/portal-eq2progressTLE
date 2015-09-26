<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2008
 * Date:		$Date: 2015-08-23 19:20:34 +0100 (Sun, 23 Aug 2015) $
 * -----------------------------------------------------------------------
 * @author		$Author: Darkmaeg $
 * @copyright	2006-2015 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev: 00001 $
 * 
 * $Id: eq2progresstle_portal.class.php 00001 2015-08-23 19:20:34Z Darkmaeg $
 * Modified Version of Hoofy's mybars progression module
 * This version populates the guild raid achievements from the Data Api
 *
 * V1.2 Minor fix
 * V1.1 Added Avatar Brell Serilius
 * V1.0 Initial Release - TLE Version
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

class eq2progresstle_portal extends portal_generic {
	protected static $path		= 'eq2progresstle';
	protected static $data		= array(
		'name'			=> 'EQ2 TLE Progression',
		'version'		=> '1.2',
		'author'		=> 'Darkmaeg',
		'contact'		=> EQDKP_PROJECT_URL,
		'description'	=> 'Everquest 2 TLE Progression',
		'multiple'		=> false,
		'lang_prefix'	=> 'eq2progresstle_'
		
	);
	protected static $positions = array('middle', 'left1', 'left2', 'right', 'bottom');
	protected static $install	= array(
		'autoenable'		=> '0',
		'defaultposition'	=> 'right',
		'defaultnumber'		=> '7',
	);
	
	protected static $apiLevel = 20;
	public function get_settings($state) {
			$settings = array(
			'eq2progresstle_shattered'	=> array(
				'name'		=> 'eq2progresstle_shattered',
				'language'	=> 'eq2progresstle_shattered',
				'type'	=> 'radio',
			),	
			'eq2progresstle_splitpaw'	=> array(
				'name'		=> 'eq2progresstle_splitpaw',
				'language'	=> 'eq2progresstle_splitpaw',
				'type'	=> 'radio',
			),	
			'eq2progresstle_desert'	=> array(
				'name'		=> 'eq2progresstle_desert',
				'language'	=> 'eq2progresstle_desert',
				'type'	=> 'radio',
			),
			'eq2progresstle_fallen'	=> array(
				'name'		=> 'eq2progresstle_fallen',
				'language'	=> 'eq2progresstle_fallen',
				'type'	=> 'radio',
			),
			'eq2progresstle_kingdom'	=> array(
				'name'		=> 'eq2progresstle_kingdom',
				'language'	=> 'eq2progresstle_kingdom',
				'type'	=> 'radio',
			),
			'eq2progresstle_faydwer'	=> array(
				'name'		=> 'eq2progresstle_faydwer',
				'language'	=> 'eq2progresstle_faydwer',
				'type'	=> 'radio',
			),
			'eq2progresstle_kunark'	=> array(
				'name'		=> 'eq2progresstle_kunark',
				'language'	=> 'eq2progresstle_kunark',
				'type'	=> 'radio',
			),
			'eq2progresstle_odyssey'	=> array(
				'name'		=> 'eq2progresstle_odyssey',
				'language'	=> 'eq2progresstle_odyssey',
				'type'	=> 'radio',
			),
			'eq2progresstle_sentinel'	=> array(
				'name'		=> 'eq2progresstle_sentinel',
				'language'	=> 'eq2progresstle_sentinel',
				'type'	=> 'radio',
			),
			'eq2progresstle_velious'	=> array(
				'name'		=> 'eq2progresstle_velious',
				'language'	=> 'eq2progresstle_velious',
				'type'	=> 'radio',
			),
			'eq2progresstle_chains'	=> array(
				'name'		=> 'eq2progresstle_chains',
				'language'	=> 'eq2progresstle_chains',
				'type'	=> 'radio',
			),
			'eq2progresstle_arena'	=> array(
				'name'		=> 'eq2progresstle_arena',
				'language'	=> 'eq2progresstle_arena',
				'type'	=> 'radio',
			),
			'eq2progresstle_contested'	=> array(
				'name'		=> 'eq2progresstle_contested',
				'language'	=> 'eq2progresstle_contested',
				'type'	=> 'radio',
			),
			'eq2progresstle_veeshan'	=> array(
				'name'		=> 'eq2progresstle_veeshan',
				'language'	=> 'eq2progresstle_veeshan',
				'type'	=> 'radio',
			),
			'eq2progresstle_altar'	=> array(
				'name'		=> 'eq2progresstle_altar',
				'language'	=> 'eq2progresstle_altar',
				'type'	=> 'radio',
			),
			'eq2progresstle_precipice'	=> array(
				'name'		=> 'eq2progresstle_precipice',
				'language'	=> 'eq2progresstle_precipice',
				'type'	=> 'radio',
			),
			'eq2progresstle_date'	=> array(
				'name'		=> 'eq2progresstle_date',
				'language'	=> 'eq2progresstle_date',
				'type'	=> 'radio',
			),
		);
		return $settings;
	}
		
	public function output() {
		if($this->config('eq2progresstle_headtext')){
			$this->header = sanitize($this->config('eq2progresstle_headtext'));
		}
		$maxbars = 0;
		if (($this->config('eq2progresstle_shattered')) == TRUE )	{ ($maxbars = $maxbars + 1); ($zone1 = TRUE); }
		if (($this->config('eq2progresstle_splitpaw')) == TRUE )	{ ($maxbars = $maxbars + 1); ($zone2 = TRUE); }
		if (($this->config('eq2progresstle_desert')) == TRUE ) 		{ ($maxbars = $maxbars + 1); ($zone3 = TRUE); }
		if (($this->config('eq2progresstle_fallen')) == TRUE ) 		{ ($maxbars = $maxbars + 1); ($zone4 = TRUE); }
		if (($this->config('eq2progresstle_kingdom')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone5 = TRUE); }
		if (($this->config('eq2progresstle_faydwer')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone6 = TRUE); }
		if (($this->config('eq2progresstle_kunark')) == TRUE ) 		{ ($maxbars = $maxbars + 1); ($zone7 = TRUE); }
		if (($this->config('eq2progresstle_odyssey')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone8 = TRUE); }
		if (($this->config('eq2progresstle_sentinel')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone9 = TRUE); }
		if (($this->config('eq2progresstle_velious')) == TRUE )		{ ($maxbars = $maxbars + 1); ($zone10 = TRUE); }
		if (($this->config('eq2progresstle_chains')) == TRUE )		{ ($maxbars = $maxbars + 1); ($zone11 = TRUE); }
		if (($this->config('eq2progresstle_arena')) == TRUE ) 		{ ($maxbars = $maxbars + 1); ($zone12 = TRUE); }
		if (($this->config('eq2progresstle_contested')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone13 = TRUE); }
		if (($this->config('eq2progresstle_veeshan')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone14 = TRUE); }
		if (($this->config('eq2progresstle_altar')) == TRUE ) 		{ ($maxbars = $maxbars + 1); ($zone15 = TRUE); }
		if (($this->config('eq2progresstle_precipice')) == TRUE ) 	{ ($maxbars = $maxbars + 1); ($zone16 = TRUE); }
		//Initialize Zones
		$shattered = 0;	$splitpaw = 0; $desert = 0; $fallen = 0; $kingdom = 0; $faydwer = 0; $kunark = 0; $odyssey = 0;
		$sentinel = 0; $velious = 0; $chains = 0; $arena = 0; $contested = 0; $veeshan = 0; $altar = 0; $precipice = 0;		
		$shmax = 9; $ssmax = 2; $dfmax = 8; $fdmax = 3; $ksmax = 8; $efmax = 5;
		$rokmax = 9; $tsomax = 6; $sfmax = 7; $dovmax = 22; $coemax = 4; $arenamax = 10;
		$contmax = 9; $tovmax = 11; $aommax = 11; $popmax = 5;		
		$this->game->new_object('eq2_daybreak', 'daybreak', array());
		if(!is_object($this->game->obj['daybreak'])) return "";
		$progdata = $this->game->obj['daybreak']->guildinfo($this->config->get('guildtag'), $this->config->get('uc_servername'), false);
		$achieve  = $progdata['guild_list'][0]['achievement_list'];	
		$ktot = count($achieve);
		$this->game->new_object('eq2_daybreak', 'daybreak', array($this->config->get('uc_server_loc'), $this->config->get('uc_data_lang')));
		if(!is_object($this->game->obj['daybreak'])) return "";
		$guilddata = $this->game->obj['daybreak']->guildinfo($this->config->get('guildtag'), $this->config->get('servername'), false);
		$achieve = $guilddata['guild_list'][0]['achievement_list'];	
		$gdata 	  = $guilddata['guild_list'][0];
		$ktot = count($achieve);
		$spacer = "";
		if (($this->config('eq2progresstle_date')) == TRUE ) 		
		{ ($spacer = "Not Killed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); }
		$shval=$this->user->lang('eq2progresstle_f_eq2progresstle_shattered');
		$sh1=$spacer.'<font color="white">Archlich Udalan</font><br>'; $sh2=$spacer.'<font color="white">Darathar</font><br>';		
		$sh3=$spacer.'<font color="white">K\'Dal the Deceiver</font><br>'; $sh4=$spacer.'<font color="white">King Drayek</font><br>';	
		$sh5=$spacer.'<font color="white">King Zalak</font><br>'; $sh6=$spacer.'<font color="white">Overlord Oxulius</font><br>';
		$sh7=$spacer.'<font color="white">Rognog the Angler</font><br>'; $sh8=$spacer.'<font color="white">Venekor</font><br>';
		$sh9=$spacer.'<font color="white">Vox</font><br>';
		$ssval=$this->user->lang('eq2progresstle_f_eq2progresstle_splitpaw');
		$ss1=$spacer.'<font color="white">Faroth Mal</font><br>'; $ss2=$spacer.'<font color="white">Skoam Anvilpaw</font><br>';		
		$dfval=$this->user->lang('eq2progresstle_f_eq2progresstle_desert');
		$df1=$spacer.'<font color="white">Ahk\'Min Rhoen</font><br>'; $df2=$spacer.'<font color="white">Arazul, Hand of the Godking</font><br>'; $df3=$spacer.'<font color="white">Barakah & Siyamak</font><br>'; 
		$df4=$spacer.'<font color="white">Djinn Master</font><br>'; $df5=$spacer.'<font color="white">Godking Anuk</font><br>'; 
		$df6=$spacer.'<font color="white">Lathena</font><br>'; $df7=$spacer.'<font color="white">Lockjaw</font><br>'; 
		$df8=$spacer.'<font color="white">The Black Queen</font><br>'; $fdval=$this->user->lang('eq2progresstle_f_eq2progresstle_fallen');
		$fd1=$spacer.'<font color="white">Chel\'Drak</font><br>'; $fd2=$spacer.'<font color="white">Xux\'laio</font><br>';
		$fd3=$spacer.'<font color="white">Bonesnapper</font><br>'; $ksval=$this->user->lang('eq2progresstle_f_eq2progresstle_kingdom');
		$ks1=$spacer.'<font color="white">Harla Dar</font><br>'; $ks2=$spacer.'<font color="white">Pantrilla</font><br>';		
		$ks3=$spacer.'<font color="white">Sharti & Ireth</font><br>'; $ks4=$spacer.'<font color="white">Talendor & Gorenaire</font><br>';$ks5=$spacer.'<font color="white">Tarinax</font><br>';	$ks6=$spacer.'<font color="white">Venekor</font><br>';	
		$ks7=$spacer.'<font color="white">Vilucidae</font><br>'; $ks8=$spacer.'<font color="white">Vyemm</font><br>';	
		$efval=$this->user->lang('eq2progresstle_f_eq2progresstle_faydwer'); 
		$ef1=$spacer.'<font color="white">Clockwork Menace</font><br>'; $ef2=$spacer.'<font color="white">Malkonis D\'Morte</font><br>'; 
		$ef3=$spacer.'<font color="white">Mayong Mistmoore (Sanctum)</font><br>'; $ef4=$spacer.'<font color="white">Mayong Mistmoore (Throne)</font><br>'; $ef5=$spacer.'<font color="white">Wuoshi</font><br>'; 
		$rokval=$this->user->lang('eq2progresstle_f_eq2progresstle_kunark');
		$rok1=$spacer.'<font color="white">Byzola</font><br>'; $rok2=$spacer.'<font color="white">Imzok\'s Revenge</font><br>';	
		$rok3=$spacer.'<font color="white">Leviathan</font><br>'; $rok4=$spacer.'<font color="white">Pawbuster</font><br>';	
		$rok5=$spacer.'<font color="white">Phara Dar</font><br>'; $rok6=$spacer.'<font color="white">Selrach Di\'Zok</font><br>';
		$rok7=$spacer.'<font color="white">Tairiza</font><br>'; $rok8=$spacer.'<font color="white">Trakanon</font><br>';
		$rok9=$spacer.'<font color="white">Venril Sathir</font><br>'; $tsoval=$this->user->lang('eq2progresstle_f_eq2progresstle_odyssey');
		$tso1=$spacer.'<font color="white">Anashti Sul</font><br>'; $tso2=$spacer.'<font color="white">Gynok Moltor</font><br>';	
		$tso3=$spacer.'<font color="white">Miragul</font><br>'; $tso4=$spacer.'<font color="white">Munzok</font><br>';	
		$tso5=$spacer.'<font color="white">Warlord Ykesha</font><br>'; $tso6=$spacer.'<font color="white">Zarrakon</font><br>';
		$sfval=$this->user->lang('eq2progresstle_f_eq2progresstle_sentinel');
		$sf1=$spacer.'<font color="white">Master Yael</font><br>'; $sf2=$spacer.'<font color="white">Perah\'Celsis</font><br>'; 
		$sf3=$spacer.'<font color="white">Roehn Theer</font><br>'; $sf4=$spacer.'<font color="white">Roehn Theer (HM)</font><br>';
		$sf5=$spacer.'<font color="white">Toxxulia</font><br>'; $sf6=$spacer.'<font color="white">Vuulan</font><br>'; 
		$sf7=$spacer.'<font color="white">Waansu</font><br>'; 
		$dovval=$this->user->lang('eq2progresstle_f_eq2progresstle_velious'); 
		$dov1=$spacer.'<font color="white">Dozekar</font><br>'; $dov2=$spacer.'<font color="white">Dozekar (Challenge)</font><br>'; 
		$dov3=$spacer.'<font color="white">General Teku</font><br>'; $dov4=$spacer.'<font color="white">Honvar the Earthcrasher</font><br>'; $dov5=$spacer.'<font color="white">Kildrukaun the Ancient</font><br>';
		$dov6=$spacer.'<font color="white">King Tormax</font><br>'; $dov7=$spacer.'<font color="white">King Tormax (Challenge)</font><br>'; $dov8=$spacer.'<font color="white">Kraytok</font><br>'; $dov9=$spacer.'<font color="white">Kraytok (Challenge)</font><br>'; 
		$dov10=$spacer.'<font color="white">Psyllon\'Ris\'</font><br>'; $dov11=$spacer.'<font color="white">Sevalak of Storms</font><br>'; 
		$dov12=$spacer.'<font color="white">Soren the Vindicator</font><br>'; $dov13=$spacer.'<font color="white">Statue of Rallos Zek</font><br>'; $dov14=$spacer.'<font color="white">Statue of Rallos Zek (Challenge)</font><br>'; 
		$dov15=$spacer.'<font color="white">Sullon Zek</font><br>'; $dov16=$spacer.'<font color="white">Sullon Zek (Challenge)</font><br>'; $dov17=$spacer.'<font color="white">Tallon Zek</font><br>'; $dov18=$spacer.'<font color="white">Tallon Zek (Challenge)</font><br>'; $dov19=$spacer.'<font color="white">Vallon Zek</font><br>'; $dov20=$spacer.'<font color="white">Vallon Zek (Challenge)</font><br>'; $dov21=$spacer.'<font color="white">Vrewwx Icyheart</font><br>'; $dov22=$spacer.'<font color="white">Vyskudra the Ancient</font><br>';
		$coeval=$this->user->lang('eq2progresstle_f_eq2progresstle_chains'); 
		$coe1=$spacer.'<font color="white">Amalgamon</font><br>'; $coe2=$spacer.'<font color="white">Baroddas & Baelon</font><br>';
		$coe3=$spacer.'<font color="white">Drinal 4 Soulwells</font><br>'; $coe4=$spacer.'<font color="white">Omugra, Thazarus, & Vuzalg</font><br>';
		$arenaval=$this->user->lang('eq2progresstle_f_eq2progresstle_arena'); 
		$arena1=$spacer.'<font color="white">Bristlebane</font><br>'; $arena2=$spacer.'<font color="white">Drinal</font><br>';
		$arena3=$spacer.'<font color="white">Mithaniel Marr</font><br>'; $arena4=$spacer.'<font color="white">Prexus</font><br>';
		$arena5=$spacer.'<font color="white">Rodcet Nife</font><br>'; $arena6=$spacer.'<font color="white">Solusek Ro</font><br>';
		$arena7=$spacer.'<font color="white">Sullon Zek</font><br>'; $arena8=$spacer.'<font color="white">Tallon Zek</font><br>';
		$arena9=$spacer.'<font color="white">Tunare</font><br>'; $arena10=$spacer.'<font color="white">Vallon Zek</font><br>';
		$contval=$this->user->lang('eq2progresstle_f_eq2progresstle_contested');
		$cont1=$spacer.'<font color="white">Drinal</font><br>'; $cont2=$spacer.'<font color="white">Mithaniel Marr</font><br>';
		$cont3=$spacer.'<font color="white">Prexus</font><br>'; $cont4=$spacer.'<font color="white">Rodcet Nife</font><br>';
		$cont5=$spacer.'<font color="white">Solusek Ro</font><br>'; $cont6=$spacer.'<font color="white">Sullon Zek</font><br>';
		$cont7=$spacer.'<font color="white">Tallon Zek</font><br>'; $cont8=$spacer.'<font color="white">Tunare</font><br>';
		$cont9=$spacer.'<font color="white">Vallon Zek</font><br>';
		$tovval=$this->user->lang('eq2progresstle_f_eq2progresstle_veeshan');
		$tov1=$spacer.'<font color="white">Bristlebane</font><br>'; $tov2=$spacer.'<font color="white">Draazak the Ancient</font><br>';
		$tov3=$spacer.'<font color="white">Exarch Lorokai the Unliving</font><br>'; $tov4=$spacer.'<font color="white">Fabled Mutagenic Outcast</font><br>'; $tov5=$spacer.'<font color="white">Fabled Three Princes</font><br>'; $tov6=$spacer.'<font color="white">Fabled Vyemm & Alzid Prime</font><br>'; $tov7=$spacer.'<font color="white">Roehn Theer - Ages End</font><br>';
		$tov8=$spacer.'<font color="white">Roehn Theer - Ages End (HM)</font><br>'; $tov9=$spacer.'<font color="white">The Crumbling Emperor</font><br>'; $tov10=$spacer.'<font color="white">Vulak\'Aerr the Dreadscale</font><br>';
		$tov11=$spacer.'<font color="white">Zlandicar</font><br>';
		$aomval=$this->user->lang('eq2progresstle_f_eq2progresstle_altar');
		$aom1=$spacer.'<font color="white">Arch Lich Rhag\'Zadune</font><br>'; $aom2=$spacer.'<font color="white">Baz the Illusionist</font><br>'; $aom3=$spacer.'<font color="white">Captain Krasnok</font><br>';
		$aom4=$spacer.'<font color="white">Construct of Malice</font><br>'; $aom5=$spacer.'<font color="white">Grethah the Frenzied</font><br>'; $aom6=$spacer.'<font color="white">Kildiun the Drunkard</font><br>';
		$aom7=$spacer.'<font color="white">Malkonis D\'Morte</font><br>'; $aom8=$spacer.'<font color="white">Malkonis D\'Morte (Challenge)</font><br>'; $aom9=$spacer.'<font color="white">Perador the Mighty</font><br>'; $aom10=$spacer.'<font color="white">Primordial Ritualist Villandre V\'Zher</font><br>'; $aom11=$spacer.'<font color="white">The Crumbling Icon</font><br>';
		$popval=$this->user->lang('eq2progresstle_f_eq2progresstle_precipice');
		$pop1=$spacer.'<font color="white">Brell Serilis</font><br>'; $pop2=$spacer.'<font color="white">Cazic-Thule</font><br>'; 
		$pop3=$spacer.'<font color="white">Fennin Ro</font><br>'; $pop4=$spacer.'<font color="white">Karana</font><br>'; 
		$pop5=$spacer.'<font color="white">The Tribunal</font><br>';
		//Check which have been killed
		$tkillslist = $this->pdc->get('portal.module.eq2progresstle.'.$this->root_path);
				if (!$tkillslist){
		for ($a=0; $a<=$ktot; $a++) {
		$kdate = "";
		if (($this->config('eq2progresstle_date')) == TRUE ) 		
		{ ($stamp = date('m/d/Y', $achieve[$a]['completedtimestamp']));	 
	        ($kdate = '<font color="white">'.$stamp.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strike></font>'); }
		$acid = $achieve[$a]['id'];
		//Check which were killed
		if ($acid == '755589334')  {$shattered = $shattered + 1; $sh1 = $kdate.$this->killed($sh1);}
		if ($acid == '2880419067') {$shattered = $shattered + 1; $sh2 = $kdate.$this->killed($sh2);}
		if ($acid == '2690907646') {$shattered = $shattered + 1; $sh3 = $kdate.$this->killed($sh3);}
		if ($acid == '3031774005') {$shattered = $shattered + 1; $sh4 = $kdate.$this->killed($sh4);}
		if ($acid == '616659975')  {$shattered = $shattered + 1; $sh5 = $kdate.$this->killed($sh5);}
		if ($acid == '1031899415') {$shattered = $shattered + 1; $sh6 = $kdate.$this->killed($sh6);}
		if ($acid == '2217589756') {$shattered = $shattered + 1; $sh7 = $kdate.$this->killed($sh7);}
		if ($acid == '1277336788') {$shattered = $shattered + 1; $sh8 = $kdate.$this->killed($sh8);}
		if ($acid == '1175319967') {$shattered = $shattered + 1; $sh9 = $kdate.$this->killed($sh9);}
		if ($acid == '3758088138') {$splitpaw = $splitpaw + 1; $ss1 = $kdate.$this->killed($ss1);}
		if ($acid == '3522306503') {$splitpaw = $splitpaw + 1; $ss2 = $kdate.$this->killed($ss2);}
		if ($acid == '4152187954') {$desert = $desert + 1; $df1 = $kdate.$this->killed($df1);}
		if ($acid == '432099394')  {$desert = $desert + 1; $df2 = $kdate.$this->killed($df2);}
		if ($acid == '4194994362') {$desert = $desert + 1; $df3 = $kdate.$this->killed($df3);}
		if ($acid == '1805107181') {$desert = $desert + 1; $df4 = $kdate.$this->killed($df4);}
		if ($acid == '2296904021') {$desert = $desert + 1; $df5 = $kdate.$this->killed($df5);}
		if ($acid == '2929705358') {$desert = $desert + 1; $df6 = $kdate.$this->killed($df6);}
		if ($acid == '1222636566') {$desert = $desert + 1; $df7 = $kdate.$this->killed($df7);}
		if ($acid == '3002259501') {$desert = $desert + 1; $df8 = $kdate.$this->killed($df8);}
		if ($acid == '3022331543') {$fallen = $fallen + 1; $fd1 = $kdate.$this->killed($fd1);}
		if ($acid == '2604469264') {$fallen = $fallen + 1; $fd2 = $kdate.$this->killed($fd2);}
		if ($acid == '2052346762') {$fallen = $fallen + 1; $fd3 = $kdate.$this->killed($fd3);}
		if ($acid == '2301347501') {$kingdom = $kingdom + 1; $ks1 = $kdate.$this->killed($ks1);}
		if ($acid == '2446900980') {$kingdom = $kingdom + 1; $ks2 = $kdate.$this->killed($ks2);}
		if ($acid == '3442597125') {$kingdom = $kingdom + 1; $ks3 = $kdate.$this->killed($ks3);}
		if ($acid == '609384496')  {$kingdom = $kingdom + 1; $ks4 = $kdate.$this->killed($ks4);}
		if ($acid == '1798429543') {$kingdom = $kingdom + 1; $ks5 = $kdate.$this->killed($ks5);}
		if ($acid == '2075381149') {$kingdom = $kingdom + 1; $ks6 = $kdate.$this->killed($ks6);}
		if ($acid == '1276137549') {$kingdom = $kingdom + 1; $ks7 = $kdate.$this->killed($ks7);}
		if ($acid == '2351493763') {$kingdom = $kingdom + 1; $ks8 = $kdate.$this->killed($ks8);}
		if ($acid == '2660282579') {$faydwer = $faydwer + 1; $ef1 = $kdate.$this->killed($ef1);}
		if ($acid == '2266042524') {$faydwer = $faydwer + 1; $ef2 = $kdate.$this->killed($ef2);}
		if ($acid == '573824603')  {$faydwer = $faydwer + 1; $ef3 = $kdate.$this->killed($ef3);}
		if ($acid == '2253756365') {$faydwer = $faydwer + 1; $ef4 = $kdate.$this->killed($ef4);}
		if ($acid == '3922377540') {$faydwer = $faydwer + 1; $ef5 = $kdate.$this->killed($ef5);}
		if ($acid == '3291105741') {$kunark = $kunark + 1; $rok1 = $kdate.$this->killed($rok1);}
		if ($acid == '3927712073') {$kunark = $kunark + 1; $rok2 = $kdate.$this->killed($rok2);}
		if ($acid == '2653397487') {$kunark = $kunark + 1; $rok3 = $kdate.$this->killed($rok3);}
		if ($acid == '4056887203') {$kunark = $kunark + 1; $rok4 = $kdate.$this->killed($rok4);}
		if ($acid == '3100040417') {$kunark = $kunark + 1; $rok5 = $kdate.$this->killed($rok5);}
		if ($acid == '3448097163') {$kunark = $kunark + 1; $rok6 = $kdate.$this->killed($rok6);}
		if ($acid == '1837045447') {$kunark = $kunark + 1; $rok7 = $kdate.$this->killed($rok7);}
		if ($acid == '3830384644') {$kunark = $kunark + 1; $rok8 = $kdate.$this->killed($rok8);}
		if ($acid == '826149840')  {$kunark = $kunark + 1; $rok9 = $kdate.$this->killed($rok9);}
		if ($acid == '3155887355') {$odyssey = $odyssey + 1; $tso1 = $kdate.$this->killed($tso1);}
		if ($acid == '1526448946') {$odyssey = $odyssey + 1; $tso2 = $kdate.$this->killed($tso2);}
		if ($acid == '3682994519') {$odyssey = $odyssey + 1; $tso3 = $kdate.$this->killed($tso3);}
		if ($acid == '1005439184') {$odyssey = $odyssey + 1; $tso4 = $kdate.$this->killed($tso4);}
		if ($acid == '3650735286') {$odyssey = $odyssey + 1; $tso5 = $kdate.$this->killed($tso5);}
		if ($acid == '1233836872') {$odyssey = $odyssey + 1; $tso6 = $kdate.$this->killed($tso6);}
		if ($acid == '3838099024') {$sentinel = $sentinel + 1; $sf1 = $kdate.$this->killed($sf1);}
		if ($acid == '2921756931') {$sentinel = $sentinel + 1; $sf2 = $kdate.$this->killed($sf2);}
		if ($acid == '1362341525') {$sentinel = $sentinel + 1; $sf3 = $kdate.$this->killed($sf3);}
		if ($acid == '1808623966') {$sentinel = $sentinel + 1; $sf4 = $kdate.$this->killed($sf4);}
		if ($acid == '3217251809') {$sentinel = $sentinel + 1; $sf5 = $kdate.$this->killed($sf5);}
		if ($acid == '235060975')  {$sentinel = $sentinel + 1; $sf6 = $kdate.$this->killed($sf6);}
		if ($acid == '130131495')  {$sentinel = $sentinel + 1; $sf7 = $kdate.$this->killed($sf7);}
		if ($acid == '351383115')  {$velious = $velious + 1; $dov1 = $kdate.$this->killed($dov1);}
		if ($acid == '2473806106') {$velious = $velious + 1; $dov2 = $kdate.$this->killed($dov2);}
		if ($acid == '3615452988') {$velious = $velious + 1; $dov3 = $kdate.$this->killed($dov3);}
		if ($acid == '3010722630') {$velious = $velious + 1; $dov4 = $kdate.$this->killed($dov4);}
		if ($acid == '4054449882') {$velious = $velious + 1; $dov5 = $kdate.$this->killed($dov5);}
		if ($acid == '1628177139') {$velious = $velious + 1; $dov6 = $kdate.$this->killed($dov6);}
		if ($acid == '3606842680') {$velious = $velious + 1; $dov7 = $kdate.$this->killed($dov7);}
		if ($acid == '536961056')  {$velious = $velious + 1; $dov8 = $kdate.$this->killed($dov8);}
		if ($acid == '1765210956') {$velious = $velious + 1; $dov9 = $kdate.$this->killed($dov9);}
		if ($acid == '835180705')  {$velious = $velious + 1; $dov10 = $kdate.$this->killed($dov10);}
		if ($acid == '2362010195') {$velious = $velious + 1; $dov11 = $kdate.$this->killed($dov11);}
		if ($acid == '344369629')  {$velious = $velious + 1; $dov12 = $kdate.$this->killed($dov12);}
		if ($acid == '2166076255') {$velious = $velious + 1; $dov13 = $kdate.$this->killed($dov13);}
		if ($acid == '2544523763') {$velious = $velious + 1; $dov14 = $kdate.$this->killed($dov14);}
		if ($acid == '832312297')  {$velious = $velious + 1; $dov15 = $kdate.$this->killed($dov15);}
		if ($acid == '3285130354') {$velious = $velious + 1; $dov16 = $kdate.$this->killed($dov16);}
		if ($acid == '3582177156') {$velious = $velious + 1; $dov17 = $kdate.$this->killed($dov17);}
		if ($acid == '3493794934') {$velious = $velious + 1; $dov18 = $kdate.$this->killed($dov18);}
		if ($acid == '2097487381') {$velious = $velious + 1; $dov19 = $kdate.$this->killed($dov19);}
		if ($acid == '3570058315') {$velious = $velious + 1; $dov20 = $kdate.$this->killed($dov20);}
		if ($acid == '4145063722') {$velious = $velious + 1; $dov21 = $kdate.$this->killed($dov21);}
		if ($acid == '528786370')  {$velious = $velious + 1; $dov22 = $kdate.$this->killed($dov22);}
		if ($acid == '1622583242') {$chains = $chains + 1; $coe1 = $kdate.$this->killed($coe1);}
		if ($acid == '2815791137') {$chains = $chains + 1; $coe2 = $kdate.$this->killed($coe2);}
		if ($acid == '117381414')  {$chains = $chains + 1; $coe3 = $kdate.$this->killed($coe3);}
		if ($acid == '3473349988') {$chains = $chains + 1; $coe4 = $kdate.$this->killed($coe4);}
		if ($acid == '2968476469') {$arena = $arena + 1; $arena1 = $kdate.$this->killed($arena1);}
		if ($acid == '1979157433') {$arena = $arena + 1; $arena2 = $kdate.$this->killed($arena2);}
		if ($acid == '593827632')  {$arena = $arena + 1; $arena3 = $kdate.$this->killed($arena3);}
		if ($acid == '476803566')  {$arena = $arena + 1; $arena4 = $kdate.$this->killed($arena4);}
		if ($acid == '136089721')  {$arena = $arena + 1; $arena5 = $kdate.$this->killed($arena5);}
		if ($acid == '1266762124') {$arena = $arena + 1; $arena6 = $kdate.$this->killed($arena6);}
		if ($acid == '3234597117') {$arena = $arena + 1; $arena7 = $kdate.$this->killed($arena7);}
		if ($acid == '3543924985') {$arena = $arena + 1; $arena8 = $kdate.$this->killed($arena8);}
		if ($acid == '1253692288') {$arena = $arena + 1; $arena9 = $kdate.$this->killed($arena9);}
		if ($acid == '3620327620') {$arena = $arena + 1; $arena10 = $kdate.$this->killed($arena10);}
		if ($acid == '2417016352') {$contested = $contested + 1; $cont1 = $kdate.$this->killed($cont1);}
		if ($acid == '42226058')   {$contested = $contested + 1; $cont2 = $kdate.$this->killed($cont2);}
		if ($acid == '4186719351') {$contested = $contested + 1; $cont3 = $kdate.$this->killed($cont3);}
		if ($acid == '2623216647') {$contested = $contested + 1; $cont4 = $kdate.$this->killed($cont4);}
		if ($acid == '1748417285') {$contested = $contested + 1; $cont5 = $kdate.$this->killed($cont5);}
		if ($acid == '3816551028') {$contested = $contested + 1; $cont6 = $kdate.$this->killed($cont6);}
		if ($acid == '4035705456') {$contested = $contested + 1; $cont7 = $kdate.$this->killed($cont7);}
		if ($acid == '2942232089') {$contested = $contested + 1; $cont8 = $kdate.$this->killed($cont8);}
		if ($acid == '4101909069') {$contested = $contested + 1; $cont9 = $kdate.$this->killed($cont9);}
		if ($acid == '2371639852') {$veeshan = $veeshan + 1; $tov1 = $kdate.$this->killed($tov1);}
		if ($acid == '2828051041') {$veeshan = $veeshan + 1; $tov2 = $kdate.$this->killed($tov2);}
		if ($acid == '3607119179') {$veeshan = $veeshan + 1; $tov3 = $kdate.$this->killed($tov3);}
		if ($acid == '3194637595') {$veeshan = $veeshan + 1; $tov4 = $kdate.$this->killed($tov4);}
		if ($acid == '554855277')  {$veeshan = $veeshan + 1; $tov5 = $kdate.$this->killed($tov5);}
		if ($acid == '1344069514') {$veeshan = $veeshan + 1; $tov6 = $kdate.$this->killed($tov6);}
		if ($acid == '1089000969') {$veeshan = $veeshan + 1; $tov7 = $kdate.$this->killed($tov7);}
		if ($acid == '1400749304') {$veeshan = $veeshan + 1; $tov8 = $kdate.$this->killed($tov8);}
		if ($acid == '3296875551') {$veeshan = $veeshan + 1; $tov9 = $kdate.$this->killed($tov9);}
		if ($acid == '1302823374') {$veeshan = $veeshan + 1; $tov10 = $kdate.$this->killed($tov10);}
		if ($acid == '616943266')  {$veeshan = $veeshan + 1; $tov11 = $kdate.$this->killed($tov11);}
		if ($acid == '3928176072') {$altar = $altar + 1; $aom1 = $kdate.$this->killed($aom1);}
		if ($acid == '3296712239') {$altar = $altar + 1; $aom2 = $kdate.$this->killed($aom2);}
		if ($acid == '1748957509') {$altar = $altar + 1; $aom3 = $kdate.$this->killed($aom3);}
		if ($acid == '116845928')  {$altar = $altar + 1; $aom4 = $kdate.$this->killed($aom4);}
		if ($acid == '1849147944') {$altar = $altar + 1; $aom5 = $kdate.$this->killed($aom5);}
		if ($acid == '1475875915') {$altar = $altar + 1; $aom6 = $kdate.$this->killed($aom6);}
		if ($acid == '19578004')   {$altar = $altar + 1; $aom7 = $kdate.$this->killed($aom7);}
		if ($acid == '99686993')   {$altar = $altar + 1; $aom8 = $kdate.$this->killed($aom8);}
		if ($acid == '2955610207') {$altar = $altar + 1; $aom9 = $kdate.$this->killed($aom9);}
		if ($acid == '1434280382' or $acid == '2017956309'){$altar = $altar + 1; $aom10 = $kdate.$this->killed($aom10);}
		if ($acid == '3742464779') {$altar = $altar + 1; $aom11 = $kdate.$this->killed($aom11);}
		if ($acid == '3785130348') {$precipice = $precipice + 1; $pop1 = $kdate.$this->killed($pop1);}
		if ($acid == '3312622728') {$precipice = $precipice + 1; $pop2 = $kdate.$this->killed($pop2);}
		if ($acid == '1264497483') {$precipice = $precipice + 1; $pop3 = $kdate.$this->killed($pop3);}
		if ($acid == '2302657105') {$precipice = $precipice + 1; $pop4 = $kdate.$this->killed($pop4);}
		if ($acid == '3211824092') {$precipice = $precipice + 1; $pop5 = $kdate.$this->killed($pop5);}
		
		}
		
		//cache it
		$tkillslist = array($sh1,$sh2,$sh3,$sh4,$sh5,$sh6,$sh7,$sh8,$sh9,$shattered,
						   $ss1,$ss2,$splitpaw,
						   $df1,$df2,$df3,$df4,$df5,$df6,$df7,$df8,$desert,
						   $fd1,$fd2,$fd3,$fallen,
						   $ks1,$ks2,$ks3,$ks4,$ks5,$ks6,$ks7,$ks8,$kingdom,
						   $ef1,$ef2,$ef3,$ef4,$ef5,$faydwer,
						   $rok1,$rok2,$rok3,$rok4,$rok5,$rok6,$rok7,$rok8,$rok9,$kunark,
						   $tso1,$tso2,$tso3,$tso4,$tso5,$tso6,$odyssey,
						   $sf1,$sf2,$sf3,$sf4,$sf5,$sf6,$sf7,$sentinel,
						   $dov1,$dov2,$dov3,$dov4,$dov5,$dov6,$dov7,$dov8,$dov9,$dov10,$dov11,$dov12,$dov13,$dov14,$dov15,$dov16,$dov17,$dov18,$dov19,$dov20,$dov21,$dov22,$velious,
						   $coe1,$coe2,$coe3,$coe4,$chains,
						   $arena1,$arena2,$arena3,$arena4,$arena5,$arena6,$arena7,$arena8,$arena9,$arena10,$arena,
						   $cont1,$cont2,$cont3,$cont4,$cont5,$cont6,$cont7,$cont8,$cont9,$contested,
						   $tov1,$tov2,$tov3,$tov4,$tov5,$tov6,$tov7,$tov8,$tov9,$tov10,$tov11,$veeshan,
						   $aom1,$aom2,$aom3,$aom4,$aom5,$aom6,$aom7,$aom8,$aom9,$aom10,$aom11,$altar,
						   $pop1,$pop2,$pop3,$pop4,$pop5,$precipice
						   );
		$this->pdc->put('portal.module.eq2progresstle.'.$this->root_path, $tkillslist, 3600);
				}
		$vanilla = ($tkillslist[0].$tkillslist[1].$tkillslist[2].$tkillslist[3].$tkillslist[4].$tkillslist[5].$tkillslist[6].$tkillslist[7].$tkillslist[8]);
		$zonetotal1 = ($tkillslist[9]);
		$sunder = ($tkillslist[10].$tkillslist[11]);
		$zonetotal2 = ($tkillslist[12]);
		$flame = ($tkillslist[13].$tkillslist[14].$tkillslist[15].$tkillslist[16].$tkillslist[17].$tkillslist[18].$tkillslist[19].$tkillslist[20]);
		$zonetotal3 = ($tkillslist[21]);		
		$fall = ($tkillslist[22].$tkillslist[23].$tkillslist[24]);
		$zonetotal4 = ($tkillslist[25]);
		$king = ($tkillslist[26].$tkillslist[27].$tkillslist[28].$tkillslist[29].$tkillslist[30].$tkillslist[31].$tkillslist[32].$tkillslist[33]);
		$zonetotal5 = ($tkillslist[34]);
		$echoes = ($tkillslist[35].$tkillslist[36].$tkillslist[37].$tkillslist[38].$tkillslist[39]);
		$zonetotal6 = ($tkillslist[40]);
		$ruins = ($tkillslist[44].$tkillslist[42].$tkillslist[43].$tkillslist[44].$tkillslist[45].$tkillslist[46].$tkillslist[47].
		$tkillslist[48].$tkillslist[49]);
		$zonetotal7 = ($tkillslist[50]);
		$shad = ($tkillslist[51].$tkillslist[52].$tkillslist[53].$tkillslist[54].$tkillslist[55].$tkillslist[56]);
		$zonetotal8 = ($tkillslist[57]);
		$fate = ($tkillslist[58].$tkillslist[59].$tkillslist[60].$tkillslist[61].$tkillslist[62].$tkillslist[63].$tkillslist[64]);
		$zonetotal9 = ($tkillslist[65]);
		$dest = ($tkillslist[66].$tkillslist[67].$tkillslist[68].$tkillslist[69].$tkillslist[70].$tkillslist[71].$tkillslist[72].$tkillslist[73].$tkillslist[74].$tkillslist[75].$tkillslist[76].$tkillslist[77].$tkillslist[78].$tkillslist[79].$tkillslist[80].$tkillslist[81].$tkillslist[82].$tkillslist[83].$tkillslist[84].$tkillslist[85].$tkillslist[86].$tkillslist[87]);
	        $zonetotal10 = ($tkillslist[88]);
		$chain = ($tkillslist[89].$tkillslist[90].$tkillslist[91].$tkillslist[92]);
		$zonetotal11 = ($tkillslist[93]);
		$aren = ($tkillslist[94].$tkillslist[95].$tkillslist[96].$tkillslist[97].$tkillslist[98].$tkillslist[99].$tkillslist[100].$tkillslist[101].$tkillslist[102].$tkillslist[103]);
		$zonetotal12 = ($tkillslist[104]);
		$con = ($tkillslist[105].$tkillslist[106].$tkillslist[107].$tkillslist[108].$tkillslist[109].$tkillslist[110].$tkillslist[111].$tkillslist[112].$tkillslist[113]);
		$zonetotal13 = ($tkillslist[114]);
		$tear  = ($tkillslist[115].$tkillslist[116].$tkillslist[117].$tkillslist[118].$tkillslist[119].$tkillslist[120].$tkillslist[121].
		$tkillslist[122].$tkillslist[123].$tkillslist[124].$tkillslist[125]);
		$zonetotal14 = ($tkillslist[126]);		
		$alt = ($tkillslist[127].$tkillslist[128].$tkillslist[129].$tkillslist[130].$tkillslist[131].$tkillslist[132].$tkillslist[133].$tkillslist[134].$tkillslist[135].$tkillslist[136].$tkillslist[137]);
		$zonetotal15 = ($tkillslist[138]);
		$power = ($tkillslist[139].$tkillslist[140].$tkillslist[141].$tkillslist[142].$tkillslist[143]);
		$zonetotal16 = ($tkillslist[144]);
                $zonename1 = $shval; 	      $zonemax1 = $shmax;          $zonetip1 = $vanilla;
		$zonename2 = $ssval; 	      $zonemax2 = $ssmax;          $zonetip2 = $sunder;
		$zonename3 = $dfval;  	      $zonemax3 = $dfmax;          $zonetip3 = $flame;
		$zonename4 = $fdval; 	      $zonemax4 = $fdmax;          $zonetip4 = $fall;
		$zonename5 = $ksval;  	      $zonemax5 = $ksmax;          $zonetip5 = $king;
		$zonename6 = $efval;  	      $zonemax6 = $efmax;          $zonetip6 = $echoes;
		$zonename7 = $rokval;  	      $zonemax7 = $rokmax;         $zonetip7 = $ruins;
		$zonename8 = $tsoval; 	      $zonemax8 = $tsomax;  	   $zonetip8 = $shad;
		$zonename9 = $sfval; 	      $zonemax9 = $sfmax;      	   $zonetip9 = $fate;
		$zonename10 = $dovval;        $zonemax10 = $dovmax;        $zonetip10 = $dest;
		$zonename11 = $coeval;        $zonemax11 = $coemax;   	   $zonetip11 = $chain;
		$zonename12 = $arenaval;      $zonemax12 = $arenamax;      $zonetip12 = $aren;
		$zonename13 = $contval;       $zonemax13 = $contmax; 	   $zonetip13 = $con;
		$zonename14 = $tovval; 	      $zonemax14 = $tovmax; 	   $zonetip14 = $tear;
		$zonename15 = $aomval; 	      $zonemax15 = $aommax;	   $zonetip15 = $alt;
		$zonename16 = $popval; 	      $zonemax16 = $popmax;    	   $zonetip16 = $power;
		$out = '';
			for($i=1;$i<=16;$i++) {
			$check = ${"zone".$i};
			if ($check == TRUE) {
			$text = ${"zonename".$i}; $value = ${"zonetotal".$i}; $max = ${"zonemax".$i}; $tooltip = ${"zonetip".$i};	
			$out .= $this->bar_out($i,$value,$max,$text,$tooltip);
			} 
			}
			return $out;
		return $this->bar_out();
	}
	
	public function killed($kill) {
		$killed = preg_replace("/&#?[a-z0-9]{2,8};/i","",$kill);
		$killed2 = strip_tags($killed);
		$killed3 = substr($killed2,10);
		$killed4 = '<font color="808080"><strike>'.$killed3.'</strike></font><br>';
		return $killed4;
		}	
	
	public function bar_out($num,$value,$max,$text,$tooltip) {
		if(empty($tooltip)) return $this->jquery->ProgressBar('eq2progresstle_'.unique_id(), 0, array(
			'total' 	=> $max,
			'completed' => $value,
			'text'		=> $text.' %progress%',
			'txtalign'	=> 'center',
		));
		$name = 'eq2progresstle_tt_'.unique_id();
		$positions = array(
			'left' => array('my' => 'left top', 'at' => 'right center', 'name' => $name),
			'middle' => array('name' => $name),
			'right' => array('my' => 'right center', 'at' => 'left center', 'name' => $name ),
			'bottom' => array('my' => 'bottom center', 'at' => 'top center', 'name' => $name ),
		);
		$arrPosition = (isset($positions[$this->position])) ? $positions[$this->position] : $positions['middle'];
		$tooltipopts	= array('label' => $this->jquery->ProgressBar('eq2progresstle_'.unique_id(), 0, array(
			'total' 	=> $max,
			'completed' => $value,
			'text'		=> $text.' %progress%',
			'txtalign'	=> 'center',
		)), 'content' => $tooltip);
		$tooltipopts	= array_merge($tooltipopts, $arrPosition);
		return new htooltip('eq2progresstle_tt'.$num, $tooltipopts);
	}
}

?>
