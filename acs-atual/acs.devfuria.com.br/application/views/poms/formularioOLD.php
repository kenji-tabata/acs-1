                    <!-- Coluna Master, coluna unica -->
                    <div id="content-master">

                            <div class="post">
                                    <!-- Titulo do post -->
                                    <h2 class="title">Formulário</h2>

                                    <!-- Rodape do titulo -->
                                    <p class="meta">
                                        <span class="left">
                                            <b>Pesquisado:</b><br />
                                            Nome: <?php echo $pesquisado->nome ?><br />
                                            Email: <?php echo $pesquisado->email ?><br />
                                            Cpf: <?php echo $pesquisado->cpf ?><br />
                                            Sexo: <?php echo $pesquisado->sexo ?><br />

                                            <b>Instruções:</b><br />
                                            Preencha todos os adjetivos com valores de 1 a 5, conforme a legenda ao lado.<br />
                                        </span>
                                        <span class="right legenda">
                                            <b>Legenda:</b><br />
                                            1 = Extremamente baixo.<br />
                                            2 = Baixo.<br />
                                            3 = Médio.<br />
                                            4 = Alto.<br />
                                            5 = Extremamente alto.
                                        </span>
                                        <b id="status-poms-form" style="clear: both;" class="left <?php echo isset($poms_pesquisado->status) ? $poms_pesquisado->status: 'nao_preenchido' ?>">
                                            Status: <?php echo isset($poms_pesquisado->status) ? $poms_pesquisado->status: 'nao preenchido' ?>
                                        </b>
                                        <b class="right">
                                            <a style="color: red;" href="<?php echo base_url().'poms/poms/deletar/'.$pesquisado->id ?>">Deletar fomulário.</a>
                                        </b>
                                    </p>
                                    <div style="clear: both;">&nbsp;</div>

                                    <!-- Mensagens de erro -->
                                    <div class="erro" style="display: none;">
                                        <p>Você deve pontuar todos os adjetivos, verifique os adjetivos que estão em vermelho e pontue-os antes de salvar o formulário.</p>
                                    </div>
                                    <!-- end div.erro -->

                                    <!-- Caso o status esteja processado o usuario sera alertado com a mensagem abaixo. -->
                                    <div id="dialog-poms-form" title="Formulário processado">
                                        <p>
                                            Este fomulário já foi preenchido e processado, portanto seu resultado esta disponível.
                                            Caso você salve novamente este formulário, o mesmo voltará para o status preenchendo e precisará ser processado novamente.
                                        </p>
                                    </div>

                                    <!-- Conteudo do post -->
                                    <div class="entry">

                                        <!-- Formulario POMS -->
                                        <form id="form-poms" class="default-form" action="<?php echo base_url().'poms/poms/salvar' ?>" method="post">
                                            <fieldset>
                                                <input type="hidden" name="id_pesquisado" value="<?php echo $pesquisado->id ?>" />

                                                <!-- Lista de Adjetivos -->
                                                <div id="adjetivos-poms">
                                                    <?php $i = 22;?>
                                                    <?php $nr_coluna = 1;?>
                                                    <?php foreach ($adjetivos_nomes as $adjetivo_nr => $adjetivo_nome): ?>
                                                            <?php echo ($i % 22 == 0 && $nr_coluna != 1) ? '</div>' : '' ?>
                                                            <?php echo ($i++ % 22 == 0) ? '<div id="col'.$nr_coluna++.'">' : '' ?>
                                                                <div class="adjetivo-poms" id="<?php echo $adjetivo_nome ?>">
                                                                    <label class="adjetivos-nomes-poms">
                                                                        <?php echo ucfirst($adjetivo_nome) ?>
                                                                        <span id="pontuacao-<?php echo $adjetivo_nome ?>" class="adjetivos-pontucao-poms"><?php echo isset($poms_pesquisado->str_resultado[$adjetivo_nr]) ? $poms_pesquisado->str_resultado[$adjetivo_nr] : '0' ?></span>
                                                                    </label>
                                                                    <div class="adjetivos-barras-poms" id="barra-<?php echo $adjetivo_nome ?>"></div>
                                                                    <input type="hidden" id="valor-<?php echo $adjetivo_nome ?>" class="valor-adjetivo-poms" name="<?php echo $adjetivo_nr ?>" value="<?php echo isset($poms_pesquisado->str_resultado[$adjetivo_nr]) ? $poms_pesquisado->str_resultado[$adjetivo_nr] : '0' ?>" />
                                                                </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <!-- end div#adjetivos -->
                                                <div style="clear: both;">&nbsp;</div>

                                                <input type="submit" id="salvar" name="salvar" class="botao" value="Salvar" />

                                            </fieldset>
                                        </form>
                                        <!-- end Formulario POMS -->

                                    </div>
                                    <!-- end div.entry -->
                            </div>
                            <!-- end div.post -->

                    </div>
                    <!-- end div#content-master -->
                    <div style="clear: both;">&nbsp;</div>