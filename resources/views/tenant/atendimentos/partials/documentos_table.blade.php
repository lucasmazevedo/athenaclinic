<table class="table-bordered fs-6 table align-middle" id="coreDatatable">
    <thead>
        <tr class="text-muted fw-bold fs-7 gs-2 text-uppercase text-start">
            <th class="min-w-125px">Titulo</th>
            <th class="min-w-125px">Cadastrada em</th>
            <th class="min-w-70px text-end">Ações</th>
        </tr>
    </thead>
    <tbody class="fw-semibold text-gray-600">
        @foreach ($documentos as $doc)
            <tr>
                <td>{{ $doc->titulo }}</td>
                <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                <td class="text-end">
                    <a href="{{ route('atendimentos.printDocumento', $doc->id) }}" target="_Blank"
                        class="btn btn-sm btn-primary"><i class="bi bi-printer fs-2"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
