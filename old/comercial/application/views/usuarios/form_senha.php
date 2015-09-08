<!-- Coluna da direita -->
<div id="content">
    
        <div class="post">
            <!-- Titulo do post -->
            <h2 class="title">Alterar Senha</h2>

            <!-- Conteudo do post -->
            <div class="entry">

                    <!-- Mensagens de erro -->
                    <div class="erro">
                        <?php echo validation_errors() ?>
                    </div>
                    <!-- end div.erro -->
                    
                    <?php $this->load->helper('form')?>
                    
                    <!-- Formulario Padrao -->
                    <form class="default-form" action="<?php echo base_url() . 'usuarios/salvar_senha' ?>" method="post">
                        <fieldset>

                            <input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata('id_usuario') ?>" />
                            
                            <label for="senha">Nova senha</label>
                            <input type="password" id="senha" name="senha" value="" />

                            <label for="confsenha">Redigite a senha</label>
                            <input type="password" id="confsenha" name="confsenha" value="" />

                            <input type="submit" name="salvar" class="botao" value="Salvar" />
                        </fieldset>
                    </form>
                    <!-- end form.default-form -->
            </div>
            <!-- end div.entry -->
        </div>
        <!-- end div.post -->
        <div style="clear: both;">&nbsp;</div>
</div>
<!-- end div#content -->
