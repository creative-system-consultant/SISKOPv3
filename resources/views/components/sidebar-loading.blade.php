<style>
.load {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(14px); 
    -webkit-backdrop-filter: blur(14px);
    display: flex;
    justify-content: center;
    align-items: center;
    }
    
    .load.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }
    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }
</style>
<div  id="myDIV"  class="bg-black bg-opacity-50 load" style="visibility: hidden;">
    <img src="{{ asset('img/loading.png') }}" alt="" class="w-auto h-20 animate-pulse ">
</div>
<script>
    function loading() {

        var x = document.getElementById("myDIV");
        if (x.style.visibility === "hidden") {
            x.style.visibility = "visible";
        } else {
            x.style.visibility = "hidden";
        }
    }
</script>