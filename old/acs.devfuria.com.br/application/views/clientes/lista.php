<!-- Coluna da direita -->
<div id="content">

    <div class="post">
        <!-- Titulo do post -->
        <h2 class="title">Lista de clientes</h2>

        <!-- Rodape do titulo -->
        <p class="meta">
            <span class="left"></span>
            <span class="right"><?php echo anchor('clientes/formulario/', 'Inserir novo cliente.')?></span>
        </p>
        <div style="clear: both;">&nbsp;</div>

        <!-- Conteudo do post -->
        <div class="entry">

            <!-- Tabela modelo -->
            <table class="default-table" cellpadding="0" cellspacing="0" border="0">
                
                <!-- Cabecalho -->
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Nome do cliente</th>
                        <th>Créditos</th>
                        <th>Usados</th>
                        <th>Restam</th>
                        <th>Status</th>
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($clientes As $cliente): ?>
                     <tr class="<?php echo alternator('', 'zebra') ?>">
                        <td><a href=""></a></td>
                        <td><?php echo $cliente->nome ;?></td>
                        <td><?php echo $cliente->credito ;?></td>
                        <td><?php echo $cliente->debito ;?></td>
                        <td><?php echo ($cliente->credito - $cliente->debito) ;?></td>
                        <td><?php echo $cliente->status ;?></td>
                        <td><?php echo anchor('clientes/deletar/'.$cliente->id, 'deletar')?></td>
                        <td><?php echo anchor('clientes/formulario/'.$cliente->id, 'alterar')?></td>
                    </tr>                 
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end table.default -->
        </div>
        <!-- end div.entry -->
    </div>
    <!-- end div.post -->
</div>
<!-- end div#content -->