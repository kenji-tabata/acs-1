<!-- Coluna da direita -->
<div id="content">

    <div class="post">
        <!-- Titulo do post -->
        <h2 class="title">Formulário Cliente</h2>

        <!-- Conteudo do post -->
        <div class="entry">
            <!-- Mensagens de erro -->
            <div class="erro">
                <?php echo validation_errors() ?>
            </div>
            <!-- end div.erro -->

            <!-- Formulario Padrao -->
            <?php $this->load->helper('form')?>            
            <form class="default-form" action="<?php echo base_url() . 'clientes/salvar' ?>" method="post">
                <fieldset>
                    
                    <input type="hidden" id="id" name="id" value="<?php echo isset($cliente->id) ? $cliente->id : '' ?>" />
                    
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?php echo set_value('nome', isset($cliente->nome) ? $cliente->nome : '') ?>" />

                    <label for="url_form_terc">URL do formulário <span style="font-weight: bolder;">www.acs.net.br/comercial/formulario/método/</span></label>
                    <input type="text" id="url_form_terc" name="url_form_terc" value="<?php echo set_value('url_form_terc', isset($cliente->url_form_terc) ? $cliente->url_form_terc : '') ?>" />

                    <label for="credito">Créditos</label>
                    <input type="text" id="credito" name="credito" value="<?php echo set_value('credito', isset($cliente->credito) ? $cliente->credito : '') ?>" />
                    
                    <label for="status">Status</label>
                    <?php echo form_dropdown('status',
                                             array("" => "Selecione uma opção", "ativo" => 'Ativo', "desativado" => 'Desativado'),
                                             set_value('status', isset($cliente->status) ? $cliente->status : '')); ?>

                    <input type="submit" name="salvar" class="botao" value="Salvar" />
                </fieldset>
            </form>
            <!-- end form.default-form -->
        </div>
        <!-- end div.entry -->
    </div>
    <!-- end div.post -->

    <!-- end div.post -->
    <div style="clear: both;">&nbsp;</div>

</div>
<!-- end div#content -->