{{-- @extends('layouts.app-main') --}}
{{-- @section('content') --}}
    <div class="grid-container">
        <header class="grid-item header">
            <h2>🍽 CSS Grid Tem-plated 🍽</h2>

        </header>
        <div class="grid-item title">
            <h1>So you wanna side scroll, eh?</h1>
        </div>
        <main class="grid-item main">
            <div class="items">
                <div class="item item1"></div>
                <div class="item item2"></div>
                <div class="item item3"></div>
                <div class="item item4"></div>
                <div class="item item5"></div>
                <div class="item item6"></div>
                <div class="item item7"></div>
                <div class="item item8"></div>
                <div class="item item9"></div>
                <div class="item item10"></div>
            </div>
            <p>🐰🥚Click & Drag <i>powered by TypeScript</i></p>
        </main>
        <footer class="grid-item footer">
            <h2>More Things</h2>
            <a>All of the Things</a>
            <a>Some of the Things</a>
            <a>None of the Things</a>
        </footer>
    </div>
{{-- @endsection --}}

{{-- @push('style') --}}
    <style>
        body,
        html {
            color: #fff;
            text-align: center;
            background: #efefef;
            font-family: Helvetica, sans-serif;
            margin: 0;
        }

        .grid-container {
            background: #efefef;
            font-family: 'Rubik', sans-serif;
        }

        @supports('display') {

            .grid-container {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: auto 1fr auto;

                //Let the craziness begin!!!
                grid-template-areas:
                    "header header header"
                    "title title "
                    "main main main";

            }

            .grid-item {
                color: #fff;
                background: skyblue;
                padding: 3.5em 1em;
                font-size: 1em;
                font-weight: 700;
            }

            .header {
                background-color: darken(skyblue, 60%);
                grid-area: header;
                padding: 1em;
            }

            .title {
                color: #555;
                background-color: lighten(skyblue, 25%);
                grid-area: title;
            }

            .main {
                color: lighten(#555, 25%);
                background-color: lighten(skyblue, 60%);
                grid-area: main;
                padding: 0;
                overflow-x: scroll;
                overflow-y: hidden;
            }

            .footer {
                background-color: darken(skyblue, 10%);
                grid-area: footer;
                padding: 0.6em;
            }

            .items {
                position: relative;
                width: 100%;
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;
                transition: all 0.2s;
                transform: scale(0.98);
                will-change: transform;
                user-select: none;
                cursor: pointer;
            }

            .items.active {
                background: rgba(255, 255, 255, 0.3);
                cursor: grabbing;
                cursor: -webkit-grabbing;
                transform: scale(1);
            }

            .item {
                display: inline-block;
                background: skyblue;
                min-height: 250px;
                min-width: 400px;
                margin: 2em 1em;


            }
        }

        a {
            display: block;
            color: lighten(skyblue, 15%);
            text-decoration: underline;
            margin: 1em auto;

            &:hover {
                cursor: pointer;
            }
        }

        p {
            text-align: left;
            text-indent: 20px;
            font-weight: 100;
        }

        i {
            color: skyblue;
        }
    </style>
{{-- @endpush --}}

{{-- @push('script') --}}
    <script>
        const slider = document.querySelector('.items');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            console.log(walk);
        });
    </script>
{{-- @endpush --}}
