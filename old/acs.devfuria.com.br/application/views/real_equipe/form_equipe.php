<div id="real-equipe-dialog-modal" class="ui-widget" title="<?php echo $titulo ?>">
    
    <form id="real-equipe-dialog-form">
        
        <p>Preencha o nome da equipe e forme a mesma utilizando as colunas abaixo.</p>
        
        <input type="hidden" id="real-equipe-dialog-id" name="real-equipe-dialog-id" value="<?php echo isset ($equipe_dados->id) ? $equipe_dados->id : ''  ?>" />
        <input type="hidden" id="real-equipe-dialog-id-cliente" name="real-equipe-dialog-id-cliente" value="<?php echo $this->session->userdata('id_cliente') ?>" />
        <input type="hidden" id="real-equipe-dialog-status-equipe" name="real-equipe-dialog-status-equipe" value="<?php echo isset ($equipe_dados->status) ? $equipe_dados->status : 'nao_preenchido'  ?>" />
        
        <div class="erro"></div>
        
        <p>
            <label for="real-equipe-dialog-nome-equipe">Nome da equipe : </label>
            <input type="text" value="<?php echo isset ($equipe_dados->nome) ? $equipe_dados->nome : '' ?>" name="real-equipe-dialog-nome-equipe" id="real-equipe-dialog-nome-equipe" class="text ui-widget-content ui-corner-all" style="width: 750px;" />
        </p>
        
        <p class="meta legenda">
            Arraste os pesquisados da lista da direita, para a lista da esquerda e forme uma equipe. 
            Depois marque um pesquisado da equipe como líder, clicando duas vezes sobre o mesmo.
        </p>
        
        <div id="real-equipe-dialog-formando-equipe"> 
            <!-- Lista com os pesquisados que NAO sao da equipe -->
            <ul id="real-equipe-dialog-pesquisados" class='droptrue'>
                <legend class="real-equipe-dialog-cabecalho">Pesquisados</legend>
                <?php foreach($todos_pesquisados as $pesquisado): ?>
                    <li class="ui-state-highlight">
                        <?php echo $pesquisado->nome ?>
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id ?>][id-pesquisado]" class="real-equipe-hidden-id-pesquisado"     value="<?php echo $pesquisado->id ?>" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id ?>][str-resultado]" class="real-equipe-hiddens-str-resultado"    value="" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id ?>][lider]"         class="real-equipe-hiddens-lider"            value="nao" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id ?>][preenchido]"    class="real-equipe-hiddens-preenchido"       value="nao" />
                    </li>
                <?php endforeach; ?>    
            </ul>

            <!-- Lista com os pesquisados que SAO da equipe -->
            <ul id="real-equipe-dialog-equipe" class='droptrue'>
                <legend class="real-equipe-dialog-cabecalho">Equipe</legend>
                <?php foreach($equipe_pesquisados as $pesquisado): ?>
                    <li class="ui-state-highlight <?php echo ($pesquisado->lider == 'sim') ? 'lider' : '' ?>">
                        <?php echo $pesquisado->nome ?>
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id_pesquisado ?>][id-pesquisado]" class="real-equipe-hiddens-id-pesquisado"    value="<?php echo $pesquisado->id_pesquisado ?>" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id_pesquisado ?>][str-resultado]" class="real-equipe-hiddens-str-resultado"    value="<?php echo $pesquisado->str_resultado ?>" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id_pesquisado ?>][lider]"         class="real-equipe-hiddens-lider"            value="<?php echo $pesquisado->lider ?>" />
                        <input type="hidden" id="" name="pesquisado[<?php echo $pesquisado->id_pesquisado ?>][preenchido]"    class="real-equipe-hiddens-preenchido"       value="<?php echo $pesquisado->preenchido ?>" />
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- end #real-equipe-dialog-formando-equipe -->
        
    </form>
    <!-- end #real-equipe-dialog-form -->
    
</div>
<!-- end #real-equipe-dialog-modal -->

<!-- Javascript/Jquery que implementa o 'sortable', nele os pesquisados sao remanejados e/ou colocados como lider. -->
<script type="text/javascript">
    $(function() {
        $("ul.droptrue").sortable({
            connectWith: "ul",
            items: 'li',
            receive: function(e, ui){
                // Se passar um lider para a lista de pesquisados, o mesmo perde a lideranca.
                ui.item.context.className = 'ui-state-highlight';   // Retira a classe .lider
                ui.item.context.childNodes[5].defaultValue = 'nao'; // O hidden de lider passa a ter valor='nao'
            }
        });

        $("#real-equipe-dialog-pesquisados, #real-equipe-dialog-equipe").disableSelection();

        $("#real-equipe-dialog-equipe").delegate("li", "dblclick", function (){
            lider(this);
        });
        
        var lider = function(li){
            $this = $(li);
            
            // Em todos os elementos irmaoes, remove a classe lider o coloca 'nao' no valor do hidden-lider 
            $this.siblings().each(function(){
                var elemento = $(this);
                elemento.removeClass('lider');
                elemento.find('.real-equipe-hiddens-lider').attr('value', 'nao');
            });
            
            // Adiciona a classe lider no proprio elemento clicado, se ela nao estiver, ou retira caso ela ja esteja.
            $this.toggleClass('lider');
            
            // Toogle Para o Hidden: Muda a value do hidden lider no proprio elemento clicado para 'nao', se ela estiver 'sim', ou o contrario.
            var hidden = $this.find('.real-equipe-hiddens-lider');
            if(hidden.attr('value') == 'sim'){
                hidden.attr('value', 'nao');
            } else {
                hidden.attr('value', 'sim');
            }
            
        };
    });
</script>
