<!-- Coluna Master, coluna unica -->
<div id="content-master">

    <div class="post">
        <!-- Titulo do post -->
        <h2 class="title">Sistema de diagnósticos e métricas dos estados de humor - POMS</h2>

        <!-- Rodape do titulo -->
        <p class="meta">
            <!-- Esquerda -->
            <span class="left"><?php echo base_url()."formulario/poms/".$cliente->url_form_terc ?></span>
            <!-- Direita -->
            <span class="rigth" style="margin-left: 280px;"><a href="<?php echo base_url() ?>poms/poms/download_formulario_pdf/" >Baixar Formulário PDF</a></span>
            <span class="rigth" style="margin-left: 40px;"><a href="<?php echo base_url() ?>poms/poms/resultado_grupo/" id="resultado-grupo-poms-lista">Resultado por grupo</a></span>

        </p>
        <div class="erro"></div>
        <div style="clear: both;">&nbsp;</div>

        <!-- Conteudo do post -->
        <div class="entry">

            <!-- Tabela POMS -->
            <table class="default-table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cpf</th>
                        <th>Sexo</th>
                        <th>Formulário</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->load->helper('string'); ?>
                    <?php foreach ($pesquisados as $pesquisado): ?>
                        <tr class="<?php echo alternator('', 'zebra') ?> <?php echo ($pesquisado->status) ? $pesquisado->status : 'nao_preenchido' ?>">
                            <td><?php echo ($pesquisado->status == 'processado') ? '<input type="checkbox" name="ids_pesquisados[]" value="' . $pesquisado->id . '" />' : nbs(); ?></td>
                            <td><?php echo $pesquisado->nome ?></td>
                            <td><?php echo $pesquisado->email ?></td>
                            <td><?php echo $pesquisado->cpf ?></td>
                            <td><?php echo $pesquisado->sexo ?></td>
                            <td><?php echo anchor('poms/poms/formulario/' . $pesquisado->id, 'Formulário') ?></td>
                            <td><?php
                    switch ($pesquisado->status) {
                        case 'processado':
                            echo anchor('poms/poms/resultado_individual/' . $pesquisado->id, 'Resultado', 'target="_blank"');
                            break;
                        case 'preenchido':
                            echo anchor('poms/poms/processar/' . $pesquisado->id, 'Processar');
                            break;
                        default:
                            echo nbs();
                            break;
                    }
                        ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end Tabela POMS -->
        </div>
        <!-- end div.entry -->
    </div>
    <!-- end div.post -->

</div>
<!-- end div#content-master -->
<div style="clear: both;">&nbsp;</div>