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
 * V1.3 Fixed Bug with Date Killed
 * V1.2 Minor Fix
 * V1.1 Added Avatar Brell Serilius
 * V1.0 Initial Release - TLE Version
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

class eq2progresstle_portal extends portal_generic {
	protected static $path		= 'eq2progresstle';
	protected static $data		= array(
		'name'			=> 'EQ2 Progression TLE',
		'version'		=> '1.3',
		'author'		=> 'Darkmaeg',
		'icon'			=> 'fa-bar-chart-o',
		'contact'		=> EQDKP_PROJECT_URL,
		'description'	=> 'Everquest 2 Progression TLE',
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
		$tktot = count($achieve);
		$this->game->new_object('eq2_daybreak', 'daybreak', array($this->config->get('uc_server_loc'), $this->config->get('uc_data_lang')));
		if(!is_object($this->game->obj['daybreak'])) return "";
		$guilddata = $this->game->obj['daybreak']->guildinfo($this->config->get('guildtag'), $this->config->get('servername'), false);
		$achieve = $guilddata['guild_list'][0]['achievement_list'];	
		$gdata 	  = $guilddata['guild_list'][0];
		$tktot = count($achieve);
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
		for ($ta=0; $ta<=$tktot; $ta++) {
		$tkdate = "";
		//d($tkdate);
		if (($this->config('eq2progresstle_date')) == TRUE ) { 
		($tstamp = date('m/d/Y', $achieve[$ta]['completedtimestamp']));	 
	    ($tkdate = '<font color="white">'.$tstamp.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strike></font>');
		}
		$tacid = $achieve[$ta]['id'];
		if ($tacid == '755589334')  {$shattered = $shattered + 1; 
		$sh1 = $tkdate.'<font color="808080"><strike>Archlich Udalan</strike></font><br>';}
		if ($tacid == '2880419067') {$shattered = $shattered + 1; 
		$sh2 = $tkdate.'<font color="808080"><strike>Darathar</strike></font><br>';}
		if ($tacid == '2690907646') {$shattered = $shattered + 1; 
		$sh3 = $tkdate.'<font color="808080"><strike>K\'Dal the Deceiver</strike></font><br>';}
		if ($tacid == '3031774005') {$shattered = $shattered + 1; 
		$sh4 = $tkdate.'<font color="808080"><strike>King Drayek</strike></font><br>';}
		if ($tacid == '616659975')  {$shattered = $shattered + 1; 
		$sh5 = $tkdate.'<font color="808080"><strike>King Zalak</strike></font><br>';}
		if ($tacid == '1031899415') {$shattered = $shattered + 1; 
		$sh6 = $tkdate.'<font color="808080"><strike>Overlord Oxulius</strike></font><br>';}
		if ($tacid == '2217589756') {$shattered = $shattered + 1; 
		$sh7 = $tkdate.'<font color="808080"><strike>Rognog the Angler</strike></font><br>';}
		if ($tacid == '1277336788') {$shattered = $shattered + 1; 
		$sh8 = $tkdate.'<font color="808080"><strike>Venekor</strike></font><br>';}
		if ($tacid == '1175319967') {$shattered = $shattered + 1; 
		$sh9 = $tkdate.'<font color="808080"><strike>Vox</strike></font><br>';}
		if ($tacid == '3758088138') {$splitpaw = $splitpaw + 1; 
		$ss1 = $tkdate.'<font color="808080"><strike>Faroth Mal</strike></font><br>';}
		if ($tacid == '3522306503') {$splitpaw = $splitpaw + 1; 
		$ss2 = $tkdate.'<font color="808080"><strike>Skoam Anvilpaw</strike></font><br>';}
		if ($tacid == '4152187954') {$desert = $desert + 1; 
		$df1 = $tkdate.'<font color="808080"><strike>Ahk\'Min Rhoen</strike></font><br>';}
		if ($tacid == '432099394')  {$desert = $desert + 1; 
		$df2 = $tkdate.'<font color="808080"><strike>Arazul, Hand of the Godking</strike></font><br>';}
		if ($tacid == '4194994362') {$desert = $desert + 1; 
		$df3 = $tkdate.'<font color="808080"><strike>Barakah & Siyamak</strike></font><br>';}
		if ($tacid == '1805107181') {$desert = $desert + 1; 
		$df4 = $tkdate.'<font color="808080"><strike>Djinn Master</strike></font><br>';}
		if ($tacid == '2296904021') {$desert = $desert + 1; 
		$df5 = $tkdate.'<font color="808080"><strike>Godking Anuk</strike></font><br>';}
		if ($tacid == '2929705358') {$desert = $desert + 1; 
		$df6 = $tkdate.'<font color="808080"><strike>Lathena</strike></font><br>';}
		if ($tacid == '1222636566') {$desert = $desert + 1; 
		$df7 = $tkdate.'<font color="808080"><strike>Lockjaw</strike></font><br>';}
		if ($tacid == '3002259501') {$desert = $desert + 1; 
		$df8 = $tkdate.'<font color="808080"><strike>The Black Queen</strike></font><br>';}
		if ($tacid == '3022331543') {$fallen = $fallen + 1; 
		$fd1 = $tkdate.'<font color="808080"><strike>Chel\'Drak</strike></font><br>';}
		if ($tacid == '2604469264') {$fallen = $fallen + 1; 
		$fd2 = $tkdate.'<font color="808080"><strike>Xux\'laio</strike></font><br>';}
		if ($tacid == '2052346762') {$fallen = $fallen + 1; 
		$fd3 = $tkdate.'<font color="808080"><strike>Bonesnapper</strike></font><br>';}
		if ($tacid == '2301347501') {$kingdom = $kingdom + 1; 
		$ks1 = $tkdate.'<font color="808080"><strike>Harla Dar</strike></font><br>';}
		if ($tacid == '2446900980') {$kingdom = $kingdom + 1; 
		$ks2 = $tkdate.'<font color="808080"><strike>Pantrilla</strike></font><br>';}
		if ($tacid == '3442597125') {$kingdom = $kingdom + 1; 
		$ks3 = $tkdate.'<font color="808080"><strike>Sharti & Ireth</strike></font><br>';}
		if ($tacid == '609384496')  {$kingdom = $kingdom + 1; 
		$ks4 = $tkdate.'<font color="808080"><strike>Talendor & Gorenaire</strike></font><br>';}
		if ($tacid == '1798429543') {$kingdom = $kingdom + 1; 
		$ks5 = $tkdate.'<font color="808080"><strike>Tarinax</strike></font><br>';}
		if ($tacid == '2075381149') {$kingdom = $kingdom + 1; 
		$ks6 = $tkdate.'<font color="808080"><strike>Venekor</strike></font><br>';}
		if ($tacid == '1276137549') {$kingdom = $kingdom + 1; 
		$ks7 = $tkdate.'<font color="808080"><strike>Vilucidae</strike></font><br>';}
		if ($tacid == '2351493763') {$kingdom = $kingdom + 1; 
		$ks8 = $tkdate.'<font color="808080"><strike>Vyemm</strike></font><br>';}
		if ($tacid == '2660282579') {$faydwer = $faydwer + 1; 
		$ef1 = $tkdate.'<font color="808080"><strike>Clockwork Menace</strike></font><br>';}
		if ($tacid == '2266042524') {$faydwer = $faydwer + 1; 
		$ef2 = $tkdate.'<font color="808080"><strike>Malkonis D\'Morte</strike></font><br>';}
		if ($tacid == '573824603')  {$faydwer = $faydwer + 1; 
		$ef3 = $tkdate.'<font color="808080"><strike>Maong Mistmoore (Sanctum)</strike></font><br>';}
		if ($tacid == '2253756365') {$faydwer = $faydwer + 1; 
		$ef4 = $tkdate.'<font color="808080"><strike>Mayong Mistmoore (Throne)</strike></font><br>';}
		if ($tacid == '3922377540') {$faydwer = $faydwer + 1; 
		$ef5 = $tkdate.'<font color="808080"><strike>Wuoshi</strike></font><br>';}
		if ($tacid == '3291105741') {$kunark = $kunark + 1; 
		$rok1 = $tkdate.'<font color="808080"><strike>Byzola</strike></font><br>';}
		if ($tacid == '3927712073') {$kunark = $kunark + 1; 
		$rok2 = $tkdate.'<font color="808080"><strike>Imzok\'s Revenge</strike></font><br>';}
		if ($tacid == '2653397487') {$kunark = $kunark + 1; 
		$rok3 = $tkdate.'<font color="808080"><strike>Leviathan</strike></font><br>';}
		if ($tacid == '4056887203') {$kunark = $kunark + 1; 
		$rok4 = $tkdate.'<font color="808080"><strike>Pawbuster</strike></font><br>';}
		if ($tacid == '3100040417') {$kunark = $kunark + 1; 
		$rok5 = $tkdate.'<font color="808080"><strike>Phara Dar</strike></font><br>';}
		if ($tacid == '3448097163') {$kunark = $kunark + 1; 
		$rok6 = $tkdate.'<font color="808080"><strike>Selrach Di\'Zok</strike></font><br>';}
		if ($tacid == '1837045447') {$kunark = $kunark + 1; 
		$rok7 = $tkdate.'<font color="808080"><strike>Tariza</strike></font><br>';}
		if ($tacid == '3830384644') {$kunark = $kunark + 1; 
		$rok8 = $tkdate.'<font color="808080"><strike>Trakanon</strike></font><br>';}
		if ($tacid == '826149840')  {$kunark = $kunark + 1; 
		$rok9 = $tkdate.'<font color="808080"><strike>Venril Sathir</strike></font><br>';}
		if ($tacid == '3155887355') {$odyssey = $odyssey + 1; 
		$tso1 = $tkdate.'<font color="808080"><strike>Anashti Sul</strike></font><br>';}
		if ($tacid == '1526448946') {$odyssey = $odyssey + 1; 
		$tso2 = $tkdate.'<font color="808080"><strike>Gynok Moltor</strike></font><br>';}
		if ($tacid == '3682994519') {$odyssey = $odyssey + 1; 
		$tso3 = $tkdate.'<font color="808080"><strike>Miragul</strike></font><br>';}
		if ($tacid == '1005439184') {$odyssey = $odyssey + 1; 
		$tso4 = $tkdate.'<font color="808080"><strike>Munzok</strike></font><br>';}
		if ($tacid == '3650735286') {$odyssey = $odyssey + 1; 
		$tso5 = $tkdate.'<font color="808080"><strike>Warlord Ykesha</strike></font><br>';}
		if ($tacid == '1233836872') {$odyssey = $odyssey + 1; 
		$tso6 = $tkdate.'<font color="808080"><strike>Zarrakon</strike></font><br>';}
		if ($tacid == '3838099024') {$sentinel = $sentinel + 1; 
		$sf1 = $tkdate.'<font color="808080"><strike>Master Yael</strike></font><br>';}
		if ($tacid == '2921756931') {$sentinel = $sentinel + 1; 
		$sf2 = $tkdate.'<font color="808080"><strike>Perah\'Celsis</strike></font><br>';}
		if ($tacid == '1362341525') {$sentinel = $sentinel + 1; 
		$sf3 = $tkdate.'<font color="808080"><strike>Roehn Theer</strike></font><br>';}
		if ($tacid == '1808623966') {$sentinel = $sentinel + 1; 
		$sf4 = $tkdate.'<font color="808080"><strike>Roehn Theer (HM)</strike></font><br>';}
		if ($tacid == '3217251809') {$sentinel = $sentinel + 1; 
		$sf5 = $tkdate.'<font color="808080"><strike>Toxxulia</strike></font><br>';}
		if ($tacid == '235060975')  {$sentinel = $sentinel + 1; 
		$sf6 = $tkdate.'<font color="808080"><strike>Vuulan</strike></font><br>';}
		if ($tacid == '130131495')  {$sentinel = $sentinel + 1; 
		$sf7 = $tkdate.'<font color="808080"><strike>Waansu</strike></font><br>';}
		if ($tacid == '351383115')  {$velious = $velious + 1; 
		$dov1 = $tkdate.'<font color="808080"><strike>Dozekar</strike></font><br>';}
		if ($tacid == '2473806106') {$velious = $velious + 1; 
		$dov2 = $tkdate.'<font color="808080"><strike>Dozekar (Challenge)</strike></font><br>';}
		if ($tacid == '3615452988') {$velious = $velious + 1; 
		$dov3 = $tkdate.'<font color="808080"><strike>General Teku</strike></font><br>';}
		if ($tacid == '3010722630') {$velious = $velious + 1; 
		$dov4 = $tkdate.'<font color="808080"><strike>Honvar the Earthcrasher</strike></font><br>';}
		if ($tacid == '4054449882') {$velious = $velious + 1; 
		$dov5 = $tkdate.'<font color="808080"><strike>Kildrukaun the Ancient</strike></font><br>';}
		if ($tacid == '1628177139') {$velious = $velious + 1; 
		$dov6 = $tkdate.'<font color="808080"><strike>King Tormax</strike></font><br>';}
		if ($tacid == '3606842680') {$velious = $velious + 1; 
		$dov7 = $tkdate.'<font color="808080"><strike>King Tormax (Challenge)</strike></font><br>';}
		if ($tacid == '536961056')  {$velious = $velious + 1; 
		$dov8 = $tkdate.'<font color="808080"><strike>Kraytok</strike></font><br>';}
		if ($tacid == '1765210956') {$velious = $velious + 1; 
		$dov9 = $tkdate.'<font color="808080"><strike>Kraytok (Challenge)</strike></font><br>';}
		if ($tacid == '835180705')  {$velious = $velious + 1; 
		$dov10 = $tkdate.'<font color="808080"><strike>Psyllon\'Ris\'</strike></font><br>';}
		if ($tacid == '2362010195') {$velious = $velious + 1; 
		$dov11 = $tkdate.'<font color="808080"><strike>Sevalak of Storms</strike></font><br>';}
		if ($tacid == '344369629')  {$velious = $velious + 1; 
		$dov12 = $tkdate.'<font color="808080"><strike>Soren the Vindicator</strike></font><br>';}
		if ($tacid == '2166076255') {$velious = $velious + 1; 
		$dov13 = $tkdate.'<font color="808080"><strike>Statue of Rallos Zek</strike></font><br>';}
		if ($tacid == '2544523763') {$velious = $velious + 1; 
		$dov14 = $tkdate.'<font color="808080"><strike>Statue of Rallos Zek (Challenge)</strike></font><br>';}
		if ($tacid == '832312297')  {$velious = $velious + 1; 
		$dov15 = $tkdate.'<font color="808080"><strike>Sullon Zek</strike></font><br>';}
		if ($tacid == '3285130354') {$velious = $velious + 1; 
		$dov16 = $tkdate.'<font color="808080"><strike>Sullon Zek (Challenge)</strike></font><br>';}
		if ($tacid == '3582177156') {$velious = $velious + 1; 
		$dov17 = $tkdate.'<font color="808080"><strike></strike>Tallon Zek</font><br>';}
		if ($tacid == '3493794934') {$velious = $velious + 1; 
		$dov18 = $tkdate.'<font color="808080"><strike></strike>Tallon Zek (Challenge)</font><br>';}
		if ($tacid == '2097487381') {$velious = $velious + 1; 
		$dov19 = $tkdate.'<font color="808080"><strike>Vallon Zek</strike></font><br>';}
		if ($tacid == '3570058315') {$velious = $velious + 1; 
		$dov20 = $tkdate.'<font color="808080"><strike>>Vallon Zek (Challenge)</strike></font><br>';}
		if ($tacid == '4145063722') {$velious = $velious + 1; 
		$dov21 = $tkdate.'<font color="808080"><strike>Vrewwx Icyheart</strike></font><br>';}
		if ($tacid == '528786370')  {$velious = $velious + 1; 
		$dov22 = '<font color="808080"><strike>Vyskudra the Ancient</strike></font><br>';}
		if ($tacid == '1622583242') {$chains = $chains + 1; 
		$coe1 = $tkdate.'<font color="808080"><strike>Amalgamon</strike></font><br>';}
		if ($tacid == '2815791137') {$chains = $chains + 1; 
		$coe2 = $tkdate.'<font color="808080"><strike>Baroddas & Baelon</strike></font><br>';}
		if ($tacid == '117381414')  {$chains = $chains + 1; 
		$coe3 = $tkdate.'<font color="808080"><strike>Drinal 4 Soulwells</strike></font><br>';}
		if ($tacid == '3473349988') {$chains = $chains + 1; 
		$coe4 = $tkdate.'<font color="808080"><strike>Omugra, Thazarus, & Vuzalg</strike></font><br>';}
		if ($tacid == '2968476469') {$arena = $arena + 1; 
		$arena1 = $tkdate.'<font color="808080"><strike>Bristlebane</strike></font><br>';}
		if ($tacid == '1979157433') {$arena = $arena + 1; 
		$arena2 = $tkdate.'<font color="808080"><strike>Drinal</strike></font><br>';}
		if ($tacid == '593827632')  {$arena = $arena + 1; 
		$arena3 = $tkdate.'<font color="808080"><strike>Mithaniel Marr</strike></font><br>';}
		if ($tacid == '476803566')  {$arena = $arena + 1; 
		$arena4 = $tkdate.'<font color="808080"><strike>Prexus</strike></font><br>';}
		if ($tacid == '136089721')  {$arena = $arena + 1; 
		$arena5 = $tkdate.'<font color="808080"><strike>Rodcet Nife</strike></font><br>';}
		if ($tacid == '1266762124') {$arena = $arena + 1; 
		$arena6 = $tkdate.'<font color="808080"><strike>Solusek Ro</strike></font><br>';}
		if ($tacid == '3234597117') {$arena = $arena + 1; 
		$arena7 = $tkdate.'<font color="808080"><strike>Sullon Zek</strike></font><br>';}
		if ($tacid == '3543924985') {$arena = $arena + 1; 
		$arena8 = $tkdate.'<font color="808080"><strike>Tallon Zek</strike></font><br>';}
		if ($tacid == '1253692288') {$arena = $arena + 1; 
		$arena9 = $tkdate.'<font color="808080"><strike>Tunare</strike></font><br>';}
		if ($tacid == '3620327620') {$arena = $arena + 1; 
		$arena10 = $tkdate.'<font color="808080"><strike>Vallon Zek</strike></font><br>';}
		if ($tacid == '2417016352') {$contested = $contested + 1; 
		$cont1 = $tkdate.'<font color="808080"><strike>Drinal</strike></font><br>';}
		if ($tacid == '42226058')   {$contested = $contested + 1; 
		$cont2 = $tkdate.'<font color="808080"><strike>Mithaniel Marr</strike></font><br>';}
		if ($tacid == '4186719351') {$contested = $contested + 1; 
		$cont3 = $tkdate.'<font color="808080"><strike>Prexus</strike></font><br>';}
		if ($tacid == '2623216647') {$contested = $contested + 1; 
		$cont4 = $tkdate.'<font color="808080"><strike>Rodcet Nife</strike></font><br>';}
		if ($tacid == '1748417285') {$contested = $contested + 1; 
		$cont5 = $tkdate.'<font color="808080"><strike>Solusek Ro</strike></font><br>';}
		if ($tacid == '3816551028') {$contested = $contested + 1; 
		$cont6 = $tkdate.'<font color="808080"><strike>Sullon Zek</strike></font><br>';}
		if ($tacid == '4035705456') {$contested = $contested + 1; 
		$cont7 = $tkdate.'<font color="808080"><strike>Tallon Zek</strike></font><br>';}
		if ($tacid == '2942232089') {$contested = $contested + 1; 
		$cont8 = $tkdate.'<font color="808080"><strike>Tunare</strike></font><br>';}
		if ($tacid == '4101909069') {$contested = $contested + 1; 
		$cont9 = $tkdate.'<font color="808080"><strike>Vallon Zek</strike></font><br>';}
		if ($tacid == '2371639852') {$veeshan = $veeshan + 1; 
		$tov1 = '<font color="808080"><strike>Bristlebane</strike></font><br>';}
		if ($tacid == '2828051041') {$veeshan = $veeshan + 1; 
		$tov2 = '<font color="808080"><strike>Draazak the Ancient</strike></font><br>';}
		if ($tacid == '3607119179') {$veeshan = $veeshan + 1; 
		$tov3 = '<font color="808080"><strike>Exarch Lorokai the Unliving</strike></font><br>';}
		if ($tacid == '3194637595') {$veeshan = $veeshan + 1; 
		$tov4 = '<font color="808080"><strike>Fabled Mutagenic Outcast</strike></font><br>';}
		if ($tacid == '554855277')  {$veeshan = $veeshan + 1; 
		$tov5 = '<font color="808080"><strike>Fabled Three Princes</strike></font><br>';}
		if ($tacid == '1344069514') {$veeshan = $veeshan + 1; 
		$tov6 = '<font color="808080"><strike>Fabled Vyemm & Alzid Prime</strike></font><br>';}
		if ($tacid == '1089000969') {$veeshan = $veeshan + 1; 
		$tov7 = '<font color="808080"><strike>Roehn Theer - Ages End</strike></font><br>';}
		if ($tacid == '1400749304') {$veeshan = $veeshan + 1; 
		$tov8 = '<font color="808080"><strike>Roehn Theer - Ages End (HM)</strike></font><br>';}
		if ($tacid == '3296875551') {$veeshan = $veeshan + 1; 
		$tov9 = '<font color="808080"><strike>The Crumbling Emperor</strike></font><br>';}
		if ($tacid == '1302823374') {$veeshan = $veeshan + 1; 
		$tov10 = '<font color="808080"><strike>Vulak\'Aerr the Dreadscale</strike></font><br>';}
		if ($tacid == '616943266')  {$veeshan = $veeshan + 1; 
		$tov11 = '<font color="808080"><strike>Zlandicar</strike></font><br>';}
		if ($tacid == '3928176072') {$altar = $altar + 1; 
		$aom1 = '<font color="808080"><strike>Arch Lich Rhag\'Zadune</strike></font><br>';}
		if ($tacid == '3296712239') {$altar = $altar + 1; 
		$aom2 = '<font color="808080"><strike>Baz the Illusionist</strike></font><br>';}
		if ($tacid == '1748957509') {$altar = $altar + 1; 
		$aom3 = '<font color="808080"><strike>Captain Krasnok</strike></font><br>';}
		if ($tacid == '116845928')  {$altar = $altar + 1; 
		$aom4 = '<font color="808080"><strike>Construct of Malice</strike></font><br>';}
		if ($tacid == '1849147944') {$altar = $altar + 1; 
		$aom5 = '<font color="808080"><strike>Grethah the Frenzied</strike></font><br>';}
		if ($tacid == '1475875915') {$altar = $altar + 1; 
		$aom6 = '<font color="808080"><strike>Kildiun the Drunkard</strike></font><br>';}
		if ($tacid == '19578004')   {$altar = $altar + 1; 
		$aom7 = '<font color="808080"><strike>Malkonis D\'Morte</strike></font><br>';}
		if ($tacid == '99686993')   {$altar = $altar + 1; 
		$aom8 = '<font color="808080"><strike>Malkonis D\'Morte (Challenge)</strike></font><br>';}
		if ($tacid == '2955610207') {$altar = $altar + 1; 
		$aom9 = '<font color="808080"><strike>Perador the Mighty</strike></font><br>';}
		if ($tacid == '1434280382' or $tacid == '2017956309'){$altar = $altar + 1; 
		$aom10 = '<font color="808080"><strike>Primordial Ritualist Villandre V\'Zher</strike></font><br>';}
		if ($tacid == '3742464779') {$altar = $altar + 1; 
		$aom11 = '<font color="808080"><strike>The Crumbling Icon</strike></font><br>';}
		if ($tacid == '3785130348') {$precipice = $precipice + 1; 
		$pop1 = '<font color="808080"><strike>Brell Serilis</strike></font><br>';}
		if ($tacid == '3312622728') {$precipice = $precipice + 1; 
		$pop2 = '<font color="808080"><strike>Cazic-Thule</strike></font><br>';}
		if ($tacid == '1264497483') {$precipice = $precipice + 1; 
		$pop3 = '<font color="808080"><strike>Fennin Ro</strike></font><br>';}
		if ($tacid == '2302657105') {$precipice = $precipice + 1; 
		$pop4 = '<font color="808080"><strike>Karana</strike></font><br>';}
		if ($tacid == '3211824092') {$precipice = $precipice + 1; 
		$pop5 = '<font color="808080"><strike>The Tribunal</strike></font><br>';}
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
		$ruins = ($tkillslist[41].$tkillslist[42].$tkillslist[43].$tkillslist[44].$tkillslist[45].$tkillslist[46].$tkillslist[47].
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
		$zonename15 = $aomval; 	      $zonemax15 = $aommax;	       $zonetip15 = $alt;
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
