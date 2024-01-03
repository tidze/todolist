@extends('base')
@section('body')
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-dots-lighter bg-gray-900 selection:bg-orange-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">

            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a href=""
                        class="scale-100 p-6  bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent ring-1 ring-inset ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-orange-500">
                        <div>
                            <div class="h-16 w-16 bg-orange-50 bg-orange-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-orange-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>

                            <p class="mt-6 text-xl font-semibold text-orange-400">( * ＾▽＾)／ Hi! </p>

                            <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                                Welcome To {{ env('APP_NAME') }}!
                                <br>
                                Here I made a website so that you could track your time.
                                <br>
                                Here's a question I always have had in my mind:
                                <br>
                                What where you doing for the past days, months or years?
                            </p>
                        </div>

                    </a>

                    <div
                        class="flex w-full scale-100 p-6 bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent ring-1 ring-inset ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-orange-500">
                        <div class="flex  justify-start items-center w-full ">

                            @if (Route::has('login'))
                                <div class="flex md:flex-col w-full">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="m-1 flex-1 p-2 font-semibold text-gray-600  hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500"><span
                                                class="text-orange-500 text-xl">&#x2AA7</span>&#x2800 Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="m-1 flex-1 p-2 font-semibold text-gray-600 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500"> <span
                                                class="text-orange-500 text-xl">&#x2AA7</span>&#x2800 Log
                                            in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="m-1 flex-1 p-2 font-semibold text-gray-600  hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500"><span
                                                    class="text-orange-500 text-xl">&#x2AA7</span>&#x2800 Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="" class="px-1 group inline-flex items-center hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500">
                            ☆
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
                @include('aboutme_link')
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script-end-of-body')
@endpush
