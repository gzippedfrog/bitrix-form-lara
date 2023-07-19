@extends('app')

@section('content')
    <div class="h-full flex flex-col justify-center items-center text-center">
        <h1 class="text-4xl mb-4">
            Ошибка при отправке заявки
        </h1>
        <p class="text-gray-400 text-xl mb-6">
            Попробуйте повторить позже
        </p>
        <a href="{{route('lead.create')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Обратно на главную</a>
    </div>
@endsection
