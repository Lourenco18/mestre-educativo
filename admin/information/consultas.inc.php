<?php
 $id = isset($_GET['id']) ? $_GET['id'] : '';
 
 $id_modal = isset($_GET['id_modal']) ? $_GET['id_modal'] : '';
 

//  consultas SQL para cada categoria
global $consultas;
$consultas = [
    'aluno' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.id_ano,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_turmainterna,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data_nascimento_aluno,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1 
)

SELECT 
    ar.foto_aluno,
    ar.id_aluno,
    ar.aluno,
    ar.id_ano,
    ar.data_nascimento_aluno,
    ar.unico,
    ar.id_turma,
    ar.id_escola,
    ar.id_turmainterna,
    ar.id_encarregadoeducacao,
    ar.id_ciclo,
    ar.data,
    ar.ativo,
    tr.*, 
    er.*, 
    cr.*, 
    cl.*, 
    eer.*, 
    rr.*, 
    anr.*, 
    cir.* 
FROM 
    AlunoRecente ar
INNER JOIN 
    turma tr ON ar.id_turma = tr.id_turma
           AND tr.id_turma = (SELECT id_turma FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    escola er ON ar.id_escola = er.id_escola
           AND er.id_escola = (SELECT id_escola FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    turmainterna cr ON ar.id_turmainterna = cr.id_turmainterna
           AND cr.id_turmainterna = (SELECT id_turmainterna FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    colaborador cl ON cr.id_colaborador = cl.id_colaborador
           AND cl.id_colaborador = (SELECT id_colaborador FROM turmainterna WHERE id_turmainterna = cr.id_turmainterna AND rn = 1)
INNER JOIN 
    encarregadoeducacao eer ON ar.id_encarregadoeducacao = eer.id_encarregadoeducacao
           AND eer.id_encarregadoeducacao = (SELECT id_encarregadoeducacao FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    relacao rr ON eer.id_relacao = rr.id_relacao
           AND rr.id_relacao = (SELECT id_relacao FROM encarregadoeducacao WHERE id_encarregadoeducacao = eer.id_encarregadoeducacao AND rn = 1)
INNER JOIN 
    ciclo cir ON ar.id_ciclo = cir.id_ciclo
           AND cir.id_ciclo = (SELECT id_ciclo FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    ano anr ON ar.id_ano = anr.unico
           AND anr.unico = (SELECT id_ano FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
WHERE 
    ar.rn = 1 
ORDER BY 
    ar.aluno ASC;


',
    'myaluno' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.id_ano,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_turmainterna,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data_nascimento_aluno,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1 
)   SELECT * from AlunoRecente inner join turmainterna on turmainterna.id_turmainterna = AlunoRecente.id_turmainterna inner join colaborador on colaborador.id_colaborador = turmainterna.id_colaborador inner join encarregadoeducacao on encarregadoeducacao.id_encarregadoeducacao = AlunoRecente.id_encarregadoeducacao inner join escola on escola.id_escola = AlunoRecente.id_escola inner join ano on ano.id_ano = AlunoRecente.id_ano ORDER BY AlunoRecente.aluno ASC;

',
 








    'alunoinative' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.id_ano,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_turmainterna,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data_nascimento_aluno,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1 
)

SELECT 
    ar.foto_aluno,
    ar.id_aluno,
    ar.aluno,
    ar.id_ano,
    ar.data_nascimento_aluno,
    ar.unico,
    ar.id_turma,
    ar.id_escola,
    ar.id_turmainterna,
    ar.id_encarregadoeducacao,
    ar.id_ciclo,
    ar.data,
    ar.ativo,
    tr.*, 
    er.*, 
    cr.*, 
    cl.*, 
    eer.*, 
    rr.*, 
    anr.*, 
    cir.* 
FROM 
    AlunoRecente ar
INNER JOIN 
    turma tr ON ar.id_turma = tr.id_turma
           AND tr.id_turma = (SELECT id_turma FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    escola er ON ar.id_escola = er.id_escola
           AND er.id_escola = (SELECT id_escola FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    turmainterna cr ON ar.id_turmainterna = cr.id_turmainterna
           AND cr.id_turmainterna = (SELECT id_turmainterna FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    colaborador cl ON cr.id_colaborador = cl.id_colaborador
           AND cl.id_colaborador = (SELECT id_colaborador FROM turmainterna WHERE id_turmainterna = cr.id_turmainterna AND rn = 1)
INNER JOIN 
    encarregadoeducacao eer ON ar.id_encarregadoeducacao = eer.id_encarregadoeducacao
           AND eer.id_encarregadoeducacao = (SELECT id_encarregadoeducacao FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    relacao rr ON eer.id_relacao = rr.id_relacao
           AND rr.id_relacao = (SELECT id_relacao FROM encarregadoeducacao WHERE id_encarregadoeducacao = eer.id_encarregadoeducacao AND rn = 1)
INNER JOIN 
    ciclo cir ON ar.id_ciclo = cir.id_ciclo
           AND cir.id_ciclo = (SELECT id_ciclo FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
INNER JOIN 
    ano anr ON ar.id_ano = anr.unico
           AND anr.unico = (SELECT id_ano FROM AlunoRecente WHERE unico = ar.unico AND rn = 1)
WHERE 
    ar.rn = 1 
ORDER BY 
    ar.aluno ASC;
',




    'alunoremoved' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.id_ano,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_turmainterna,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data_nascimento_aluno,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 0 and removed = 1
)   SELECT * from AlunoRecente inner join turmainterna on turmainterna.id_turmainterna = AlunoRecente.id_turmainterna inner join colaborador on colaborador.id_colaborador = turmainterna.id_colaborador inner join encarregadoeducacao on encarregadoeducacao.id_encarregadoeducacao = AlunoRecente.id_encarregadoeducacao inner join escola on escola.id_escola = AlunoRecente.id_escola inner join ano on ano.id_ano = AlunoRecente.id_ano ORDER BY AlunoRecente.aluno ASC;


',





//FIM DOS ALUNOS


//FIMM DOS ALUNOS







    'encarregadoeducacao' => 'WITH EncarregadoEducacaoRecente AS (
        SELECT 
            encarregadoeducacao.*, 
            ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
        FROM 
            encarregadoeducacao
        WHERE  encarregadoeducacao.removed = 0 and
            encarregadoeducacao.ativo = 1
    )
    SELECT 
        eer.*, 
        relacao.*
    FROM 
        EncarregadoEducacaoRecente eer
    INNER JOIN 
        relacao ON eer.id_relacao = relacao.unico
    WHERE 
        eer.rn = 1',
        'turmainterna' => 'SELECT * FROM turmainterna INNER JOIN colaborador ON colaborador.id_colaborador = turmainterna.id_colaborador WHERE turmainterna.ativo = 1  ',
         'colaborador' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1  Order by colaborador.colaborador ASC',
         'professor' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 3',
    'motorista' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 4',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'servico' =>'SELECT * from servico where ativo = 1 order by data DESC',
    'servicoaluno' =>'SELECT * from servicoaluno inner join aluno on aluno.unico = servicoaluno.id_aluno inner join servico on servico.id_servico = servicoaluno.id_servico  where servicoaluno.ativo = 1 order by servicoaluno.data DESC',
    'pagamento'=> 'SELECT * from pagamento inner join servicoaluno on servicoaluno.id_servicoaluno = pagamento.id_servicoaluno inner join aluno on aluno.unico = servicoaluno.id_aluno where aluno.ativo = 1',
    'localidade'=>'SELECT * from localidade where ativo = 1 ',
    'distrito'=>'SELECT * from distrito where ativo = 1 ',
    'especialidade'=>'SELECT * from especialidade where ativo = 1 ',
    'nacionalidade'=>'SELECT * from nacionalidade where ativo = 1 ',
    'turma' => 'SELECT * FROM turma  inner join escola on escola.unico = turma.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao   WHERE operacao.ativo = 1 and operacao.removed = 0 Order by ordem ASC',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.removed =0 AND permissao.ativo = 1',
    'disciplina'=> 'SELECT * FROM disciplina inner join ciclo on disciplina.id_ciclo = ciclo.unico WHERE disciplina.ativo = 1',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 1 ',
    'cargo'=> 'SELECT * FROM cargo  WHERE ativo = 1 ',

    'encarregadoeducacaoremoved' => 'WITH EncarregadoEducacaoRecente AS (
        SELECT 
            encarregadoeducacao.*, 
            ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
        FROM 
            encarregadoeducacao
        WHERE  encarregadoeducacao.removed = 1 AND
            encarregadoeducacao.ativo = 0
    )
    SELECT 
        eer.*, 
        relacao.*
    FROM 
        EncarregadoEducacaoRecente eer
    INNER JOIN 
        relacao ON eer.id_relacao = relacao.unico
    WHERE 
        eer.rn = 1',
    
    
    'servicoremoved' =>'SELECT * from servico where ativo = 0 AND removed = 1 order by data DESC',
    'servicoalunoremoved' =>'SELECT * from servicoaluno inner join aluno on aluno.unico = servicoaluno.id_aluno inner join servico on servico.id_servico = servicoaluno.id_servico  where servicoaluno.ativo = 0 AND servicoaluno.removed = 1 order by servicoaluno.data DESC',
    'pagamentoremoved'=> 'SELECT * from pagamento inner join servicoaluno on servicoaluno.id_servicoaluno = pagamento.id_servicoaluno inner join aluno on aluno.unico = servicoaluno.id_aluno where aluno.ativo = 0 AND aluno.removed = 1',
    'localidaderemoved'=>'SELECT * from localidade where ativo = 0 AND removed = 1 ',
    'distritoremoved'=>'SELECT * from distrito where ativo = 0 AND removed = 1 ',
    'especialidaderemoved'=>'SELECT * from especialidade where ativo = 0 AND removed = 1 ',
    'nacionalidaderemoved'=>'SELECT * from nacionalidade where ativo = 0 AND removed = 1 ',
    'turmaremoved' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 0 AND turma.removed = 1',
    'operacaoremoved'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 0 AND removed = 1 Order by ordem ASC',
    'permissaoremoved'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.removed =1 AND permissao.ativo = 0',
    'disciplinaremoved'=> 'SELECT * FROM disciplina inner join ciclo on disciplina.id_ciclo = ciclo.unico WHERE disciplina.ativo = 0 AND disciplina.removed = 1',
    'transporteremoved'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 0 AND removed = 1 ',
    'cargoremoved'=> 'SELECT * FROM cargo  WHERE ativo = 0 AND removed = 1 ',
    'escola' => 'SELECT * FROM escola WHERE ativo = 1 ',
    'removed' => 'SELECT * FROM escola WHERE ativo = 0 AND removed = 1 ',
    'turmainternaremoved' => 'SELECT * FROM turmainterna INNER JOIN colaborador ON colaborador.id_colaborador = turmainterna.id_colaborador WHERE turmainterna.ativo = 0 and turmainterna.removed = 1 ',
];
if (isset($id_unico_aluno)) {
    $consultas['pessoa'] = 'SELECT 
        pessoa.id_pessoa,
        pessoa.id_aluno, 
        pessoa.data,
        pessoa.pessoa, 
        pessoa.telefone_pessoa, 
        pessoa.unico AS unico_pessoa, 
        relacao.relacao 
    FROM 
        pessoa 
    INNER JOIN 
        relacao 
    ON 
        relacao.id_relacao = pessoa.id_relacao 
    WHERE 
        pessoa.ativo = 1 
        AND pessoa.removed = 0 
        AND pessoa.id_aluno = ' . $id_unico_aluno . ' 
        AND pessoa.data = (
            SELECT MAX(p2.data)
            FROM pessoa p2
            WHERE p2.unico = pessoa.unico
        )';
}

  



    
$consultasForms = [
    'servico' =>'SELECT * from servico where id_servico = '.$id.' order by data DESC',
    'aluno' => 'SELECT * 
    FROM aluno 
   
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.unico
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.unico
    INNER JOIN genero ON Genero.unico = aluno.id_genero
    INNER JOIN localidade ON Localidade.unico = aluno.id_localidade
    INNER JOIN escola ON escola.unico = aluno.id_escola
    INNER JOIN nacionalidade ON nacionalidade.unico = aluno.id_nacionalidade
    INNER JOIN turma ON turma.unico = aluno.id_turma
    Where  aluno.id_aluno = ' . $id . '',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.id_encarregadoeducacao = ' . $id . '',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1 and colaborador.id_colaborador = ' . $id . '',
    'escola' => 'SELECT * FROM escola WHERE id_escola = ' . $id . ' ',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.id_turma = ' . $id . '',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.id_operacao = ' . $id . ' ',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = '.$id.' ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.id_cargo = '.$id.' ',
    'pessoa'=> 'SELECT * FROM pessoa  WHERE id_pessoa = '.$id_modal.' ',  
    'disciplina' => 'SELECT * from disciplina inner join ciclo on ciclo.id_ciclo = disciplina.id_ciclo where disciplina.id_disciplina = '.$id.' ',
    'localidade' => 'SELECT * from localidade where id_localidade = '.$id.'',
    'distrito' => 'SELECT * from distrito where id_distrito = '.$id.'',
    'especialidade' => 'SELECT * from especialidade where id_especialidade = '.$id.'',
    'nacionalidade' => 'SELECT * from nacionalidade where id_nacionalidade = '.$id.'',
    'professor' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.id_colaborador = '.$id.'  ',
    'motorista' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.id_colaborador = '.$id.'  ',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.id_colaborador = '.$id.'  ',
    'turmainterna' => 'SELECT * FROM turmainterna INNER JOIN colaborador ON colaborador.id_colaborador = turmainterna.id_colaborador WHERE turmainterna.id_turmainterna = '.$id.'  ',
    
  ];
  if(isset($id_unico)){
    $consultasHistorico = [
        'aluno' => 'SELECT 
    aluno.*, 
    aluno.data AS data_aluno,
    colaborador.colaborador AS nome_orientador_anterior,
    encarregadoeducacao.encarregadoeducacao AS nome_encarregado_anterior,
    relacao.relacao AS nome_relacao_anterior,
    genero.genero AS nome_genero_anterior,
    localidade.localidade AS nome_localidade_anterior,
    escola.escola AS nome_escola_anterior,
    nacionalidade.nacionalidade AS nome_nacionalidade_anterior,
    turma.turma AS nome_turma_anterior,
    distrito.distrito AS nome_distrito_anterior,
    
    ciclo.ciclo AS nome_ciclo_anterior,
    anoletivo.anoletivo AS nome_anoletivo_anterior
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.unico
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.unico
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.unico
    INNER JOIN genero ON genero.unico = aluno.id_genero
    INNER JOIN localidade ON localidade.unico = aluno.id_localidade
    INNER JOIN escola ON escola.unico = aluno.id_escola
    INNER JOIN nacionalidade ON nacionalidade.unico = aluno.id_nacionalidade
    INNER JOIN turma ON turma.unico = aluno.id_turma
    INNER JOIN distrito ON distrito.unico = aluno.id_distrito
    
    INNER JOIN ciclo ON ciclo.unico = aluno.id_ciclo
    INNER JOIN anoletivo ON anoletivo.unico = aluno.id_anoletivo
    WHERE aluno.unico = '.$id_unico.'
    AND colaborador.data = (
    SELECT MAX(data) 
    FROM colaborador 
    WHERE colaborador.unico = aluno.id_orientador
    )
    AND encarregadoeducacao.data = (
    SELECT MAX(data) 
    FROM encarregadoeducacao 
    WHERE encarregadoeducacao.unico = aluno.id_encarregadoeducacao
    )
    AND relacao.data = (
    SELECT MAX(data) 
    FROM relacao 
    WHERE relacao.unico = encarregadoeducacao.id_relacao
    )
    AND genero.data = (
    SELECT MAX(data) 
    FROM genero 
    WHERE genero.unico = aluno.id_genero
    )
    AND localidade.data = (
    SELECT MAX(data) 
    FROM localidade 
    WHERE localidade.unico = aluno.id_localidade
    )
    AND escola.data = (
    SELECT MAX(data) 
    FROM escola 
    WHERE escola.unico = aluno.id_escola
    )
    AND nacionalidade.data = (
    SELECT MAX(data) 
    FROM nacionalidade 
    WHERE nacionalidade.unico = aluno.id_nacionalidade
    )
    AND turma.data = (
    SELECT MAX(data) 
    FROM turma 
    WHERE turma.unico = aluno.id_turma
    )
    AND distrito.data = (
    SELECT MAX(data) 
    FROM distrito 
    WHERE distrito.unico = aluno.id_distrito
    )
    
    AND ciclo.data = (
    SELECT MAX(data) 
    FROM ciclo 
    WHERE ciclo.unico = aluno.id_ciclo
    )
    AND anoletivo.data = (
    SELECT MAX(data) 
    FROM anoletivo 
    WHERE anoletivo.unico = aluno.id_anoletivo
    )
    
    ORDER BY aluno.data DESC',
    
    ]
    ;
    
  }
  