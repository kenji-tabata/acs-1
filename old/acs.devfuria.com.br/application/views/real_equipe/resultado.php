<?php


#$num_laudo = rand(1, 4);
#var_dump($num_laudo); die();


# Criando os quatro tipos de laudos
$laudos = array();
$laudos[1] = new stdClass();
$laudos[2] = new stdClass();
$laudos[3] = new stdClass();
$laudos[4] = new stdClass();

$laudos[1]->tit_1 = "Perfil de Comportamento Ideológico de";
$laudos[1]->tit_2 = "Liderança do Líder: Autoritário Centralizador";
$laudos[1]->par   = "Ficou claramente demonstrado pelos dados obtidos pelo \"ACS-4\" que a atribuição de valores às tendências de comportamento ideológico de liderança do líder aponta para um Perfil de Liderança Cêntrica – Líder Autoritário. Preocupa-se em impor padrões definidos de organização, canais de comunicação e métodos de procedimentos sob diferentes condições de liberdade e escolha. Um padrão de comportamento ideológico de liderança que não dá muito ênfase para os relacionamentos e coesividade grupal, mas que analisa os problemas internos da organização do grupo e a coordenação dos esforços. Tende a encarar  e considerar seus liderados mais como produtos custo/benefícios do que como pessoas. Tem dificuldade em se orientar para atender as necessidades e expectativas dos seus liderados. O dilema básico desse Estilo de Liderança é a maneira pela qual o Líder usa seu poder de autoridade institucional, grupal e pessoal que pode afetar a capacidade produtiva do grupo e a manutenção de boas relações no contexto social e organizacional. Possui fortes qualidades de liderança e características psicossociais que oscilam constantemente entre o autoritarismo e a desistência para conquistar e manter o controle do seu grupo de trabalho. Predominam certas qualidades – como persistência e convicção - para impor e \"violentar\" valores e o respeito próprio de seus liderados. Costumam impor uma série de valores pessoais como fontes de influencias que afetam diretamente o comportamento e o desempenho grupal. Não possui atributos pessoais para delegar, negociar e resolver conflitos com capacidade de julgamento quanto à liberdade de participação dos seus liderados. Responde a pressão organizacional e grupal de maneira mais bitolada. Adota atitudes e condutas coercitivas visando à missão a ser cumprida porque se dedicam mais a execução de tarefas. Tende a desenvolver idéias práticas pela maneira que encara seu desempenho como líder de grupo. Isto nos leva a características psicossociais fundamentais desse estilo de liderança: um líder com tendências comportamentais para indicar problemas, considerar as opções que escolhe como sendo a única para solucionar problemas e diz a seus liderados o que devem fazer. Adota um padrão de comportamento de liderança autocrática, cujas atividades desenvolvidas pelos seus liderados são acompanhadas por pressões em relação às metas e a concretização dos objetivos pré-determinados. Adota uma política fechada quanto à participação e discussões coletivas. Essa tendência aponta para ações de comando centradas na execução de tarefas, cujas funções desenvolvidas pelos liderados são amplamente estruturadas. As ações de comando são evidenciadas por situações conflituosas, com todos os canais de comunicação partindo do líder. Grande parte das mudanças no grupo não ocorre sem esbarrar em obstáculos e resistência – em parte, porque esse estilo de comportamento de liderança não comprometimento afetivo relacional nas relações de gestão de recursos humanos. Um estilo de Liderança do tipo \"General Custer\" (nunca muda de estratégias visando solução de problemas, a exemplo do general da sétima cavalaria americana).  Um estilo de liderança motivado pelo desejo de sucesso pessoal, independente e que impõe padrões definidos de organização e métodos de procedimentos, cujas habilidades para solucionar problemas são mais \"instrumentais/executiva\" (atitudes e condutas voluntariosas, dominadoras e até certo ponto agressivas) do que comprometidas com respeito humano dos seus liderados.";

$laudos[2]->tit_1 = "Perfil de Comportamento Ideológico de";
$laudos[2]->tit_2 = "Liderança do Líder: Autoritário Participativo";
$laudos[2]->par   = "Os resultados obtidos pelo \"ACS-4\" apontam um estilo de liderança cêntrica participativa – líder autoritário participativo – com tendências ideológicas mais direcionadas para o processo de execução de tarefas,  mas que aceita a participação dos seus liderados em algumas situações operacionais relacionadas ao grau de controle mantido por ele no comando do grupo. As suas ações de comando determinam os padrões de comportamentos que devem ser seguido pelos seus liderados.  Possui atributos pessoais convencidas de que os liderados ou escolhidos devem assumir responsabilidade pelo peso de suas decisões.  Adota atitudes e condutas que diferem em relação a confiança que deposita nos seus liderados, verificam constantemente o conhecimento e a competência dos seus liderados para lidar com problemas relacionados a produção de resultados. Um estilo de liderança que tem uma necessidade relativamente grande de independência para delinear entre ele e seus liderados padrões definidos de organização, canais de comunicação e métodos de procedimentos e com pouca tolerância de liberdade de ação do seu grupo/equipe de trabalho. Tem tendência a decidir sobre as prioridades de objetivos que acentuam o crescimento individual de cada membro do seu grupo. Dá pouca ênfase ao comportamento indicativo de amizade, confiança mútua e respeito humano com um alto nível de centrismo nas suas características comportamentais de liderança de líder. O dilema básico desse Estilo de Liderança é a maneira pela qual o Líder usa seu poder de autoridade institucional, grupal e pessoal quanto a estrutura das relações de status social relativas à contribuição que cada liderado para se atingir os objetivos do grupo. Tem a manter ou violar as normas das quais dependem a segurança emocional. Possui características psicossociológicas que indicam facilidade de para impor canais de comunicação, capacidade de julgamento, realizações e desejos de excelência a serem atingidos para persuadir e manter sob controle seus liderados. Esse perfil chama à atenção para tendência do líder desempenhar bem suas obrigações profissionais, com impulso para tomar decisões e de se fazer entender perfeitamente por pessoas/liderados em vários níveis. Assume a responsabilidade e tende a desenvolver idéias práticas visando qualidade e quantidade de trabalho produzido com o uso do tempo. Essa tendência de comportamento de liderança  se conjuga com a capacidade de enfrentar mudanças e de se adaptar às situações inesperadas. Não se compromete com a disposição de liderar com criatividade e com sensibilidade constante aos acontecimentos tanto as informações técnicas quanto para as pessoas. Um estilo de liderança impulsionado pela necessidade e desejo de estabelecer metas,  alcançar objetivos e avaliar pessoas (liderados) em termos de como as atividades delas tendem a manter ou prejudicar a capacidade produtiva do grupo que tem um valor instrumental no processo, de solução de problemas para cada membro do grupo.  Enfim, um estilo de liderança autoritário com tendências a tomar decisoes impulsionadas por ações de comando voluntariosas, centralizadoras e até certo ponto coercitivas que presume que o poder pessoal e grupal que emana da posição institucional. ";

$laudos[3]->tit_1 = "Perfil de Comportamento Ideológico de";
$laudos[3]->tit_2 = "Liderança do Líder: Democrático Participativo";
$laudos[3]->par   = "Os resultados obtidos pelo \"ACS-4\" apontam para um Estilo de Liderança Democrática Participativa – Liderança direcionada  para  boas relações humanas (comportamento indicativo de amizade, confiança mútua e respeito humano entre ele e seus liderados), e direcionado para as execuções de tarefas. O dilema básico de estilo de liderança está entre o que o Líder  considera desejável como “Ideal Próprio” e as ações de comando que realmente adota à frente de seus liderados. Esse padrão de comportamento ideológico de liderança pode varia desde a concentração de poder até a participação mais acentuada dos seus liderados quanto aos problemas, interesses e a motivação predominante nos momentos de decisão. Tende a adotar atitudes de condutas mais compartilhadas nas suas decisões, fazendo uso moderado da sua autoridade como líder do grupo. Oportuniza que o grupo como um todo organizado adquira maior liberdade de expressão quanto ao equilíbrio de poder entre líder e liderados. Tendências próprias para delegar ao grupo o poder de escolhas das decisões. Um estilo de comportamento de liderança que sente necessidade e desejo de fazer previsões na maneira dos liderados lidarem com problemas orgânicos e funcionais. Adota atitudes e condutas geralmente são direcionadas tanto para manter a eficiência e eficácia do grupo como em levar adiante o processo de execução de tarefas a ser desenvolvido. Incentiva os liderados a expressar suas idéias e sentimentos, já que possui tendências ideológicas de liderança que levam a criatividade e dedicação no estabelecimento de metas. Seu comportamento de líder está direcionado para identificar os assuntos envolvidos e para descobrir as origens dos problemas ligados com relacionamento humano e processo de execução de tarefas. Tem tendência a decidir sobre as prioridades de objetivos que acentuam o crescimento individual de cada liderado dentro do contexto social e operacional do seu grupo. Ênfase em tomadas de decisão compartilhadas com o \"real equipe/grupo\", de maneira que seus liderados possam crescer com experiências coletivas. Tende a manter contatos diretos com seus liderados para a realização de atividade comum. Comprometido com a disposição de liderar com criatividade e com sensibilidade constante aos acontecimentos envolvendo relações interpessoais, confiança e apoio mútuo visando conseguir desenvolver um bom trabalho de equipe. O dilema desse perfil de comportamento ideológico de liderança é que suas ações variam desde uso de autoridade a liberdade do grupo – pela maneira que usa o seu poder de decisão que pode afetar a capacidade de produção do grupo quanto ao equilíbrio de poder entre líder e liderados. Um perfil de liderança que pode varia desde um Estilo de Líder Defensor (sendo ao lado dos liderados, oferecendo apoio emocional em situações difíceis) até um Estilo de Herói (sempre correndo para congratular seu grupo de liderados para que todos saibam que ele é responsável pelo sucesso grupal).";

$laudos[4]->tit_1 = "Perfil de Comportamento Ideológico de";
$laudos[4]->tit_2 = "Liderança do Líder: Democrático Liberal / \"Laissez-faire\"";
$laudos[4]->par   = "Os resultados obtidos pelo \"ACS-4\" apontam para um Estilo de Liderança Democrático Liberal / laissez-faire. Estilo de liderança direcionada para boas relações humanas (comportamento indicativo de amizade, confiança mútua e respeito humano entre ele e seus liderados) e processos de execuções de tarefas que procuram satisfazer as necessidades reais dos liderados, cujas ações de comando adotadas pelo líder não impõe autoridade que produz os resultados desejados. O dilema básico de estilo de liderança está entre a capacidade do Líder de adotar ações de comando que procurem impor padrões definidos de organização, canais de comunicação e métodos de procedimentos com responsabilidade de fazer com que o trabalho seja concretizado de maneira eficaz. Tendências próprias para delegar aos seus liderados/grupo o controle do processo de escolha de decisões, que reduz a possibilidade de prever os resultados esperados. Um Líder que não consegue adotar atitudes e condutas mais consiste para conduzir seus liderados. Por sua maneira de agir sofre pressão para fazer as coisas acontecerem. Está constantemente interessado em manter a eficácia do grupo, porque  tem tendências ideológicas de incentivar os membros do grupo a expressar suas ideias e sentimentos, porque acredita que seus liderados";
/* ========================================================================= */


#echo "<pre>";
#print_r($laudos);
#echo "</pre>";
#die();



/*
 * Aqui começa o laudo
 * Primeira página
 */
define("TITULO1", "LAUDO DE AVALIAÇÃO DE TENDÊNCIA DE COMPORTAMENTO IDEOLÓGICO DE");
define("TITULO2", "LIDERANÇA DO LÍDER -  \"ACS-4\"");
 
$fpdf->AddPage();

cabecalho($fpdf);
$pagMarEsquerda = 20;

$tit = "1.Descrição do Sistema de Diagnóstico e Métricas  \"ACS-4\".";
$par = "O \"ACS-4\" é um dispositivo de diagnóstico e métricas de avaliação do Comportamento Ideológico de Liderança do Líder, cujas ações de comando são direcionadas para processos de tomadas de decisoes, relações humanas e de execução de tarefas dentro de um contexto social e organizacional de desafios, limitações, liberdade e constrangimentos. Um sistema de diagnóstico e métricas preciso, rápido e informatizado, composto por cinqüenta frases descritivas e objetivas a respeito das ações de comando adotadas por um líder à frente de seus liderados. Um dispositivo que oferece um método padronizado para fazer comparações entre a própria ideologia de liderança descrita pelo Líder como \"Ideal Próprio\" e; a maneira pela qual o Real Grupo/Equipe (Liderados) avalia e categoriza o Estilo de Liderança do Líder dentro de uma  escala de comportamentos que oscila desde uma Liderança Cêntrica (Líder Cêntrico) a liberdade do grupo (Grupo Cêntrico). Trata-se de um dispositivo de avaliação que mensura tendências comportamentais de liderança – estilos de liderança – envolvidos com duas dimensões características do Comportamento dos Líderes: Relações Humanas (comportamentos indicativos de amizade, confiança mútua, respeito humano, etc.), e - Execução de Tarefas (padrões definidos de organização, canais de comunicação, métodos de procedimentos, etc.)  correlacionada com atributos pessoais ligados a Tolerância de Liberdade de Ação, Persuasão e Reconciliação que se combina para produzir quatro estilos de liderança: autoritário centralizador (líder cêntrico); autoritário participativo; democrático participativo; democrático Liberal / Laissez-faire.";

$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(0, 7, utf8_decode($tit), 0, 1);

$fpdf->SetFont('Arial','', 7);
$fpdf->Write(5, utf8_decode($par) );


$tit = "2. Apresentação e Discussão dos Resultados.";
$fpdf->Ln(7);
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(0, 10, utf8_decode($tit), 0, 1);

/*
 * Novo gráfico
 */
$real_equipe_graf_new->setNomeArquivo();
$real_equipe_graf_new->main($media_resultado);


// Gráfico com a média do grupo
$fpdf->Image($real_equipe_graf_new->getNomeArquivo(), $x=15, $y=95 , $w=60, $h=60);
$real_equipe_graf_new->deletar_imagem();


#
# Título de cada laudo
#
$fpdf->Cell(100);
$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, 5, utf8_decode($laudos[1]->tit_1), 0, 1);
$fpdf->Cell(100);

$fpdf->SetFont('Arial','', 7);
$fpdf->Cell(10, 5, utf8_decode($laudos[1]->tit_2), 0, 1);

$fpdf->Ln(50);


#
# Texto de cada laudo
#
$fpdf->SetFont('Arial','', 7);
$fpdf->Write(5, utf8_decode($laudos[1]->par));

/*

# Listagem dos fatores e sua pontuações que apareciam embaixo do gráfico

$ydim = 145;
$d_nome = array(
    "rh" => "Relações Humanas",
    "et" => "Executção de tarefas",
    "per" => "Perssuasivo",
    "rec" => "Reconciliador",
    "int" => "Intuitivo",
    "tof" => "Tolerância a falhas"
);

foreach($media_resultado as $dimensao_nome => $dimensao_valor){
    $ydim += 5;
    $fpdf->SetY($ydim);
    $fpdf->SetFont('Arial','', 7);

    $fpdf->SetX(20);
    $fpdf->Cell(100, 0, utf8_decode($d_nome[$dimensao_nome]), 0, 1);

    $fpdf->SetX(50);
    $fpdf->Cell(100, 0, $dimensao_valor, 0, 1);
}
*/




if(1==2){
/*
 *  Segunda página em diante
 */
rodape($fpdf);
$contador_pesq = 0;
$qtde_por_pag = 3;
$x_img = $pagMarEsquerda;
foreach($pesquisados as $pesquisado){

    if($contador_pesq % $qtde_por_pag == 0){
        $fpdf->AddPage();
        cabecalho($fpdf);

        $y_img = 50;
    } else {
        $y_img += 80;
    }


    /*
     *  Gráfico Individual - NOVO
     */
    $real_equipe_graf_new->setNomeArquivo();
    $real_equipe_graf_new->main( $pesquisado->resultado );

    $fpdf->Image($real_equipe_graf_new->getNomeArquivo(), $x_img, $y_img, 50, 50);
    $real_equipe_graf_new->deletar_imagem();

    /*
     *  Gráfico Individual - anterior
     */
//    $real_equipe_graf->setPontuacao();
//    $real_equipe_graf->setNomeArquivo();
//    $real_equipe_graf->setDisplay(Real_equipe_graf::GRAVAR_NO_DISCO);
//    $real_equipe_graf->display();
//
//    $fpdf->Image($real_equipe_graf->getNomeArquivo(), $x_img, $y_img, 50, 50);
//    $real_equipe_graf->deletar_imagem();

    // Dados do pesquisado
    $ht = 5;

    $fpdf->SetY($y_img);
    $fpdf->SetX(80);
    $fpdf->SetFont('Arial','', 7);
    $fpdf->Cell(100, $ht, utf8_decode('Nome: '.$pesquisado->nome), 0, 1);
    if($pesquisado->lider == "sim"){
        $fpdf->SetY($y_img+5);
        $fpdf->SetX(80);
        $fpdf->Cell(100, $ht, utf8_decode('LÍDER'), 0, 1);
    }


    if($contador_pesq % $qtde_por_pag == 0){
        rodape($fpdf);
    }

    $contador_pesq++;

}  # end foreach


}




/*
 * Display
 */
$fpdf->SetDisplayMode("fullpage", "single"); # Modo de visualização
$fpdf->Output();





/*
 *  Cabecalho
 */
function cabecalho($fpdf){
    $fpdf->SetFont('Arial','B', 11);
    $fpdf->Cell(0, 7, utf8_decode(TITULO1),  0, 1, "C");

    $fpdf->Cell(0, 7, utf8_decode(TITULO2), 0, 1, 'C');	

    $fpdf->Line(10, 25, 200, 25);
}

/*
 *  Rodape
 */
function rodape($fpdf){
    $fpdf->Line(10, 269, 200, 269);

    $fpdf->SetFont('Arial','',7);
    $fpdf->SetY(269 + 1);

    $impresso_em = date('d/m/Y').' às '.date('G:i').'hs';
    $fpdf->Cell(10, 2, "Impresso em ".utf8_decode($impresso_em).".");

    $fpdf->SetY(269 - 1.5);
    $fpdf->SetX(180);
    $fpdf->Cell(0, 7, utf8_decode("Página ".$fpdf->PageNo()));
}

?>