@extends('app')

@section('content')
    <main class="bg-white dark:bg-gray-900 min-h-full">
        <div class="py-8 px-12 mx-auto max-w-screen-sm">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Свяжитесь
                с
                нами</h2>
            <p class="mb-8 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Для того, чтобы
                начать сотрудничество оставьте свои контактные данные</p>

            <form action="{{ route('lead.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="last_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                    <input type="text" id="last_name" name="last_name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Иванов" value="{{ old('last_name') }}" required>
                    @foreach ($errors->get('last_name') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="first_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                    <input type="text" id="first_name" name="first_name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Иван" value="{{ old('first_name') }}" required>
                    @foreach ($errors->get('first_name') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="mb-4">
                    <label for="second_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                    <input type="text" id="second_name" name="second_name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Иванович" value="{{ old('second_name') }}">
                    @foreach ($errors->get('second_name') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="mb-4">
                    <label for="phone"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Телефон</label>
                    <input type="tel" id="phone" name="phone"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="+7 (123) 456-7890" value="{{ old('phone') }}"
                           pattern="^\+\d{1,3} ?\(?\d{3}\)? ?\d{3}\-?\d{4}$"
                           required>
                    @foreach ($errors->get('phone') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="mb-4">
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="ivan_ivanov@mail.com" pattern="^.+@.+\..+$" value="{{ old('email') }}" required>
                    @foreach ($errors->get('email') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="message"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Комментарий</label>
                    <textarea id="message" name="message" rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="">{{ old('message') }}</textarea>
                    @foreach ($errors->get('message') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата
                        рождения</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input type="text" id="birthdate" name="birthdate"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="04.08.1988" value="{{ old('birthdate') }}" required>
                    </div>
                    @foreach ($errors->get('birthdate') as $message)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @endforeach
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Отправить
                </button>
            </form>

        </div>
    </main>
@endsection
