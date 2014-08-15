<?php
App::uses('AppController', 'Controller');
/**
 * Files Controller
 *
 * @property File $File
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FilesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->File->recursive = 0;
		$this->set('files', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @throws NotFoundException
 */
	public function view($id = null) {
		if (!$this->File->exists($id)) {
			throw new NotFoundException(__('Invalid files copy'));
		}
		$options = array('conditions' => array('File.' . $this->File->primaryKey => $id));
		$this->set('file', $this->File->find('first', $options));
	}

/**
 * second view method
 *
 * @param string $id
 * @throws NotFoundException
 */
	public function view2($id = null) {
		if (!$this->File->exists($id)) {
			throw new NotFoundException(__('Invalid files copy'));
		}
		$options = array('conditions' => array('File.' . $this->File->primaryKey => $id));
		$this->set('file', $this->File->find('first', $options));
	}

/**
 * search method
 *
 * @param string $search
 */
	function search($search = ""){
		$this->Paginator->settings = array(
			'fields' => array(
				'File.id', 
				'File.title', 
				'File.subject', 
				'File.grade', 
				'File.editor', 
				'File.description', 
			),
		);
		$options = array(
			'OR' => array(
				'File.title LIKE' => '%'.$search.'%',
				'File.subject LIKE' => '%'.$search.'%',
				'File.grade LIKE' => '%'.$search.'%',
				'File.editor LIKE' => '%'.$search.'%',
				'File.description LIKE' => '%'.$search.'%',
				'File.filename LIKE' => '%'.$search.'%',
			),
		);
		$this->set('files', $this->Paginator->paginate('File', $options));
		$this->render('index');
}

/**
 * download method
 *
 * @param string $id
 * @return void
 */
	public function download($id = 1){
		$options = array('conditions' => array('File.id' => $id), 'fields' => array('File.filename'));
		$file = $this->File->find('first', $options);
		$this->response->body(file_get_contents('files/'.$file['File']['filename']));
		// $this->response->type('pdf');
		$this->response->download($file['File']['filename']);
		return $this->response;
	}

/**
 * download_each method
 *
 */
	public function download_each($ids = ""){
		$ids = explode(",", $ids);
		foreach ($ids as $id) {
			return $this->download($id);
		}
	}

/**
 * download_zip method
 *
 */
	public function download_zip($ids = ""){
		$ids = explode(",", $ids);
		foreach ($ids as $id) {
			$options = array('conditions' => array('File.id' => $id), 'fields' => array('File.filename'));
			$file = $this->File->find('list', $options);
			$files[] = $file[$id];
		}
		$folder = 'files/';
		$destination = tempnam('tmp/', "zip");
		ini_set('memory_limit', '-1');

		$validFiles = array();
		if (is_array($files)) {
			foreach ($files as $file) {
				if (file_exists($folder.$file)) {
					$validFiles[] = $folder.$file;
				}
			}
		}

		if (count($validFiles) < 1) {
			unlink($destination);
		  return false;
		}

		$zip = new ZipArchive();
		if ($zip->open($destination, ZipArchive::OVERWRITE) !== true) {
			unlink($destination);
			return false;
		}

		$dest = 'hackdomia_download';
		foreach ($validFiles as $file) {
		  $zip->addFile($file, $dest.DS.basename($file));
		}
		$zip->close();

		if (file_exists($destination) && filesize($destination) > 0) {
			// header('Content-Description: File Transfer');
			// header("Content-Type: application/octet-stream");
			// header("Content-Disposition: attachment; filename=\"hackdomia_download_".time().".zip\"");
			// header("Content-Transfer-Encoding: binary");
			// header("Content-Length: ".filesize($destination));
			// header("Expires: 0");
			// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			// header("Pragma: public");
			// readfile($destination);
			// exit();
			$this->response->body(file_get_contents($destination));
			$this->response->type('zip');
			$this->response->download("hackdomia_download_".time().".zip");
			unlink($destination);
			return $this->response;
		} else {
			unlink($destination);
			return false;
		}
	}

/**
 * private clean
 *
 * @return void
 */
	private function clean($subject) { 
		$pattern = array('/[^a-zA-Z0-9\._-]+/', '/^[-_]*|[_-]*$/');
		$replacement ='';
		$search = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
		$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
		return preg_replace($pattern, $replacement, str_replace($search, $replace, $subject));
	}

/**
 * private rename
 *
 * @return void
 */
	private function rename($old, $new) {
		$this->new = $this->clean($new);
		if(rename(FILES_DIR.$old, FILES_DIR.$this->new)) {
			return $this->new;
		} else {
			return $new;
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->File->recursive = 0;
		$this->set('files', $this->Paginator->paginate());
	}

/**
 * admin_orphans method
 */
	public function admin_orphans() {
		if ($this->request->is('post')) {
			$i = 0;
			$success = 0;
			$failed = 0;
			foreach ($this->request->data('File') as $file) {
				if (!$file['ignore']) {
					unset($file['ignore']);
					if ($file['filename'] != $file['old_filename']){
						$file['filename'] = $this->rename($file['old_filename'], $file['filename']);
					}
					unset($file['old_filename']);
					$this->File->create();
					if ($this->File->save($file)) {
						$success++;
					} 
					else {
						$failed++;
						$errors[$i] = $this->File->validationErrors;
					}
				}
				$i++;
			}
			if ($success) {
				$this->Session->setFlash(__('%s fichiers ajoutés correctement.', $success), 
					'alert', array("type"=>"success"), 'success'
				);
			} if ($failed) {
				$this->Session->setFlash(__('Une erreur est survenu lors de l\'ajout de %s fichiers.', $failed), 
					'alert', array("type"=>"alert"), 'failed'
				);
				$this->File->validationErrors = $errors;
			}
		}

		if ($handle = opendir(FILES_DIR)) {
			while ($filename = readdir($handle)) {
				$filename_path = FILES_DIR.$filename;
				if(!is_dir($filename_path)) {
					if ($filename != "." && $filename != "..") {
						$db_files = $this->File->find('list', array('fields' => array('File.filename')));
						if (!in_array($filename,$db_files)) {
							$orphans_files[] = $this->rename($filename, $filename);
						}
					}
				}
			}
			closedir($handle);
			if (isset($orphans_files)) {	
				$this->set('files', $orphans_files);
			}
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			debug($this->request->data('File'));
			$this->File->create();
			if ($this->File->save($this->request->data)) {
				$this->Session->setFlash(__('The files copy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The files copy could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->File->exists($id)) {
			throw new NotFoundException(__('Invalid files copy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->File->save($this->request->data)) {
				$this->Session->setFlash(__('The files copy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The files copy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('File.' . $this->File->primaryKey => $id));
			$this->request->data = $this->File->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->File->id = $id;
		if (!$this->File->exists()) {
			throw new NotFoundException(__('Invalid files copy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->File->delete()) {
			$this->Session->setFlash(__('The files copy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The files copy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
