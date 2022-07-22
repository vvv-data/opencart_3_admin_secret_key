<?php
/*
@author vvv-data
@link   https://vvvdata.ru
*/

class ControllerExtensionModuleAdminSecretKey extends Controller {
 
	public function index() {
   
	  
	  $this->load->model('extension/module/admin_secret_key');

	  $data = array();
	  $data = $this->load->language('extension/module/admin_secret_key');
	  $data['text_success_view'] = '';

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

			$this->model_extension_module_admin_secret_key->SaveSettings();

			$data['text_success_view'] = $data['text_success'];
		}
   
	  // Загружаем настройки через метод "модели"
	  $data += $this->model_extension_module_admin_secret_key->LoadSettings();	  
	  
	  $data += $this->GetBreadCrumbs();
   
	  
	  $data['action'] = $this->url->link('extension/module/admin_secret_key', 'user_token=' . $this->session->data['user_token'], true);
	  $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
	  
	  $data['header'] = $this->load->controller('common/header');
	  $data['column_left'] = $this->load->controller('common/column_left');
	  $data['footer'] = $this->load->controller('common/footer');

	  if(HTTPS_SERVER)
	     $data['secret_url'] = HTTPS_SERVER;  
      elseif(HTTP_SERVER)
	   $data['secret_url'] = HTTP_SERVER;
	  else $data['secret_url'] = ''; 
	  
	  if(isset($data['module_admin_secret_key_status']) && $data['module_admin_secret_key_status'] > 0  && $data['module_admin_secret_key_key']){
		$data['secret_key_enabled'] = 1; 
		$data['text_secret_url'] = $data['text_url_enabled'];
		if($data['secret_url'])
		  $data['secret_url'] = $data['secret_url']."?secret=".$data['module_admin_secret_key_key'];
		else $data['secret_url'] = $data['text_error'];
	  }
	  else {
		$data['secret_key_enabled'] = 0; 
		$data['text_secret_url'] = $data['text_url_disabled'];
		if(!$data['secret_url']) $data['secret_url'] = $data['text_error'];
	  }

	  
	  if(HTTPS_CATALOG)
	     $data['redirect_page'] = HTTPS_CATALOG;  
      elseif(HTTP_CATALOG)
	   $data['redirect_page'] = HTTP_CATALOG;
	  else $data['redirect_page'] = '';

	  $data['redirect_page'] .= 'index.php?route=error/not_found'; 

	  $data['redirect_url_example'] = $data['redirect_page'];

	  if(isset($data['module_admin_secret_key_page']) && $data['module_admin_secret_key_page'])
		$data['redirect_page'] = $data['module_admin_secret_key_page']; 

	  $this->response->setOutput($this->load->view('extension/module/admin_secret_key', $data));
   
	}
   
	// Хлебные крошки
	private function GetBreadCrumbs() {
	  $data = array(); $data['breadcrumbs'] = array();
	  $data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_home'),
		'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
	  );
	  $data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_extension'),
		'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
	  );
	  $data['breadcrumbs'][] = array(
		'text' => $this->language->get('heading_title'),
		'href' => $this->url->link('extension/module/admin_secret_key', 'user_token=' . $this->session->data['user_token'], true)
	  );
	  return $data;
	}

	public function uninstall() {
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('module_admin_secret_key');
	  }
   
  }