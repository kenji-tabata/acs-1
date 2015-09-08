<!-- Coluna da direita -->
<div id="content">

    <div class="post">
        <!-- Titulo do post -->
        <h2 class="title">Lista de pesquisados</h2>

        <!-- Rodape do titulo -->
        <p class="meta">
            <span class="left"></span>
            <span class="right"><?php echo anchor('pesquisados/formulario/', 'Inserir novo pesquisado.') ?></span>
        </p>
        <div style="clear: both;">&nbsp;</div>

        <!-- Conteudo do post -->
        <div class="entry">

            <!-- Tabela Pesquisados -->
            <table class="default-table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        
                        <!--
                        <?php
                        /*
                         * Vide anotação logo abaixo
                         */
                        ?>
                        <?php #if($this->session->userdata('cliente_master')): ?>
                            <th>Cliente</th>
                        <?php #endif; ?>
                        -->
                        
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cpf</th>
                        <th>Sexo</th>
                        
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->load->helper('string'); ?>
                    <?php #$this->load->helper('string_limiter'); ?>
                    <?php $this->load->helper('text'); ?>
                    <?php foreach ($pesquisados as $pesquisado): ?>
                        <tr class="<?php echo alternator('', 'zebra') ?> ">
                            <td>+</td>
                            
                            
                            <?php
                            /*
                             * Nem o cliente master nem os demais clientes
                             * devem ver na lista o campo $pesquisado->nome_cliente.
                             * 
                             * Cada cliente enxerga na lista apenas seus respectivos pesquisados
                             * 
                             */
                            ?>
                            <!--
                            <?php #if($this->session->userdata('cliente_master')): ?>
                                <td title="<?php #echo $pesquisado->nome_cliente ?>"><?php #echo string_limiter($pesquisado->nome_cliente, 15) ?></td>
                            <?php #endif; ?>
                            -->
                            <td title="<?php echo $pesquisado->nome  ?>"><?php echo $pesquisado->nome ?></td>
                            <td title="<?php echo $pesquisado->email ?>"><?php echo $pesquisado->email ?></td>
                            <td><?php echo $pesquisado->cpf     ?></td>
                            <td title="<?php echo $pesquisado->sexo ?>"><?php echo $pesquisado->sexo ?></td>
                            
                            <td><?php echo anchor('pesquisados/deletar/' . $pesquisado->id, 'Deletar') ?></td>
                            <td><?php echo anchor('pesquisados/formulario/' . $pesquisado->id, 'Alterar') ?></td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end table.default -->
        </div>
        <!-- end div.entry -->
    </div>
    <!-- end div.post -->
    <div style="clear: both;">&nbsp;</div>

</div>
<!-- end div#content -->
