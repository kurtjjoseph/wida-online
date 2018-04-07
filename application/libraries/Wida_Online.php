<?php


class Wida_Online
{
	var $ci;
	var $wom;
	var $config = array();

	public function __construct()
	{
		$ci = &get_instance();
		$ci->load->model('wida_online_model');
		$this->loadConfig();
	}

	public function lastSong()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_entry();

	}

	public function latestSongs()
	{
		$wom = new Wida_online_model();
		return $wom->get_last_ten_entries();

	}

	public function getSong($id)
	{
		$wom = new Wida_online_model();
		return $wom->getSong($id);

	}

	public function getNewSong()
	{
		$wom = new Wida_online_model();
		return $wom->getNewSong();

	}


	public function getChord($spelling)
	{
		$wom = new Wida_online_model();
		return $wom->getChord($spelling);

	}

	public function getChords()
	{
		$wom = new Wida_online_model();
		return $wom->getChords();

	}

	public function getSongs()
	{
		$wom = new Wida_online_model();
		return $wom->getSongs();

	}

	public function saveSong($id, $songdata)
	{
		$wom = new Wida_online_model();

		return $wom->saveSong($id,$songdata);

	}


	public function loadConfig(){

		$templateName = "material";

		$this->config["js_files"] = array();
		$this->config["css_files"] = array();
		$this->config["pagetitle"] ="Wida Online";
		$this->config["scriptdir"] ="/wida-online/assets/$templateName/";
		$this->config["templatescripts"] ="templates/$templateName/templatescripts";
		$this->config["pagescripts"] ="templates/$templateName/pagescripts";
		$this->config["logo"] ="templates/$templateName/logo";
		$this->config["navbar"]["top"] ="templates/$templateName/navbar";
		$this->config["navbar"]["main"] ="templates/$templateName/navbar_main";
		$this->config["breadcrumb"] ="templates/$templateName/breadcrumb";
		$this->config["content"] ="templates/$templateName/content";
		$this->config["body"] ="templates/$templateName/body";
		$this->config["html_header"] ="templates/$templateName/html_header";
		$this->config["html_footer"] ="templates/$templateName/html_footer";
		$this->config["bootstrap"] ="templates/$templateName/bootstrap";


		$pages =  array();
		$pages['Overzicht'] = 'Home';

		$this->config["pages"] = $pages;



	}

}