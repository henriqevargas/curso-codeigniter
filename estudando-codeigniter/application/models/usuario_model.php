<?php

class Usuario_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function cadastrar($data)
	{

        //inserindo no banco de dados e vai retornar oq tiver no banco
        return $this->db->insert('usuario', $data);
           
	}

    public function excluir($id=null) 
	{

		$this->db->where('idusuario',$id);
		return $this->db->delete('usuario'); 
        
	}

    public function salvar_atualizacao($data, $id)
	{

		$this->db->where('idusuario',$id);
        return $this->db->update('usuario', $data); 
       

	}

    public function salvar_senha($id, $senha_antiga, $senha_nova) {
        

		$this->db->select('senha'); //buscando no banco
		$this->db->where('idusuario',$id); //se o id usuario for igual ao $id
		$data['senha'] = $this->db->get('usuario')->result();
		$dados['senha'] = $senha_nova;


		if($data['senha'][0]->senha==$senha_antiga) { //se data na posição senha e o primeiro registro que é a posição zero do array,o campo senha se for igual a senha antiga entao
			$this->db->where('idusuario', $id);
			$this->db->update('usuario', $dados);
            return true;
		}else{
			return false;
		}
	}

    function get_usuarios() {
        $this->db->select('*');
		$this->db->join('cidade', 'cidade_idcidade=idcidade', 'inner');
		$this->db->order_by('idusuario');
		return $this->db->get('usuario')->result();//usuario é a tabela do banco de dados
    }

    function get_usuarios_pesquisa() {
        $termo = $this->input->post('pesquisar');
        $this->db->select('*');
        $this->db->join('cidade', 'cidade_idcidade=idcidade', 'inner');
        $this->db->order_by('idusuario');
        $this->db->like('nome', $termo);
		return $this->db->get('usuario')->result();//usuario é a tabela do banco de dados
    }

    function get_cidades() {
        $this->db->select('*');
		
		return $this->db->get('cidade')->result();
    }
    
    function get_qtd_usuarios() {
        
		$this->db->select('count (*) as total'); //contando os registros
		return $this->db->get('usuario')->result(); //contando quantos registros tem na tabela do banco
    }

    function get_usuarios_pag($valor, $reg_p_pag) {
        $this->db->select('*');
        $this->db->limit($reg_p_pag , $valor);
		$this->db->join('cidade', 'cidade_idcidade=idcidade', 'inner');
		$this->db->order_by('idusuario');
		return $this->db->get('usuario')->result();//usuario é a tabela do banco de dados
    }
    

}