<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Songs extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_CRUD');

		$this->load->library('wida_online');

		// load Breadcrumbs
		$this->load->library('breadcrumbs');

		$this->load->helper('url');
	}

	public function index()
	{
		$wida = new Wida_online();

		$viewScope = array();

		$contentdata = $this->render_content($viewScope);

		$viewScope['js_files'] = $contentdata['js_files'];
		$viewScope['css_files'] = $contentdata['css_files'];
		$viewScope['content'] = $this->load->view($wida->config['content'], (array)$contentdata, true);


		$viewScope['breadcrumbdata'] = $this->render_breadcrumb($viewScope);
		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'] , $viewScope, true);


		$viewScope['js_files'] = $wida->config['js_files'] ;
		$viewScope['css_files'] = $wida->config['css_files'] ;
		$viewScope['pagetitle'] = $wida->config['pagetitle']  ;
		$viewScope['scriptdir'] = $wida->config['scriptdir'] ;

		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'] , $viewScope, true);
		$viewScope['navbar'] = $this->load->view($wida->config['navbar'] , $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'] , $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'] , $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'] , $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);
	}

	public function render_content($viewScope)
	{
		$output = array();

		$output["js_files"] = array();
		$output["css_files"] = array();
		$output["output"] = $this->songlist();


		return $output;
	}

	public function render_breadcrumb($viewScope)
	{
		$output = array();
		$output["output"] = "";

		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');


		// output
		$output["output"] = $this->breadcrumbs->show();
		return $output;
	}

	public function songs_management($viewScope)
	{
		$crud = new grocery_CRUD();
		$crud->set_table('wida_allsongs');
		$crud->set_subject('Songs');
		$output = $crud->render();
		return $output;
	}

	public function song($index)
	{
		$viewScope = array();
		$wida = new Wida_online();
		$data = array();
		$data["selectedsong"] = $wida->getSong($index);
		$viewScope['content'] = $this->load->view('selectedSong', $data, true);


		$this->breadcrumbs = new Breadcrumbs();

		// add breadcrumbs
		$this->breadcrumbs->push('Liederen', '/songs');
		$this->breadcrumbs->push('Song', '/song');
		$this->breadcrumbs->push($data['selectedsong']->Title, '/song');
		// output
		$viewScope["breadcrumbdata"]["output"] = $this->breadcrumbs->show();

		$this->render($viewScope);
	}



	public function render($viewScope)
	{
		$wida = new Wida_online();
		//$viewScope['content'] = $this->load->view($wida->config['content'], (array)$contentdata, true);

		$viewScope['breadcrumb'] = $this->load->view($wida->config['breadcrumb'] , $viewScope, true);
		$viewScope['js_files'] = $wida->config['js_files'] ;
		$viewScope['css_files'] = $wida->config['css_files'] ;
		$viewScope['pagetitle'] = $wida->config['pagetitle']  ;
		$viewScope['scriptdir'] = $wida->config['scriptdir'] ;
		$viewScope['templatescripts'] = $this->load->view($wida->config['templatescripts'], $viewScope, true);
		$viewScope['pagescripts'] = $this->load->view($wida->config['pagescripts'] , $viewScope, true);
		$viewScope['navbar'] = $this->load->view($wida->config['navbar'] , $viewScope, true);
		$viewScope['body'] = $this->load->view($wida->config['body'] , $viewScope, true);
		$viewScope['html_header'] = $this->load->view($wida->config['html_header'] , $viewScope, true);
		$viewScope['html_footer'] = $this->load->view($wida->config['html_footer'] , $viewScope, true);

		$this->load->view($wida->config['bootstrap'], $viewScope);
	}

	public function songlist()
	{
		$wida = new Wida_online();
		$data = array();
		$data["songs"] = $wida->getSongs();
		return $this->load->view('songlist', $data,true);
	}
}