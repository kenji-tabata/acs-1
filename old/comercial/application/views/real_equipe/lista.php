<!-- Coluna Master, coluna unica -->
<div id="content-master">

        <div class="post">
                <!-- Titulo do post -->
                <h2 class="title">ACS - Comportamento Ideológico de liderança</h2>

                <!-- Rodape do titulo -->
                <p class="meta">
                    <!-- Esquerda -->
                    <span class="left">Tabela de equipes</span>
                    <!-- Direita -->
                    <span class="rigth" style="margin-left: 280px;"><a href="<?php echo base_url() ?>real_equipe/real_equipe/download_formulario_pdf/" >Baixar Formulário PDF</a></span>
                    <span class="right" style="margin-left: 100px;"><a href="#novaEquipe" class="real-equipe-form-equipe">Criar uma nova equipe.</a></span>
                </p>
                <div style="clear: both;">&nbsp;</div>

                <!-- Conteudo do post -->
                <div class="entry">

                        <!-- Tabela Real Equipe -->
                        <table id="real-equipe-lista-equipes" class="default-table" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Nome da equipe</th>
                                    <th>Status da equipe</th>
                                    <th>Editar equipe</th>
                                    <th>Preencher formulários</th>
                                    <th>Resultados</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $this->load->helper('string'); ?>
                                <?php $this->load->helper('inflector'); ?>
                                <?php foreach ($equipes as $equipe): ?>
                                    <tr class="<?php echo alternator('', 'zebra') . ' ' . $equipe->status ?>">
                                        <td>+</td>
                                        <td><?php echo $equipe->nome ?></td>
                                        <td><?php echo humanize($equipe->status) ?></td>
                                        <td><a class="real-equipe-form-equipe" href="real_equipe/formulario_equipe/<?php echo $equipe->id ?>">Editar</a></td>
                                        <td><a class="real-equipe-equipe-pesquisados" href="<?php echo base_url() ?>real_equipe/real_equipe/equipe_pesquisados/<?php echo $equipe->id ?>">Formulários</a></td>
                                        <td><?php
                                                switch ($equipe->status) {
                                                    case 'processado':
                                                        echo anchor('real_equipe/real_equipe/resultado/'.$equipe->id, 'Resultado', 'target="_blank"');
                                                        break;
                                                    case 'preenchido':
                                                        echo anchor('real_equipe/real_equipe/processar/'.$equipe->id, 'Processar');
                                                        break;
                                                    case 'nao_preenchido':
                                                        echo nbs();
                                                        break;
                                                    default:
                                                        echo nbs();
                                                        break;
                                                }
                                            ?>
                                        </td>
                                        <td><a href="<?php echo base_url() ?>real_equipe/real_equipe/deletar_equipe/<?php echo $equipe->id ?>">Deletar</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- end #real-equipe-lista-equipes -->
                </div>
                <!-- end div.entry -->
        </div>
        <!-- end div.post -->

        <div id="real-equipe-armazena-modal"></div>
        <div id="real-equipe-mensagens-erro"></div>

</div>
<!-- end div#content-master -->
<div style="clear: both;">&nbsp;</div>