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
        td {
            font-size: 10pt;
        }
        h3 {
            margin: 0px;
        }
        .font9 {
            font-size: 9pt;
        }
        .font8{
            font-size: 8pt;
        }
        .font7{
            font-size: 7pt;
        }
        .font6{
            font-size: 6pt;
        }
        .font8-table tr td{
            font-size: 8pt;
        }
        .font7-table tr td{
            font-size: 7pt;
        }
        .font6-table tr td{
            font-size: 6pt;
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
        .align-right {
            float: right
        }
        hr {
            margin: 0px;
            background-color: black;
        }
    </style>
</head>
<body>
    @if(count($servidores) == 0)
        <div class="center">
            <h1>Não foram encontrados servidores para essa opção</h1>
            <button class="button" onclick="javascript:history.back()">Voltar</button>
        </div>
    @endif
    @foreach($servidores as $servidor)
    <h3>Universidade de Brasília <div class="align-right">Decanato de Gestão de Pessoas</div></h3>
    <hr>
    <div class="font9 align-right">Referência</div>
    <h3 ><br>Folha de Registro de Frequência Individual<div class="align-right" style="text-transform:uppercase">{{$mes}}</div></h3>
    
    
    <hr>
    <table width="100%" class="font7-table">
        <tr>
            <td width="70%">Nome</td>
            <td width="15%">UnB</td>
            <td width="15%">Siape</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="70%">{{$servidor->nome}}</td>
            <td width="15%">{{$servidor->matricula_fub}}</td>
            <td width="15%">{{$servidor->matricula_siape}}</td>
        </tr>
    </table>
    <hr>
    <table width="100%" class="font7-table">
        <tr>
            <td width="50%">Lotação</td>
            <td width="35%">Cargo</td>
            <td width="15%">Carga Horária</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%">{{$servidor->lotacao->descricao}}</td>
            <td width="35%">{{$servidor->cargo->descricao}}</td>
            <td width="15%">{{$servidor->cargo->carga_horaria}}</td>
        </tr>
    </table>
    <hr>
    <div class="font9">999999- Subordinação não informada</div>
    <hr>
    <b class="font8">Ocorrências - Legenda</b>
    <table width="100%" class="font7-table">
        <tr>
            <td>LCO - Licênça com Ônus</td>
            <td>LM - Licênça Médica</td>
            <td>LSO - Licênça s/ Ônus</td>
            <td>LE - Licênça Especial</td>
            <td>LG - Licênça Gestante</td>
            <td>LC - Licênça Capacitação</td>
        </tr>
        <tr>
            <td>FE - Férias</td>
            <td>FA - Faltas</td>
            <td>FP - Folga Plantão</td>
            <td>Gr - Greve</td>
            <td>Pr - Paralização</td>
            <td>Dt - Dedetização</td>
        </tr>
        <tr>
            <td>__-__________</td>
            <td>__-__________</td>
            <td>__-__________</td>
            <td>__-__________</td>
            <td>__-__________</td>
            <td>__-__________</td>
        </tr>
    </table>
    <table class="GeneratedTable" style="line-height: 14px">
        <tbody>
            <tr>
                <td colspan="3"></td>
                <td class="center" colspan="4"><b>Intervalo</b></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td width="5%" style="text-align: center"><b>Dia</b></td>
                <td colspan="2" style="text-align: center"><b>Entrada</b></td>
                <td colspan="2" style="text-align: center"><b>Saída</b></td>
                <td colspan="2" style="text-align: center"><b>Entrada</b></td>
                <td colspan="2" style="text-align: center"><b>Saída</b></td>
                <td style="text-align: center"><b>Ocorrência</b></td>
            </tr>
            @foreach($dias as $dia)
                @if($dia->isSaturday())
                <tr>
                    <th>{{$dia->day}}</th>
                    <td colspan="2">Sábado</td>
                    <td colspan="2">Sábado</td>
                    <td colspan="2">Sábado</td>
                    <td colspan="2">Sábado</td>
                    <td></td>
                </tr>
                @elseif($dia->isSunday())
                <tr>
                    <th>{{$dia->day}}</th>
                    <td colspan="2">Domingo</td>
                    <td colspan="2">Domingo</td>
                    <td colspan="2">Domingo</td>
                    <td colspan="2">Domingo</td>
                    <td></td>
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
                    <td width="7%"></td>
                    <td width="13%"></td>
                    <td width="7%"></td>
                    <td width="13%"></td>
                    <td width="7%"></td>
                    <td width="13%"></td>
                    <td width="7%"></td>
                    <td width="13%"></td>
                    <td></td>
                </tr>
                @endif
            </tr>
            @endforeach
        </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table width="100%">
        <tbody>
            <tr>
                <td width="30%">Data</td>
                <td width="70%">Assinatura/Carimbo Chefia Imediata</td>
            </tr>
            <tr>
                <td>___/___/___</td>
                <td>____________________________________________________</td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>
</html>