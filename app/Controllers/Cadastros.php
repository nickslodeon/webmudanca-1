<?php

namespace App\Controllers;

class Cadastros extends BaseController
{
  
    public function cadastroUsuario()
    {
        $session = session();

        $msgConfirmaCadastro = $session->getFlashdata('msgConfirmaCadastro');
        $msgSenhaDiferente = $session->getFlashdata('msgSenhaDiferente');
        $msgEmailjaCadastrado = $session->getFlashdata('msgEmailjaCadastrado');
        $msgUsuariojaCadastrado = $session->getFlashdata('msgUsuariojaCadastrado');
       
        $dadosView = [
            'msgConfirmaCadastro' => $msgConfirmaCadastro,
            'msgSenhaDiferente' => $msgSenhaDiferente,
            'msgEmailjaCadastrado' => $msgEmailjaCadastrado,
            'msgUsuariojaCadastrado' => $msgUsuariojaCadastrado
        ];
        
        return view ('cadastrousuario', $dadosView);
    }

    public function dadosCadastro()
    {
        $nome = $this->request->getPost('nome');
        $usuario = $this->request->getPost('usuario');
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        $Confirmasenha = $this->request->getPost('confirma_senha');
        $dataNasc = $this->request->getPost('data_nascimento');
        $genero = $this->request->getPost('genero');

        $dados = [
            'nomecompleto' => $nome,
            'usuario' => $usuario,
            'email' => $email,
            'senha' => $senha,
            'dataNascimento' => $dataNasc,
            'genero' => $genero
        ];

        $usuarioModel = new \App\Models\UsuarioModel();

        // $verificaEmail = $usuarioModel->VerificaEmail($email);
        // $verificaUsuario = $usuarioModel->VerificaUsuario($usuario);
        
        if($senha != $Confirmasenha){
            $session = session();
            $session->setFlashdata('msgSenhaDiferente', 'As senhas não combinam.');
        }
        // else if($verificaEmail == 1 && "1"){
        //     $session = session();
        //     $session->setFlashdata('msgEmailjaCadastrado', 'Email já cadastrado.');
        //     return redirect()->to(base_url('cadastrousuario'));
        // }else if($verificaUsuario == 1 && "1"){
        //     $session = session();
        //     $session->setFlashdata('msgUsuariojaCadastrado', 'Usuário já cadastrado.');
        //     return redirect()->to(base_url('cadastrousuario'));
        // }

            
        
        $usuarioModel->insert($dados);
        
        $session = session();
        $session->setFlashdata('msgConfirmaCadastro', 'Cadastrado com sucesso!');

        return redirect()->to(base_url('cadastrousuario'));
     
    }

    public function cadastraImoveis()
    {
        $session = session();
        
        $usuario = $session->get('usuario');
        $msgConfirmaCadastro = $session->getFlashdata('msgConfirmaCadastro');
        $msgErro = $session->getFlashdata('msgErro');


        $dados = [ 
            'usuario' => $usuario,
            'msgConfirmaCadastro' => $msgConfirmaCadastro,
            'msgErro' => $msgErro
        ];
        
        return view ('cadastraImoveis', $dados);
    }

    public function DadosImoveis()
    {
        $imovelModel = new \App\Models\ImovelModel();
        
        $usuario = $this->request->getPost('usuario');
        $tipo = $this->request->getPost('tipo');
        $aluguel_venda = $this->request->getPost('aluguel_venda');
        $preco = $this->request->getPost('preco');
        $area = $this->request->getPost('area_total');
        $numeroQuartos = $this->request->getPost('num_quartos');
        $numeroBanheiros = $this->request->getPost('num_banheiros');
        $numeroVagasGaragem = $this->request->getPost('num_vagas_garagem');
        $img = $this->request->getFile('arquivo');

     
        if($img->isValid() && ! $img-> hasMoved()){
            $imgName = $img->getRandomName();
            $img->move('uploads', $imgName);
        }


        $imovelData = [
            'Usuario' => $usuario,
            'Tipo' => $tipo,
            'Aluguel_Venda' => $aluguel_venda,
            'Preco' => $preco,
            'Area' => $area,
            'NumeroQuartos' => $numeroQuartos,
            'NumeroBanheiros' => $numeroBanheiros,
            'NumeroVagasGaragem' => $numeroVagasGaragem,
            'Imagens' => $imgName
        ];

        $imovelModel->insert($imovelData);

        
        
        $imovel = $imovelModel->getimovel();
        $qtdImovel = count($imovel)-1;
         
        
        
        $nomeProprietario = $this->request->getPost('nome_contato');
        $emailProprietario = $this->request->getPost('email_contato');
        $telefoneProprietario = $this->request->getPost('telefone_contato');

        
         $proprietarioData = [
            'Nome' => $nomeProprietario,
            'Email' => $emailProprietario,
            'Telefone' => $telefoneProprietario
        ];


        $proprietarioModel = new \App\Models\proprietarioModel();
        $proprietarioModel->insert($proprietarioData);

        $proprietario = $proprietarioModel->getProprietarios($nomeProprietario,$emailProprietario);
        $QtdProprietarios = count($proprietario)-1;


        //Pegando o Id do proprietario 
        $ID_Proprietario = $proprietarioModel->getIdProprietario($nomeProprietario,$emailProprietario);

        

        //Relacionando com o imóvel 
        $imovelModel->set('ID_Proprietario', $ID_Proprietario[$QtdProprietarios]);
        $imovelModel->where('ID_imovel', $imovel[$qtdImovel]['ID_imovel']);
        $imovelModel->update();
       


       
        $Rua = $this->request->getPost('endereco');
        $numImovel = $this->request->getPost('numImovel');
        $Bairro = $this->request->getPost('bairro');
        $Cidade = $this->request->getPost('cidade');
        $Estado = $this->request->getPost('estado');
        $Cep = $this->request->getPost('cep');

         
          $enderecoData = [
            'Rua' => $Rua,
            'numImovel' => $numImovel,
            'Bairro' => $Bairro,
            'Cidade' => $Cidade,
            'Estado' => $Estado,
            'CEP' => $Cep
            ];

         $enderecoModel = new \App\Models\enderecoModel();
         $enderecoModel->insert($enderecoData);

      
         $Endereco_ID = $enderecoModel->getIdEndereco($Rua,$numImovel);
        
         
         $endereco= $enderecoModel->getEnderecos($Rua,$numImovel);
         $qtdEndereco = count($endereco)-1;
        
        $imovelModel->set('ID_Endereco', $Endereco_ID[$qtdEndereco]);
        $imovelModel->where('ID_imovel', $imovel[$qtdImovel]['ID_imovel']);
        $imovelModel->update();
        

       

         $session = session();
         
         $session->setFlashdata('msgConfirmaCadastro', 'Imóvel Cadastrado com sucesso!');
         return redirect()->to(base_url('cadastraImoveis'));
        
    }

    public function getImoveisByUsuario($usuario)
    {
        $imovelModel = new \App\Models\ImovelModel();
        $imoveis = $imovelModel->where('Usuario', $usuario)->findAll();
        
        return $imoveis;
    }


}

