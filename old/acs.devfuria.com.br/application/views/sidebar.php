<!-- Coluna da esquerda -->
<div id="sidebar">
    <!-- Todos elementos do sidebar -->
    <ul>
        <!-- Um elemento do sidebar -->
        <li>
            <h2>Gerenciando</h2>
            <!-- Menu auxiliar -->
            <ul>
                <li><?php echo anchor("pesquisados", "Pesquisados"); ?></li>
                <li><?php echo anchor("usuarios", "Usuários"); ?></li>
                
                <?php if($this->session->userdata('cliente_master')): ?>
                    <li><?php echo anchor("clientes", "Clientes");  ?></li>
                <?php endif; ?>
                    
                <li><?php echo anchor("usuarios/form_senha", "Alterar senha"); ?></li>
            </ul>
        </li>
    </ul>
</div>
<div style="clear: both;">&nbsp;</div>
<!-- end div#sidebar -->