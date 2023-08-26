@extends('layouts.app-simple')

@section('APP_NAME', 'About Me | Arda\'lan')

@section('body')
    {{-- <div class="w-full h-full flex justify-center items-start p-4 absolute bg-black opacity-80 text-white text-5xl"><span class="animate-pulse">Under Construction...</span></div> --}}
    {{-- <div class="absolute z-0 bg-orange-500 h-full w-full"></div> --}}
    <div class="relative z-10 flex flex-col h-full bg-black bg-opacity-90 text-gray-300">
        <header class="relative z-10 shadow-md shadow-orange-500">
            <nav>
                <ul class="flex lg:px-4">
                    <li class="m-3 flex justify-center items-center">
                        <div class="w-4 h-4 rounded-full bg-orange-500"></div>
                    </li>
                    <li class="m-3">{{ env('DEV_NAME') }}</li>
                    <li class="m-3 flex justify-center items-center font-light text-[10px]"><a href="#about">Developer</a></li>
                    <li class="m-3 ml-auto"><a href="{{ asset('about-me-assets/MyResume-[www.cvbuilder.me].pdf') }}">Resume fa<span class="font-bold">&#8681;</span></a></li>
                    {{-- <li class="m-3"><a href="#projects">Projects</a></li> --}}
                    <li class="m-3"><a href="#infoBar">Contact</a></li>
                </ul>
            </nav>
        </header>
        <main class="flex-auto flex md:flex-row flex-col sm:flex-col bg-zinc-800 justify-center items-center p-4">
            <section class="sm:flex-1 flex md:justify-end justify-center sm:justify-center md:items-center items-center p-3" id="picture">
                <div class="border border-orange-500 w-64 h-64 sm:w-80 sm:h-80 rounded-full bg-orange-900 bg-opacity-40"><img src="{{ asset('about-me-assets/AboutMe_low_quality.png') }}"
                        class="object-scale-down w-full h-full rounded-full" alt="profile picture"></div>
            </section>
            <section class="sm:flex-1 flex flex-col sm:flex-col  justify-center sm:items-start sm:p-3" id="info">
                <h1 class="text-[76px] m-1">Hello!</h1>
                <h2 class="sm:text-xl text-2xl m-1 capitalize">a bit about me</h2>
                <p class="sm:w-[600px] md:w-[380px] lg:w-[600px]     m-1 sm:text-sm text-lg">
                    Hello, I'm {{ env('DEV_NAME') }}, a aspiring web developer with a passion for creating functional and visually appealing websites. I am constantly learning and improving my skills to stay up-to-date
                    with the latest web technologies.
                    I have a good understanding of HTML, CSS, and JavaScript, and I'm currently exploring frameworks like(e.g., <span class="border-yellow-500 border-b">Laravel</span>, <span
                        class="border-yellow-500 border-b">Tailwind CSS</span>).
                    While I may not have professional experience yet, I have worked on personal projects to gain practical knowledge and showcase my abilities.<br>
                    Thank you for visiting my portfolio website. If you have any questions or opportunities for collaboration, please feel free to reach out. I am excited to grow as a developer and contribute to the web
                    development community.
                </p>
            </section>
        </main>
        <footer class="text-center py-2 border-t border-orange-500 border-opacity-50" id="infoBar">
            <ul class="flex sm:flex-row flex-col justify-around items-center">
                <li class="p-1 font-bold">Phone <br><span class="font-normal text-sm hover:underline text-blue-500 cursor-pointer" id="phoneRevealer">Click To Reveal</span><span
                        class="font-normal text-sm hidden cursor-pointer hover:underline" id="phoneNumber" data-clipboard-target="#phoneNumber">+989226556078</span></li>
                <li class="p-1 font-bold">Email <br><span class="font-normal text-sm cursor-pointer active:text-blue-500 hover:underline" id="email" data-clipboard-target="#email">tidze.gh@gmail.com</span></li>
                <li class="p-1 font-bold flex flex-col justify-center items-center cursor-pointer">Follow Me
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 50 50" width="50px" height="50px">
                        <path
                            d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z" />
                    </svg>
                </li>
                <li class="">&copy; 2023 {{ env('DEV_NAME') }}</li>
            </ul>
        </footer>
    </div>

@endsection
@push('script-head')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#phoneRevealer').click(function() {
                $('#phoneRevealer').toggle();
                $('#phoneNumber').toggle();
            });

            $('#email').on('click', function() {
                var clipboard = new ClipboardJS('#email');

                clipboard.on('success', function(e) {
                    alert('Text copied to clipboard!');
                });

                clipboard.on('error', function(e) {
                    console.error('Error copying text to clipboard:', e.action);
                });
            });
            $('#phoneNumber').on('click', function() {
                var clipboard = new ClipboardJS('#phoneNumber');

                clipboard.on('success', function(e) {
                    alert('Text copied to clipboard!');
                });

                clipboard.on('error', function(e) {
                    console.error('Error copying text to clipboard:', e.action);
                });
            });
        });
    </script>
@endpush
