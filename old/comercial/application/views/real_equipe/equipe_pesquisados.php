<!-- Links para os pesquisados -->
<tr class="links_formularios">
    <td class="links_formularios" colspan="7">
        <table class="links_formularios">
            <tr>
                <th>Nome</th>
                <th>Preenchido</th>
                <th>Líder</th>
                <th>Formulários</th>
            </tr>
            <?php foreach ($pesquisados as $pesquisado): ?>
                <tr>
                    <td><?php echo $pesquisado->nome ?></td>
                    <td><?php echo $pesquisado->preenchido ?></td>
                    <td><?php echo $pesquisado->lider ?></td>
                    <td>
                        <a href="<?php echo base_url().'real_equipe/real_equipe/'
                                        .'formulario_pesquisado/'
                                        .$id_real_equipe.'/'
                                        .$pesquisado->id_pesquisado 
                                 ?>">
                            Formulário
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" class="center">
                    <?php echo base_url()."formulario/realequipe/".$cliente->url_form_terc."/".$id_real_equipe ?>
                </td>
            </tr>    
        </table>
    </td>
</tr>