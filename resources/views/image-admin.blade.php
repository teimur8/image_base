@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Фотографии и информация</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>НПА</th>
                                <th>ФИО держателя </th>
                                <th>ФИО назначенного лица</th>
                                <th>Квалификация</th>
                                <th>Телефона</th>
                                <th>Email</th>
                                <th>Инстаграм</th>
                                <th>Фотографии</th>
                                <th>Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->npaId }}</td>
                                    <td>{{ $item->fio1 }}</td>
                                    <td>{{ $item->fio2 }}</td>
                                    <td>{{ $item->qualification }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->instagram }}</td>
                                    <td></td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $items->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
