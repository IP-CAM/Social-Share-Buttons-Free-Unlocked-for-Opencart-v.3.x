<?php
class ControllerExtensionModuleSoshare extends Controller
{
    private $error = array();
    private $prefix;
    public function __construct($registry)
    {parent::__construct($registry);$this->prefix = (version_compare(VERSION, '3.0', '>=')) ? 'module_' : '';}

    public function index()
    {
        if ($this->config->get($this->prefix . 'soshare_status')) {
        $data = $this->load->language('extension/module/soshare');
        $this->load->model('extension/module/soshare');
        $this->document->addStyle('/catalog/view/stylesheet/fontawesome.all.css');
        $data['facebook_status'] = $this->config->get($this->prefix . 'soshare_facebook_status');$data['facebook_text_color'] = $this->config->get($this->prefix . 'soshare_facebook_text_color');
        $data['facebook_hover_text_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_text_color');$data['facebook_bgcolor'] = $this->config->get($this->prefix . 'soshare_facebook_bgcolor');
        $data['facebook_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_facebook_hover_bgcolor');$data['facebook_border_color'] = $this->config->get($this->prefix . 'soshare_facebook_border_color');
        $data['facebook_hover_border_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_border_color');$data['facebook_icon_color'] = $this->config->get($this->prefix . 'soshare_facebook_icon_color');
        $data['facebook_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_icon_color');$data['facebook_view'] = $this->config->get($this->prefix . 'soshare_facebook_view');
        $data['linkedin_status'] = $this->config->get($this->prefix . 'soshare_linkedin_status');$data['linkedin_text_color'] = $this->config->get($this->prefix . 'soshare_linkedin_text_color');
        $data['linkedin_hover_text_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_text_color');$data['linkedin_bgcolor'] = $this->config->get($this->prefix . 'soshare_linkedin_bgcolor');
        $data['linkedin_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_bgcolor');$data['linkedin_border_color'] = $this->config->get($this->prefix . 'soshare_linkedin_border_color');
        $data['linkedin_hover_border_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_border_color');$data['linkedin_icon_color'] = $this->config->get($this->prefix . 'soshare_linkedin_icon_color');
        $data['linkedin_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_icon_color');$data['linkedin_view'] = $this->config->get($this->prefix . 'soshare_linkedin_view');
        $data['odnoklassniki_status'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_status');$data['odnoklassniki_text_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_text_color');
        $data['odnoklassniki_hover_text_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_text_color');$data['odnoklassniki_bgcolor'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_bgcolor');
        $data['odnoklassniki_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_bgcolor');$data['odnoklassniki_border_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_border_color');
        $data['odnoklassniki_hover_border_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_border_color');$data['odnoklassniki_icon_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_icon_color');
        $data['odnoklassniki_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_icon_color');$data['odnoklassniki_view'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_view');
        $data['pinterest_status'] = $this->config->get($this->prefix . 'soshare_pinterest_status');$data['pinterest_text_color'] = $this->config->get($this->prefix . 'soshare_pinterest_text_color');
        $data['pinterest_hover_text_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_text_color');$data['pinterest_bgcolor'] = $this->config->get($this->prefix . 'soshare_pinterest_bgcolor');
        $data['pinterest_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_bgcolor');$data['pinterest_border_color'] = $this->config->get($this->prefix . 'soshare_pinterest_border_color');
        $data['pinterest_hover_border_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_border_color');$data['pinterest_icon_color'] = $this->config->get($this->prefix . 'soshare_pinterest_icon_color');
        $data['pinterest_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_icon_color');$data['pinterest_view'] = $this->config->get($this->prefix . 'soshare_pinterest_view');
        $data['pocket_status'] = $this->config->get($this->prefix . 'soshare_pocket_status');$data['pocket_text_color'] = $this->config->get($this->prefix . 'soshare_pocket_text_color');
        $data['pocket_hover_text_color'] = $this->config->get($this->prefix . 'soshare_pocket_hover_text_color');$data['pocket_bgcolor'] = $this->config->get($this->prefix . 'soshare_pocket_bgcolor');
        $data['pocket_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_pocket_hover_bgcolor');$data['pocket_border_color'] = $this->config->get($this->prefix . 'soshare_pocket_border_color');
        $data['pocket_hover_border_color'] = $this->config->get($this->prefix . 'soshare_pocket_hover_border_color');$data['pocket_icon_color'] = $this->config->get($this->prefix . 'soshare_pocket_icon_color');
        $data['pocket_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_pocket_hover_icon_color');$data['pocket_view'] = $this->config->get($this->prefix . 'soshare_pocket_view');
        $data['whatsapp_status'] = $this->config->get($this->prefix . 'soshare_whatsapp_status');$data['whatsapp_text_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_text_color');
        $data['whatsapp_hover_text_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_hover_text_color');$data['whatsapp_bgcolor'] = $this->config->get($this->prefix . 'soshare_whatsapp_bgcolor');
        $data['whatsapp_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_whatsapp_hover_bgcolor');$data['whatsapp_border_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_border_color');
        $data['whatsapp_hover_border_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_hover_border_color');$data['whatsapp_icon_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_icon_color');
        $data['whatsapp_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_whatsapp_hover_icon_color');$data['whatsapp_view'] = $this->config->get($this->prefix . 'soshare_whatsapp_view');

        $data['tooltip_status'] = $this->config->get($this->prefix . 'soshare_tooltip_status');

        if (isset($data['title'])) {
            $data['heading_title'] = $data['title'];
            
        }

        return $this->load->view('extension/module/soshare', $data);}}
}