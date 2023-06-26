<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento</title>
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
        <table style="width: 100%; margin-bottom: 50px; margin-left: auto; align: center; margin-right: auto;"
            border="1" cellspacing="1" cellpadding="0">
            <tbody style="font-size: 12pt;">
                <tr>
                    <td style="font-size: 12pt;">
                        <table style="padding-left:20px; width: 100%; margin-left: auto; margin-right: auto;"
                            border="0">
                            <tbody>
                                <tr>
                                    <td>Nome: <strong>{{ $data->agendamento->paciente->nome }}</strong></td>
                                    <td>Código: <strong>{{ $data->agendamento->paciente->cod_acesso }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Idade:
                                        <strong><strong>{{ \Carbon\Carbon::parse($data->agendamento->paciente->dtnascimento)->age }}&nbsp;</strong></strong>|
                                        Sexo:&nbsp;
                                        @if ($data->agendamento->paciente->sexo == 0)
                                            <strong>MASCULINO</strong>
                                        @else
                                            <strong>FEMININO</strong>
                                        @endif
                                    </td>
                                    <td>Conv&ecirc;nio: <strong>{{ $data->agendamento->convenio->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Data Nascimento:
                                        <strong>{{ \Carbon\Carbon::parse($data->agendamento->paciente->dtnascimento)->format('d/m/Y') }}</strong>
                                    </td>
                                    <td>Atendente: <strong>{{ $data->agendamento->funcionario->nome }}</strong></td>
                                </tr>
                                <tr>
                                    <td>CPF: <strong>{{ $data->agendamento->paciente->cpf }}</strong></td>
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
        <p style="font-size: 12pt;">{!! $data->conteudo !!}</p>

    </div>
</body>

</html>
