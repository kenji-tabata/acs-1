<!-- Coluna da direita -->
<div id="content">
    
        <div class="post">
            <!-- Titulo do post -->
            <h2 class="title">Formulário Pesquisado</h2>

            <!-- Conteudo do post -->
            <div class="entry">

                    <!-- Mensagens de erro -->
                    <div class="erro">
                        <?php echo validation_errors() ?>
                    </div>
                    <!-- end div.erro -->
                    
                    <?php $this->load->helper('form')?>
                    
                    <!-- Formulario Padrao -->
                    <form class="default-form" action="<?php echo base_url() . 'pesquisados/salvar' ?>" method="post">
                        <fieldset>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pesquisado->id) ? $pesquisado->id : '' ?>" />
                            
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo set_value('nome', isset($pesquisado->nome) ? $pesquisado->nome : '') ?>" />

                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" value="<?php echo set_value('email', isset($pesquisado->email) ? $pesquisado->email : '') ?>" />
                            
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" value="<?php echo set_value('cpf', isset($pesquisado->cpf) ? $pesquisado->cpf : '') ?>" />
                            
                            <label for="dtNasc">Data de nascimento</label>
                            <input type="text" id="dtNasc" name="dtNasc" value="<?php echo  set_value('dtNasc', isset($pesquisado->data_nascimento) ? $pesquisado->data_nascimento : '') ?>" />
                            
                            <label for="sexo">Sexo</label>
                            <?php echo form_dropdown('sexo',
                                                     array("" => "Selecione uma opção", "masculino" => 'Masculino', "feminino" => 'Feminino'),
                                                     set_value('sexo', isset($pesquisado->sexo) ? $pesquisado->sexo : ''),
                                                     'id="sexo"'); ?>
                            <?php
                            /*
                             * Cada cliente, seja master ou não, deve inserir pesquisados apenas
                             * na sua própria área
                             */
                            ?>                          
                            <?php #if($this->session->userdata('cliente_master')): ?>
                                <!--
                                <label for="id_cliente">Cliente</label>
                                -->
                                <?php #$combo_cliente = array('' => 'Selecione uma opção') ?>
                                
                                <?php #foreach($clientes as $cliente): ?>
                                    <?php #$combo_cliente[$cliente->id] = $cliente->nome ?>
                                <?php #endforeach; ?>
                                
                                <?php #echo form_dropdown('id_cliente',
                                      #                   $combo_cliente,
                                      #                   set_value('id_cliente', isset($pesquisado->id_cliente) ? $pesquisado->id_cliente : ''),
                                      #                   'id="id_cliente"'); ?>
                            <?php #else: ?> 
                                <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo set_value('id_cliente', isset($pesquisado->id_cliente) ? $pesquisado->id_cliente : $this->session->userdata('id_cliente')) ?>" />
                            <?php #endif; ?>
                       
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
<script type="text/javascript">
    $(function(){
        $('#dtNasc').datepicker({ dateFormat: 'yy-mm-dd', changeYear: true });
    });
</script>