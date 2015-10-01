            <?php
            $menu = array(
                        'inicio' =>         array('content' => 'Início',        'href' => 'inicio'),
                        'poms' =>           array('content' => 'Poms',          'href' => 'poms/poms'),
                        'real_equipe' =>    array('content' => 'Real Equipe',   'href' => 'real_equipe/real_equipe'),
//                        'coesao' =>         array('content' => 'Coesão',        'href' => 'coesao')
            );
            ?>
            <!-- Menu Superior -->
            <div id="menu">
                    <ul>
                            <?php foreach ($menu as $item => $conteudo): ?>
                                    <?php $class = ($item == $menu_ativo) ? 'current_page_item': '' ?>
                                    <li class="<?php echo $class ?>">
                                        <?php echo anchor($conteudo['href'], $conteudo['content']) ?>
                                    </li>
                            <?php endforeach; ?>
                            <li class="logoff"><?php echo anchor('acesso/logout', 'Sair') ?></li>
                    </ul>
            </div>
            <!-- end div#menu -->


            <div id="page">
            <div id="page-bgtop">
            <div id="page-bgbtm">