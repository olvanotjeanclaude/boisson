<div class="d-flex justify-content-between">
    @isset($editLink)
        <div>
            <a href="{{ $editLink ?? '#' }}" class="btn btn-primary">
                {{-- <span class="material-icons">edit</span> --}}
                <span class="">Edit</span>
            </a>
        </div>
    @endisset
    @isset($showLink)
        <a href="{{ $showLink ?? '#' }}" class="btn btn-secondary ml-1">
            {{-- <span class="material-icons">visibility</span> --}}
            Voir
        </a>
    @endisset
    @isset($deleteLink)
        <button data-id="{{ $id }}" class="ml-1 btn btn-danger delete-btn" data-url="{{ $deleteLink }}">
            Supprimer
        </button>
    @endisset
</div>
