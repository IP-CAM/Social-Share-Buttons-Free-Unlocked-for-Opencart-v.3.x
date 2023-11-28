<?php
class ControllerExtensionModuleSoshare extends Controller {
    private $version = '1.0';
    private $error = array();
    private $token_var;
    private $extension_var;
    private $prefix;
    public function __construct($registry) {
        parent::__construct($registry);
        $this->token_var = (version_compare(VERSION, '3.0', '>=')) ? 'user_token' : 'token';
        $this->extension_var = (version_compare(VERSION, '3.0', '>=')) ? 'marketplace' : 'extension';
        $this->prefix = (version_compare(VERSION, '3.0', '>=')) ? 'module_' : '';
    }
    public function install() {}
    public function uninstall() {}
    public function index() {
        $data = $this->load->language('extension/module/soshare');
        $heading_title = preg_replace('/^.*?\|\s?/ius', '', $this->language->get('heading_title'));
        $data['heading_title'] = $heading_title;
        $heading_text = preg_replace('/^.*?\|\s?/ius', '', $this->language->get('heading_text'));
        $data['heading_text'] = $heading_text;
        $this->document->setTitle($heading_text);
        $this->load->model('setting/setting');
        $this->document->addStyle('view/stylesheet/bootstrap-toggle.min.css');
        $this->document->addStyle('view/stylesheet/coloris.min.css');
        $this->document->addStyle('view/stylesheet/fontawesome.all.css');
        $this->document->addStyle('view/stylesheet/soshare.css');
        $this->document->addScript('view/javascript/bootstrap-toggle.min.js');
        $this->document->addScript('view/javascript/coloris.min.js');
        $this->document->addScript('view/javascript/share-buttons.js');
        $this->document->addScript('https://code.jquery.com/jquery-3.6.0.js');
        $this->document->addScript('https://code.jquery.com/ui/1.13.1/jquery-ui.js');
        $this->document->addScript('view/javascript/soshare.js');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting($this->prefix . 'soshare', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            if (isset($this->request->post['apply'])) {
                $this->response->redirect($this->url->link('extension/module/soshare', $this->token_var . '=' . $this->session->data[$this->token_var], true));
            } else {
                $this->response->redirect($this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true));
            }
        }
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', $this->token_var . '=' . $this->session->data[$this->token_var], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $heading_text,
            'href' => $this->url->link('extension/module/soshare', $this->token_var . '=' . $this->session->data[$this->token_var], true)
        );
        $this->load->model('extension/module/soshare');
        $data['prefix'] = $this->prefix;
        $data['token_var'] = $this->token_var;
        $data[$this->token_var] = $this->session->data[$this->token_var];
        $data['action'] = $this->url->link('extension/module/soshare', $this->token_var . '=' . $this->session->data[$this->token_var], true);
        $data['cancel'] = $this->url->link($this->extension_var . '/extension', $this->token_var . '=' . $this->session->data[$this->token_var] . '&type=module', true);
        $data['text_info'] = sprintf($this->language->get('text_info'), $this->version);
        if (isset($this->request->post[$this->prefix . 'soshare_status'])) {$data[$this->prefix . 'soshare_status'] = $this->request->post[$this->prefix . 'soshare_status'];} else {$data[$this->prefix . 'soshare_status'] = $this->config->get($this->prefix . 'soshare_status');}
        if (isset($this->request->post[$this->prefix . 'soshare_name'])) {$data[$this->prefix . 'soshare_name'] = $this->request->post[$this->prefix . 'soshare_name'];} else {$data[$this->prefix . 'soshare_name'] = $this->config->get($this->prefix . 'soshare_name');}
        if (isset($this->request->post[$this->prefix . 'soshare_store_name'])) {$data[$this->prefix . 'soshare_store_name'] = $this->request->post[$this->prefix . 'soshare_store_name'];} else {$data[$this->prefix . 'soshare_store_name'] = $this->config->get($this->prefix . 'soshare_store_name');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_status'])) {$data[$this->prefix . 'soshare_facebook_status'] = $this->request->post[$this->prefix . 'soshare_facebook_status'];} else {$data[$this->prefix . 'soshare_facebook_status'] = $this->config->get($this->prefix . 'soshare_facebook_status');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_text_color'])) {$data[$this->prefix . 'soshare_facebook_text_color'] = $this->request->post[$this->prefix . 'soshare_facebook_text_color'];} else {$data[$this->prefix . 'soshare_facebook_text_color'] = $this->config->get($this->prefix . 'soshare_facebook_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_hover_text_color'])) {$data[$this->prefix . 'soshare_facebook_hover_text_color'] = $this->request->post[$this->prefix . 'soshare_facebook_hover_text_color'];} else {$data[$this->prefix . 'soshare_facebook_hover_text_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_bgcolor'])) {$data[$this->prefix . 'soshare_facebook_bgcolor'] = $this->request->post[$this->prefix . 'soshare_facebook_bgcolor'];} else {$data[$this->prefix . 'soshare_facebook_bgcolor'] = $this->config->get($this->prefix . 'soshare_facebook_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_hover_bgcolor'])) {$data[$this->prefix . 'soshare_facebook_hover_bgcolor'] = $this->request->post[$this->prefix . 'soshare_facebook_hover_bgcolor'];} else {$data[$this->prefix . 'soshare_facebook_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_facebook_hover_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_border_color'])) {$data[$this->prefix . 'soshare_facebook_border_color'] = $this->request->post[$this->prefix . 'soshare_facebook_border_color'];} else {$data[$this->prefix . 'soshare_facebook_border_color'] = $this->config->get($this->prefix . 'soshare_facebook_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_hover_border_color'])) {$data[$this->prefix . 'soshare_facebook_hover_border_color'] = $this->request->post[$this->prefix . 'soshare_facebook_hover_border_color'];} else {$data[$this->prefix . 'soshare_facebook_hover_border_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_icon_color'])) {$data[$this->prefix . 'soshare_facebook_icon_color'] = $this->request->post[$this->prefix . 'soshare_facebook_icon_color'];} else {$data[$this->prefix . 'soshare_facebook_icon_color'] = $this->config->get($this->prefix . 'soshare_facebook_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_hover_icon_color'])) {$data[$this->prefix . 'soshare_facebook_hover_icon_color'] = $this->request->post[$this->prefix . 'soshare_facebook_hover_icon_color'];} else {$data[$this->prefix . 'soshare_facebook_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_facebook_hover_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_facebook_view'])) {$data[$this->prefix . 'soshare_facebook_view'] = $this->request->post[$this->prefix . 'soshare_facebook_view'];} else {$data[$this->prefix . 'soshare_facebook_view'] = $this->config->get($this->prefix . 'soshare_facebook_view');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_status'])) {$data[$this->prefix . 'soshare_linkedin_status'] = $this->request->post[$this->prefix . 'soshare_linkedin_status'];} else {$data[$this->prefix . 'soshare_linkedin_status'] = $this->config->get($this->prefix . 'soshare_linkedin_status');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_text_color'])) {$data[$this->prefix . 'soshare_linkedin_text_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_text_color'];} else {$data[$this->prefix . 'soshare_linkedin_text_color'] = $this->config->get($this->prefix . 'soshare_linkedin_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_hover_text_color'])) {$data[$this->prefix . 'soshare_linkedin_hover_text_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_hover_text_color'];} else {$data[$this->prefix . 'soshare_linkedin_hover_text_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_bgcolor'])) {$data[$this->prefix . 'soshare_linkedin_bgcolor'] = $this->request->post[$this->prefix . 'soshare_linkedin_bgcolor'];} else {$data[$this->prefix . 'soshare_linkedin_bgcolor'] = $this->config->get($this->prefix . 'soshare_linkedin_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_hover_bgcolor'])) {$data[$this->prefix . 'soshare_linkedin_hover_bgcolor'] = $this->request->post[$this->prefix . 'soshare_linkedin_hover_bgcolor'];} else {$data[$this->prefix . 'soshare_linkedin_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_border_color'])) {$data[$this->prefix . 'soshare_linkedin_border_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_border_color'];} else {$data[$this->prefix . 'soshare_linkedin_border_color'] = $this->config->get($this->prefix . 'soshare_linkedin_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_hover_border_color'])) {$data[$this->prefix . 'soshare_linkedin_hover_border_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_hover_border_color'];} else {$data[$this->prefix . 'soshare_linkedin_hover_border_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_icon_color'])) {$data[$this->prefix . 'soshare_linkedin_icon_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_icon_color'];} else {$data[$this->prefix . 'soshare_linkedin_icon_color'] = $this->config->get($this->prefix . 'soshare_linkedin_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_hover_icon_color'])) {$data[$this->prefix . 'soshare_linkedin_hover_icon_color'] = $this->request->post[$this->prefix . 'soshare_linkedin_hover_icon_color'];} else {$data[$this->prefix . 'soshare_linkedin_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_linkedin_hover_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_linkedin_view'])) {$data[$this->prefix . 'soshare_linkedin_view'] = $this->request->post[$this->prefix . 'soshare_linkedin_view'];} else {$data[$this->prefix . 'soshare_linkedin_view'] = $this->config->get($this->prefix . 'soshare_linkedin_view');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_status'])) {$data[$this->prefix . 'soshare_odnoklassniki_status'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_status'];} else {$data[$this->prefix . 'soshare_odnoklassniki_status'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_status');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_text_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_text_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_text_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_text_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_text_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_hover_text_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_text_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_hover_text_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_bgcolor'])) {$data[$this->prefix . 'soshare_odnoklassniki_bgcolor'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_bgcolor'];} else {$data[$this->prefix . 'soshare_odnoklassniki_bgcolor'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_bgcolor'])) {$data[$this->prefix . 'soshare_odnoklassniki_hover_bgcolor'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_bgcolor'];} else {$data[$this->prefix . 'soshare_odnoklassniki_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_border_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_border_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_border_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_border_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_border_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_hover_border_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_border_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_hover_border_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_icon_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_icon_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_icon_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_icon_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_icon_color'])) {$data[$this->prefix . 'soshare_odnoklassniki_hover_icon_color'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_hover_icon_color'];} else {$data[$this->prefix . 'soshare_odnoklassniki_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_hover_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_odnoklassniki_view'])) {$data[$this->prefix . 'soshare_odnoklassniki_view'] = $this->request->post[$this->prefix . 'soshare_odnoklassniki_view'];} else {$data[$this->prefix . 'soshare_odnoklassniki_view'] = $this->config->get($this->prefix . 'soshare_odnoklassniki_view');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_status'])) {$data[$this->prefix . 'soshare_pinterest_status'] = $this->request->post[$this->prefix . 'soshare_pinterest_status'];} else {$data[$this->prefix . 'soshare_pinterest_status'] = $this->config->get($this->prefix . 'soshare_pinterest_status');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_text_color'])) {$data[$this->prefix . 'soshare_pinterest_text_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_text_color'];} else {$data[$this->prefix . 'soshare_pinterest_text_color'] = $this->config->get($this->prefix . 'soshare_pinterest_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_hover_text_color'])) {$data[$this->prefix . 'soshare_pinterest_hover_text_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_hover_text_color'];} else {$data[$this->prefix . 'soshare_pinterest_hover_text_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_text_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_bgcolor'])) {$data[$this->prefix . 'soshare_pinterest_bgcolor'] = $this->request->post[$this->prefix . 'soshare_pinterest_bgcolor'];} else {$data[$this->prefix . 'soshare_pinterest_bgcolor'] = $this->config->get($this->prefix . 'soshare_pinterest_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_hover_bgcolor'])) {$data[$this->prefix . 'soshare_pinterest_hover_bgcolor'] = $this->request->post[$this->prefix . 'soshare_pinterest_hover_bgcolor'];} else {$data[$this->prefix . 'soshare_pinterest_hover_bgcolor'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_bgcolor');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_border_color'])) {$data[$this->prefix . 'soshare_pinterest_border_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_border_color'];} else {$data[$this->prefix . 'soshare_pinterest_border_color'] = $this->config->get($this->prefix . 'soshare_pinterest_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_hover_border_color'])) {$data[$this->prefix . 'soshare_pinterest_hover_border_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_hover_border_color'];} else {$data[$this->prefix . 'soshare_pinterest_hover_border_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_border_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_icon_color'])) {$data[$this->prefix . 'soshare_pinterest_icon_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_icon_color'];} else {$data[$this->prefix . 'soshare_pinterest_icon_color'] = $this->config->get($this->prefix . 'soshare_pinterest_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_hover_icon_color'])) {$data[$this->prefix . 'soshare_pinterest_hover_icon_color'] = $this->request->post[$this->prefix . 'soshare_pinterest_hover_icon_color'];} else {$data[$this->prefix . 'soshare_pinterest_hover_icon_color'] = $this->config->get($this->prefix . 'soshare_pinterest_hover_icon_color');}
        if (isset($this->request->post[$this->prefix . 'soshare_pinterest_view'])) {$data[$this->prefix . 'soshare_pinterest_view'] = $this->request->post[$this->prefix . 'soshare_pinterest_view'];} else {$data[$this->prefix . 'soshare_pinterest_view'] = $this->config->get($this->prefix . 'soshare_pinterest_view');}
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
        $data['header'] = $this->load->controller('common/header');$data['column_left'] = $this->load->controller('common/column_left');$data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/soshare', $data));}
        protected function validate() {if (!$this->user->hasPermission('modify', 'extension/module/soshare')) {$this->error['warning'] = $this->language->get('error_permission');}
        if ($this->error && !isset($this->error['warning'])) {$this->error['warning'] = $this->language->get('error_warning');}return !$this->error;}
}