<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12">
        <h1 class="page-header">Atualizar Usuário</h1>
    </div>


    <div class="col-md-12">
        <form action="<?= base_url(); ?>usuario/salvar_atualizacao" method="post">
            <input type="hidden" id="idusuario" name="idusuario" value="<?= $usuario[0]->idusuario; ?>"> <!-- um campo escondido para gente colocar o valor dele com o id do usuario la da fncao salvar_atualizacao-->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome..." value="<?= $usuario[0]->nome; ?>" required>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o CPF..." value="<?= $usuario[0]->cpf; ?>" required>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Informe o Endereço..." value="<?= $usuario[0]->endereco; ?>" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="nivel">Nível:</label>
                    <select id="nivel" class="form-control" name="nivel" required>
                        <option value="0"> --- </option>
                        <option value="1" <?= $usuario[0]->nivel == 1 ? 'selected' : ''; ?>> Administrador </option> <!-- vai selecionar o valor de nivel =1 que é administrador -->
                        <option value="2" <?= $usuario[0]->nivel == 2 ? 'selected' : ''; ?>> Usuário </option>
                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Informe o Email..." value="<?= $usuario[0]->email; ?>" required>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="button" class="btn btn-default btn-block" value="Atualizar a Senha"  data-toggle="modal" data-target="#myModal">
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="status">Status:</label>
                    <select id="status" class="form-control" name="status" value="<?= $usuario[0]->status; ?>" required>
                        <option value="0"> --- </option>
                        <option value="1" <?= $usuario[0]->status == 1 ? 'selected' : ''; ?>> Ativo </option>
                        <option value="2" <?= $usuario[0]->status == 2 ? 'selected' : ''; ?>> Inativo </option>
                    </select>
                </div>
               
                <div class="col-md-3">
                        <label for="cidade">Cidade:</label>
                        <select id="cidade" class="form-control" name="cidade" required>
                            <option value="0"> --- </option>
                            <?php foreach($cidades as $linha): 
                                if($usuario[0]->cidade_idcidade==$linha->idcidade) { ?>
                            <option value="<?= $linha->idcidade ?>" selected> <?= $linha->nome_cid. '-'.$linha->estado; ?> </option>
                            <?php } else {     ?> 

                            <option value="<?= $linha->idcidade ?>" > <?= $linha->nome_cid. '-'.$linha->estado; ?> </option>
    
                            <?php } 
                        endforeach; ?>
                        </select>
                 </div>
                    
                 <div class="col-md-3">
                    <div class="form-group">
                        <label for="datanascimento">Data de Nascimento:</label>
                        <input type="text" class="form-control" id="datanascimento" name="datanascimento" placeholder="00/00/0000" value="<?= date('d/m/Y', strtotime($usuario[0]->datanascimento)); ?>" required>
                    </div>

                 </div>

            </div>


            <div class="col-md-12" style="text-align: right; padding-right:0px">
                <button type="submit" class="btn btn-success">Enviar</button>
                <button type="reset" class="btn btn-default">Cancelar</button>

            </div>

            <div style="text-align:right">

            </div>
        </form>
    </div>

</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?= base_url () ?>usuario/salvar_senha" method="post">
  <input type="hidden" id="idusuario" name="idusuario" value="<?= $usuario[0]->idusuario; ?>"> <!-- um campo escondido para gente colocar o valor dele com o id do usuario la da fncao salvar_atualizacao-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Atualizar senha</h4>
      </div>
      <div class="modal-body">

            <div class="row">
            
                <div class="col-md-12 form-group ">
                    <label for="senha_antiga">Senha antiga:</label>
                    <input type="password" name="senha_antiga" id="senha_antiga" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label for="senha_nova">Nova Senha:</label>
                    <input type="password" name="senha_nova" id="senha_nova"  onkeyup="checarSenha()"  class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label for="senha_confirmar">Confirmar Senha:</label>
                    <input type="password" name="senha_confirmar" id="senha_confirmar"  onkeyup="checarSenha()" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <div id="divcheck">

                    </div>
                </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary" id="enviarsenha" disabled>Salvar</button>
      </div>
    </div>
    </form>
  </div>
</div>




<script>

    $(document).ready(function () {
        $("#senha_nova").keyup(checkPasswordMatch); //identificar o campo da senha //keyup é uma função que executa assim que a gente soltar o botao
        $("#senha_confirmar").keyup(checkPasswordMatch);
    });
    function checarSenha() { 
        var password = $("#senha_nova").val(); //variavel senha que vai reservar a nova senha
        var confirmPassword = $("#senha_confirmar").val(); //variavel que vai reservar a confirmacao da senha

        if (password == '' || '' == confirmPassword) { //vericicar  se o password for vazio ou se o confirma passsword for vazio entao vai acontecer;......
            $("#divcheck").html("<span style='color: red'> Campo de senha vazio </span>");
            document.getElementById("enviarsenha").disabled = true;
        } else if (password != confirmPassword ) { // aqui ele vai verificar se esta igual ou nao // 
            $("#divcheck").html("<span style='color: red'> Senhas não conferem! </span>");
            document.getElementById("enviarsenha").disabled = true;
        }else {
            $("#divcheck").html("<span style='color: green'> Senhas iguais! </span>");
            document.getElementById("enviarsenha").disabled = false;
        }
    }

</script> 






