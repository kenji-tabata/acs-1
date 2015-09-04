<!-- Coluna Master, coluna unica -->
<div id="content-master">

        <div class="post">
                <!-- Titulo do post -->
                <h2 class="title">Formulário</h2>

                <!-- Rodape do titulo -->
                <div class="meta">
                    <span class="right legenda">
                        <b>Legenda:</b><br />
                        A = Sempre.<br />
                        B = Frequentemente.<br />
                        C = Ocasionalmente.<br />
                        D = Raramente.<br />
                        E = Nunca.
                    </span>

                    <div class="instrucoes">
                        <p>
                            <b>Pesquisado:</b><br />
                            Nome: <?php echo $pesquisado_dados->nome ?><br />
                            Email: <?php echo $pesquisado_dados->email ?><br />
                            Cpf: <?php echo $pesquisado_dados->cpf ?><br />
                            Sexo: <?php echo $pesquisado_dados->sexo ?><br />
                            Equipe: <?php echo $equipe_dados->nome ?><br />
                        </p>
                        <p>
                            <b>Instruções:</b><br />
                            Abaixo existe uma lista de questões (frases) descritivas e objetivas associadas ao <span class="underline">Comportamento Ideológico de Liderança</span>
                            de pessoas com a imcumbência de comandar/liderar um grupo/equipe de trabalho dentro de grandes e pequenas organizações sociais.
                            Essa lista de questões abrange seis dimensões de comportamento de liderança: relacionamento humano, processo de execução de tarefas,
                            persuasão, tolerância de liberdade de ação, reconciliação e integração social. Cada questão proporciona cinco alternativas de múltipla
                            escolha: A = Sempre; B = Frequentemente; C = Ocasionalmente; D = Raramente; E = Nunca.
                        </p>
                        <p>
                            Leia com atenção o que está escrito em cada frase e assinale entre uma das cinco alternativas a que mais se aproxima daquilo que você adota como
                            sendo sua própria Ideologia de Liderança - Estilo de Comportamento de Liderança - à frente do seu Grupo/Equipe de trabalho. Marque uma das respostas
                            (A, B, C, D, E), e NÃO marque mais que uma letra na mesma frase. Preste atenção em responder cada frase e não tenha pressa - não há resposta certa ou
                            errada em cada frase - indique apenas a alternativa que melhor defina o seu "Ideal Próprio" em termos de liderar pessoas. É importante que você responda
                            a cada uma das questões da forma mais verdadeira possível.
                        </p>
                        <!-- Mensagens de erro -->
                        <div class="erro" style="display: none;">
                            <p>Você deve marcar uma opção em todas as frases, verifique as frases que estão em vermelho e marque uma opção antes de salvar o formulário.</p>
                        </div>
                        <!-- end div.erro -->
                        <?php if($pesquisado_real_equipe->lider == 'sim'): ?>
                            <p><b style="color: red;">Você como líder:</b></p>
                        <?php else: ?>
                            <p><b style="color: red;">Seu líder/chefe/manager: (<?php echo isset($lider->nome) ? $lider->nome : 'Não há um líder para esta equipe.' ?>)</b></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="clear: both;">&nbsp;</div>

                <!-- Caso o status esteja processado o usuario sera alertado com a mensagem abaixo. -->
                <div id="dialog-real-equipe-form" title="Formulário processado">
                    <p>
                        Este fomulário já foi preenchido e processado, portanto seu resultado esta disponível.
                        Caso você salve novamente este formulário, o mesmo voltará para o status preenchendo e precisará ser processado novamente.
                    </p>
                </div>

                <!-- Conteudo do post -->
                <div class="entry">

                    <!-- Formulario Real Equipe -->
                    <form id="form-real-equipe-pesquisados" class="default-form" action="<?php echo base_url().'real_equipe/real_equipe/formulario_pesquisado_salvar' ?>" method="post">
                        <fieldset>
                            <input type="hidden" id="id_real_equipe"    name="id_real_equipe"   value="<?php echo $pesquisado_real_equipe->id_real_equipe ?>" />
                            <input type="hidden" id="id_pesquisado"     name="id_pesquisado"    value="<?php echo $pesquisado_real_equipe->id_pesquisado ?>" />
                            <input type="hidden" id="lider" name="lider" value="<?php echo $pesquisado_real_equipe->lider ?>" />

                            <input type="hidden" id="equipe_status" name="equipe_status" value="<?php echo $equipe_dados->status ?>" />
                            <!-- Lista de Frases -->
                            <div id="real-equipe-container-todas-frases">

                                <?php foreach ($frases as $id_frase => $frase): ?>
                                <!-- Frase <?php echo $id_frase ?> -->
                                <div class="real-equipe-frases">
                                    <div class="real-equipe-frase">
                                        <label><?php echo $frase['frase'] ?></label>
                                    </div>
                                    <div class="real-equipe-pontuacao">
                                        <?php if($frase['invertida'] == 'nao'): ?>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '1') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_A" name="frases[<?php echo $id_frase ?>]" value="1" /><label for="<?php echo $id_frase ?>_A">A</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '2') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_B" name="frases[<?php echo $id_frase ?>]" value="2" /><label for="<?php echo $id_frase ?>_B">B</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '3') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_C" name="frases[<?php echo $id_frase ?>]" value="3" /><label for="<?php echo $id_frase ?>_C">C</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '4') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_D" name="frases[<?php echo $id_frase ?>]" value="4" /><label for="<?php echo $id_frase ?>_D">D</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '5') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_E" name="frases[<?php echo $id_frase ?>]" value="5" /><label for="<?php echo $id_frase ?>_E">E</label>
                                        <?php else: ?>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '5') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_A" name="frases[<?php echo $id_frase ?>]" value="5" /><label for="<?php echo $id_frase ?>_A">A</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '4') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_B" name="frases[<?php echo $id_frase ?>]" value="4" /><label for="<?php echo $id_frase ?>_B">B</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '3') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_C" name="frases[<?php echo $id_frase ?>]" value="3" /><label for="<?php echo $id_frase ?>_C">C</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '2') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_D" name="frases[<?php echo $id_frase ?>]" value="2" /><label for="<?php echo $id_frase ?>_D">D</label>
                                            <input type="radio" <?php echo (isset ($array_resultado[$id_frase])) ? ($array_resultado[$id_frase] == '1') ? "checked='checked'" : "" : "" ?> id="<?php echo $id_frase ?>_E" name="frases[<?php echo $id_frase ?>]" value="1" /><label for="<?php echo $id_frase ?>_E">E</label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- end div#real-equipe-container-todas-frases -->
                            <div style="clear: both;">&nbsp;</div>

                            <input type="submit" id="salvar" name="salvar" class="botao" value="Salvar" />

                        </fieldset>
                    </form>
                    <!-- end Formulario Real Equipe -->

                </div>
                <!-- end div.entry -->
        </div>
        <!-- end div.post -->

</div>
<!-- end div#content-master -->
<div style="clear: both;">&nbsp;</div>