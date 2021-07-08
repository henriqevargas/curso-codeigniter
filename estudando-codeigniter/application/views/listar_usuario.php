<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-10">
    <h1 class="page-header">Usuarios</h1>
    </div>
    <div class="col-md-2">
        <a class="btn btn-primary btn-block" href="<?= base_url(); ?>usuario/cadastro"> Novo usuário</a> <!--criando um botao da classe btn primary e btn block do bootstrap e chamando o método cadastro da classe usuario -->
    </div>

    <div class="col-md-12" style="padding-bottom: 10px">
        <form action="<?= base_url(); ?>usuario/pesquisar" method="post">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="pesquisar" name="pesquisar" placeholder="Pesquisar por..." >
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">Pesquisar</button>
                    </div>
                </div>
        </form>
    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th>Cidade</th>
                <th>Status</th>
                <th></th>
            </tr>
            <?php foreach($usuarios as $usu) {?> <!--temos um vetor de usuarios e a cada linha vamos chamar um usuario-->
            <tr>
                <td><?= $usu->idusuario; ?></td>
                <td><?= $usu->nome; ?></td>
                <td><?= $usu->email; ?></td>
                <td><?= $usu->nivel==1?'Administrador':'Usuario'; ?></td>
                <td><?= $usu->nome_cid; ?></td> <!-- esse nome é o nome da cidade -->
                <td><?= $usu->status==1?'Ativo':'Inativo'; ?></td> <!-- se status for igual 1 entao vai ser ativo se nao vai ser inativo........-->
                <td>
                    <a href="<?= base_url('usuario/atualizar/'.$usu->idusuario)  ?>" class="btn btn-primary btn-group">Atualizar</a>
                    <a href="<?= base_url('usuario/excluir/'.$usu->idusuario)  ?>" class="btn btn-danger btn-group" onclick="return confirm('Deseja realmente excluir o usuário?')">Remover</a>
                </td>

            </tr>
            <?php }  ?>
        </table>

        <nav>
            <ul class="pagination">
                <li>
                    <a href="<?= base_url('usuario/pag/'.$valor-$reg_p_pag);?>" aria-label="Anterior" style="<?=$btnA ?>">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                    $n_pag = 1;
                    for ($i=1; $i<=$qtd_botoes; $i++) { ?>
                    <li><a href="<?= base_url('usuario/pag/'.$n_pag);?>"><?= $i?></a></li>
                    <?php 
                    $n_pag+=$reg_p_pag;
                } ?>
                
                <li>
                    <a href="<?= base_url('usuario/pag/'.$valor+$reg_p_pag);?>" aria-label="Próximo" style="<?=$btnP?>">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>            
            </ul>
        </nav>


      






    </div>
  
 
</div>
</div>
</div>