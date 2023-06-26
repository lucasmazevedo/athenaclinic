<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de Procedimentos - {{ $data->paciente->nome }}</title>
</head>

<body style="font-size: 12pt;">
    <div style="width:100%; height: 405px;">
        <table style="width: 100%; margin-left: auto; align: center; margin-right: auto;" border="0" cellspacing="1"
            cellpadding="0">
            <tbody>
                <tr>
                    <td width="200px" style="width:200px; height: 150px;" align="left"><img
                            src="{{ global_asset('/assets/media/logos/athena_clinic.svg') }}" width="200px"></td>
                    <td style="font-size: 14pt;">
                        <table style="padding-left:20px; width: 100%; margin-left: auto; margin-right: auto;"
                            border="0">
                            <tbody>
                                <tr>
                                    <td style="font-size: 16pt; font-weight: bold;">Athena Clinic</td>
                                </tr>
                                <tr>
                                    <td>Rua Ceará, nº 412, Pirajá
                                    </td>
                                </tr>
                                <tr>
                                    <td>Teresina/PI - CNPJ: 46.311.540/0001-97
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; margin-left: auto; align: center; margin-right: auto;" border="1" cellspacing="1"
            cellpadding="0">
            <tbody style="font-size: 12pt;">
                <tr>
                    <td style="font-size: 12pt;">
                        <table style="padding-left:20px; width: 100%; margin-left: auto; margin-right: auto;"
                            border="0">
                            <tbody>
                                <tr>
                                    <td>Nome: <strong>{{ $data->paciente->nome }}</strong></td>
                                    <td>Código: <strong>{{ $data->paciente->cod_acesso }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Idade:
                                        <strong><strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->age }}&nbsp;</strong></strong>|
                                        Sexo:&nbsp;
                                        @if ($data->paciente->sexo == 0)
                                            <strong>MASCULINO</strong>
                                        @else
                                            <strong>FEMININO</strong>
                                        @endif
                                    </td>
                                    <td>Conv&ecirc;nio: <strong>{{ $data->convenio->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Data Nascimento:
                                        <strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->format('d/m/Y') }}</strong>
                                    </td>
                                    <td>Atendente: <strong>{{ $data->funcionario->nome }}</strong></td>
                                </tr>
                                <tr>
                                    <td>CPF: <strong>{{ $data->paciente->cpf }}</strong></td>
                                    <td>Data Solicitação:
                                        <strong>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }} às
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('H:i:s') }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p></p>
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
            <thead style="background-color:#ccc;">
                <tr>
                    <th scope="col">COD.</th>
                    <th scope="col">PROCEDIMENTO.</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->procedimentos as $p)
                    <tr style="text-align:center">
                        <td>{{ 'P-' . str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $p->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <table style="text-align:right;" width="100%" border="0">
        <tbody>
            <tr>
                <td style="width: 670px; text-align:right;">
                    <p style="line-height: 16pt;"><b>RESULTADO ONLINE - ACESSO PARA PACIENTES:</b><br>
                        Acesse seus exames pela internet. É rápido e prático.<br>
                        <b>PROTOCOLO:</b> {{ $data->paciente->cod_acesso }}<br>
                        <b>SENHA:</b> {{ $data->paciente->senha_acesso }}<br>
                        <b>https://resultados.athenaclinic.com.br</b>
                    </p>
                </td>
                <th style="width: 100px;">
                    {!! QrCode::size(100)->generate('https://resultados.athenaclinic.com.br') !!}
                </th>

            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <br>
    <div style="width:100%; height: 405px;">
        <table style="width: 100%; margin-left: auto; align: center; margin-right: auto;" border="0" cellspacing="1"
            cellpadding="0">
            <tbody>
                <tr>
                    <td width="200px" style="width:200px; height: 150px;" align="left"><img
                            src="{{ global_asset('/assets/media/logos/athena_clinic.svg') }}" width="200px"></td>
                    <td style="font-size: 14pt;">
                        <table style="padding-left:20px; width: 100%; margin-left: auto; margin-right: auto;"
                            border="0">
                            <tbody>
                                <tr>
                                    <td style="font-size: 16pt; font-weight: bold;">Athena Clinic</td>
                                </tr>
                                <tr>
                                    <td>Rua Ceará, nº 412, Pirajá
                                    </td>
                                </tr>
                                <tr>
                                    <td>Teresina/PI - CNPJ: 46.311.540/0001-97
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; margin-left: auto; align: center; margin-right: auto;" border="1" cellspacing="1"
            cellpadding="0">
            <tbody style="font-size: 12pt;">
                <tr>
                    <td style="font-size: 12pt;">
                        <table style="padding-left:20px; width: 100%; margin-left: auto; margin-right: auto;"
                            border="0">
                            <tbody>
                                <tr>
                                    <td>Nome: <strong>{{ $data->paciente->nome }}</strong></td>
                                    <td>Código: <strong>{{ $data->paciente->cod_acesso }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Idade:
                                        <strong><strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->age }}&nbsp;</strong></strong>|
                                        Sexo:&nbsp;
                                        @if ($data->paciente->sexo == 0)
                                            <strong>MASCULINO</strong>
                                        @else
                                            <strong>FEMININO</strong>
                                        @endif
                                    </td>
                                    <td>Conv&ecirc;nio: <strong>{{ $data->convenio->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Data Nascimento:
                                        <strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->format('d/m/Y') }}</strong>
                                    </td>
                                    <td>Atendente: <strong>{{ $data->funcionario->nome }}</strong></td>
                                </tr>
                                <tr>
                                    <td>CPF: <strong>{{ $data->paciente->cpf }}</strong></td>
                                    <td>Data Solicitação:
                                        <strong>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }} às
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('H:i:s') }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p></p>
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
            <thead style="background-color:#ccc;">
                <tr>
                    <th scope="col">COD.</th>
                    <th scope="col">PROCEDIMENTO.</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->procedimentos as $p)
                    <tr style="text-align:center">
                        <td>{{ 'P-' . str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $p->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <table style="text-align:right;" width="100%" border="0">
        <tbody>
            <tr>
                <td style="width: 670px; text-align:right;">
                    <p style="line-height: 16pt;"><b>RESULTADO ONLINE - ACESSO PARA PACIENTES:</b><br>
                        Acesse seus exames pela internet. É rápido e prático.<br>
                        <b>PROTOCOLO:</b> {{ $data->paciente->cod_acesso }}<br>
                        <b>SENHA:</b> {{ $data->paciente->senha_acesso }}<br>
                        <b>https://resultados.athenaclinic.com.br</b>
                    </p>
                </td>
                <th style="width: 100px;">
                    {!! QrCode::size(100)->generate('https://resultados.athenaclinic.com.br') !!}
                </th>
            </tr>
        </tbody>
    </table>
</body>

</html>
