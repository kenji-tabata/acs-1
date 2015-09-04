<!-- Coluna da direita -->
<div id="content">

    <div class="post">
        <!-- Titulo do post -->
        <h2 class="title">Lista de usuários</h2>

        <!-- Rodape do titulo -->
        <p class="meta">
            <span class="left"></span>
            <span class="right"><?php echo anchor('usuarios/formulario/', 'Inserir novo usuário.') ?></span>
        </p>
        <div style="clear: both;">&nbsp;</div>

        <!-- Conteudo do post -->
        <div class="entry">

            <!-- Tabela Usuários -->
            <table class="default-table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Status</th>
                        <th>Tipo</th>
                        
                        <?php if($this->session->userdata('cliente_master')): ?>
                            <th>Cliente</th>
                        <?php endif; ?>                        
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->load->helper('string'); ?>
                    <?php $this->load->helper('text'); ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="<?php echo alternator('', 'zebra') ?> <?php echo $usuario->status; ?>">
                            <td>&nbsp;</td>
                            
                            <td title="<?php echo $usuario->nome ?>"><?php echo character_limiter($usuario->nome,    15) ?></td>
                            <td title="<?php echo $usuario->usuario ?>"><?php echo character_limiter($usuario->usuario, 15) ?></td>
                            <td><?php echo $usuario->status ?></td>
                            <td><?php echo $usuario->tipo ?></td>
                            
                            <?php if($this->session->userdata('cliente_master')): ?>
                                <td title="<?php echo $usuario->nome_cliente ?>"><?php echo character_limiter($usuario->nome_cliente, 15) ?></td>
                            <?php endif; ?>
                                
                            <td><?php echo anchor('usuarios/deletar/' . $usuario->id, 'Deletar') ?></td>
                            <td><?php echo anchor('usuarios/formulario/' . $usuario->id, 'Alterar') ?></td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end Tabela Usuários -->
        </div>
        <!-- end div.entry -->
    </div>
    <!-- end div.post -->
    <div style="clear: both;">&nbsp;</div>
</div>
<!-- end div#content -->
