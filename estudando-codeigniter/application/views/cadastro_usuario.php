<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12">
        <h1 class="page-header">Novo Usuário</h1>
    </div>


    <div class="col-md-12">
        <form autocomplete="off" action="<?= base_url(); ?>usuario/cadastrar" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome..." required>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o CPF..." required>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Informe o Endereço..." required>
                    </div>
                </div>

                <div class="col-md-2">
                        <label for="nivel">Nível:</label>
                        <select id="nivel" class="form-control" name="nivel" required>
                            <option value="0"> --- </option>
                            <option value="1"> Administrador </option>
                            <option value="2"> Usuário </option>
                        </select>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Informe o Email..." required>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a Senha..." required>
                    </div>
                </div>

                <div class="col-md-2">
                        <label for="status">Status:</label>
                        <select id="status" class="form-control" name="status" required>
                            <option value="0"> --- </option>
                            <option value="1"> Ativo </option>
                            <option value="2"> Inativo </option>
                        </select>
                </div>
                <div class="col-md-3">
                        <label for="cidade">Cidade:</label>
                        <select id="cidade" class="form-control" name="cidade" required>
                            <option value="0"> --- </option>
                            <?php foreach($cidades as $linha):  ?>
                            <option value="<?= $linha->idcidade ?>"> <?= $linha->nome_cid.'-'.$linha->estado; ?> </option>
                            <?php endforeach; ?>
                        </select>
                 </div>
                    
                 <div class="col-md-3">
                    <div class="form-group">
                        <label for="datanascimento">Data de Nascimento:</label>
                        <input type="text" class="form-control" id="datanascimento" name="datanascimento" placeholder="00/00/0000" required>
                    </div>

                 </div>

            </div>
    
            <div  style="text-align: right; padding-right:0px">
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