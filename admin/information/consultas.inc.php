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
        aluno.id_orientador,
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
),
TurmaRecente AS (
    SELECT 
        turma.*,
        ROW_NUMBER() OVER (PARTITION BY turma.unico ORDER BY turma.data DESC) AS rn
    FROM 
        turma
),
AnoRecente AS (
    SELECT 
        ano.*,
        ROW_NUMBER() OVER (PARTITION BY ano.unico ORDER BY ano.data DESC) AS rn
    FROM 
        ano
),
LocalidadeRecente AS (
    SELECT 
        localidade.*,
        ROW_NUMBER() OVER (PARTITION BY localidade.unico ORDER BY localidade.data DESC) AS rn
    FROM 
        localidade
),
NacionalidadeRecente AS (
    SELECT 
        nacionalidade.*,
        ROW_NUMBER() OVER (PARTITION BY nacionalidade.unico ORDER BY nacionalidade.data DESC) AS rn
    FROM 
        nacionalidade
),
CidadeRecente AS (
    SELECT 
        cidade.*,
        ROW_NUMBER() OVER (PARTITION BY cidade.unico ORDER BY cidade.data DESC) AS rn
    FROM 
        cidade
),
GeneroRecente AS (
    SELECT 
        genero.*,
        ROW_NUMBER() OVER (PARTITION BY genero.unico ORDER BY genero.data DESC) AS rn
    FROM 
        genero
),
EscolaRecente AS (
    SELECT 
        escola.*,
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) AS rn
    FROM 
        escola
),
ColaboradorRecente AS (
    SELECT 
        colaborador.*,
        ROW_NUMBER() OVER (PARTITION BY colaborador.unico ORDER BY colaborador.data DESC) AS rn
    FROM 
        colaborador
),
EncarregadoEducacaoRecente AS (
    SELECT 
        encarregadoeducacao.*,
        ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
    FROM 
        encarregadoeducacao
),
RelacaoRecente AS (
    SELECT 
        relacao.*,
        ROW_NUMBER() OVER (PARTITION BY relacao.unico ORDER BY relacao.data DESC) AS rn
    FROM 
        relacao
),
CicloRecente AS (
    SELECT 
        ciclo.*,
        ROW_NUMBER() OVER (PARTITION BY ciclo.unico ORDER BY ciclo.data DESC) AS rn
    FROM 
        ciclo
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
    ar.id_orientador,
    ar.id_encarregadoeducacao,
    ar.id_ciclo,
    ar.data,
    ar.ativo,
    tr.*,
    er.*,
    cr.*,
    eer.*,
    rr.*,
    anr.*,
    cir.*
FROM 
    AlunoRecente ar
INNER JOIN 
    TurmaRecente tr ON ar.id_turma = tr.unico AND tr.rn = 1
INNER JOIN 
    EscolaRecente er ON ar.id_escola = er.unico AND er.rn = 1
INNER JOIN 
    ColaboradorRecente cr ON ar.id_orientador = cr.unico AND cr.rn = 1
INNER JOIN 
    EncarregadoEducacaoRecente eer ON ar.id_encarregadoeducacao = eer.unico AND eer.rn = 1
INNER JOIN 
    RelacaoRecente rr ON eer.id_relacao = rr.unico AND rr.rn = 1
INNER JOIN 
    CicloRecente cir ON ar.id_ciclo = cir.unico AND cir.rn = 1
    INNER JOIN 
    AnoRecente anr ON ar.id_ano = anr.unico AND anr.rn = 1
WHERE 
    ar.rn = 1;

',
    'myaluno' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.aluno,
        aluno.id_ano,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_orientador,
        aluno.id_encarregadoeducacao,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1
),
TurmaRecente AS (
    SELECT 
        turma.*,
        ROW_NUMBER() OVER (PARTITION BY turma.unico ORDER BY turma.data DESC) AS rn
    FROM 
        turma
),
AnoRecente AS (
    SELECT 
        ano.*,
        ROW_NUMBER() OVER (PARTITION BY ano.unico ORDER BY ano.data DESC) AS rn
    FROM 
        ano
),
EscolaRecente AS (
    SELECT 
        escola.*,
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) AS rn
    FROM 
        escola
),
ColaboradorRecente AS (
    SELECT 
        colaborador.*,
        ROW_NUMBER() OVER (PARTITION BY colaborador.unico ORDER BY colaborador.data DESC) AS rn
    FROM 
        colaborador
),
EncarregadoEducacaoRecente AS (
    SELECT 
        encarregadoeducacao.*,
        ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
    FROM 
        encarregadoeducacao
),
RelacaoRecente AS (
    SELECT 
        relacao.*,
        ROW_NUMBER() OVER (PARTITION BY relacao.unico ORDER BY relacao.data DESC) AS rn
    FROM 
        relacao
)
SELECT 
    ar.foto_aluno,
    ar.id_aluno,
    ar.aluno,
    ar.unico,
    ar.id_turma,
    ar.id_escola,
    ar.id_orientador,
    ar.id_encarregadoeducacao,
    ar.data,
    ar.ativo,
    tr.*,
    er.*,
    cr.*,
    eer.*,
    anr.*,
    rr.*
FROM 
    AlunoRecente ar
INNER JOIN 
    TurmaRecente tr ON ar.id_turma = tr.unico AND tr.rn = 1
INNER JOIN 
    EscolaRecente er ON ar.id_escola = er.unico AND er.rn = 1
INNER JOIN 
    ColaboradorRecente cr ON ar.id_orientador = cr.unico AND cr.rn = 1
INNER JOIN 
    EncarregadoEducacaoRecente eer ON ar.id_encarregadoeducacao = eer.unico AND eer.rn = 1
INNER JOIN 
    RelacaoRecente rr ON eer.id_relacao = rr.unico AND rr.rn = 1
     INNER JOIN 
    AnoRecente anr ON ar.id_ano = anr.unico AND anr.rn = 1
WHERE 
    ar.rn = 1
 and aluno.id_orientador = ' . $_SESSION['userID'] . '',






    'alunoinative' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.id_ano,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_orientador,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data_nascimento_aluno,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 0 and removed = 0
),
TurmaRecente AS (
    SELECT 
        turma.*,
        ROW_NUMBER() OVER (PARTITION BY turma.unico ORDER BY turma.data DESC) AS rn
    FROM 
        turma
),
AnoRecente AS (
    SELECT 
        ano.*,
        ROW_NUMBER() OVER (PARTITION BY ano.unico ORDER BY ano.data DESC) AS rn
    FROM 
        ano
),
LocalidadeRecente AS (
    SELECT 
        localidade.*,
        ROW_NUMBER() OVER (PARTITION BY localidade.unico ORDER BY localidade.data DESC) AS rn
    FROM 
        localidade
),
NacionalidadeRecente AS (
    SELECT 
        nacionalidade.*,
        ROW_NUMBER() OVER (PARTITION BY nacionalidade.unico ORDER BY nacionalidade.data DESC) AS rn
    FROM 
        nacionalidade
),
CidadeRecente AS (
    SELECT 
        cidade.*,
        ROW_NUMBER() OVER (PARTITION BY cidade.unico ORDER BY cidade.data DESC) AS rn
    FROM 
        cidade
),
GeneroRecente AS (
    SELECT 
        genero.*,
        ROW_NUMBER() OVER (PARTITION BY genero.unico ORDER BY genero.data DESC) AS rn
    FROM 
        genero
),
EscolaRecente AS (
    SELECT 
        escola.*,
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) AS rn
    FROM 
        escola
),
ColaboradorRecente AS (
    SELECT 
        colaborador.*,
        ROW_NUMBER() OVER (PARTITION BY colaborador.unico ORDER BY colaborador.data DESC) AS rn
    FROM 
        colaborador
),
EncarregadoEducacaoRecente AS (
    SELECT 
        encarregadoeducacao.*,
        ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
    FROM 
        encarregadoeducacao
),
RelacaoRecente AS (
    SELECT 
        relacao.*,
        ROW_NUMBER() OVER (PARTITION BY relacao.unico ORDER BY relacao.data DESC) AS rn
    FROM 
        relacao
),
CicloRecente AS (
    SELECT 
        ciclo.*,
        ROW_NUMBER() OVER (PARTITION BY ciclo.unico ORDER BY ciclo.data DESC) AS rn
    FROM 
        ciclo
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
    ar.id_orientador,
    ar.id_encarregadoeducacao,
    ar.id_ciclo,
    ar.data,
    ar.ativo,
    tr.*,
    er.*,
    cr.*,
    eer.*,
    rr.*,
    anr.*,
    cir.*
FROM 
    AlunoRecente ar
INNER JOIN 
    TurmaRecente tr ON ar.id_turma = tr.unico AND tr.rn = 1
INNER JOIN 
    EscolaRecente er ON ar.id_escola = er.unico AND er.rn = 1
INNER JOIN 
    ColaboradorRecente cr ON ar.id_orientador = cr.unico AND cr.rn = 1
INNER JOIN 
    EncarregadoEducacaoRecente eer ON ar.id_encarregadoeducacao = eer.unico AND eer.rn = 1
INNER JOIN 
    RelacaoRecente rr ON eer.id_relacao = rr.unico AND rr.rn = 1
INNER JOIN 
    CicloRecente cir ON ar.id_ciclo = cir.unico AND cir.rn = 1
    INNER JOIN 
    AnoRecente anr ON ar.id_ano = anr.unico AND anr.rn = 1
WHERE 
    ar.rn = 1;

',
    'alunoremoved' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola  INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE  aluno.removed = 1',
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
        eer.rn = 1;',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM (
    SELECT 
        escola.*, 
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) as rn
    FROM escola
    WHERE ativo = 1
) sub
WHERE rn = 1;',
    'professor' => 'WITH RecentEspecialidade AS (
    SELECT 
        *,
        ROW_NUMBER() OVER (PARTITION BY id_especialidade ORDER BY data DESC) as rn
    FROM especialidade
),
RecentCargo AS (
    SELECT 
        *,
        ROW_NUMBER() OVER (PARTITION BY id_cargo ORDER BY data DESC) as rn
    FROM cargo
),
RecentColaborador AS (
    SELECT 
        *,
        ROW_NUMBER() OVER (PARTITION BY id_colaborador ORDER BY data DESC) as rn
    FROM colaborador
    WHERE ativo = 1 AND id_cargo = 3
)
SELECT 
    RecentColaborador.*, 
    RecentEspecialidade.*, 
    RecentCargo.*
FROM 
    RecentColaborador
INNER JOIN 
    RecentEspecialidade ON RecentColaborador.id_especialidade = RecentEspecialidade.id_especialidade AND RecentEspecialidade.rn = 1
INNER JOIN 
    RecentCargo ON RecentColaborador.id_cargo = RecentCargo.id_cargo AND RecentCargo.rn = 1
WHERE 
    RecentColaborador.rn = 1;',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 1 Order by ordem ASC',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 1 ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo',
    'disciplina'=> 'SELECT * FROM disciplina inner join ciclo on disciplina.id_ciclo = ciclo.unico WHERE disciplina.ativo = 1',
    
'pessoa'=> 'SELECT 
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
        )',
  ];


  



    
$consultasForms = [
    'aluno' => 'SELECT * 
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.unico
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
  ];

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
cidade.cidade AS nome_cidade_anterior,
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
INNER JOIN cidade ON cidade.unico = aluno.id_cidade
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
AND cidade.data = (
SELECT MAX(data) 
FROM cidade 
WHERE cidade.unico = aluno.id_cidade
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
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1 and colaborador.id_colaborador = ' . $id . '',
    'escola' => 'SELECT * FROM escola WHERE id_escola = ' . $id . ' ',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.id_turma = ' . $id . '',
    'operacao' => 'SELECT * FROM operacao  WHERE operacao.id_operacao = ' . $id . ' ',
    'transporte' => 'SELECT * FROM transporte  WHERE transporte.ativo = ' . $id . ' ',
    'permissao' => 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.id_cargo = ' . $id . ' ',
    'pessoa' => 'SELECT * FROM pessoa  WHERE id_pessoa = ' . $id_modal . ' ',
]
;
