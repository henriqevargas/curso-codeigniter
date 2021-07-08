<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function verificar_sessao() 
	{
		 if ($this->session->userdata('logado') == false) {
			redirect('dashboard/login');
		}  
		}

	public function index($indice=null, $valor=null) 
	{
		
		
		if($valor == null) { //se $valor for nulo, quer dizer que chamei esse metodo sem nenhum valor, entao quer dizer que estou na pagina 1
			$valor = 1; //a partir de qual posição vai começar a aparecer os dados na tela 
		}
		$reg_p_pag = 5; // (registro por pagina ) --> aqui estamos definindo o numero de registro que queremos colocar em cada pagina

		if($valor <= $reg_p_pag) { // se o numero que entrou no valor for menor/igual que o registro por pagina
			$data['btnA'] = 'pointer-events:none'; //o btnA é o botao anterior, ele vai ser desativado
		}else{
			$data['btnA'] = ''; // se nao o btnA é igual a 'nada'
		}

		$this->load->model('usuario_model', 'usuario');
		$u = $this->usuario->get_qtd_usuarios();
		
		// verificação se o nosso botao de proximo esta ativado ou desativado
		if(($u[0]->total-$valor) < $reg_p_pag) { //por exemplo se eu tenho 50 registro e eu mandei o valor 1, entao 50 - 1 vai ser menor que que a quantidade de pagina (10) ? Não, entao ele vai fazer....
			$data['btnP'] = 'pointer-events:none';
		} else {
			$data['btnP'] = '';
		}

		$this->load->model('usuario_model', 'usuario');
		$u = $this->usuario->get_qtd_usuarios();
		
		$data['usuarios'] = $this->usuario->get_usuarios();
		$data['usuarios'] = $this->usuario->get_usuarios_pag($valor, $reg_p_pag);
		//==================================================

		$data['valor'] = $valor;
		$data['reg_p_pag'] = $reg_p_pag;
		$data['qtd_reg'] = $u[0]->total;
		

		
		$v_inteiro = (int) $u[0]->total/$reg_p_pag;
		$v_resto = $u[0]->total%$reg_p_pag;

		//============================================
		


		$data['qtd_botoes'] = $v_inteiro; //definindo a qtd de botoes que vou ter
		
		$v_inteiro = (int) $u[0]->total/$reg_p_pag;
		$v_resto = $u[0]->total%$reg_p_pag;

		if($v_resto>0) {
			$v_inteiro +=1;
		}


		//========================
		switch ($indice) {
			case 1:
				$data['msg'] = "Usuario cadastrado com Sucesso!";
            	$this->load->view('includes/msg_sucesso',$data);
				break;
			case 2:
				$data['msg'] = "Não foi possível cadastrar o usuário";
            	$this->load->view('includes/msg_erro',$data);
				break;
			case 3:
				$data['msg'] = "Usuario excluído com sucesso!";
           	    $this->load->view('includes/msg_sucesso',$data);
				break;
			case 4:
				$data['msg'] = "Não foi possível excluir o usuário";
                $this->load->view('includes/msg_erro',$data);
				break;
			case 5:
				$data['msg'] = "Usuario atualizado com sucesso!";
                $this->load->view('includes/msg_sucesso',$data);
				break;
			case 6:
				$data['msg'] = "Não foi possível atualizar o usuário";
                $this->load->view('includes/msg_erro',$data);
				break;
		}
		
		$this->load->view('includes/html_header'); 
		$this->load->view('includes/menu');

        $this->load->view('listar_usuario',$data);
		$this->load->view('includes/html_footer');

	}

    public function cadastro()
	{
		$this->verificar_sessao();
		$this->load->model('usuario_model','usuario'); //logando na model , o segundo parametro esta "renomeando usuario_model para usuario, assim posso usar essa classe aqui dentro utilizando o nome 'usuario' 
		$data['cidades'] = $this->usuario->get_cidades();
		$this->load->view('includes/html_header'); 
		$this->load->view('includes/menu');
		$this->load->view('cadastro_usuario', $data);
		$this->load->view('includes/html_footer');

	}

    public function cadastrar()
	{     

		//recebendo os dados
		$data['nome'] = $this->input->post('nome');  //criando array com o nome de cada item do meu banco
		$data['cpf'] = $this->input->post('cpf');
		$data['endereco'] = $this->input->post('endereco');
		$data['email'] = $this->input->post('email');
		$data['senha'] = md5($this->input->post('senha')); //md5 é para cadastrar a senha criptografada
		$data['status'] = $this->input->post('status');
		$data['nivel'] = $this->input->post('nivel');  
		$data['cidade_idcidade'] = $this->input->post('cidade');  
		$data['datanascimento'] = implode( '-' , array_reverse(explode('/',$this->input->post('datanascimento'))));  

		$this->load->model('usuario_model','usuario'); //logando na model , o segundo parametro esta "renomeando usuario_model para usuario, assim posso usar essa classe aqui dentro utilizando o nome 'usuario' 
        if($this->usuario->cadastrar($data)) { //se ele inserir essas informações entao ele vai para...
            redirect('usuario/1'); //redirecionado para o controlador usuario e passado o valor 1
        }else{
            redirect('usuario/2'); //redirecionado para o controlador usuario e passado o valor 2

        }

	}

	public function excluir($id) 
	{
		$this->load->model('usuario_model','usuario'); //logando na model , o segundo parametro esta "renomeando usuario_model para usuario, assim posso usar essa classe aqui dentro utilizando o nome 'usuario' 


		if($this->usuario->excluir($id)) { 
            redirect('usuario/3'); //redirecionado para o controlador usuario e passado o valor 3
        }else{
            redirect('usuario/4'); //redirecionado para o controlador usuario e passo o valor 4

        }
	}

	public function atualizar ($id=null, $indice=null) 
	{
		$this->verificar_sessao();

		$this->load->model('usuario_model','usuario');
		$data['cidades'] = $this->usuario->get_cidades();

		$this->db->where('idusuario', $id);
		$data['usuario'] = $this->db->get('usuario')->result(); //buscamos os dados do usuario no banco

		$this->load->view('includes/html_header'); 
		$this->load->view('includes/menu');
		switch ($indice) {
			case 1:
				$data['msg'] = "Senha atualizada com Sucesso!";
            	$this->load->view('includes/msg_sucesso',$data);
				break;
			case 2:
				$data['msg'] = "Não foi possível atualizar a senha do usuário";
            	$this->load->view('includes/msg_erro',$data);
				break;
			}

		$this->load->view('editar_usuario', $data);
		$this->load->view('includes/html_footer');
		

	}


	public function salvar_atualizacao()
	{

		$id = $this->input->post('idusuario'); 
		$data['nome'] = $this->input->post('nome');  //criando array com o nome de cada item do meu banco
        $data['cpf'] = $this->input->post('cpf');
        $data['endereco'] = $this->input->post('endereco');
        $data['email'] = $this->input->post('email');
        $data['status'] = $this->input->post('status');
        $data['nivel'] = $this->input->post('nivel');  
		$data['cidade_idcidade'] = $this->input->post('cidade');  
        $data['datanascimento'] = implode( '-' , array_reverse(explode('/',$this->input->post('datanascimento'))));  


		$this->load->model('usuario_model','usuario'); //logando na model , o segundo parametro esta "renomeando usuario_model para usuario, assim posso usar essa classe aqui dentro utilizando o nome 'usuario' 

        if($this->usuario->salvar_atualizacao($data, $id)) { 
            redirect('usuario/5'); 
        }else{
            redirect('usuario/6'); 

        }

	}

	public function salvar_senha() {
		

		
		$this->load->model('usuario_model','usuario'); //logando na model , o segundo parametro esta "renomeando usuario_model para usuario, assim posso usar essa classe aqui dentro utilizando o nome 'usuario' 
		$id = $this->input->post('idusuario'); 


		$senha_antiga = md5($this->input->post('senha_antiga'));
		$senha_nova= md5($this->input->post('senha_nova'));


		if($this->usuario->salvar_senha($id, $senha_antiga, $senha_nova)) { 

			redirect('usuario/atualizar/'.$id.'/1'); // vai redirecionar para o usuario e o metodo atualizar com o id1, que é a mensagem 1....

		}else{
			redirect('usuario/atualizar/'.$id.'/2');
		}
	}

	public function pesquisar($valor=null) 
	{
		//===============================================

		if($valor == null) { //se $valor for nulo, quer dizer que chamei esse metodo sem nenhum valor, entao quer dizer que estou na pagina 1
			$valor = 1; //a partir de qual posição vai começar a aparecer os dados na tela 
		}
		$reg_p_pag = 5; // (registro por pagina ) --> aqui estamos definindo o numero de registro que queremos colocar em cada pagina

		if($valor <= $reg_p_pag) { // se o numero que entrou no valor for menor/igual que o registro por pagina
			$data['btnA'] = 'pointer-events:none'; //o btnA é o botao anterior, ele vai ser desativado
		}else{
			$data['btnA'] = ''; // se nao o btnA é igual a 'nada'
		}

		$this->load->model('usuario_model', 'usuario');
		$u = $this->usuario->get_qtd_usuarios();
		
		// verificação se o nosso botao de proximo esta ativado ou desativado
		if(($u[0]->total-$valor) < $reg_p_pag) { //por exemplo se eu tenho 50 registro e eu mandei o valor 1, entao 50 - 1 vai ser menor que que a quantidade de pagina (10) ? Não, entao ele vai fazer....
			$data['btnP'] = 'pointer-events:none';
		} else {
			$data['btnP'] = '';
		}

		$this->load->model('usuario_model', 'usuario');
		$u = $this->usuario->get_qtd_usuarios();
		
		$data['usuarios'] = $this->usuario->get_usuarios();
		$data['usuarios'] = $this->usuario->get_usuarios_pag($valor, $reg_p_pag);
		//==================================================

		$data['valor'] = $valor;
		$data['reg_p_pag'] = $reg_p_pag;
		$data['qtd_reg'] = $u[0]->total;
		

		
		$v_inteiro = (int) $u[0]->total/$reg_p_pag;
		$v_resto = $u[0]->total%$reg_p_pag;

		//============================================
		


		$data['qtd_botoes'] = $v_inteiro; //definindo a qtd de botoes que vou ter
		
		$v_inteiro = (int) $u[0]->total/$reg_p_pag;
		$v_resto = $u[0]->total%$reg_p_pag;

		if($v_resto>0) {
			$v_inteiro +=1;
		}



		//=================================================
		$this->load->model('usuario_model', 'usuario');
		$data['usuarios'] = $this->usuario->get_usuarios_pesquisa();
		//============================================
		$this->load->view('includes/html_header'); 
		$this->load->view('includes/menu');

        $this->load->view('listar_usuario', $data);
		$this->load->view('includes/html_footer');

	
	}

	public function pag($valor = null) //esse $valor é pra mostrar em qual posição e o valor que vou estar atualmente, ou que eu cliquei, ou seja, quando eu clicar nele vai ser mandado o valor para essa variavel...
	{

		if($valor == null) { //se $valor for nulo, quer dizer que chamei esse metodo sem nenhum valor, entao quer dizer que estou na pagina 1
			$valor = 1; //a partir de qual posição vai começar a aparecer os dados na tela 
		}
		$reg_p_pag = 5; // (registro por pagina ) --> aqui estamos definindo o numero de registro que queremos colocar em cada pagina
		
		if($valor <= $reg_p_pag) { // se o numero que entrou no valor for menor/igual que o registro por pagina
			$data['btnA'] = 'pointer-events:none'; //o btnA é o botao anterior, ele vai ser desativado
		}else{
			$data['btnA'] = ''; // se nao o btnA é igual a 'nada'
		}

		$this->load->model('usuario_model', 'usuario');
		$u = $this->usuario->get_qtd_usuarios();
		
		// verificação se o nosso botao de proximo esta ativado ou desativado
		if(($u[0]->total-$valor) < $reg_p_pag) { //por exemplo se eu tenho 50 registro e eu mandei o valor 1, entao 50 - 1 vai ser menor que que a quantidade de pagina (10) ? Não, entao ele vai fazer....
			$data['btnP'] = 'pointer-events:none';
		} else {
			$data['btnP'] = '';
		}
	
		$this->load->model('usuario_model', 'usuario');
		$data['usuarios'] = $this->usuario->get_usuarios_pag($valor, $reg_p_pag);
		//============================================

		$data['valor'] = $valor;
		$data['reg_p_pag'] = $reg_p_pag;
		$data['qtd_reg'] = $u[0]->total;
		

		
		$v_inteiro = (int) $u[0]->total/$reg_p_pag;
		$v_resto = $u[0]->total%$reg_p_pag;

		if($v_resto>0) {
			$v_inteiro +=1;
		}

		$data['qtd_botoes'] = $v_inteiro; //definindo a qtd de botoes que vou ter


		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('listar_usuario', $data); 
		$this->load->view('includes/html_footer');  
		

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */