<style>
    #logo-bg {
            position: relative;
        }

        #logo-bg>div:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            border-top: 40px solid white;
            border-left: 40px solid transparent;
            width: 0;
        }

        #logo-bg>div:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            border-bottom: 40px solid white;
            border-right: 40px solid transparent;
            width: 0;
        }
</style>


<div id="logo-bg" class="inline-block">
    <div class="flex flex-col align-center bg-gray-700 p-6 ">
        <div class="flex justify-center uppercase text-white text-6xl">planpacer</div>
        <div class="flex justify-center capitalize text-white text-xl">Track Your Time</div>
    </div>
</div>
