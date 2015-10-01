<!-- Coluna da direita -->
<div id="content">
    
        <div class="post">
            <!-- Titulo do post -->
            <h2 class="title">Formulário Usuário</h2>

            <!-- Conteudo do post -->
            <div class="entry">

                    <!-- Mensagens de erro -->
                    <div class="erro">
                        <?php echo validation_errors() ?>
                    </div>
                    <!-- end div.erro -->
                    
                    <?php $this->load->helper('form')?>
                    
                    <!-- Formulario Padrao -->
                    <form class="default-form" action="<?php echo base_url() . 'usuarios/salvar' ?>" method="post">
                        <fieldset>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($usuario->id) ? $usuario->id : ''; ?>" />
                            
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo set_value('nome', isset($usuario->nome) ? $usuario->nome : '' ) ?>" />

                            <label for="usuario">Usuário</label>
                            <input type="text" id="usuario" name="usuario" value="<?php echo set_value('usuario', isset($usuario->usuario) ? $usuario->usuario : '') ?>" />
                            
                            <label for="status">Status</label>
                            <?php echo form_dropdown('status',
                                                     array("" => "Selecione uma opção", "ativo" => 'Ativo', "desativado" => 'Desativado'),
                                                     set_value('status', isset($usuario->status) ? $usuario->status : ''),
                                                     'id="status"'); ?>

                            <label for="tipo">Tipo</label>
                            <?php echo form_dropdown('tipo',
                                                     array("" => "Selecione uma opção", "master" => 'Master', "admin" => 'Administrador'),
                                                     set_value('tipo', isset($usuario->tipo) ? $usuario->tipo : ''),
                                                     'id="tipo"'); ?>
                            
                            <?php if($this->session->userdata('cliente_master')): ?>
                                <label for="cliente">Cliente</label>
                                <?php $combo_cliente = array('' => 'Selecione uma opção') ?>
                                
                                <?php foreach($clientes as $cliente): ?>
                                    <?php $combo_cliente[$cliente->id] = $cliente->nome ?>
                                <?php endforeach; ?>
                                
                                <?php echo form_dropdown('id_cliente',
                                                         $combo_cliente,
                                                         set_value('id_cliente', isset($usuario->id_cliente) ? $usuario->id_cliente : ''),
                                                         'id="id_cliente"'); ?>
                            <?php else: ?> 
                                <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo isset($usuario->id_cliente) ? $usuario->id_cliente : $this->session->userdata('id_cliente') ?>" />
                            <?php endif; ?>     
                                
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
