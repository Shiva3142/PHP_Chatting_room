$(document).ready(function(){
    $('#hideshownavbar').click(function (event){
        event.preventDefault()
        $('#navbar').toggle(10,()=>{
            if ($('#navbar').css('display')=='block') {
                $('#navbar').css('display','flex')
            }
        });
    })
})

function Typename() {
    let i = 0;
    function writeName() {
        let name = "Shivkumar Chauhan"
        let nameplace = document.getElementById('developer')
        if (i <= name.length) {
            nameplace.innerHTML = name.slice(0, i)
            i++;
            setTimeout(writeName, 50)
        }
    }
    writeName()
}
setInterval(Typename, 2000)
