<html>
<head>
    <meta content="text/html; charset=UTF-16" http-equiv="content-type">
    <style>
        @media print
        {
            .page-break  { display:block; page-break-before:always; }
        }
        * {
            font-family: "Arial";
        }
        p {
            font-size: 10pt;
            margin:0;
        }
        h3 {
            font-size: 11pt;
        }
        td {
            font-size: 10pt;
        }
        .font9 {
            font-size: 9pt;
        } 
        .font8 {
            font-size: 8pt;
        }
        table.GeneratedTable {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #000000;
            border-style: solid;
            color: #000000;
            height: 1px;
        }
        table.GeneratedTable td, table.GeneratedTable th {
            border-width: 1px;
            border-color: #000000;
            border-style: solid;
            padding: 3px;
        }

        table.GeneratedTable thead {
            background-color: #ffffff;
        }
        img {
            width: 286.00px; 
            height: 25.33px; 
            margin-left: 0.00px; 
            margin-top: 0.00px; 
            transform: rotate(0.00rad) 
            translateZ(0px); 
            -webkit-transform: rotate(0.00rad) translateZ(0px);
        }
        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
            text-align: center;
        }
        table.bold-table {
            border-collapse: collapse;
            text-align: center;
            padding: 5pt 5pt 5pt 5pt;
            width: 100%;
        }
        table.bold-table td, table.bold-table th{
            border-width: 2px;
            border-color: #000000;
            border-style: solid;
            padding: 3px;
            width:350px;
        }
        table tr .special-field{
            border-left-color: white;
            border-right-color: white;
            border-bottom-color: white;
        }
        table tr .special-field2{
            border-left-color: white;
            border-right-color: black;
            border-bottom-color: white;
        }
        table tr .blank-top-bottom{
            border-top-color: white;
            border-bottom-color: white;
        }
        .small-heigth {
            line-height: 11px;

        }
        .col-cod {
            width: 1px;
        }
        .col-event {
            width: 1px;
        }
        table tr .blank {
            border-left-color: white;
            border-right-color: white;
            border-bottom-color: white;
        }
        table tr .full-blank {
            border-color: white;
        }
        table.fixed { table-layout:fixed;}
        table.fixed td { overflow: hidden; }
        table.small { table-layout:fixed; width: 50%}
        .button {
            background-color: #008CBA; /* Blue */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @if(count($estagiarios) == 0)
    <div class="center">
        <h1>Não foram encontrados estagiários para essa opção</h1>
        <button class="button" onclick="javascript:history.back()">Voltar</button>
    </div>
    @endif
    @foreach($estagiarios as $estagiario)
    <div class="page-break"></div>
    <table class="center bold-table" >
        <tbody>
            <tr>
                <td>
                    <img src={{ asset('img/unb.png') }}>
                </td>
                <td>
                    <h3>
                    FOLHA DE FREQUÊNCIA <br>DE ESTAGIÁRIO</p>
                </td>
            </tr>
        </tbody>
    </table>
    <h3 class="center">INSTRUÇÕES PARA PREENCHIMENTO</h3>
    <p>
        Sr. Supervisor,<br>
        Preencha a folha de frequência do estagiário, informando as ocorrências válidas no mês, com a data correspondente.<br>
        Assine e carimbe a frequência; peça a assinatura do estagiário e envie por UnBDOC para DGP/COEST, impreterivelmente, até o &nbsp;<u>segundo dia útil do mês subseqüente.</u><br>
        Para o controle de assiduidade e pontualidade, utilizar o Registro Diário de Ponto (em atendimento ao Decreto nº 1.590, de 10 de agosto de 1995).
    </p>
    <table class="GeneratedTable small-heigth fixed">
        <tbody>
            <col width="5%" />
            <col width="45%" />
            <col width="25%" />
            <col width="25%" />
            <tr>
                <td colspan="3">
                    <div>Nome do estagiário</div>
                    <div>&nbsp;</div>
                    <div><b>{{$estagiario->nome}}</b></div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div>Nível</div>
                    <div class="font9">
                        <br>
                        <div> (  &nbsp;) Técnico</div>
                        <div> (X) Graduação</div>
                        <div> (  &nbsp;) Médio</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div>Nome do supervisor</div>
                    <div>&nbsp;</div>
                    <div><b>{{$estagiario->supervisor->nome}}</b></div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div>Lotação</div>
                    <div>&nbsp;</div>
                    <div><b>{{$estagiario->lotacao->descricao}}</b></div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div>Telefone</div>
                    <div>&nbsp;</div>
                    <div><b>3107-3665</b></div>
                    <div>&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div>Período previsto para o estágio <i class="font9">(indicado no<br> Termo  de Compromisso de Estágio)</i></div>
                    <div>&nbsp;</div>
                    <div><b>{{$estagiario->periodo_inicio}} à {{$estagiario->periodo_fim}}</b></div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div>Mês de referência</div>
                    <div>&nbsp;</div>
                    <div style="text-transform:uppercase"><b>{{$mes}}</b></div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div>Horário</div>
                    <div>&nbsp;</div>
                    <div align="center">das <b>{{$estagiario->hora_inicio}}h</b> às <b>{{$estagiario->hora_fim}}h</b></div>
                    <div>&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <div><b>Cód.</b></div>
                </td>
                <td align="center" width="40%">
                    <div><b>Eventos de frequência</b></div>
                </td>
                <td align="center" width="50%" colspan="2">
                    <div><b>Datas</b></div>
                </td>
            </tr>
            <tr>
                <th>
                    <div>1</div>
                </th>
                <td>
                    <div>Recesso (Lei Nº 11.788, art. 13)</div>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    2
                </th>
                <td>
                    Atestado médico (*)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    3
                </th>
                <td>
                    Atestado escolar (*)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    4
                </th>
                <td>
                    Outras faltas justificadas (*)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    5
                </th>
                <td>
                    Horário reduzido para avaliação escolar (*)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    6
                </th>
                <td>
                    Dispensa de ponto pelo supervisor
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    7
                </th>
                <td>
                    Falta compensada em outro dia
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    8
                </th>
                <td>
                    Feriado/ponto facultativo
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    9
                </th>
                <td>
                    Falta não-justificada
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    10
                </th>
                <td>
                    Rescisão (Desligamento)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    11
                </th>
                <td>
                    Outros (**)
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td class="special-field">
                </td>
                <td class="special-field2"> 
                </td>
                <td>
                    Total de ausências no mês
                </td>
                <td>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <i>OBS: Nos eventos acima marcados com (*), é indispensável anexar o respectivo atestado/comprovante. (**) Relatar ocorrências não contempladas nos códigos de 1 a 10, via memorando,</i>
    </p>
    <h3 class="center">Avaliação de desempenho do estagiário</h3>
    <div class="font8" align="center">(Amparo legal para o art. 19, inciso III, da Orientação Normativa n. 7, de 30 de outubro de 2008, da Secretaria de Recursos Humanos do MPOG)</div>
    <p>Atribua um dos conceitos a cada um dos aspectos a seguir:</p>
    <table class="GeneratedTable small-heigth">
        <tbody>
            <tr>
                <td colspan="2" align="center"><b>Aspectos Observáveis</b></td>
                <td class="blank-top-bottom" ></td>
                <td colspan="2" align="center"><b>Conceito</b></td>
            </tr>
            <tr>
                <td>1 - Interesse</td>
                <td width="30px"></td>
                <td class="blank-top-bottom"></td>
                <td rowspan="2" align="center"><b>A</b></td>
                <td rowspan="2" align="center"><b>Superou o desempenho esperado</b></td>
            </tr>
            <tr>
                <td>2 - Organização</td>
                <td></td>
                <td class="blank-top-bottom"></td>
            </tr>
            <tr>
                <td>3 - Qualidade nas tarefas executadas</td>
                <td></td>
                <td class="blank-top-bottom"></td>
                <td rowspan="2" align="center"><b>B</b></td>
                <td rowspan="2" align="center"><b>Correspondeu ao desempenho esperado</b></td>
            </tr>
            <tr>
                <td>4 - Conhecimento do trabalho</td>
                <td></td>
                <td class="blank-top-bottom"></td>
            </tr>
            <tr>
                <td>5 - Dedicação</td>
                <td></td>
                <td class="blank-top-bottom"></td>
                <td rowspan="2" align="center"><b>C</b></td>
                <td rowspan="2" align="center"><b>Atendeu mas necessita aprimoramento</b></td>
            </tr>
            <tr>
                <td>6 - Relacionamento com os colegas</td>
                <td></td>
                <td class="blank-top-bottom"></td>
            </tr>
            <tr>
                <td>7 - Atendimento ao cliente</td>
                <td></td>
                <td class="blank-top-bottom"></td>
                <td rowspan="2" align="center"><b>D</b></td>
                <td rowspan="2" align="center"><b>Não atendeu ao desempenho esperado</b></td>
            </tr>
            <tr>
                <td>8 - Responsabilidade</td>
                <td></td>
                <td class="blank-top-bottom"></td>
            </tr>
        </tbody>
    </table>
    <p> Assinale com um "X":</p>
    <table class="GeneratedTable small-heigth small">
        <tbody>
            <tr>
                <td></td>
                <td align="center" width="10%"><b>Sim</b></td>
                <td align="center" width="10%"><b>Não</b></td>
            </tr>
            <tr>
                <td>9 - Pontualidade</td>
                <td></td>
                <td></td>
            </tr>
            <td>10 - Assiduidade</td>
            <td></td>
            <td></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <table class="GeneratedTable small-heigth fixed">
        <tbody>
            <col width="40px" />
            <col width="30px" />
            <col width="40px" />
            <tr>
                <td class="blank" align="center"><i>Assinatura e carimbo do supervisor</i></td>
                <td class="full-blank"></td>
                <td class="blank" align="center"><i>Assinatura do Estagiário</i></td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <table class="center bold-table" >
        <tbody>
            <tr>
                <td>
                    <img src={{ asset('img/unb.png') }}>
                </td>
                <td>
                    <h3>
                    REGISTRO DIÁRIO <br>DE PONTO</p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="GeneratedTable">
        <tbody>
            <tr>
                <th colspan="1" rowspan="2">DIA</th>
                <th colspan="2" rowspan="2">ENTRADA</th>
                <th colspan="4">INTERVALO</th>
                <th colspan="2" rowspan="2">SAÍDA</th>
            </tr>
            <tr>
                <th colspan="2">SAÍDA</th>
                <th colspan="2">ENTRADA</th>
            </tr>
            @foreach($dias as $dia)
            @if($dia->isSaturday())
            <tr>
                <th>{{$dia->day}}</th>
                @for($i = 0; $i < 8; $i++)
                <td>Sábado</td>
                @endfor
            </tr>
            @elseif($dia->isSunday())
            <tr>
                <th>{{$dia->day}}</th>
                @for($i = 0; $i < 8; $i++)
                <td>Domingo</td>
                @endfor
            </tr>
            @elseif($dia->day === 0)
            <tr>
                <th>{{$dia->day}}</th>
                <td>x</td>
                <td>F</td>
                <td>E</td>
                <td>R</td>
                <td>I</td>
                <td>A</td>
                <td>D</td>
                <td>O</td>
            </tr>
            @else
            <tr>
                <th>{{$dia->day}}</th>
                @for($i = 0; $i < 8; $i++)
                <td></td>
                @endfor
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endforeach
</body>
</html>