<?php



class UsersController extends AppController {

    var $name = 'Users';

    var $components = array('Recaptcha');
    var $helpers = array('Recaptcha');

    function beforeFilter() {
        parent::beforeFilter();

        if (!empty($this->Auth)) {
            $this->Auth->allow('activate', 'register', 'reset', 'recover', 'resend', 'login', 'logout');
            $this->Auth->allow('*');
        }
    }

    function index() {}

    function login() {                                 
        if (!empty($this->data)) {    
            if ($this->data['User']['remember_me'] == 1) {    
                $this->Cookie->write('User.id', $this->Auth->user('id'));
            }
        }
        
        if ($this->Session->check('Auth.User')) {
            $this->redirect($this->Auth->redirect());
        }
    }
    
    function logout() { 
		if ($this->Cookie->read('User.id')) { 
			$this->Cookie->delete('User.id');
	    }
        $this->redirect($this->Auth->logout());
    }

    function register($status = '') {
        if (!$this->Session->check('Auth.User')) {
            if (!empty($this->data)) {
                if ($user = $this->User->register($this->data)) {
                    $this->_sendEmail($user);
                    $this->Session->write('Registration.email', $user['to']);
                    $this->redirect(array('action' => 'register', 'success'));
                } else {
                    $this->Session->setFlash(__('We were unable to register your account!', true));
                }
            } elseif ($status) {
                if ($this->Session->check('Registration.email')) {
                    $this->set('email', $this->Session->read('Registration.email'));
                    $this->render($this->action.'_'.$status);
                } else {
                    $this->redirect(array('action' => 'register'));
                }
            }
        } else {
            $this->redirect('/');
        }
    }


    function activate($key = null) {
        if (!$this->Session->check('Auth.User')) {
            if (!is_null($key)) {
                if ($user = $this->User->activate($key)) {
                    $this->Auth->login($user);
                    $this->_sendEmail($user);
                    $this->Session->setFlash(__('Your account is verified!', true));
                    $this->redirect(array('action' => 'done'));
                } else {
                    $this->Session->setFlash(__('We were unable to verify you account! Account may already be active.', true));
                    $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->redirect(array('action' => 'login'));
            }
        } else {
            $this->redirect('/');
        }
    }

    function done() {     
		if ($this->Session->check('Auth.User')) {
        	if (!empty($this->data)) {   
            	if ($this->Auth->user('id')) {
                	$user = $this->User->read(null, $this->Auth->user('id'));
                	$this->User->save($this->data);
                	$this->Auth->login($user);
                	$this->redirect($this->Auth->redirect('/'));
            	} else {
                	$this->redirect(array('action' => 'login'));
            	}
        	} else {
            	$this->data = $this->Auth->user();
        	} 
		} else {
			$this->redirect('/');
		}
    }

    function skip() {
        $this->redirect($this->Auth->redirect('/'));
        // Track User/Insert History
        // Send to Home Page
    }

    function recover() {
        if (!empty($this->data)) {
            if ($user = $this->User->recover($this->data)) {
                $this->_sendEmail($user);
                $this->Session->setFlash(__('Password Change Email has been sent!', true));  
                $this->redirect(array('action' => 'recover'));
            } else {
                $this->Session->setFlash(__('No user found with that email', true)); 
            }
        }
    }

    function reset($key = null) {   
        if (!is_null($key)) {  
			if ($user = $this->User->resetKey($key)) {
				$this->Session->write('Reset.User', $user); 
			}
		}  

		if ($user = $this->Session->read('Reset.User')) { 
			$this->set('user', $user);  
	  		if (!empty($this->data)) {  
				if ($this->User->reset($this->data, $user['User']['id'])) {
					$this->Session->delete('Reset');
					$this->redirect('/');
				}   
        	}    
		} else {
			$this->redirect('/');
		}
    }

    function resend($email = null) {
        if (!is_null($email)) {
            if ($user = $this->User->resend($email)) {
                $this->_sendEmail($user);
            } else {
                $this->Session->setFlash(__('Unable to send activation email.  It may be that the account is already active or the email doesn\'t exisit.', true)); 
            }
        }
        $this->redirect(array('action' => 'login'));
    }


    function admin_login() {
		$this->set('title_for_layout', __('Administration Login', true));
		$this->layout = "admin_login";
		if (!empty($this->data)) {
            if ($this->data['User']['remember_me'] == 1) {
                $this->Cookie->write('User.id', $this->Auth->user('id'));
            }
        }

        if ($this->Session->check('Auth.User')) {
            $this->redirect($this->Auth->redirect());
        }
    }

	function admin_logout() {
		if ($this->Cookie->read('User.id')) { 
			$this->Cookie->delete('User.id');
	    }
        $this->redirect($this->Auth->logout());
    }

	function admin_index() {
		$this->set('title_for_layout', __('Users', true));
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'), 'attention');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->register($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'), 'error');
			}
		}
		$this->set('title_for_layout', sprintf(__('Add %s', true), 'User'));
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'), 'attention');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->register($this->data, $id)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	
		
		$this->set('title_for_layout', sprintf(__('Edit "%s"', true), $this->data['User']['username']));
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'User'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function home(){
		$this->set('title_for_layout','Restocom');
	}
	function comprar(){
		$this->set('title_for_layout','Restocom');
		
		/*var $items= new array();
		var $subitem= new array();*/
		$items[0]['claseLi']='item';
		$items[0]['boolHijo']='false';
		$items[0]['boolFinal']='false';
		$items[0]['descripcionItem']='Todos';
		
		$items[1]['claseLi']='item';
		$items[1]['boolHijo']='true';
		$items[1]['boolFinal']='false';
		$items[1]['descripcionItem']='Abarrotes';
		$items[1]['subitem']=array(0=>'Aceite',1=>'Arroz',2=>'Azucar',3=>'Condimentos',4=>'Conservas');
		
		$items[2]['claseLi']='item';
		$items[2]['boolHijo']='false';
		$items[2]['boolFinal']='false';
		$items[2]['descripcionItem']='Carniceria';
		
		$items[3]['claseLi']='item';
		$items[3]['boolHijo']='true';
		$items[3]['boolFinal']='false';
		$items[3]['descripcionItem']='Frutas y Verduras';
		
		$items[3]['subitem']=array(0=>'Frutas', 1=>'Verduras');
		
		$items[4]['claseLi']='item';
		$items[4]['boolHijo']='false';
		$items[4]['boolFinal']='false';
		$items[4]['descripcionItem']='Lacteos';
		
		$items[5]['claseLi']='item';
		$items[5]['boolHijo']='true';
		$items[5]['boolFinal']='false';
		$items[5]['descripcionItem']='Panaderia';
		
		$items[5]['subitem']=array(0=>'Pan Blanco', 1=>'Pan Integral', 2=>'Queques', 3=>'Dulces', 4=>'Tortas', 5=>'Pizzas');
		
		$items[6]['claseLi']='pieMenu';
		$items[6]['boolHijo']='true';
		$items[6]['boolFinal']='true';
		$items[6]['descripcionItem']='Vinos y Licores';
		
		$items[6]['subitem']=array(0=>'Cervezas', 1=>'Champagne', 2=>'Vinos Tintos', 3=>'Vinos Blancos', 4=>'Vinos Otros', 5=>'Vodka', 6=>'Ron', 7=>'Whisky', 8=>'Otros Licores');

		$this->set('item', $items);
	}
}
