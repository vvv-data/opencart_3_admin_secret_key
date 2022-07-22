<?php
/*
@author vvv-data
@link   https://vvvdata.ru
*/

class ModelExtensionModuleAdminSecretKey extends Model {
 

	// Запись настроек в базу данных
	public function SaveSettings() {
	  $this->load->model('setting/setting');
	  if(isset($this->request->post['module_admin_secret_key_key'])) 
	     $this->request->post['module_admin_secret_key_key'] = preg_replace ("/[^a-zA-Z0-9]/","",$this->request->post['module_admin_secret_key_key']);
	  if(isset($this->request->post['module_admin_secret_key_page'])) 
	    $this->request->post['module_admin_secret_key_page'] = trim($this->request->post['module_admin_secret_key_page']);
	  $this->model_setting_setting->editSetting('module_admin_secret_key', $this->request->post);
	}
   
	
	// Загрузка настроек из базы данных
	public function LoadSettings() {
	  $this->load->model('setting/setting');
	  return $this->model_setting_setting->getSetting('module_admin_secret_key');
	}

	// Загрузка настроек из базы данных
	public function GetSecret() {
		$data = array();
		$data = $this->LoadSettings();
		if(isset($data['module_admin_secret_key_status']) && $data['module_admin_secret_key_status'] > 0 && $data['module_admin_secret_key_key']) 
		return $data;
		else 
		return null;
	  }
   
  }