@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection


@section('title')
    Liste De Clients
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'client',
        'breadcrumbs' => [
            ['text' => 'clients', 'link' => route('admin.clients.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau client',
            'link' => route('admin.clients.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                @include('component.alert', [
                    'type' => 'success',
                    'message' => session('success'),
                ])
            @endif
        </div>
    </div>

    <!-- Material Data Tables -->
    <section id="material-datatables">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title"> Liste Des  clients</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable text-nowrap  material-table">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Identification</th>
                                            <th>Code</th>
                                            <th>Telephone</th>
                                            <th>Adresse</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $customer)
                                            <tr>
                                                <td>
                                                    {!! $customer->badge !!}
                                                </td>
                                                <td>{{ $customer->identification }}</td>
                                                <td>{{ $customer->code }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ Str::limit($customer->address, 20) }}</td>
                                                <td>{{ format_date($customer->created_at) }}</td>
                                                <td>
                                                    @include('includes.action-button', [
                                                        'id' => $customer->id,
                                                        'editLink' => route('admin.clients.edit', $customer->id),
                                                        'deleteLink' => route('admin.clients.destroy', $customer->id),
                                                    ])
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
