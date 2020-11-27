@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Спасибо за информацию!</h2>

                        @if($item)
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h4>Вы успешно загрузили следующую информацию:</h4>
                                    <div class="table-responsive">
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
                                            <tr>
                                                <td class="font-weight-bold">Фото</td>
                                                <td>
                                                    @foreach($item->getPhotos() as $photo)
                                                        <a href="{{$photo['path']}}" target="_blank"
                                                           class="mb-3 d-block">
                                                            <img style="max-width: 500px;" src="{{$photo['path']}}"
                                                                 alt="">
                                                        </a>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <a href="/" class="btn btn-primary">На главную</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
