<?php

use Illuminate\Database\Seeder;

class DocumentsTypesSeeder extends Seeder
{

    public function run()
    {
        \DB::table('category_finances')->insert( array(
            0 =>
                            array (
                                'id' => 1,
                                'name' => 'VALE TRANSPORTE',
                            ),
                        1 =>
                            array (
                                'id' => 2,
                                'name' => 'ÁGUA',
                            ),
                        2 =>
                            array (
                                'id' => 4,
                                'name' => 'CORREIOS',
                            ),
                        3 =>
                            array (
                                'id' => 5,
                                'name' => 'SUPERMERCADO / HIGIENE / COPA / COZINHA',
                            ),
                        4 =>
                            array (
                                'id' => 6,
                                'name' => 'REPAROS E REFORMAS',
                            ),
                        5 =>
                            array (
                                'id' => 7,
                                'name' => 'ASSINATURA DE JORNAIS E REVISTAS',
                            ),
                        6 =>
                            array (
                                'id' => 8,
                                'name' => 'SEGUROS',
                            ),
                        7 =>
                            array (
                                'id' => 9,
                                'name' => 'COMBUSTÍVEIS',
                            ),
                        8 =>
                            array (
                                'id' => 10,
                                'name' => 'LANCHES',
                            ),
                        9 =>
                            array (
                                'id' => 11,
                                'name' => 'TELEFONE',
                            ),
                        10 =>
                            array (
                                'id' => 12,
                                'name' => 'TREINAMENTO EMPREGADO',
                            ),
                        11 =>
                            array (
                                'id' => 13,
                                'name' => 'ESTACIONAMENTO',
                            ),
                        12 =>
                            array (
                                'id' => 16,
                                'name' => 'FATURAS DUP. PAGAS E A PAGAR',
                            ),
                        13 =>
                            array (
                                'id' => 17,
                                'name' => 'RESCISÃO CONTRATO TRABALHO',
                            ),
                        14 =>
                            array (
                                'id' => 18,
                                'name' => 'CONTRIBUIÇÃO SINDICAL',
                            ),
                        15 =>
                            array (
                                'id' => 19,
                                'name' => 'FGTS - GRF - FOLHA DE PGTº',
                            ),
                        16 =>
                            array (
                                'id' => 20,
                                'name' => 'GRRF - (FGTS TRCT)',
                            ),
                        17 =>
                            array (
                                'id' => 21,
                                'name' => 'ISSQN RETIDO',
                            ),
                        18 =>
                            array (
                                'id' => 22,
                                'name' => 'DARF 1708 - IRRF - PESSOA JURÍDICA',
                            ),
                        19 =>
                            array (
                                'id' => 23,
                                'name' => 'DARF 5952',
                            ),
                        20 =>
                            array (
                                'id' => 25,
                                'name' => 'LOCAÇÃO EQUIPAMENTOS',
                            ),
                        21 =>
                            array (
                                'id' => 26,
                                'name' => 'PRÓ-LABORE',
                            ),
                        22 =>
                            array (
                                'id' => 27,
                                'name' => 'ISSQN IMPOSTO SOBRE SERVIÇOS',
                            ),
                        23 =>
                            array (
                                'id' => 28,
                                'name' => 'DARF 2089',
                            ),
                        24 =>
                            array (
                                'id' => 29,
                                'name' => 'DARF 2372',
                            ),
                        25 =>
                            array (
                                'id' => 30,
                                'name' => 'SUPORTE TÉCNICO SOFTWARE',
                            ),
                        26 =>
                            array (
                                'id' => 31,
                                'name' => 'INSS - GPS',
                            ),
                        27 =>
                            array (
                                'id' => 32,
                                'name' => 'DARF 2172',
                            ),
                        28 =>
                            array (
                                'id' => 33,
                                'name' => 'DARF 8109',
                            ),
                        29 =>
                            array (
                                'id' => 34,
                                'name' => 'HONORÁRIOS CONTÁBEIS',
                            ),
                        30 =>
                            array (
                                'id' => 35,
                                'name' => 'TRANSPORTE - TÁXI e ÔNIBUS',
                            ),
                        31 =>
                            array (
                                'id' => 36,
                                'name' => 'CONTRA-CHEQUE / PAGTº SALÁRIOS',
                            ),
                        32 =>
                            array (
                                'id' => 37,
                                'name' => 'ENERGIA ELÉTRICA',
                            ),
                        33 =>
                            array (
                                'id' => 38,
                                'name' => 'FÉRIAS',
                            ),
                        34 =>
                            array (
                                'id' => 39,
                                'name' => 'DARF 0561',
                            ),
                        35 =>
                            array (
                                'id' => 47,
                                'name' => 'DAS-SIMPLES NACIONAL',
                            ),
                        36 =>
                            array (
                                'id' => 48,
                                'name' => 'ICMS: ST e DIFERENÇA ALÍQUOTA',
                            ),
                        37 =>
                            array (
                                'id' => 49,
                                'name' => 'ADIANTAMENTO DE SALARIO',
                            ),
                        38 =>
                            array (
                                'id' => 50,
                                'name' => 'ASSISTÊNCIA MÉDICA',
                            ),
                        39 =>
                            array (
                                'id' => 51,
                                'name' => 'CONDOMÍNIO',
                            ),
                        40 =>
                            array (
                                'id' => 54,
                                'name' => 'HONORÁRIOS ADVOCATÍCIOS',
                            ),
                        41 =>
                            array (
                                'id' => 55,
                                'name' => 'CONSULTORIA',
                            ),
                        42 =>
                            array (
                                'id' => 56,
                                'name' => 'DARF 3208',
                            ),
                        43 =>
                            array (
                                'id' => 57,
                                'name' => 'CARTÃO DE CRÉDITO MASTERCARD',
                            ),
                        44 =>
                            array (
                                'id' => 58,
                                'name' => 'MATERIAL ESCRITÓRIO',
                            ),
                        45 =>
                            array (
                                'id' => 59,
                                'name' => 'TAXA DE ENGENHO',
                            ),
                        46 =>
                            array (
                                'id' => 60,
                                'name' => 'REFEIÇÕES',
                            ),
                        47 =>
                            array (
                                'id' => 61,
                                'name' => 'ÓLEO LUBRIFICANTE',
                            ),
                        48 =>
                            array (
                                'id' => 63,
                                'name' => 'COMISSÕES',
                            ),
                        49 =>
                            array (
                                'id' => 64,
                                'name' => 'IPTU',
                            ),
                        50 =>
                            array (
                                'id' => 65,
                                'name' => 'CARTORIO',
                            ),
                        51 =>
                            array (
                                'id' => 66,
                                'name' => 'VISA - CARTÃO DE CRÉDITO',
                            ),
                        52 =>
                            array (
                                'id' => 67,
                                'name' => 'EXTRATO CONTA CORRENTE',
                            ),
                        53 =>
                            array (
                                'id' => 68,
                                'name' => 'EMPRÉSTIMO BANCÁRIO - PAGAMENTO',
                            ),
                        54 =>
                            array (
                                'id' => 69,
                                'name' => 'DARF 1240 PARCELAMENTO INSS',
                            ),
                        55 =>
                            array (
                                'id' => 70,
                                'name' => 'AJUDA DE CUSTO',
                            ),
                        56 =>
                            array (
                                'id' => 72,
                                'name' => 'FRETES E CARRETOS',
                            ),
                        57 =>
                            array (
                                'id' => 73,
                                'name' => 'TAXAS: TFLF e TFS',
                            ),
                        58 =>
                            array (
                                'id' => 74,
                                'name' => 'TAXA DE INCÊNDIO',
                            ),
                        59 =>
                            array (
                                'id' => 75,
                                'name' => 'IPVA; SEG.OBRIGATÓRIO; LICENCTº',
                            ),
                        60 =>
                            array (
                                'id' => 76,
                                'name' => '13º SALÁRIO - PRIM. E SEG. PARCELA',
                            ),
                        61 =>
                            array (
                                'id' => 78,
                                'name' => 'SINDICATO E ASSOCIAÇÃO E CONSELHO',
                            ),
                        62 =>
                            array (
                                'id' => 121,
                                'name' => 'COMPROV. ANUAL RENDTº.- IRRF PJ',
                            ),
                        63 =>
                            array (
                                'id' => 3,
                                'name' => 'ALUGUEL',
                            ),
                        64 =>
                            array (
                                'id' => 79,
                                'name' => 'MULTA DE TRÂNSITO',
                            ),
                        65 =>
                            array (
                                'id' => 80,
                                'name' => '13ª SALÁRIO ADIANTAMENTO',
                            ),
                        66 =>
                            array (
                                'id' => 81,
                                'name' => 'LUCROS PAGOS',
                            ),
                        67 =>
                            array (
                                'id' => 82,
                                'name' => 'HOSPEDAGEM E ESTADAS',
                            ),
                        68 =>
                            array (
                                'id' => 83,
                                'name' => 'LOCAÇÃO DE VEÍCULOS',
                            ),
                        69 =>
                            array (
                                'id' => 84,
                                'name' => 'MATERIAL DE TRABALHO',
                            ),
                        70 =>
                            array (
                                'id' => 86,
                                'name' => 'ASSESSORIA EMPRESARIAL',
                            ),
                        71 =>
                            array (
                                'id' => 89,
                                'name' => 'FINANCIAMENTO BANCÁRIO',
                            ),
                        72 =>
                            array (
                                'id' => 90,
                                'name' => 'CONSÓRCIO',
                            ),
                        73 =>
                            array (
                                'id' => 44,
                                'name' => 'DUPLICATAS RECEBIDAS - RECEITA - TITULO EM CARTEIRA',
                            ),
                        74 =>
                            array (
                                'id' => 14,
                                'name' => 'MANUTENÇÃO VEÍCULOS E MOTOS',
                            ),
                        75 =>
                            array (
                                'id' => 15,
                                'name' => 'ADMINISTRAÇÃO BENS E NEGOCIAÇÃO TERCEIROS',
                            ),
                        76 =>
                            array (
                                'id' => 24,
                                'name' => 'SERVIÇOS DE ARQUITETURA E ENGENHARIA',
                            ),
                        77 =>
                            array (
                                'id' => 40,
                                'name' => 'DARF 0190',
                            ),
                        78 =>
                            array (
                                'id' => 41,
                                'name' => 'HOSPEDAGEM PROGRAMAS E DOMÍNIO',
                            ),
                        79 =>
                            array (
                                'id' => 42,
                                'name' => 'PUBLICIDADE E PROPAGANDA',
                            ),
                        80 =>
                            array (
                                'id' => 43,
                                'name' => 'TAXA EXPEDIENTE REGISTRO ATOS ADMINISTRATIVOS',
                            ),
                        81 =>
                            array (
                                'id' => 45,
                                'name' => 'RECEITA - MOVIMENTO TÍTULOS',
                            ),
                        82 =>
                            array (
                                'id' => 46,
                                'name' => 'NOTA FISCAL',
                            ),
                        83 =>
                            array (
                                'id' => 122,
                                'name' => 'COMUNICAÇÃO COBRANÇA E REGULARIZAÇÃO',
                            ),
                        84 =>
                            array (
                                'id' => 123,
                                'name' => 'CERTIDÕES NEGATIVAS',
                            ),
                        85 =>
                            array (
                                'id' => 124,
                                'name' => 'RELATÓRIO TRIBUTÁRIO / FINANCEIRO / FATURAMENTO',
                            ),
                        86 =>
                            array (
                                'id' => 131,
                                'name' => 'SOLICITAÇÃO SERVIÇOS',
                            ),
                        87 =>
                            array (
                                'id' => 132,
                                'name' => 'PROTOCOLO',
                            ),
                        88 =>
                            array (
                                'id' => 133,
                                'name' => 'CERTIFICADO DIGITAL',
                            ),
                        89 =>
                            array (
                                'id' => 141,
                                'name' => 'DOCUMENTOS PARA ADMISSÃO EMPREGADO',
                            ),
                        90 =>
                            array (
                                'id' => 142,
                                'name' => 'DOCUMENTOS PARA DEMISSÃO EMPREGADO',
                            ),
                        91 =>
                            array (
                                'id' => 143,
                                'name' => 'ATESTADO MÉDICO',
                            ),
                        92 =>
                            array (
                                'id' => 144,
                                'name' => 'FICHA ADMISSÃO',
                            ),
                        93 =>
                            array (
                                'id' => 145,
                                'name' => 'EXTRATO CONTA FGTS',
                            ),
                        94 =>
                            array (
                                'id' => 146,
                                'name' => 'CHAVE DE IDENTIFICAÇÃO - FGTS',
                            ),
                        95 =>
                            array (
                                'id' => 147,
                                'name' => 'SEGURO DESEMPREGO',
                            ),
                        96 =>
                            array (
                                'id' => 148,
                                'name' => 'AVISO PRÉVIO',
                            ),
                        97 =>
                            array (
                                'id' => 149,
                                'name' => 'CONTRATO EXPERIÊNCIA',
                            ),
                        98 =>
                            array (
                                'id' => 150,
                                'name' => 'DECLARAÇÃO BENEFICIÁRIO VALE TRANSPORTE',
                            ),
                        99 =>
                            array (
                                'id' => 151,
                                'name' => 'DECLARAÇÃO DEPENDENTE IMPOSTO DE RENDA',
                            ),
                        100 =>
                            array (
                                'id' => 152,
                                'name' => 'TERMO DE RESPONSABILIDADE',
                            ),
                        101 =>
                            array (
                                'id' => 153,
                                'name' => 'DECLARAÇÃO RESIDENCIAL',
                            ),
                        102 =>
                            array (
                                'id' => 154,
                                'name' => 'ACORDO COMPENSAÇÃO HORAS DE TRABALHO',
                            ),
                        103 =>
                            array (
                                'id' => 155,
                                'name' => 'DECLARAÇÃO OPÇÃO DESCONTO CONTR. SINDICAL',
                            ),
                        104 =>
                            array (
                                'id' => 52,
                                'name' => 'ICMS - PARCELAMENTO',
                            ),
                        105 =>
                            array (
                                'id' => 53,
                                'name' => 'ISSQN - PARCELAMENTO',
                            ),
                        106 =>
                            array (
                                'id' => 62,
                                'name' => 'ALUGUEL - RECEITA DE...',
                            ),
                        107 =>
                            array (
                                'id' => 71,
                                'name' => 'MATERIAL DE CONSUMO',
                            ),
                        108 =>
                            array (
                                'id' => 77,
                                'name' => 'DARF 5190 - PERT',
                            ),
                        109 =>
                            array (
                                'id' => 85,
                                'name' => 'DARF 1124 - PERT',
                            ),
                        110 =>
                            array (
                                'id' => 87,
                                'name' => 'ISSQN A PAGAR',
                            ),
                        111 =>
                            array (
                                'id' => 88,
                                'name' => 'DARF 5184 - PERT',
                            ),
                        112 =>
                            array (
                                'id' => 91,
                                'name' => 'DARF 4750 - LEI 12996/2014',
                            ),
                        113 =>
                            array (
                                'id' => 92,
                                'name' => 'DARF 4737 - LEI 12996/2014',
                            ),
                        114 =>
                            array (
                                'id' => 93,
                                'name' => 'DARF 1734 - PGFN/RFB',
                            ),
                        115 =>
                            array (
                                'id' => 94,
                                'name' => 'HONORÁRIOS ANTECIPAÇÃO',
                            ),
                        116 =>
                            array (
                                'id' => 95,
                                'name' => 'OBRIGAÇÃO PARA COM TERCEIROS - HONORÁRIOS',
                            ),
                        117 =>
                            array (
                                'id' => 96,
                                'name' => 'OBRIGAÇÃO PARA COM TERCEIROS - SINDICATO',
                            ),
                        118 =>
                            array (
                                'id' => 97,
                                'name' => 'TARIFAS FINANCEIRAS',
                            ),
                        119 =>
                            array (
                                'id' => 98,
                                'name' => 'RECEITA - CARTEIRA',
                            ),
                        120 =>
                            array (
                                'id' => 99,
                                'name' => 'RECEITA - MOVIMENTO TÍTULOS',
                            ),
                        121 =>
                            array (
                                'id' => 100,
                                'name' => 'REEMBOLSO',
                            ),
                        122 =>
                            array (
                                'id' => 101,
                                'name' => 'EMPRÉSTIMO - PAGAMENTO',
                            ),
                        123 =>
                            array (
                                'id' => 102,
                                'name' => 'DOCTº. ARRECADAÇÃO DO SIMPLES NACIONAL - PARCELAMENTO',
                            ),
                        124 =>
                            array (
                                'id' => 103,
                                'name' => 'SERVIÇOS EXPEDIENTE/MALOTES',
                            ),
                        125 =>
                            array (
                                'id' => 104,
                                'name' => 'DARF 1097 - IPI',
                            ),
                        126 =>
                            array (
                                'id' => 105,
                                'name' => 'ICMS - PAGAMENTO NORMAL',
                            ),
                        127 =>
                            array (
                                'id' => 106,
                                'name' => 'INDENIZAÇÃO PARA COM TERCEIROS',
                            ),
                        128 =>
                            array (
                                'id' => 107,
                                'name' => 'ORNAMENTAÇÃO E FESTAS',
                            ),
                        129 =>
                            array (
                                'id' => 108,
                                'name' => 'SERVIÇOS MEDICINA E LABORATÓRIO',
                            ),
                        130 =>
                            array (
                                'id' => 125,
                                'name' => 'DENUNCIA ESPONTÂNEA',
                            ),
                        131 =>
                            array (
                                'id' => 126,
                                'name' => 'CONTRATOS EM GERAL',
                            ),
                        132 =>
                            array (
                                'id' => 127,
                                'name' => 'NOTA FISCAL',
                            ),
                        133 =>
                            array (
                                'id' => 134,
                                'name' => 'CONTRATO PRESTAÇÃO SERVIÇO',
                            ),
                        134 =>
                            array (
                                'id' => 135,
                                'name' => 'ATA ASSEMBLÉIA GERAL',
                            ),
                        135 =>
                            array (
                                'id' => 136,
                                'name' => 'ESTATUTO SOCIAL',
                            ),
                        136 =>
                            array (
                                'id' => 137,
                                'name' => 'REGISTRO IMÓVEIS',
                            ),
                        137 =>
                            array (
                                'id' => 156,
                                'name' => 'FÉRIAS AVISO DE...',
                            ),
                        138 =>
                            array (
                                'id' => 157,
                                'name' => 'FOLHA DE PONTO',
                            ),

        ));
    }
}
