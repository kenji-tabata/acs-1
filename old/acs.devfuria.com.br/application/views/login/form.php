    <!-- Caixa de Login -->
    <div id="box-login" class="shadow">
        
        <!-- Mensagens de erro -->
        <div class="erro">
            <?php echo validation_errors() ?>
        </div>
        <!-- end div.erro -->
        
        <!-- Formulario de login -->
        <form id="login" action="<?php echo base_url().'acesso/login' ?>" method="post">
            <fieldset>
                <label for="usuario">Nome do usuário</label>
                <input type="text" id="usuario" name="usuario" class="texto" value="<?php echo set_value('usuario') ?>"  />
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="texto" value="<?php echo set_value('senha') ?>" />
                <input type="submit" value="Entrar" class="botao" />
            </fieldset>
        </form>
        <!-- end form#login -->
        
        <hr/>
        
        <!-- Rodape da caixa de login -->
        <b>Bem vindo ao sistema do Prof. Antonio Carlos Simões!!!</b>
        
    </div>
    <!-- end div#box-login -->