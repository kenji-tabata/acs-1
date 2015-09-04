    <!-- Caixa para check cpf -->
    <div id="box-check-cpf" class="shadow">
        
        <!-- Mensagens de erro -->
        <div class="erro">
            <?php echo validation_errors() ?>
        </div>
        <!-- end div.erro -->
        
        <!-- Formulario  -->
        <form id="form-check-cpf" action="<?php echo base_url().'formularios_externos/valida_cpf' ?>" method="post">
            <fieldset>
                <?php $this->load->helper('inflector') ?>
<!--                <legend><h3><?php #echo humanize($this->session->userdata('metodo')) ?></h3></legend>-->
                <legend><h3><?php echo $legenda ?></h3></legend>
                <label for="cpf">Digite seu cpf:</label>
                <input type="text" id="cpf" name="cpf" class="texto" value="<?php echo set_value('cpf') ?>"  />
                
                <input type="submit" value="Entrar" class="botao" />
            </fieldset>
        </form>
        <!-- end form#form-check-cpf -->
        
        <hr/>
        
        <!-- Rodape da caixa de login -->
        <b>Bem vindo ao sistema do Prof. Antonio Carlos Simões!!!</b>
        
    </div>
    <!-- end div#box-login -->