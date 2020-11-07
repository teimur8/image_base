@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Фотографии и информация</div>

                    <div class="card-body">

                        <form action="" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Введите любые данные" value="{{ request()->get('q') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Поиск</button>
                                    <a class="btn btn-outline-secondary" href="/admin/images">Сбросить</a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Общая информация</th>
                                    <th>Контакты</th>
                                    <th>Фотографии</th>
                                    <th>Дата создания</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">Номер НПА</td>
                                                    <td>{{ $item->npaId }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">ФИО держателя договора</td>
                                                    <td>{{ $item->fio1 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">ФИО назначенного лица</td>
                                                    <td>{{ $item->fio2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Квалификация</td>
                                                    <td>{{ $item->qualification }}</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">Телефон</td>
                                                    <td>{{ $item->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td>{{ $item->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Инстаграм</td>
                                                    <td>{{ $item->instagram }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>

                                        <td>
                                            @foreach($item->photos as $photo)
                                                <a href="{{$photo}}" target="_blank" class="mb-3 d-block">
                                                    <img style="max-width: 100px;" src="{{$photo}}" alt="">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $items->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
