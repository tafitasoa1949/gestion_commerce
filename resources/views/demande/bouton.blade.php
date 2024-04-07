@if($fonction == 2)
    <td>
            <a href="{{ route('Confirmation', ['id' => $indice->id, 'etat' => 'finance']) }}" class="btn btn-success btn-circle btn-sm">
                <i class = "fas fa-check"></i>
            </a>
    </td>
@else($fonction == 4)
    <td>
    <a href="{{ route('Confirmation', ['id' => $indice->id, 'etat' => 'chef']) }}" class="btn btn-success btn-circle btn-sm">
        <i class = "fas fa-check"></i>
    </a>
    </td>
@endif


